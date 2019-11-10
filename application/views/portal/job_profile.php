<?php $this->load->view('partial/portal_header.php'); ?>
<?php $this->load->view('partial/portal_sidebar.php'); ?>
<?php $this->load->view('partial/portal_breadcrumbs.php'); ?>
<!--BEGIN CONTENT-->
<div class="page-content">
    <div id="tab-general">
        <div class="row mbl">
            <div class="col-lg-12 block-space">
                <!-- divider -->
                <div class="panel">
                    <div class="panel-body">
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#job_tab">Job profile</a></li>
                            <li><a href="#upload_attachments">Upload Attachments</a></li>
                            <li><a href="#question_tab">Question Profile</a></li>
                            <li><a href="#interview_call_tab">Interview Call Profile</a></li>
                            <li><a href="#structured_interview_tab">Structured Interview Profile</a></li>
                        </ul>
                        <div class="tab-content">
                            <div id="job_tab" class="tab-pane fade in active clearfix">
                             <div id="nestable" class="dd">
                                <form method="POST" id="job_profile_form" action="/employer/save_job_profile" />
                                <input type="hidden" id="job_profile_id" name="job_profile_id" value="<?=isset($profile->job_profile_id) ? $profile->job_profile_id : 0 ?>" />
                                <input type="hidden" id="company_profile_id" name="company_profile_id" value="<?=isset($company_profile_id) ? $company_profile_id : 0 ?>" />
                                <ol class="dd-list">
                                    <li data-id="1" class="dd-item">
                                        <div class="dd-handle"><h4>What does this do?</h4>
                                            <p>The following are icons as to what each represents in this page</p>
                                            <img src="<?=base_url()?>assets/portal/images/label1.png"/> <span>Job Posting</span> &nbsp; &nbsp;
                                            <img src="<?=base_url()?>assets/portal/images/label2.png"/> <span>Screening</span> &nbsp; &nbsp;
                                            <img src="<?=base_url()?>assets/portal/images/label3.png"/> <span>Qualification</span>                                           
                                        </div>  
                                    </li>
                                    <li data-id="1" class="dd-item">
                                        <div class="dd-handle"><h4>Code and Position</h4>
                                        </div>
                                        <div class="code-pos">
                                            <div class="form-group">
                                                <label for="inputSubject" class="control-label">
                                                    Company Code</label>
                                                    <div class="input-icon right">
                                                        <input id="company_code" disabled type="text" placeholder="" class="form-control" value="<?=isset($company_profile->company_ref_no) ? $company_profile->company_ref_no : ''?>">
                                                    </div>
                                                </div>
                                                <div style="clear:both;"></div>
                                                <div class="form-group">
                                                    <label for="inputSubject" class="control-label">
                                                        Vacancy Code</label>
                                                        <div class="input-icon right">
                                                            <input id="vacancy_code" disabled type="text" placeholder="" class="form-control" value="<?=isset($profile->job_ref_no) ? $profile->job_ref_no : ''?>">
                                                        </div>
                                                        <div style="clear:both;"></div>
                                                    </div>
                                                    <div style="clear:both;"></div>
                                                    <div class="form-group">
                                                        <label for="inputSubject" class="control-label">
                                                            Position</label>
                                                            <div class="input-icon right">
                                                                <input id="position" name="position" type="text" placeholder="" class="form-control" value="<?=isset($profile->position)?$profile->position:''?>">
                                                            </div>
                                                        </div>
                                                        <div style="clear:both;"></div>
                                                        <div class="form-group">
                                                            <label for="close_date" class="control-label">
                                                                Close Date</label>
                                                                <div class="input-icon right">
                                                                    <input id="close_date" name="close_date" type="text" placeholder="Position Close Date" class="form-control" value="<?=isset($profile->close_date)?$profile->close_date:''?>">
                                                                </div>
                                                            </div>
                                                            <div style="clear:both;"></div>   
                                                        </li>
                                                        <li data-id="1" class="dd-item">
                                                            <div class="dd-handle"><h4>Company industry</h4></div>
                                                            <div class="code-pos">
                                                                <div class="form-group">
                                                                    <div id="industry" name="industry" class="selectivity-input example-input"></div>
                                                                </div>
                                                                <div style="clear:both;"></div>
                                                                <div class="pull-right">
                                                                    <div class="pull-left toggle-space" data-toggle="tooltip" title="Job Posting">  
                                                                        <div class="toggle toggle-green pull-right"> </div> 
                                                                        <input type="checkbox" value="industry" name="is_displayed_in_posting[]" class="checkme pull-right hidden">
                                                                        <div style="clear:both;"></div>
                                                                    </div>  
                                                                    <div class="pull-left toggle-space" data-toggle="tooltip" title="Screening">        
                                                                        <div class="toggle-screening toggle-blue pull-right"> </div>    
                                                                        <input type="checkbox" value="industry" name="is_shown_in_screening[]" class="checkme pull-right hidden">
                                                                        <div style="clear:both;"></div>
                                                                    </div>  
                                                                </div>  

                                                                <div style="clear:both;"></div>
                                                            </div>
                                                        </li>
                                                        <li data-id="1" class="dd-item">
                                                            <div class="dd-handle"><h4>Job families and History</h4></div>
                                                            <div class="code-pos">
                                                                <div class="form-group">
                                                                    <div id="job_history_category" name="job_history_category" class="selectivity-input example-input"></div>   
                                                                </div>
                                                                <div style="clear:both;"></div>                                                       
                                                                <div class="pull-right">
                                                                    <div class="pull-left toggle-space" data-toggle="tooltip" title="Job Posting">  
                                                                        <div class="toggle toggle-green pull-right"> </div> 
                                                                        <input type="checkbox" value="job_history_category" name="is_displayed_in_posting[]" class="checkme pull-right hidden">
                                                                        <div style="clear:both;"></div>
                                                                    </div>  
                                                                    <div class="pull-left toggle-space" data-toggle="tooltip" title="Qualification">    
                                                                        <div class="toggle-qualification toggle-orange pull-right"> </div>  
                                                                        <input type="checkbox" value="job_history_category" name="is_shown_in_qualification[]" class="checkme pull-right hidden">
                                                                        <div style="clear:both;"></div>
                                                                    </div>  
                                                                </div>  
                                                                <div style="clear:both;"></div>
                                                            </div>
                                                        </li>
                                                        <li data-id="1" class="dd-item">
                                                            <div class="dd-handle"><h4>Open to Nationality</h4></div>
                                                            <div class="code-pos">
                                                                <div class="form-group">
                                                                    <div id="nationality" name="nationality" class="selectivity-input example-input"></div>
                                                                    <div style="clear:both;"></div>
                                                                    Select all <input type="checkbox" name="select_all_options" class="select_all_options" >
                                                                </div>
                                                                <div style="clear:both;"></div>
                                                                <div class="pull-right">
                                                                    <div class="pull-left toggle-space" data-toggle="tooltip" title="Job Posting">  
                                                                        <div class="toggle toggle-green pull-right"> </div> 
                                                                        <input type="checkbox" value="nationality" name="is_displayed_in_posting[]" class="checkme pull-right hidden">
                                                                        <div style="clear:both;"></div>
                                                                    </div>  
                                                                    <div class="pull-left toggle-space" data-toggle="tooltip" title="Screening">        
                                                                        <div class="toggle-screening toggle-blue pull-right"> </div>    
                                                                        <input type="checkbox" value="nationality" name="is_shown_in_screening[]" class="checkme pull-right hidden">
                                                                        <div style="clear:both;"></div>
                                                                    </div>  
                                                                </div>  
                                                                <div style="clear:both;"></div>
                                                            </div>
                                                        </li>
                                                        <li data-id="1" class="dd-item">
                                                            <div class="dd-handle"><h4>Gender</h4></div>
                                                            <div class="code-pos">
                                                                <div class="form-group">
                                                                    <div id="gender" name="gender" class="selectivity-input example-input"></div>
                                                                </div>
                                                                <div style="clear:both;"></div>
                                                                <div class="pull-right">
                                                                    <div class="pull-left toggle-space" data-toggle="tooltip" title="Job Posting">  
                                                                        <div class="toggle toggle-green pull-right"> </div> 
                                                                        <input type="checkbox" value="gender" name="is_displayed_in_posting[]" class="checkme pull-right hidden">
                                                                        <div style="clear:both;"></div>
                                                                    </div>  
                                                                    <div class="pull-left toggle-space" data-toggle="tooltip" title="Screening">        
                                                                        <div class="toggle-screening toggle-blue pull-right"> </div>    
                                                                        <input type="checkbox" value="gender" name="is_shown_in_screening[]" class="checkme pull-right hidden">
                                                                        <div style="clear:both;"></div>
                                                                    </div>  
                                                                </div>  
                                                                <div style="clear:both;"></div>
                                                            </div>
                                                        </li>
                                                        <li data-id="1" class="dd-item">
                                                            <div class="dd-handle"><h4>Language required for the job</h4></div>
                                                            <div class="code-pos">
                                                                <div class="form-group">
                                                                    <div id="required_language" name="required_language" class="selectivity-input example-input"></div>
                                                                </div>
                                                                <div style="clear:both;"></div>
                                                                <div class="pull-right">
                                                                    <div class="pull-left toggle-space" data-toggle="tooltip" title="Job Posting">  
                                                                        <div class="toggle toggle-green pull-right"> </div> 
                                                                        <input type="checkbox" value="required_language" name="is_displayed_in_posting[]" class="checkme pull-right hidden">
                                                                        <div style="clear:both;"></div>
                                                                    </div>  
                                                                    <div class="pull-left toggle-space" data-toggle="tooltip" title="Screening">        
                                                                        <div class="toggle-screening toggle-blue pull-right"> </div>    
                                                                        <input type="checkbox" value="required_language" name="is_shown_in_screening[]" class="checkme pull-right hidden">
                                                                        <div style="clear:both;"></div>
                                                                    </div>  
                                                                </div>  
                                                                <div style="clear:both;"></div>
                                                            </div>
                                                        </li>
                                                        <li data-id="1" class="dd-item">
                                                            <div class="dd-handle"><h4>Location of the work</h4></div>
                                                            <div class="code-pos">
                                                                <div class="form-group">
                                                                    <select name="country" id="country" class="form-control">
                                                                        <option value="0">Please select</option>
                                                                        <?php 
                                                                        foreach ($locations as $key => $location) { ?>
                                                                        <option <?=isset($profile->country_id) ? ($profile->country_id==$location->country_id) ? 'selected' : '' : ''?> value="<?=$location->country_id?>"><?=$location->country?></option>
                                                                        <?php } ?> 
                                                                    </select>
                                                                </div>
                                                                <div style="clear:both;"></div>

                                                                <div class="pull-right">
                                                                    <div class="pull-left toggle-space" data-toggle="tooltip" title="Job Posting">  
                                                                        <div class="toggle toggle-green pull-right"> </div> 
                                                                        <input type="checkbox" value="country" name="is_displayed_in_posting[]" class="checkme pull-right hidden">
                                                                        <div style="clear:both;"></div>
                                                                    </div>  
                                                                    <div class="pull-left toggle-space" data-toggle="tooltip" title="Screening">        
                                                                        <div class="toggle-screening toggle-blue pull-right"> </div>    
                                                                        <input type="checkbox" value="country" name="is_shown_in_screening[]" class="checkme pull-right hidden">
                                                                        <div style="clear:both;"></div>
                                                                    </div>  
                                                                </div>  
                                                                <div style="clear:both;"></div>
                                                            </div>
                                                        </li>
                                                        <li data-id="1" class="dd-item">
                                                            <div class="dd-handle"><h4>level of experience</h4></div>
                                                            <div class="code-pos">
                                                                <div class="form-group">
                                                                    <select name="experience_level" id="experience_level" class="form-control">
                                                                        <option value="0">Please select</option>
                                                                        <?php 
                                                                        foreach ($experience_levels as $key => $level) { ?>
                                                                        <option <?=isset($profile->experience_level_id) ? ($profile->experience_level_id == $level->experience_level_id) ? 'selected' : '' : ''?> value="<?=$level->experience_level_id?>"><?=$level->level?></option>
                                                                        <?php } ?> 
                                                                    </select>
                                                                </div>
                                                                <div style="clear:both;"></div>
                                                                <div class="pull-right">
                                                                    <div class="pull-left toggle-space" data-toggle="tooltip" title="Job Posting">  
                                                                        <div class="toggle toggle-green pull-right"> </div> 
                                                                        <input type="checkbox" value="experience_level" name="is_displayed_in_posting[]" class="checkme pull-right hidden">
                                                                        <div style="clear:both;"></div>
                                                                    </div>  
                                                                    <div class="pull-left toggle-space" data-toggle="tooltip" title="Screening">        
                                                                        <div class="toggle-screening toggle-blue pull-right"> </div>    
                                                                        <input type="checkbox" value="experience_level" name="is_shown_in_screening[]" class="checkme pull-right hidden">
                                                                        <div style="clear:both;"></div>
                                                                    </div>  
                                                                </div>  
                                                                <div style="clear:both;"></div>
                                                            </div>
                                                        </li>
                                                        <li data-id="1" class="dd-item">
                                                            <div class="dd-handle"><h4>Job description</h4></div>
                                                            <div class="code-pos">
                                                                <div class="form-group">
                                                                  <textarea id="job_description" type="text" placeholder="" name="job_description" class="form-control"><?=isset($profile->job_description) ? $profile->job_description : '' ?></textarea>
                                                              </div>
                                                              <div style="clear:both;"></div>
                                                              <div class="pull-right">
                                                                <div class="pull-left toggle-space" data-toggle="tooltip" title="Job Posting">  
                                                                    <div class="toggle toggle-green pull-right"> </div> 
                                                                    <input type="checkbox" value="job_description" name="is_displayed_in_posting[]" class="checkme pull-right hidden">
                                                                    <div style="clear:both;"></div>
                                                                </div>  
                                                            </div>  
                                                            <div style="clear:both;"></div>
                                                        </div>
                                                    </li>
                                                    <li data-id="1" class="dd-item">
                                                        <div class="dd-handle"><h4>Job duties</h4></div>
                                                        <div class="code-pos">
                                                            <div class="form-group">
                                                              <textarea id="job_duties" type="text" placeholder="" name="job_duties" class="form-control"><?=isset($profile->job_duties) ? $profile->job_duties : '' ?></textarea>
                                                          </div>
                                                          <div style="clear:both;"></div>
                                                          <div class="pull-right">
                                                            <div class="pull-left toggle-space" data-toggle="tooltip" title="Job Posting">  
                                                                <div class="toggle toggle-green pull-right"> </div> 
                                                                <input type="checkbox" value="job_duties" name="is_displayed_in_posting[]" class="checkme pull-right hidden">
                                                                <div style="clear:both;"></div>
                                                            </div>  
                                                        </div>  
                                                        <div style="clear:both;"></div>
                                                    </div>
                                                </li>
                                                <li data-id="1" class="dd-item">
                                                    <div class="dd-handle"><h4>Expectation from him within first year</h4></div>
                                                    <div class="code-pos">
                                                        <div class="form-group">
                                                            <div class="input-icon right">
                                                              <textarea id="first_year_expectations" name="first_year_expectations" type="text" placeholder="" class="form-control"><?=isset($profile->first_year_expectations) ? $profile->first_year_expectations : '' ?></textarea>
                                                          </div>
                                                      </div>
                                                      <div style="clear:both;"></div>
                                                  </div>
                                              </li>
                                              <li data-id="1" class="dd-item">
                                                <div class="dd-handle"><h4>What days and hours are available for work</h4></div>
                                                <div class="code-pos">
                                                    <div class="form-group">
                                                        <div class="col-md-5 col-sm-5">
                                                            <input id=" working_days" name="working_days" type="text" placeholder="Working Days" class="form-control" value="<?=isset($profile->working_days) ? $profile->working_days : '' ?>">

                                                            <div style="clear:both;"></div>
                                                        </div>
                                                        <div class="col-md-4 col-sm-4">
                                                            <input id="working_hours" name="working_hours" type="text" placeholder="Working Hours" class="form-control" value="<?=isset($profile->working_hours) ? $profile->working_hours : '' ?>">

                                                            <div style="clear:both;"></div>
                                                        </div>
                                                    </div>
                                                    <div style="clear:both;"></div>
                                                </div>
                                            </li>
                                            <li data-id="1" class="dd-item">
                                                <div class="dd-handle"><h4>Work required working the week ends?</h4></div>
                                                <div class="code-pos">
                                                    <div class="form-group">
                                                        <div class="input-icon right">
                                                         <select id="is_weekend_work_required" name="is_weekend_work_required" class="form-control">
                                                            <option>Yes </option>
                                                            <option>No </option>
                                                        </select> 
                                                    </div>
                                                </div>
                                                <div style="clear:both;"></div>
                                            </div>
                                        </li>
                                        <li data-id="1" class="dd-item">
                                            <div class="dd-handle"><h4>Work required working evening after working hours?</h4></div>
                                            <div class="code-pos">
                                                <div class="form-group">
                                                    <div class="input-icon right">
                                                     <select id="work_after_working_hours" name="work_after_working_hours" class="form-control">
                                                        <option>Yes  </option>
                                                        <option>No </option>
                                                    </select> 
                                                </div>
                                            </div>

                                            <div style="clear:both;"></div>
                                        </div>
                                    </li>
                                    <li data-id="1" class="dd-item">
                                        <div class="dd-handle"><h4>The work from the type of shifts?</h4></div>
                                        <div class="code-pos">
                                            <div class="form-group">
                                                <div class="input-icon right">
                                                 <select id="work_shifts" name="work_shifts" class="form-control">
                                                    <option >Yes  </option>
                                                    <option>No </option>
                                                </select> 
                                            </div>
                                        </div>
                                        <div style="clear:both;"></div>
                                    </div>
                                </li>
                                <li data-id="1" class="dd-item">
                                   <div class="dd-handle"><h4>There is the company policy for overtime?</h4></div>
                                   <div class="code-pos">
                                       <div class="form-group">
                                           <div class="input-icon right">
                                            <select id="is_overtime_required" name="is_overtime_required" class="form-control">
                                               <option>Yes  </option>
                                               <option>No </option>
                                           </select> 
                                       </div>
                                   </div>
                                   <div style="clear:both;"></div>
                                   <div class="form-group">
                                       <label for="inputSubject" class="control-label">
                                           If yes , what is  the company policy for overtime?</label>
                                           <div class="input-icon right">
                                            <textarea id="overtime_policy" name="overtime_policy" type="text" placeholder="" class="form-control"><?=isset($overtime_policy) ? $overtime_policy : '' ?></textarea>
                                        </div>
                                    </div>
                                    <div style="clear:both;"></div>
                                </div>
                            </li>
                            <li data-id="1" class="dd-item">
                               <div class="dd-handle"><h4>Level of the position</h4></div>
                               <div class="code-pos">
                                   <div class="form-group">
                                       <div class="input-icon right">
                                        <select id="career_level" name="career_level" class="form-control">
                                          <option value="0">Please select..</option>
                                          <?php 
                                          foreach ($career_levels as $key => $level) { ?>
                                          <option <?=isset($profile->career_level_id) ? $profile->career_level_id==$level->career_level_id? 'selected' : '' : ''?> value="<?=$level->career_level_id?>"><?=$level->career_level?></option>
                                          <?php } ?>
                                      </select> 
                                  </div>
                              </div>
                              <div style="clear:both;"></div>
                              <div class="pull-right">
                                <div class="pull-left toggle-space" data-toggle="tooltip" title="Job Posting">  
                                    <div class="toggle toggle-green pull-right"> </div> 
                                    <input type="checkbox" value="career_level" name="is_displayed_in_posting[]" class="checkme pull-right hidden">
                                    <div style="clear:both;"></div>
                                </div>  
                                <div class="pull-left toggle-space" data-toggle="tooltip" title="Qualification">    
                                    <div class="toggle-qualification toggle-orange pull-right"> </div>  
                                    <input type="checkbox" value="career_level" name="is_shown_in_qualification[]" class="checkme pull-right hidden">
                                    <div style="clear:both;"></div>
                                </div>  
                            </div>  
                            <div style="clear:both;"></div>
                        </div>
                    </li>
                    <li data-id="1" class="dd-item">
                        <div class="dd-handle"><h4>What is the position in the organization structure</h4></div>
                        <div class="code-pos">
                            <div class="form-group">
                                <div class="input-icon right">
                                    <textarea id="organization_structure_position" name="organization_structure_position" type="text" placeholder="" class="form-control"><?=isset($profile->organization_structure_position) ? $profile->organization_structure_position : '' ?></textarea>
                                </div>
                            </div>
                            <div style="clear:both;"></div>
                        </div>
                    </li>
                    <li data-id="1" class="dd-item">
                        <div class="dd-handle"><h4>Reported to whom</h4></div>
                        <div class="code-pos">
                            <div class="form-group">
                                <div class="input-icon right">
                                    <textarea id="reporting_to" name="reporting_to" type="text" placeholder="" class="form-control"><?=isset($profile->reporting_to) ? $profile->reporting_to : '' ?></textarea>
                                </div>
                            </div>
                            <div style="clear:both;"></div>
                        </div>
                    </li>
                    <li data-id="1" class="dd-item">
                        <div class="dd-handle"><h4>How many one reported to him</h4></div>
                        <div class="code-pos">
                            <div class="form-group">
                                <div class="input-icon right">
                                    <select id="total_employees_reporting_to" name="total_employees_reporting_to" class="form-control">
                                        <option <?=isset($profile->total_employees_reporting_to) ? $profile->total_employees_reporting_to == '0 - 5' ? 'selected' : '' : ''?> value="0 - 5">0 - 5</option>
                                        <option <?=isset($profile->total_employees_reporting_to) ? $profile->total_employees_reporting_to == '5 - 10'? 'selected' : '' : ''?> value="5 - 10">5 - 10 </option>   
                                        <option <?=isset($profile->total_employees_reporting_to) ? $profile->total_employees_reporting_to == '10 - 20'? 'selected' : '' : ''?> value="10 - 20">10 - 20 </option>  
                                        <option <?=isset($profile->total_employees_reporting_to) ? $profile->total_employees_reporting_to == '20 - 50'? 'selected' : '' : ''?> value="20 - 50">20 - 50 </option>  
                                    </select> 
                                </div>
                            </div>
                            <div style="clear:both;"></div>
                        </div>
                    </li>
                    <li data-id="1" class="dd-item">
                        <div class="dd-handle"><h4>What is the grade of the employee in the organization structure</h4></div>
                        <div class="code-pos">
                            <div class="form-group">
                                <div class="input-icon right">
                                    <select id="grade_of_employee" name="grade_of_employee" class="form-control">
                                        <option value="0">Please Select</option>
                                        <?php for ($i=0; $i < 20 ; $i++) { 
                                            echo '<option value="'.($i+1).'">'.($i+1).'</option>';
                                        } ?>


                                    </select> 
                                </div>
                            </div>
                            <div style="clear:both;"></div>
                        </div>
                    </li>
                    <li data-id="1" class="dd-item">
                        <div class="dd-handle"><h4>What is the position promotion for higher position and replacement</h4></div>
                        <div class="code-pos">
                            <div class="form-group">
                                <div class="input-icon right">
                                    <textarea id="position_promotion" name="position_promotion" type="text" placeholder="" class="form-control"><?=isset($profile->position_promotion) ? $profile->position_promotion : '' ?></textarea>
                                </div>
                            </div>
                            <div style="clear:both;"></div>
                        </div>
                    </li>
                    <li data-id="1" class="dd-item">
                        <div class="dd-handle"><h4>The trail period for the employee</h4></div>
                        <div class="code-pos">
                            <div class="form-group">
                                <div class="input-icon right">
                                    <select id="probation_period" name="probation_period" class="form-control">
                                        <option <?=isset($profile->probation_period) ? $profile->probation_period =='1 Month'? 'selected' : '' : ''?> value="1 Month">1 Month</option>    
                                        <option <?=isset($profile->probation_period) ? $profile->probation_period =='0 - 3 Months'? 'selected' : '' : ''?>  value="0 - 3 Months">0 - 3 Months</option> 
                                        <option <?=isset($profile->probation_period) ? $profile->probation_period =='0 - 6 Months'? 'selected' : '' : ''?> value="0 - 6 Months">0 - 6 Months </option>
                                    </select> 
                                </div>
                            </div>
                            <div style="clear:both;"></div>
                        </div>
                    </li>
                    <li data-id="1" class="dd-item">
                        <div class="dd-handle"><h4>Benefits including</h4></div>
                        <div class="code-pos">
                            <div class="form-group">
                                <?php 
                                foreach ($employee_benefits as $key => $employee_benefit) { ?>
                                <div style="margin: 5px 0;">
                                    <input class="pull-left" type="checkbox" name="employee_benefits_<?=$employee_benefit->employee_benefit_id?>_checkbox" <?=is_employee_benefits_selected(isset($profile->job_profile_id)?$profile->job_profile_id:0,$employee_benefit->employee_benefit_id)? 'checked' : ''?> value="<?=$employee_benefit->employee_benefit_id?>">
                                    <span class="pull-left" style="width:150px;">&nbsp;<?=$employee_benefit->benefit?>&nbsp;</span>
                                    &nbsp; <input class="pull-left" type="text" placeholder="Amount" value="<?=get_employee_benefit_amount(isset($profile->job_profile_id)?$profile->job_profile_id:0,$employee_benefit->employee_benefit_id)?>" name="employee_benefits_<?=$employee_benefit->employee_benefit_id?>_amount"/>
                                </div>
                                <div class="clearfix"></div>
                                <?php } ?>
                            </div>
                            <div style="clear:both;"></div>
                        </div>
                    </li>
                    <li data-id="1" class="dd-item">
                        <div class="dd-handle"><h4>Work environment</h4></div>
                        <div class="code-pos">
                            <div class="form-group">
                                <div id="work_environment" name="work_environment" class="selectivity-input example-input"></div>
                            </div>
                            <div style="clear:both;"></div>
                        </div>
                    </li>
                    <li data-id="1" class="dd-item">
                        <div class="dd-handle"><h4>Equipment and devices to be used?</h4></div>
                        <div class="code-pos">
                            <div class="form-group">
                                <textarea id="equipments_devices_used" name="equipments_devices_used" type="text" placeholder="" class="form-control"><?=isset($profile->equipments_devices_used) ? $profile->equipments_devices_used : '' ?></textarea>
                            </div>
                            <div style="clear:both;"></div>
                        </div>
                    </li>
                    <li data-id="1" class="dd-item">
                        <div class="dd-handle"><h4>Mobility</h4></div>
                        <div class="code-pos">
                            <div class="form-group">
                                <div id="mobility" name="mobility" class="selectivity-input example-input"></div>
                            </div>
                            <div style="clear:both;"></div>
                            <div class="pull-right">
                                <div class="pull-left toggle-space" data-toggle="tooltip" title="Job Posting">  
                                    <div class="toggle toggle-green pull-right"> </div> 
                                    <input type="checkbox" value="mobility" name="is_displayed_in_posting[]" class="checkme pull-right hidden">
                                    <div style="clear:both;"></div>
                                </div> 
                            </div>  
                            <div style="clear:both;"></div>
                        </div>
                    </li>                                       
                    <li data-id="1" class="dd-item">
                        <div class="dd-handle"><h4>Minimum education requirements?</h4></div>
                        <div class="code-pos">
                            <div class="form-group">
                                <div class="form-group">
                                    <select id="degree_type" name="degree_type" class="form-control">
                                        <option value="0">Please select..</option>
                                        <?php 
                                        foreach ($degree_types as $key => $type) { ?>
                                        <option <?=isset($profile->degree_type_id) ? $profile->degree_type_id==$type->degree_type_id? 'selected' : '' : ''?> value="<?=$type->degree_type_id?>"><?=$type->type?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div style="clear:both;"></div>
                            <div class="pull-right">
                                <div class="pull-left toggle-space" data-toggle="tooltip" title="Job Posting">  
                                    <div class="toggle toggle-green pull-right"> </div> 
                                    <input type="checkbox" value="minimum_education_requirement" name="is_displayed_in_posting[]" class="checkme pull-right hidden">
                                    <div style="clear:both;"></div>
                                </div>  
                                <div class="pull-left toggle-space" data-toggle="tooltip" title="Qualification">    
                                    <div class="toggle-qualification toggle-orange pull-right"> </div>  
                                    <input type="checkbox" value="minimum_education_requirement" name="is_shown_in_qualification[]" class="checkme pull-right hidden">
                                    <div style="clear:both;"></div>
                                </div>  
                            </div>  
                            <div style="clear:both;"></div>
                        </div>
                    </li>
                    <li data-id="1" class="dd-item">
                        <div class="dd-handle"><h4>Training certificate held by the applicant</h4></div>
                        <div class="code-pos">
                            <div class="form-group">
                                <textarea id="is_training_certificate_retained" name="is_training_certificate_retained" type="text" placeholder="" class="form-control"><?=isset($profile->is_training_certificate_retained) ? $profile->is_training_certificate_retained : ''?></textarea>
                            </div>
                            <div style="clear:both;"></div>
                        </div>
                    </li>
                    <li data-id="1" class="dd-item">
                        <div class="dd-handle"><h4>What type of training company will offer for the employee?</h4></div>
                        <div class="code-pos">
                            <div class="form-group">
                                <textarea id="training_offered" name="training_offered" type="text" placeholder="" class="form-control"><?=isset($profile->training_offered) ? $profile->training_offered : ''?></textarea>
                            </div>
                            <div style="clear:both;"></div>
                        </div>
                    </li>
                    <li data-id="1" class="dd-item">
                        <div class="dd-handle"><h4>Activities type needed for this position</h4></div>
                        <div class="code-pos">
                            <div class="form-group">
                                <div id="position_activity_ids" name="position_activity_ids" class="selectivity-input example-input"></div>
                            </div>
                            <div style="clear:both;"></div>
                        </div>
                    </li>
                    <li data-id="1" class="dd-item">
                        <div class="dd-handle"><h4>Skills type needed for this position</h4></div>
                        <div class="code-pos">  
                            <div class="form-group">
                                <div id="skills" name="skills" class="selectivity-input example-input"></div>
                            </div>
                            <div style="clear:both;"></div>
                        </div>
                    </li>
                    <li data-id="1" class="dd-item">
                        <div class="dd-handle"><h4>Competencies dealing with customer</h4></div>
                        <div class="code-pos">
                            <div class="form-group">
                             <div id="customer_competency" name="competencies_needed" class="competencies_needed selectivity-input example-input"></div>
                         </div>
                         <div style="clear:both;"></div>
                         <div class="pull-right">
                            <div class="pull-left toggle-space" data-toggle="tooltip" title="Qualification">    
                                <div class="toggle-qualification toggle-orange pull-right"> </div>  
                                <input type="checkbox" value="customer_competencies" name="is_shown_in_qualification[]" class="checkme pull-right hidden">
                                <div style="clear:both;"></div>
                            </div>  
                        </div>  
                        <div style="clear:both;"></div>
                    </div>
                </li>
                <li data-id="1" class="dd-item">
                    <div class="dd-handle"><h4>Competencies Dealing with People</h4></div>
                    <div class="code-pos">
                        <div class="form-group">
                         <div id="people_competency" name="competencies_needed" class="competencies_needed selectivity-input example-input"></div>
                     </div>
                     <div style="clear:both;"></div>
                     <div class="pull-right">
                        <div class="pull-left toggle-space" data-toggle="tooltip" title="Qualification">    
                            <div class="toggle-qualification toggle-orange pull-right"> </div>  
                            <input type="checkbox" value="people_competencies" name="is_shown_in_qualification[]" class="checkme pull-right hidden">
                            <div style="clear:both;"></div>
                        </div>  
                    </div>  
                    <div style="clear:both;"></div>
                </div>
            </li>
            <li data-id="1" class="dd-item">
                <div class="dd-handle"><h4>Competencies Dealing with Business</h4></div>
                <div class="code-pos">
                    <div class="form-group">
                        <div id="business_competency" name="competencies_needed" class="competencies_needed selectivity-input example-input"></div>
                    </div>
                    <div style="clear:both;"></div>
                    <div class="pull-right">
                       <div class="pull-left toggle-space" data-toggle="tooltip" title="Qualification">    
                        <div class="toggle-qualification toggle-orange pull-right"> </div>  
                        <input type="checkbox" value="business_competencies" name="is_shown_in_qualification[]" class="checkme pull-right hidden">
                        <div style="clear:both;"></div>
                    </div>  
                </div>  
                <div style="clear:both;"></div>
            </div>
        </li>
        <li data-id="1" class="dd-item">
            <div class="dd-handle"><h4>Self-Management Competencies </h4></div>
            <div class="code-pos">
                <div class="form-group">
                    <div id="self_management_competency" name="competencies_needed" class="competencies_needed selectivity-input example-input"></div>
                </div>
                <div style="clear:both;"></div>
                <div class="pull-right">
                    <div class="pull-left toggle-space" data-toggle="tooltip" title="Qualification">    
                     <div class="toggle-qualification toggle-orange pull-right"> </div>  
                     <input type="checkbox" value="self_management_competencies" name="is_shown_in_qualification[]" class="checkme pull-right hidden">
                     <div style="clear:both;"></div>
                 </div>  
             </div>  
             <div style="clear:both;"></div>
         </div>
     </li>
     <li data-id="1" class="dd-item">
        <div class="dd-handle"><h4>Behavioral competencies</h4></div>
        <div class="code-pos">
            <div class="form-group">
                <div id="behavioral_competency" name="competencies_needed" class="competencies_needed selectivity-input example-input"></div>
            </div>
            <div style="clear:both;"></div>
            <div class="pull-right">
                <div class="pull-left toggle-space" data-toggle="tooltip" title="Qualification">    
                    <div class="toggle-qualification toggle-orange pull-right"> </div>  
                    <input type="checkbox" value="behavioral_competencies" name="is_shown_in_qualification[]" class="checkme pull-right hidden">
                    <div style="clear:both;"></div>
                </div>  
            </div>  
            <div style="clear:both;"></div>
        </div>
    </li>
    <li data-id="1" class="dd-item">
        <div class="dd-handle"><h4>Selection test types.</h4></div>
        <div class="code-pos">
            <div class="form-group">
                <textarea id="selection_type" name="selection_type" type="text" placeholder="" class="form-control"><?=isset($profile->selection_type) ? $profile->selection_type : ''?></textarea>
            </div>
            <div style="clear:both;"></div>
        </div>
    </li>
    <li data-id="1" class="dd-item">
        <div class="dd-handle"><h4>When you want the employee to start</h4></div>
        <div class="code-pos">
            <div class="form-group">
                <div class="input-icon right">
                    <select id="notice_period" name="notice_period" class="form-control">
                        <option value="0">Please select</option>
                        <?php 
                        foreach ($notice_periods as $key => $notice_period) { ?>
                        <option <?=isset($profile->notice_period_id) ? $profile->notice_period_id==$notice_period->notice_period_id? 'selected' : '' : ''?> value="<?=$notice_period->notice_period_id?>"><?=$notice_period->period?></option>
                        <?php } ?>  
                    </select>
                </div>
            </div>
            <div style="clear:both;"></div>
            <div class="pull-right">
                <div class="pull-left toggle-space" data-toggle="tooltip" title="Job Posting">  
                    <div class="toggle toggle-green pull-right"> </div> 
                    <input type="checkbox" value="notice_period" name="is_displayed_in_posting[]" class="checkme pull-right hidden">
                    <div style="clear:both;"></div>
                </div>  
                <div class="pull-left toggle-space" data-toggle="tooltip" title="Screening">        
                    <div class="toggle-screening toggle-blue pull-right"> </div>    
                    <input type="checkbox" value="notice_period" name="is_shown_in_screening[]" class="checkme pull-right hidden">
                    <div style="clear:both;"></div>
                </div>  
            </div>  
            <div style="clear:both;"></div>
        </div>
    </li>
    <li data-id="1" class="dd-item">
        <div class="dd-handle"><h4>The vacancy created by</h4></div>
        <div class="code-pos">
            <div class="form-group">
                <div class="input-icon right">
                    <select id="vacancy_created_by" name="vacancy_created_by" class="form-control">
                        <option value="Termination">Termination </option>   
                        <option value="Leave of an Employee">Leave of an Employee </option>  
                        <option value="New Hiring">New Hiring</option>
                    </select> 
                </div>
            </div>
            <div style="clear:both;"></div>
        </div>
    </li>
    <li data-id="1" class="dd-item">
        <div class="dd-handle"><h4>Learning resources of the position</h4></div>
        <div class="code-pos">
            <div class="form-group">
                <div id="learning_resource" name="learning_resource" class="selectivity-input example-input"></div>
            </div>
            <div style="clear:both;"></div>
        </div>
    </li>
    <li data-id="1" class="dd-item">
        <div class="dd-handle"><h4>What is the preferred age for the position </h4></div>
        <div class="code-pos">
            <div class="form-group">
                <select id="preferred_age" name="preferred_age" class="form-control">
                    <option value="0">Please select</option>
                    <?php 
                    foreach ($preferred_ages as $key => $age) { ?>
                    <option <?=isset($profile->preferred_age_id) ? $profile->preferred_age_id==$age->preferred_age_id? 'selected' : '' : ''?> value="<?=$age->preferred_age_id?>"><?=$age->age?></option>
                    <?php } ?>  
                </select>
            </div>
            <div style="clear:both;"></div>
            <div class="pull-right">
                <div class="pull-left toggle-space" data-toggle="tooltip" title="Job Posting">  
                    <div class="toggle toggle-green pull-right"> </div> 
                    <input type="checkbox" value="preferred_age" name="is_displayed_in_posting[]" class="checkme pull-right hidden">
                    <div style="clear:both;"></div>
                </div>  
                <div class="pull-left toggle-space" data-toggle="tooltip" title="Screening">        
                    <div class="toggle-screening toggle-blue pull-right"> </div>    
                    <input type="checkbox" value="preferred_age" name="is_shown_in_screening[]" class="checkme pull-right hidden">
                    <div style="clear:both;"></div>
                </div>   
            </div>  
            <div style="clear:both;"></div>
        </div>
    </li>
    <li data-id="1" class="dd-item">
        <div class="dd-handle"><h4>Marital status preferred for the job</h4></div>
        <div class="code-pos">
            <div class="form-group">
               <select id="maritial_status" name="maritial_status" class="form-control">
                <option value="0">Please select</option>
                <?php 
                foreach ($maritial_statuses as $key => $status) { ?>
                <option <?=isset($profile->maritial_status_id) ? $profile->maritial_status_id==$status->maritial_status_id? 'selected' : '' : ''?> value="<?=$status->maritial_status_id?>"><?=$status->status?></option>
                <?php } ?>  
            </select>
        </div>
        <div style="clear:both;"></div>
        <div class="pull-right">
            <div class="pull-left toggle-space" data-toggle="tooltip" title="Job Posting">  
                <div class="toggle toggle-green pull-right"> </div> 
                <input type="checkbox" value="maritial_status" name="is_displayed_in_posting[]" class="checkme pull-right hidden">
                <div style="clear:both;"></div>
            </div>  
            <div class="pull-left toggle-space" data-toggle="tooltip" title="Screening">        
                <div class="toggle-screening toggle-blue pull-right"> </div>    
                <input type="checkbox" value="maritial_status" name="is_shown_in_screening[]" class="checkme pull-right hidden">
                <div style="clear:both;"></div>
            </div>  
        </div>  
        <div style="clear:both;"></div>
    </div>
</li>
<li data-id="1" class="dd-item">
    <div class="dd-handle"><h4>Prefered Visa status for the job</h4></div>
    <div class="code-pos">
        <div class="form-group">
            <select id="visa_status" name="visa_status" class="form-control">
                <option value="0">Please select</option>
                <?php 
                foreach ($visa_statuses as $key => $visa_status) { ?>
                <option <?=isset($profile->visa_status_id) ? $profile->visa_status_id==$visa_status->visa_status_id? 'selected' : '' : ''?> value="<?=$visa_status->visa_status_id?>"><?=$visa_status->type?></option>
                <?php } ?>  
            </select> 
        </div>
        <div style="clear:both;"></div>
        <div class="pull-right">
            <div class="pull-left toggle-space" data-toggle="tooltip" title="Job Posting">  
                <div class="toggle toggle-green pull-right"> </div> 
                <input type="checkbox" value="visa_status" name="is_displayed_in_posting[]" class="checkme pull-right hidden">
                <div style="clear:both;"></div>
            </div>  
            <div class="pull-left toggle-space" data-toggle="tooltip" title="Screening">        
                <div class="toggle-screening toggle-blue pull-right"> </div>    
                <input type="checkbox" value="visa_status" name="is_shown_in_screening[]" class="checkme pull-right hidden">
                <div style="clear:both;"></div>
            </div>  
        </div>  
        <div style="clear:both;"></div>
    </div>
</li>
<li data-id="1" class="dd-item">
    <div class="dd-handle"><h4>Driving license which country required</h4></div>
    <div class="code-pos">
        <div class="form-group">
            <div id="driving_license_country" name="driving_license_country" class="selectivity-input example-input"></div>
        </div>
        <div style="clear:both;"></div>
        <div class="pull-right">
            <div class="pull-left toggle-space" data-toggle="tooltip" title="Job Posting">  
                <div class="toggle toggle-green pull-right"> </div> 
                <input type="checkbox" value="driving_license_country" name="is_displayed_in_posting[]" class="checkme pull-right hidden">
                <div style="clear:both;"></div>
            </div>  
            <div class="pull-left toggle-space" data-toggle="tooltip" title="Screening">        
                <div class="toggle-screening toggle-blue pull-right"> </div>    
                <input type="checkbox" value="driving_license_country" name="is_shown_in_screening[]" class="checkme pull-right hidden">
                <div style="clear:both;"></div>
            </div>  
        </div>  
        <div style="clear:both;"></div>
    </div>
</li>
<li data-id="1" class="dd-item">
    <div class="dd-handle"><h4>The range of salary takes to home for this position</h4></div>
    <div class="code-pos">
        <div class="form-group">
            <select id="salary_range" name="salary_range" class="form-control">
                <option value="0">Please select</option>
                <?php 
                foreach ($salary_ranges as $key => $salary_range) { ?>
                <option <?=isset($profile->salary_range_id) ? $profile->salary_range_id==$salary_range->salary_range_id? 'selected' : '' : ''?> value="<?=$salary_range->salary_range_id?>"><?=$salary_range->salary_range?></option>
                <?php } ?>  
            </select>
        </div>
        <div style="clear:both;"></div>
        <div class="pull-right">
            <div class="pull-left toggle-space" data-toggle="tooltip" title="Job Posting">  
                <div class="toggle toggle-green pull-right"> </div> 
                <input type="checkbox" value="salary_range" name="is_displayed_in_posting[]" class="checkme pull-right hidden">
                <div style="clear:both;"></div>
            </div>  
            <div class="pull-left toggle-space" data-toggle="tooltip" title="Screening">        
                <div class="toggle-screening toggle-blue pull-right"> </div>    
                <input type="checkbox" value="salary_range" name="is_shown_in_screening[]" class="checkme pull-right hidden">
                <div style="clear:both;"></div>
            </div>  
        </div>  
        <div style="clear:both;"></div>
    </div>
</li>
<li data-id="1" class="dd-item">
    <div class="dd-handle"><h4>What is the Education(faculty) matching the job</h4></div>
    <div class="code-pos">
        <div class="form-group">
            <select id="education_faculty" name="education_faculty" class="form-control">
               <option value="0">Please select</option>
               <?php 
               foreach ($education_faculties as $key => $education_faculty) { ?>
               <option <?=isset($profile->education_faculty_id) ? $profile->education_faculty_id==$education_faculty->education_faculty_id? 'selected' : '' : ''?> value="<?=$education_faculty->education_faculty_id?>"><?=$education_faculty->faculty?></option>
               <?php } ?> 
           </select> 
       </div>
       <div style="clear:both;"></div>
       <div class="pull-right">
           <div class="pull-left toggle-space" data-toggle="tooltip" title="Qualification">    
            <div class="toggle-qualification toggle-orange pull-right"> </div>  
            <input type="checkbox" value="education_faculty" name="is_shown_in_qualification[]" class="checkme pull-right hidden">
            <div style="clear:both;"></div>
        </div>  
    </div>  
    <div style="clear:both;"></div>
</div>
</li>
<li data-id="1" class="dd-item">
    <div class="dd-handle"><h4>What are the soft skills you want?</h4></div>
    <div class="code-pos">
        <div class="form-group">
            <div id="soft_skill_type" name="soft_skill_type" class="selectivity-input example-input"></div>
        </div>
        <div style="clear:both;"></div>
        <div class="pull-right">
            <div class="pull-left toggle-space" data-toggle="tooltip" title="Qualification">    
                <div class="toggle-qualification toggle-orange pull-right"> </div>  
                <input type="checkbox" value="soft_skill_type" name="is_shown_in_qualification[]" class="checkme pull-right hidden">
                <div style="clear:both;"></div>
            </div>  
        </div>  
        <div style="clear:both;"></div>
    </div>
</li>
<li data-id="1" class="dd-item">
    <div class="dd-handle"><h4>Department</h4></div>
    <div class="code-pos">
        <div class="form-group">
            <select id="department" name="department" class="form-control">
                <option value="0">Please select</option>
                <?php 
                foreach ($departments as $key => $department) { ?>
                <option <?=isset($profile->department_id) ? $profile->department_id==$department->department_id? 'selected' : '' : ''?> value="<?=$department->department_id?>"><?=$department->department?></option>
                <?php } ?>  
            </select> 
        </div>
        <div style="clear:both;"></div>
        <div class="pull-right">
            <div class="pull-left toggle-space" data-toggle="tooltip" title="Job Posting">  
                <div class="toggle toggle-green pull-right"> </div> 
                <input type="checkbox" value="department" name="is_displayed_in_posting[]" class="checkme pull-right hidden">
                <div style="clear:both;"></div>
            </div> 
            <div class="pull-left toggle-space" data-toggle="tooltip" title="Qualification">    
                <div class="toggle-qualification toggle-orange pull-right"> </div>  
                <input type="checkbox" value="department" name="is_shown_in_qualification[]" class="checkme pull-right hidden">
                <div style="clear:both;"></div>
            </div>  
        </div>  
        <div style="clear:both;"></div>
    </div>
</li>
<li data-id="1" class="dd-item">
    <div class="dd-handle"><h4>Employment type</h4></div>
    <div class="code-pos">
        <div class="form-group">
            <select id="employment_type" name="employment_type" class="form-control">
                <option value="0">Please select</option>
                <?php 
                foreach ($employment_types as $key => $employment_type) { ?>
                <option <?=isset($profile->employment_type_id) ? $profile->employment_type_id==$employment_type->employment_type_id? 'selected' : '' : ''?> value="<?=$employment_type->employment_type_id?>"><?=$employment_type->type?></option>
                <?php } ?>     
            </select>
        </div>
        <div style="clear:both;"></div>
    </div>
</li>
<li data-id="1" class="dd-item">
    <div class="dd-handle"><h4>Employment Status</h4></div>
    <div class="code-pos">
        <div class="form-group">
            <select id="employment_status" name="employment_status" class="form-control">
               <option value="0">Please select</option>
               <?php 
               foreach ($employment_statuses as $key => $employment_status) { ?>
               <option <?=isset($profile->employment_status_id) ? $profile->employment_status_id==$employment_status->employment_status_id? 'selected' : '' : ''?> value="<?=$employment_status->employment_status_id?>"><?=$employment_status->status?></option>
               <?php } ?>   
           </select>
       </div>
       <div style="clear:both;"></div>
       <div class="pull-right">
        <div class="pull-left toggle-space" data-toggle="tooltip" title="Job Posting">  
            <div class="toggle toggle-green pull-right"> </div> 
            <input type="checkbox" value="employment_status" name="is_displayed_in_posting[]" class="checkme pull-right hidden">
            <div style="clear:both;"></div>
        </div> 
    </div>  
    <div style="clear:both;"></div>
</div>
</li>
<div class="fixed-btn"> <button type="button" class="btn btn-primary btn-save-job-profile hidden"><?=isset($profile->job_profile_id) ? 'Update Profile' : 'Create Profile'?></button></div>
</ol>
</form>
</div>
</div>
<div id="upload_attachments" class="tab-pane fade">
   <?php if(isset($profile->job_profile_id)){ ?>
   <form action="/employer/save_job_profile_attachments" enctype="multipart/form-data" method="POST">
    <input type="hidden" id="job_profile_id" name="job_profile_id" value="<?=isset($profile->job_profile_id) ? $profile->job_profile_id : 0 ?>" />
    <input type="hidden" id="company_profile_id" name="company_profile_id" value="<?=isset($company_profile_id) ? $company_profile_id : 0 ?>" />                               
    <ol class="dd-list">
        <li data-id="1" class="dd-item">
            <div class="dd-handle"><h4>KPI and performance standard for the employee</h4></div>
            <div class="code-pos">
                <div class="form-group">
                    <input id="kpi_performance" name="kpi_performance" type="file" placeholder="Inlcude some file">
                    <a href="<?=base_url()?>uploads/job_profile_attachments/<?=$profile->kpi_performance?>" target="_blank"><?=$profile->kpi_performance?></a>
                </div>
                <div style="clear:both;"></div>
            </div>
        </li>
        <li data-id="1" class="dd-item">
            <div class="dd-handle"><h4>Appraisal and evaluation of the applicant</h4></div>
            <div class="code-pos">
                <div class="form-group">
                    <input id="appraisal_evaluation" name="appraisal_evaluation" type="file">
                    <a href="<?=base_url()?>uploads/job_profile_attachments/<?=$profile->appraisal_evaluation?>" target="_blank"><?=$profile->appraisal_evaluation?></a>
                </div>
                <div style="clear:both;"></div>
            </div>
        </li>
        <li data-id="1" class="dd-item">
            <div class="dd-handle"><h4>Criteria to accept or reject the employee</h4></div>
            <div class="code-pos">
                <div class="form-group">
                    <input id="accept_reject_criteria" name="accept_reject_criteria" type="file">
                    <a href="<?=base_url()?>uploads/job_profile_attachments/<?=$profile->accept_reject_criteria?>" target="_blank"><?=$profile->accept_reject_criteria?></a>
                </div>
                <div style="clear:both;"></div>
            </div>
            <br/>
        </li>
    </ol>
    <input type="submit" value="Upload Attachments" class="pull-right btn btn-info" /> 
    <div class="clearfix"></div>
</form>
<?php }else { ?>
<div class="alert alert-danger" role="alert">Please Complete the Job Profile and then add upload attachments <strong>!</strong></div>
<?php } ?>
</div>

<div id="question_tab" class="tab-pane fade">
    <?php if(isset($profile->job_profile_id)){ ?>
    <div class="panel-body">
        <div class="row">
           <button class="add-question edit-btn pull-right" type="submit"><i class="fa fa-pencil-square-o"></i> Add</button>
           <?php foreach($questions as $key => $question){ ?>
           <div class="col-md-12 col-sm-12 seperator">
            <div class="col-md-8 col-sm-8 left-padding section-content">

                <input type="hidden" id="cn_job_profile_question_id" name="job_profile_question_id" value="<?=$question->job_profile_question_id?>" />
                <h5><?=$key+1?>) <span class="cn-question"><?=$question->question?></span></h5>
            </div>                                                  
            <div class="edit-delete text-right pull-right">
                <ul>
                    <li>
                        <button class="edit-question edit-btn" type="submit"><i class="fa fa-pencil-square-o"></i> Edit</button>
                    </li>
                    <li>
                        <a href="<?=base_url()?>employer/delete_job_profile_question/<?=$question->job_profile_id?>/<?=$question->job_profile_question_id?>"><button class="dlt-btn delete-question" type="submit"><i class="fa fa-trash-o"></i> Delete</button></a>
                    </li>
                </ul>
            </div>
        </div> 
        <?php } ?>                                                     
    </div>
    <div style="clear:both;"></div>
    <form method="POST" action="/employer/save_job_profile_question" id="question_profile_form" class="question_profile_form"> 
        <input type="hidden" id="job_profile_id" name="job_profile_id" value="<?=isset($profile->job_profile_id) ? $profile->job_profile_id : 0 ?>" />
        <input type="hidden" id="job_profile_question_id" name="job_profile_question_id" value="0" />
        <input type="hidden" id="question_type" name="question_type" value="question" />
        <div class="bottom-slider">
            <div class="col-md-8 col-sm-8 left-padding">
                <div class="form-group">
                    <div class="input-icon right">
                        <textarea id="question" name="question" type="text" placeholder="" class="form-control"></textarea>
                    </div>
                </div>
                <div style="clear:both;"></div>
            </div>
            <div class="form-group pull-right">
                <label class="control-label col-md-2 col-sm-2 col-xs-12"></label>
                <button class="info-save btn-info btn">Save</button>
            </div>
            <div style="clear:both;"></div>
        </div>
    </form>
</div>
<?php }else { ?>
<div class="alert alert-danger" role="alert">Please Complete the Job Profile and then add questions <strong>!</strong></div>
<?php } ?>

