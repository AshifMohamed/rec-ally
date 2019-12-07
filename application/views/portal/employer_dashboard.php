<?php $this->load->view('partial/portal_header.php'); ?>
<?php $this->load->view('partial/portal_sidebar.php'); ?>
<?php $this->load->view('partial/portal_breadcrumbs.php'); ?>
<!--BEGIN CONTENT-->
                <div class="page-content">
                    <div id="tab-general">
                        <div id="sum_box" class="row mbl">
                            <div class="col-sm-6 col-md-3 block-space">
                                 <a href="<?=base_url()?>employer/positions/opened">
                                <div class="small-box profit db mbm">
                                    <div class="panel-body">
                                        <p class="icon">
                                            <i class="icon fa fa-suitcase"></i>
                                        </p>
                                        <h4 class="value">
                                            <span data-counter="" data-start="10" data-end="50" data-step="1" data-duration="0">
                                            </span><span><?=count($opened_jobs)?></span></h4>
                                        <p class="description">
                                            Positions Opened</p>
                                        <div class="progress progress-sm mbn">
                                            <div role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"
                                                style="width: 0%;" class="progress-bar progress-bar-success">
                                                <span class="sr-only">80% Complete (success)</span></div>
                                        </div>
                                    </div>
                                </div>
                                </a>
                            </div>
                            <div class="col-sm-6 col-md-3 block-space">
                             <a href="<?=base_url()?>employer/reports">
                                <div class="small-box income db mbm">
                                    <div class="panel-body">
                                        <p class="icon">
                                            <i class="icon fa fa-file"></i>
                                        </p>
                                        <h4 class="value">
                                            <span>5</span></h4>
                                        <p class="description">
                                            Reports</p>
                                        <div class="progress progress-sm mbn">
                                            <div role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"
                                                style="width: 0%;" class="progress-bar progress-bar-info">
                                                <span class="sr-only">60% Complete (success)</span></div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                            </div>
                            <div class="col-sm-6 col-md-3 block-space">
                             <a href="<?=base_url()?>employer/positions/closed">
                                <div class="small-box task db mbm">
                                    <div class="panel-body">
                                        <p class="icon">
                                            <i class="icon fa fa-eye"></i>
                                        </p>
                                        <h4 class="value">
                                            <span><?=count($closed_jobs)?></span></h4>
                                        <p class="description">
                                            Positions Closed</p>
                                        <div class="progress progress-sm mbn">
                                            <div role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"
                                                style="width: 0%;" class="progress-bar progress-bar-danger">
                                                <span class="sr-only">50% Complete (success)</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                            </div>
                            
                            <div class="col-sm-6 col-md-3">
                            <a href="<?=base_url()?>employer/profile">
                                <div class="small-box visit db mbm">
                                    <div class="panel-body">
                                        <p class="icon">
                                            <i class="icon fa fa-history"></i>
                                        </p>
                                        <h4 class="value">
                                            <span style="color: rgb(242, 191, 12);">-</span></h4>
                                        <p class="description">
                                            View Profile</p>
                                        <div class="progress progress-sm mbn">
                                           <div role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100"
                                                style="width: 0%;" class="progress-bar progress-bar-warning">
                                                <span class="sr-only">70% Complete (success)</span></div>
                                        </div>
                                    </div>
                                </div>
                             </a>
                            </div>
                        </div>
                        <div class="row mbl">
                            <div class="col-lg-9 block-space">
                                <div class="panel">
                                    <div class="panel-body">
											<div class="row">
											   <div class="col-md-9 col-sm-9 left-padding right-padding">
													<div class="col-md-3 col-sm-3">
													   <img class="img-responsive" src="<?=!empty($profile->company_logo)? base_url().'uploads/company_logos/'.$profile->company_logo: base_url().'assets/portal/images/clogo.jpg'?>">
													</div>
													<div class="col-md-6 col-sm-6">
														<h4 id="cn_company_name"><?=isset($profile->name)?$profile->name:'-'?></h4>
														<p><b>Name</b> <span  id="cn_owner"><?=isset($profile->owner)?$profile->owner:'-'?> </span> </p>
														<p><b>Address</b> <?=!empty($address) ? '<span id="cn_building_no">'.$address->building_no.',</span> <span id="cn_building_name">'.$address->building_name.',</span> <span id="cn_street">'.$address->street.',</span>  <span id="cn_city">'.$address->city.',</span> <span id="cn_country">'.$address->country.'</span>' : '-'?></p>
														<p><b>Website</b> <a target="_blank" href="<?=isset($contact->website)?prep_url($contact->website):'#';?>"><span id="cn_website"> <?=isset($contact->website) ? $contact->website :'-' ?></span></a></p>
													</div>
												</div>  
											</div>
                                    </div>
                                </div>
                                <div style="clear:both;"></div>
									<div class="panel-inner">
                                        <div class="col-md-6 col-sm-6 update-cv set-width left-padding">
                                            <div class="pal panel">
                                                <h4 class="box-heading">Start Your Recruitment</h4>
                                                <a href="<?=base_url()?>employer/job_profile/0"><button type="submit" class="btn btn-blue pull-right">Post Job</button></a>
                                                <a href="<?=base_url()?>employer/job_profile"><button type="submit" class="btn btn-blue pull-right">Close Jobs</button></a>
                                                <div class="clearfix"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-6 right-padding update-cv left-padding">
                                            <div class="pal panel">
                                                <h4 class="box-heading">Recruitment Process</h4>
                                                <a href="<?=base_url()?>employer/job_profile"><button type="submit" class="btn btn-blue">View Complete Process</button></a>
                                            </div>
                                        </div>
                                        <div style="clear:both;"></div>
                                    </div>
                                    <div style="clear:both;"></div>
                                    <div class="panel-inner">
                                        <div class="col-md-6 col-sm-6 update-cv left-padding">
                                            <div class="pal panel">
                                                <h4 class="box-heading">Dashboard Reports</h4>
                                                <ul class="list-group">
                                                    <a href="<?=base_url()?>employer/reports"><li class="list-group-item">Opened and Close Jobs</li></a>
                                                    <a href="<?=base_url()?>employer/reports"><li class="list-group-item">Company Website Visited - Count</li></a>
                                                    <a href="<?=base_url()?>employer/reports"><li class="list-group-item">Number of Job Likes</li></a>
                                                    <a href="<?=base_url()?>employer/reports"><li class="list-group-item">Jobs Appeared in Search - Count</li></a>
                                                    <a href="<?=base_url()?>employer/reports"><li class="list-group-item">When Posting Closes</li></a>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-6 update-cv right-padding left-padding">
                                            <div class="pal panel">
                                                <h4 class="box-heading">Your Profile</h4>
                                                <p><i class="fa fa-edit"></i> Edit Profile</p>
                                                <!-- <p><i class="fa fa-eye"></i> View profile</p> -->
                                                <a href="<?=base_url()?>employer/profile"><button type="submit" class="btn btn-blue">View Profile</button></a>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-6 update-cv right-padding left-padding">
                                            <div class="pal panel">
                                                <h4 class="box-heading">Your Service</h4>
                                                <!-- <p><i class="fa fa-edit"></i> Edit Profile</p> -->
                                                <!-- <p><i class="fa fa-eye"></i> View profile</p> -->
                                                <a href="<?=base_url()?>employer/service"><button type="submit" class="btn btn-blue">View Service</button></a>
                                            </div>
                                        </div>
                                    </div>
                                    <div style="clear:both;"></div>                                 
                            </div>
                            <?php $this->load->view('partial/portal_candidate_search'); ?>
                        </div>
                      </div>
                    </div>
                <!--END CONTENT-->
<?php $this->load->view('partial/portal_footer.php'); ?>