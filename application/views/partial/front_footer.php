
    <div class="footer-wrapper">
    <div class="footer">
        <div class="footer-top">
            <div class="container">
                <div class="row">
                    <div class="col-sm-5 col-md-5 wow pulse">
                        <div class="footer-top-block footer-abt">
                            <h2><img  data-toggle="modal" data-target="#how_porta_works_modal" src="<?=base_url()?>assets/front/img/sub-logo.png"/> I'm Recruiter</h2>
								 <p>I’m your gateway to success whether you are a job seeker or worker seeker I’m your convenience seeker, I’m your mean to achieve your work dream and I’m designed to help you hurriedly reach your goals and find the suitable worker for your job. </p>
                        </div><!-- /.footer-top-block -->
                    </div><!-- /.col-* -->

                    <div class="col-sm-3 col-md-3 wow pulse">
                        <div class="footer-top-block">
                            <h2>Quick Links</h2>
                            <ul>
                                <li><a href="<?=base_url()?>">Home</a></li>
                                <li><a href="<?=base_url()?>about_us">About Us</a></li>
                                <li><a href="<?=base_url()?>contact_us">Contact Us</a></li>
                                <li><a href="<?=base_url()?>terms_conditions">Terms &amp; Conditions</a></li>
                                <li><a href="<?=base_url()?>privacy_policy">Privacy policy</a></li>
                            </ul>
                        </div><!-- /.footer-top-block -->
                    </div><!-- /.col-* -->
                    <div class="col-md-4 col-sm-4 wow pulse">
                        <div class="footer-top-block">
                            <h2>Stay Connected</h2>
                            <ul class="social-links">
                                <li><a target="_blank" href="https://www.facebook.com/webnetally/"><i class="fa fa-facebook"></i></a></li>
                                <li><a target="_blank" href="https://twitter.com/amjeddmour"><i class="fa fa-twitter"></i></a></li>
                                <li><a target="_blank" href="https://www.linkedin.com/company/webnet-ally?trk=top_nav_home"><i class="fa fa-linkedin"></i></a></li>
                                <li><a href="#"><i class="fa fa-tumblr"></i></a></li>
                            </ul>
                            <ul class="col-md-6 col-sm-6">
                                    <a class="twitter-timeline" data-dnt="true" href="https://twitter.com/amjeddmour" data-widget-id="705767092629286912">Tweets by @amjeddmour</a>
                                    <script defer="defer">!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.async="true";js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
                            </ul>
                        </div><!-- /.footer-top-left -->
                    </div><!-- /.col-* -->
                </div><!-- /.row -->
            </div><!-- /.container -->
        </div><!-- /.footer-top -->

        <div class="footer-bottom">
            <div class="container">
                <div class="footer-bottom-left wow flipInX">
                    &copy; <a href="<?=base_url()?>">Recruitment Ally</a>, 2016 All rights reserved.
                </div><!-- /.footer-bottom-left -->
                <div class="footer-bottom-right pull-left wow flipInX" style="margin-left:34px;">
                    Created by <a href="http://webnet-ally.com/" target="_blank">Webnet Ally Development Team</a>. 
                </div><!-- /.footer-bottom-right -->
            </div><!-- /.container -->
        </div><!-- /.footer-bottom -->
    </div><!-- /.footer -->
