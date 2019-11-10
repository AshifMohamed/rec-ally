<?php $this->load->view('partial/portal_header.php'); ?>
<?php $this->load->view('partial/portal_sidebar.php'); ?>
<?php $this->load->view('partial/portal_breadcrumbs.php'); ?>

<link rel="stylesheet" href="<?=base_url()?>assets/portal/styles/stepsForm.css" >
<!-- Graph -->
<link rel="stylesheet" href="<?=base_url()?>assets/portal/styles/example.css">
<link rel="stylesheet" href="<?=base_url()?>assets/portal/styles/material-charts.css">
<!--BEGIN CONTENT-->
                <div class="page-content">
                    <div id="tab-general">
                        <div class="row mbl">
                            <div class="col-lg-12 block-space">
                            <?php if($is_job_expired && $is_question_profiles_completed) :?>
					<!--STEPS FORM START ------------ -->
						<div class="stepsForm">
								<div class="sf-steps">
									<div class="sf-steps-content">
										<div id="screening" data-target="<?=base_url()?>employer/job_profile/process/<?=$profile->job_profile_id?>?process=screening">
											<span>1</span> Screening
										</div>
										<div id="qualification" data-target="<?=base_url()?>employer/job_profile/process/<?=$profile->job_profile_id?>?process=qualification">
											<span>2</span> Qualification 
										</div>
										<div id="question" data-target="<?=base_url()?>employer/job_profile/process/<?=$profile->job_profile_id?>?process=question">
											<span>3</span> Question
										</div>
										<div id="interview_call" data-target="<?=base_url()?>employer/job_profile/process/<?=$profile->job_profile_id?>?process=interview_call">
											<span>4</span> Interview Call
										</div>
										<div id="structured_interview" data-target="<?=base_url()?>employer/job_profile/process/<?=$profile->job_profile_id?>?process=structured_interview">
											<span>5</span> Structured Interview
										</div>
										<div id="test" data-target="<?=base_url()?>employer/job_profile/process/<?=$profile->job_profile_id?>?process=test">
											<span>6</span> Test
										</div>
										<div id="selection" data-target="<?=base_url()?>employer/job_profile/process/<?=$profile->job_profile_id?>?process=selection">
											<span>7</span> Selection
										</div>
										<div id="result" data-target="<?=base_url()?>employer/job_profile/process/<?=$profile->job_profile_id?>?process=result">
											<span>8</span> Result
										</div>
									</div>
								</div>             
									<div class="sf-steps-form sf-radius"> 
										<ul class="sf-content"> 
											<?php if($process == 'screening'): ?>
												<?php if($candidates_applied > 0): ?>
													<li>
														<div class="panel table-top">
																<div class="panel-body">
																	<table class="table table-hover table-bordered">
																		<thead>
																		<tr>
																			<th>Jobs Ref</th>
																			<th>Post Date</th>
																			<th>Post By</th>
																			<th>Close Date</th>
																			<th>Job Profile</th>
																			<th>Posting Profile</th>
																		</tr>
																		</thead>
																		<tbody>
																		<tr>
																			<td><?=$profile->job_ref_no?></td>
																			<td><?=$profile->posted_date?></td>
																			<td><?=$profile->company_name?></td>
																			<td><?=$profile->close_date?></td>
																			<td><a href="<?=base_url()?>employer/job_profile/<?=$profile->job_profile_id?>" target="_blank">View</a></td>
																			<td><a href="<?=base_url()?>posting/<?=$profile->job_ref_no?>" target="_blank">View</a></td>
																		</tr>
																		</tbody>
																	</table>
																	<p class="text-center view-more">view process</p>
																	<table class="table table-hover process-view table-bordered">
																		<thead>
																		<tr>
																			<th>No of Candidates Apply</th>
																			<th>Profile</th>
																			<th>Candidates Passing Screening Process</th>
																			<th>Profile</th>
																			<th>Candidates Declined Screening Process</th>
																			<th>Profile</th>
																			<th>Percentage Passed</th>
																			<th>Percentage Declined</th>
																		</tr>
																		</thead>
																		<tbody>
																		<tr>
																			<td><?=$candidates_applied?></td>
																			<td><a target="_blank" href="<?=base_url()?>employer/job_profile/view_candidates/<?=$profile->job_profile_id?>/applied_candidates">View</a></td>
																			<td><?=$candidates_passed?></td>
																			<td><a target="_blank" href="<?=base_url()?>employer/job_profile/view_candidates/<?=$profile->job_profile_id?>/passed_screening">View</a></td>
																			<td><?=$candidates_declined?></td>
																			<td><a target="_blank" href="<?=base_url()?>employer/job_profile/view_candidates/<?=$profile->job_profile_id?>/declined_candidates">View</a></td>
																			<td><?=$percentage_passed?>%</td>
																			<td><?=$percentage_declined?>%</td>
																		</tr>
																		</tbody>
																	</table>
																</div>
														</div>
													</li>
												<?php else: ?>
													<div class="alert alert-danger" role="alert"> No Candidates Found to proceed with the shortlisting process</div>
												<?php endif; ?>
											<?php endif; ?>
										</ul>
										<ul class="sf-content"> 
											<?php if($process == 'qualification'): ?>
												<?php if($candidates_applied > 0): ?>
													<li>
															<div class="panel table-top">
																<div class="panel-body">
																	<table class="table table-hover table-bordered">
																		<thead>
																		<tr>
																			<th>Job Ref</th>
																			<th>Post Date</th>
																			<th>Post By</th>
																			<th>Close Date</th>
																			<th>Job Profile</th>
																			<th>Posting Profile</th>
																		</tr>
																		</thead>
																		<tbody>
																		<tr>
																			<td><?=$profile->job_ref_no?></td>
																			<td><?=$profile->posted_date?></td>
																			<td><?=$profile->company_name?></td>
																			<td><?=$profile->close_date?></td>
																			<td><a href="<?=base_url()?>employer/job_profile/<?=$profile->job_profile_id?>" target="_blank">View</a></td>
																			<td><a href="<?=base_url()?>posting/<?=$profile->job_ref_no?>" target="_blank">View</a></td>
																		</tr>
																		</tbody>
																	</table>
																	<p class="text-center view-more">view process</p>
																	<table class="table table-hover process-view table-bordered">
																		<thead>
																		<tr>
																			<th>Candidates Passing Screening Process</th>
																			<th>Profile</th>
																			<th>Candidates Passing Qualification Process</th>
																			<th>Profile</th>
																			<th>Candidates Declined in Qualification process</th>
																			<th>Profile</th>
																			<th>Percentage Passed</th>
																			<th>Percentage Declined</th>
																		</tr>
																		</thead>
																		<tbody>
																		<tr>
																			<td><?=$screening_passed?></td>
																			<td><a target="_blank" href="<?=base_url()?>employer/job_profile/view_candidates/<?=$profile->job_profile_id?>/passed_screening">View</a></td>
																			<td><?=$candidates_passed?></td>
																			<td><a target="_blank" href="<?=base_url()?>employer/job_profile/view_candidates/<?=$profile->job_profile_id?>/passed_qualification">View</a></td>
																			<td><?=$candidates_declined?></td>
																			<td><a target="_blank" href="<?=base_url()?>employer/job_profile/view_candidates/<?=$profile->job_profile_id?>/declined_qualification">View</a></td>
																			<td><?=$percentage_passed?>%</td>
																			<td><?=$percentage_declined?>%</td>
																		</tr>
																		</tbody>
																	</table>
																</div>	
													</li>
												<?php else: ?>
													<div class="alert alert-danger" role="alert"> No Candidates Found to proceed with the shortlisting process</div>
												<?php endif; ?>
											<?php endif;?>
										</ul>		
										<ul class="sf-content"> 
											<?php if($process == 'question'): ?>
												<?php if($candidates_applied > 0): ?>
													<?php if($total_candidate_unanswered > 0 && !isset($proceed_question) && $process_completed == 'qualification'): ?>
														<div class="panel">
															<div class="panel-body">
																<div class="alert alert-warning">
																	<p><strong><?=$total_candidate_unanswered?> out of <?=($total_candidate_answered+$total_candidate_unanswered)?> candidate(s)</strong> haven't answered the questions emailed to them. If you proceed now the unanaswered candidate's <strong>question points will be set to "0"</strong>.</p>
																	<p><strong>Do you want to proceed? </strong> <a href="<?=base_url()?>/employer/job_profile/process/<?=$profile->job_profile_id?>?process=question&status=proceed"><button class="btn btn-danger">Yes</button></a></p>
																</div>
															</div>
														</div>
													<?php else: ?>
														<li>
																<div class="panel table-top">
																	<div class="panel-body">
																		<table class="table table-hover table-bordered">
																			<thead>
																			<tr>
																				<th>Job Ref</th>
																				<th>Post Date</th>
																				<th>Post By</th>
																				<th>Close Date</th>
																				<th>Job Profile</th>
																				<th>Posting Profile</th>
																			</tr>
																			</thead>
																			<tbody>
																			<tr>
																				<td><?=$profile->job_ref_no?></td>
																				<td><?=$profile->posted_date?></td>
																				<td><?=$profile->company_name?></td>
																				<td><?=$profile->close_date?></td>
																				<td><a href="<?=base_url()?>employer/job_profile/<?=$profile->job_profile_id?>" target="_blank">View</a></td>
																				<td><a href="<?=base_url()?>posting/<?=$profile->job_ref_no?>" target="_blank">View</a></td>
																			</tr>
																			</tbody>
																		</table>
																		<p class="text-center view-more">view process</p>
																		<table class="table table-hover process-view table-bordered">
																			<thead>
																			<tr>
																				<th>Candidates Passing Qualification Process</th>
																				<th>Profile</th>
																				<th>Candidates Passing Question Process</th>
																				<th>Profile</th>
																				<th>Candidates Declined in Question Process</th>
																				<th>Profile</th>
																				<th>Percentage Passed</th>
																				<th>Percentage Declined</th>
																			</tr>
																			</thead>
																			<tbody>
																			<tr>
																				<td><?=$qualification_passed?></td>
																				<td><a target="_blank" href="<?=base_url()?>employer/job_profile/view_candidates/<?=$profile->job_profile_id?>/passed_qualification">View</a></td>
																				<td><?=$candidates_passed?></td>
																				<td><a target="_blank" href="<?=base_url()?>employer/job_profile/view_candidates/<?=$profile->job_profile_id?>/passed_question">View</a></td>
																				<td><?=$candidates_declined?></td>
																				<td><a target="_blank" href="<?=base_url()?>employer/job_profile/view_candidates/<?=$profile->job_profile_id?>/declined_candidates">View</a></td>
																				<td><?=$percentage_passed?>%</td>
																				<td><?=$percentage_declined?>%</td>
																			</tr>
																			</tbody>
																		</table>
																	</div>
																</div>
																<div class="panel table-top">
																	<div class="container proc-tab-wrap">
																			<form action="<?=base_url()?>employer/schedule_interview/<?=$profile->job_profile_id?>" method="POST">
																				<div class="col-md-7 col-sm-7 left-padding proc-tab">
																					<?php if(!$interview_scheduling_completed): ?>
																						<h3>Set Interview Call <a href="<?=base_url()?>employer/job_profile/view_candidates/<?=$profile->job_profile_id?>/interview_schedule" target="_blank"><small class="label label-success">view interview schedule</small></a></h3>
																						<select name="interview_candidate" id="set_time" class="form-control candidate_select set-time">
																							<option value="0">Please Select</option>
																							<?php foreach ($candidates as $key => $candidate) { ?>
																								<?php if(is_candidate_interview_set($candidate->candidate_profile_id) == 0) :  ?>
																									<option value="<?=$candidate->candidate_profile_id?>"><?=$candidate->first_name.' '.$candidate->last_name?></option>
																								<?php endif; ?>			
																							<?php } ?> 
																						</select>
																					<?php else: ?>
																						<div class="alert alert-success" role="alert"><p>Interviews have been successfully scheduled for all candidates<strong>!</strong></p> <p>Please complete the interview feedback for each candidate before proceeding with the next process. <a class="label label-primary" href="<?=base_url().'employer/job_profile/process_settings/'.$profile->job_profile_id.'#interview_call'?>">Submit Feedback</a>&nbsp;<a href="<?=base_url()?>employer/job_profile/view_candidates/<?=$profile->job_profile_id?>/interview_schedule" target="_blank"><small class="label label-success">view interview schedule</small></a></p></div>
																					<?php endif; ?>
																				</div>
																				<div style="clear:both;"></div>
																				<div class="set-interview set-date-show">
																					<ul>
																						<li>
																							<div class="form-group col-md-3 col-sm-3 left-padding">
																									<label class="control-label">
																										Date and Time</label>
																									<div class="input-icon right">
																										<input id="interview_date_time" name="interview_date_time" type="text" placeholder="Interview Date" required class="form-control">
																									</div>
																							</div>
																							<div class="form-group col-md-4 col-sm-4">
																									<label class="control-label">
																										Message to the candidate</label>
																									<div class="input-icon right">
																										<textarea id="interview_message" name="interview_message" placeholder="" class="form-control">We have arranged an on-call interview as part of our shortlisting process.</textarea>
																									</div>
																									<br>
																							<button type="submit" class="btn btn-primary pull-right">Set Interview</button>
																							</div>
																							<div style="clear:both;"></div>
																						</li>
																					</ul>
																				</div>
																			</form>
																	</div>
																</div>
														</li>
													<?php endif; ?>	
												<?php else: ?>
													<div class="alert alert-danger" role="alert"> No Candidates Found to proceed with the shortlisting process</div>
												<?php endif; ?>
											<?php endif; ?>
										</ul>		
										<ul class="sf-content"> 
											<?php /*echo $candidates_applied.'--'.$interview_call_feedback_count;*/ if($process == 'interview_call'): ?>
												<?php if($candidates_applied > 0): ?>
														<?php if($interview_call_feedback_count == $candidates_applied): ?>
															<li>
																<div class="panel table-top">
																	<div class="panel-body">
																		<table class="table table-hover table-bordered">
																			<thead>
																			<tr>
																				<th>Job Ref</th>
																				<th>Post Date</th>
																				<th>Post By</th>
																				<th>Close Date</th>
																				<th>Job Profile</th>
																				<th>Posting Profile</th>
																			</tr>
																			</thead>
																			<tbody>
																			<tr>
																				<td><?=$profile->job_ref_no?></td>
																				<td><?=$profile->posted_date?></td>
																				<td><?=$profile->company_name?></td>
																				<td><?=$profile->close_date?></td>
																				<td><a href="<?=base_url()?>employer/job_profile/<?=$profile->job_profile_id?>" target="_blank">View</a></td>
																				<td><a href="<?=base_url()?>posting/<?=$profile->job_ref_no?>" target="_blank">View</a></td>
																			</tr>
																			</tbody>
																		</table>
																		<p class="text-center view-more">view process</p>
																		<table class="table table-hover process-view table-bordered">
																			<thead>
																			<tr>
																				<th>Candidates Passing Question Process</th>
																				<th>Profile</th>
																				<th>Candidates Passing Interview Call Process</th>
																				<th>Profile</th>
																				<th>Candidates Declined in Interview Call Process</th>
																				<th>Profile</th>
																				<th>Percentage Passed</th>
																				<th>Percentage Declined</th>
																			</tr>
																			</thead>
																			<tbody>
																			<tr>
																				<td><?=$candidates_applied?></td>
																				<td><a target="_blank" href="<?=base_url()?>employer/job_profile/view_candidates/<?=$profile->job_profile_id?>/passed_question">View</a></td>
																				<td><?=$candidates_passed?></td>
																				<td><a target="_blank" href="<?=base_url()?>employer/job_profile/view_candidates/<?=$profile->job_profile_id?>/passed_interview_call">View</a></td>
																				<td><?=$candidates_declined?></td>
																				<td><a target="_blank" href="<?=base_url()?>employer/job_profile/view_candidates/<?=$profile->job_profile_id?>/declined_candidates">View</a></td>
																				<td><?=$percentage_passed?>%</td>
																				<td><?=$percentage_declined?>%</td>
																			</tr>
																			</tbody>
																		</table>
																	</div>
																</div>
															</li>
														<?php else: ?>
																<div class="alert alert-danger" role="alert">Please submit the interview call feedbacks for all candidates before proceeding with this step. <a class="label label-primary" href="<?=base_url().'employer/job_profile/process_settings/'.$profile->job_profile_id.'#interview_call'?>" target="_blank">Submit  Feedback</a></div>
														<?php endif;?>
												<?php else: ?>
													<div class="alert alert-danger" role="alert"> No Candidates Found to proceed with the shortlisting process</div>
												<?php endif; ?>
											<?php endif; ?>
										</ul>		
										<ul class="sf-content"> 
											<?php if($process == 'structured_interview'): ?>
												<?php if($candidates_applied > 0): ?>
														<?php if($structured_interview_feedback_count == $candidates_applied): ?>
														<li>
															<div class="panel table-top">
																<div class="panel-body">
																	<table class="table table-hover table-bordered">
																		<thead>
																		<tr>
																			<th>Job Ref</th>
																			<th>Post Date</th>
																			<th>Post By</th>
																			<th>Close Date</th>
																			<th>Job Profile</th>
																			<th>Posting Profile</th>
																		</tr>
																		</thead>
																		<tbody>
																		<tr>
																			<td><?=$profile->job_ref_no?></td>
																			<td><?=$profile->posted_date?></td>
																			<td><?=$profile->company_name?></td>
																			<td><?=$profile->close_date?></td>
																			<td><a href="<?=base_url()?>employer/job_profile/<?=$profile->job_profile_id?>" target="_blank">View</a></td>
																			<td><a href="<?=base_url()?>posting/<?=$profile->job_ref_no?>" target="_blank">View</a></td>
																		</tr>
																		</tbody>
																	</table>
																	<p class="text-center view-more">view process</p>
																	<table class="table table-hover process-view table-bordered">
																		<thead>

																		<tr>
																			<th>Candidates Passing Interview Call Process</th>
																			<th>Profile</th>
																			<th>Candidates Passing Structured Interview Process</th>
																			<th>Profile</th>
																			<th>Candidates Declined in Structured Interview Process</th>
																			<th>Profile</th>
																			<th>Percentage Passed</th>
																			<th>Percentage Declined</th>
																		</tr>
																		</thead>
																		<tbody>
																		<tr>
																			<td><?=$candidates_applied?></td>
																			<td><a target="_blank" href="<?=base_url()?>employer/job_profile/view_candidates/<?=$profile->job_profile_id?>/passed_interview_call">View</a></td>
																			<td><?=$candidates_passed?></td>
																			<td><a target="_blank" href="<?=base_url()?>employer/job_profile/view_candidates/<?=$profile->job_profile_id?>/passed_structured_interview">View</a></td>
																			<td><?=$candidates_declined?></td>
																			<td><a target="_blank" href="<?=base_url()?>employer/job_profile/view_candidates/<?=$profile->job_profile_id?>/declined_candidates">View</a></td>
																			<td><?=$percentage_passed?>%</td>
																			<td><?=$percentage_declined?>%</td>
																		</tr>
																		</tbody>
																	</table>
																</div>
															</div>
														</li>
														<?php else: ?>
															<div class="alert alert-danger" role="alert">Please submit the structured interview question feedbacks for all candidates before proceeding with this step. <a class="label label-primary" href="<?=base_url().'employer/job_profile/process_settings/'.$profile->job_profile_id.'#structured_interview'?>" target="_blank">Submit  Feedback</a></div>
														<?php endif;?>
												<?php else: ?>
													<div class="alert alert-danger" role="alert"> No Candidates Found to proceed with the shortlisting process</div>
												<?php endif; ?>
											<?php endif; ?>
										</ul>		
										<ul class="sf-content"> 
											<?php if($process == 'test'): ?>
												<?php if($candidates_applied > 0): ?>
														<?php if($test_feedback_count == $candidates_applied): ?>
														<li>
															<div class="panel table-top">
																<div class="panel-body">
																	<table class="table table-hover table-bordered">
																		<thead>
																		<tr>
																			<th>Job Ref</th>
																			<th>Post Date</th>
																			<th>Post By</th>
																			<th>Close Date</th>
																			<th>Job Profile</th>
																			<th>Posting Profile</th>
																		</tr>
																		</thead>
																		<tbody>
																		<tr>
																			<td><?=$profile->job_ref_no?></td>
																			<td><?=$profile->posted_date?></td>
																			<td><?=$profile->company_name?></td>
																			<td><?=$profile->close_date?></td>
																			<td><a href="<?=base_url()?>employer/job_profile/<?=$profile->job_profile_id?>" target="_blank">View</a></td>
																			<td><a href="<?=base_url()?>posting/<?=$profile->job_ref_no?>" target="_blank">View</a></td>
																		</tr>
																		</tbody>
																	</table>
																	<p class="text-center view-more">view process</p>
																	<table class="table table-hover process-view table-bordered">
																		<thead>
																		<tr>
																			<th>Candidates Passing Structured Interview Process</th>
																			<th>Profile</th>
																			<th>Candidates Passing Test Process</th>
																			<th>Profile</th>
																			<th>Candidates Declined in Test Process</th>
																			<th>Profile</th>
																			<th>Percentage Passed</th>
																			<th>Percentage Declined</th>
																		</tr>
																		</thead>
																		<tbody>
																		<tr>
																			<td><?=$candidates_applied?></td>
																			<td><a target="_blank" href="<?=base_url()?>employer/job_profile/view_candidates/<?=$profile->job_profile_id?>/passed_structured_interview">View</a></td>
																			<td><?=$candidates_passed?></td>
																			<td><a target="_blank" href="<?=base_url()?>employer/job_profile/view_candidates/<?=$profile->job_profile_id?>/passed_test">View</a></td>
																			<td><?=$candidates_declined?></td>
																			<td><a target="_blank" href="<?=base_url()?>employer/job_profile/view_candidates/<?=$profile->job_profile_id?>/declined_candidates">View</a></td>
																			<td><?=$percentage_passed?>%</td>
																			<td><?=$percentage_declined?>%</td>
																		</tr>
																	</table>
																</div>
															</div>
														</li>
														<?php else: ?>
															<div class="alert alert-danger" role="alert">Please submit the test feedbacks for all candidates before proceeding with this step. <a class="label label-primary" href="<?=base_url().'employer/job_profile/process_settings/'.$profile->job_profile_id.'#test'?>" target="_blank">Submit  Feedback</a></div>
														<?php endif;?>
												<?php else: ?>
													<div class="alert alert-danger" role="alert"> No Candidates Found to proceed with the shortlisting process</div>
												<?php endif; ?>
											<?php endif ?>
										</ul>
										<ul class="sf-content"> 
											<?php if($process == 'selection'): ?>
												<?php if($candidates_applied > 0): ?>
														<?php if($selection_feedback_count == $candidates_applied): ?>
														<li>
															<div class="panel table-top">
																<div class="panel-body">
																	<table class="table table-hover table-bordered">
																		<thead>
																		<tr>
																			<th>Job Ref</th>
																			<th>Post Date</th>
																			<th>Post By</th>
																			<th>Close Date</th>
																			<th>Job Profile</th>
																			<th>Posting Profile</th>
																		</tr>
																		</thead>
																		<tbody>
																		<tr>
																			<td><?=$profile->job_ref_no?></td>
																			<td><?=$profile->posted_date?></td>
																			<td><?=$profile->company_name?></td>
																			<td><?=$profile->close_date?></td>
																			<td><a href="<?=base_url()?>employer/job_profile/<?=$profile->job_profile_id?>" target="_blank">View</a></td>
																			<td><a href="<?=base_url()?>posting/<?=$profile->job_ref_no?>" target="_blank">View</a></td>
																		</tr>
																		</tbody>
																	</table>
																	<p class="text-center view-more">view process</p>
																	<table class="table table-hover process-view table-bordered">
																		<thead>
																		<tr>
																			<th>Candidates Passing Test Process</th>
																			<th>Profile</th>
																			<th>Candidates Passing Selection Process</th>
																			<th>Profile</th>
																			<th>Candidates Declined in Selection Process</th>
																			<th>Profile</th>
																			<th>Percentage Passed</th>
																			<th>Percentage Declined</th>
																		</tr>
																		</thead>
																		<tbody>
																		<tr>
																			<td><?=$candidates_applied?></td>
																			<td><a target="_blank" href="<?=base_url()?>employer/job_profile/view_candidates/<?=$profile->job_profile_id?>/passed_test">View</a></td>
																			<td><?=$candidates_passed?></td>
																			<td><a target="_blank" href="<?=base_url()?>employer/job_profile/view_candidates/<?=$profile->job_profile_id?>/passed_selection">View</a></td>
																			<td><?=$candidates_declined?></td>
																			<td><a target="_blank" href="<?=base_url()?>employer/job_profile/view_candidates/<?=$profile->job_profile_id?>/declined_candidates">View</a></td>
																			<td><?=$percentage_passed?>%</td>
																			<td><?=$percentage_declined?>%</td>
																		</tr>
																	</table>
																</div>
															</div>
														</li>
														<?php else: ?>
															<div class="alert alert-danger" role="alert">Please submit the selection feedbacks for all candidates before proceeding with this step. <a class="label label-primary" href="<?=base_url().'employer/job_profile/process_settings/'.$profile->job_profile_id.'#selection'?>" target="_blank">Submit  Feedback</a></div>
														<?php endif;?>
												<?php else: ?>
													<div class="alert alert-danger" role="alert"> No Candidates Found to proceed with the shortlisting process</div>
												<?php endif; ?>
											<?php endif; ?>
										</ul>		
										<ul class="sf-content"> 
											<?php if($process == 'result'): ?>
												<?php if($candidates_applied > 0): ?>
													<li class="final-results-section">
															<div class="panel table-top">
																<div class="panel-body">
																	<h5 class="pull-left">Job Reference: <?=$profile->job_ref_no?></h5>
																	<a class="btn btn-success pull-right" id="btn_view_detailed_results" data-toggle="modal" href='#modal_view_detailed_results'>View Detailed Results</a>
																	<table class="table table-hover table-bordered">
																		<thead>
																		<tr>
																			<th>Rank</th>
																			<th>Profile</th>
																			<th>Name</th>
																			<th>Screening</th>
																			<th>Qualification</th>
																			<th>Question</th>
																			<th>Interview Call</th>
																			<th>Structured Interview</th>
																			<th>Test</th>
																			<th>Selection</th>
																			<th>Total</th>
																		</tr>
																		</thead>
																		<tbody>
																		<?php foreach ($candidates as $key => $candidate) { ?>
																			<tr class="final-results">
																				<td><?=$key+1?></td>
																				<td><a target="_blank" href="<?=base_url()?>employer/view_candidate/<?=$candidate->candidate_profile_id?>">View</a></td>
																				<td><?=$candidate->first_name.' '.$candidate->last_name?></td>
																				<td class="screening_summary"><?=number_format($candidate->summary[0]['points'],2)?></td>
																				<td class="qualification_summary"><?=number_format($candidate->summary[1]['points'],2)?></td>
																				<td class="question_summary"><?=number_format(get_percentage_value($candidate->summary[2]['points'],$candidate->summary[2]['total_questions']*5),2)?></td>
																				<td class="interview_call_summary"><?=number_format(get_percentage_value($candidate->summary[3]['points'],$candidate->summary[3]['total_questions']*4),2)?></td>
																				<td class="structured_interview_summary"><?=number_format(get_percentage_value($candidate->summary[4]['points'],$candidate->summary[4]['total_questions']*4),2)?></td>
																				<td class="test_summary"><?=number_format($candidate->summary[5]['points'],2)?></td>
																				<td class="selection_summary"><?=number_format($candidate->summary[6]['points'],2)?></td>
																				<td class="overal_percentage"></td>
																			</tr>
																		<?php } ?>
																		</tbody>
																	</table>
																	
																	        <section>
																		<div class="subsection">
																			<div class="res-congr">
																				<h3>Congratulations!</h3> 
																				<p>We have filtered you <?=count($candidates)?> top Candidate(s)</p>
																			</div>	
																			<ul>	
																				<h4>Process Filtered Results</h4>
																				<li>Step 1 : Screening</li>
																				<li>Step 2 : Qualification</li>
																				<li>Step 3 : Questions</li>
																				<li>Step 4 : Interview calls</li>
																				<li>Step 5 : Structured Interview</li>
																				<li>Step 6 : Test</li>
																				<li>Step 7 : Selection</li>
																			</ul>
																			<div class="example-container col-md-6 col-sm-6 clearfix hidden">
																				<div class="example-chart">
																					<div id="bar-chart-example"></div>
																				</div>
																			</div>
																			<div class="example-container col-md-6 col-sm-6 clearfix hidden">
																				<div class="example-chart">
																					<div id="bar-chart-example-2"></div>
																				</div>
																			</div>
																			
																			<div class="example-container col-md-6 col-sm-6 clearfix hidden">
																				<div class="example-chart">
																					<div id="bar-chart-example-3"></div>
																				</div>
																			</div>
																			<!-- <br/><br/> -->
																			<div class="example-container col-md-6 col-sm-6 clearfix hidden">
																				<div class="example-chart">
																					<div id="bar-chart-example-4"></div>
																				</div>
																			</div>
																		</div>
																	</section>
																</div>
															</div>
													</li>
												<?php else: ?>
													<div class="alert alert-danger" role="alert"> No Candidates Found to proceed with the shortlisting process</div>
												<?php endif; ?>
												<div class="modal fade" id="modal_view_detailed_results">
													<div class="modal-dialog">
														<div class="modal-content">
															<div class="modal-header">
																<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
																<h4 class="modal-title">Recruitment Process Results Detailed</h4>
															</div>
															<div class="modal-body">
																<div class="panel-group process_results_detailed" id="accordion" role="tablist" aria-multiselectable="true">
																	  <div class="panel panel-default">
																	    <div class="panel-heading" role="tab" id="headingOne">
																	      <h4 class="panel-title">
																	        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
																	          Question Results
																	        </a>
																	      </h4>
																	    </div>
																	    <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
																	     <div class="panel-body">
																	        <?php 
																	      		foreach ($candidates as $key => $candidate) :
																	      			$questions = get_job_profile_questions_by_job_profile_candidate_profile_and_type($job_profile_id,$candidate->candidate_profile_id,'question');
																	      	?>
																	      			<h5><?=$candidate->first_name.' '.$candidate->last_name?> <small><b>(total points :  <?=number_format(get_percentage_value($candidate->summary[2]['points'],$candidate->summary[2]['total_questions']*5),2)?>)</b></small> </h5>
																	      			<ul class="result_details">
																	      			<?php
																	      			foreach ($questions as $key => $question) :
																	      			?>
																	      				<li><?=$question->question?><br/> <b>Answer:</b> <?=ucwords(str_replace('_',' ', $question->choice))?> </li>
																	      			<?php endforeach; ?>
																	      			</ul>
																	      		<?php endforeach; ?>
																	      </div>
																	    </div>
																	  </div>
																	  <div class="panel panel-default">
																	    <div class="panel-heading" role="tab" id="headingTwo">
																	      <h4 class="panel-title">
																	        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
																	          Interview Call Results
																	        </a>
																	      </h4>
																	    </div>
																	    <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
																	      <div class="panel-body"> 
																	      	<?php 
																	      		foreach ($candidates as $key => $candidate) :
																	      			$questions = get_job_profile_questions_by_job_profile_candidate_profile_and_type($job_profile_id,$candidate->candidate_profile_id,'interview_call');
																	      			$attachment = get_attachment_by_job_profile_candidate_profile_and($job_profile_id,$candidate->candidate_profile_id);
																	      	?>
																	      			<h5><?=$candidate->first_name.' '.$candidate->last_name?> <small><b>(total points :  <?=number_format(get_percentage_value($candidate->summary[3]['points'],$candidate->summary[3]['total_questions']*4),2)?>)</b></small> </h5>
																	      			<a download href="<?=isset($attachment->interview_call) ? base_url().'uploads/shortlisting_feedback_attachments/'.$attachment->interview_call : '#'?>" <?=isset($attachment->interview_call)? 'target="_blank"' : '' ?> > attachment</a>
																	      			<ul class="result_details">
																	      			<?php
																	      			foreach ($questions as $key => $question) :
																	      			?>
																	      				<li><?=$question->question?><br/> <b>Answer:</b> <?=ucwords(str_replace('_',' ', $question->choice))?> </li>
																	      			<?php endforeach; ?>
																	      			</ul>
																	      		<?php endforeach; ?>
																	      </div>
																	    </div>
																	  </div>
																	  <div class="panel panel-default">
																	    <div class="panel-heading" role="tab" id="headingThree">
																	      <h4 class="panel-title">
																	        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
																	          Structured Interview Results
																	        </a>
																	      </h4>
																	    </div>
																	    <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
																	      <div class="panel-body">
																	        <?php 
																	      		foreach ($candidates as $key => $candidate) :
																	      			$questions = get_job_profile_questions_by_job_profile_candidate_profile_and_type($job_profile_id,$candidate->candidate_profile_id,'structured_interview');
																	      	?>
																	      			<h5><?=$candidate->first_name.' '.$candidate->last_name?> <small><b>(total points :  <?=number_format(get_percentage_value($candidate->summary[4]['points'],$candidate->summary[4]['total_questions']*4),2)?>)</b></small> </h5>
																	      			<ul class="result_details">
																	      			<?php
																	      			foreach ($questions as $key => $question) :
																	      			?>
																	      				<li><?=$question->question?><br/> <b>Answer:</b> <?=ucwords(str_replace('_',' ', $question->choice))?> </li>
																	      			<?php endforeach; ?>
																	      			</ul>
																	      		<?php endforeach; ?>
																	      </div>
																	    </div>
																	  </div>
																	  <div class="panel panel-default">
																	    <div class="panel-heading" role="tab" id="headingThree">
																	      <h4 class="panel-title">
																	        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseFour" aria-expanded="false" aria-controls="collapseThree">
																	          Test and Selection Results
																	        </a>
																	      </h4>
																	    </div>
																	    <div id="collapseFour" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
																	      <div class="panel-body">
																	        <?php 
																	      		foreach ($candidates as $key => $candidate) :
																	      			echo '<h5>'.$candidate->first_name.' '.$candidate->last_name.'</h5>';		      	
																		      		$test = get_test_selection_by_job_profile_candidate_profile_and_type($job_profile_id,$candidate->candidate_profile_id,'test');
																		      		$selection = get_test_selection_by_job_profile_candidate_profile_and_type($job_profile_id,$candidate->candidate_profile_id,'selection');
																		      		$attachment = get_attachment_by_job_profile_candidate_profile_and($job_profile_id,$candidate->candidate_profile_id);
																		      		if(!empty($test) && !empty($selection)):
																		    ?>
																			      		<ul class="result_details">
																			      			<li>Test Process : <b><?=$test->points?> points</b><a download href="<?=isset($attachment->test) ? base_url().'uploads/shortlisting_feedback_attachments/'.$attachment->test : '#'?>" <?=isset($attachment->test)? 'target="_blank"' : '' ?> > attachment</a> </li>
																			      			<li>Selection Process : <b><?=$selection->points?> points</b> <a download href="<?=isset($attachment->selection) ? base_url().'uploads/shortlisting_feedback_attachments/'.$attachment->selection : '#'?>" <?=isset($attachment->selection)? 'target="_blank"' : '' ?> > attachment</a> </li>
																			      		</ul>
																			      	<?php endif; ?> 
																	      	<?php endforeach; ?> 
																	      </div>
																	    </div>
																	  </div>
																	</div>
															</div>
															<div class="modal-footer">
																<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
																<!-- <button type="button" class="btn btn-primary">Save changes</button> -->
															</div>
														</div>
													</div>
												</div>
											<?php endif; ?>
										</ul>				
									</div>
								<div class="sf-steps-navigation sf-align-right">
									<span id="sf-msg" class="sf-msg-error"></span>
									<button id="sf-prev" type="button" class="sf-button">Previous</button>
									<button id="sf-next" type="button" class="sf-button">Next</button>
								</div>
						</div>
				<!--STEPS FORM END -------------- -->
							<?php elseif(!$is_job_expired): ?>
								<div class="alert alert-danger" role="alert"> The job should be closed before the process can be started</div>
							<?php elseif(!$is_question_profiles_completed): ?>
								<div class="alert alert-danger" role="alert"> <strong>Before you start the process :</strong> Please complete question, interview call and structured interview question profiles. </div>
							<?php endif; ?>
                            </div>
                        </div>
                      </div>
                    </div>
                <!--END CONTENT-->