</div>
<div id="interview_call_tab" class="tab-pane fade">
    <?php if(isset($profile->job_profile_id)){ ?>
    <div class="panel-body">
        <div class="row">
           <button class="add-question edit-btn pull-right" type="submit"><i class="fa fa-pencil-square-o"></i> Add</button>
           <?php foreach($interview_call_questions as $key => $question){ ?>
           <div class="col-md-12 col-sm-12 seperator">
            <div class="col-md-8 col-sm-8 left-padding section-content">

                <input type="hidden" id="cn_job_profile_question_id" name="job_profile_question_id" value="<?=$question->job_profile_question_id?>" />
                <h5><?=$key+1?>) <span class="cn-question"><?=$question->question?></span></h5>
            </div>                                                  
            <div class="edit-delete text-right pull-right">
                <ul>
                    <li>
                        <button class="edit-question edit-btn" type="submit"><i class="fa fa-pencil-square-o"></i> Edit</button>
                    </li>
                    <li>
                        <a href="<?=base_url()?>employer/delete_job_profile_question/<?=$question->job_profile_id?>/<?=$question->job_profile_question_id?>"><button class="dlt-btn delete-question" type="submit"><i class="fa fa-trash-o"></i> Delete</button></a>
                    </li>
                </ul>
            </div>
        </div> 
        <?php } ?>                                                     
    </div>
    <div style="clear:both;"></div>
    <form method="POST" action="/employer/save_job_profile_question" id="question_profile_form" class="question_profile_form"> 
        <input type="hidden" id="job_profile_id" name="job_profile_id" value="<?=isset($profile->job_profile_id) ? $profile->job_profile_id : 0 ?>" />
        <input type="hidden" id="job_profile_question_id" name="job_profile_question_id" value="0" />
        <input type="hidden" id="question_type" name="question_type" value="interview_call" />
        <div class="bottom-slider">
            <div class="col-md-8 col-sm-8 left-padding">
                <div class="form-group">
                    <div class="input-icon right">
                        <textarea id="question" name="question" type="text" placeholder="" class="form-control"></textarea>
                    </div>
                </div>
                <div style="clear:both;"></div>
            </div>
            <div class="form-group pull-right">
                <label class="control-label col-md-2 col-sm-2 col-xs-12"></label>
                <button class="info-save btn-info btn">Save</button>
            </div>
            <div style="clear:both;"></div>
        </div>
    </form>
