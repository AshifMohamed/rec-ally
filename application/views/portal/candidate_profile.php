<?php $this->load->view('partial/portal_header.php'); ?>
<?php $this->load->view('partial/portal_sidebar.php'); ?>
<?php $this->load->view('partial/portal_breadcrumbs.php'); ?>
<!--BEGIN CONTENT-->
                <div class="page-content">
                    <div id="tab-general">
                        <div class="row mbl">
                            <div class="col-lg-9 block-space">
                            	<input type="hidden" id="candidate_profile_id" value="<?=isset($profile->candidate_profile_id) ? $profile->candidate_profile_id : 0?>"/>
                                <div class="panel">
                                    <div class="panel-body">
                                        <div class="row">
                                           <div class="col-md-12 col-sm-12 left-padding right-padding">
												<div class="col-md-3 col-sm-3 text-center ">
													<img class="img-responsive pro-img" src="<?=(!empty($profile->profile_pic_name)) ? base_url().'uploads/candidate_profiles/'.$profile->profile_pic_name : base_url().'assets/portal/images/avatar.png'?>">	
												</div>
												<div class="col-md-4 col-sm-4">
													<img class="img-responsive pro-img" src="<?=(!empty($profile->portrait_pic_name)) ? base_url().'uploads/candidate_profiles/'.$profile->portrait_pic_name : base_url().'assets/portal/images/ava-big.png'?>">
												</div>
												<div class="col-md-4 col-sm-4 section-content"> 
													<h4 ><span id="cn_first_name"><?=isset($profile->first_name) ? $profile->first_name.'</span> <span id="cn_last_name">'.$profile->last_name : ''?></span></h4>
													<p><b>Experience : </b> <span id="cn_experience"><?=!empty($experiences) ? $experiences[count($experiences) - 1]->position : '-'?></span> </p>
													<p><b>Address : </b><?=!empty($address) ? '<span id="cn_building_no">'.$address->building_no.'</span> <span id="cn_building_name">'.$address->building_name.'</span> <span id="cn_city">'.$address->city.'</span> <span id="cn_street">'.$address->street.'</span> <span id="cn_country">'.$address->country.'</span>' : '-'?></p>
													<p><b>Mobile</b> <span id="cn_mobile"><?=isset($contact->mobile) ? $contact->mobile : '-'?></span></p>
													<p><b>Email</b> <span id="cn_email"><?=isset($contact->email)? $contact->email :'-'?></span></p>
													<p class=""> <b>Date Of Birth : </b> <span id="cn_date_of_birth"><?=isset($profile->date_of_birth)? $profile->date_of_birth :'-'?></span> <?=isset($profile->date_of_birth)? ' <b>( '.get_age_by_date($profile->date_of_birth).'<sup> years </sup>)</b>' :''?></p>
													<p class="hidden"> <b>Nationality : </b> <span id="cn_nationality"><?=isset($profile->nationality)? $profile->nationality :''?></span></p>
													<p class="hidden"> <b>Passport Number : </b>  <span id="cn_passport_number"><?=isset($profile->passport_number)? $profile->passport_number :''?></span></p>
													<p class="hidden"><b>Gender : </b> <span id="cn_gender"><?=isset($profile->gender)? $profile->gender :'-'?></span></p>
													<p  class="hidden"><b>Marital Status : </b> <span id="cn_maritial_status"><?=isset($profile->status)? $profile->status :'-'?></span></p>
													<p class="hidden"><b>Number of Dependants : </b> <span id="cn_number_of_dependants"><?=isset($profile->number_of_dependants)? $profile->number_of_dependants :'-'?></span></p>
													<p class="hidden"><b>Visa Status : </b> <span id="cn_visa_status"><?=isset($profile->type)? $profile->type :'-'?></span></p>
													<p class="hidden"><b>Expiration Date : </b>  <span id="cn_visa_expiration_date"><?=isset($profile->visa_expiration_date)? $profile->visa_expiration_date :'-'?></span></p>
													<p class=""><b>Driving License Countries : </b>  <span id="cn_driving_license_countries"><?php $value=''; foreach ($driving_license_collection as $key => $country){ $value.=$country->country.', ';}  print remove_trailing_commas($value); ?></span></p>
												</div>	
												<div class="col-md-3 col-sm-3 text-center ">
													<?php if(!empty($profile->passport_copy_name)) { ?>
													<img class="img-responsive pro-img" src="<?=base_url().'uploads/candidate_profiles/'.$profile->passport_copy_name ?>">	
													<?php } ?>
												</div>												
												<div class="edit-delete">
													<ul><li><button class="edit-btn edit-basic-profile-info" type="submit"><i class="fa fa-pencil-square-o"></i> Edit</button></li></ul>
												</div>
											</div>														
                                        </div>
											<div style="clear:both;"></div>
											  <form method="POST" id="basic_profile_info_form" name="basic_profile_info_form" action="/candidate/save_candidate_basic_profile_info" enctype="multipart/form-data">
											  	<input name="candidate_profile_id" id="candidate_profile_id" type="hidden" value="<?=isset($profile->candidate_profile_id) ? $profile->candidate_profile_id : 0?>"/>
											  	<input name="address_profile_map_id" id="address_profile_map_id" type="hidden" value="<?=!empty($address) ? $address->address_profile_map_id : 0 ?>"/>
												<div class="bottom-slider">
													<div class="col-md-6 col-sm-6 left-padding">
														<div class="form-group">
															<label for="first_name" class="control-label">
																First Name</label>
															<div class="input-icon right">
																<input name="first_name" id="first_name" placeholder="" class="form-control" type="text"></div>
														</div>
														<div style="clear:both;"></div>
														<div class="form-group">
															<label for="last_name" class="control-label">
																Last Name</label>
															<div class="input-icon right">
																<input name="last_name" id="last_name" placeholder="" class="form-control" type="text"></div>
														</div>
														<div style="clear:both;"></div>
															<div class="form-group">
																<label for="gender" class="control-label">
																Gender</label>
                                                                <select name="gender" id="gender" class="form-control">
                                                                    <option value="Male">Male</option>
                                                                    <option value="Female">Female</option>
                                                                </select>
															</div>
														<div style="clear:both;"></div>
															<div class="form-group">
																<label for="date_of_birth" class="control-label">
																D.O.B</label>
																		<input id="date_of_birth" name="date_of_birth" placeholder="" class="form-control" type="text">
															</div>
														<div style="clear:both;"></div>
															 <div class="form-group">
																		<label for="maritial_status" class="control-label">
																		Maritial Status</label>
																		<select name="maritial_status" id="maritial_status" class="form-control">
																			<option value="0">Please select</option>
																			<?php 
		                                                                    foreach ($maritial_statuses as $key => $maritial_status) { ?>
		                                                                    	<option value="<?=$maritial_status->maritial_status_id?>"><?=$maritial_status->status?></option>
		                                                                    <?php } ?>	
																		</select>
																	</div>
														<div style="clear:both;"></div>
															 <div class="form-group">
																		<label for="number_of_dependants" class="control-label">
																		Number of Dependants</label>
																		 <select name="number_of_dependants" id="number_of_dependants" class="form-control">
		                                                                    <option value="">Please Select</option>
		                                                                    <option value="0">0</option>
		                                                                    <option value="0-2">0-2</option>
		                                                                    <option value="More than 2">More than 2</option>
		                                                                </select>
																	</div>
														<div style="clear:both;"></div>
															 <div class="form-group">
																		<label for="visa_status" class="control-label">
																		Visa Status</label>
																		<select name="visa_status" id="visa_status" class="form-control">
																			<option value="0">Please select</option>
																			<?php 
		                                                                    foreach ($visa_statuses as $key => $visa_status) { ?>
		                                                                    	<option value="<?=$visa_status->visa_status_id?>"><?=$visa_status->type?></option>
		                                                                    <?php } ?>	
																		</select>
																	</div>
														<div style="clear:both;"></div>
															 <div class="form-group">
																		<label for="visa_expiration_date" class="control-label">
																		Visa Expiration Date</label>
																		<input id="visa_expiration_date" name="visa_expiration_date" placeholder="" class="form-control" type="text">
																	</div>
														<div style="clear:both;"></div>
														<div class="form-group">
															<label for="profile_pic" class="control-label">
																Profile Picture</label>
															<div class="form-group">
															<input id="profile_pic" name="profile_pic" placeholder="Inlcude some file" type="file"></div>
														</div>
														<div style="clear:both;"></div>
														<div class="form-group">
															<label for="portrait_pic" class="control-label">
																Full Body Size Picture</label>
															<div class="form-group">
															<input id="portrait_pic" name="portrait_pic" placeholder="Inlcude some file" type="file"></div>
														</div>
														<div style="clear:both;"></div>
														<div class="form-group">
															<label for="passport_copy" class="control-label">
																Passport Copy</label>
															<div class="form-group">
															<input id="passport_copy" name="passport_copy" placeholder="Passport Copy" type="file"></div>
														</div>
														<div style="clear:both;"></div>
													</div>
													<div class="col-md-6 col-sm-6 left-padding">
															<div class="form-group">
															<label for="passport_number" class="control-label">
																Passport Number</label>
															<div class="input-icon right">
																<input name="passport_number" id="passport_number" placeholder="" class="form-control" type="text"></div>
														</div>
															<div class="form-group">
                                                               <div class="input-icon right">
																   <div class="form-group">
																			<label for="building_no" class="control-label">
																		Building No</label>
																			<input id="building_no" name="building_no" placeholder="" class="form-control" type="text">
																	
																	</div>	
																	<div class="form-group">
																			<label for="building_name" class="control-label">
																		Building Name</label>
																			<input id="building_name" name="building_name" placeholder="" class="form-control" type="text">
																	
																	</div>	
																	 <div class="form-group">
																		<label for="street" class="control-label">
																Street</label>
																	<input id="street" name="street" placeholder="" class="form-control" type="text">
																	</div>
																	 <div class="form-group">
																<label for="city" class="control-label">
																City</label>
																	<select name="city" id="city" class="form-control">
																		<option value="0">Please select</option>
																		<?php 
	                                                                    foreach ($cities as $key => $city) { ?>
	                                                                    	<option value="<?=$city->city_id?>"><?=$city->city?></option>
	                                                                    <?php } ?>	
																	</select>
																	</div>
																	 <div class="form-group">
																		<label for="country" class="control-label">
																		Country</label>
																		<select name="country" id="country" class="form-control">
																			<option value="0">Please select</option>
																			<?php 
		                                                                    foreach ($countries as $key => $country) { ?>
		                                                                    	<option value="<?=$country->country_id?>"><?=$country->country?></option>
		                                                                    <?php } ?>	
																		</select>
																	</div>
																</div>
															</div>
														<div style="clear:both;"></div>
														<div class="form-group">
															<label for="nationality" class="control-label">
																Nationality</label>
																<select id="nationality" name="nationality" class="form-control">
                                                                    <option value="0">Please select</option>
																		<?php 
	                                                                    foreach ($nationalities as $key => $nationality) { ?>
	                                                                    	<option value="<?=$nationality->nationality_id?>"><?=$nationality->nationality?></option>
	                                                                    <?php } ?>
                                                                </select>
														</div>
														<div style="clear:both;"></div>
														<div class="form-group">
															<label for="driving_license" class="control-label">
																Driving License Valid Countries</label>
																<span>(Multiple options can be selected)</span>
															<div class="driving_license_country">
																<?php foreach ($countries as $key => $country) { ?>
		                                                                <input name="driving_license_country[]" id="driving_license_country" type="checkbox" value="<?=$country->country_id?>" <?=in_array($country->country_id, $selected_driving_license_countries) ? 'checked ' :''?> /> <span><?=$country->country?></span><br>      
		                                                        <?php } ?>	
																
															</div>
														</div>
														<div style="clear:both;"></div>
													</div>
													<div class="form-group pull-right">
															<label class="control-label col-md-2 col-sm-2 col-xs-12"></label>
															<button class="info-save btn btn-info" id="save_basic_profile_info" name="save_basic_profile_info">Save</button>&nbsp
															<button class="btn btn-danger cancel-btn" type="button">Cancel</button>
													</div>
													<div style="clear:both;"></div>
												</div>
											  </form>	
                                    </div>
                                </div>
								<!-- divider -->
                                <div class="panel">
                                    <div class="panel-body">
                                        <div class="row">
                                           <div class="col-md-12 col-sm-12">
												<div class="col-md-8 col-sm-8 left-padding section-content">
													<h3>Contact Information</h3>
													<p><b>Email : </b><span class="cn_email"><?=isset($contact->email)? $contact->email :''?></span></p>
													<p><b>Secondary Email : </b><span class="cn_secondary_email"><?=isset($contact->secondary_email)? $contact->secondary_email :''?></span></p>
													<p><b>Mobile : </b><span class="cn_mobile"><?=isset($contact->mobile)? $contact->mobile :''?></span></p>
													<p><b>Skype ID : </b> <span class="cn_skype_id"><?=isset($contact->skype)? $contact->skype :''?></span></p>
													<p><b>LinkedIn : </b><a target="_blank" href="<?=isset($contact->linkedin)?prep_url($contact->linkedin):'#';?>"><span class="cn_linkedin"><?=isset($contact->linkedin)? $contact->linkedin :''?></span></a></p>
													<p><b>Website : </b><a target="_blank" href="<?=isset($contact->website)?prep_url($contact->website):'#';?>"><span class="cn_website"><?=isset($contact->website)? $contact->website :''?></span></a></p>
													<p><b>Preferred Method : </b> <span class="cn_preffered_contact_method"><?=!empty($profile->preferred_contact_method)? ucfirst(str_replace('_', ' ', $profile->preferred_contact_method)) :''?></span></p>
												</div>													
												<div class="edit-delete text-right pull-right">
													<ul>
														<li>
															<button class="edit-btn edit-contact-info" type="submit"><i class="fa fa-pencil-square-o"></i> Edit</button>
														</li>
													</ul>
												</div>
											</div>														
                                        </div>
											<div style="clear:both;"></div>	
											<form method="POST" id="profile_contact_info_form" name="profile_contact_info_form" action="/candidate/save_candidate_contact_info">
												<input type="hidden" value="<?=isset($contact->contact_profile_map_id)? $contact->contact_profile_map_id :'0'?>" id="contact_profile_map_id" name="contact_profile_map_id"  />
												<input type="hidden" value="<?=isset($contact->contact_id)? $contact->contact_id :'0'?>" id="contact_id" name="contact_id"  />
												<div class="bottom-slider">
													<div class="col-md-8 col-sm-8 left-padding">
														<div class="form-group">
															<label for="email" class="control-label">
																Email Address</label>
															<div class="input-icon right">
																<input id="email" name="email" type="text" placeholder="" class="form-control"></div>
														</div>
														<div style="clear:both;"></div>
														<div class="form-group">
															<label for="secondary_email" class="control-label">
																Secondary address</label>
															<div class="input-icon right">
																<input id="secondary_email" name="secondary_email" type="text" placeholder="" class="form-control">
															</div>
														</div>
														<div class="form-group">
															<label for="mobile" class="control-label">
																Phone Number</label>
															<div class="row input-size">
																	<div class="col-xs-4"> 
																		<input id="country_code" name="country_code" placeholder="" class="form-control" type="text"></div>
																		<div class="col-xs-4">
																		<input id="network_code" name="network_code" placeholder="" class="form-control" type="text">
																		</div>
																		<div class="col-xs-4">
																		<input id="mobile" name="mobile" placeholder="" class="form-control" type="text">
																		</div>
																		<span id="err_country_code" class="error col-xs-4" hidden>Error</span>
																		<span id="err_network_code" class="error col-xs-4" hidden>Error</span>
																		<span id="err_mobile" class="error col-xs-4" hidden>Error</span>
															</div>															
														<div style="clear:both;"></div>
														</div>
														<div style="clear:both;"></div>
														<div class="form-group">
															<label for="skype" class="control-label">
																Skype account</label>
															<div class="input-icon right">
																<input id="skype" name="skype" type="text" placeholder="" class="form-control">
															</div>
														</div>
														<div style="clear:both;"></div>
														<div class="form-group">
															<label for="linkedin" class="control-label">
																LinkedIn profile</label>
															<div class="input-icon right">
																<input id="linkedin" name="linkedin" type="text" placeholder="" class="form-control">
															</div>
														</div>
														<div style="clear:both;"></div>
														<div class="form-group">
															<label for="website" class="control-label">
																Personal website</label>
															<div class="input-icon right">
																<input id="website" name="website" type="text" placeholder="" class="form-control">
															</div>
														</div>
														<div style="clear:both;"></div>
														<div class="form-group">
															<label for="preferred_contact_method" class="control-label">
																Preferred to contact you in the beginning</label>
															<div class="input-icon right">
																<select id="preferred_contact_method" name="preferred_contact_method" class="form-control">
																	<option value="By Email">By Email</option>
																	<option value="By Phone">By Phone</option>
																	<option value="By SMS & WhatApp">By SMS & WhatApp</option>
																	<option value="By Skype">By Skype</option>
																</select>
															</div>
														</div>
														<div style="clear:both;"></div>
													</div>
													<div style="clear:both;"></div>
													<div class="form-group pull-right">
															<label class="control-label col-md-2 col-sm-2 col-xs-12"></label>
															<button type="button" class="info-save  btn btn-info" id="btn_save_profile_contact_info">Save</button>&nbsp
															<button class="btn btn-danger cancel-btn" type="button">Cancel</button>
													</div>
												</div>
											 </form>
                                    </div>
                                </div>
								<!-- divider -->
                                <div class="panel">
                                    <div class="panel-body">
                                        <div class="row">
                                           <div class="col-md-12 col-sm-12">
												<div class="col-md-8 col-sm-8 left-padding section-content">
													<h3>About You</h3>
													<h5>What you want to tell us about your self</h5>
													<p class="cn-about-you"><?=!empty($profile->about_you)? $profile->about_you :'' ?></p>
												</div>													
												<div class="edit-delete text-right pull-right">
													<ul>
														<li>
															<button class="edit-btn edit-about-you-info" type="submit"><i class="fa fa-pencil-square-o"></i> Edit</button>
														</li>
													</ul>
												</div>
											</div>														
                                        </div>
											<div style="clear:both;"></div>
											<form method="POST" id="about_you_form" name="about_you_form" action="/candidate/save_about_you_info">
												<div class="bottom-slider">
													<div class="col-md-8 col-sm-8 left-padding">
														<div class="form-group">
															<label for="about_you" class="control-label">
																What you want to tell about you</label>
															<div class="input-icon right">
																<textarea id="about_you" name="about_you" class="form-control" required></textarea>
															</div>
															<span id="err_about_you" class="error" hidden>Error</span>
														</div>
														<div style="clear:both;"></div>
													</div>
													<div style="clear:both;"></div>
													<div class="form-group pull-right">
															<label class="control-label col-md-2 col-sm-2 col-xs-12"></label>
															<button class="info-save btn btn-info" id="btn_save_about_you">Save</button>&nbsp
															<button class="btn btn-danger cancel-btn" type="button">Cancel</button>
													</div>
												</div>
											</form>
                                    </div>
                                </div>
                                <!-- divicer -->
                                <div class="panel">
                                    <div class="panel-body">
                                        <div class="row">
                                           <div class="col-md-12 col-sm-12">
												<div class="col-md-8 col-sm-8 left-padding section-content">
													<h3>Salary and Notice Period</h3>
													<p><b>Current : </b> <span class="cn-current-salary"><?=isset($salary_notice_period->current_salary) ? $salary_notice_period->current_salary : ''?></span></p>
													<p><b>Target : </b> <span class="cn-expected-salary"><?=isset($salary_notice_period->expected_salary) ? $salary_notice_period->expected_salary : ''?></span></p>
													<p><b>Notice Period : </b><span class="cn-notice-period"><?=isset($salary_notice_period->period) ? $salary_notice_period->period : ''?></span></p>
												</div>													
												<div class="edit-delete text-right pull-right">
													<ul>
														<li>
															<button class="edit-btn edit-salary-notice-period-info" type="submit"><i class="fa fa-pencil-square-o"></i> Edit</button>
														</li>
													</ul>
												</div>
											</div>														
                                        </div>
											<div style="clear:both;"></div>
											  <form method="POST" id="salary_notice_period_form" name="salary_notice_period_form" action="/candidate/save_salary_notice_period_info">
											  	<input type="hidden" name="candidate_salary_notice_period_id" id="candidate_salary_notice_period_id" value="<?=isset($salary_notice_period->candidate_salary_notice_period_id)? $salary_notice_period->candidate_salary_notice_period_id :'0'?>" />
												<div class="bottom-slider">
													<div class="col-md-8 col-sm-8 left-padding">
														<div class="form-group">
															<label for="current_salary" class="control-label">
																Current Salary</label>
															<div class="input-icon right">
																<select name="current_salary" id="current_salary" class="form-control">
																	<option value="0">Please select</option>
																		<?php 
	                                                                    foreach ($salary_ranges as $key => $salary_range) { ?>
	                                                                    	<option value="<?=$salary_range->salary_range_id?>"><?=$salary_range->salary_range?></option>
	                                                                    <?php } ?>	
																	</select>
															</div>
														</div>
														<div style="clear:both;"></div>
														<div class="form-group">
															<label for="expected_salary" class="control-label">
																Target Salary</label>
															<div class="input-icon right">
																<select id="expected_salary" name="expected_salary" class="form-control">
																	<option value="0">Please select</option>
																		<?php
	                                                                    foreach ($salary_ranges as $key => $salary_range) { ?>
	                                                                    	<option value="<?=$salary_range->salary_range_id?>"><?=$salary_range->salary_range?></option>
	                                                                    <?php } ?>	
																	</select>
															</div>
														</div>
														<div style="clear:both;"></div>
														<div class="form-group">
															<label for="inputSubject" class="control-label">
																What is your notice period</label>
															<div class="input-icon right">
																<select id="notice_period" name="notice_period" class="form-control">
																	<option value="0">Please select</option>
																		<?php 
	                                                                    foreach ($notice_periods as $key => $notice_period) { ?>
	                                                                    	<option value="<?=$notice_period->notice_period_id?>"><?=$notice_period->period?></option>
	                                                                    <?php } ?>	
																	</select>
															</div>
														</div>
														<div style="clear:both;"></div>
													</div>
													<div style="clear:both;"></div>
													<div class="form-group pull-right">
															<label class="control-label col-md-2 col-sm-2 col-xs-12"></label>
															<button class="info-save  btn btn-info save-candidate-info" id="save_salary_notice_period">Save</button>&nbsp
															<button class="btn btn-danger cancel-btn" type="button">Cancel</button>
													</div>
												</div>
											 </form>
                                    </div>
                                </div>
                                <!-- divider -->
                                <div class="panel">
                                    <div class="panel-body">
                                        <div class="row">
                                           <div class="col-md-12 col-sm-12">
												<div class="col-md-8 col-sm-8 left-padding section-content">
													<h3>Job Target</h3>
													<p><b>Position Level : </b><span class="cn-career-level"><?=isset($profile->career_level) ? $profile->career_level : ''?></span></p>
													<p><b>Department : </b> <span><?=isset($profile->department) ? $profile->department : ''?></span></p>
													<p><b>Industry type : </b> <span><?php $value=''; foreach ($industry_collection as $key => $industry){ $value.=$industry->industry.', '?>
																					<?php } print remove_trailing_commas($value); ?></span></p>
													<p><b>Job History Families : </b> <span><?php $value=''; foreach ($job_history_collection as $key => $history_category){ $value.=$history_category->history_category.', '?>
																					<?php } print remove_trailing_commas($value); ?></span></p>
													<p><b>Soft Skill Types : </b> <span><?php $value=''; foreach ($soft_skill_collection as $key => $soft_skill_type){ $value.=$soft_skill_type->skill_type.', '?>
																					<?php } print remove_trailing_commas($value); ?></span></p>
													<p>
														<b>Competencies : </b> 
														<br/>
														<ul class="job_target_competencies">
														  <li>
														    <h6 class="">Dealing with Customers</h6>
														    	<?php $value=''; foreach ($competency_collection as $key => $competency){ if($competency->competency_type == 'customer') $value.=$competency->competency.', '?>
																<?php } !empty($value) ? print remove_trailing_commas($value) : '-'; ?>
														  </li>
														  <li>
														    <h6 class="">Dealing with People</h6>
														    <?php $value=''; foreach ($competency_collection as $key => $competency){ if($competency->competency_type == 'people') $value.=$competency->competency.', '?>
																<?php } !empty($value) ? print remove_trailing_commas($value) : '-'; ?>
														  </li>
														  <li>
														    <h6 class="">Dealing with Business</h6>
														    <?php $value=''; foreach ($competency_collection as $key => $competency){ if($competency->competency_type == 'business') $value.=$competency->competency.', '?>
																<?php } !empty($value) ? print remove_trailing_commas($value) : '-'; ?>
														  </li>
														  <li>
														    <h6 class="">Self-Management Competencies</h6>
														    <?php $value=''; foreach ($competency_collection as $key => $competency){ if($competency->competency_type == 'self_management') $value.=$competency->competency.', '?>
																<?php } !empty($value) ? print remove_trailing_commas($value) : '-'; ?>
														  </li>
														  <li>
														    <h6 class="">Behavioral Competencies</h6>
														    <?php $value=''; foreach ($competency_collection as $key => $competency){ if($competency->competency_type == 'behavioral') $value.=$competency->competency.', '?>
																<?php } !empty($value) ? print remove_trailing_commas($value) : '-'; ?>
														  </li>
														</ul>
													</p>
												</div>													
												<div class="edit-delete text-right pull-right">
													<ul>
														<li>
															<button class="edit-btn edit-job-target" type="submit"><i class="fa fa-pencil-square-o"></i> Edit</button>
														</li>
													</ul>
												</div>
											</div>														
                                        </div>
											<div style="clear:both;"></div>
											  <form method="POST" id="job_target_form" name="job_target_form" action="/candidate/save_job_target_info">
												<div class="bottom-slider">
													<div class="col-md-8 col-sm-8 left-padding">
														<div class="form-group">
															<label for="career_level" class="control-label">
																Your Level of Position</label>
															<div class="input-icon right">
															  <select name="career_level" id="career_level" class="form-control">
                                                                    <option value="0">Please select..</option>
                                                                    <?php 
                                                                    foreach ($career_levels as $key => $level) { ?>
                                                                    	<option value="<?=$level->career_level_id?>"><?=$level->career_level?></option>
                                                                    <?php } ?>
                                                                </select>
															</div>
														</div>
														<div style="clear:both;"></div>
														<div class="form-group">
															<label for="department" class="control-label">
																In which Department you are working</label>
															<div class="input-icon right">
																<select name="department" id="department" class="form-control">
                                                                    <option value="0">Please select..</option>
                                                                    <?php 
                                                                    foreach ($departments as $key => $department) { ?>
                                                                    	<option value="<?=$department->department_id?>" <?=isset($profile->department_id) ? $profile->department_id == $department->department_id ? 'selected' : '' : ''?>><?=$department->department?></option>
                                                                    <?php } ?>
                                                                </select>
															</div>
														</div>
														<div style="clear:both;"></div>
														<div class="form-group">
															<label for="industry" class="control-label">
																In Which Industry are you In</label>
															<div class="input-icon right" data-validate-max="3">
																  <?php 
                                                                    foreach ($industries as $key => $industry) { ?>
                                                                   		<label class="checkbox1">
                                                                    		<input name="industry[]" id="industry" type="checkbox" value="<?=$industry->industry_id?>" <?=in_array($industry->industry_id, $selected_industries) ? 'checked ' :''?>> <span><?=$industry->industry?></span><br>      
                                                                   		</label>
                                                                  <?php } ?>
                                                                 
															</div>
														</div>
														<div style="clear:both;"></div>
														<div class="form-group">
															<label for="inputSubject" class="control-label">
																Your Job history related to which families</label>
															<div class="input-icon right" data-validate-max="3">
															 <?php 
                                                                    foreach ($job_history_categories as $key => $category) { ?>
                                                                    	<label class="checkbox1">
                                                                    		<input name="job_history_category[]" id="job_history_category" type="checkbox" value="<?=$category->job_history_category_id?>" <?=in_array($category->job_history_category_id, $selected_job_history_categories) ? 'checked ' :''?>> <span><?=$category->history_category?></span><br>
                                                                    	</label>
                                                             <?php } ?>
															</div>
														</div>
														<div style="clear:both;"></div>
														<div class="form-group">
															<label for="inputSubject" class="control-label">
																Competencies dealing with customer </label>
															<div class="input-icon right" data-validate-max="3">
															  <?php 
                                                                    foreach ($competencies as $key => $competency) {
                                                                    	if($competency->competency_type  == 'customer'){
                                                               ?>
                                                               			<label class="checkbox1">
                                                                    		<input name="customer_competency[]" type="checkbox" value="<?=$competency->competency_id?>" <?=in_array($competency->competency_id, $selected_competencies) ? 'checked ' :''?>> <span><?=$competency->competency?></span><br>
                                                            			</label>
                                                             <?php }} ?>
															</div>
														</div> 
														<div style="clear:both;"></div>
														<div class="form-group">
															<label for="inputSubject" class="control-label">
																Competencies dealing with people </label>
															<div class="input-icon right" data-validate-max="3">
															  <?php 
                                                                    foreach ($competencies as $key => $competency) {
                                                                    	if($competency->competency_type  == 'people'){
                                                               ?>
                                                                    	<label class="checkbox1">
                                                                    		<input name="people_competency[]" type="checkbox" value="<?=$competency->competency_id?>" <?=in_array($competency->competency_id, $selected_competencies) ? 'checked ' :''?>> <span><?=$competency->competency?></span><br>
                                                             			</label>
                                                             <?php }} ?>
		 													</div>
														</div>
														<div style="clear:both;"></div>
														<div class="form-group">
															<label for="inputSubject" class="control-label">
																Competencies dealing with Business </label>
															<div class="input-icon right" data-validate-max="3">
															 <?php 
                                                                    foreach ($competencies as $key => $competency) {
                                                                    	if($competency->competency_type  == 'business'){
                                                               ?>
                                                               			<label class="checkbox1">
                                                                    		<input name="business_competency[]" type="checkbox" value="<?=$competency->competency_id?>" <?=in_array($competency->competency_id, $selected_competencies) ? 'checked ' :''?>> <span><?=$competency->competency?></span><br>
                                                             			</label>
                                                             <?php }} ?>
															</div>
														</div>
														<div style="clear:both;"></div>
														<div class="form-group">
															<label for="inputSubject" class="control-label">
																Self-Management Competencies</label>
															<div class="input-icon right" data-validate-max="3">
															 <?php 
                                                                    foreach ($competencies as $key => $competency) {
                                                                    	if($competency->competency_type  == 'self_management'){
                                                               ?>
                                                               		<label class="checkbox1">
                                                                    	<input name="self_management_competency[]" type="checkbox" value="<?=$competency->competency_id?>" <?=in_array($competency->competency_id, $selected_competencies) ? 'checked ' :''?>> <span><?=$competency->competency?></span><br>
                                                             		</label>
                                                             <?php }} ?>
															</div>
														</div>
														<div style="clear:both;"></div>
														<div class="form-group">
															<label for="inputSubject" class="control-label">
																Behavioral competencies</label>
															<div class="input-icon right" data-validate-max="3">
															 <?php 
                                                                    foreach ($competencies as $key => $competency) {
                                                                    	if($competency->competency_type == 'behavioral'){
                                                              ?>
	                                                              		<label class="checkbox1">
	                                                                    	<input name="behavioral_competency[]" type="checkbox" value="<?=$competency->competency_id?>" <?=in_array($competency->competency_id, $selected_competencies) ? 'checked ' :''?>> <span><?=$competency->competency?></span><br>
                                                             			</label>
                                                             <?php }} ?>
															</div>
														</div>
														<div style="clear:both;"></div>
														<div class="form-group">
															<label for="inputSubject" class="control-label">
																 What is your soft Skills type </label>
															<div class="input-icon right" data-validate-max="3">
															  <?php 
                                                                    foreach ($soft_skill_types as $key => $skill) { ?>
	                                                                    <label class="checkbox1">
	                                                                    	<input name="soft_skill_type[]" type="checkbox" value="<?=$skill->soft_skill_type_id?>" <?=in_array($skill->soft_skill_type_id, $selected_soft_skill_types) ? 'checked ' :''?>> <span><?=$skill->skill_type?></span><br>
                                                             			</label>
                                                             <?php } ?>
															</div>
														</div>
														<div style="clear:both;"></div>
													</div>
													<div style="clear:both;"></div>
													<div class="form-group pull-right">
															<label class="control-label col-md-2 col-sm-2 col-xs-12"></label>
															<button class="info-save  btn btn-info save-candidate-info" id="btn_save_job_target">Save</button>&nbsp
															<button class="btn btn-danger cancel-btn" type="button">Cancel</button>
													</div>
												</div>
											 </form>
                                    </div>
                                </div>  
								<!-- divider -->
                                <div class="panel">
                                    <div class="panel-body">
                                        <div class="row">
                                        	<button class="add-btn edit-btn pull-right" type="submit"><i class="fa fa-plus"></i> Add</button>
                                           	<h3  style="padding-left: 15px;">Education</h3>                                           		
                                           		<?php foreach($educations as $key => $education) { ?>
                                           		 <div class="col-md-12 col-sm-12 seperator">
                                           			<div class="col-md-7 col-sm-7 left-padding section-content">
														<input class="cn_degree_id" name="degree_id" value="<?=$education->degree_id?>" type="hidden" />
														<p><b>Degree/Education : </b><span class="cn_degree_type"><?=$education->degree_type?></span></p>
														<p><b>Education Faculty : </b> <span class="cn_education_faculty"><?=$education->faculty?></span></p>
														<p><b>University : </b> <span class="cn_university"><?=$education->university?></span></p>
														<p><b>Location : </b> <span class="cn_country"><?=$education->country?></span></p>
														<p><b>Completion date : </b> <span class="cn_completion_date"><?=$education->completion_date?></span></p>
														<p><b>Grade : </b> <span class="cn_grade"><?=$education->grade?></span></p>
													</div>	
													<div class="edit-delete text-right pull-right">
														<ul>
															<li>
																<button class="edit-btn edit-education" type="submit"><i class="fa fa-pencil-square-o"></i> Edit</button>
															</li>
															<li>
																<a href="<?=base_url()?>candidate/delete_cv_item?section=education&id=<?=$education->degree_id?>" class="delete_cv_item"><button class=" dlt-btn delete-education" type="submit"><i class="fa fa-trash-o"></i> Delete</button></a>
															</li>
														</ul>
													</div>
												</div>	
													<?php } ?>
													<div class="col-md-12 col-sm-12">
														<?=empty($educations)? '' : ''?>	
													</div>											
                                        </div>
											<div style="clear:both;"></div>
											 <form method="POST" id="education_form" name="education_form" action="/candidate/save_education_info">
											 	<input id="degree_id" name="degree_id" value="0" type="hidden" />
												<div class="bottom-slider">
													<div class="col-md-8 col-sm-8 left-padding">
														<div class="form-group">
															<label for="degree" class="control-label">
																Education Faculty</label>
															<div class="input-icon right">
																<select id="education_faculty" name="education_faculty" class="form-control">
                                                                    <option value="0">Please select..</option>
                                                                    <?php 
                                                                    foreach ($education_faculties as $key => $faculty) { ?>
                                                                    	<option value="<?=$faculty->education_faculty_id?>"><?=$faculty->faculty?></option>
                                                                    <?php } ?>
                                                                </select>
															</div>
														</div>
														<div class="form-group">
															<label for="degree" class="control-label">
																Degree</label>
															<div class="input-icon right">
																<select id="degree_type" name="degree_type" class="form-control">
                                                                    <option value="0">Please select..</option>
                                                                    <?php 
                                                                    foreach ($degree_types as $key => $type) { ?>
                                                                    	<option value="<?=$type->degree_type_id?>"><?=$type->type?></option>
                                                                    <?php } ?>
                                                                </select>
															</div>
														</div>
														<div style="clear:both;"></div>
														<div class="form-group">
															<label for="university" class="control-label">
																University</label>
															<div class="input-icon right">
																<input id="university" name	="university" type="text" placeholder="" class="form-control">
															</div>
															<div style="clear:both;"></div>
														</div>
														<div class="form-group">
															<label for="location" class="control-label">
																Location</label>
															<div class="input-icon right">
																  <select name="country" id="country" class="form-control">
                                                                    <option value="0">Please select..</option>
                                                                    <?php 
                                                                    foreach ($countries as $key => $country) { ?>
                                                                    	<option value="<?=$country->country_id?>"><?=$country->country?></option>
                                                                    <?php } ?>
                                                                </select>
																  </select>
															</div>
															<div style="clear:both;"></div>
														</div>
														<div class="form-group">
															<label for="completion_date" class="control-label">
																Completion date </label>
															<div class="input-icon right">
																	<input id="completion_date" name="completion_date" placeholder="" class="form-control" type="text">
															</div>
															<div style="clear:both;"></div>
														</div>
														<div class="form-group">
															<label for="grade" class="control-label">
																Grade</label>
															<div class="input-icon right">
																<input id="grade" name="grade" placeholder="" class="form-control" type="text">
															</div>
															<div style="clear:both;"></div>
														</div>
													<div style="clear:both;"></div>
												</div>
												<div style="clear:both;"></div>
												<div class="form-group pull-right">
														<label class="control-label col-md-2 col-sm-2 col-xs-12"></label>
														<button class="info-save btn btn-info save-candidate-info" id="save_education">Save</button>&nbsp
														<button class="btn btn-danger cancel-btn" type="button">Cancel</button>
												</div>
											</div>
										 </form>
                                    </div>
                                </div>	                              
								<!-- divider -->
                                <div class="panel">
                                    <div class="panel-body">
                                        <div class="row">
                                        	<button class="add-btn edit-btn pull-right" type="submit"><i class="fa fa-plus"></i> Add</button>
                                        	<h3 style="padding-left:15px;">Work Experience</h3>
                                        	<?php foreach($experiences as $key => $experience) { ?>
                                            <div class="col-md-12 col-sm-12 seperator">
												<div class="col-md-8 col-sm-8 left-padding section-content">
														<p><b>Position : </b><span class="cn-position"> <?=$experience->position?></span></p>
														<p><b>Company : </b><span class="cn-company-name"><?=$experience->company_name?></span> <span class="cn-country"> <?=$experience->country?></span></p>
														<p><b>Period : </b><span class="cn-start-date"><?=$experience->start_date?> </span> to <span class="cn-end-date"><?=$experience->end_date?></span></p>
														<p><b>Description : </b><span class="cn-job-description"><?=$experience->job_description?></span></p>
														<p><b>Experience Level : </b><span class="cn-experience-level"><?=$experience->experience_level?></span></p>
														<p><b>Website : </b><a target="_blank" href="<?=prep_url($experience->company_website);?>"><span class="cn-company-website"><?=$experience->company_website?></span></a></p>
														<p><b>Industry : </b><span class="cn-industry"><?=$experience->industry?></span></p>
														<p><b>Reference Name : </b><span class="cn-reference-name"><?=$experience->reference_name?></span></p>
														<p><b>Reference Position : </b><span class="cn-reference-position"><?=$experience->reference_position?></span></p>
														<p><b>Reference Mobile : </b><span class="cn-reference-mobile"><?=$experience->reference_mobile?></span></p>
														<input class="cn-experience-id" type="hidden" value="<?=$experience->experience_id?>">
											  			<input class="cn-experience-reference-id" type="hidden" value="<?=$experience->experience_reference_id?>">
												</div>													
												<div class="edit-delete text-right pull-right">
													<ul>
														<li>
															<button class="edit-btn edit-experience" type="submit"><i class="fa fa-pencil-square-o"></i> Edit</button>
														</li>
														<li>
															<a href="<?=base_url()?>candidate/delete_cv_item?section=work_experience&id=<?=$experience->experience_id?>" class="delete_cv_item"><button class=" dlt-btn delete-education" type="submit"><i class="fa fa-trash-o"></i> Delete</button></a>
														</li>
													</ul>
												</div>
											</div>
											<?php } ?>
											<div class="col-md-12 col-sm-12">
												<?=empty($experiences)? '' : ''?>	
											</div>													
                                        </div>
											<div style="clear:both;"></div>
											  <form method="POST" id="experience_form" name="experience_form" action="/candidate/save_experience_info">
											  	<input id="experience_id" name="experience_id" type="hidden" value="0">
											  	<input id="experience_reference_id" name="experience_reference_id" type="hidden" value="0">
												<div class="bottom-slider">
													<div class="col-md-8 col-sm-8 left-padding">
														<div class="form-group">
															<label for="experience_level_id" class="control-label">
																Level of experience</label>
															<div class="input-icon right">
																<select id="experience_level" name="experience_level" class="form-control">
																	<option value="0">Please select..</option>
																	<?php foreach ($experience_levels as $key => $level) {?>
																		<option value="<?=$level->experience_level_id?>"><?=$level->level?></option>
																	<?php } ?>
																</select>	
															</div>
														</div>
														<div style="clear:both;"></div>
														<div class="form-group">
															<label for="position" class="control-label">
																Position</label>
															<div class="input-icon right">
																<input id="position" name="position" type="text" placeholder="" class="form-control">
															</div>
														</div>
														<div style="clear:both;"></div>
														<div class="form-group">
															<label for="company_name" class="control-label">
																Company name</label>
															<div class="input-icon right">
																<input id="company_name" name="company_name" type="text" placeholder="" class="form-control">
															</div>
														</div>	
														<div style="clear:both;"></div>
														<div class="form-group">
															<label for="company_website" class="control-label">
																Website of company</label>
															<div class="input-icon right">
																<input id="company_website" name="company_website" type="text" placeholder="" class="form-control">
															</div>
														</div>
														<div style="clear:both;"></div>
														<div class="form-group">
															<label for="location" class="control-label">
																Location</label>
															<div class="input-icon right">
																<select id="country" name="country" class="form-control">
																	<option value="0">Please select</option>
																		<?php 
	                                                                    foreach ($countries as $key => $country) { ?>
	                                                                    	<option value="<?=$country->country_id?>"><?=$country->country?></option>
	                                                                    <?php } ?>	
																</select>
															</div>
														</div>
														<div style="clear:both;"></div>
														<div class="form-group">
															<label for="industry" class="control-label">
																Company Industry</label>
															<div class="input-icon right">
																<select name="industry" id="industry" class="form-control">
																	<option value="0">Please select</option>
																		<?php 
	                                                                    foreach ($industries as $key => $industry) { ?>
	                                                                    	<option value="<?=$industry->industry_id?>"><?=$industry->industry?></option>
	                                                                    <?php } ?>	
																	</select>
															</div>
														</div>
														<div style="clear:both;"></div>
														<div class="form-group">
															<label for="job_description" class="control-label">
																Job Roles</label>
															<div class="input-icon right">
																<textarea id="job_description" name="job_description" type="text" placeholder="" class="form-control"></textarea>
															</div>
														</div>
														<div style="clear:both;"></div>
														<div class="form-group pull-left input-size time-period">
															<div class="pull-left">
																<label class="control-label">Time Period</label>
																<div class="input-icon right">
																	<input id="start_date" style="width:200px" name="start_date" placeholder="Start Date" class="form-control pull-left" type="text">
																	<span class="pull-left">-&nbsp&nbsp </span>  
																	<input id="end_date"  style="width:200px" name="end_date" placeholder="End Date" class="form-control pull-left" type="text">
																	<span class="pull-left hidden" id="lbl_currently_working_here">Present <br/><br/></span>
																	<div class="" id="currently_working_here"><input type="checkbox" id="is_current_working_here" value="1"><label for="is_current_working_here">I Currently Work Here</label></div>
																</div>
															</div>
															<div style="clear:both;"></div>
														</div>
														<div style="clear:both;"></div>
														<div class="form-group">
															<label for="reference_name" class="control-label">
																Reference Name</label>
															<div class="input-icon right">
																<input id="reference_name" name="reference_name" type="text" placeholder="" class="form-control">
															</div>
														</div>
														<div style="clear:both;"></div>
														<div class="form-group">
															<label for="position" class="control-label">
																Reference position</label>
															<div class="input-icon right">
																<input id="reference_position" name="reference_position" type="text" placeholder="" class="form-control">
															</div>
														</div>
														<div style="clear:both;"></div>
														<div class="form-group">
															<label for="mobile" class="control-label">
																Reference Mobile</label>
															<div class="input-icon right">
																<input id="reference_mobile" name="reference_mobile" type="text" placeholder="" class="form-control">
															</div>
														</div>
														<div style="clear:both;"></div>
													</div>
													<div style="clear:both;"></div>
													<div class="form-group pull-right">
															<label class="control-label col-md-2 col-sm-2 col-xs-12"></label>
															<button class="info-save  btn btn-info save-candidate-info" id="save_experience">Save</button>&nbsp
															<button class="btn btn-danger cancel-btn" type="button">Cancel</button>
													</div>
												</div>
											</form>	
                                    </div>
                                </div>
								<!-- divider -->
                                <div class="panel">
                                    <div class="panel-body">
                                        <div class="row">
                                        	<button class="add-btn edit-btn pull-right" type="submit"><i class="fa fa-plus"></i> Add</button>
                                        	<h3 style="padding-left:15px;">Professional Certification</h3>
                                        	<?php foreach($certificates as $key => $certificate) { ?>
                                           <div class="col-md-12 col-sm-12 seperator">
												<div class="col-md-8 col-sm-8 left-padding section-content">
														<input id="cn-certificate-id" class="cn-certificate-id" type="hidden" value="<?=$certificate->certificate_id?>"/>
														<p><b>Certificate Name : </b> <span class="cn-name"><?=$certificate->name?></span></p>
														<p><b>Certificate Number : </b> <span class="cn-number"><?=$certificate->number?></span></p>
														<p><b>Completion Date : </b> <span class="cn-completion-date"><?=$certificate->completion_date?></span></p>
														<p><b>Expiration Date : </b> <span class="cn-expiration-date"> <?=$certificate->expiration_date?></span></p>													
												</div>													
												<div class="edit-delete text-right pull-right">
													<ul>
														<li>
															<button class="edit-btn edit-certification" type="submit"><i class="fa fa-pencil-square-o"></i> Edit</button>
														</li>
														<li>
															<a href="<?=base_url()?>candidate/delete_cv_item?section=certification&id=<?=$certificate->certificate_id?>" class="delete_cv_item"><button class=" dlt-btn delete-education" type="submit"><i class="fa fa-trash-o"></i> Delete</button></a>
														</li>
													</ul>
												</div>
											</div>
											<?php } ?>
											<div class="col-md-12 col-sm-12">
												<?=empty($certificate)? '' : ''?>
											</div>												
                                      </div>
											<div style="clear:both;"></div>
											 <form method="POST" id="certification_form" name="certification_form" action="/candidate/save_certificate_info">
											 	<input id="certificate_id" name="certificate_id" type="hidden" value="0"/>
												<div class="bottom-slider">
													<div class="col-md-8 col-sm-8 left-padding">
														<div class="form-group">
															<label for="number" class="control-label">
																Certification Number</label>
															<div class="input-icon right">
																<input id="number" name="number" type="text" placeholder="" class="form-control">
															</div>
														</div>
														<div style="clear:both;"></div>
														<div class="form-group">
															<label for="name" class="control-label">
																Certification Name</label>
															<div class="input-icon right">
																<input id="name" name="name" type="text" placeholder="" class="form-control">
															</div>
														</div>
														<div class="form-group input-size">
															<div class="pull-left"><label for="completion_date" class="control-label">
																Completion Date</label>
															<div class="input-icon right">
																<input id="certification_completion_date" name="completion_date" placeholder="" class="form-control" type="text">
															</div>
															</div>
														<div style="clear:both;"></div>
														<br>
														<div class="form-group ">
															<div><label for="expiration_date" class="control-label">
																Expiration Date</label>
															<div class="input-icon right">
																<input id="expiration_date" name="expiration_date" placeholder="" class="form-control" type="text">
															</div>
															</div>
															
														</div>
													</div>
													<div style="clear:both;"></div>
												</div>
												<div style="clear:both;"></div>
													<div class="form-group pull-right">
															<label class="control-label col-md-2 col-sm-2 col-xs-12"></label>
															<button class="info-save  btn btn-info save-candidate-info" id="save_certification">Save</button>&nbsp
															<button class="btn btn-danger cancel-btn" type="button">Cancel</button>
													</div>
                                    	</div>
                                     </form>
                               		 </div>
                             	</div>
								<!-- divider -->
                                <div class="panel">
                                    <div class="panel-body">
                                        <div class="row">
                                        	<button class="add-btn edit-btn pull-right" type="submit"><i class="fa fa-plus"></i> Add</button>
                                        	<h3 style="padding-left:15px;">Languages</h3>
                                        	<?php foreach($language_expertise as $key => $language) { ?>
                                           	<div class="col-md-12 col-sm-12 seperator">
												<div class="col-md-8 col-sm-8 left-padding section-content">
														<p><b>Language : </b><span class="cn-language"><?=$language->language?></span></p>
														<p><b>Expertise : </b><span class="cn-expertise"><?=$language->expertise?></span></p>
														<p class="hidden"><span class="cn-language-expertise-id hidden"><?=$language->language_expertise_id?></span></p>
												</div>													
												<div class="edit-delete text-right pull-right">
													<ul>
														<li>
															<button class="edit-btn edit-language" type="submit"><i class="fa fa-pencil-square-o"></i> Edit</button>
														</li>
														<li>
															<a href="<?=base_url()?>candidate/delete_cv_item?section=language&id=<?=$language->language_expertise_id?>" class="delete_cv_item"><button class=" dlt-btn delete-education" type="submit"><i class="fa fa-trash-o"></i> Delete</button></a>
														</li>
													</ul>
												</div>
											</div>
											<?php } ?>
											<div class="col-md-12 col-sm-12">
												<?=empty($language_expertise)? '' : ''?>
											</div>															
                                        </div>
											<div style="clear:both;"></div>
											 <form method="POST" id="language_form" name="language_form" action="/candidate/save_language_info">
											 	<input id="language_expertise_id" name="language_expertise_id" value="0" type="hidden" />
												<div class="bottom-slider">
													<div class="col-md-8 col-sm-8 left-padding">
														<div class="form-group">
															<div class="pull-left"><label for="language" class="control-label">
																Language</label></div>
															<div class="input-icon right col-md-5 col-sm-4">
																<select id="language" name="language" class="form-control">
																	<option value="0">Please select..</option>
                                                                    <?php 
                                                                    foreach ($languages as $key => $language) { ?>
                                                                    	<option value="<?=$language->language_id?>"><?=$language->language?></option>
                                                                    <?php } ?>
                                                                </select>
															</div>
															<div class="input-icon right col-md-4 col-sm-4">
																<select id="expertise" name="expertise" class="form-control">
																	<option value="Beginner">Beginner</option>
																	<option value="Intermediate">Intermediate</option>
																	<option value="Expert">Expert</option>
																</select>
															</div>
														</div>
														<div style="clear:both;"></div>
													</div>
													<div style="clear:both;"></div>
													<div class="form-group pull-right">
															<label class="control-label col-md-2 col-sm-2 col-xs-12"></label>
															<button class="info-save  btn btn-info save-candidate-info" id="save_language">Save</button>&nbsp
															<button class="btn btn-danger cancel-btn" type="button">Cancel</button>
													</div>
												</div>
											</form>
                                    </div>
                                </div>
												<!-- divider -->
                                <div class="panel">
                                    <div class="panel-body">
                                        <div class="row">
                                        	<button class="add-btn edit-btn pull-right" type="submit"><i class="fa fa-plus"></i> Add</button>
                                        	<h3 style="padding-left:15px;">Membership</h3>
                                        	<?php foreach($memberships as $key => $membership) { ?>
                                          	 <div class="col-md-12 col-sm-12 seperator">
												<div class="col-md-8 col-sm-8 left-padding section-content">
														<input id="cn-membership-id" name="cn-membership-id" class="cn-membership-id"  type="hidden" value="<?=$membership->membership_id?>" />
														<p><b>Membership : </b> <span class="cn-membership"><?=$membership->membership?></span></p>
														<p><b>Organization : </b> <span class="cn-organization"><?=$membership->organization?></span></p>
														<p><b>Member Since : </b> <span class="cn-member-since"><?=$membership->member_since?></span></p>
														<p><b>Description : </b> <span class="cn-membership-description"><?=$membership->membership_description?></span></p>
												</div>													
												<div class="edit-delete text-right pull-right">
													<ul>
														<li>
															<button class="edit-btn edit-membership" type="submit"><i class="fa fa-pencil-square-o"></i> Edit</button>
														</li>
														<li>
															<a href="<?=base_url()?>candidate/delete_cv_item?section=membership&id=<?=$membership->membership_id?>" class="delete_cv_item"><button class=" dlt-btn delete-education" type="submit"><i class="fa fa-trash-o"></i> Delete</button></a>
														</li>
													</ul>
												</div>
											</div>	
											<?php } ?>
											<div class="col-md-12 col-sm-12">
												<?=empty($memberships)? '' : ''?>
											</div>														
                                        </div>
											<div style="clear:both;"></div>
											<form method="POST" id="membership_form" name="membership_form" action="/candidate/save_membership_info">
												<input id="membership_id" name="membership_id"  type="hidden" value="0"/>
												<div class="bottom-slider">
													<div class="col-md-8 col-sm-8 left-padding">
														<div class="form-group">
															<label for="membership" class="control-label">
																Membership</label>
															<div class="input-icon right">
																<input id="membership" name="membership" type="text" placeholder="" class="form-control">
															</div>
														</div>
														<div style="clear:both;"></div>
														<div class="form-group">
															<label for="organization" class="control-label">
																Organization</label>
															<div class="input-icon right">
																<input id="organization" name="organization" type="text" placeholder="" class="form-control">
															</div>
														</div>
														<div style="clear:both;"></div>
														<div class="form-group">
															<div class="pull-left"><label for="member_since" class="control-label">
																Member since:</label></div>
															<div class="input-icon right">
																<input id="member_since" name="member_since" placeholder="" class="form-control" type="text">
															</div>
														</div>
														<div style="clear:both;"></div>														
														<div class="form-group">
																<label for="membership_description" class="control-label">
																	Membership role</label>
																<div class="input-icon right">
																	<textarea id="membership_description" name="membership_description" type="text" placeholder="" class="form-control"></textarea>
																</div>
															</div>
														<div style="clear:both;"></div>
													</div>
													<div style="clear:both;"></div>
													<div class="form-group pull-right">
															<label class="control-label col-md-2 col-sm-2 col-xs-12"></label>
															<button class="info-save  btn btn-info save-candidate-info" id="save_membership">Save</button>&nbsp
															<button class="btn btn-danger cancel-btn" type="button">Cancel</button>
													</div>
												</div>
											</form>
                                    </div>
                                </div>
																				<!-- divider -->
								<div class="panel">
                                    <div class="panel-body">
                                        <div class="row">
                                        	<button class="add-btn edit-btn pull-right" type="submit"><i class="fa fa-plus"></i> Add</button>
                                        	<h3 style="padding-left:15px;">Trainings</h3>
                                        	<?php foreach($trainings as $key => $training) { ?>
                                           <div class="col-md-12 col-sm-12 seperator">
												<div class="col-md-8 col-sm-8 left-padding section-content">
														<input id="cn-training-id" class="cn-training-id" type="hidden" value="<?=$training->candidate_training_id?>"/>
														<p><b>Course Name : </b> <span class="cn-course-name"><?=$training->course_name?></span></p>
														<p><b>Center Name : </b> <span class="cn-center-name"><?=$training->center_name?></span></p>
														<p><b>Course Date : </b> <span class="cn-training-completion-date"><?=$training->course_date?></span></p>			
												</div>													
												<div class="edit-delete text-right pull-right">
													<ul>
														<li>
															<button class="edit-btn edit-training" type="submit"><i class="fa fa-pencil-square-o"></i> Edit</button>
														</li>
														<li>
															<a href="<?=base_url()?>candidate/delete_cv_item?section=training&id=<?=$training->candidate_training_id?>" class="delete_cv_item"><button class=" dlt-btn delete-education" type="submit"><i class="fa fa-trash-o"></i> Delete</button></a>
														</li>
													</ul>
												</div>
											</div>
											<?php } ?>
											<div class="col-md-12 col-sm-12">
												<?=empty($training)? '' : ''?>
											</div>												
                                      </div>
											<div style="clear:both;"></div>
											 <form method="POST" id="training_form" name="training_form" action="/candidate/save_training_info">
											 	<input id="training_id" name="training_id" type="hidden" value="0"/>
												<div class="bottom-slider">
													<div class="col-md-8 col-sm-8 left-padding">
														<div class="form-group">
															<label for="number" class="control-label">
																Course Name</label>
															<div class="input-icon right">
																<input id="course_name" name="course_name" type="text" placeholder="" class="form-control" required>
															</div>
														</div>
														<div style="clear:both;"></div>
														<div class="form-group">
															<label for="name" class="control-label">
																Center Name</label>
															<div class="input-icon right">
																<input id="center_name" name="center_name" type="text" placeholder="" class="form-control" required>
															</div>
														</div>
														<div class="form-group input-size">
															<div class="pull-left"><label for="training_completion_date" class="control-label">
																Completion Date</label>
															<div class="input-icon right">
																<input id="training_completion_date" name="training_completion_date" placeholder="" class="form-control" type="text" required>
															</div>
															</div>
														<div style="clear:both;"></div>
														<br>
													</div>
													<div style="clear:both;"></div>
												</div>
												<div style="clear:both;"></div>
													<div class="form-group pull-right">
															<label class="control-label col-md-2 col-sm-2 col-xs-12"></label>
															<button class="info-save  btn btn-info save-candidate-info" id="save_training">Save</button>&nbsp
															<button class="btn btn-danger cancel-btn" type="button">Cancel</button>
													</div>
                                    	</div>
                                     </form>
                               		 </div>
                             	</div>
                            </div>
                            <div class="col-lg-3">
										<div class="panel panel-green">
                                            <div class="panel-heading">
                                                Profile Strength</div>
											<div class="panel-body pan cv-pre">
                                                <div class="progress-wrap">
													  <ul>
														<li class="pull-left">Weak</li>
														<li class="pull-right">Strong</li>
													  </ul>	
													  <div style="clear:both;"></div>
													  <div class="progress pro-marg">
														<div class="progress-bar <?=get_class_by_score($profile_score)?>" role="progressbar" aria-valuenow="<?=$profile_score?>" aria-valuemin="0" aria-valuemax="100" style="width:<?=$profile_score?>%">
														  <span class="sr-only"><?=$profile_score?>% Complete</span>
														</div>
													  </div>
												</div>
												<div class="cv-compare">
													<ul>
														<li><i class="fa fa-file-image-o"></i>  <a data-toggle="modal" data-target="#improveCvModal" href="#">How to improve Profile</a></li>
														<li><i class="fa fa-list-alt"></i> <a data-toggle="modal" data-target="#myModal2" href="#"> View a sample Profile</a></li>							
														<li><a target="_blank" href="<?=base_url('candidate/view_candidate')?>"><button type="submit" class="btn btn-primary cv-btn">
                                                        Preview my Profile</button></a></li>							
													</ul>
												</div>
                                            </div>
                                        </div>
										<div class="panel panel-green">
                                            <div class="panel-heading">
                                                Profile Overview</div>
											<div class="panel-body pan cv-pre">
												<div class="cv-compare">
													<ul>
														<!-- <li><span>Profile Summary</span> <span class="pull-right"><?=count($profile)? '<i class="fa fa-check"></i>' : '<i class="fa fa-times"></i>'?></span></li>	
														<div class="clearfix"></div>						 -->
														<li><span>Work Experience</span> <span class="pull-right"><?=count($experiences)? '<i class="fa fa-check"></i>' : '<i class="fa fa-times"></i>'?></span></li>	
														<div class="clearfix"></div>						
														<li><span>Professional Certification</span> <span class="pull-right"><?=count($certificates)? '<i class="fa fa-check"></i>' : '<i class="fa fa-times"></i>'?></span></li>	
														<div class="clearfix"></div>						
														<li><span>Education Qualifications</span> <span class="pull-right"><?=count($educations)? '<i class="fa fa-check"></i>' : '<i class="fa fa-times"></i>'?></span></li>	
														<!-- <div class="clearfix"></div>						
														<li><span>Languages Skills</span> <span class="pull-right"><?=count($language_expertise)? '<i class="fa fa-check"></i>' : '<i class="fa fa-times"></i>'?></span></li>	 -->
														<div class="clearfix"></div>					
														<li class="cv-compare-last"><span>Job Target</span> <span class="pull-right"><?=(!empty($profile->industry_ids) && !empty($profile->competency_ids) && !empty($profile->soft_skill_type_ids))? '<i class="fa fa-check"></i>' : '<i class="fa fa-times"></i>'?></span></li>	
														<div class="clearfix"></div>												
													</ul>
												</div>
                                            </div>
                                        </div>
                            </div>
                        </div>
                        </div>
                      </div>
                    </div>
                <!--END CONTENT-->
                <!--Modals-->
		  
		 <div class="modal fade" id="myModal2" role="dialog">
			<div class="modal-dialog">			
			  <!-- Modal content-->
			  <div class="modal-content">
				<div class="modal-header">
				  <button type="button" class="close" data-dismiss="modal">&times;</button>
				  <h4 class="modal-title">Sample CV</h4>
				</div>
				<div class="modal-body">
				  <div class="bs-example">
						<div class="tab-content">
							<img class="img-responsive" src="<?=base_url('assets/portal/images')?>/cvsample.png"/>
						</div>
				  </div>
				</div>
				<div class="modal-footer">
				  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
			  </div>
			</div> 
		  </div>
		
		<!--Modals-->
