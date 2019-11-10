<?php $this->load->view('partial/portal_header.php'); ?>
<?php $this->load->view('partial/portal_sidebar.php'); ?>
<?php $this->load->view('partial/portal_breadcrumbs.php'); ?>
<!--BEGIN CONTENT-->
                <div class="page-content">
                    <div id="tab-general">
                            <div class="mbl row ">
                                <div class="col-lg-12">
                                    <div class="panel panel-blue col-lg-9 left-padding right-padding" style="background:#FFF;">
                                        <div class="panel-heading">Saved Jobs</div>
                                        <br>
                                        <!-- <p class="col-md-12 col-sm-12">view the jobs that you have saved</p> -->
                                        <div class="panel-body">
                                             <?php if(count($saved_jobs)) : ?>
                                            <table class="table table-hover table-bordered">
                                                <thead>
                                                <tr>
                                                        <th>Job Ref</th>
                                                        <th>Position</th>
                                                        <th>Company Name</th>
                                                        <th>Date</th>
                                                        <th>View posting</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <?php foreach ($saved_jobs as $key => $job): ?>                                         
                                                 <tr>
                                                   <td><?=$job->job_ref_no?></td>
                                                   <td><?=$job->position?></td>
                                                   <td><?=$job->company_name?></td>
                                                   <td><?=$job->saved_date?></td>
                                                   <td><a target="_blank" href="<?=base_url()?>/posting/<?=$job->job_ref_no?>"><span class="label label-sm label-info">view</span></a></td>
                                                </tr>
                                                 <?php endforeach; ?>   
                                                </tbody>
                                            </table>
                                        <?php else: ?>
                                                 <div class="alert alert-info">No jobs saved yet</div>
                                        <?php endif; ?>
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