<?php $this->load->view('partial/portal_header.php'); ?>
<?php $this->load->view('partial/portal_sidebar.php'); ?>
<?php $this->load->view('partial/portal_breadcrumbs.php'); ?>
<!--BEGIN CONTENT-->
                <div class="page-content">
                    <div id="tab-general">
                            <div class="mbl row ">
                                <div class="col-lg-12">
                                    <div class="panel panel-blue col-lg-9 left-padding right-padding" style="background:#FFF;">
                                        <div class="panel-heading">History</div>
                                        <div class="panel-body">
                                            <?php if(count($application_histories)): ?>
                                                <table class="table table-hover table-bordered">
                                                    <thead>
                                                    <tr>
                                                        <th>Job Ref</th>
                                                        <th>Company</th>
                                                        <th>Location</th>
                                                        <th>Status</th>
                                                        <th>Screening</th>
                                                        <th>Qualification</th>
                                                        <th>Questions</th>
                                                        <th>Interview Call</th>
                                                        <th>Structure Interview</th>
                                                        <th>Selection</th>

                                                        <!-- <th>Updated On</th> -->
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <?php foreach ($application_histories as $key => $application){?>
                                                    <tr>
                                                        <td><?=$application->job_ref_no?></td>
                                                        <td><?=$application->company_name?></td>
                                                        <td><?=$application->country?></td>
                                                        <td><?=get_filter_status($application->status)?></td>
                                                        <td><?= isset($application->screen_types) ?
                                                        get_point_by_test_type($application->screen_types,$application->qual_screen_point,'screening') : '-'?></td>
                                                        <td><?= isset($application->screen_types) ? get_point_by_test_type($application->screen_types,$application->qual_screen_point,'qualification') : '-'?></td>
                                                        <td><?=isset($application->test_types) ? get_point_by_test_type($application->test_types,$application->test_selc_point,'test') : '-'?></td>
                                                        <td><?='-'?></td>
                                                        <td><?='-'?></td>
                                                        <td><?=isset($application->test_types) ? get_point_by_test_type($application->test_types,$application->test_selc_point,'selection') : '-'?></td>
                                                        <!-- <td><?=$application->status_date?></td> -->
                                                    </tr>
                                                    <?php } ?>
                                                    </tbody>
                                                </table>
                                            <?php else: ?>
                                                <div class="alert alert-info" role="alert">No job history available for you yet<strong>!</strong></div>
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