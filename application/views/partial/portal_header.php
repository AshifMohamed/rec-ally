<!DOCTYPE html>
<html lang="en">
<head>
    <?php //$page_title = get_page_title(); ?>
    <title><?=isset($page_title) && !empty($page_title)? $page_title.' | ' : ' Management Panel | '?>Recruitment Ally</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="shortcut icon" type="image/x-icon" href="<?=base_url();?>assets/portal/images/favicon.png">
    <?php  ?>
    <!--Loading bootstrap css-->
    <link href='http://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
    <link type="text/css" rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,400,300,700">
    <link type="text/css" rel="stylesheet" href="http://fonts.googleapis.com/css?family=Oswald:400,700,300">
    <!-- <link href='https://fonts.googleapis.com/css?family=Roboto+Slab' rel='stylesheet' type='text/css'> -->
    <link type="text/css" rel="stylesheet" href="<?=base_url();?>assets/portal/styles/jquery-ui-1.10.4.custom.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
  <!--   <link type="text/css" rel="stylesheet" href="<?=base_url();?>assets/portal/styles/font-awesome.min.css"> -->
    <link type="text/css" rel="stylesheet" href="<?=base_url();?>assets/portal/styles/simple-line-icons.css">
    <!-- <link type="text/css" rel="stylesheet" href="<?=base_url();?>assets/portal/styles/bootstrap.min.css"> -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" integrity="sha256-7s5uDGW3AHqw6xtJmNNtr+OBRJUlgkNJEo78P4b0yRw= sha512-nNo+yCHEyn0smMxSswnf/OnX6/KwJuZTlNZBjauKhTK0c+zT+q5JOCx0UFhXQ6rJR9jg6Es8gPuD2uZcYDLqSw==" crossorigin="anonymous">
    <link type="text/css" rel="stylesheet" href="<?=base_url();?>assets/portal/styles/animate.css">
    <link type="text/css" rel="stylesheet" href="<?=base_url();?>assets/portal/styles/main.css">
    <link type="text/css" rel="stylesheet" href="<?=base_url();?>assets/portal/styles/style-responsive.css">
    <link type="text/css" rel="stylesheet" href="<?=base_url();?>assets/portal/styles/zabuto_calendar.min.css">
    <link type="text/css" rel="stylesheet" href="<?=base_url();?>assets/portal/styles/pace.css">
    <link type="text/css" rel="stylesheet" href="<?=base_url();?>assets/portal/styles/jquery.news-ticker.css">
    <link type="text/css" rel="stylesheet" href="<?=base_url();?>assets/portal/styles/nestable.css">
    <!-- Farshad added -->
    <link type="text/css" rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap.min.css">
    <link type="text/css" rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
    <script type="text/javascript">
        var base_url = '<?=base_url()?>';
    </script>
</head>
<body>
    <div>
        <!--BEGIN BACK TO TOP-->
        <a id="totop" href="#"><i class="fa fa-angle-up"></i></a>
        <!--END BACK TO TOP-->
        <!--BEGIN TOPBAR-->
        <div id="header-topbar-option-demo" class="page-header-topbar">
            <nav id="topbar" role="navigation" style="margin-bottom: 0;" data-step="3" class="navbar navbar-default navbar-static-top">
                <div class="navbar-header">
                    <button type="button" data-toggle="collapse" data-target=".sidebar-collapse" class="navbar-toggle"><span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button>
                    <a id="logo" href="<?=base_url(get_user_type())?>" class="navbar-brand"><span class="fa fa-rocket"></span><span class="logo-text" style="display: none">RecruitementAlly</span><span  class="logo-text-icon"><img src="<?=base_url();?>assets/portal/images/sub-logo.png" alt="RcruitemenAlly" class="img-responsive"/></span> <span class="logo-span-txt">I'm Recruiter</span></a></div>
                    <div class="topbar-main"><a id="menu-toggle" href="#" class="hidden-xs"><i class="fa fa-bars"></i></a>
                        <div class="news-update-box hidden-xs"><span class="text-uppercase mrm pull-left text-white">News:</span>
                            <ul id="news-update" class="list-unstyled">
                                <li>Welcome to I'm - Recruiter</li>
                            </ul>
                        </div>
                        <ul class="nav navbar navbar-top-links navbar-right mbn">
                            <!-- <li class="dropdown"><a data-hover="dropdown" href="#" class="dropdown-toggle"><i class="fa fa-bell fa-fw"></i><span class="badge badge-green">3</span></a></li> -->
                            <li class="dropdown topbar-user"><a data-hover="dropdown" href="#" class="dropdown-toggle"><img src="<?=get_profile_picture()?>" alt="" class="img-responsive img-circle"/>&nbsp;<span class="hidden-xs"><?=$this->session->userdata('logged_name')?></span>&nbsp;<span class="caret"></span></a>
                                <ul class="dropdown-menu dropdown-user pull-right">
                                    <?php if(!is_admin()): ?>
                                        <li><a href="<?=base_url().get_user_type();?>/profile"><i class="fa fa-user"></i>My Profile</a></li>
                                        <li class="divider"></li>
                                    <?php endif; ?>
                                    <?php $access_type = $this->session->userdata('access_type'); if(isset($access_type)): ?>
                                        <li><a href="<?=base_url()?>login_as_admin"><i class="fa fa-random"></i>Switch Access</a></li>
                                        <li class="divider"></li>
                                    <?php endif; ?>
                                    <li><a href="<?=base_url().$this->session->userdata('logout_url');?>"><i class="fa fa-key"></i>Logout</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </nav>
                <!--BEGIN MODAL CONFIG PORTLET-->
                <div id="modal-config" class="modal fade">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" data-dismiss="modal" aria-hidden="true" class="close">
                                    &times;</button>
                                    <h4 class="modal-title">
                                        Modal title</h4>
                                    </div>
                                    <div class="modal-body">
                                        <p>
                                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed eleifend et nisl eget
                                            porta. Curabitur elementum sem molestie nisl varius, eget tempus odio molestie.
                                            Nunc vehicula sem arcu, eu pulvinar neque cursus ac. Aliquam ultricies lobortis
                                            magna et aliquam. Vestibulum egestas eu urna sed ultricies. Nullam pulvinar dolor
                                            vitae quam dictum condimentum. Integer a sodales elit, eu pulvinar leo. Nunc nec
                                            aliquam nisi, a mollis neque. Ut vel felis quis tellus hendrerit placerat. Vivamus
                                            vel nisl non magna feugiat dignissim sed ut nibh. Nulla elementum, est a pretium
                                            hendrerit, arcu risus luctus augue, mattis aliquet orci ligula eget massa. Sed ut
                                            ultricies felis.
                                        </p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" data-dismiss="modal" class="btn btn-default">
                                            Close
                                        </button>
                                        <button type="button" class="btn btn-primary">
                                            Save changes
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--END MODAL CONFIG PORTLET-->
                    </div>
        <!--END TOPBAR-->
<div id="global_notification" class="alert <?php if($this->session->status) echo $this->session->status; else echo 'hidden';?>" role="alert"><?php if($this->session->message) echo $this->session->message?></div>