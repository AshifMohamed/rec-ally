<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">  
    <meta name="robots" content="index, follow">
    <meta name="description" content="Recruitment Ally Portal is your gate to a new recruitment experience! We have a unique
    process and a different approach built by professional HR team and consultant to help you determine what type of work you will
    undertake">
    <meta name="keywords" content="recruitment ally, recruitment-ally, recruitment ally portal, new recruitment portal, recruitment and consultancy, recruitment experience, jobs, IT Jobs, new jobs, ">
    <meta name="google-site-verification" content="csUbjE0Wd8JhqTlf6q6uCJC1IBlb1hY4mHnrWj17Adc" />
    
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700|Lato&subset=latin,latin-ext" rel="stylesheet" type="text/css">
    <link href="<?=base_url()?>assets/front/css/all.min.css" rel="stylesheet" type="text/css" >
    <link rel="shortcut icon" type="image/x-icon" href="<?=base_url()?>assets/front/favicon.png">
    
    <?php $page_title = get_page_title(); ?>
    <title><?=isset($page_title) && !empty($page_title)? $page_title.' | ' : 'Recruitment, Portal & Consultancy | '?>Recruitment Ally</title>
    <script type="text/javascript">
        var base_url = '<?=base_url()?>';
    </script>
</head>
<body class="hero-content-dark footer-dark">
<div class="page-wrapper">
    <div class="header-wrapper">
    <div class="header">
        <div class="header-top">
            <div class="container">
                <div class="header-brand">
                    <div class="header-logo">
                        <a href="<?=base_url()?>">
							<img class="" src="<?=base_url()?>assets/front/img/logo.png" alt="RecruitmentAlly Logo"/>
                        </a>
                    </div><!-- /.header-logo-->

                    <div class="header-slogan">
                        <span class="header-slogan-slash">/</span>
                        <span class="header-slogan-text">“I’m your gateway to success”</span>
                    </div><!-- /.header-slogan-->
                </div><!-- /.header-brand -->

                <ul class="header-actions nav nav-pills">
                	<?php if(is_user_logged_in()){ ?>		        		
					<li class="log-id-name">
						<span><a href="<?=base_url().get_user_type();?>" title="Candidate Profile"><?=$this->session->userdata('logged_name')?></a></span>
			        </li>
					<li class="log-dropdown">
						<button type="button" class="btn drop-btn">
							<i class="fa fa-user text-muted"></i>
							<i class="fa fa-angle-down text-muted"></i>
						</button>
						<ul class="log-dropdown-menu">
							
							<!-- <li><a href="#">Help</a></li>
							<li><a href="#">Feedback</a></li> -->
                           <?php if(!is_admin()): ?>
                               <li><a href="<?=base_url().get_user_type();?>/profile"><i class="fa fa-user"></i>My Profile</a></li>
                           <?php endif; ?>
                           <?php $access_type = $this->session->userdata('access_type'); if(isset($access_type)): ?>
                               <li><a href="<?=base_url()?>login_as_admin"><i class="fa fa-random"></i>Switch Access</a></li>
                           <?php endif; ?>
                           <li><a href="<?=base_url().$this->session->userdata('logout_url');?>"><i class="fa fa-key"></i>Logout</a></li>
						</ul>
			        </li>
		        	<?php }else{?>
						<li ><a data-target="#login_modal" data-toggle="modal" href="#">Login</a></li>
	                    <li ><a data-target="#register_modal" data-toggle="modal" href="#">Sign Up</a></li>
	                    <li><a href="#" class="primary news-btn">Newsletter</a>
                            <form method="POST" action="<?=base_url()?>newsletter_subscription">
    							<ul class="newsletter">
        							<div class="form-group">
        								<li><input placeholder="Full Name" name="name" type="text"/></li>
        								<li><input placeholder="E-mail" name="email" type="email"/></li>
        								<li><button type="submit" value="submit">Subscribe</button></li>
        							</div>
    							</ul>
                            </form>
						</li>
			        <?php }?>
                    
                </ul><!-- /.header-actions -->

                <button class="navbar-toggle collapsed" type="button" data-toggle="collapse" data-target=".header-nav">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div><!-- /.container -->
        </div><!-- /.header-top -->

        <div class="header-bottom">
            <div class="container">
                <ul class="header-nav nav nav-pills collapse">
                    <li class="active">
                        <a href="<?=base_url()?>">Home</a>
                    </li>

                    <li>
                        <a href="<?=base_url()?>about_us">About Us </a>
                    </li>

                    <li>
                       <a href="#">Services <i class="fa fa-chevron-down"></i></a>
                        <ul class="sub-menu">
                            <li><a href="/recruitment_outsourcing">Recruitment Outsourcing</a></li>
                            <li><a href="/recruitment_portal">Recruitment Portal</a></li>
                            <li><a href="/recruitment_consultancy">Recruitment Consultancy</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="<?=base_url()?>contact_us">Contact Us </a>
                    </li>
                </ul>
            </div><!-- /.container -->
        </div><!-- /.header-bottom -->
    </div><!-- /.header -->
</div><!-- /.header-wrapper-->
<div id="global_notification" class="alert <?php if($this->session->status) echo $this->session->status; else echo 'hidden';?>" role="alert"><?php if($this->session->message) echo $this->session->message?></div>