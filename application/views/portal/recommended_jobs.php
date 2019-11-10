<?php $this->load->view('partial/portal_header.php'); ?>
<?php $this->load->view('partial/portal_sidebar.php'); ?>
<?php $this->load->view('partial/portal_breadcrumbs.php'); ?>
<!--BEGIN CONTENT-->
                <div class="page-content">
                    <div id="tab-general">
                        <div class="mbl row ">
                            <div class="col-lg-9">
                                <div class="panel panel-blue left-padding right-padding" style="background:#FFF;">
                                    <div class="panel-heading">Recommended Jobs</div>
                                    <!-- <p class="col-md-12 col-sm-12">view and apply for jobs that match your profile</p> -->
                                    <div class="panel-body">
                                        <?php if(count($recommended_jobs) >0): ?>
                                            <table class="table table-hover table-bordered">
                                            <thead> 
                                            <tr>
                                                <th>Job Ref</th>
                                                <th>Position</th>
                                                <th>Career Level</th>
                                                <th>Category</th>
                                                <th>Location</th>
                                                <th>Close Date</th>
                                                <th>Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php foreach($recommended_jobs as $key => $profile) { ?>
                                            <tr>
                                                <td class="hidden"><input type="hidden" class="job_profile_id" value="<?=$profile->job_profile_id?>"/></td>
                                                <td><?=$profile->job_ref_no?></td>
                                                <td><?=$profile->position?></td>
                                                <td><?=$profile->career_level?></td>
                                                <td><?=$profile->department?></td>
                                                <td><?=$profile->country?></td>
                                                <td><?=$profile->close_date?></td>
                                                <td>
                                                    <a href="<?=base_url()?>posting/<?=$profile->job_ref_no?>"  class="label label-info" target="_blank">View Posting</a>
                                                </td>
                                            </tr>
                                            <?php } ?>
                                            </tbody>
                                        </table> 
                                        <?php else: ?>
                                            <div class="alert alert-info"> No job recommendation for the moment!</div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                           <?php $this->load->view('partial/portal_job_search.php'); ?>
                        </div>
                      </div>
                    </div>
                 </div>
                </div>
                <!--END CONTENT-->
<?php $this->load->view('partial/portal_footer.php'); ?>