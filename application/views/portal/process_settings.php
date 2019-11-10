<?php $this->load->view('partial/portal_header.php'); ?>
<?php $this->load->view('partial/portal_sidebar.php'); ?>
<?php $this->load->view('partial/portal_breadcrumbs.php'); ?>
<style type="text/css">
#feedback_submissions_header.nav > li > a
{
	padding:10px!important;
}
</style>
<!--BEGIN CONTENT-->
                <div class="page-content">
                    <div id="tab-general">
                                <div class="panel">
									<div class="panel-heading">Feedback Submissions for Shortlisting Processes</div>
									<div class="panel-body">
										<ul class="nav nav-tabs" id="feedback_submissions_header">
											  <li class="active"><a data-toggle="tab" href="#interview_call">Interview Call FeedBack</a></li>
											  <li><a data-toggle="tab" href="#structured_interview">Structured Interview Feedback</a></li>
											  <li><a data-toggle="tab" href="#test">Test Feedback</a></li>
											  <li><a data-toggle="tab" href="#selection">Selection Feedback</a></li>
											  <!-- <li><a data-toggle="tab" href="#update_attachments">Update Attachments</a></li> -->
										</ul>
										<div class="tab-content">
											<div id="interview_call" class="tab-pane fade in active clearfix">
												<?php if($process_completed == 'question' || $process_completed == 'interview_call_request'): ?>
													<?php if($interview_call_feedback_count != count($candidates)): ?>
														<form action="<?=base_url()?>employer/save_question_profile_answers/<?=$job_profile_id?>?process=interview_call" name="interview_call_profile_form" enctype="multipart/form-data" method="POST">
															<?php if($interview_scheduling_completed): ?>
																<div class="col-md-5 col-sm-5 left-padding proc-tab">
																	<label class="control-label" for="gender">
																	Candidate</label>
																	<select class="form-control" id="candidate_profile_id" name="candidate_profile_id">
																		<option value="0">Please Select</option>
																		<?php foreach ($candidates as $key => $candidate) { ?>
																			<?php if(is_question_feedback_set($candidate->candidate_profile_id,$job_profile_id,'interview_call') == 0) :  ?>
																				<option value="<?=$candidate->candidate_profile_id?>"><?=$candidate->first_name.' '.$candidate->last_name?></option>
																			<?php endif; ?>		
																		<?php } ?>
																	</select>
																</div>
																<div style="clear:both;"></div>
																<div class="interview-call-questions can-select-show">
																	<ul>
																		<?php foreach ($interview_call_questions as $key => $question) { ?>
																		<li>
																			<p><?=$question->question?> </p>
																			<input type="radio" value="excellent_4" name="<?=$question->job_profile_question_id?>[]">Excellent &nbsp;
																			<input type="radio" value="very good_3" name="<?=$question->job_profile_question_id?>[]">Very good &nbsp;
																			<input type="radio" checked value="good_2" name="<?=$question->job_profile_question_id?>[]">Good &nbsp;
																			<input type="radio" value="acceptable_1" name="<?=$question->job_profile_question_id?>[]">Acceptable &nbsp;
																			<input type="radio" value="not acceptable_0" name="<?=$question->job_profile_question_id?>[]">Not acceptable &nbsp;
																		</li>
																		<?php } ?>
																		<br/>
																	</ul>
																	<input type="file" id="interview_call_file" name="interview_call_file">
																	<button class="btn btn-primary pull-right" type="submit">Save Feedback</button>
																</div>
															<?php else: ?>
																<div class="alert alert-danger" role="alert">Please schedule interviews for all users before you can proceed with feedback submissons</div>
															<?php endif;?>
														</form>
													<?php else: ?>
														<div class="alert alert-success" role="alert">Feedbacks submitted for this process. Please continue with the others tasks</div>
													<?php endif;?>
												<?php else: ?>
														<div class="alert alert-danger" role="alert">This feedback section is either completed or not available yet</div>
												<?php endif;?>	
											</div>
											<div id="structured_interview" class="tab-pane fade clearfix">
												<?php if($process_completed == 'interview_call'): ?>
													<?php if($structured_interview_feedback_count != count($candidates)): ?>
													<form action="<?=base_url()?>employer/save_question_profile_answers/<?=$job_profile_id?>?process=structured_interview" name="structured_interview_profile_form" method="POST">
															<div class="col-md-5 col-sm-5 left-padding proc-tab">
																<label class="control-label" for="gender">
																Candidate</label>
																<select class="form-control" id="candidate_profile_id" name="candidate_profile_id">
																	<option value="0">Please Select</option>
																	<?php foreach ($candidates as $key => $candidate) { ?>
																		<?php if(is_question_feedback_set($candidate->candidate_profile_id,$job_profile_id,'structured_interview') == 0) :  ?>
																			<option value="<?=$candidate->candidate_profile_id?>"><?=$candidate->first_name.' '.$candidate->last_name?></option>
																		<?php endif; ?>		
																	<?php } ?>
																</select>
															</div>
															<div style="clear:both;"></div>
															<div class="structure-interview-questions can-select-show">
																<ul>
																	<?php foreach ($structured_interview_questions as $key => $question) { ?>
																	<li>
																		<p><?=$question->question?> </p>
																		<input type="radio" value="excellent_4" name="<?=$question->job_profile_question_id?>[]">Excellent &nbsp;
																		<input type="radio" value="very good_3" name="<?=$question->job_profile_question_id?>[]">Very good &nbsp;
																		<input type="radio" checked value="good_2" name="<?=$question->job_profile_question_id?>[]">Good &nbsp;
																		<input type="radio" value="acceptable_1" name="<?=$question->job_profile_question_id?>[]">Acceptable &nbsp;
																		<input type="radio" value="not acceptable_0" name="<?=$question->job_profile_question_id?>[]">Not acceptable &nbsp;
																	</li>
																	<?php } ?>
																	<br/>
																</ul>
																<button class="btn btn-primary pull-right" type="submit">Save Feedback</button>
															</div>
													</form>
													<?php else: ?>
														<div class="alert alert-success" role="alert">Feedbacks submitted for this process. Please continue with the others tasks</div>
													<?php endif;?>
												<?php else: ?>
													<div class="alert alert-danger" role="alert">This feedback section is either completed or not available yet</div>
												<?php endif;?>
											</div> 
											<div id="test" class="tab-pane fade clearfix">
												<?php if($process_completed == 'structured_interview'): ?>
													<?php if($test_feedback_count != count($candidates)): ?>
														<form action="<?=base_url()?>employer/save_test_selection_points/<?=$job_profile_id?>?process=test" name="test_profile_form" enctype="multipart/form-data" method="POST">
																<div class="col-md-5 col-sm-5 left-padding proc-tab">
																	<label class="control-label" for="gender">
																	Candidate</label>
																	<select class="form-control" id="candidate_profile_id" name="candidate_profile_id">
																		<option value="0">Please Select</option>
																		<?php foreach ($candidates as $key => $candidate) { ?>
																			<?php if(is_test_selection_feedback_set($candidate->candidate_profile_id,$job_profile_id,'test') == 0) :  ?>
																				<option value="<?=$candidate->candidate_profile_id?>"><?=$candidate->first_name.' '.$candidate->last_name?></option>
																			<?php endif; ?>		
																		<?php } ?>
																	</select>
																</div>
																<div style="clear:both;"></div>
																<div class="test-profile can-select-show">
																	<input type="number" value="" name="test_points" class="pull-left" placeholder="Enter Marks">
																	<input type="file" id="results_file" name="results_file">
																	<div class="clearfix"></div><br/>
																	<button class="btn btn-primary" type="submit">Save Feedback</button>
																</div>
														</form>
													<?php else: ?>
														<div class="alert alert-success" role="alert">Feedbacks submitted for this process. Please continue with the others tasks</div>
													<?php endif;?>
												<?php else: ?>
													<div class="alert alert-danger" role="alert">This feedback section is either completed or not available yet</div>
												<?php endif;?>
											</div>
											<div id="selection" class="tab-pane fade clearfix">
												<?php if($process_completed == 'test'): ?>
													<?php if($selection_feedback_count != count($candidates)): ?>
														<form action="<?=base_url()?>employer/save_test_selection_points/<?=$job_profile_id?>?process=selection" name="selection_profile_form" enctype="multipart/form-data" method="POST">
																<div class="col-md-5 col-sm-5 left-padding proc-tab">
																	<label class="control-label" for="gender">
																	Candidate</label>
																	<select class="form-control" id="candidate_profile_id" name="candidate_profile_id">
																		<option value="0">Please Select</option>
																		<?php foreach ($candidates as $key => $candidate) { ?>
																			<?php if(is_test_selection_feedback_set($candidate->candidate_profile_id,$job_profile_id,'selection') == 0) :  ?>
																				<option value="<?=$candidate->candidate_profile_id?>"><?=$candidate->first_name.' '.$candidate->last_name?></option>
																			<?php endif; ?>		
																		<?php } ?>
																	</select>
																</div>
																<div style="clear:both;"></div>
																<div class="selection-profile can-select-show">
																	<input type="number" value="" name="test_points" class="pull-left" placeholder="Enter Marks">
																	<input type="file" id="results_file" name="results_file">
																	<div class="clearfix"></div><br/>
																	<button class="btn btn-primary" type="submit">Save Feedback</button>
																</div>
														</form>
													<?php else: ?>
														<div class="alert alert-success" role="alert">Feedbacks submitted for this process. Please continue with the others tasks</div>
													<?php endif;?>
												<?php else: ?>
													<div class="alert alert-danger" role="alert">This feedback section is either completed or not available yet</div>
												<?php endif;?>
											</div>
											<!-- <div id="update_attachments" class="tab-pane fade clearfix">
												<?php if($process_completed == 'selection'): ?>
													<form action="<?=base_url()?>employer/update_attachments/<?=$job_profile_id?>" name="update_attachments_form" enctype="multipart/form-data" method="POST">
															<div class="col-md-5 col-sm-5 left-padding proc-tab">
																<label class="control-label" for="candidate_profile_id">
																Candidate</label>
																<select class="form-control" id="candidate_profile_id" name="candidate_profile_id">
																	<option value="0">Please Select</option>
																	<?php foreach ($candidates as $key => $candidate) { ?>
																			<option value="<?=$candidate->candidate_profile_id?>"><?=$candidate->first_name.' '.$candidate->last_name?></option>
																	<?php } ?>
																</select>
															</div>
															<div style="clear:both;"></div>
															<?php foreach ($candidates as $key => $candidate) { ?>
																<?php $attachment = get_attachment_by_job_profile_candidate_profile_and($job_profile_id,$candidate->candidate_profile_id); ?>
																<div class="can-select-show update_attachment_<?=$candidate->candidate_profile_id?>">
																	<ol class="dd-list">
																	    <li data-id="1" class="dd-item">
																	        <div class="dd-handle"><h4>Interview Call Attachment</h4></div>
																	        <div class="code-pos">
																	            <div class="form-group">
																	                <input id="interview_call_file" name="interview_call_file" type="file" placeholder="Inlcude some file">
																	                <a href="<?=isset($attachment->interview_call) ? base_url().'uploads/job_profile_attachments/'.$attachment->interview_call : '#'?>" target="_blank"><?=isset($attachment->interview_call)? $attachment->interview_call : 'no attachment available'?></a>
																	            </div>
																	            <div style="clear:both;"></div>
																	        </div>
																	    </li>
																	    <li data-id="1" class="dd-item">
																	        <div class="dd-handle"><h4>Test Attachment</h4></div>
																	        <div class="code-pos">
																	            <div class="form-group">
																	                <input id="test_file" name="test_file" type="file">
																	                <a href="<?=isset($attachment->test) ? base_url().'uploads/job_profile_attachments/'.$attachment->test : '#'?>" target="_blank"><?=isset($attachment->test)? $attachment->test : 'no attachment available'?></a>
																	            </div>
																	            <div style="clear:both;"></div>
																	        </div>
																	    </li>
																	    <li data-id="1" class="dd-item">
																	        <div class="dd-handle"><h4>Selection Attachment</h4></div>
																	        <div class="code-pos">
																	            <div class="form-group">
																	                <input id="selection_file" name="selection_file" type="file">
																	                <a href="<?=isset($attachment->selection) ? base_url().'uploads/job_profile_attachments/'.$attachment->selection : '#'?>" target="_blank"><?=isset($attachment->selection)? $attachment->selection : 'no attachment available'?></a>
																	            </div>
																	            <div style="clear:both;"></div>
																	        </div>
																	        <br/>
																	    </li>
																	</ol>
																	<input type="submit" value="Upload Attachments" class="pull-right btn btn-info" /> 
																	<div class="clearfix"></div>
																</div>
															<?php } ?>
													</form>
												<?php else: ?>
													<div class="alert alert-danger" role="alert">Please complete the entire recruitment process before updating any attachments.</div>
												<?php endif;?>
											</div> -->
										</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                      </div>
                    </div>
                <!--END CONTENT-->
<?php $this->load->view('partial/portal_footer.php'); ?>

<style type="text/css">
input[name="test_points"] {
    margin-right: 10px;
}
</style>
<script type="text/javascript">
$(function(){
	// $(".nav-tabs a").click(function(){
 //   		$(this).tab('show');
	// });
	$("[name=candidate_profile_id]").change(function(){
		$(this).parents("form:first").find(".can-select-show").show();
	});

	if(document.URL.match('interview_call'))
	{
	    $('a[href="#interview_call"]').tab('show');
	}
	else if(document.URL.match('structured_interview'))
	{
	    $('a[href="#structured_interview"]').tab('show');
	}
	else if(document.URL.match('test'))
	{
	    $('a[href="#test"]').tab('show');
	}
	else if(document.URL.match('selection'))
	{
	    $('a[href="#selection"]').tab('show');
	}
});
</script>