</div>
<?php }else { ?>
<div class="alert alert-danger" role="alert">Please Complete the Job Profile and then add questions <strong>!</strong></div>
<?php } ?>


</div>
<div id="structured_interview_tab" class="tab-pane fade">
    <?php if(isset($profile->job_profile_id)){ ?>
    <div class="panel-body">
        <div class="row">
           <button class="add-question edit-btn pull-right" type="submit"><i class="fa fa-pencil-square-o"></i> Add</button>
           <?php foreach($structured_questions as $key => $question){ ?>
           <div class="col-md-12 col-sm-12 seperator">
            <div class="col-md-8 col-sm-8 left-padding section-content">
                <input type="hidden" id="cn_job_profile_question_id" name="job_profile_question_id" value="<?=$question->job_profile_question_id?>" />
                <h5><?=$key+1?>) <span class="cn-question"><?=$question->question?></span></h5>
            </div>                                                  
            <div class="edit-delete text-right pull-right">
                <ul>
                    <li>
                        <button class="edit-question edit-btn" type="submit"><i class="fa fa-pencil-square-o"></i> Edit</button>
                    </li>
                    <li>
                        <a href="<?=base_url()?>employer/delete_job_profile_question/<?=$question->job_profile_id?>/<?=$question->job_profile_question_id?>"><button class="dlt-btn delete-question" type="submit"><i class="fa fa-trash-o"></i> Delete</button></a>
                    </li>
                </ul>
            </div>
        </div> 
        <?php } ?>                                                     
    </div>
    <div style="clear:both;"></div>
    <form method="POST" action="/employer/save_job_profile_question" id="question_profile_form" class="question_profile_form"> 
        <input type="hidden" id="job_profile_id" name="job_profile_id" value="<?=isset($profile->job_profile_id) ? $profile->job_profile_id : 0 ?>" />
        <input type="hidden" id="job_profile_question_id" name="job_profile_question_id" value="0" />
        <input type="hidden" id="question_type" name="question_type" value="structured_interview" />
        <div class="bottom-slider">
            <div class="col-md-8 col-sm-8 left-padding">
                <div class="form-group">
                    <div class="input-icon right">
                        <textarea id="question" name="question" type="text" placeholder="" class="form-control"></textarea>
                    </div>
                </div>
                <div style="clear:both;"></div>
            </div>
            <div class="form-group pull-right">
                <label class="control-label col-md-2 col-sm-2 col-xs-12"></label>
                <button class="info-save btn-info btn">Save</button>
            </div>
            <div style="clear:both;"></div>
        </div>
    </form>
