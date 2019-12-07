<script type="text/javascript">  
    setTimeout(function(){
        $('#errorModal').modal('hide')
    }, 4000);
    
    $(document).ready(function () {
        
        console.log('dasasd');
        
        $('#btnLogin').click(function(){
            $.ajax({
                url: "<?php echo site_url(); ?>login/validate",
                type: "POST",
                data: $("#login").serialize(),
                success: function (response) {
                    if(response.error_code == 1){
                        $('#errorModal').modal('show');
                        $("#err_log").html(response.message);
                        
                    } else if(response.error_code == 0){
                        
                        window.location.href = response.redirect;
                    }
                }
            });
        });
        
        
        
//        $("#login").removeAttr('novalidate');
//        $("#login").validate({ 
//            // Specify the validation rules
//            rules: {  
//                username: {
//                    required: true,
//                },
//                admin: {
//                    required: true,
//                    minlength: 3
//                }
//            },
//            // Specify the validation error messages
//            messages: {                        
//                user_psw: {
//                    required: "Please enter your password.",
//                    minlength: "Your password must be at least 3 characters long"
//                },
//                user_email: "Please enter your username"
//            },
//            submitHandler: function (form) {
//                $.ajax({
//                    url: "<?php echo site_url(); ?>admin/admin_login",
//                    type: "POST",
//                    data: $("#admin_login").serialize(),
//                    success: function (response) {
//                        if (jQuery.trim(response) === '2') {
//                            $("#err_log").html('<p>The User name And password is mismatch.</p>');
//                        } else if (jQuery.trim(response) === '1') {
//                            $('.loading_spinner').show();
//                            window.location.href = "<?php echo site_url(); ?>admin/home";
//                        }
//                    }
//                });
//            }
//        });

    });
</script>

<body class="login-page" style="background-image: url(<?php echo base_url(); ?>assets/img/bg-pattern.png)">
    
    <main>
        
        <div class="login-block">
            <a href="<?php echo site_url();?>">
                <img src="assets/img/logo.png" alt="">
            </a>
            <h1 data-toggle="modal" data-target="#myModal">Log into your account</h1>
            
            <form id="login" name="login" method="post">
                
<!--                <div class="alert" id="err_log" role="alert"></div>-->
                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="ti-email"></i></span>
                        <input type="email" name="email" required="required" class="form-control" placeholder="Email">
                    </div>
                </div>
                
                <hr class="hr-xs">
                
                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="ti-unlock"></i></span>
                        <input type="password" name="password" required="required" class="form-control" placeholder="Password">
                    </div>
                </div>
                
                <button class="btn btn-primary btn-block" id="btnLogin" type="button">Login</button>
                
                <div class="login-footer">
                    <h6>Or login with</h6>
                    <ul class="social-icons">
                        <li><a class="linkedin" href="<?php echo base_url().'login/linkedin'; ?>"><i class="fa fa-linkedin"></i></a></li>
                        <li><a class="twitter" href="<?php echo base_url().'login/twitter'; ?>"><i class="fa fa-twitter"></i></a></li>
                        <li><a class="google-plus" href="<?php get_google_auth_url(); ?>"><i class="fa fa-google-plus"></i></a></li>
                    </ul>
                </div>
                
            </form>
        </div>
        
        <div class="login-links">
            <a class="pull-left" href="<?php echo base_url().'forgot_password'; ?>">Forgot Password?</a>
            <a class="pull-right" href="<?php echo base_url().'register'; ?>">Register an account</a>
        </div>
    </main>
    
    <!-- Modal -->
    <div class="modal fade" id="errorModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body bg-danger">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <div class="alert" id="err_log" role="alert"></div>
                </div>
            </div>
        </div>
    </div>