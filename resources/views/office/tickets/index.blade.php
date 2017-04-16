@extends('layouts.app') @section('content')
<section class="content">
    <!-- Default box -->
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Welcome to the support center</h3>
            <p style="margin-top: 10px;">In order to streamline support requests and better serve you, we utilize a support ticket system. Every support request is assigned a unique ticket number which you can use to track the progress and responses online. For your reference we provide complete archives and history of all your support requests. A valid email address is required to submit a ticket.</p>
            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                    <i class="fa fa-minus"></i></button>
            </div>
        </div>
        <div class="box-body">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#newIssue">Open a New Ticket</button>
            <button type="button" class="btn btn-success pull-right" data-toggle="modal" data-target="#status">Check Ticket Status</button>
            <!-- BEGIN NEW TICKET -->
            <div class="modal fade" id="newIssue" tabindex="-1" role="dialog" aria-labelledby="newIssue" aria-hidden="true">
                <div class="modal-wrapper">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header bg-blue">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                <h4 class="modal-title"><i class="fa fa-pencil"></i> Create a New Ticket</h4>
                            </div>
                            <form action="#" method="post">
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="email">Email Address</label>
                                        <input name="email" type="email" class="form-control" placeholder="Email Address">
                                    </div>
                                    <!-- select -->
                                    <div class="form-group">
                                        <label>Help Topic</label>
                                        <select class="form-control">
                                            <option>-- Select a Help Topic --</option>
                                            <option>Feedback</option>
                                            <option>General Enquiry</option>
                                            <option>Report a Problem</option>
                                            <option>Report Fake POP</option>
                                            <option>Access Issue</option>
                                            <option>Other Issues</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="summary">Issue Summary</label>
                                        <input type="text" name="summary" class="form-control" placeholder="Summary of the Issue">
                                    </div>
                                    <div class="box">
                                        <div class="box-header">
                                            <h3 class="box-title">Ticket Details
													<small>Please describe your issue</small>
												</h3>
                                        </div>
                                        <!-- /.box-header -->
                                        <div class="box-body pad">
                                            <textarea class="textarea" placeholder="Please detail your issue or question" style="width: 100%; height: 120px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <input type="file" name="attachment">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Discard</button>
                                    <button type="submit" class="btn btn-primary pull-right"><i class="fa fa-pencil"></i> Create</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END NEW TICKET -->
            <!-- CHECK TICKET STATUS -->
            <div class="modal fade" id="status" tabindex="-1" role="dialog" aria-labelledby="status" aria-hidden="true">
                <div class="modal-wrapper">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header bg-blue">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                <h4 class="modal-title"><i class="fa fa-pencil"></i> Check Ticket Status</h4>
                            </div>
                            <form action="#" method="post">
                                <div class="modal-body">
                                    <p>Please provide your email address and ticket number, an access link will be emailed to you.</p>
                                    <div class="form-group">
                                        <label for="email">Email Address</label>
                                        <input name="email" type="email" class="form-control" placeholder="Email Address">
                                    </div>
                                    <div class="form-group">
                                        <label for="ticketNumber">Ticket Number</label>
                                        <input type="text" name="summary" class="form-control" placeholder="E.G 13680">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Discard</button>
                                    <button type="submit" class="btn btn-primary pull-right"><i class="fa fa-pencil"></i> Email Access Link</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END CHECK TICKET STATUS -->
            <div style="padding: 10px;"></div>
            <div class="row">
                <!-- BEGIN TICKET CONTENT -->
                <div class="col-md-12">
                    <ul class="list-group fa-padding">
                        <li class="list-group-item" data-toggle="modal" data-target="#issue">
                            <div class="media">
                                <div class="media-body">
                                    <strong>My account is blocked. Please support, re-activate immediately</strong> <span class="label label-warning">PENDING</span><span class="number pull-right"># 13698</span>
                                    <p class="info">Opened by <a href="#">username</a> 5 hours ago </p>
                                </div>
                            </div>
                        </li>
                        <li class="list-group-item" data-toggle="modal" data-target="#issue">
                            <div class="media">
                                <div class="media-body">
                                    <strong>I have not been matched for two weeks now.</strong> <span class="label label-success">OPEN</span><span class="number pull-right"># 13697</span>
                                    <p class="info">Opened by <a href="#">username</a> 12 hours ago </p>
                                </div>
                            </div>
                        </li>
                        <li class="list-group-item" data-toggle="modal" data-target="#issue">
                            <div class="media">
                                <div class="media-body">
                                    <strong>Difficulty uploading my proof of payment</strong> <span class="label label-primary">CLOSED</span><span class="number pull-right"># 13695</span>
                                    <p class="info">Opened by <a href="#">username</a> 19 hours ago </p>
                                </div>
                            </div>
                        </li>
                        <li class="list-group-item" data-toggle="modal" data-target="#issue">
                            <div class="media">
                                <div class="media-body">
                                    <strong>My account has been compromised</strong> <span class="label label-danger">URGENT</span><span class="number pull-right"># 13680</span>
                                    <p class="info">Opened by <a href="#">username</a> 2 days ago </p>
                                </div>
                            </div>
                        </li>
                    </ul>
                    <!-- BEGIN DETAIL TICKET -->
                    <div class="modal fade" id="issue" tabindex="-1" role="dialog" aria-labelledby="issue" aria-hidden="true">
                        <div class="modal-wrapper">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header bg-blue">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                        <h4 class="modal-title"><i class="fa fa-cog"></i> My account has been compromised</h4>
                                    </div>
                                    <form action="#" method="post">
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-md-2">
                                                </div>
                                                <div class="col-md-10">
                                                    <p>Issue <strong>#13680</strong> opened by <a href="#">username</a> 2 days ago</p>
                                                    <p>These section will contain the detailed report the user sent to the support system. </p>
                                                    <p>The complaint continues on this line also.</p>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="row">
                                                <div class="col-md-2">
                                                </div>
                                                <div class="col-md-10">
                                                    <p>Posted by <a href="#">Admin</a> on 10/04/2017 at 14:12</p>
                                                    <p>These section will contain a feedback from any dedicated support team. A reply to the complaint.</p>
                                                    <p>The thread will continue in an alternate manner. That is; a post from the user and another reply from the admin or dedicated support staff</p>
                                                    <a href="#"><span class="fa fa-reply"></span> &nbsp;Post a reply</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- END DETAIL TICKET -->
                </div>
                <!-- END TICKET CONTENT -->
            </div>
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
            Footer
        </div>
        <!-- /.box-footer-->
    </div>
    <!-- /.box -->
</section>
@stop