<?php $this->load->view('partial/portal_footer.php'); ?>
<!-- <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css"> -->
<style type="text/css">
.example-container{margin-bottom: 0;}
.final-results-section .subsection h4{font-size: 15px!important}
.final-results-section .subsection ul li{font-size: 13px!important}
.material-charts-chart-title{font-weight: bold;text-transform: capitalize;}
.example-chart{border-right:none;}
.material-charts-box-chart-vertical-bar.material-charts-blue > div,.material-charts-box-chart-vertical-bar.material-charts-green > div{font-size:10px;left: 2px;position: relative;top: -15px;}
.process_results_detailed h4.panel-title {font-size: 14px!important;}
.process_results_detailed .panel-body h5 {margin:0 0 5px;}
.process_results_detailed ul.result_details {margin-bottom:10px;margin-top: 15px;padding-left: 21px !important;}
.process_results_detailed ul.result_details li {list-style-type:lower-alpha!important;padding-bottom:10px!important;}
#btn_view_detailed_results{margin-bottom:6px;}
</style>
<!-- graph -->
 <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.1/moment.min.js" type="text/javascript"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/js/bootstrap-datetimepicker.min.js" type="text/javascript"></script>
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/css/bootstrap-datetimepicker.min.css">
<?php if($process=='result') echo '<script src="'.base_url().'assets/portal/script/material-charts.js"></script>';?>