<?php $this->load->view('partial/how_to_improve_cv.php'); ?>
<?php $this->load->view('partial/portal_footer.php'); ?>
<style type="text/css">
.driving_license_country {
    height: 250px;
    overflow-y: scroll;
}
#currently_working_here input[type="checkbox"]
{
	width:auto!important;
}

#experience_form .time-period span{
	margin-top:5px;
}

#experience_form #lbl_currently_working_here{
	font-weight: bold;
}
.error {
  color: red;
  margin-left: 5px;
}
.job_target_competencies > li {margin-left:10px;}
</style>
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<script type="text/javascript" src="<?=base_url()?>assets/front/js/jquery.ezmark.js"></script>
<script type="text/javascript">
  $(function() {

    $("#completion_date,#certification_completion_date,#expiration_date,#start_date,#end_date,#member_since,#visa_expiration_date,#training_completion_date").datepicker({
      changeMonth: true,
      changeYear: true,
      dateFormat: 'yy-mm-dd'
	});
	
	$("#date_of_birth").datepicker({
      changeMonth: true,
      changeYear: true,
      dateFormat: 'dd-mm-yy'
    });

    $("#date_of_birth").datepicker( "option", "yearRange","1950:2014");
    $("#completion_date,#certification_completion_date,#visa_expiration_date,#training_completion_date").datepicker( "option", "yearRange","-10:+15");

    $('#is_current_working_here').change(function(){
    	//alert('ad');
    	SetCurrentlyWorking($(this));
    });
	
    $('[data-validate-max="3"] input[type="checkbox"]').change(function(){
    	if($(this).parents('.form-group:first').find('input[type="checkbox"]:checked').length > 3)
    	{
    		alert('You can only select upto 3 options from each section in job target')
    		$(this).removeAttr('checked');
    	}
	});

	$('#btn_save_profile_contact_info').click(function(){
		
		if(validateCountryCode() && validateNetworkCode() && validateMobile())
		{
			var thisForm = $(this).parents('form:first');
			var action = thisForm.attr('action');
			var candidate_profile_id = $('#candidate_profile_id').val();
		
			$.ajax({
				type:'POST', 
				url:action,
				data:thisForm.serialize()+'&candidate_profile_id='+candidate_profile_id,
				success:function(result){
				// thisForm[0].reset();
					location.reload();
				},
				error:function(err){

				}, 
			});
			return false;
		}
	});

	$('#btn_save_about_you').click(function(){

		var thisForm = $(this).parents('form:first');
		var action = thisForm.attr('action');
		var about_you = $('#about_you').val();
		var candidate_profile_id = $('#candidate_profile_id').val();

		if(about_you.length > 60)
		{
			$('#err_about_you').show().delay(3000).fadeOut();
			$('#err_about_you').text("Maximum characters allowed is only 60");
			return false;
		}
		else if(about_you.length > 0)
		{
			$.ajax({
				type:'POST', 
				url:action,
				data:thisForm.serialize()+'&candidate_profile_id='+candidate_profile_id,
				success:function(result){
				// thisForm[0].reset();
					location.reload();
					return true;
				},
				error:function(err){

				}, 
			});
		}
		return false;		
	});

    $('input[type="checkbox"]').ezMark(); 
	$('.panel .row').each(function(index, el) {
        $(this).find('.seperator').last().css({borderBottom:'0px solid #000'});       
	});
	
	// $('#country_code').on('input', function() {
	// // do your stuff
		
	// });

	
	
	  
//     if (country_code.length > 3) {
//         $('#mobile').after('<span class="error">Enter only three numbers for country code</span>');
//     }
    
//   });

  });

 function SetCurrentlyWorking(thisObj)
 {
 	if(thisObj.is(':checked') == true)
    {
    	$('#experience_form').find('#end_date').val('Present');
    	$('#experience_form').find('#lbl_currently_working_here').removeClass('hidden').show();

    }
    else
    {
    	$('#experience_form').find('#end_date').val('');
    	$('#experience_form').find('#lbl_currently_working_here').hide();
    }
    $('#experience_form').find('#end_date').toggle();
 }

 function validateIfInteger(val)
	{
		var regEx = /^\d*$/;
	  	return regEx.test(val);
	}

	function validateCountryCode(checkLength = false)
	{
		// $('#btn_save_profile_contact_info').prop('disabled', false);
		$('#err_country_code').hide();

		var country_code = $('#country_code').val();
		country_code = country_code ? country_code.trim() : "";

		// if(checkLength && country_code.length == 0)
		// {
		// 	$('#err_country_code').show();
		// 	$('#err_country_code').text("Please enter a value for country code");
		// 	// $('#btn_save_profile_contact_info').prop('disabled', true);
		// 	return false;
		// }
		if(!validateIfInteger(country_code))
		{
			$('#err_country_code').show().delay(3000).fadeOut();
			$('#err_country_code').text("Enter only numbers");
			// $('#btn_save_profile_contact_info').prop('disabled', true);
			return false;
		}
		if(country_code.length > 3)
		{
			$('#err_country_code').show().delay(3000).fadeOut();
			$('#err_country_code').text("Maximum of only three numbers are allowed for country code");
			// $('#btn_save_profile_contact_info').prop('disabled', true);
			return false;
		}

		return true;
	}

	function validateNetworkCode(checkLength = false)
	{
		// $('#btn_save_profile_contact_info').prop('disabled', false);
		$('#err_network_code').hide();

		var network_code = $('#network_code').val();
		network_code = network_code ? network_code.trim() : "";

		// if(checkLength && network_code.length == 0)
		// {
		// 	$('#err_network_code').show();
		// 	$('#err_network_code').val("Enter only numbers");
		// //	$('#btn_save_profile_contact_info').prop('disabled', true);
		// 	return false;
		// }
		// if(network_code.length > 0)
		// {
		// 	validateCountryCode(true);
		// }
		if(!validateIfInteger(network_code))
		{
			$('#err_network_code').show().delay(3000).fadeOut();
			$('#err_network_code').text("Enter only numbers");
		//	$('#btn_save_profile_contact_info').prop('disabled', true);
			return false;
		}

		return true;
	}

	function validateMobile()
	{
		// $('#btn_save_profile_contact_info').prop('disabled', false);
		$('#err_mobile').hide();

		var mobile = $('#mobile').val();
		mobile = mobile ? mobile.trim() : "";

		// if(mobile.length > 0)
		// {
		// 	validateNetworkCode(true);
		// }
		if(!validateIfInteger(mobile))
		{
			$('#err_mobile').show().delay(3000).fadeOut();
			$('#err_mobile').text("Enter only numbers");
		//	$('#btn_save_profile_contact_info').prop('disabled', true);
			return false;
		}

		return true;
	}

</script>
