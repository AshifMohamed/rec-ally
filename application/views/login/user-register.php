<body class="login-page">
    
    <main>
        
        <div class="login-block">
            <a href="<?php echo site_url();?>">
                <img src="assets/img/logo.png" alt="">
            </a>
            <h1>Register your account</h1>
            <div class="alert" id="err_log" role="alert"></div>
            
            <!-- Nav tabs -->
            <ul class="nav nav-tabs" role="tablist">
                <li role="presentation" class="active"><a href="#seeker" aria-controls="seeker" role="tab" data-toggle="tab">Register as a Job Seeker</a></li>
                <li role="presentation"><a href="#employer" aria-controls="employer" role="tab" data-toggle="tab">Register as a Employer</a></li>
            </ul>
            
                <!-- Tab panes -->
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active" id="seeker">
                        <form name="candidate_register_form" id="candidate_register_form">
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="ti-user"></i></span>
                                <input type="text" class="form-control" placeholder="First name" id="first_name" name="first_name" required="required">
                            </div>
                        </div>
                        
                        <hr class="hr-xs">
                        
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="ti-user"></i></span>
                                <input type="text" class="form-control" placeholder="Last name" id="last_name" name="last_name" required="required">
                            </div>
                        </div>
                        
                        <hr class="hr-xs">
                        
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="ti-email"></i></span>
                                <input type="email" class="form-control" placeholder="Your email address" id="email_seeker" name="email" required="required">
                            </div>
                        </div>
                        
                        <hr class="hr-xs">
                        
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="ti-unlock"></i></span>
                                <input type="password" class="form-control" placeholder="Choose a password" id="password_seeker" name="password" required="required">
                            </div>
                        </div>
                        <p> 
                            <input type="checkbox" name="agree_to_terms" required /> Agree to our 
                            <a target="_blank" href="<?=base_url()?>terms_conditions">terms and conditions</a> 
                            and 
                            <a target="_blank" href="<?=base_url()?>privacy_policy">privacy policy</a>
                        </p>
                        <button class="btn btn-primary btn-block" type="button" id="btn_candidate_register_form">Sign up</button>
                        </form>
                    </div>
                    <div role="tabpanel" class="tab-pane" id="employer">
                        <form name="employer_register_form" id="employer_register_form">
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="ti-home"></i></span>
                                <input type="text" class="form-control" placeholder="Company name" id="company_name" name="company_name" required="required">
                            </div>
                        </div>
                        
                        <hr class="hr-xs">
                        
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="ti-user"></i></span>
                                <input type="text" class="form-control" placeholder="Owner's name" id="owners_name" name="owners_name" required="required">
                            </div>
                        </div>
                        
                        <hr class="hr-xs">
                        
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="ti-email"></i></span>
                                <input type="email" class="form-control" placeholder="Your email address" id="email" name="email" required="required">
                            </div>
                        </div>
                        
                        <hr class="hr-xs">
                        
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="ti-unlock"></i></span>
                                <input type="password" class="form-control" placeholder="Choose a password" id="password" name="password" required="required">
                            </div>
                        </div>
                        <p> 
                            <input type="checkbox" name="agree_to_terms" required /> Agree to our 
                            <a target="_blank" href="<?=base_url()?>terms_conditions">terms and conditions</a> 
                            and 
                            <a target="_blank" href="<?=base_url()?>privacy_policy">privacy policy</a>
                        </p>
                        <button class="btn btn-primary btn-block" type="button" id="btn_employer_register_form">Sign up</button>
                        </form>
                    </div>
                    
                </div>
        </div>
        
        <div class="login-links">
            <p class="text-center">Already have an account? <a class="txt-brand" href="<?php echo base_url().'login'; ?>">Login</a></p>
        </div>
    </main>
    
<div class="modal fade register-modal" id="register_modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog pop-modal">
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
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
    <div class="modal fade" id="errorModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <div class="alert" id="err_log" role="alert"></div>
                </div>
            </div>
        </div>
    </div>