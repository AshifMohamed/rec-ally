<header class="site-header size-lg text-center innerpage" style="background-image: url(<?php echo base_url('assets/img/front//img/s3.jpg'); ?>)">

</header>
<div class="common-inner">
        <h2 class="container left-padding">Recruitment consultancy</h2>
        <div class="first-wrap">
            <ul class="container">
                <p>Finding the best person for the best place is not an easy job, it is a long journey involves a lot of stopped stations until reaching the final destination. At Recruitment Ally we understand well that in today’s challenging work environment organization is fighting to survive and cultivate its name and reputation. Undoubtedly the key weapon to win the competition is the human capital; the essential and intrinsic asset that drive the success wheel.</p>
                <div class="col-md-12 col-sm-12 i-col  wow pulse"><i>“Employee is not a tool it is a resource”</i></div>
                <p>However, hiring the suitable employee is not the end rather it is the mean to achieve a set of objectives that any organization has set up in the early stage of its foundation. That is why the alignment between the employee goals and the employer vision is a must to fulfil a mutual benefit.</p>
                <div class="col-md-12 col-sm-12 i-col  wow pulse"><i>“Employee is not a cost center it is a profit center”</i></div>
                <div style="clear:both;"></div>
                <div style="margin-top:10px;"><h4>At Recruitment Ally we offer you a full consultancy service to help you:</h4>
                    <div class="">
                        <img class="img-responsive wow bounceInUp" src="<?=base_url()?>assets/img/front/img/circle-arrow.png">
                        <br><br>
                        <div style="clear:both;"></div>
                        <div class="col-md-6 col-sm-6 arrow-cat-1 left-padding">
                            <h4><b>Understand The Business Needs</b></h4>
                            <p>Identify the need of the entire business and help the organization to determine</p>
                        </div>
                        <div class="col-md-6 col-sm-6 arrow-cat-1">
                            <h4><b>Psychometric and Behavioral Assessment</b></h4>
                            <p>Provide an inclusive metrics to assess the employee competency during the selection process.</p>
                        </div>
                    </div>
                    <div class="">
                        <div style="clear:both;"></div>
                        <div class="col-md-6 col-sm-6 box-cat-1 left-padding">
                            <img class="img-responsive wow bounceInUp" src="<?=base_url()?>assets/img/front/img/mp.png">
                            <p class="text-center" style="margin-top: 25px;">At Recruitment Ally we believe that employee should not be treated as only an economic man as his service is exchanged by salary, but also as social and psychological man.Thus the complete man is viewed. Building a joint plan that help employer to move forward from the personnel management strategy to human resource management strategy is our mission. We help you from the very first stage until you reach your last destination.</p>
                        </div>
                        <div class="col-md-6 col-sm-6 box-cat-1">
                            <img class="img-responsive wow bounceInUp" src="<?=base_url()?>assets/img/front/img/mp2.png">
                            <p class="text-center" style="margin-top: 30px;">As we understand the importance of performance management as a follow up process and strategy to assure that the quality of the work is measured and managed we help you develop a performance management system (PMS) not only a performance appraisal (PA) and tackle the Achilles heel of the HRM.</p>
                        </div>
                    </div>
                    <div style="clear:both;"></div>
                    <div class="on-boarding wow pulse">
                        
                        <h4 style="color: #17A7E0;font-family:roboto-bold;">On Boarding</h4>
                        <p>“Research and conventional wisdom both suggest that employees get about 90 days to prove
                            Themselves in a new job. The faster the new hires feel welcome and prepared for their jobs, the faster they will be able to successfully contribute to the firm’s mission” At recruitment Ally we help you to develop a socialization process that cover the <b>Four C’s</b> level of the On-boarding process:</p>
                        <li class="clr-1"><span><strong class="clr-1 wow slideInUp">C</strong>ompliance</span> which includes teaching employees basic legal and policy-related rules and regulations.</li>
                        <li class="clr-2"><span><strong class="clr-1 wow slideInUp">C</strong>larification</span> refers to ensuring that employees understand their new jobs and all related expectations.</li>
                        <li class="clr-3"><span><strong  class="clr-1 wow slideInUp">C</strong>ulture</span> is a broad category that includes providing employees with a sense of organizational norms- both formal and informal.</li>
                        <li class="clr-4"><span><strong class="clr-1 wow slideInUp">C</strong>onnection</span> refers to the vital interpersonal relationships and information networks that new employees must establish.</li>
                    </div>
                </div>
            </ul>
            
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