</div>
<?php }else { ?>
<div class="alert alert-danger" role="alert">Please Complete the Job Profile and then add questions <strong>!</strong></div>
<?php } ?>


</div>
</div>

</div>
</div>
</div>
                <!-- <div class="col-lg-3">
            </div> -->
        </div>
    </div>
</div>
<!--END CONTENT-->
<?php $this->load->view('partial/portal_footer.php'); ?>
<link rel="stylesheet" href="<?=base_url()?>assets/portal/styles/toggles.css">
<link rel="stylesheet" href="<?=base_url()?>assets/portal/styles/toggles-light.css">
<link rel="stylesheet" href="<?=base_url()?>assets/portal/styles/selectivity-full.css">
<script src="<?=base_url()?>assets/portal/script/toggles.js" type="text/javascript"></script>
<script src="<?=base_url()?>assets/portal/script/selectivity-full.js" type="text/javascript"></script>

<script type="text/javascript">
$(document).ready(function () {
   /* $(".edit-btn").click(function(){
        $(this).parents(".panel-body").find(".bottom-slider").slideToggle();
    });*/

var posting_elements = '<?=isset($profile->posting_elements)?$profile->posting_elements:''?>'.split(',');
var screening_elements = '<?=isset($profile->screening_elements)?$profile->screening_elements:''?>'.split(',');
var qualification_elements = '<?=isset($profile->qualification_elements)?$profile->qualification_elements:''?>'.split(',');
// console.log(posting_elements);
var toggle_checked = false;
$('.toggle').each(function(){
    toggle_checked = false;
    var checkbox_value = $(this).next().val();
    if(inArray(checkbox_value, posting_elements) || posting_elements[0]=="")
    {
        toggle_checked = true;
    }
    $(this).toggles({checkbox: $(this).next(),on:toggle_checked,text:{on: 'SHOW',off: 'HIDE'}}); 
});

$('.toggle-screening').each(function(){
    toggle_checked = false;
    var checkbox_value = $(this).next().val();
    if(inArray(checkbox_value, screening_elements) || screening_elements[0]=="")
    {
        toggle_checked = true;
    }
    $(this).toggles({checkbox: $(this).next(),on:toggle_checked}); 
});

$('.toggle-qualification').each(function(){
    toggle_checked = false;
    var checkbox_value = $(this).next().val();
    if(inArray(checkbox_value, qualification_elements) || qualification_elements[0]=="")
    {
        toggle_checked = true;
    }
    $(this).toggles({checkbox: $(this).next(),on:toggle_checked,text:{on: 'YES',off: 'NO'}}); 
});
$(".nav-tabs a").click(function(){
    $(this).tab('show');
});

if(document.URL.match('question_tab'))
{
    $('a[href="#question_tab"]').tab('show');
}
else if(document.URL.match('interview_call_tab'))
{
    $('a[href="#interview_call_tab"]').tab('show');
}
else if(document.URL.match('structured_interview_tab'))
{
    $('a[href="#structured_interview_tab"]').tab('show');
}

setTimeout(function(){
    $('#industry').selectivity({
        items: JSON.parse(<?=$industries?>),
        multiple: true,
        placeholder: 'Type to search a city',
        value:'<?=isset($profile->industry_ids) ? $profile->industry_ids : ''?>'.split(',')
    });
    $('#job_history_category').selectivity({
        items: JSON.parse(<?=$job_history_categories?>),
        multiple: true,
        placeholder: 'Type to search a city',
        value:'<?=isset($profile->job_history_category_ids) ? $profile->job_history_category_ids : ''?>'.split(',')
    });
    $('#nationality').selectivity({
        items: JSON.parse(<?=$nationalities?>),
        multiple: true,
        placeholder: 'Type to search a city',
        value:'<?=isset($profile->nationality_ids) ? $profile->nationality_ids : ''?>'.split(',')
    });
    $('#gender').selectivity({
        items: [{id:"male",text:"Male"},{id:"female",text:"Female"}],
        multiple: true,
        placeholder: 'Type to search a city',
        value:'<?=isset($profile->genders) ? $profile->genders : ''?>'.split(',')
    });

    $('#required_language').selectivity({
        items: JSON.parse(<?=$languages?>),
        multiple: true,
        placeholder: 'Type to search a city',
        value:'<?=isset($profile->required_language_ids) ? $profile->required_language_ids : ''?>'.split(',')
    });

    $('#work_environment').selectivity({
        items: JSON.parse(<?=$work_environments?>),
        multiple: true,
        placeholder: 'Type to search a city',
        value:'<?=isset($profile->work_environment_ids) ? $profile->work_environment_ids : ''?>'.split(',')
    });

    $('#mobility').selectivity({
        items: JSON.parse(<?=$mobilities?>),
        multiple: true,
        placeholder: 'Type to search a city',
        value:'<?=isset($profile->mobility_ids) ? $profile->mobility_ids : ''?>'.split(',')
    });

    $('#customer_competency').selectivity({
        items: JSON.parse(<?=$customer_competencies?>),
        multiple: true,
        placeholder: 'Type to search a city',
        value:'<?=isset($profile->competency_ids) ? $profile->competency_ids : ''?>'.split(',')
    });

    $('#people_competency').selectivity({
        items: JSON.parse(<?=$people_competencies?>),
        multiple: true,
        placeholder: 'Type to search a city',
        value:'<?=isset($profile->competency_ids) ? $profile->competency_ids : ''?>'.split(',')
    });

    $('#business_competency').selectivity({
        items: JSON.parse(<?=$business_competencies?>),
        multiple: true,
        placeholder: 'Type to search a city',
        value:'<?=isset($profile->competency_ids) ? $profile->competency_ids : ''?>'.split(',')
    });

    $('#self_management_competency').selectivity({
        items: JSON.parse(<?=$self_management_competencies?>),
        multiple: true,
        placeholder: 'Type to search a city',
        value:'<?=isset($profile->competency_ids) ? $profile->competency_ids : ''?>'.split(',')
    });

    $('#behavioral_competency').selectivity({
        items: JSON.parse(<?=$behavioral_competencies?>),
        multiple: true,
        placeholder: 'Type to search a city',
        value:'<?=isset($profile->competency_ids) ? $profile->competency_ids : ''?>'.split(',')
    });


    $('#driving_license_country').selectivity({
        items: JSON.parse(<?=$countries?>),
        multiple: true,
        placeholder: 'Type to search a city',
        value:'<?=isset($profile->driving_license_country_ids) ? $profile->driving_license_country_ids : ''?>'.split(',')
    });

    $('#position_activity_ids').selectivity({
        items: JSON.parse(<?=$position_activities?>),
        multiple: true,
        placeholder: 'Type to search a city',
        value:'<?=isset($profile->position_activity_ids) ? $profile->position_activity_ids : ''?>'.split(',')
    });

    $('#learning_resource').selectivity({
        items: JSON.parse(<?=$learning_resources?>),
        multiple: true,
        placeholder: 'Type to search a city',
        value:'<?=isset($profile->learning_resource_ids) ? $profile->learning_resource_ids : ''?>'.split(',')
    });

    $('#soft_skill_type').selectivity({
        items: JSON.parse(<?=$soft_skill_types?>),
        multiple: true,
        placeholder: 'Type to search a city',
        value:'<?=isset($profile->soft_skill_type_ids) ? $profile->soft_skill_type_ids : ''?>'.split(',')
    });

    $('#skills').selectivity({
        items: JSON.parse(<?=$skill_types?>),
        multiple: true,
        placeholder: 'Type to search a city',
        value:'<?=isset($profile->skills) ? $profile->skills : ''?>'.split(',')
    });

},400);

$('.select_all_options').change(function(){
    var thisElement = $('#'+$(this).prev().prev().attr('id'));
    if($(this).is(':checked')){

        var values = thisElement.selectivity('value');
        thisElement.selectivity('open');
        $('.selectivity-results-container').find('.selectivity-result-item').each(function(index, el) {
            values += ','+$(this).attr('data-item-id');
        });
        thisElement.selectivity('close');
        values = RemoveTrailingComma(values);
        $(thisElement).selectivity('value',values.split(','));
    }
    else
        $(thisElement).selectivity('value',[]);

});

}); 

$(window).load(function(){
    $('.btn-save-job-profile').removeClass('hidden')
});
</script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<script type="text/javascript">
$(function() {
    $("#close_date").datepicker({
      changeMonth: true,
      changeYear: true,
      dateFormat: 'yy-mm-dd'
  });
});
</script>
<script type="text/javascript" src="//cdn.tinymce.com/4/tinymce.min.js"></script>
<script type="text/javascript">

tinyMCE.init({
    selector: '#job_description',
    toolbar1: 'insertfile undo redo | styleselect | sizeselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | fontsizeselect | link image',
    fontsize_formats: "8px 9px 10px 11px 12px 13px 14px 15px 16px 17px 18px 24px 36px",
    height: 200,
});
tinyMCE.init({
    selector: '#job_duties',
    toolbar1: 'insertfile undo redo | styleselect | sizeselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | fontsizeselect | link image',
    fontsize_formats: "8px 9px 10px 11px 12px 13px 14px 15px 16px 17px 18px 24px 36px",
    height: 200,
});
// initMCEexact("#job_description");
// initMCEexact("#job_duties");

// function initMCEexact(e){
//   tinyMCE.init({
//     selector: e,
//     height: 200,
//   });
// }

</script>