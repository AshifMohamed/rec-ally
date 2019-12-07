<?php $this->load->view('partial/portal_header.php'); ?>
<?php //$this->load->view('partial/portal_sidebar.php'); ?>
<?php $this->load->view('partial/portal_breadcrumbs.php'); ?>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<style>
    #canvas .circle {
        display: inline-block;
        margin: 1em;
    }

    .circles-decimals {
        font-size: .4em;
    }

    #page-wrapper {
        margin-left: 0px
    }

    #sum_box .block-space {
        padding-left: 0px
    }

    #sum_box .block-space:last-child {
        padding-right: 0 !important;
    }
</style>

<!--BEGIN CONTENT-->
<div class="page-content admin">
    <div id="tab-general">
        <div id="sum_box" class="row mbl">
            <div class="col-sm-6 col-md-3 block-space">
                <div class="small-box profit db mbm">
                    <div class="panel-body">
                        <p class="icon">
                            <i class="icon fa fa-building-o"></i>
                        </p>
                        <h4 class="value">
                                            <span data-counter="" data-start="10" data-end="50" data-step="1"
                                                  data-duration="0">
                                            </span><span><?= count($active_companies_registered); ?></span></h4>
                        <p class="description">
                            Companies Registered</p>
                        <div class="progress progress-sm mbn">
                            <div role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"
                                 style="width: 0%;" class="progress-bar progress-bar-success">
                                <span class="sr-only">80% Complete (success)</span></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-3 block-space">
                <div class="small-box income db mbm">
                    <div class="panel-body">
                        <p class="icon">
                            <i class="icon fa fa-user "></i>
                        </p>
                        <h4 class="value">
                            <span><?= number_format(count($active_candidates_registered), '0', '.', ','); ?></span></h4>
                        <p class="description">
                            Candidates Registered</p>
                        <div class="progress progress-sm mbn">
                            <div role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"
                                 style="width: 0%;" class="progress-bar progress-bar-info">
                                <span class="sr-only">60% Complete (success)</span></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-3 block-space">
                <div class="small-box task db mbm">
                    <div class="panel-body">
                        <p class="icon">
                            <i class="icon fa fa-suitcase"></i>
                        </p>
                        <h4 class="value">
                            <span><?= count($jobs_posted) ?></span></h4>
                        <p class="description">
                            Jobs Posted</p>
                        <div class="progress progress-sm mbn">
                            <div role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"
                                 style="width: 0%;" class="progress-bar progress-bar-danger">
                                <span class="sr-only">50% Complete (success)</span></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-3 block-space">
                <div class="small-box visit db mbm">
                    <div class="panel-body">
                        <p class="icon">
                            <i class="icon fa fa-eye"></i>
                        </p>
                        <h4 class="value">
                            <span><?= number_format($average_logins, '0', '.', ','); ?></span></h4>
                        <p class="description">
                            Average Logins Per Day</p>
                        <div class="progress progress-sm mbn">
                            <div role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100"
                                 style="width: 0%;" class="progress-bar progress-bar-warning">
                                <span class="sr-only">70% Complete (success)</span></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mbl">
            <!--END TOPBAR-->
            <div class="bs-example">
                <div class="panel-group" id="accordion">
                    <div class="panel panel-default">
                        <div class="panel-heading blue-panel-heading">
                            <h4 class="panel-title">
                                <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapse1">
                                    Companies Pending Approval
                                </a>
                            </h4>
                        </div>
                        <div id="collapse1" class="panel-collapse collapse in">
                            <div class="panel-body">
                                <?php if (count($companies_pending_approval) > 0): ?>
                                    <table id="companies_pending_approval" class="display table table-striped table-hover table-bordered" cellspacing="0" width="100%">
                                        <thead>
                                        <tr>
                                            <th>Company Name</th>
                                            <th>Owner</th>
                                            <th>Email</th>
                                            <th>Registered Date</th>
                                            <th>Service</th>
                                            <th>Actions</th>
                                        </tr>
                                        </thead>
                                        
                                        <tbody>
                                        
                                        <?php foreach ($companies_pending_approval as $key => $company): ?>
                                            <tr>
                                                <td><?= $company->name ?></td>
                                                <td><?= $company->owner ?></td>
                                                <td><?= $company->login_email ?></td>
                                                <td><?= $company->registered_date ?></td>
                                                <td><a class="open-service label label-info"
                                                    href="#view_service"
                                                    data-service_id="<?= $company->service_id ?>"
                                                    data-toggle="modal">View</a></td>

                                                <td><button class="btn-green-new" onclick="confirmation('<?= base_url() . ADMIN_PATH_NAME ?>/approve_company?id=<?= $company->user_profile_id ?>','Are you sure to activate this company?');">Approve</button>
                                                    <!-- &nbsp;<label class="label label-danger">Decline</label> -->
                                                </td>
                                            </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                <?php else: ?>
                                    <div class="alert alert-info" role="alert">No Companies Pending for Approval
                                        <strong>!</strong></div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="modal fade" id="view_service">
                                                    <div class="modal-dialog modal-lg">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <button type="button" class="close" data-dismiss="modal"
                                                                        aria-hidden="true">&times;
                                                                </button>
                                                                <h4 class="modal-title">Recruitment Ally Service</h4>
                                                            </div>
                                                            <div class="modal-body">
                                                            <?php if(count($service) > 0): ?>
                                           <table id="tbl_service" class="table table-bordered">
													<thead>
													<tr>
														<th>Id</th>
														<th>Service</th>
														<th>No Of Months</th>
														<th>No Of Access Accounts</th>
                                                        <th>No Of Job Posts</th>
														<th>Amount</th>            
													</tr>
													</thead>
													<tbody>
			                                            <?php foreach ($service as $key => $service) : ?>  
																	<tr class="<?=18 == $service->id ? 'label-free' : '' ?>">
																		<td><?=$service->id?></td>
																		<td><?=$service->title?></td>
																		<td><?=$service->no_of_months?></td>
                                                                        <td><?=$service->no_of_access_account?></td>
																		<td><?=$service->no_of_job_post?></td>
																		<td><?=$service->amount == 0 ? 'Free' : $service->amount?></td>
																	</tr>		
															<?php endforeach; ?>
													</tbody>
												</table>
                                                <?php endif; ?>
                                                </div>
                                                        </div>
                                                    </div>
                                                </div>


                       
                    </div>
                    <div class="panel panel-default hidden">
                        <div class="panel-heading blue-panel-heading">
                            <h4 class="panel-title">
                                <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapse7">
                                    Candidates Pending Activation
                                </a>
                            </h4>
                        </div>
                        <div id="collapse7" class="panel-collapse collapse">
                            <div class="panel-body">
                                <?php if (count($unverified_candidates) > 0): ?>
                                    <table id="candidates_pending_activation" class="display table table-striped table-hover table-bordered" cellspacing="0"
                                           width="100%">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Candidate Name</th>
                                            <th>Registered Date</th>
                                            <th>Email</th>
                                            <th>Method</th>
                                            <th>Last Reminded On</th>
                                            <th>Actions</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php foreach ($unverified_candidates as $key => $candidate): ?>
                                            <?php
                                            $registered_date = explode(' ', $candidate->registered_date);
                                            $last_reminded = explode(' ', $candidate->last_reminded);
                                            ?>
                                            <tr>
                                                <td><?= $key + 1 ?></td>
                                                <td><?= ucwords($candidate->first_name . ' ' . $candidate->last_name) ?></td>
                                                <td><?= $registered_date[0] ?></td>
                                                <td><?= $candidate->email ?></td>
                                                <td><?= ucwords($candidate->method) ?></td>
                                                <td><?= $last_reminded[0] ?></td>
                                                <td><button class="btn-new-green" onclick="confirmation('<?= base_url() . ADMIN_PATH_NAME ?>/remind_candidate?email=<?= $candidate->email ?>&name=<?= ucwords($candidate->first_name . ' ' . $candidate->last_name) ?>' , 'Are you sure to send an activation link?')">Send
                                                            Email</button>
                                                    <!-- &nbsp;<label class="label label-danger">Decline</label> -->
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                <?php else: ?>
                                    <div class="alert alert-info" role="alert">No Candidates Pending to be
                                        Reminded<strong>!</strong></div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading blue-panel-heading">
                            <h4 class="panel-title">
                                <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapse2">
                                    Information Request
                                </a>
                            </h4>
                        </div>
                        <div id="collapse2" class="panel-collapse collapse">
                            <div class="panel-body">
                                <?php if (count($contact_us_requests) > 0): ?>
                                    <table id="information_requests" class="display table table-striped table-hover table-bordered" cellspacing="0" width="100%">
                                        <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Mobile</th>
                                            <th>Country</th>
                                            <th>Request Type</th>
                                            <th>Message</th>
                                            <th>Date</th>
                                            <th>Action</th> 
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php foreach ($contact_us_requests as $key => $request): ?>
                                            <tr>
                                                <td><?= ucwords($request->name) ?></td>
                                                <td><?= $request->email ?></td>
                                                <td><?= $request->mobile ?></td>
                                                <td><?= $request->country ?></td>
                                                <td><?= $request->request_type ?></td>
                                                <td>
                                                    <a tabindex="0" style="width:250px!important;"
                                                       class="label btn btn-info" rel="popover" title="Message"
                                                       data-placement="left" data-trigger="focus"
                                                       data-content="<?= $request->message ?>">View Message</a>
                                                </td>
                                                <td><?= $request->date ?></td>
                                                <td> <button class="btn-danger-new" onClick="delete_contact_request(<?= $request->contact_email_id ?>,this)">Delete</button>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                <?php else: ?>
                                    <div class="alert alert-info" role="alert">No Contact Us Requests Found
                                        <strong>!</strong></div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading blue-panel-heading">
                            <h4 class="panel-title">
                                <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapse3">
                                    Vote Result
                                </a>
                            </h4>

                        </div>
                        <div id="collapse3" class="panel-collapse collapse">
                            <div class="panel-body">
                                <button type="button" id="view_edit_polls" data-toggle="modal"
                                        href="#modal_view_edit_polls" class="btn btn-blue pull-right">View/Edit Polls
                                </button>
                                <button type="button" data-toggle="modal" href="#modal_create_new_poll"
                                        id="create_new_poll" class="btn btn-blue pull-right">Create New Poll
                                </button>
                                <div class="clearfix"></div>
                                <br/>
                                <div class="modal fade" id="modal_view_edit_polls">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal"
                                                        aria-hidden="true">&times;
                                                </button>
                                                <h4 class="modal-title">View/Edit Polls</h4>
                                            </div>
                                            <div class="modal-body">
                                                <table id="table_edit_view_polls" class="display table table-striped table-hover table-bordered" cellspacing="0"
                                                       width="100%">
                                                    <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Question</th>
                                                        <th>Options</th>
                                                        <!-- <th>End Date</th> -->
                                                        <th>Published</th>
                                                        <th>Actions</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <?php foreach ($polls as $key => $poll): ?>
                                                        <tr>
                                                            <td width="5%"><?= $key + 1 ?></td>
                                                            <td width="35%"><?= $poll->name ?></td>
                                                            <td width="15%">
                                                                <?php $poll_options = get_poll_options_by_poll_id($poll->poll_id); ?>
                                                                <?php foreach ($poll_options as $key => $option): ?>
                                                                    <label><?= $key + 1 ?>)</label>
                                                                    <span> <?= $option->option ?></span><br/>
                                                                <?php endforeach; ?>
                                                            </td>
                                                            <!-- <td width="18%"><?= $poll->end_date ?></td> -->
                                                            <td width="5%">
                                                                <div class="poll-published toggle-green"></div>
                                                                <input id="is_published" name="is_published"
                                                                       class="hidden" type="checkbox"
                                                                       value="<?= $poll->is_published ? 'true' : 'false' ?>" <?= $poll->is_published ? 'checked' : '' ?> />
                                                            </td>
                                                            <td width="15%">
                                                                <span class="label label-primary edit_poll"
                                                                      data-id="<?= $poll->poll_id ?>">Edit</span>&nbsp;
                                                                <button class="btn-danger-new" onclick="confirmation('<?= base_url() . ADMIN_PATH_NAME ?>/delete_poll/<?= $poll->poll_id ?>' , 'Are you sure to delete it?')"
                                                                            href="">Delete</button>
                                                            </td>
                                                        </tr>
                                                    <?php endforeach; ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-danger" data-dismiss="modal">
                                                    Close
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal fade" id="modal_create_new_poll">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <form method="POST" action="<?= base_url() . ADMIN_PATH_NAME ?>/save_poll">
                                                <input type="hidden" name="poll_id" id="poll_id" value="0">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal"
                                                            aria-hidden="true">&times;
                                                    </button>
                                                    <h4 class="modal-title">Create New Poll</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <!-- <legend>New Poll</legend> -->
                                                    <div class="form-group">
                                                        <label for="poll_name">Name</label>
                                                        <input type="text" class="form-control" name="poll_name"
                                                               id="poll_name"
                                                               placeholder="Name of the Poll (eg: Who is Will Smith)">
                                                    </div>
                                                    <!-- <div class="form-group">
                                                        <label for="poll_name">End Date</label>
                                                        <input type="text" class="form-control" name="poll_end_date" id="poll_end_date" placeholder="When to End the Poll?">
                                                    </div> -->
                                                    <div class="form-group poll-options">
                                                        <label for="poll_name">Poll Options</label>
                                                        <input type="text" class="form-control" name="poll_option[]"
                                                               id="poll_option"
                                                               placeholder="Poll Option (eg: Artist, Actor, NBA Player etc.)">
                                                        <i class="fa fa-plus"></i>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="poll_name">Publish Now</label>
                                                        <div class="poll-published toggle-green"></div>
                                                        <input id="is_published" name="is_published"
                                                               style="visibility:hidden" type="checkbox"/>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-danger" data-dismiss="modal">
                                                        Close
                                                    </button>
                                                    <button type="submit" class="btn btn-blue">Save Poll</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div id="myCarousel" class="carousel slide" data-ride="carousel">
                                    <!-- Indicators -->
                                    <ol class="carousel-indicators">
                                        <?php foreach ($polls as $key => $poll): ?>
                                            <?php $poll_count = '';
                                            $options = '';
                                            $poll_options = get_poll_options_by_poll_id($poll->poll_id); ?>
                                            <?php foreach ($poll_options as $key_inner => $option): ?>
                                                <?php $options .= $option->option . ','; ?>
                                                <?php $poll_count .= get_poll_option_count($poll->poll_id, $option->poll_option_id) . ','; ?>
                                            <?php endforeach;
                                            if (empty($poll_count)) $poll_count = 0;
                                            if (empty($poll_count)) $options = 0; ?>
                                            <li data-target="#myCarousel" data-name="poll_item<?= $key ?>"
                                                data-options-value="<?= remove_trailing_commas($options) ?>"
                                                data-count-value="<?= remove_trailing_commas($poll_count) ?>"
                                                data-slide-to="<?= $key ?>"
                                                class="<?= $key == 0 ? 'active' : '' ?>"></li>
                                        <?php endforeach; ?>
                                    </ol>

                                    <!-- Wrapper for slides -->
                                    <div class="carousel-inner" role="listbox">
                                        <?php foreach ($polls as $key => $poll): ?>
                                            <div class="item <?= $key == 0 ? 'active' : '' ?>">
                                                <div class="portlet box mbl col-md-12 pull-left">
                                                    <div class="portlet-header">
                                                        <div class="caption"><?= $poll->name ?> - Poll</div>
                                                        <div class="tools"><i class="fa fa-chevron-up"></i>
                                                            <!-- <i data-toggle="modal" data-target="#modal-config" class="fa fa-cog"></i><i class="fa fa-refresh"></i><i class="fa fa-times"></i> -->
                                                        </div>
                                                    </div>
                                                    <div class="portlet-body">
                                                        <div id="poll_chart<?= $key + 1 ?>"
                                                             style="width: 100%; height:300px"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                    <!-- Left and right controls -->
                                    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
                                        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                                        <span class="sr-only">Previous</span>
                                    </a>
                                    <a class="right carousel-control" href="#myCarousel" role="button"
                                       data-slide="next">
                                        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                                        <span class="sr-only">Next</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading blue-panel-heading">
                            <h4 class="panel-title">
                                <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapse4">
                                    Newsletter
                                </a>
                            </h4>
                        </div>
                        <div id="collapse4" class="panel-collapse collapse">
                            <div class="panel-body">
                                <?php if (count($newsletter_subscribers) > 0): ?>
                                    <table id="newsletter_subscribers" class="display table table-striped table-hover table-bordered" cellspacing="0" width="100%">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Date</th>
                                        </tr>
                                        </thead>
                                        
                                        <tbody>
                                        <?php foreach ($newsletter_subscribers as $key => $subscriber): ?>
                                            <tr>
                                                <td><?= $key + 1 ?></td>
                                                <td><?= $subscriber->name ?></td>
                                                <td><?= $subscriber->email ?></td>
                                                <td><?= $subscriber->date ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                <?php else: ?>
                                    <div class="alert alert-info" role="alert">No User Have Subscribed for the
                                        Newsletter yet <strong>!</strong></div>
                                <?php endif; ?>
                                <div class="clearfix"></div>
                                <div class="modal fade" id="newsletter_modal">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal"
                                                        aria-hidden="true">&times;
                                                </button>
                                                <h4 class="modal-title">Create/Edit and Send Newsletter to all
                                                    Subscribers</h4>
                                            </div>
                                            <div role="tabpanel">
                                                <!-- Nav tabs -->
                                                <ul class="nav nav-tabs" role="tablist">
                                                    <li role="presentation" class="active">
                                                        <a class="btn btn-blue" href="#tb_create_edit_newsletter"
                                                           aria-controls="create_edit_newsletter" role="tab"
                                                           data-toggle="tab">Create/Edit</a>
                                                    </li>
                                                    <li role="presentation">
                                                        <a class="btn btn-success" href="#tb_send_newsletter" aria-controls="tb_send_newsletter"
                                                           role="tab" data-toggle="tab">Send Newsletter</a>
                                                    </li>
                                                </ul>

                                                <!-- Tab panes -->
                                                <div class="tab-content">
                                                    <div role="tabpanel" class="tab-pane active"
                                                         id="tb_create_edit_newsletter">
                                                        <form action="<?= base_url() . ADMIN_PATH_NAME ?>/save_newsletter"
                                                              method="POST" class="form-horizontal" role="form"
                                                              enctype="multipart/form-data">
                                                            <div class="modal-body">
                                                                <div class="form-group">
                                                                    <div class="col-sm-12">
                                                                        <label for="newsletter_id">Select
                                                                            Newsletter</label>
                                                                        <select name="newsletter_id" id="newsletter_id"
                                                                                class="form-control">
                                                                            <option value="0" selected>Select Newsletter
                                                                                to Edit
                                                                            </option>
                                                                            <?php foreach ($newsletters as $key => $newsletter) : ?>
                                                                                <option value="<?= $newsletter->newsletter_id ?>" <?= isset($newsletter_loaded->newsletter_id) ? ($newsletter->newsletter_id == $newsletter_loaded->newsletter_id) ? 'selected' : '' : '' ?>><?= $newsletter->title ?></option>
                                                                            <?php endforeach; ?>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <div class="col-sm-12">
                                                                        <label for="newsletter_title">Title</label>
                                                                        <input type="text" name="newsletter_title"
                                                                               id="newsletter_title"
                                                                               placeholder="Enter a newsletter title"
                                                                               value="<?= isset($newsletter_loaded->title) ? $newsletter_loaded->title : '' ?>"
                                                                               class="form-control" required="required">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <div class="col-sm-12">
                                                                        <label for="load_newsletter">Newsletter
                                                                            Editor</label>
                                                                        <textarea class="form-control"
                                                                                  placeholder="Enter the newsletter content here"
                                                                                  id="newsletter_email_content"
                                                                                  name="newsletter_email_content"><?= isset($newsletter_loaded->contents) ? $newsletter_loaded->contents : '' ?></textarea>
                                                                    </div>
                                                                </div>
                                                                <input style="width: 187px;" type="file"
                                                                       name="newsletter_attachment"
                                                                       id="newsletter_attachment" accept="image/*"> <a
                                                                        download
                                                                        href="<?= isset($newsletter_loaded->attachment) ? $newsletter_loaded->attachment : '' ?>"><?= isset($newsletter_loaded->attachment) ? $newsletter_loaded->attachment : '' ?></a>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-danger"
                                                                        data-dismiss="modal">Close
                                                                </button>
                                                                <button type="submit" class="btn btn-blue"
                                                                        id="save_newsletter">Save Newsletter
                                                                </button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                    <div role="tabpanel" class="tab-pane" id="tb_send_newsletter">
                                                        <form action="<?= base_url() . ADMIN_PATH_NAME ?>/send_newsletter"
                                                              method="POST" class="form-horizontal" role="form"
                                                              enctype="multipart/form-data">
                                                            <div class="modal-body">
                                                                <div class="form-group">
                                                                    <div class="col-sm-12">
                                                                        <label for="newsletter_id">Select
                                                                            Newsletter</label>
                                                                        <select name="newsletter_id" id="newsletter_id"
                                                                                class="form-control">
                                                                            <option value="0" selected>Select Newsletter
                                                                                to Edit
                                                                            </option>
                                                                            <?php foreach ($newsletters as $key => $newsletter) : ?>
                                                                                <option value="<?= $newsletter->newsletter_id ?>" <?= isset($newsletter_loaded->newsletter_id) ? ($newsletter->newsletter_id == $newsletter_loaded->newsletter_id) ? 'selected' : '' : '' ?>><?= $newsletter->title ?></option>
                                                                            <?php endforeach; ?>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-danger"
                                                                        data-dismiss="modal">Close
                                                                </button>
                                                                <button type="submit" class="btn btn-info"
                                                                        id="send_newsletter">Send All
                                                                </button>
                                                            </div>

                                                        </form>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="add-mail-messagecontainer">
                                    <ul class=" pull-right" style="margin-top:30px;">
                                        <li class="pull-left">
                                            <button type="submit" data-toggle="modal" href="#newsletter_modal"
                                                    class="btn btn-blue pull-right">Create / Edit / Send
                                                Newsletter
                                            </button>
                                        </li>
                                    </ul>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading blue-panel-heading">
                            <h4 class="panel-title">
                                <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapse5">
                                    Users
                                </a>
                            </h4>
                        </div>
                        <div id="collapse5" class="panel-collapse collapse username_password_table">
                            <div class="panel-body">
                                <ul>
                                    <li>
                                        <div class="">
                                            <div class="tab-header-line"><h5>Candidates</h5></div>
                                            <div class="candidate_table_loader ">
                                                <img src="<?= base_url() ?>assets/portal/images/pre_loader.gif"> Please
                                                Wait...
                                            </div>
                                            <table id="candidates_table" class="display table table-striped table-hover table-bordered" cellspacing="0"
                                                   width="100%">
                                                <thead>
                                                    <tr>
                                                        <th data-name="user_profile_id">UserProfile ID</th>
                                                        <th data-name="name">Name</th>
                                                        <th data-name="email">Email</th>
                                                        <th data-name="country">Country</th>
                                                        <th data-name="registered_date">Registered Date</th>
                                                        <th data-name="action">Action</th>
                                                    </tr>
                                                </thead>
                                                
                                                <tbody>
                                                </tbody>
                                            </table>
                                        </div>
                                    </li>
                                    <br>
                                    <br>
                                    <li>
                                        <div class="">
                                            <div class="tab-header-line"><h5>Companies</h5></div>
                                            <table id="employer_table" class="display table table-striped table-hover table-bordered" cellspacing="0" width="100%">
                                                <thead>
                                                <tr>
                                                    <th>Company Name</th>
                                                    <th>Owner</th>
                                                    <th>Email</th>
                                                    <th class="hidden">UserProfile ID</th>
                                                    <th>Registered Date</th>
                                                    <th>Action</th>
                                                </tr>
                                                </thead>
                                                
                                                <tbody>
                                                <?php foreach ($companies_registered as $key => $company): ?>
                                                    <tr>
                                                        <td><?= $company->name ?></td>
                                                        <td><?= $company->owner ?></td>
                                                        <td><?= $company->login_email ?></td>
                                                        <td class="hidden"><?= $company->user_profile_id ?></td>
                                                        <td><?= $company->registered_date ?></td>
                                                        <td width="20%">
                                                            <button class="btn-yellow-new" onclick="confirmation('<?= base_url() . ADMIN_PATH_NAME ?>/login_to_account/<?= $company->user_profile_id ?>?type=employer','Are you sure to sign into the selected account?')">Login</button>
                                                            <!-- <span class="label label-info">View Profile</span> -->
                                                            <button class="btn btn-danger-new" onClick="delete_company(<?= $company->user_profile_id ?>,this)">Delete</button>
                                                            
                                                            
                                                            <div class="pull-right">
                                                                <div class="toggle-company account_status toggle-blue"
                                                                     data-toggle="tooltip"
                                                                     data-original-title="Active/Deactive"
                                                                     data-href="<?= base_url() . ADMIN_PATH_NAME ?>/update_profile_status?id=<?= $company->user_profile_id ?>&status=<?= $company->is_active ? 'true' : 'false' ?>"></div>
                                                                <input id="is_company_active" name="is_company_active"
                                                                       class="hidden" type="checkbox"
                                                                       value="<?= $company->is_active ? 'true' : 'false' ?>" <?= $company->is_active ? 'checked' : '' ?> />
                                                            </div>
                                                            <div class="pull-right">
                                                                <div class="toggle-featured is_featured toggle-green"
                                                                     data-toggle="tooltip"
                                                                     data-original-title="Featured"
                                                                     data-href="<?= base_url() . ADMIN_PATH_NAME ?>/make_company_featured?id=<?= $company->user_profile_id ?>&status=<?= $company->is_featured ? 'true' : 'false' ?>"></div>
                                                                <input id="is_featured" name="is_featured"
                                                                       class="hidden" type="checkbox"
                                                                       value="<?= $company->is_featured ? 'true' : 'false' ?>" <?= $company->is_featured ? 'checked' : '' ?>/>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </li>
                                    <br>
                                    <br>
                                    <li>
                                        <div class="">
                                            <div class="tab-header-line">
                                                <h5 class="pull-left" style="margin-top: 12px!important;">
                                                    Administrators</h5>
                                                <button type="submit" class="btn btn-blue pull-right"
                                                        data-toggle="modal" href='#add_new_administrator'>Add New
                                                </button>
                                                <div class="modal fade" id="add_new_administrator">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <button type="button" class="close" data-dismiss="modal"
                                                                        aria-hidden="true">&times;
                                                                </button>
                                                                <h4 class="modal-title">Add New Administrator</h4>
                                                            </div>
                                                            <form id="form_create_edit_administrator"
                                                                  action="<?= base_url() . ADMIN_PATH_NAME ?>/save_administrator"
                                                                  method="POST" class="form-horizontal" role="form">
                                                                <input type="hidden" name="admin_team_id"
                                                                       id="admin_team_id" value="0">
                                                                <input type="hidden" name="user_profile_id"
                                                                       id="user_profile_id" value="0">
                                                                <div class="modal-body">
                                                                    <input type="hidden" value="0"
                                                                           id="user_profile_id"/>
                                                                    <div class="form-group">
                                                                        <div class="col-sm-12">
                                                                            <label for="name">Name</label>
                                                                            <input type="text" name="name" id="name"
                                                                                   class="form-control" value=""
                                                                                   required="required"
                                                                                   placeholder="Enter Administrator's Name">
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <div class="col-sm-12">
                                                                            <label for="email">Email</label>
                                                                            <input type="email" name="email" id="email"
                                                                                   class="form-control" value=""
                                                                                   required="required"
                                                                                   placeholder="Enter Email">
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <div class="col-sm-12">
                                                                            <label for="password">Password</label>
                                                                            <input type="password" name="password"
                                                                                   id="password" class="form-control"
                                                                                   value="" required="required"
                                                                                   placeholder="Enter Password">
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <div class="col-sm-12">
                                                                            <label for="confirm_password">Confirm
                                                                                Password</label>
                                                                            <input type="password"
                                                                                   name="confirm_password"
                                                                                   id="confirm_password"
                                                                                   class="form-control" value=""
                                                                                   required="required"
                                                                                   placeholder="Re-Enter Password">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-danger"
                                                                            data-dismiss="modal">Close
                                                                    </button>
                                                                    <button type="submit" class="btn btn-blue"
                                                                            id="btn_save_administrator">Save
                                                                    </button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="clearfix"></div>
                                                <br>
                                            </div>
                                            <table id="admin_table" class="display table table-striped table-hover table-bordered" cellspacing="0" width="100%">
                                                <thead>
                                                <tr>
                                                    <th>Name</th>
                                                    <th>Email</th>
                                                    <!-- <th>Password</th> -->
                                                    <th class="hidden">User Profile ID</th>
                                                    <th class="hidden">Admin Team ID</th>
                                                    <th>Action</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <?php foreach ($administrators as $key => $admin): ?>
                                                    <tr>
                                                        <td><?= $admin->name ?></td>
                                                        <td><?= $admin->email ?></td>
                                                        <!-- <td><?= $admin->password ?></td> -->
                                                        <td class="hidden"><?= $admin->user_profile_id ?></td>
                                                        <td class="hidden"><?= $admin->admin_team_id ?></td>
                                                        <td><span class="label label-info edit-administrator"
                                                                  data-target="#add_new_administrator"
                                                                  data-toggle="modal">Edit</span>&nbsp;&nbsp;<span
                                                                    class="label label-red">Delete</span></td>
                                                    </tr>
                                                <?php endforeach; ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading blue-panel-heading">
                            <h4 class="panel-title">
                                <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapse6">
                                    Reports</a>
                            </h4>
                        </div>
                        <div id="collapse6" class="panel-collapse collapse">
                            <div class="panel-body">
                                <div class="portlet box mbl col-md-6 pull-left">
                                    <div class="portlet-header">
                                        <div class="caption">Companies Registered</div>
                                        <div class="tools"><i class="fa fa-chevron-up"></i>
                                            <!-- <i data-toggle="modal" data-target="#modal-config" class="fa fa-cog"></i><i class="fa fa-refresh"></i><i class="fa fa-times"></i> -->
                                        </div>
                                    </div>
                                    <div class="portlet-body">
                                        <div class="circle" id="circles-1"></div>
                                        <!-- <div id="placeholder" style="width: 100%; height:300px"></div> -->
                                    </div>
                                </div>
                                <div class="portlet box mbl col-md-6 pull-left">
                                    <div class="portlet-header">
                                        <div class="caption">Candidates Registered</div>
                                        <div class="tools"><i class="fa fa-chevron-up"></i>
                                            <!-- <i data-toggle="modal" data-target="#modal-config" class="fa fa-cog"></i><i class="fa fa-refresh"></i><i class="fa fa-times"></i> -->
                                        </div>
                                    </div>
                                    <div class="portlet-body">
                                        <div class="circle" id="circles-2"></div>
                                        <!-- <div id="placeholder" style="width: 100%; height:300px"></div> -->
                                    </div>
                                </div>
                                <div class="portlet box mbl col-md-6 pull-left">
                                    <div class="portlet-header">
                                        <div class="caption">Opened/Closed Jobs</div>
                                        <div class="tools"><i class="fa fa-chevron-up"></i>
                                            <!-- <i data-toggle="modal" data-target="#modal-config" class="fa fa-cog"></i><i class="fa fa-refresh"></i><i class="fa fa-times"></i> -->
                                        </div>
                                    </div>
                                    <div class="portlet-body">
                                        <div id="opened_closed_jobs" style="width: 100%; height:300px"></div>
                                    </div>
                                </div>
                                <div class="portlet box mbl col-md-6 pull-left">
                                    <div class="portlet-header">
                                        <div class="caption">Jobs Posted Country Wise</div>
                                        <div class="tools"><i class="fa fa-chevron-up"></i>
                                            <!-- <i data-toggle="modal" data-target="#modal-config" class="fa fa-cog"></i><i class="fa fa-refresh"></i><i class="fa fa-times"></i> -->
                                        </div>
                                    </div>
                                    <div class="portlet-body">
                                        <div id="jobs_country_wise"
                                             style="width: 100%; height:300px;position:relative"></div>
                                    </div>
                                </div>
                                <div class="portlet box mbl col-md-6 pull-left">
                                    <div class="portlet-header">
                                        <div class="caption">Candidates Country Wise</div>
                                        <div class="tools"><i class="fa fa-chevron-up"></i>
                                            <!-- <i data-toggle="modal" data-target="#modal-config" class="fa fa-cog"></i><i class="fa fa-refresh"></i><i class="fa fa-times"></i> -->
                                        </div>
                                    </div>
                                    <div class="portlet-body">
                                        <div id="candidates_country_wise"
                                             style="width: 100%; height:300px;position:relative"></div>
                                    </div>
                                </div>
                                <div class="portlet box mbl col-md-6 pull-left">
                                    <div class="portlet-header">
                                        <div class="caption">Candidates Industry Wise</div>
                                        <div class="tools"><i class="fa fa-chevron-up"></i>
                                            <!-- <i data-toggle="modal" data-target="#modal-config" class="fa fa-cog"></i><i class="fa fa-refresh"></i><i class="fa fa-times"></i> -->
                                        </div>
                                    </div>
                                    <div class="portlet-body">
                                         <select id="industryType" multiple>
                                         <option value="0">-select 3 Industries-</option> 
                                    <?php foreach ($candidate_industries as $key => $industry): ?>
                                    <option value=<?= $industry->industry_id?>><?= $industry->industry?></option>   

                                                <?php endforeach; ?>   
                                        </select> 
                                        
                                        <div id="candidates_industry_wise"
                                             style="width: 100%; height:300px;position:relative"></div>
                                             <button class="info-save btn btn-info" id="get_candidate_industry">Load</button>
                                    </div>
                                </div>
                                <div class="portlet box mbl col-md-6 pull-left">
                                    <div class="portlet-header">
                                        <div class="caption">Candidates Experience Wise</div>
                                        <div class="tools"><i class="fa fa-chevron-up"></i>
                                            <!-- <i data-toggle="modal" data-target="#modal-config" class="fa fa-cog"></i><i class="fa fa-refresh"></i><i class="fa fa-times"></i> -->
                                        </div>
                                    </div>
                                    <div class="portlet-body">
                                        <div id="candidates_experience_wise"
                                             style="width: 100%; height:300px;position:relative"></div>
                                    </div>
                                </div>
                                <div class="portlet box mbl col-md-6 pull-left">
                                    <div class="portlet-header">
                                        <div class="caption">Candidates Age Wise</div>
                                        <div class="tools"><i class="fa fa-chevron-up"></i>
                                            <!-- <i data-toggle="modal" data-target="#modal-config" class="fa fa-cog"></i><i class="fa fa-refresh"></i><i class="fa fa-times"></i> -->
                                        </div>
                                    </div>
                                    <div class="portlet-body">
                                        <div id="candidates_age_wise"
                                             style="width: 100%; height:300px;position:relative"></div>
                                    </div>
                                </div>
                                <div class="portlet box mbl col-md-6 pull-left">
                                    <div class="portlet-header">
                                        <div class="caption">Candidates Register</div>
                                        <div class="tools"><i class="fa fa-chevron-up"></i>
                                            <!-- <i data-toggle="modal" data-target="#modal-config" class="fa fa-cog"></i><i class="fa fa-refresh"></i><i class="fa fa-times"></i> -->
                                        </div>
                                    </div>
                                    <div class="portlet-body">
                                        <div id="candidates_register"
                                             style="width: 100%; height:300px;position:relative"></div>
                                    </div>
                                </div>

                                <div class="portlet box mbl col-md-6 pull-left">
                                    <div class="portlet-header">
                                        <div class="caption">Candidates Register Daily</div>
                                        <div class="tools"><i class="fa fa-chevron-up"></i>
                                            <!-- <i data-toggle="modal" data-target="#modal-config" class="fa fa-cog"></i><i class="fa fa-refresh"></i><i class="fa fa-times"></i> -->
                                        </div>
                                    </div>
                                    <div class="portlet-body">
                                        <div id="candidates_register_daily"
                                             style="width: 100%; height:300px;position:relative"></div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading blue-panel-heading">
                            <h4 class="panel-title">
                                <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapse9">
                                    Job Listings
                                </a>
                            </h4>
                        </div>
                        <div id="collapse9" class="panel-collapse collapse">
                            <div class="panel-body">
                                <h2>Job Listings</h2>
                                <div class="clearfix"></div>
                                <br>
                                <?php if(count($job_profiles)){ ?>
        							<table id="job_listings_table" class="display table table-striped table-hover table-bordered" cellspacing="0" width="100%">
        											<thead>
        											<tr>
                                                        <th>Job Ref</th>
        												<th>Candidates Applied</th>
        												<th>Position</th>
        												<th>Category</th>
                                                        <th>Close Date</th>
        											</tr>
        											</thead>
        											<tbody>
                                                    <?php foreach($job_profiles as $key => $profile) { ?>
        											<tr> 
                                                        <td><?=$profile->job_ref_no?></td>
        												<td><b><?=get_candidates_applied_count_by_job_profile_id($profile->job_profile_id)?></b> &nbsp;(<a href="<?=base_url()?>employer/job_profile/view_candidates/<?=$profile->job_profile_id?>/applied_candidates" target="_blank">View</a>)</td>
                                                        <td><?=$profile->position?></td>
        												<td><?=$profile->department?></td>
                                                        <td><?=$profile->close_date?></td>
        											</tr>
                                                    <?php } ?>
        											</tbody>
        							</table> 
                                        <?php }else{ ?>
                                            <div class="alert alert-info" role="alert">No Job Profiles Created <strong>!</strong></div>
                                        <?php } ?>
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading blue-panel-heading">
                            <h4 class="panel-title">
                                <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapse8">
                                    Advertisements
                                </a>
                            </h4>
                        </div>
                        <div id="collapse8" class="panel-collapse collapse">
                            <div class="panel-body">
                                <h2>Advertisement Space</h2>
                                <button type="submit" class="btn btn-blue pull-right"
                                        data-toggle="modal" href='#add_new_advertisement'>Add New
                                </button>
                                <div class="modal fade" id="add_new_advertisement">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal"
                                                        aria-hidden="true">&times;
                                                </button>
                                                <h4 class="modal-title">Add New Administrator</h4>
                                            </div>
                                            <form id="form_create_edit_advertisement"
                                                  action="<?= base_url() . ADMIN_PATH_NAME ?>/save_administrator"
                                                  method="POST" class="form-horizontal" role="form">
                                                <input type="hidden" name="admin_team_id"
                                                       id="admin_team_id" value="0">
                                                <input type="hidden" name="user_profile_id"
                                                       id="user_profile_id" value="0">
                                                <div class="modal-body">
                                                    <input type="hidden" value="0"
                                                           id="user_profile_id"/>
                                                    <div class="form-group">
                                                        <div class="col-sm-12">
                                                            <label for="name">Name</label>
                                                            <input type="text" name="name" id="name"
                                                                   class="form-control" value=""
                                                                   required="required"
                                                                   placeholder="Enter Administrator's Name">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="col-sm-12">
                                                            <label for="email">Email</label>
                                                            <input type="email" name="email" id="email"
                                                                   class="form-control" value=""
                                                                   required="required"
                                                                   placeholder="Enter Email">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="col-sm-12">
                                                            <label for="password">Password</label>
                                                            <input type="password" name="password"
                                                                   id="password" class="form-control"
                                                                   value="" required="required"
                                                                   placeholder="Enter Password">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="col-sm-12">
                                                            <label for="confirm_password">Confirm
                                                                Password</label>
                                                            <input type="password"
                                                                   name="confirm_password"
                                                                   id="confirm_password"
                                                                   class="form-control" value=""
                                                                   required="required"
                                                                   placeholder="Re-Enter Password">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-danger"
                                                            data-dismiss="modal">Close
                                                    </button>
                                                    <button type="submit" class="btn btn-blue"
                                                            id="btn_save_administrator">Save
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                                <br>
                                <table id="advertisement_table" class="display table table-striped table-hover table-bordered" cellspacing="0" width="100%">
                                    <thead>
                                    <tr>
                                        <th class="hidden">Advertisement ID</th>
                                        <th>Image</th>
                                        <th>From</th>
                                        <th>To</th>
                                        <th>Time</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach ($advertisements as $key => $advertisement): ?>
                                        <tr>
                                            <td class="hidden"><?= $advertisement->id ?></td>
                                            <td><?= $advertisement->image_name ?></td>
                                            <td><?= $advertisement->from_date ?></td>
                                            <td><?= $advertisement->to_date ?></td>
                                            <td><?= $advertisement->time ?></td>
                                            <td><span class="label label-info edit-administrator"
                                                      data-target="#add_new_administrator"
                                                      data-toggle="modal">Edit</span>&nbsp;&nbsp;<span
                                                        class="label label-red">Delete</span></td>
                                        </tr>
                                    <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--END CONTENT-->
