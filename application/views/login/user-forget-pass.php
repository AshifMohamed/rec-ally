<body class="login-page">

<main>

  <div class="login-block" id="reset_password_modal">
    <img src="assets/img/logo.png" alt="">
    <h1>Request password reset</h1>
      <div class="form-group" >
        <div class="input-group">
          <span class="input-group-addon"><i class="ti-email"></i></span>
          <input type="text" class="form-control" placeholder="Email" name="reset_email" id="reset_email">
        </div>
      </div>

        <button class="btn btn-primary btn-block" type="button" value="Reset Password" name="reset_password_request" id="reset_password_request">Request reset link</button>
  </div>

  <div class="login-links">
    <p class="text-center"><a href="<?php echo base_url().'login'; ?>">Back to login</a></p>
  </div>
    
<!-- ModalStart -->
<div class="modal fade" id="reset_password_modal" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header" style="margin-bottom: 5px!important;padding-left:13px!important;">
                <button type="button" class="close reset-close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title trial-header reset-mail-header">Reset Password</h4>
            </div>
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

</main>