<script type="text/javascript">
var total_filtered_candidates = 0;
$(function(){
	var process_stage = '<?=$process?>';
	$(".stepsForm").stepsForm({
			width			:'100%',
			active			: 0,
			errormsg		:'Check faulty fields.',
			sendbtntext		:'Create Account',
			posturl			:'core/demo_steps_form.php',
			theme			:'green',
	}); 

	$('.sf-steps-content > div').removeClass('sf-active'); 
	$('#'+process_stage).addClass('sf-active');
	$('.sf-steps-form .sf-content').hide();
	// alert();
	$('.sf-steps-form .sf-content').eq($('#'+process_stage).index()).slideToggle(); 

	$('.sf-steps-content > div').click(function(){
		location.href = $(this).attr('data-target');
	});

	$('#interview_date_time').datetimepicker({
                format: 'YYYY-MM-DD HH:mm:ss'
            });
	// $('#interview_date_time').datetimepicker();
		
	$(".container .themes>span").click(function(e) {
		$(".container .themes>span").removeClass("selectedx");
		$(this).addClass("selectedx");
         $(".stepsForm").removeClass().addClass("stepsForm");
		$(".stepsForm").addClass("sf-theme-"+$(this).attr("data-value"));
    });

    $(".view-more").click(function(){
		$(this).parents(".panel-body").find(".process-view").slideToggle();
	});

	$(".set-time").change(function(){
		$(".set-interview").show();
	});
	
	$("[name=candidate_profile_id]").change(function(){
		$(this).parents("form:first").find(".can-select-show").show();
	});

	    // $("#interview_date_time").datepicker({
	    //   changeMonth: true,
	    //   changeYear: true
	    // });
    	// $("#interview_date_time").datepicker( "option", "dateFormat",'yy-mm-dd');

    	if(process_stage == 'result')
    	{
			var arr_value1 = set_get_result_table_values($(".final-results").eq(0));
    		var arr_value2 = set_get_result_table_values($(".final-results").eq(1));
    		var arr_value3 = set_get_result_table_values($(".final-results").eq(2));
    		
    		$(".final-results").each(function(index, el) {
    			var thisRow = $(this);
          		//console.log(index);
    			$(".final-results").find('.overal_percentage').each(function(index1, el) {
    				
    				if($('.overal_percentage').eq(index+1).text() != '')
    				{
		              //console.log($('.overal_percentage').eq(index).text());
		              if(parseFloat(thisRow.find('td').last().text()) < parseFloat($(this).text()))
		              {
		                //alert($(this).text());
		                thisRow.next().insertBefore(thisRow);
		              }
		            }
    			});
    			// thisRow.find('td').first().text(index+1);
    		});

    		var arr_value1 = set_get_result_table_values($(".final-results").eq(0));
    		var arr_value2 = set_get_result_table_values($(".final-results").eq(1));
    		var arr_value3 = set_get_result_table_values($(".final-results").eq(2));

	    	if(arr_value1.length)
	    	{
				var exampleBarChartData = {
				"datasets": {
					"values": arr_value1,
					"labels": [
						"step 1", 
						"step 2", 
						"step 3", 
						"step 4", 
						"step 5", 
						"step 6", 
						"step 7" 
					],
					"color": "blue"
				},		
				"title" : $(".final-results").eq(0).find('td').eq(2).text(),
				"height": "300px",
				"width": "450",
				"background": "#FFFFFF",
				"shadowDepth": "1"
				};
				MaterialCharts.bar("#bar-chart-example", exampleBarChartData);
				$('#bar-chart-example').parents(".example-container:first").removeClass('hidden');
				total_filtered_candidates++;

			}
			if($(".final-results").eq(1).length)
	    	{
				var exampleBarChartData = {
				"datasets": {
					"values": arr_value2,
					"labels": [ 
						"step 1", 
						"step 2", 
						"step 3", 
						"step 4", 
						"step 5", 
						"step 6", 
						"step 7" 
					],
					"color": "blue"
				},
				"title" : $(".final-results").eq(1).find('td').eq(2).text(),
				"height": "300px",
				"width": "450",
				"background": "#FFFFFF",
				"shadowDepth": "1"
				};
				MaterialCharts.bar("#bar-chart-example-2", exampleBarChartData);
				$('#bar-chart-example-2').parents(".example-container:first").removeClass('hidden');
				total_filtered_candidates++;

			}

			if($(".final-results").eq(2).length)
	    	{
				var exampleBarChartData = {
				"datasets": {
					"values": arr_value3,
					"labels": [ 
						"step 1", 
						"step 2", 
						"step 3", 
						"step 4", 
						"step 5", 
						"step 6", 
						"step 7" 
					],
					"color": "blue"
				},
				"title" : $(".final-results").eq(2).find('td').eq(2).text(),
				"height": "300px",
				"width": "450",
				"background": "#FFFFFF",
				"shadowDepth": "1"
				};
				MaterialCharts.bar("#bar-chart-example-3", exampleBarChartData);
				$('#bar-chart-example-3').parents(".example-container:first").removeClass('hidden');
				total_filtered_candidates++;
			}

			if($(".final-results").eq(0).length)
			{
				var arr_value4 = get_final_result_values($(".final-results"));
				var exampleBarChartData = {
					"datasets": {
						"values": arr_value4,
						"labels": [
							"step 1", 
							"step 2", 
							"step 3", 
							"step 4", 
							"step 5", 
							"step 6", 
							"step 7" 
						],
						"color": "green"
					},
					"title" : "Overall",	
					"height": "300px",
					"width": "450",
					"background": "#FFFFFF",
					"shadowDepth": "1"
				};

				MaterialCharts.bar("#bar-chart-example-4", exampleBarChartData);
				$('#bar-chart-example-4').parents(".example-container:first").removeClass('hidden');
			}

			$('.material-charts-box-chart-vertical-bar').each(function(){
				$(this).append('<div>'+$(this).attr('data-hover')+'%</div>');
			});
		}
});

