<header class="site-header size-lg text-center innerpage" style="background-image: url(<?php echo base_url('assets/img/front//img/s2.jpg'); ?>)">

</header>
<div class="common-inner">
        <h2 class="container left-padding">Recruitment Portal</h2>
        <div class="first-wrap">
            <ul class="container">
                <h4>Hierarchy of the Recruitment Ally Portal Process</h4>
                <li>
                    <img class="img-responsive wow bounceInUp" src="<?=base_url()?>assets/img/front/img/process.png">
                </li>
                <li class="online-rec">
                    <h4>Online recruitment techniques</h4>
                    <div class="col-md-4 col-sm-4 left-padding">
                        <div class="col-colors">
                            <img class="img-responsive wow pulse" src="<?=base_url()?>assets/img/front/img/jobdes.jpg">
                            <p>Provide a detailed job description and job specifications in the job postings to attract candidates with the right skill sets and qualifications at the first stage.</p>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-4">
                        <div class="col-colors">
                            <img class="img-responsive wow pulse" src="<?=base_url()?>assets/img/front/img/strat.jpg">
                            <p>The alignment with the overall recruitment strategy of the organization.</p>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-4">
                        <div class="col-colors">
                            <img class="img-responsive wow pulse" src="<?=base_url()?>assets/img/front/img/backend.jpg">
                            <p>Back-end support.</p>
                        </div>
                    </div>
                </li>
            </ul>
            <div style="clear:both;"></div>
            <div class="container">
                <ul>
                    <li class="col-md-4 col-sm-4 arrow-p">
                        <img class=" plus-middle" src="<?=base_url()?>assets/img/front/img/plus-middle.png">
                        <img class="img-responsive wow pulse" src="<?=base_url()?>assets/img/front/img/plus1.png">
                        <p>Review and screen the
                            resume in creative and
                            innovative way and minimize
                            the time, efforts and
                            workload headaches to review
                            the attached CV and the risk to
                            remember and review the
                            status.</p>
                    </li>
                    <li class="col-md-4 col-sm-4 arrow-p">
                        <img class="plus-middle" src="<?=base_url()?>assets/img/front/img/equal-middle.png">
                        <img class="img-responsive wow pulse" src="<?=base_url()?>assets/img/front/img/plus2.png">
                        <p>Fast and effective
                            response for through
                            automated screening and
                            selection process.</p>
                    </li>
                    <li class="col-md-4 col-sm-4 arrow-p">
                        <img class="img-responsive wow pulse" src="<?=base_url()?>assets/img/front/img/plus3.png">
                        <p>Database for thousands of
                            candidates relevant to the IT
                            *Database with multiple
                            options for suitable bank for
                            question related to each job
                            *History for the
                            candidates job application
                            and recruitment.</p>
                    </li>
                </ul>
                <div class="clearfix"></div>
                <div class="adv-recruit">
                    <h4>Advantages of E-Recruitment:</h4>
                    
                    <p><i class="fa fa-check"></i> Lower costs to the organization. Also, posting jobs online is cheaper than advertising in the newspapers.</p>
                    
                    <p><i class="fa fa-check"></i> No intermediaries.</p>
                    
                    <p><i class="fa fa-check"></i> Reduction in the time for recruitment (over 65 percent of the hiring time).</p>
                    
                    <p><i class="fa fa-check"></i> Facilitates the recruitment of right type of people with the required skills. </p>
                    
                    <p><i class="fa fa-check"></i> Improved efficiency of recruitment process. </p>
                    
                    <p><i class="fa fa-check"></i> Online recruitment helps the organizations to weed out the unqualified candidates in an automated way.</p>
                </div>	
            </div>
            <div style="clear:both;"></div>
            <?php if($this->session->userdata('is_logged_in') == false){ ?>
            <div class="cta-text">
                <div class="container">
                    <div class="cta-text-inner wow bounceInUp">
                        <div class="cta-text-before">I want to</div><!-- /.cta-large-before -->
                        <a data-target="#login_modal" data-toggle="modal" href="<?php echo site_url('login');?>" class="btn btn-primary">Hire Employee</a> 
                        or 
                        <a href="<?php echo site_url('login');?>" class="btn btn-primary">Find Job</a>
                    </div><!-- /.cta-text-inner -->
                </div><!-- /.container -->
            </div><!-- /.cta-text -->
            <?php } ?>
            <br>
            <br>
            <br>
            <div style="clear:both;"></div> 
        </div>
    </div>