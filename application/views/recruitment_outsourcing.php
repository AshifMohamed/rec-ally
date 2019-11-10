<header class="site-header size-lg text-center innerpage" style="background-image: url(<?php echo base_url('assets/img/front//img/s1.jpg'); ?>)">

</header>
<div class="common-inner">
    <h2 class="container">Recruitment Outsourcing</h2>
    <div class="first-wrap">
        <div class="service-1-first">
            <div class="container">
                <div class="col-md-9 col-sm-9 left-padding">
                    <h4 style="color: #17A7E0;font-family:roboto;">Stage 1</h4>
                    <h4 style="color: #17A7E0;font-family:roboto;">Job Analysis</h4>
                    <p>Identify the job vacancy and position requirement</p>
                    <p>At this stage we develop an inclusive job profile which include all the information needed to an open vacancy.</p>
                    <ul>
                        <li><i class="fa fa-check"></i> Job description</li>                                
                        <li><i class="fa fa-check"></i> Job role</li>
                        <li><i class="fa fa-check"></i> Job responsibilities</li>
                        <li><i class="fa fa-check"></i> Knowledge, skills and education required to the position.</li>
                        <li><i class="fa fa-check"></i> Salary range</li>
                        <li><i class="fa fa-check"></i> Compensation & benefit</li>
                        <li><i class="fa fa-check"></i> Location</li>
                        <li><i class="fa fa-check"></i> Working hours …etc</li>
                    </ul>
                </div>
                <div class="col-md-3 col-sm-3">
                    <img class="img-responsive wow bounceInUp" src="<?=base_url()?>assets/img/front/img/icon2.png">
                </div>
            </div>  
        </div>  
        <br>
        <div class="service-1-second">
            <div class="container">
                <div class="col-md-3 col-sm-3">
                    <img class="img-responsive wow bounceInUp" src="<?=base_url()?>assets/img/front/img/icon3.png">
                </div>
                <div class="col-md-9 col-sm-9 left-padding">								
                    <h4 style="color: #17A7E0;font-family:roboto;">Stage 2</h4>
                    <h4 style="color: #17A7E0;font-family:roboto;">Job Posting</h4>
                    <p>Job posting; through advertise the open vacancy in our portal beside the social media as LinkedIn or newspaper...etc.</p>
                    
                </div>
            </div>  
        </div>  
        <br>
        <div class="service-1-third">
            <div class="container">
                <div class="col-md-9 col-sm-9 left-padding">
                    <h4 style="color: #17A7E0;font-family:roboto;">Stage 3</h4>
                    <h4 style="color: #17A7E0;font-family:roboto;">Screening</h4>
                    <p>Upon receiving the candidate application we start our third stage which include an initial screening to the applications to revise and evaluate the selected applicants that initially matching the job.</p>
                </div>
                <div class="col-md-3 col-sm-3">
                    <img class="img-responsive wow bounceInUp" src="<?=base_url()?>assets/img/front/img/icon4.png">
                </div>
            </div>  
        </div>
        <br>
        <div class="service-1-fourth">
            <div class="container">
                <div class="col-md-3 col-sm-3">
                    <img class="img-responsive wow bounceInUp" src="<?=base_url()?>assets/img/front/img/icon5.png">
                </div>
                <div class="col-md-9 col-sm-9 left-padding">
                    <h4 style="color: #17A7E0;font-family:roboto;">Stage 4</h4>
                    <h4 style="color: #17A7E0;font-family:roboto;">Subsequent screening</h4>
                    <p>Comparing applicant's qualification to the qualification specified in the job advertisement.
                        Have a roadmap to follow for evaluating each candidate against the requirements to determine who will be the best fit. Accordingly, prepare a shortlisted candidates.</p>
                    <p>At this stage, a set of standard criteria and questions should be asked for all candidates to make the process be credible and fair. Questions requiring a yes/no response can be helpful in the beginning of an interview to help candidates feel comfortable especially when nerves are at their highest. By contract, high inquiry questions are those that stimulate a broad range of responses; penetrate the dimensions of experience, skills, organizational compatibility.</p>
                </div>
            </div>  
        </div>  
        <br>
        <div class="service-1-fifth">
            <div class="container">
                <div class="col-md-9 col-sm-9 left-padding">
                    <h4 style="color: #17A7E0;font-family:roboto;">Stage 5</h4>
                    <h4 style="color: #17A7E0;font-family:roboto;">Interviews</h4>
                    <p><b>Initial interview</b> by phone which will help to evaluate the communication skills and ability to give and take before starting the actual meeting.</p>
                    <p><b>Structured interview.</b>
                        Arrange a scheduled interview with the candidate whether face to face interview or video interview. At this stage candidate are required to answer specific questions regarding the open vacancy and we evaluate the candidate ability to handle the aspect of the job and the willingness for learning and development.</p>
                    <p><b>Final Interview is must.</b>
                        We here give the company members the right to meet the shortlisted candidate to break the ice before the final decision.</p>
                </div>
                <div class="col-md-3 col-sm-3 wow bounceInUp">
                    <img class="img-responsive" src="<?=base_url()?>assets/img/front/img/icon6.png">
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
</div>