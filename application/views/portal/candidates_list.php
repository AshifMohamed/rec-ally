<?php $this->load->view('partial/portal_header.php'); ?>
<?php $this->load->view('partial/portal_sidebar.php'); ?>
<?php $this->load->view('partial/portal_breadcrumbs.php'); ?>

<!--BEGIN CONTENT-->
                <div class="page-content">
                    <div id="tab-general">
                        <div class="mbl row ">
  							<div class="col-lg-12">
	                            <div class="panel panel-blue left-padding right-padding" style="background:#FFF;">
	                            		<?php $page_view_segment = $this->uri->segment(5);?>
										<div class="panel-heading">
											<?=$view_type != 'interview_schedule' ? 'Candidates List - '.ucwords(str_replace('_',' ',$page_view_segment)) : 'Interview Schedules' ?>
										</div>
										<div class="panel-body">
										<?php if($view_type == 'question' || $view_type == 'interview_call' || $view_type == 'structured_interview' || $view_type == 'test' || $view_type == 'selection'):?>
												<span class="pull-right btn label-success" data-toggle="modal" href="#modal_individual_process_results" style="position: relative; right: -13px; top: -58px; color: white;">View Results</span>
												<div class="modal fade" id="modal_individual_process_results">
													<div class="modal-dialog">
														<div class="modal-content">
															<div class="modal-header">
																<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
																<h4 class="modal-title"><?=ucwords(str_replace('_',' ',$view_type))?></h4>
															</div>
															<div class="modal-body">
																<?php if($view_type == 'question' || $view_type == 'interview_call' || $view_type == 'structured_interview'):?>
																	<div class="panel-group individual_process_results" id="accordion" role="tablist" aria-multiselectable="true">
																	<?php foreach ($candidate_summaries as $key => $summary) : ?>  
						                                            	<?php foreach ($candidate_profiles as $key1 => $candidate) : ?>
						                                            		<?php if($summary->candidate_profile_id == $candidate->candidate_profile_id): ?>
						                                            			<?php $questions = get_job_profile_questions_by_job_profile_candidate_profile_and_type($job_profile_id,$candidate->candidate_profile_id,$view_type); ?>
																					  <div class="panel panel-default">
																					    <div class="panel-heading" role="tab" id="headingOne">
																					      <h4 class="panel-title">
																					        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse<?=$key?>" aria-expanded="true" aria-controls="collapseOne">
																					          <?=$candidate->first_name.' '.$candidate->last_name?> <small><b>(total points :  <?=number_format(get_percentage_value($summary->points,$summary->total_questions*$multiply_total),2)?>)</b></small>
																					        </a>
																					      </h4>
																					    </div>
																					    <div id="collapse<?=$key?>" class="panel-collapse collapse <?=$key==0? 'in':''?>" role="tabpanel" aria-labelledby="headingOne">
																					    	<?php 
																					    		if($view_type == 'interview_call' || $view_type == 'test' || $view_type == 'selection'):
																					    			$attachment = get_attachment_by_job_profile_candidate_profile_and($job_profile_id,$candidate->candidate_profile_id); 
																					    	?>
																					   		<?php endif; ?>
																						     <div class="panel-body">
																						      		<ul class="result_details">
																										<?php foreach ($questions as $key => $question) : ?>
																											<li><?=$question->question?><br/> <b>Answer:</b> <?=ucwords(str_replace('_',' ', $question->choice))?> </li>
																										<?php endforeach; ?>
																									</ul>
																									<?php if($view_type == 'interview_call'): ?>
																											<a download class="label <?=isset($attachment->interview_call)? 'label-success' : 'label-info'?>" href="<?=isset($attachment->interview_call) ? base_url().'uploads/shortlisting_feedback_attachments/'.$attachment->interview_call : '#'?>" <?=isset($attachment->interview_call)? 'target="_blank"' : '' ?> > <?=isset($attachment->interview_call)? 'View Interview Call' : 'No Attachment Available'?></a><br/></br>
																									<?php endif; ?>
																						      </div>
																					    </div>
																					  </div>
																			<?php break; endif; ?>
																		<?php endforeach; ?>
																	<?php endforeach; ?>
																	</div>
																<?php endif; ?>
																<?php if($view_type == 'test' || $view_type == 'selection'):?>
																	<div class="panel-group individual_process_results test_selection" id="accordion" role="tablist" aria-multiselectable="true">
																		<ul class="result_details">
																		<?php foreach ($candidate_summaries as $key => $summary) : ?>  
							                                            	<?php foreach ($candidate_profiles as $key1 => $candidate) : ?>
							                                            		<?php if($summary->candidate_profile_id == $candidate->candidate_profile_id): ?>
																							<?php $attachment = get_attachment_by_job_profile_candidate_profile_and($job_profile_id,$candidate->candidate_profile_id); ?>
																								<li> 
																									<?=$candidate->first_name.' '.$candidate->last_name?> - <?=$summary->points?> points
																									<ul>
																										<li>
																											<?php if($view_type == 'test'): ?>
																													<a download class="label <?=isset($attachment->test)? 'label-success' : 'label-info'?>" href="<?=isset($attachment->test) ? base_url().'uploads/shortlisting_feedback_attachments/'.$attachment->test : '#'?>" <?=isset($attachment->test)? 'target="_blank"' : '' ?> > <?=isset($attachment->test)? 'View Test Attachment' : 'No Attachment Available'?></a>
																											<?php elseif($view_type == 'selection'): ?>
																													<a download class="label <?=isset($attachment->selection)? 'label-success' : 'label-info'?>" href="<?=isset($attachment->selection) ? base_url().'uploads/shortlisting_feedback_attachments/'.$attachment->selection : '#'?>" <?=isset($attachment->selection)? 'target="_blank"' : '' ?> > <?=isset($attachment->selection)? 'View Selection Attachment' : 'No Attachment Available'?></a>
																											<?php endif; ?>
																										</li>
																									</ul>
																								</li>
																								
																							
																				<?php break; endif; ?>
																			<?php endforeach; ?>
																		<?php endforeach; ?>
																		</ul>
																	</div>
																<?php endif; ?>
															</div>
															<div class="modal-footer">
																<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
															</div>
														</div>
													</div>
												</div>
										<?php endif;?>
										<?php if(count($candidate_profiles) > 0): ?>
											<?php if($view_type != 'interview_schedule'): ?>
												<table class="table table-hover table-bordered">
													<thead>
													<tr>
														<th><?=isset($candidate_summaries) ?'Rank (#)' : '#'?></th>
														<th>Candidate Name</th>
														<th>Level of Position</th>
														<th>Country</th>
														<?=isset($candidate_summaries) ?'<th>Points</th>' : ''?>
														<th>Actions</th>
													</tr>
													</thead>
													<tbody>
													<?php if(isset($candidate_summaries)): ?>
			                                            <?php foreach ($candidate_summaries as $key => $summary) : ?>  
			                                            	<?php foreach ($candidate_profiles as $key1 => $profile) : ?>
			                                            		<?php if($summary->candidate_profile_id == $profile->candidate_profile_id): ?>
																	<tr>
																		<td><?=$key+1?></td>
																		<td><?=$profile->first_name.' '.$profile->last_name?></td>
																		<td><?=$profile->career_level?></td>
																		<td><?=$profile->country?></td>
																		<?php if(isset($candidate_summaries)): ?>
																			<?php if($view_type == 'question' || $view_type == 'interview_call' || $view_type == 'structured_interview'): ?>
																				<td><?=number_format(get_percentage_value($summary->points,$summary->total_questions*$multiply_total),2)?></td>
																			<?php else: ?>
																				<td><?=number_format($summary->points,2)?></td>
																			<?php endif; ?>
																		<?php endif; ?>
																		<td><a href="<?=base_url()?>employer/view_candidate/<?=$profile->candidate_profile_id?>"><span class="label label-sm label-info">View Profile</span></a></td>
																	</tr>
																<?php break; endif; ?>
															<?php endforeach; ?>
														<?php endforeach; ?>
													<?php else: ?>
														<?php foreach ($candidate_profiles as $key => $profile) : ?>
															<tr>
																<td><?=$key+1?></td>
																<td><?=$profile->first_name.' '.$profile->last_name?></td>
																<td><?=$profile->career_level?></td>
																<td><?=$profile->country?></td>
																<td><a href="<?=base_url()?>employer/view_candidate/<?=$profile->candidate_profile_id?>"><span class="label label-sm label-info">View Profile</span></a>
                                                                                                                                    <a href="<?=base_url()?>employer/draft_candidate_message/<?=$profile->candidate_profile_id?>"><span class="label label-sm label-info">Send Message</span></a>
                                                                                                                                </td>
															</tr>
															<?php endforeach; ?>
													<?php endif; ?>
													</tbody>
												</table>
											<?php else: ?>
												<table class="table table-hover table-bordered">
													<thead>
													<tr>
														<th>#</th>
														<th>Candidate Name</th>
														<th>Country</th>
														<th>Date and Time</th>
														<th>Accepted/Rejected</th>
														<th>Actions</th>
													</tr>
													</thead>
													<tbody> 
			                                            <?php foreach ($candidate_profiles as $key => $profile) : ?>
															<tr>
																<td><?=$key+1?></td>
																<td><?=$profile->first_name.' '.$profile->last_name?></td>
																<td><?=$profile->country?></td>
																<td><?=$profile->interview_date?></td> 
																<td><?php if($profile->status==-1) echo 'Pending'; elseif($profile->status==1) echo 'Accepted'; elseif($profile->status==0) echo 'Rejected'; ?></td>
																<td><a href="<?=base_url()?>employer/view_candidate/<?=$profile->candidate_profile_id?>"><span class="label label-sm label-info">View Profile</span></a></td>
															</tr>
														<?php endforeach; ?>
													</tbody>
												</table>
											<?php endif; ?>
										<?php else: ?>
											<div class="alert alert-info" role="alert"> No candidates found to be displayed.</div>
										<?php endif; ?>
	                                    </div>
	                            </div>
                        	</div>
                        </div>
                    </div>
                    <!-- <?php $this->load->view('/partial/portal_candidate_search'); ?> -->
                </div>
              </div>
            </div>
 <!--END CONTENT-->
<style>
.page-content .col-lg-3:last-child {
    visibility: hidden;
}

.individual_process_results .panel-title
{
	font-size: 14px!important;
}

.individual_process_results ul.result_details {
    margin-bottom: 0;
    margin-top: 0;
    padding-left: 21px !important;
}
.individual_process_results .panel-body {
    padding:15px 20px 0;
}

.individual_process_results ul.result_details > li {
    list-style-type: lower-alpha !important;
    padding-bottom: 10px !important;
}
.individual_process_results ul.result_details ~ a {
    font-size: 13px!important;
}

.individual_process_results.test_selection ul.result_details > li {
	list-style-type: decimal!important;
	padding-bottom: 10px !important;
}

.individual_process_results.test_selection ul.result_details > li > ul
{
	margin-top: 5px;
}
</style>
<?php $this->load->view('partial/portal_footer.php'); ?>