<?php $this->load->view('partial/portal_footer.php'); ?>
<style type="text/css">
    .carousel-inner .active.left {
        left: -50%;
    }

    .carousel-inner .next {
        left: 50%;
    }

    .carousel-inner .prev {
        left: -50%;
    }

    .carousel-control.left, .carousel-control.right {
        background-image: none;
    }

    #myCarousel.carousel .item .portlet:nth-child(3) {
        display: none;
    }

    .glyphicon.glyphicon-chevron-right, .glyphicon.glyphicon-chevron-left {
        color: black;
    }

    .panel li {
        list-style-type: none !important;
    }

    .poll-options input {
        margin-bottom: 5px;
    }

    .poll-options .fa, #table_edit_view_polls .label, #collapse5 table span.label {
        cursor: pointer;
    }

    .modal-body .form-group label {
        font-weight: bold;
    }

    #table_edit_view_polls span a, #companies_pending_approval label a, #candidates_pending_activation label a {
        color: white !important;
    }

    .flot-tick-label.tickLabel {
        font-weight: bold !important;
        z-index: 1000
    }

    /* Newsltter */
    #newsletter_modal .nav-tabs {
        padding-left: 15px;
        padding-top: 15px;
    }

    #newsletter_modal .tab-content {
        margin-bottom: 0px;
        padding: 0px;
        background: none;
    }

    #tb_create_edit_newsletter #save_newsletter, #tb_send_newsletter #send_newsletter {
        display: none;
    }

    #tb_create_edit_newsletter.active #save_newsletter, #tb_send_newsletter.active #send_newsletter {
        display: initial;
    }

    .toggle-featured.is_featured {
        margin-right: 10px;
    }

    .circle {
        text-align: center;
    }

    #jobs_country_wise .highcharts-tooltip ~ text {
        display: none;
    }

    #candidates_country_wise .highcharts-tooltip ~ text {
        display: none;
    }

    #candidates_industry_wise .highcharts-tooltip ~ text {
        display: none;
    }

    #candidates_experience_wise .highcharts-tooltip ~ text {
        display: none;
    }

    #candidates_age_wise .highcharts-tooltip ~ text {
        display: none;
    }

    /*.carousel .item .portlet{margin-right:15px;}*/
