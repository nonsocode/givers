<?php 

namespace App\Traits;

use Illuminate\Http\Request;
use ReCaptcha\ReCaptcha;

//Verify GoogleCaptcha
trait GoogleCaptcha {

	public function captchaVerify(Request $request)
	{
		$resp = $request->get('g-recaptcha-response');
		// $ip = $request->ip();
		$ip = $_SERVER['REMOTE_ADDR'];
		$secret = env('GOOGLE_CAPTCHA_SERVER');

		$googResponse = (new ReCaptcha($secret))->verify($resp, $ip);
		return $googResponse->isSuccess() ? 1:0;
	}

}


 ?>