function set_get_result_table_values(elementObj)
{
	// alert(elementObj.index());
	elementObj.find('td').first().text(elementObj.index()+1);
	var screening_summary = parseInt(elementObj.find('.screening_summary').text().trim()).toFixed(2);
	var qualification_summary = parseInt(elementObj.find('.qualification_summary').text().trim()).toFixed(2);
	var question_summary = parseInt(elementObj.find('.question_summary').text().trim()).toFixed(2);
	//console.log(question_summary);
	var interview_call_summary = parseInt(elementObj.find('.interview_call_summary').text().trim()).toFixed(2);
	var structured_interview_summary = parseInt(elementObj.find('.structured_interview_summary').text().trim()).toFixed(2);
	var test_summary = parseInt(elementObj.find('.test_summary').text().trim()).toFixed(2);
	var selection_summary = parseInt(elementObj.find('.selection_summary').text().trim()).toFixed(2);
	// console.log((parseInt(screening_summary)+parseInt(qualification_summary)+parseInt(question_summary)+parseInt(interview_call_summary)+parseInt(structured_interview_summary)+parseInt(test_summary)+parseInt(selection_summary)));
	elementObj.find('.overal_percentage').text(((parseFloat(screening_summary)+parseFloat(qualification_summary)+parseFloat(question_summary)+parseFloat(interview_call_summary)+parseFloat(structured_interview_summary)+parseFloat(test_summary)+parseFloat(selection_summary))/7).toFixed(2));
	return [screening_summary,qualification_summary,question_summary,interview_call_summary,structured_interview_summary,test_summary,selection_summary];
}

