<?php $this->load->view('partial/portal_header.php'); ?>
<?php $this->load->view('partial/portal_sidebar.php'); ?>
<?php $this->load->view('partial/portal_breadcrumbs.php'); ?>
        <!--BEGIN CONTENT-->
        <div class="page-content">
            <div id="tab-general">
                <div id="sum_box" class="row mbl">
                    <div class="col-sm-6 col-md-3 block-space">
                        <a href="<?=base_url()?>candidate/application_status">
                        <div class="panel profit db mbm">
                            <div class="panel-body">
                                <p class="icon">
                                    <i class="icon fa fa-file-o"></i>
                                </p>
                                <h4 class="value">
                                    <span data-counter="" data-start="10" data-end="50" data-step="1" data-duration="0">
                                    </span><span><?=$jobs_applied?></span></h4>
                                    <p class="description">
                                        Application Status</p>
                                        <div class="progress progress-sm mbn">
                                            <div role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"
                                            style="width: 80%;" class="progress-bar progress-bar-success">
                                            <span class="sr-only">80% Complete (success)</span></div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                            </div>
                            <div class="col-sm-6 col-md-3 block-space">
                                <a href="<?=base_url()?>candidate/recommended_jobs">
                                <div class="panel income db mbm">
                                    <div class="panel-body">
                                        <p class="icon">
                                            <i class="icon fa fa-suitcase"></i>
                                        </p>
                                        <h4 class="value">
                                            <span><?=count($recommended_jobs)?></span></h4>
                                            <p class="description">
                                                Recommended Jobs</p>
                                                <div class="progress progress-sm mbn">
                                                    <div role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"
                                                    style="width: 60%;" class="progress-bar progress-bar-info">
                                                    <span class="sr-only">60% Complete (success)</span></div>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                    </div>
                                    <div class="col-sm-6 col-md-3 block-space">
                                    <a href="<?=base_url()?>candidate/visibility">
                                        <div class="panel task db mbm">
                                            <div class="panel-body">
                                                <p class="icon">
                                                    <i class="icon fa fa-eye"></i>
                                                </p>
                                                <h4 class="value">
                                                    <span><?=$cv_views?></span></h4>
                                                    <p class="description">
                                                        Visibility</p>
                                                        <div class="progress progress-sm mbn">
                                                            <div role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"
                                                            style="width: 50%;" class="progress-bar progress-bar-danger">
                                                            <span class="sr-only">50% Complete (success)</span></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                            </div>
                                            <div class="col-sm-6 col-md-3">
                                            <a href="<?=base_url()?>candidate/application_history">
                                                <div class="panel visit db mbm">
                                                    <div class="panel-body">
                                                        <p class="icon">
                                                            <i class="icon fa fa-history"></i>
                                                        </p>
                                                        <h4 class="value">
                                                            <span><?=$all_jobs_applied?></span></h4>
                                                            <p class="description">
                                                                My History</p>
                                                                <div class="progress progress-sm mbn">
                                                                   <div role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100"
                                                                    style="width: 70%;" class="progress-bar progress-bar-warning">
                                                                    <span class="sr-only">70% Complete (success)</span></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </a>
                                                </div>
                                                <div class="row mbl">
                                                    <div class="col-lg-9 block-space">
                                                        <div class="panel">
                                                            <div class="panel-body">
                                                                <div class="row">
                                                                 <div class="col-md-9 col-sm-9 left-padding right-padding">
                                                                    <div class="col-md-3 col-sm-3">
                                                                       <img class="img-responsive" src="<?=(!empty($profile->profile_pic_name)) ? base_url().'uploads/candidate_profiles/'.$profile->profile_pic_name : base_url().'assets/portal/images/avatar.png'?>">
                                                                   </div>
                                                                   <div class="col-md-5 col-sm-5">
                                                                        <h4><span id="cn_first_name"><?=isset($profile->first_name) ? $profile->first_name.'</span> <span id="cn_last_name">'.$profile->last_name : ''?></span></h4>
                                                                        <p><b>Position</b> <span id="cn_experience"><?=!empty($experiences) ? $experiences[count($experiences) - 1]->position : '-'?></span></p>
                                                                        <p><b>Nationality</b> <span id="cn_nationality"><?=isset($profile->nationality) ? $profile->nationality : '-'?></span></p>
                                                                        <p><b>Address</b> <?=!empty($address) ? '<span id="cn_building_no">'.$address->building_no.',</span> <span id="cn_building_name">'.$address->building_name.',</span> <span id="cn_street">'.$address->street.',</span>  <span id="cn_city">'.$address->city.',</span> <span id="cn_country">'.$address->country.'</span>' : '-'?></p>
                                                                        <!-- <p id="cn_mobile"><?=isset($contact->mobile) ? $contact->mobile : '-'?></p>
                                                                        <p id="cn_email"><?=isset($contact->email)? $contact->email :'-'?></p> -->
                                                                    </div>
                                                                </div>	
                                                                <div class="col-md-3 col-sm-3 pull-right">
                                                                    <div class="invite-links">
                                                                       <p><a href="#">Conenct to facebook</a></p>
                                                                       <p><a href="#">Invite Friends</a></p>										
                                                                       <p>Status <span class="label <?=isset($profile->is_active) ? $profile->is_active ? 'label-success' : 'label-danger' : ''?>"><?=isset($profile->is_active) ? $profile->is_active ? 'Active' : 'Deactive' : ''?></span></p>
                                                                   </div>
                                                                   <a data-toggle="modal" data-target="#cvVideoModal" href="#"><button class="btn btn-blue">Upload your Video CV</button></a>	
                                                               </div>
                                                           </div>
                                                       </div>
                                                   </div>
                                                   <div style="clear:both;"></div>
                                                   <div class="panel-inner">
                                                      <div class="col-md-6 col-sm-6 update-cv left-padding">
                                                         <div class="pal panel">
                                                            <h4>Your Profile</h4>
                                                            <span class="task-item">Weak<small class="pull-right text-muted"><?=$profile_score?>%</small><div class="progress progress-sm">
                                                             <div role="progressbar" aria-valuenow="<?=$profile_score?>" aria-valuemin="0" aria-valuemax="100" style="width: <?=$profile_score?>%;" class="progress-bar <?=get_class_by_score($profile_score)?>">
                                                                <span class="sr-only"><?=$profile_score?>% Complete (success)</span></div>
                                                            </div>
                                                        </span>
                                                        <a href="<?=base_url()?>candidate/profile"><button class="btn btn-blue">Update you Profile</button></a>
                                                    </div>
                                                </div>
                                                <div class="panel-body panel col-md-6 col-sm-6 update-cv">
                                                  <h4>Your Profile</h4>
                                                  <p><i class="fa fa-edit"></i> Edit profile</p>
                                                  <p><i class="fa fa-eye"></i> View profile</p>
                                                  <a href="<?=base_url()?>candidate/profile"><button type="submit" class="btn btn-blue">View Profile</button></a>
                                              </div>
                                          </div>
                                      </div>
                                      <?php $this->load->view('partial/portal_job_search.php'); ?>
                                      
                                </div>
                            </div>
                         </div>
                <!--END CONTENT-->
<?php $cv['cv_video_url']=$cv_video_url;$cv['candidate_profile_id']=$candidate_profile_id; $this->load->view('partial/candidate_cv_video.php',$cv); ?>
<?php $this->load->view('partial/portal_footer.php'); ?>