</div><!-- /.footer-wrapper -->
<!--Start of Tawk.to Script-->
<script type="text/javascript">
var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/568e5f93f4886f6f1e51c0eb/default';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();
</script>
<!--End of Tawk.to Script-->
</div><!-- /.page-wrapper -->
                        <?php if(!is_user_logged_in()): ?>
                        <!-- ModalStart -->
                            <div class="modal fade login-modal" id="login_modal" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog pop-modal col-md-7 col-sm-7">
                                            <div class="modal-content">
                                                <div class="modal-header">
    													<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
    													</button>
    													<h4 class="modal-title" id="myModalLabel">Login</h4>
                                                </div>
                                        <div class="modal-body">
    										       <form method="POST" action="login/validate" name="candidate_login_form">
    													<div class="section-title">
    													</div>
    													<div class="alert hidden" role="alert"></div>
    													<div class="textbox-wrap">
    														<div class="input-group">
    															<span class="input-group-addon "><i class="fa fa-user"></i></span>
    															<input type="email" name="email" required="required" class="form-control" placeholder="Email">
    														</div>
    													</div>
    													<div class="textbox-wrap">
    														<div class="input-group">
    															<span class="input-group-addon "><i class="fa fa-key"></i></span>
    															<input type="password" name="password" required="required" class="form-control " placeholder="Password">
    														</div>
    													</div>
    													<div class="forgot">
    														 <div class="login-check">
    															<label class="checkbox1"><input type="checkbox" name="remember_me"><i></i>Remember Me</label>
    														 </div>
    														  <div class="login-para">
    															<p><a data-target="#reset_password_modal" data-toggle="modal" href="#"> Forgot Password? </a></p>
    														 </div>
    														 <div class="clearfix"></div>
    													</div>
    													<div class="login-btn">
    													   <input type="submit" value="Sign In" name="btn-login" id="btn-login" class="btn btn-primary">
    													</div>
    													<div class="login-bottom">
    														 <p>With your social media account</p>
    														 <div class="social-icons">
    															<div class="button">
    																<a class="lk" href="<?=base_url()?>login/linkedin"> <i class="fa fa-linkedin tw2"> </i><span>LinkedIn</span>
    																<div class="clearfix"> </div></a>
    																<a class="tw" href="<?=base_url()?>login/twitter/"> <i class="fa fa-twitter tw2"> </i><span>Twitter</span>
    																<div class="clearfix"> </div></a>
    																<a class="go" href="<?=get_google_auth_url()?>"><i class="fa fa-google-plus tw2"> </i><span>Google+</span>
    																<div class="clearfix"> </div></a>
    																<div class="clearfix"> </div>
    															</div>
    													</div>
    													</div>
    												</form>
    												<!-- 	<div class="modal-footer">
    														<h4>Don,t have an Account? <a href="register.html" data-toggle="modal" data-target=".bs-example-modal-lg-2"> Register Now!</a></h4>
    													</div> -->
                                        </div>
        							</div>
                                </div>
                            </div>
    						<!-- ModalEnd -->
    						<!-- ModalStart -->
    						<div class="modal fade register-modal" id="register_modal" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog pop-modal col-md-7 col-sm-7">
                                    <div class="modal-content">
                                        <div class="modal-body">
                                                <div class="registration_confirmation_verification hidden candidate_message">
                                                    <p class="success-msg">Thank you for signing up!</p>
                                                    <p class="shortly-msg">A verfication email has been sent to the email address you had provided us with. </p>
                                                    <p class="shortly-msg">Please check your inbox/spam folder and click on the "Confirm Email" button to verfiy your email address</p>
                                                    <!-- <div class="start-now-wrap">
                                                        <div class="col-md-3 col-sm-3">
                                                        <button type="button" class="verification-email-button btn btn-primary">Re-send Verification Email!</button>
                                                        </div>  
                                                        <div style="clear:both;"></div>
                                                    </div>
                                                    -->
                                                </div>
                                                <div class="registration_confirmation_verification hidden employer_message">
                                                    <p class="success-msg">Thank you for signing up!</p>
                                                    <p class="shortly-msg">An email has been sent to you. Please check your inbox/spam folder</p>
                                                    <!-- <div class="start-now-wrap">
                                                        <div class="col-md-3 col-sm-3">
                                                        <button type="button" class="verification-email-button btn btn-primary">Re-send Verification Email!</button>
                                                        </div>
                                                        <div style="clear:both;"></div>
                                                    </div>
                                                    -->
                                                </div>
    											 <ul class="nav nav-tabs">
    											     <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
    											     </button>
    												<li class="active"><a data-toggle="tab" href="#home">Register as a Job Seeker</a></li>
    												<li><a data-toggle="tab" href="#menu1">Register as a Employer</a></li>
    											 </ul> 
                                                 <div class="alert hidden" role="alert"></div>
    											  <div class="tab-content">
    													<div id="home" class="tab-pane fade in active">
    														<form role="form" method="POST" name="candidate_register_form" id="candidate_register_form">
    															<div class="form-group">
    																<div class="comp-reg-box">
    																	<input class="col-md-12 col-sm-12 col-xs-12" type="text" id="first_name" name="first_name" placeholder="First  Name" required="required" />
    																	<input class="col-md-12 col-sm-12 col-xs-12" type="text" id="last_name" name="last_name" placeholder="Last Name" required="required" />
    																	<input class="col-md-12 col-sm-12 col-xs-12" type="email" id="email" name="email" placeholder="Email" required="required" />
    																	<!-- <input class="col-md-12 col-sm-12 col-xs-12" type="text" id="" name="" placeholder="Current Location" required="required" /> -->
    																	<input class="col-md-12 col-sm-12 col-xs-12" type="password" id="password" name="password" placeholder="Password" required="required" />
    																	<p> <input type="checkbox" name="agree_to_terms" required /> Agree to our <a target="_blank" href="<?=base_url()?>terms_conditions">terms and conditions</a> and <a target="_blank" href="<?=base_url()?>privacy_policy">privacy policy</a></p>
    																	<button class="col-md-12 col-sm-12 col-xs-12 btn btn-primary" type="submit" id="btn_candidate_register_form">Register</button>
    																</div>
    																<div style="clear:both;"></div>
    															</div>
    														</form>	
    													</div>
    													<div id="menu1" class="tab-pane fade">
    														<form role="form" method="POST" name="employer_register_form" id="employer_register_form">
    															<div class="form-group">
    																<div class="comp-reg-box">
    																	<input class="col-md-12 col-sm-12 col-xs-12" type="text" id="company_name" name="company_name" placeholder="Company Name" required="required" />
    																	<input class="col-md-12 col-sm-12 col-xs-12" type="text" id="owners_name" name="owners_name" placeholder="Owner's Name" required="required" />
    																	<input class="col-md-12 col-sm-12 col-xs-12" type="email" id="email" name="email" placeholder="Email" required="required" />
    																	<input class="col-md-12 col-sm-12 col-xs-12" type="password" id="password" name="password" placeholder="Password" required="required" />
    																	<p> <input type="checkbox" name="agree_to_terms" required/> Agree to our <a target="_blank" href="<?=base_url()?>terms_conditions">terms and conditions</a> and <a target="_blank" href="<?=base_url()?>privacy_policy">privacy policy</a></p>
    																	<button class="col-md-12 col-sm-12 col-xs-12 btn btn-primary" type="submit" id="btn_employer_register_form">Register</button>
    																</div>
    																<div style="clear:both;"></div>
    															</div>	
    														</form>
    													</div>
    											  </div>
    	                                    </div>
    	                                </div>
    								</div>
    	                    </div>
    						<!-- ModalEnd -->
                            <!-- ModalStart -->
                            <div class="modal fade" id="reset_password_modal" role="dialog" aria-hidden="true">
                              <div class="modal-dialog">
                                <!-- Modal content-->
                                <div class="modal-content">
                                  <div class="modal-header" style="margin-bottom: 5px!important;padding-left:13px!important;">
                                     <button type="button" class="close reset-close" data-dismiss="modal">&times;</button>
                                     <h4 class="modal-title trial-header reset-mail-header">Reset Password</h4>
                                  </div>
                                      <!--1-->
                                        <div class="modal-body" id="step_1">
                                            <div id="reset_password_form">
                                                <div class="section-title">
                                                </div>
                                                <div class="alert hidden" role="alert"></div>
                                                <p style="line-height:1.4;font-size:15px;margin:0!important">Forgotten your password? Please enter your e-mail address below and we will send you a reset link via e-mail</p>
                                                <div class="textbox-wrap">
                                                    <div class="input-group">
                                                        <span class="input-group-addon "><i class="fa fa-user"></i></span>
                                                        <input type="email" name="reset_email" id="reset_email" placeholder="E-mail" required="required" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="reset-btn">
                                                   <input type="submit" style="width:100%" name="reset_password_request" id="reset_password_request" value="Reset Password" class="reset-button btn-btn-primary">
                                                </div>
                                            </div>
                                        </div>
                                      <!--/1-->
                                      <!--2-->
                                        <div class="modal-body clearfix hidden" id="step_2">
                                            <p style="line-height:1.4;font-size:15px;margin:0!important">We have sent a password reset link to your e-mail address, please follow the link and change your new password accordingly</p>
                                        </div>
                                      <!--/2-->
                                      <!--3-->
                                       <div class="modal-body clearfix hidden" id="step_3">
                                            <p style="line-height:1.4;font-size:15px;margin:0!important">One more step to go</p>
                                            <p style="line-height:1.4;font-size:14px;margin:0!important">Please type a new password</p>
                                            <input type="hidden" value="<?=isset($reset_password_code)?$reset_password_code : 0?>" name="reset_password_code" id="reset_password_code">
                                            <div class="textbox-wrap">
                                                <div class="input-group">
                                                    <span class="input-group-addon "><i class="fa fa-key"></i></span>
                                                    <input type="password" name="reset_new_password" id="reset_new_password" placeholder="New Password" required="required" class="form-control">
                                                </div>
                                                <div class="input-group">
                                                    <span class="input-group-addon "><i class="fa fa-key"></i></span>
                                                    <input type="password" name="reset_confirm_new_password" id="reset_confirm_new_password" placeholder="Confirm New Password" required="required" class="form-control">
                                                </div>
                                            </div>
                                            <div class="reset-password-input reset-btn">
                                                <input class="reset-button" style="width:100%" type="submit" value="Reset Now" id="reset_password" name="reset_password" class="reset-button btn-btn-primary"><br>
                                            </div>
                                       </div>
                                      <!--/3-->
                                      <!--4-->
                                      <div class="modal-body clearfix hidden" id="step_4">
                                            <p style="line-height:1.4;font-size:15px;margin:0!important">Your password has been successfully updated.<img src="<?=base_url()?>assets/front/img/new-tick.png"></p>
                                            <p style="line-height:1.4;font-size:14px;margin:0!important">Please <a href="#" data-target="#login_modal" data-toggle="modal">click here</a> to login</p>
                                      </div>
                                      <!--/4-->
                                </div>
                              </div>
                            </div>
                            <!-- ModalEnd --> 
                        <?php endif; ?>

<script type="text/javascript" src="<?=base_url()?>assets/front/js/plugins.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/front/js/script.js" defer="defer"></script>

</body>
<script>
    $(document).ready(function(){
        $(".fb-click").click(function(){
            $(".fb-hide").hide(100);
            $(".fb-show").show(100);
        });
       <?php $is_registration_confirmation = $this->session->tempdata('registration_confirmation'); ?>
       var is_registration_confirmation = <?=isset($is_registration_confirmation) ? 1 : 0 ?>;
       if(is_registration_confirmation)
       {
            $("#register_modal").modal('show');
            $("#register_modal").find('.modal-body').find('ul.nav-tabs,.tab-content').hide();
            $("#register_modal").find('.modal-body').find('.registration_confirmation_verification.candidate_message').removeClass('hidden');
       }

       <?php
        if(isset($reset_password_code))
        {
            echo "$('#reset_password_modal').modal('show'); $('#reset_password_modal .modal-body').addClass('hidden'); $('#reset_password_modal .modal-body').eq(2).removeClass('hidden');";
        }
       ?>
    }); 
    new WOW().init();
</script> 
</html>
