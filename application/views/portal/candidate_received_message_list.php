<?php $this->load->view('partial/portal_header.php'); ?>
<?php $this->load->view('partial/portal_sidebar.php'); ?>
<?php $this->load->view('partial/portal_breadcrumbs.php'); ?>

<!--BEGIN CONTENT-->
    <div class="page-content">
        <div id="tab-general">
            <div class="mbl row ">
                <div class="col-lg-12">
                        <div class="panel panel-blue left-padding right-padding" style="background:#FFF;">
                            <div class="panel-heading">
                                Received Messages
                            </div>
                            <div class="panel-body">
                                <?php if(count($received_messages) > 0): ?>
                                    <table class="table table-hover table-bordered">
                                    <thead>
                                    <tr>
                                            <th>#</th>
                                            <th>Subject</th>
                                            <th>Date and Time</th>
                                            <th>Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody> 
                                        <?php foreach ($received_messages as $key => $messages) : ?>
                                        
                                        <div class="modal fade" id="modal_individual_process_results<?=$key?>">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                        <h4 class="modal-title"><?=$messages['subject']?></h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p><b>Candidate Email : </b><span class="cn_email"><?=isset($messages['receiver_email'])? $messages['receiver_email'] :'-'?></span></p>
                                                        <p><b>Sent On : </b><?=$messages['sent_on']?></p>
                                                        <p><b>Message : </b><?=$messages['message']?></p>
                                                    </div>
                                                    <div class="modal-footer">
                                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                       <div class="modal fade" id="modal_reply_to_message<?=$key?>">
                                            <div class="modal-dialog"> 
                                                <div class="modal-content">
                                                <div class="modal-header">
                                                    <button
                                                    type="button"
                                                    class="close"
                                                    data-dismiss="modal"
                                                    aria-hidden="true"
                                                    >
                                                    &times;
                                                    </button>
                                                    <h4 class="modal-title"><?=$messages['subject']?></h4>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row">
                                                    <div class="col-md-12 col-sm-12">
                                                        <form
                                                        action="<?=base_url()?>candidate/reply_to_message"
                                                        method="POST"
                                                        role="form"
                                                        >
                                                        <div class="col-md-8 col-sm-8 left-padding section-content">
                                                            <input
                                                            type="hidden"
                                                            name="candidate_message_id"
                                                            id="candidate_message_id"
                                                            value="<?=$messages['candidate_message_id']?>"
                                                            />

                                                            <h4>Message</h4>
                                                            <textarea
                                                            class="col-md-12 col-sm-12"
                                                            rows="10"
                                                            required="required"
                                                            name="message"
                                                            id="message"
                                                            ></textarea>

                                                            <div class="form-actions">
                                                            <button type="submit" class="btn btn-primary">
                                                                Send Reply
                                                            </button>
                                                            </div>
                                                        </div>
                                                        </form>
                                                    </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">
                                                    Close
                                                    </button>
                                                </div>
                                                </div>
                                            </div>
                                            </div> 

                                        <tr>
                                            <td><?=$key+1?></td>
                                            <td><?=$messages['subject']?></td>
                                            <td><?=$messages['sent_on']?></td> 
                                            <td><a data-toggle="modal" href="#modal_individual_process_results<?=$key?>"><span class="label label-sm label-info">View Message</span></a>
                                            <a data-toggle="modal" href="#modal_reply_to_message<?=$key?>"><span class="label label-sm label-info">Send Reply</span></a>
                                            </td>
                                        </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                        </table>
                                <?php else: ?>
                                        <div class="alert alert-info" role="alert"> No Messages found to be displayed.</div>
                                <?php endif; ?>
                                </div>


                        </div>
                    </div>
            </div>
        </div>
    </div>
  </div>
</div>
 <!--END CONTENT-->
<style>
.page-content .col-lg-3:last-child {
    visibility: hidden;
}

.individual_process_results .panel-title
{
	font-size: 14px!important;
}

.individual_process_results ul.result_details {
    margin-bottom: 0;
    margin-top: 0;
    padding-left: 21px !important;
}
.individual_process_results .panel-body {
    padding:15px 20px 0;
}

.individual_process_results ul.result_details > li {
    list-style-type: lower-alpha !important;
    padding-bottom: 10px !important;
}
.individual_process_results ul.result_details ~ a {
    font-size: 13px!important;
}

.individual_process_results.test_selection ul.result_details > li {
	list-style-type: decimal!important;
	padding-bottom: 10px !important;
}

.individual_process_results.test_selection ul.result_details > li > ul
{
	margin-top: 5px;
}
</style>
<?php $this->load->view('partial/portal_footer.php'); ?>
