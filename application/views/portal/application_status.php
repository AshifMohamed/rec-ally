<?php $this->load->view('partial/portal_header.php'); ?>
<?php $this->load->view('partial/portal_sidebar.php'); ?>
<?php $this->load->view('partial/portal_breadcrumbs.php'); ?>
<!--BEGIN CONTENT-->
                <div class="page-content">
                    <div id="tab-general">
                        <div class="mbl row ">
                           <div class="col-lg-12">
                                <div class="panel panel-violet col-lg-9 left-padding right-padding" style="background:#FFF;">
									<div class="panel-heading">Application status</div>
									<div class="panel-body">
                                        <?php if(count($job_applications)){ ?>
                                        <table class="table table-hover table-bordered">
                                            <thead>
                                            <tr>
                                                <th>Job ref</th>
                                                <th>Company</th>
                                                <th>Position</th>
                                                <!-- <th>Location</th> -->
                                                <th>Applied On</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr> 
                                            </thead>
                                            <tbody>
                                            <?php foreach($job_applications as $key => $application) { ?>
                                            <tr>
                                                <td><?=$application->job_ref_no?></td>
                                                <td><?=$application->company_name?></td>
                                                <td><?=$application->position?></td>
                                                <!-- <td><?=$application->country?></td> -->
                                                <td><?=$application->date?></td>
                                                <td><?=get_filter_status($application->status)?></td>
                                                <td>
                                                    <a href="<?=base_url()?>posting/<?=$application->job_ref_no?>"  class="label label-info" target="_blank">View Posting</a>
                                                </td>
                                            </tr>
                                            <?php } ?>
                                            </tbody>
                                        </table>
                                        <?php }else{ ?>
                                            <div class="alert alert-info" role="alert">No jobs have been applied by you <strong>!</strong></div>
                                        <?php } ?>
                                    </div>
                                </div>
                                <?php $this->load->view('partial/portal_job_search.php'); ?>
                            </div>
                        </div>
                    </div>
                        </div>
                      </div>
                    </div>
                <!--END CONTENT-->
<?php $this->load->view('partial/portal_footer.php'); ?>