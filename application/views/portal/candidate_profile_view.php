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
													<p class=""> <b>Nationality : </b> <span id="cn_nationality"><?=isset($profile->nationality)? $profile->nationality :''?></span></p>
													<p class=""> <b>Date Of Birth : </b> <span id="cn_date_of_birth"><?=isset($profile->date_of_birth)? $profile->date_of_birth.' <b>( '.get_age_by_date($profile->date_of_birth).'<sup> years </sup>)</b>' :''?></span></p>
													<p class=""> <b>Passport Number : </b>  <span id="cn_passport_number"><?=isset($profile->passport_number)? $profile->passport_number :''?></span></p>
													<p class=""><b>Gender : </b> <span id="cn_gender"><?=isset($profile->gender)? $profile->gender :'-'?></span></p>
													<p  class=""><b>Marital Status : </b> <span id="cn_maritial_status"><?=isset($profile->status)? $profile->status :'-'?></span></p>
													<p class=""><b>Number of Dependants : </b> <span id="cn_number_of_dependants"><?=isset($profile->number_of_dependants)? $profile->number_of_dependants :'-'?></span></p>
													<p class=""><b>Visa Status : </b> <span id="cn_visa_status"><?=isset($profile->type)? $profile->type :'-'?></span></p>
													<p class=""><b>Expiration Date : </b>  <span id="cn_visa_expiration_date"><?=isset($profile->visa_expiration_date)? $profile->visa_expiration_date :'-'?></span></p>
													<p class=""><b>Driving License Countries : </b>  <span id="cn_driving_license_countries"><?php $value=''; foreach ($driving_license_collection as $key => $country){ $value.=$country->country.', ';}  print remove_trailing_commas($value); ?></span></p>
												</div>
											</div>														
                                        </div>
											<div style="clear:both;"></div>
                                    </div> 
                                </div>
								<!-- divider -->
                                <div class="panel">
                                    <div class="panel-body">
                                        <div class="row">
                                           <div class="col-md-12 col-sm-12">
												<div class="col-md-8 col-sm-8 left-padding section-content">
													<h3>Contact Information</h3>
													<p><b>Email : </b><span class="cn_email"><?=isset($contact->email)? $contact->email :'-'?></span></p>
													<p><b>Secondary Email : </b><span class="cn_secondary_email"><?=isset($contact->secondary_email)? $contact->secondary_email :'-'?></span></p>
													<p><b>Mobile : </b><span class="cn_mobile"><?=isset($contact->mobile)? $contact->mobile :'-'?></span></p>
													<p><b>Skype ID : </b> <span class="cn_skype_id"><?=isset($contact->skype)? $contact->skype :'-'?></span></p>
													<p><b>LinkedIn : </b><a target="_blank" href="<?=isset($contact->linkedin)?prep_url($contact->linkedin):'#';?>"><span class="cn_linkedin"><?=isset($contact->linkedin)? $contact->linkedin :'-'?></span></a></p>									
													<p><b>Website : </b><a target="_blank" href="<?=isset($contact->website)?prep_url($contact->website):'#';?>"><span class="cn_website"><?=isset($contact->website)? $contact->website :'-'?></span></a></p>
													<p><b>Preferred Method : </b> <span class="cn_preffered_contact_method"><?=!empty($profile->preferred_contact_method)? ucfirst(str_replace('_', ' ', $profile->preferred_contact_method)) :'-'?></span></p>
												</div>	
											</div>														
                                        </div>
											<div style="clear:both;"></div>	
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
													<p class="cn-about-you"><?=!empty($profile->about_you)? $profile->about_you :'-' ?></p>
												</div>
											</div>														
                                        </div>
											<div style="clear:both;"></div>
                                    </div>
                                </div>
                                <!-- divicer -->
                                <div class="panel">
                                    <div class="panel-body">
                                        <div class="row">
                                           <div class="col-md-12 col-sm-12">
												<div class="col-md-8 col-sm-8 left-padding section-content">
													<h3>Salary and Notice Period</h3>
													<p><b>Current : </b> <span class="cn-current-salary"><?=isset($salary_notice_period->current_salary) ? $salary_notice_period->current_salary : '-'?></span></p>
													<p><b>Target : </b> <span class="cn-expected-salary"><?=isset($salary_notice_period->expected_salary) ? $salary_notice_period->expected_salary : '-'?></span></p>
													<p><b>Notice Period : </b><span class="cn-notice-period"><?=isset($salary_notice_period->period) ? $salary_notice_period->period : '-'?></span></p>
												</div>
											</div>														
                                        </div>
											<div style="clear:both;"></div>
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
											</div>														
                                        </div>
											<div style="clear:both;"></div>
                                    </div>
                                </div>  
								<!-- divider -->
                                <div class="panel">
                                    <div class="panel-body">
                                        <div class="row">
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
												</div>	
													<?php } ?>
													<div class="col-md-12 col-sm-12">
														<?=empty($educations)? '-' : ''?>	
													</div>									
                                        </div>
											<div style="clear:both;"></div>
                                    </div>
                                </div>	                              
								<!-- divider -->
                                <div class="panel">
                                    <div class="panel-body">
                                        <div class="row">
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
											</div>
											<?php } ?>
											<div class="col-md-12 col-sm-12">
												<?=empty($experiences)? '-' : ''?>
											</div>													
                                        </div>
											<div style="clear:both;"></div>
											 
                                    </div>
                                </div>
								<!-- divider -->
                                <div class="panel">
                                    <div class="panel-body">
                                        <div class="row">
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
											</div>
											<?php } ?>
											<div class="col-md-12 col-sm-12">
												<?=empty($certificate)? '-' : ''?>
											</div>										
                                      </div>
									  <div style="clear:both;"></div>
											 
                               		 </div>
                             	</div>
								<!-- divider -->
                                <div class="panel">
                                    <div class="panel-body">
                                        <div class="row">
                                        	<h3 style="padding-left:15px;">Language</h3>
                                        	<?php foreach($language_expertise as $key => $language) { ?>
                                           	<div class="col-md-12 col-sm-12 seperator">
												<div class="col-md-8 col-sm-8 left-padding section-content">
														<p><b>Language : </b><span class="cn-language"><?=$language->language?></span></p>
														<p><b>Expertise : </b><span class="cn-expertise"><?=$language->expertise?></span></p>
														<p class="hidden"><span> class="cn-language-expertise-id hidden"><?=$language->language_expertise_id?></span></p>
												</div>
											</div>
											<?php } ?>
											<div class="col-md-12 col-sm-12">
												<?=empty($language_expertise)? '-' : ''?>	
											</div>													
                                        </div>
										<div style="clear:both;"></div>
									</div>
                                </div>
								<!-- divider -->
                                <div class="panel">
                                    <div class="panel-body">
                                        <div class="row">
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
											</div>	
											<?php } ?>
											<div class="col-md-12 col-sm-12">
												<?=empty($memberships)? '-' : ''?>
											</div>													
                                        </div>
											<div style="clear:both;"></div>
                                    </div>
                                </div>
                            </div>
                            <?php if(get_user_type() == 'candidate'): ?>
                            	<?php $this->load->view('partial/portal_job_search.php'); ?>
                            <?php else: ?>
                            	<?php $this->load->view('/partial/portal_candidate_search'); ?>
                            <?php endif; ?>
                        </div>
                        </div>
                      </div>
                    </div>
                <!--END CONTENT-->
                <!--Modals-->
		 <div class="modal fade" id="myModal" role="dialog">
			<div class="modal-dialog">			
			  <!-- Modal content-->
			  <div class="modal-content">
				<div class="modal-header">
				  <button type="button" class="close" data-dismiss="modal">&times;</button>
				  <h4 class="modal-title">How to improve CV</h4>
				</div>
				<div class="modal-body">
				  <div class="bs-example">
    <div class="tab-content">
        <div id="sectionA" class="tab-pane fade in active">
			<h5>To improve your online CV strength, the following tips should be helpful:</h5>
			<p><b>Work Experience:</b> Describe your work experiences in detail - try to explain your role with information about your responsibilities, projects, initiatives, achievements, etc. If you are a fresh graduate or a student, include internships and/or professional projects in your work experience.</p>
			<p><b>Education:</b> Ensure that you have provided information about your highest level of education. It is recommended to list other education details as well.</p>
			<p><b>Further Information:</b> If you have certifications and skills, please provide complete and up-to-date information. List all languages you know as this can be useful information for employers.</p>
        </div>
        <div id="sectionB" class="tab-pane fade">
            <h3>Section B</h3>
            <p>Vestibulum nec erat eu nulla rhoncus fringilla ut non neque. Vivamus nibh urna, ornare id gravida ut, mollis a magna. Aliquam porttitor condimentum nisi, eu viverra ipsum porta ut. Nam hendrerit bibendum turpis, sed molestie mi fermentum id. Aenean volutpat velit sem. Sed consequat ante in rutrum convallis. Nunc facilisis leo at faucibus adipiscing.</p>
        </div>
    </div>
</div>
				</div>
				<div class="modal-footer">
				  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
			  </div>
			  
			</div>
		  </div>
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

.job_target_competencies > li {margin-left:10px;}
</style>

<script type="text/javascript">
$(function(){
	$('.panel .row').each(function(index, el) {
        $(this).find('.seperator').last().css({borderBottom:'0px solid #000'});       
    });
});
</script>
