
<!-- Site header -->
<header class="site-header size-lg text-center" style="background-image: url(<?php echo base_url(); ?>assets/img/bg-banner1.jpg)">
    <div class="container">
        <div class="col-xs-12">
            <br><br>
            <h2>We offer <mark>1,259</mark> job vacancies right now!</h2>
            <h5 class="font-alt">Find your desire one in a minute</h5>
            <br><br><br>
            <form class="header-job-search" action="<?php echo base_url().'listings' ?>" method="GET">
                <div class="input-keyword">
                    <select class="form-control" name="industry_s" id="industry_s">
                        <option value="">Industry</option>
                        <?php 
                        foreach ($industries as $key => $industry) { ?>
                            <option value="<?=$industry->industry_id?>"><?=$industry->industry?></option>
                        <?php } ?> 
                    </select>
                </div>

                <div class="input-location">
                    <select class="form-control" name="country_s" id="country_s">
                        <option value="">Location</option>
                        <?php 
                        foreach ($countries as $key => $country) { ?>
                            <option value="<?=$country->country_id?>"><?=$country->country?></option>
                        <?php } ?>  
                    </select>
                </div>

                <div class="btn-search">
                    <button class="btn btn-primary" type="submit">Find jobs</button>
                    <a href="<?php echo base_url().'listings' ?>">Advanced Job Search</a>
                </div>
            </form>
        </div>
    </div>
</header>
<!-- END Site header -->