</style>
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<script src="<?= base_url() ?>assets/portal/script/circles.min.js"></script>
<link rel="stylesheet" href="<?= base_url() ?>assets/portal/styles/toggles.css">
<link rel="stylesheet" href="<?= base_url() ?>assets/portal/styles/toggles-light.css">
<script src="<?= base_url() ?>assets/portal/script/toggles.js" type="text/javascript"></script>
<script type="text/javascript">
    var admin_path = '<?=base_url() . ADMIN_PATH_NAME?>';
    $(function () {
        // $("#poll_end_date").datepicker({
        //   changeMonth: true,
        //   changeYear: true,
        //   dateFormat: 'yy-mm-dd'
        // });
    });
</script>
<script type="text/javascript">

    $(document).ready(function () {
        $("#dialog").dialog({
            autoOpen: false,
            modal: true
            });

//         $('#view_service').on('show.bs.modal', function(e) {
// //("dfasfdasf");
// console.log("Cameeeeeeeeeee Modalll");

// });

// $('.open-service').click(function (event) {
//            var service_id = $(this).data('service_id');
//             console.log("Service Id :", service_id);

//             $('#tbl_service tr').each(function () {

//                 if( $(this).find('td').length > 0){

//                     var id = $(this).find('td:first').text();
//                     if(id == service_id)
//                         {
//                             $( this).children().css( "background-color", "red" );
//                         }
//                 }
                
//                 });

//             });


        $(document).on("click", ".open-service", function () {
         //  console.log("Cameeeeeeeeeee");

           var service_id = $(this).data('service_id');
            console.log("Service Id :", service_id);

            $('#tbl_service tr').each(function () {

                if( $(this).find('td').length > 0){

                    var id = $(this).find('td:first').text();
                    if(id == service_id)
                        {
                            $( this).children().addClass("label-free");
                        }
                }
                
                });

        });


        <?php if(isset($newsletter_loaded->newsletter_id)): ?>
        setTimeout(function () {
            $("#collapse4").addClass('in');
            $("#newsletter_modal").modal('show');
        }, 400);
        <?php endif ?>

        $('#myCarousel').carousel({
            interval: 5000
        });

        $(window).load(function () {
            $('#candidates_pending_activation, #table_edit_view_polls,#companies_pending_approval, #newsletter_subscribers,#employer_table,#team_table, #admin_table, #job_listings_table').DataTable();
            $('#information_requests').DataTable({
                "order": [[6, "desc"]]
            });

            
        });


        // $('#employer_table').DataTable( {
        //     "processing": true,
        //     "serverSide": true,
        //     "ajax": '<?=base_url() . ADMIN_PATH_NAME?>/'+'get_employers'
        // });

        set_toggles('.toggle-company');
        set_toggles('.toggle-featured');
        set_toggles('.poll-published');

        $('#candidates_table,#employer_table').on('search.dt', function () {
            if ($(this).attr('id') == 'candidates_table')
                set_toggles('.toggle-candidate');
            else {
                set_toggles('.toggle-company');
                set_toggles('.toggle-featured');
            }
        });

        $(document).on('click', '.paginate_button', function () {
            set_toggles('.toggle-candidate');
            set_toggles('.toggle-company');
        });

        $('#form_create_edit_administrator #confirm_password').keyup(function (event) {
            return validate_password();
        });

        $('#form_create_edit_administrator #btn_save_administrator').click(function (event) {
            return validate_password();
        });

        // $('.carousel .item').each(function(){
        //         //console.log($(this).find('.portlet').length);
        //         var next = $(this).next();
        //         if (!next.length) {
        //           next = $(this).siblings(':first');
        //         }
        //         next.children(':first-child').clone().appendTo($(this));

        //         if (next.next().length>0) {
        //           //next.next().children(':first-child').clone().appendTo($(this));
        //         }
        //         else {
        //           $(this).siblings(':first').children(':first-child').clone().appendTo($(this));
        //         }

        // });

        $('[rel="popover"]').popover({
            html: true,
            //content: function() {
            //return $('#popover_content_wrapper').html();
            //}
        });

        $('#tb_create_edit_newsletter #newsletter_id').change(function (event) {
            window.location = base_url + '<?=ADMIN_PATH_NAME?>?newsletter_selected_id=' + $(this).val()
        });


        $('.toggle-featured.is_featured,.toggle-candidate.account_status,.toggle-company.account_status').click(function (event) {
            if (confirm('Are you sure you want to update the status?')) {
                window.location = $(this).attr('data-href');
            } else {
                var is_active = false;
                if ($(this).attr('data-href').match('status=true'))
                    is_active = true;
                $(this).toggles({checkbox: $(this).next(), on: is_active, text: {on: 'YES', off: 'NO'}, drag: false});
                return false;
            }
        });


        $('.edit-administrator').click(function (event) {
            var row_obj = $(this).parents('tr:first');
            var admin_team_id = row_obj.find('td').eq(4).text();
            var user_profile_id = row_obj.find('td').eq(3).text();
            var name = row_obj.find('td').eq(0).text();
            var email = row_obj.find('td').eq(1).text();
            var password = row_obj.find('td').eq(2).text();

            modal_form_obj = $($(this).attr('data-target')).find('form');

            modal_form_obj.find('#admin_team_id').val(admin_team_id);
            modal_form_obj.find('#user_profile_id').val(user_profile_id);
            modal_form_obj.find('#name').val(name);
            modal_form_obj.find('#email').val(email);
            // modal_form_obj.find('#password').val(password);
            modal_form_obj.find('#password').attr('placeholder', 'Enter Password');
            // modal_form_obj.find('#confirm_password').val(password);
            modal_form_obj.find('#confirm_password').attr('placeholder', 'Enter Confirm Password');
            // modal_form_obj.find('#confirm_password').parents('.form-group:first').hide();
        });
        // append(' <input type="text" class="form-control" name="poll_option[]" id="poll_option" placeholder="Poll Option (eg: Artist, Actor, NBA Player etc.)"> <i class="fa fa-plus"></i>');
        $('form .poll-options .fa-plus').click(function () {
            if ($(this).parent().find('input').length < 5) {
                $(this).parent().find('input').last().clone().insertAfter($(this).parent().find('input').last());
                $(this).parent().find('input').last().val('');
            } else if ($(this).parent().find('.alert.alert-danger').length == 0) {
                $(this).parent().append('<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Max Limit Reached!</strong> Only 5 options can be added.</div>');
                $(this).remove();
            }
        });

        $('.edit_poll').click(function (event) {
            var modal = $('#modal_create_new_poll');
            modal.find('form')[0].reset();
            modal.modal('show');
            modal.find('.modal-title').text('Edit Poll');
            modal.find('#poll_id').val($(this).attr('data-id'));
            modal.find('#poll_name').val($(this).parents('tr:first').find('td').eq(1).text());
            modal.find('.poll-published').val($(this).parents('tr:first').find('td').eq(3).val());
            if ($(this).parents('tr:first').find('td').eq(3).find('.poll-published').next().is(':checked'))
                modal.find('.poll-published').next().attr('checked', 'checked');
            //else
            //
            modal.find('.poll-published').each(function () {
                $(this).toggles({
                    checkbox: $(this).next(),
                    on: $(this).next().is(':checked'),
                    text: {on: 'YES', off: 'NO'}
                });
            });
            //console.log($(this).parents('tr:first').find('td').eq(3).find('.poll-published').next().is(':checked'));
            // modal.find('#poll_end_date').val($(this).parents('tr:first').find('td').eq(3).text());
            //console.log($(this).parents('tr:first').find('td').eq(2).find('span'));
            $(this).parents('tr:first').find('td').eq(2).find('span').each(function (index, el) {

                modal.find('.poll-options input').last().clone().insertAfter(modal.find('.poll-options input').last());
                //console.log($(this).text());
                modal.find('.poll-options input').eq(index).val($(this).text());
                //alert(index);
            });
            if (modal.find('.poll-options input').last().text() == '')
                modal.find('.poll-options input').last().remove();
        });
        var is_reports_opened = false;
        $('[href="#collapse6"]').click(function () {
            if (is_reports_opened == false) {
                is_reports_opened = true;
                var colors = [
                        ['#BEE3F7', '#45AEEA'], ['#F4BCBF', '#D43A43']
                    ],
                    circles = [];
                var circle_speed = [200, 20];
                for (var i = 1; i <= 2; i++) {

                    if (i == 1)
                        percentage = <?=$active_companies_registered?>;
                    else if (i == 2)
                        percentage = <?=$active_candidates_registered?>;

                    var child = document.getElementById('circles-' + i),
                        circle = Circles.create({
                            id: child.id,
                            value: percentage,
                            maxValue: percentage,
                            // number:     250,
                            radius: 150,
                            width: 25,
                            duration: 0,
                            colors: colors[i - 1]
                        });
                    circles.push(circle);
                    // alert(circle_speed[i]);
                    counterNum($('#circles-' + i).find('.circles-integer').first(), 0, percentage, 1, circle_speed[i - 1]);
                }
                var candidate_industries = [];
                var industry_count;
                $("#get_candidate_industry").click(function(){
                    
                    var selectedIndustries = $('#industryType').val();

                    console.log("The paragraph was clicked. :",selectedIndustries[0]);
                    if(!(selectedIndustries[0] == "0")){

                    var filtered_industry_count = candidate_industries.reduce((acc,val) => {

                        if(selectedIndustries.indexOf(val.industry_id) > -1){                        
                            var count =  val.candidate_count == null ? 0 : parseInt(val.candidate_count);
                            acc.push([val.industry,count]);
                        }
                            return acc;
                    },[]);

                    console.log("sfdwef :",filtered_industry_count);

                    // var filtered_industry_count =  candidate_industries.map(industry => {
                    //     var val =  industry.candidate_count == null ? 0 : parseInt(industry.candidate_count);
                    //     return [industry.industry,val]
                    //  });
                    
                    var options = { 
                        chart: {
                            plotBackgroundColor: null,
                            plotBorderWidth: null,
                            plotShadow: false,
                            renderTo: 'candidates_industry_wise',
                        },
                        title: {
                            text: 'Candidates in a Specific Industry'
                        },
                        tooltip: {
                            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
                        },
                        plotOptions: {
                            pie: {
                                allowPointSelect: true,
                                cursor: 'pointer',
                                dataLabels: {
                                    enabled: true,
                                    color: '#000000',
                                    connectorColor: '#000000',
                                    formatter: function () {
                                        return '<b>' + this.point.name + '</b>: ' + this.percentage.toFixed(2) + ' %';
                                    }
                                }
                            }
                        },
                        series: [{
                            type: 'pie',
                            name: 'Industry share',
                            data: filtered_industry_count
                        }]
                     }; 

                     var chart = new Highcharts.Chart(options);

                    }
                
                });
                

                setTimeout(function () {
                    // PIE CHART 1 START
                    var data = [
                        {label: "Opened Positions", data: <?=count($opened_jobs)?>},
                        {label: "Closed Positions", data: <?=count($closed_jobs)?>}
                    ];
                    //placeholder.unbind();


                    $.plot('#opened_closed_jobs', data, {
                        series: {
                            pie: {
                                show: true,
                                radius: 1,
                                label: {
                                    show: true,
                                    radius: 3 / 4,
                                    formatter: function (label, series) {
                                        return '<div style="font-size:8pt;text-align:center;padding:2px;color:white;">' + label + '<br/>' + series.data[0][1] + '</div>';

                                    },
                                    background: {
                                        opacity: 0.5,
                                        color: "#000"
                                    }
                                }
                            }
                        },
                        grid: {
                            hoverable: true,
                        }
                    });

                    // Build the chart
                    var job_total = '<?=$job_count?>'.split(',');
                    var job_countries = '<?=$job_countries?>'.split(',');
                    var arr_data = [];
                    for (var i = 0; i < job_total.length; i++) {
                        var new_arr = [job_countries[i], parseInt(job_total[i])];
                        arr_data.push(new_arr);
                    }
                    ;
                    $('#jobs_country_wise').highcharts({
                        chart: {
                            plotBackgroundColor: null,
                            plotBorderWidth: null,
                            plotShadow: false
                        },
                        title: {
                            text: 'Jobs Posted in a Specific Country'
                        },
                        tooltip: {
                            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
                        },
                        plotOptions: {
                            pie: {
                                allowPointSelect: true,
                                cursor: 'pointer',
                                dataLabels: {
                                    enabled: true,
                                    color: '#000000',
                                    connectorColor: '#000000',
                                    formatter: function () {
                                        return '<b>' + this.point.name + '</b>: ' + this.percentage.toFixed(2) + ' %';
                                    }
                                }
                            }
                        },
                        series: [{
                            type: 'pie',
                            name: 'Country share',
                            data: arr_data
                        }]
                    });

                    // Build the chart
                    var candidate_total = '<?=$canditate_count?>'.split(',');
                    var candidate_countries = '<?=$canditate_countries?>'.split(',');
                    var arr_data1 = [];
                    for (var i = 0; i < candidate_total.length; i++) {
                        var new_arr1 = [candidate_countries[i], parseInt(candidate_total[i])];
                        arr_data1.push(new_arr1);
                    }
                    ;
                    $('#candidates_country_wise').highcharts({
                        chart: {
                            plotBackgroundColor: null,
                            plotBorderWidth: null,
                            plotShadow: false
                        },
                        title: {
                            text: 'Candidates in a Specific Country'
                        },
                        tooltip: {
                            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
                        },
                        plotOptions: {
                            pie: {
                                allowPointSelect: true,
                                cursor: 'pointer',
                                dataLabels: {
                                    enabled: true,
                                    color: '#000000',
                                    connectorColor: '#000000',
                                    formatter: function () {
                                        return '<b>' + this.point.name + '</b>: ' + this.percentage.toFixed(2) + ' %';
                                    }
                                }
                            }
                        },
                        series: [{
                            type: 'pie',
                            name: 'Country share',
                            data: arr_data1
                        }]
                    });

                    //Build Candidate Industry Chart
                      candidate_industries = <?php echo json_encode(isset($candidate_industries) ? $candidate_industries : array()); ?>;


                      industry_count =  candidate_industries.map(industry => {
                        var val =  industry.candidate_count == null ? 0 : parseInt(industry.candidate_count);
                        return [industry.industry,val]
                     });
                    
                    $('#candidates_industry_wise').highcharts({
                        chart: {
                            plotBackgroundColor: null,
                            plotBorderWidth: null,
                            plotShadow: false
                        },
                        title: {
                            text: 'Candidates in a Specific Industry'
                        },
                        tooltip: {
                            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
                        },
                        plotOptions: {
                            pie: {
                                allowPointSelect: true,
                                cursor: 'pointer',
                                dataLabels: {
                                    enabled: true,
                                    color: '#000000',
                                    connectorColor: '#000000',
                                    formatter: function () {
                                        return '<b>' + this.point.name + '</b>: ' + this.percentage.toFixed(2) + ' %';
                                    }
                                }
                            }
                        },
                        series: [{
                            type: 'pie',
                            name: 'Industry share',
                            data: industry_count
                        }]
                    });

                    // Build the chart
                    var experience_candidate_total = '<?=$experience_canditate_count?>'.split(',');
                    var candidate_experiences = '<?=$canditate_experiences?>'.split(',');

                    var arr_data3 = [];
                    for (var i = 0; i < experience_candidate_total.length; i++) {
                        var new_arr3 = [candidate_experiences[i], parseInt(experience_candidate_total[i])];
                        arr_data3.push(new_arr3);
                    }
                    ;

                    $('#candidates_experience_wise').highcharts({
                        chart: {
                            plotBackgroundColor: null,
                            plotBorderWidth: null,
                            plotShadow: false
                        },
                        title: {
                            text: 'Candidates in a Specific Experience'
                        },
                        tooltip: {
                            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
                        },
                        plotOptions: {
                            pie: {
                                allowPointSelect: true,
                                cursor: 'pointer',
                                dataLabels: {
                                    enabled: true,
                                    color: '#000000',
                                    connectorColor: '#000000',
                                    formatter: function () {
                                        return '<b>' + this.point.name + '</b>: ' + this.percentage.toFixed(2) + ' %';
                                    }
                                }
                            }
                        },
                        series: [{
                            type: 'pie',
                            name: 'Experience share',
                            data: arr_data3
                        }]
                    });


                    // Build the chart age wise
                    var age_candidate_total = '<?=$age_canditate_count?>'.split(',');
                    var candidate_age = '<?=$canditate_ages?>'.split(',');

                    var arr_data_age = [];
                    for (var i = 0; i < age_candidate_total.length; i++) {
                        var new_arr3 = [candidate_age[i], parseInt(age_candidate_total[i])];
                        arr_data_age.push(new_arr3);
                    };
                    $('#candidates_age_wise').highcharts({
                        chart: {
                            plotBackgroundColor: null,
                            plotBorderWidth: null,
                            plotShadow: false
                        },
                        title: {
                            text: 'Candidates percentage of age wise'
                        },
                        tooltip: {
                            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
                        },
                        plotOptions: {
                            pie: {
                                allowPointSelect: true,
                                cursor: 'pointer',
                                dataLabels: {
                                    enabled: true,
                                    color: '#000000',
                                    connectorColor: '#000000',
                                    formatter: function () {
                                        return '<b>' + this.point.name + '</b>: ' + this.percentage.toFixed(2) + ' %';
                                    }
                                }
                            }
                        },
                        series: [{
                            type: 'pie',
                            name: 'Percentage of candidates',
                            data: arr_data_age
                        }]
                    });
                    
                    var month_names = ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];
                    var registered_candidates_total = '<?=$registered_candidates?>'.split(',');
                    var previous_registered_candidates_total = '<?=$previous_registered_candidates?>'.split(',');
                    console.log("Current Year :",registered_candidates_total);
                    console.log("Previous Year :",previous_registered_candidates_total);

                    var merged_registered_candidates_total = previous_registered_candidates_total.concat(registered_candidates_total);
                    var arr_data_candidate_register = [];
                    for (var i = 0; i < registered_candidates_total.length; i++) {
                        arr_data_candidate_register.push(parseInt(registered_candidates_total[i]));
                    }

                    function calculateDiff(current,previous)
                    {
                        let val = previous == 0 ? 0 : ((current - previous) / previous) * 100;
                        return Math.abs(val).toFixed(2);                      
                    }
                    function format_label(month_name)
                    {
                        let index = month_names.indexOf(month_name);
                        let six_sum = merged_registered_candidates_total.slice(6 + index - 6 ,6 + index + 1).reduce((a,b) => parseInt(a) + parseInt(b),0);
                        let current_value = parseInt(merged_registered_candidates_total[6 + index]);
                        let previous_value = parseInt(merged_registered_candidates_total[6 + index - 1]);
                        let six_month_value = (six_sum/6).toFixed(2) ;
                        let six_month_diff = calculateDiff(current_value,six_month_value);
                        let one_month_diff = calculateDiff(current_value,previous_value);

                        let label = "";
                       
                        if(current_value < six_month_value)
                        {
                            label += "D "; 
                        }else{
                            label += "I ";
                        }

                        label += six_month_diff+"% "+month_name;
                        if(current_value < previous_value)
                        {
                            label += " D "; 
                        }else{
                            label += " I ";
                        }
                        label += one_month_diff+"%";
                        return label;
                    }
                    
                    $('#candidates_register').highcharts({
                        chart: {
                                type: 'column'
                            },
                            title: {
                                text: 'Monthly Registered Candidates'
                            },
                            // subtitle: {
                            //     text: 'Source: WorldClimate.com'
                            // },
                            xAxis: {
                                categories: month_names,
                                labels: {
                formatter: function() {
                    return '<span style="font-size:10px">'+format_label(this.value)+'</span>';
                },useHTML: true },
                                crosshair: true,
                            },
                            yAxis: {
                                min: 0,
                                title: {
                                text: 'Registered Candidates'
                                }
                            },
                            tooltip: {
                                headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                                pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                                '<td style="padding:0"><b>{point.y}</b></td></tr>',
                                footerFormat: '</table>',
                                shared: true,
                                useHTML: true
                            },
                            plotOptions: {
                                column: {
                                pointPadding: 0.2,
                                borderWidth: 0
                                }
                            },
                            series: [ {
                                name: 'No Of Candidates',
                                data: arr_data_candidate_register
                                // data: [48.9, 38.8, 39.3, 41.4, 47.0, 48.3, 59.0, 59.6, 52.4, 65.2, 59.3, 51.2]

                            }]
                    });


                    //Registered candidates for days

                    var registered_candidates_days_total = '<?=$registered_candidates_days?>'.split(',');
                    var arr_data_candidate_register_days = [];
                    var categories = [] ;
                    for (var i = 0; i < registered_candidates_days_total.length; i++) {
                        categories.push(i+1);
                        arr_data_candidate_register_days.push(parseInt(registered_candidates_days_total[i]));
                    }
                    // console.log("Registerd Candidates :", arr_data_candidate_register);
                    $('#candidates_register_daily').highcharts({
                        chart: {
                                type: 'column'
                            },
                            title: {
                                text: 'Daily Registered Candidates'
                            },
                            // subtitle: {
                            //     text: 'Source: WorldClimate.com'
                            // },
                            xAxis: {
                                categories: categories,
                                crosshair: true
                            },
                            yAxis: {
                                min: 0,
                                title: {
                                text: 'Registered Candidates'
                                }
                            },
                            tooltip: {
                                headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                                pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                                '<td style="padding:0"><b>{point.y}</b></td></tr>',
                                footerFormat: '</table>',
                                shared: true,
                                useHTML: true
                            },
                            plotOptions: {
                                column: {
                                pointPadding: 0.2,
                                borderWidth: 0
                                }
                            },
                            series: [ {
                                name: 'No Of Candidates',
                                data: arr_data_candidate_register_days
                                // data: [48.9, 38.8, 39.3, 41.4, 47.0, 48.3, 59.0, 59.6, 52.4, 65.2, 59.3, 51.2]

                            }]
                    });
                    
                    
                    // google.charts.load('current', {'packages': ['bar']});
                    // google.charts.setOnLoadCallback(drawChart);

                    // function drawChart() {
                    //     var data = google.visualization.arrayToDataTable([
                    //         ['Year', 'Sales', 'Expenses', 'Profit'],
                    //         ['2014', 1000, 400, 200],
                    //         ['2015', 1170, 460, 250],
                    //         ['2016', 660, 1120, 300],
                    //         ['2017', 1030, 540, 350]
                    //     ]);

                    //     var options = {
                    //         bars: 'vertical',
                    //         vAxis: {format: 'decimal'},
                    //         height: 300,
                    //         colors: ['#1b9e77', '#d95f02', '#7570b3']
                    //     };

                    //     var chart = new google.charts.Bar(document.getElementById('candidates_register'));

                    //     chart.draw(data, google.charts.Bar.convertOptions(options));
                    // }

                }, 500);
               
            }
        });

        $('[href="#collapse3"]').click(function () {
            setTimeout(function () {
                //START BAR CHART
                $('#myCarousel').find('.carousel-indicators li').each(function (index, el) {
                    var poll_options = $(this).attr('data-options-value').split(',');
                    var poll_vote_count = $(this).attr('data-count-value').split(',');
                    //console.log(poll_options);
                    var arr_data = [];

                    for (var i = 0; i < poll_options.length; i++) {
                        var new_arr = [poll_options[i], poll_vote_count[i]];
                        arr_data.push(new_arr);
                    }
                    ;

                    //console.log(arr_data);
                    var d3 = arr_data;
                    $.plot("#poll_chart" + (index + 1), [{
                        data: d3,
                        label: "Results",
                        color: "#01b6ad"
                    }], {
                        series: {
                            bars: {
                                align: "center",
                                lineWidth: 0,
                                show: !0,
                                barWidth: .5,
                                fill: .9
                            }
                        },
                        grid: {
                            borderColor: "#fafafa",
                            borderWidth: 1,
                            hoverable: !0
                        },
                        tooltip: !0,
                        tooltipOpts: {
                            content: "%x : %y",
                            defaultTheme: false
                        },
                        xaxis: {
                            tickColor: "#fafafa",
                            mode: "categories"
                        },
                        yaxis: {
                            tickColor: "#fafafa"
                        },
                        shadowSize: 0
                    });
                });
                //END BAR CHART

            }, 500);
        });

//         $('.open-service').click(function (event) {
//             var service_id = $(this).data('service_id');
//             console.log("Service Id :",service_id);

//             $('#tbl_service tr').each(function () {

//                 if( $(this).find('td').length > 0){

//                     var id = $(this).find('td:first').text();
//                     if(id == service_id)
//                         {
//                             $( this).children().css( "background-color", "red" );
//                         }
//                 }

//             }
// //             $('tr').each(function(){
// //     if( $(this).find('td').length==fullRowNumCells)
// //         textArray.push( $(this).find('td:first').text())  
     
// // });
//             // $('#tbl_service tr').each(function (i, row) {

//             // }

//             // $( "#secondrow" ).children().css( "background-color", "red" );


//         }
//         $(document).on("click", ".open-service", function () {
//            console.log("Cameeeeeeeeeee");
//         });

//         //triggered when modal is about to be shown
//             $('#view_service').on('show.bs.modal', function(e) {

//                 console.log("Cameeeeeeeeeee Modalll");
//             //get data-id attribute of the clicked element

//             //populate the textbox
//             });

    });

    $(document).ready(function () {

        $('#candidates_table').DataTable({
                "processing": true,
                "serverSide": true,
                "ajax": admin_path + "/get_candidates_dt",
                "columnDefs": [
                    {
                        "targets": [ 0 ],
                        "visible": false,
                        "searchable": false
                    },
                ],
                 "drawCallback": function( settings ) {
                    let table = $('#candidates_table');
                    let dt = $('#candidates_table').DataTable();
                    let is_active = 1;
                    let is_checked = 1;
                    table.find('tbody tr').each(function(index, el) {
                        let user_profile_id = dt.cells({ row: index, column: 0 }).data()[0];

                        $(this).find('td').last().append('<a style="margin-right:10px;" href="' + admin_path + '/login_to_account/' + user_profile_id + '?type=candidate" onclick="if(confirm(\'Are you sure to sign into the selected account?\')) return true; else return false;"><span class="label label-yellow">Login</span></a><a href="' + admin_path + '/delete_profile?id=' + user_profile_id + '" onclick="if(confirm(\'Are you sure to delete the account?\')) return true; else return false;"><span class="label label-red">Delete</span></a><div class="toggle-candidate account_status toggle-blue pull-right" data-toggle="tooltip" data-original-title="Active/Deactive" data-href="' + admin_path + '/update_profile_status?id=' + user_profile_id + '>&status=' + is_active + '"></div><input id="is_candidate_active" name="is_candidate_active" class="hidden" type="checkbox" value="' + is_active + '" ' + is_checked + '/>');
                    });
                    set_toggles('.toggle-candidate');
                    setTimeout(function(){
                        table.find('thead th').last().css('width', '160px!important');
                    },100);
                }
        });
        $('.candidate_table_loader').remove();
        // let page = 1;

        // $.ajax({
        //     url: '<?=base_url() . ADMIN_PATH_NAME?>/get_candidates_dt',
        //     type: 'GET',
        //     dataType: 'json',
        //     data: {page:page},
        //     success: function (result) {
        //         //result = JSON.parse(result);
        //         //console.log(result);
        //         //var parsed_result = JSON.parse(result);
        //         $(result).each(function (index, row) {
        //             var is_active = 'false';
        //             var is_checked = ''
        //             if (row.is_active == 1) {
        //                 is_active = 'true';
        //                 is_checked = 'checked'
        //             }
        //             //console.log(row.country );
        //             if (row.country == null)
        //                 row.country = '';
        //                 $('<tr><td>' + row.first_name + ' ' + row.last_name + '</td><td>' + row.login_email + '</td><td class="hidden">' + row.user_profile_id + '</td><td>' + row.country + '</td><td>' + row.registered_date + '</td><td width="14%"><a style="margin-right:10px;" href="' + admin_path + '/login_to_account/' + row.user_profile_id + '?type=candidate" onclick="if(confirm(\'Are you sure to sign into the selected account?\')) return true; else return false;"><span class="label label-yellow">Login</span></a><a href="' + admin_path + '/delete_profile?id=' + row.user_profile_id + '" onclick="if(confirm(\'Are you sure to delete the account?\')) return true; else return false;"><span class="label label-red">Delete</span></a><div class="toggle-candidate account_status toggle-blue pull-right" data-toggle="tooltip" data-original-title="Active/Deactive" data-href="' + admin_path + '/update_profile_status?id=' + row.user_profile_id + '>&status=' + is_active + '"></div><input id="is_candidate_active" name="is_candidate_active" class="hidden" type="checkbox" value="' + is_active + '" ' + is_checked + '/></td></tr>').appendTo('#candidates_table tbody');
        //         });
        //         $('#candidates_table').DataTable();
        //         set_toggles('.toggle-candidate');
        //         $('#candidates_table').removeClass('hidden');
        //         $('.candidate_table_loader').remove();
        //         $('#candidates_table').find('[data-toggle="tooltip"]').tooltip();
        //         //<input id="is_candidate_active" name="is_candidate_active" class="hidden" type="checkbox" value="'+$(this)[0].is_active ? true : false+'" '+(this)[0].is_active ? "checked" : ""+' />
        //         //
        //     },
        //     error: function (err) {
        //         console.log(err);
        //     },
        });

    // });

    function delete_contact_request(id,row)
        {
                $.ajax({
                url: '<?=base_url() . ADMIN_PATH_NAME?>/delete_info_request' + '?' + $.param({"id": id}),
                dataType: 'json',
                type: 'DELETE',
                success: function (res) {
                    
                    if(res == "Success")
                    {
                        var myTable = $('#information_requests').DataTable();
                        if (typeof(row) == "object") {
                           let tr = $(row).closest("tr").get(0);
                           myTable.row( tr ).remove().draw( false );
                           toastr.success("Request Deleted Successfully");
                        }
                    }
                    else{
                        toastr.warning("Could not delete the request. Please make sure a request has been selected")
                    }
                },
                error: function (err) {
                    toastr.error("Could not delete the request. Please try again later");
                },
            });
        }

        function delete_company(id,row)
        {
            // <a href="<?= base_url() . ADMIN_PATH_NAME ?>/delete_company?id=<?= $company->user_profile_id ?>"onclick="if(confirm(\'Are you sure to delete the account?\')) return true; else return false;"><span class="label label-red">Delete</span></a>


            $("#dialog").dialog({
            buttons : {
                "Yes" : function() {
                    $.ajax({
                        url: '<?=base_url() . ADMIN_PATH_NAME?>/delete_company' + '?' + $.param({"id": id}),
                        dataType: 'json',
                        type: 'DELETE',
                        success: function (res) {
                            
                            if(res == "Success")
                            {
                                var myTable = $('#information_requests').DataTable();
                                if (typeof(row) == "object") {
                                let tr = $(row).closest("tr").get(0);
                                myTable.row( tr ).remove().draw( false );
                                toastr.success("Company Deleted Successfully");
                                }
                            }
                            else{
                                toastr.warning("Could not delete the company. Please make sure a request has been selected")
                            }
                        },
                        error: function (err) {
                            toastr.error("Could not delete the company. Please try again later");
                        },
                        });
                },
                "No" : function() {
                $(this).dialog("close");
                }
            }
            });
            $("#dialog").html("Are you sure to delete the account");
            $("#dialog").dialog("open");
        }

