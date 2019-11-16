<div id="wrapper">
    <!--BEGIN SIDEBAR MENU-->
    <nav id="sidebar" role="navigation" data-step="2" data-intro="Template has &lt;b&gt;many navigation styles&lt;/b&gt;"
    data-position="right" class="navbar-default navbar-static-side">
        <div class="sidebar-collapse menu-scroll">
            <?php $user_type = get_user_type(); if($user_type != 'employer'){ ?>
            <ul id="side-menu" class="nav">
                <div class="clearfix"></div>
                <li>
                    <a href="<?=base_url().$user_type;?>">
                        <i class="fa fa-tachometer fa-fw">
                            <div class="icon-bg bg-orange"></div>
                        </i>
                        <span class="menu-title">Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="<?=base_url().$user_type;?>/profile">
                        <i class="fa fa-pencil">
                            <div class="icon-bg bg-pink"></div>
                        </i>
                        <span class="menu-title">Edit Profile</span>
                    </a>
                </li>
                <li>
                    <a href="<?=base_url()?>candidate/view_candidate">
                        <i class="fa fa-eye">
                            <div class="icon-bg bg-pink"></div>
                        </i>
                        <span class="menu-title">View Profile</span>
                    </a>
                </li>
                <li>
                    <a href="<?=base_url().$user_type;?>/saved_jobs">
                        <i class="fa fa-eye">
                            <div class="icon-bg bg-pink"></div>
                        </i>
                        <span class="menu-title">Saved Positions</span>
                    </a>
                </li>
                <li>
                    <a href="<?=base_url().$user_type;?>/settings">
                        <i class="fa fa-eye">
                            <div class="icon-bg bg-pink"></div>
                        </i>
                        <span class="menu-title">Settings</span>
                    </a>
                </li>
                <li>
                    <a href="<?=base_url().$user_type;?>/view_messages">
                        <i class="fa fa-envelope">
                            <div class="icon-bg bg-pink"></div>
                        </i>
                        <span class="menu-title">Messages</span>
                    </a>
                </li>
                <li>
                    <a href="<?=base_url().$user_type;?>/sent_messages">
                        <i class="fa fa-envelope">
                            <div class="icon-bg bg-pink"></div>
                        </i>
                        <span class="menu-title">Sent Messages</span>
                    </a>
                </li>
            </ul>
            <div class="cv-compare">
                <ul>
                    <li><a data-toggle="modal" data-target="#improveCvModal" href="#"><button class="btn btn-primary cv-btn">How to improve CV</button></a>
                    </li>   
                </ul>									
			</div>
            <?php }
             else if(get_user_type() != 'candidate'){ ?>
                <ul id="side-menu" class="nav">
                     <div class="clearfix"></div>
                    <li><a href="<?=base_url().$user_type;?>"><i class="fa fa-tachometer fa-fw">
                        <div class="icon-bg bg-orange"></div>
                    </i><span class="menu-title">Dashboard</span></a>
                    </li>
                     <li><a href="<?=base_url().$user_type;?>/profile"><i class="fa fa-pencil">
                        <div class="icon-bg bg-pink"></div>
                    </i><span class="menu-title">Edit Profile</span></a>
                       
                    </li>
                    <!--  <li><a href="<?=base_url().$user_type;?>/profile"><i class="fa fa-eye">
                        <div class="icon-bg bg-pink"></div>
                    </i><span class="menu-title">View Profile</span></a>
                       
                    </li> -->
                     <li><a href="<?=base_url().$user_type;?>/job_profile"><i class="fa fa-eye">
                        <div class="icon-bg bg-pink"></div>
                        </i><span class="menu-title">Job Profile</span></a>
                    </li> 
                    <li><a href="<?=base_url().$user_type;?>/reports"><i class="fa fa-eye">
                        <div class="icon-bg bg-pink"></div>
                        </i><span class="menu-title">Reports</span></a>
                    </li>
                    <li><a href="<?=base_url().$user_type;?>/settings"><i class="fa fa-eye">
                        <div class="icon-bg bg-pink"></div>
                        </i><span class="menu-title">Settings</span></a>
                    </li>
                    <li><a href="<?=base_url().$user_type;?>/received_message_list"><i class="fa fa-envelope">
                        <div class="icon-bg bg-pink"></div>
                        </i><span class="menu-title">Messages</span></a>
                    </li>
                    <li><a href="<?=base_url().$user_type;?>/candidate_message_list"><i class="fa fa-envelope">
                        <div class="icon-bg bg-pink"></div>
                        </i><span class="menu-title">Sent Messages</span></a>
                    </li>

                </ul>
            <?php } ?>
        </div>
    </nav>
    <!--END SIDEBAR MENU-->