<!-- Main container -->
    <main>



      <!-- Recent jobs -->
      <section>
        <div class="container">
          <header class="section-header">
            <span>Latest</span>
            <h2>Recent jobs</h2>
          </header>

          <div class="row item-blocks-connected">
              
            <?php foreach($jobs as $job){ ?>

            <!-- Job item -->
            <div class="col-xs-12">
                <div class="item-block">
                    <header>
                      <!--<img src="<?php // echo base_url(); ?>assets/img/logo-envato.png" alt="">-->
                      <a class="hgroup" href="<?php echo base_url(); ?>posting/<?php echo $job->job_ref_no; ?>">
                        <h4><?php echo $job->position; ?></h4>
                        <h5>Job Ref:<?php echo $job->job_ref_no; ?></h5>
                      </a>
                      <div class="header-meta">
                        <a class="location" href="<?php echo base_url(); ?>posting/<?php echo $job->job_ref_no; ?>"><?php echo $job->country; ?>, <?php echo $job->name; ?></a>
                        <span class="label label-info"><?php if(is_job_already_save($job->job_profile_id) > 0){?> <span>Position Saved</span> <?php }else{ ?><a href="<?php base_url()?>save_job_position/<?php echo $job->job_ref_no ?>" <?php is_user_logged_in() ? '' : 'data-target="#login_modal" data-toggle="modal"'?>>Save Position</a><?php } ?></span>
                      </div>
                    </header>
                </div>
            </div>
            <!-- END Job item -->
            
            <?php } ?>

          </div>

          <br><br>
          <p class="text-center"><a class="btn btn-info" href="job-list.html">Browse all jobs</a></p>
        </div>
      </section>
      <!-- END Recent jobs -->


      <!-- Recent jobs -->
      <section>
        <div class="container">
          <header class="section-header">
            <span>Latest</span>
            <h2>Popular Companies</h2>
          </header>

          <div class="row item-blocks-connected">
		<?php foreach ($companies as $key => $company) { ?>  
                <div class="item-block">
                    <header>
                      <img src="<?php echo base_url(); ?>uploads/company_logos/<?php echo $company->company_logo; ?>" alt="">
                      <div class="hgroup">
                          <h4><a href="<?php echo base_url(); ?>listings/<?php $company->company_ref_no; ?>"><?php echo $company->name; ?></a></h4>
                        <h5><?php echo $company->country?>,<?php echo $company->city?></h5>
                      </div>
                      <span class="open-position"><a href="<?php echo base_url()?>listings/<?php echo $company->company_ref_no?>"><?=get_job_count_by_company_id($company->company_profile_id,true)?> open positions</a></span>
                    </header>
                </div>
                <?php } ?>
          </div>

          <br><br>
          <p class="text-center"><a class="btn btn-info" href="#">Browse all Companies</a></p>
        </div>
      </section>
      <!-- END Recent jobs -->


      <!-- Facts -->
      <section class="bg-img bg-repeat no-overlay section-sm" style="background-image: url(<?php echo base_url(); ?>assets/img/bg-pattern.png)">
        <div class="container">

          <div class="row">
            <div class="counter col-md-3 col-sm-6">
              <p><span data-from="0" data-to="68"></span>+</p>
              <h6>Jobs</h6>
            </div>

            <div class="counter col-md-3 col-sm-6">
              <p><span data-from="0" data-to="158"></span>+</p>
              <h6>Members</h6>
            </div>

            <div class="counter col-md-3 col-sm-6">
              <p><span data-from="0" data-to="789"></span>+</p>
              <h6>Resumes</h6>
            </div>

            <div class="counter col-md-3 col-sm-6">
              <p><span data-from="0" data-to="12"></span>+</p>
              <h6>Company</h6>
            </div>
          </div>

        </div>
      </section>
      <!-- END Facts -->


      <!-- How it works -->
      <section>
        <div class="container">

          <div class="col-sm-12 col-md-6">
            <header class="section-header text-left">
              <span>Workflow</span>
              <h2>How it works</h2>
            </header>

            <p class="lead">Pellentesque et pulvinar orci. Suspendisse sed euismod purus. Pellentesque nunc ex, ultrices eu enim non, consectetur interdum nisl. Nam congue interdum mauris, sed ultrices augue lacinia in. Praesent turpis purus, faucibus in tempor vel, dictum ac eros.</p>

            <p class="lead">Pellentesque et pulvinar orci. Suspendisse sed euismod purus. Pellentesque nunc ex, ultrices eu enim non, consectetur interdum nisl. Nam congue interdum mauris, sed ultrices augue lacinia in. Praesent turpis purus, faucibus in tempor vel, dictum ac eros.</p>
            
            <br><br>
            <a class="btn btn-primary" href="#">Learn more</a>
          </div>

          <div class="col-sm-12 col-md-6 hidden-xs hidden-sm">
			<iframe class="" style="width:100%;height: 380px; margin-top:150px!important;" frameborder="0" allowfullscreen="" src="https://www.youtube.com/embed/xJS_Ucbd_EE"></iframe>
          </div>

        </div>
      </section>
      <!-- END How it works -->


      <!-- Categories -->
      <section class="bg-alt">
        <div class="container">
          <header class="section-header">
            <span>Categories</span>
            <h2>Our Services</h2>
            <p>Here's our popular services</p>
          </header>

          <div class="category-grid">
            <a href="job-list-1.html">
              <i class="fa fa-laptop"></i>
              <h6>Technology</h6>
              <p>Designer, Developer, IT Service, Front-end developer, Project management</p>
            </a>

            <a href="job-list-1.html">
              <i class="fa fa-laptop"></i>
              <h6>Technology</h6>
              <p>Designer, Developer, IT Service, Front-end developer, Project management</p>
            </a>

            <a href="job-list-1.html">
              <i class="fa fa-laptop"></i>
              <h6>Technology</h6>
              <p>Designer, Developer, IT Service, Front-end developer, Project management</p>
            </a>

            <a href="job-list-1.html">
              <i class="fa fa-laptop"></i>
              <h6>Technology</h6>
              <p>Designer, Developer, IT Service, Front-end developer, Project management</p>
            </a>

            <a href="job-list-1.html">
              <i class="fa fa-laptop"></i>
              <h6>Technology</h6>
              <p>Designer, Developer, IT Service, Front-end developer, Project management</p>
            </a>

            <a href="job-list-1.html">
              <i class="fa fa-laptop"></i>
              <h6>Technology</h6>
              <p>Designer, Developer, IT Service, Front-end developer, Project management</p>
            </a>
        </div>
      </section>
      <!-- END Categories -->
	  
	  <!-- PartnersList -->
		<section>
          <header class="section-header">
            <span>Meet our Partners</span>
            <h2>Partners</h2>
          </header>
			<div class="container">
				<div class="owl-carousel owl-theme">
					<div class="item ptnr-list col-md-11 col-sm-11">
						<h5>NourGlobal</h5>
						<div class="text-center"><img src="<?php echo base_url(); ?>assets/img/partner-img1.png"/></div>
						<p>Nourglobal is one of the fastest growing connectivity & ict services provider in... <a href="#">more</a></p>
						<div class="ptner-list-link text-center">
							<h6>Enterprise Account Manager</h6>
							 <a href="#">view job</a>
						</div>
					</div>
					<div class="item ptnr-list col-md-11 col-sm-11">
						<h5>NourGlobal</h5>
						<div class="text-center"><img src="<?php echo base_url(); ?>assets/img/partner-img1.png"/></div>
						<p>Nourglobal is one of the fastest growing connectivity & ict services provider in... <a href="#">more</a></p>
						<div class="ptner-list-link text-center">
							<h6>Enterprise Account Manager</h6>
							 <a href="#">view job</a>
						</div>
					</div>
					<div class="item ptnr-list col-md-11 col-sm-11">
						<h5>NourGlobal</h5>
						<div class="text-center"><img src="<?php echo base_url(); ?>assets/img/partner-img1.png"/></div>
						<p>Nourglobal is one of the fastest growing connectivity & ict services provider in... <a href="#">more</a></p>
						<div class="ptner-list-link text-center">
							<h6>Enterprise Account Manager</h6>
							 <a href="#">view job</a>
						</div>
					</div>
					<div class="item ptnr-list col-md-11 col-sm-11">
						<h5>NourGlobal</h5>
						<div class="text-center"><img src="<?php echo base_url(); ?>assets/img/partner-img1.png"/></div>
						<p>Nourglobal is one of the fastest growing connectivity & ict services provider in... <a href="#">more</a></p>
						<div class="ptner-list-link text-center">
							<h6>Enterprise Account Manager</h6>
							 <a href="#">view job</a>
						</div>
					</div>
					<div class="item ptnr-list col-md-11 col-sm-11">
						<h5>NourGlobal</h5>
						<div class="text-center"><img src="<?php echo base_url(); ?>assets/img/partner-img1.png"/></div>
						<p>Nourglobal is one of the fastest growing connectivity & ict services provider in... <a href="#">more</a></p>
						<div class="ptner-list-link text-center">
							<h6>Enterprise Account Manager</h6>
							 <a href="#">view job</a>
						</div>
					</div>
					<div class="item ptnr-list col-md-11 col-sm-11">
						<h5>NourGlobal</h5>
						<div class="text-center"><img src="<?php echo base_url(); ?>assets/img/partner-img1.png"/></div>
						<p>Nourglobal is one of the fastest growing connectivity & ict services provider in... <a href="#">more</a></p>
						<div class="ptner-list-link text-center">
							<h6>Enterprise Account Manager</h6>
							 <a href="#">view job</a>
						</div>
					</div>
					<div class="item ptnr-list col-md-11 col-sm-11">
						<h5>NourGlobal</h5>
						<div class="text-center"><img src="<?php echo base_url(); ?>assets/img/partner-img1.png"/></div>
						<p>Nourglobal is one of the fastest growing connectivity & ict services provider in... <a href="#">more</a></p>
						<div class="ptner-list-link text-center">
							<h6>Enterprise Account Manager</h6>
							 <a href="#">view job</a>
						</div>
					</div>
					<div class="item ptnr-list col-md-11 col-sm-11">
						<h5>NourGlobal</h5>
						<div class="text-center"><img src="<?php echo base_url(); ?>assets/img/partner-img1.png"/></div>
						<p>Nourglobal is one of the fastest growing connectivity & ict services provider in... <a href="#">more</a></p>
						<div class="ptner-list-link text-center">
							<h6>Enterprise Account Manager</h6>
							 <a href="#">view job</a>
						</div>
					</div>
					<div class="item ptnr-list col-md-11 col-sm-11">
						<h5>NourGlobal</h5>
						<div class="text-center"><img src="<?php echo base_url(); ?>assets/img/partner-img1.png"/></div>
						<p>Nourglobal is one of the fastest growing connectivity & ict services provider in... <a href="#">more</a></p>
						<div class="ptner-list-link text-center">
							<h6>Enterprise Account Manager</h6>
							 <a href="#">view job</a>
						</div>
					</div>
					<div class="item ptnr-list col-md-11 col-sm-11">
						<h5>NourGlobal</h5>
						<div class="text-center"><img src="<?php echo base_url(); ?>assets/img/partner-img1.png"/></div>
						<p>Nourglobal is one of the fastest growing connectivity & ict services provider in... <a href="#">more</a></p>
						<div class="ptner-list-link text-center">
							<h6>Enterprise Account Manager</h6>
							 <a href="#">view job</a>
						</div>
					</div>
					<div class="item ptnr-list col-md-11 col-sm-11">
						<h5>NourGlobal</h5>
						<div class="text-center"><img src="<?php echo base_url(); ?>assets/img/partner-img1.png"/></div>
						<p>Nourglobal is one of the fastest growing connectivity & ict services provider in... <a href="#">more</a></p>
						<div class="ptner-list-link text-center">
							<h6>Enterprise Account Manager</h6>
							 <a href="#">view job</a>
						</div>
					</div>
					<div class="item ptnr-list col-md-11 col-sm-11">
						<h5>NourGlobal</h5>
						<div class="text-center"><img src="<?php echo base_url(); ?>assets/img/partner-img1.png"/></div>
						<p>Nourglobal is one of the fastest growing connectivity & ict services provider in... <a href="#">more</a></p>
						<div class="ptner-list-link text-center">
							<h6>Enterprise Account Manager</h6>
							 <a href="#">view job</a>
						</div>
					</div>
					<div class="item ptnr-list col-md-11 col-sm-11">
						<h5>NourGlobal</h5>
						<div class="text-center"><img src="<?php echo base_url(); ?>assets/img/partner-img1.png"/></div>
						<p>Nourglobal is one of the fastest growing connectivity & ict services provider in... <a href="#">more</a></p>
						<div class="ptner-list-link text-center">
							<h6>Enterprise Account Manager</h6>
							 <a href="#">view job</a>
						</div>
					</div>
					<div class="item ptnr-list col-md-11 col-sm-11">
						<h5>NourGlobal</h5>
						<div class="text-center"><img src="<?php echo base_url(); ?>assets/img/partner-img1.png"/></div>
						<p>Nourglobal is one of the fastest growing connectivity & ict services provider in... <a href="#">more</a></p>
						<div class="ptner-list-link text-center">
							<h6>Enterprise Account Manager</h6>
							 <a href="#">view job</a>
						</div>
					</div>
				</div>
			</div>
		</section>
	  <!-- PartnersList -->
		
        <!-- Newsletter -->
        <section class="bg-img" style="background-image: url(<?php echo base_url(); ?>assets/img/map-light.jpg)">
            <div class="container">
                
                <div class="col-md-6 col-sm-6  wow bounceInUp why-bg-p animated">
                    <h4><strong>Why Recruitment Ally?</strong></h4>
                    <ul>
                        <li>Focus more and give attention for the job analysis to have good understanding.</li>
                        <li>Everything is available and employers easily find what they needs.</li>
                        <li>Efficiency of Screening and filtering.</li>
                    </ul>
                </div>
                
                <div class="col-md-4 col-sm-4  wow bounceInUp pull-right why-bg-p animated">
                  <?php if (count($current_poll) > 0): ?>
                    <h4><strong>Share your Opinion</strong></h4>
                    <h6><strong><?= $current_poll[0]->name ?></strong></h6>
                    <form method="POST" class="form-subscribe" id="feedback" name="feedback" >
                    <input type="hidden" name="poll_id" id="poll_id" value=<?= $current_poll[0]->poll_id ?>>
                    <?php foreach ($current_poll as $key => $poll): ?>
                        <input type="radio" name="poll_option" value=<?= $poll->poll_option_id ?> <?=isset($poll->poll_choice_id) ? 'checked= "checked"' : '' ?>> <?= $poll->option ?><br>
                        <!-- <input type="radio" name="opinion" value="need_improvement"> Need Improvement<br>
                        <input type="radio" name="opinion" value="much_better"> Much Better.<br> -->
                    <?php endforeach; ?>
                    <!-- <h6><strong>Add Comments</strong></h6>
                    <textarea id="comment" name="comment" placeholder="Write your comments"></textarea><br> -->
                    <button class="btn btn-primary btn-block" id="btnFeedback" type="button">Submit</button>
                    <!-- <button class="" type="submit">Submit</button> -->
                    </form>
                    <span class="label label-primary"> <a data-toggle="modal" href='#modal_poll_results'
                        id="poll_results">Results</a></span>
                  <?php endif; ?>
                </div>
            </div>
        </section>
        <div class="modal fade" id="modal_poll_results">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal"
                                                                        aria-hidden="true">&times;
                                                                </button>
                <h4 class="modal-title">Poll Results</h4>
              </div>
              <div class="modal-body">
              <div id="myCarousel" class="carousel slide" data-interval="false" data-ride="carousel">
             <!-- Indicators -->
             <ol class="carousel-indicators">
                <?php foreach ($polls as $key => $poll): ?>
                    <?php $poll_count = '';
                       $options = '';
                       $poll_options = get_poll_options_by_poll_id($poll->poll_id); ?>
                       <?php foreach ($poll_options as $key_inner => $option): ?>
                           <?php $options .= $option->option . ','; ?>
                           <?php $poll_count .= get_poll_option_count($poll->poll_id, $option->poll_option_id) . ','; ?>
                       <?php endforeach;
                       if (empty($poll_count)) $poll_count = 0;
                       if (empty($poll_count)) $options = 0; ?>
                       <li data-target="#myCarousel" data-name="poll_item<?= $key ?>"
                           data-options-value="<?= remove_trailing_commas($options) ?>"
                           data-count-value="<?= remove_trailing_commas($poll_count) ?>"
                           data-slide-to="<?= $key ?>"
                           class="<?= $key == 0 ? 'active' : '' ?>"></li>
                   <?php endforeach; ?>                     
              </ol>                       

               <!-- Wrapper for slides -->
               <div class="carousel-inner" role="listbox">
                  <?php foreach ($polls as $key => $poll): ?>
                      <div class="item <?= $key == 0 ? 'active' : '' ?>">
                          <div class="portlet box mbl col-md-12 pull-left">
                             <div class="portlet-header">
                                <div class="caption"><?= $poll->name ?> - Poll</div>
                                  <div class="tools"><i class="fa fa-chevron-up"></i>
                                    <!-- <i data-toggle="modal" data-target="#modal-config" class="fa fa-cog"></i><i class="fa fa-refresh"></i><i class="fa fa-times"></i> -->
                                  </div>
                                </div>                       
                                <div class="portlet-body">
                                    <div id="poll_chart<?= $key + 1 ?>"
                                        style="width: 100%; height:300px"></div>
                                    </div>
                          </div>                      
                      </div>                    
                  <?php endforeach; ?>                    
                </div>                 

                 <!-- Left and right controls -->
                  <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
                      <span class="fa fa-chevron-left" aria-hidden="true"></span>
                      <span class="sr-only">Previous</span>
                  </a>
                  <a class="right carousel-control" href="#myCarousel" role="button"
                    data-slide="next">
                    <span class="fa fa-chevron-right" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                  </a>                
        </div>
              </div>
            </div>
          </div>
        </div>
        

    </main>
    <!-- END Main container -->
   
  <script type="text/javascript">  
     
    $(document).ready(function () {
        
        var url = "<?php echo site_url(); ?>submit_poll_feedback";
        //var url ="http://localhost:81/recruitment-ally/submit_poll_feedback/";
        console.log('dasasd ',url);
        
        $('#btnFeedback').click(function(){
            $.ajax({
                url: url,
                type: "POST",
                data: $("#feedback").serialize(),
                success: function (response) {
                        console.log("Success");
                        window.location.href = response.redirect;
                }
            });
        });

        $('#poll_results').click(function () {
           console.log("Clicked ....")
            setTimeout(function () {
                //START BAR CHART
                console.log("Clicked 2....")
                $('#myCarousel').find('.carousel-indicators li').each(function (index, el) {
                  console.log("Clicked 3....")
                    var poll_options = $(this).attr('data-options-value').split(',');
                    console.log("Clicked 4....")
                    var poll_vote_count = $(this).attr('data-count-value').split(',');
                    console.log("Options ...",poll_options);
                    var arr_data = [];

                    for (var i = 0; i < poll_options.length; i++) {
                        var new_arr = [poll_options[i], poll_vote_count[i]];
                        arr_data.push(new_arr);
                    }
                    ;

                    //console.log(arr_data);
                    var d3 = arr_data;
                    $.plot("#poll_chart" + (index + 1), [{
                        data: d3,
                        label: "Results",
                        color: "#01b6ad"
                    }], {
                        series: {
                            bars: {
                                align: "center",
                                lineWidth: 0,
                                show: !0,
                                barWidth: .5,
                                fill: .9
                            }
                        },
                        grid: {
                            borderColor: "#fafafa",
                            borderWidth: 1,
                            hoverable: !0
                        },
                        tooltip: !0,
                        tooltipOpts: {
                            content: "%x : %y",
                            defaultTheme: false
                        },
                        xaxis: {
                            tickColor: "#fafafa",
                            mode: "categories"
                        },
                        yaxis: {
                            tickColor: "#fafafa"
                        },
                        shadowSize: 0
                    });
                });
                //END BAR CHART

            }, 500);
        });

      });
</script>
