<?php

namespace App\Factories;

use App\Mail\ActivationMail;
use App\Repositories\ActivationRepository;
use App\User;
use Illuminate\Mail\Mailer;
use Illuminate\Mail\Message;
use Illuminate\Queue\SerializesModels;

class UserActivation
{
    

    protected $activationRepo;
    protected $mailer;
    protected $resendAfter = 24;

    public function __construct(ActivationRepository $activationRepo, Mailer $mailer)
    {
        $this->activationRepo = $activationRepo;
        $this->mailer = $mailer;
    }

    public function sendActivationMail($user)
    {
        if ($user->activated /*|| !$this->shouldSend($user)*/) {
            return;
        }

        $token = $this->activationRepo->createActivation($user);

        $link = route('user.activate', $token);
        // $message = sprintf('Activate account %s', $link, $link);

        \Mail::to($user->email)->send(new ActivationMail($user, $token));

        // $this->mailer->raw($message, function (Message $m) use ($user) {
        //     $m->to($user->email)->subject('Activation mail');
        // });
    }

    public function activateUser($token)
    {
        $activation = $this->activationRepo->getActivationByToken($token);

        if ($activation === null) {
            return null;
        }

        $user = User::find($activation->user_id);

        $user->activated = true;

        $user->save();

        $this->activationRepo->deleteActivation($token);

        return $user;
    }

    private function shouldSend($user)
    {
        $activation = $this->activationRepo->getActivation($user);
        return $activation === null || strtotime($activation->created_at) + 60 * 60 * $this->resendAfter < time();
    }

}