</script>

<script type="text/javascript" src="//cdn.tinymce.com/4/tinymce.min.js"></script>
<script type="text/javascript">

    function set_toggles(className) {
        $(className).each(function () {
            $(this).toggles({
                checkbox: $(this).next(),
                on: $(this).next().is(':checked'),
                text: {on: 'YES', off: 'NO'},
                drag: false
            });
        });
    }

    function validate_password() {
        password = $('#form_create_edit_administrator #password');
        confirm_password = $('#form_create_edit_administrator #confirm_password')
        if (password.val() != confirm_password.val()) {
            confirm_password.css({border: '1px solid red'});
            return false;
        } else
            confirm_password.css({border: '1px solid #e5e5e5'});
        return true;
    }

    tinymce.init({
        selector: '#newsletter_email_content',
        height: 200,
        theme: 'modern',
        plugins: [
            'advlist autolink lists link image charmap print preview hr anchor pagebreak',
            'searchreplace wordcount visualblocks visualchars code fullscreen',
            'insertdatetime media nonbreaking save table contextmenu directionality',
            'emoticons template paste textcolor colorpicker textpattern imagetools'
        ],
        toolbar1: 'insertfile undo redo | styleselect | sizeselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | fontsizeselect | link image',
        toolbar2: 'print preview media | forecolor backcolor emoticons',
        fontsize_formats: "8px 9px 10px 11px 12px 13px 14px 15px 16px 17px 18px 24px 36px",
        image_advtab: true,
        statusbar: false,
    });

    
</script>