function get_final_result_values(elementObj)
{
	var screening_summary = 0;
	var qualification_summary = 0;
	var question_summary = 0;
	var interview_call_summary = 0;
	var structured_interview_summary = 0
	var test_summary = 0;
	var selection_summary = 0;

	elementObj.each(function(){
		screening_summary += parseInt($(this).find('.screening_summary').text().trim());
		qualification_summary += parseInt($(this).find('.qualification_summary').text().trim());
		question_summary += parseInt($(this).find('.question_summary').text().trim());
		//console.log(question_summary);
		interview_call_summary += parseInt($(this).find('.interview_call_summary').text().trim());
		structured_interview_summary += parseInt($(this).find('.structured_interview_summary').text().trim());
		test_summary += parseInt($(this).find('.test_summary').text().trim());
		selection_summary += parseInt($(this).find('.selection_summary').text().trim());
	});
	screening_summary = (parseInt(screening_summary)/total_filtered_candidates).toFixed(2);
	qualification_summary = (parseInt(qualification_summary)/total_filtered_candidates).toFixed(2);
	question_summary = (parseInt(question_summary)/total_filtered_candidates).toFixed(2);
	interview_call_summary = (parseInt(interview_call_summary)/total_filtered_candidates).toFixed(2);
	structured_interview_summary = (parseInt(structured_interview_summary)/2).toFixed(2);
	test_summary = (parseInt(test_summary)/total_filtered_candidates).toFixed(2);
	selection_summary = (parseInt(selection_summary)/total_filtered_candidates).toFixed(2);
	return [screening_summary,qualification_summary,question_summary,interview_call_summary,structured_interview_summary,test_summary,selection_summary];
}

</script>