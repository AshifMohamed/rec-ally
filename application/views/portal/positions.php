<?php $this->load->view('partial/portal_header.php'); ?>
<?php $this->load->view('partial/portal_sidebar.php'); ?>
<?php $this->load->view('partial/portal_breadcrumbs.php'); ?>
<!--BEGIN CONTENT-->
                <div class="page-content">
                    <div id="tab-general">
                        <div class="mbl row ">
                           <div class="col-lg-12">
                                <div class="panel panel-blue col-lg-9 left-padding right-padding" style="background:#FFF;">
                                    <div class="panel-heading">Positions</div>
                                    <div class="panel-body">
                                        <?php if(count($positions)) : ?>
                                        <table class="table table-hover table-bordered">
                                            <thead>
                                            <tr>
                                                <th>Job Ref</th>
                                                <th>Location</th>
                                                <th>Posted Date</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php foreach ($positions as $key => $position){?>
                                            <tr>
                                                <td><?=$position->job_ref_no?></td>
                                                <td><?=$position->country?></td>
                                                <td><?=$position->posted_date?></td>
                                            </tr>
                                            <?php } ?>
                                            </tbody>
                                        </table>
                                    <?php else:  ?>
                                        <div class="alert alert-info">No Positions available to be listed</div>
                                    <?php endif; ?>
                                    </div>
                                </div>
                                <?php $this->load->view('partial/portal_candidate_search.php'); ?>
                            </div>
                        </div>
                    </div>
                        </div>
                      </div>
                    </div>
                <!--END CONTENT-->
<?php $this->load->view('partial/portal_footer.php'); ?>