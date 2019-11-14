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
                                Sent Messages
                            </div>
                            <div class="panel-body">
                                <?php if(count($sent_messages) > 0): ?>
                                    <table class="table table-hover table-bordered">
                                    <thead>
                                    <tr>
                                            <th>#</th>
                                            <th>Date and Time</th>
                                            <th>Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody> 
                                        <?php foreach ($sent_messages as $key => $messages) : ?>
                                        
                                        <div class="modal fade" id="modal_individual_process_results<?=$key?>">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p><b>Message : </b><?=$messages['message']?></p>
                                                    </div>
                                                    <div class="modal-footer">
                                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <tr>
                                            <td><?=$key+1?></td>
                                            <td><?=$messages['sent_on']?></td> 
                                            <td><a data-toggle="modal" href="#modal_individual_process_results<?=$key?>"><span class="label label-sm label-info">View Message</span></a>
                                            </td>
                                        </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                        </table>
                                <?php else: ?>
                                        <div class="alert alert-info" role="alert"> No Sent Messages found to be displayed.</div>
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
