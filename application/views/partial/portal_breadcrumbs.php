<!-- BEGIN PAGE WRAPPER-->
<div id="page-wrapper">
    <!--BEGIN TITLE & BREADCRUMB PAGE-->
    <div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
        <div class="page-header pull-left">
            <div class="page-title">
                <?=(isset($page_title) && !empty($page_title))? $page_title : ''?>
            </div>
                <!-- <p>Update to enhance your chances of being seen by the employer</p> -->
            </div>
            <ol class="breadcrumb page-breadcrumb pull-right">
                <li><i class="fa fa-home"></i>&nbsp;<a href="<?=base_url().get_user_type()?>">Home</a><?=(isset($page_title) && !empty($page_title) && $page_title != 'Dashboard')? '&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;'.$page_title : ''?></li>
                <!-- <li class="hidden"><a href="#">Dashboard</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li> -->
                <!-- <li class="active">Dashboard</li> -->
            </ol>
            <div class="clearfix">
            </div>
        </div>
         <!--END TITLE & BREADCRUMB PAGE -->