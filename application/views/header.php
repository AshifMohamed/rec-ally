<!DOCTYPE html>
<html lang="en">
    
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="Post a job position or create your online resume by TheJobs!">
        <meta name="keywords" content="">
        
        <title>Recruitment-Ally</title>

        <!-- Styles -->
        <link href="<?php echo base_url(); ?>assets/css/app.min.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>assets/css/custom.css" rel="stylesheet">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/owl.carousel.min.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/owl.theme.default.min.css">
        <link href="<?php echo base_url(); ?>assets/css/my_style.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>assets/css/mystyle.css" rel="stylesheet">

        <script type="text/javascript">
            var base_url = '<?=base_url()?>';
        </script>
        
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
        <link href='http://fonts.googleapis.com/css?family=Oswald:100,300,400,500,600,800%7COpen+Sans:300,400,500,600,700,800%7CMontserrat:400,700' rel='stylesheet' type='text/css'>
        
        <!-- Favicons -->
        <link rel="" href="">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    </head>
    
    <body class="nav-on-header smart-nav">
        
        <!-- Navigation bar -->
        <nav class="navbar">
            <div class="container">
                
                <!-- Logo -->
                <div class="pull-left">
                    <a class="navbar-toggle" href="#" data-toggle="offcanvas"><i class="ti-menu"></i></a>
                    
                    <div class="logo-wrapper">
                        <a class="logo" href="<?php echo base_url(); ?>"><img src="<?php echo base_url(); ?>assets/img/logo.png" alt="logo"></a>
                        <a class="logo-alt" href="<?php echo base_url(); ?>"><img src="<?php echo base_url(); ?>assets/img/logo.png" alt="logo-alt"></a>
                    </div>
                    
                </div>
                <!-- END Logo -->
                
                <!-- User account -->
                
                <div class="pull-right user-login">
                    <?php if(is_user_logged_in()){ ?>
                    <li>
                        <span>
                            <a href="<?php echo base_url().get_user_type();?>" title="Candidate Profile">
                            <?=$this->session->userdata('logged_name')?>
                            </a>
                        </span>
                    </li>
                    <li role="presentation" class="dropdown">
                        <a class="dropdown-toggle btn btn-primary" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                            <?php if(!empty($profile_image_url)){ ?>
                                <img src="<?=$profile_image_url?>" alt="" height="30" class="img-circle"/>
                            <?php }else {?>
                                <i class="fa fa-user text-muted"></i>
                                <?php } ?>
                                <i class="fa fa-angle-down text-muted"></i>
                        </a>
                        <ul class="dropdown-menu">
                            <?php if(!is_admin()): ?>
                            <li><a href="<?php echo base_url().get_user_type();?>/profile"><i class="fa fa-user"></i>My Profile</a></li>
                            <?php endif; ?>
                            <?php $access_type = $this->session->userdata('access_type'); if(isset($access_type)): ?>
                            <li><a href="<?php echo base_url()?>login_as_admin"><i class="fa fa-random"></i>Switch Access</a></li>
                            <?php endif; ?>
                            <li><a href="<?php echo base_url().$this->session->userdata('logout_url');?>"><i class="fa fa-key"></i>Logout</a></li>
                        </ul>
                    </li>
                    <?php }else{ ?>
                    <a class="btn btn-sm btn-primary" href="<?php echo base_url().'login'; ?>">Login</a> or <a href="<?php echo base_url().'register'; ?>">register</a>
                    <?php } ?>
                </div>
                <!-- END User account -->
                
                <!-- Navigation menu -->
                <ul class="nav-menu">
                    <li>
                        <a class="active" href="<?php echo base_url(); ?>">Home</a>
                    </li>
                    <li>
                        <a href="<?php echo base_url('about'); ?>">About us</a>
                    </li>
                    <li>
                        <a href="#">Services</a>
                        <ul>
                            <li><a href="<?php echo base_url('recruitment_outsourcing'); ?>">Recruitment Outsourcing</a></li>
                            <li><a href="<?php echo base_url('recruitment_portal'); ?>">Recruitment Portal</a></li>
                            <li><a href="<?php echo base_url('recruitment_consultancy'); ?>">Recruitment Consultancy</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="<?php echo base_url('contact') ?>">Contact Us </a> 
                    </li>
                </ul>
                <!-- END Navigation menu -->
                
            </div>
        </nav>
        <!-- END Navigation bar -->
    <div id="global_notification" class="alert <?php if($this->session->status) echo $this->session->status; else echo 'hidden';?>" role="alert"><?php if($this->session->message) echo $this->session->message?></div>