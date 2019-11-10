<?php $this->load->view('partial/portal_header.php'); ?>
<?php $this->load->view('partial/portal_sidebar.php'); ?>
<?php $this->load->view('partial/portal_breadcrumbs.php'); ?>
<!--BEGIN CONTENT-->
                <div class="page-content">
                    <div id="tab-general">
                        <div class="row mbl">
                            <div class="col-lg-9 block-space">
                                <div class="panel">
                                    <div class="panel-body">
                                        <div class="row">
                                            <div class="col-md-12 col-sm-12">
                                                <form action="<?=base_url()?>employer/send_candidate_message" method="POST" role="form" enctype="multipart/form-data">
                                                <div class="col-md-8 col-sm-8 left-padding section-content">
                                                    <input type="hidden" name="candidate_profile_id" id="candidate_profile_id" value="<?=isset($profile->candidate_profile_id) ? $profile->candidate_profile_id : 0?>"/>
                                                    <input type="hidden" name="candidate_email" id="candidate_email" value="<?=isset($contact->email) ? $contact->email : ''?>"/>
                                                    <input type="hidden" name="candidate_name" id="candidate_name" value="<?=isset($profile->first_name) ? $profile->first_name.' '.$profile->last_name : ''?>"/>
                                                    <h3>Create Message</h3>
                                                    <p><b>Candidate Name : </b><?=isset($profile->first_name) ? $profile->first_name.' '.$profile->last_name : ''?></p>
                                                    <p><b>Candidate Email : </b><span class="cn_email"><?=isset($contact->email)? $contact->email :'-'?></span></p>
                                                    <h4>Subject</h4>
                                                    <input class="col-md-12 col-sm-12" required="required" name="subject" id="subject">
                                                    
                                                    <h4>Message</h4>
                                                    <textarea class="col-md-12 col-sm-12" rows="10" required="required" name="message" id="message"></textarea>
                                                    
                                                    <div class="form-actions">
                                                    <button type="submit" class="btn btn-primary">
                                                        Send Message</button>
                                                    </div>
                                                </div>
                                                </form>
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
