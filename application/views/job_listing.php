<?php $this->load->view('header.php'); ?>

<!-- Page header -->
    <header class="page-header bg-img" style="background-image: url(<?php echo base_url(); ?>assets/img/bg-banner1.jpg);">
      <div class="container page-name">
        <h1 class="text-center">Browse jobs</h1>
        <p class="lead text-center">Use following search box to find jobs that fits you better</p>
      </div>

      <div class="container">
        <form method="post" action="<?php echo base_url() ?>job/filter_search" id="filter_search_form" name="filter_search_form">

          <div class="row">
            <div class="form-group col-xs-12 col-sm-12">
              <input type="text" class="form-control" name="keyword" id="keyword" placeholder="Keyword" value="<?=!empty($keyword) ? $keyword : !empty($keyword_s) ? $keyword_s :''?>">
            </div>
            <div class="clearfix"></div>

            <div class="form-group col-xs-12 col-sm-3">
              <h6>Contract</h6>
                <?php foreach ($employment_statuses as $key => $status) { ?>
                    <div class="checkbox">
                        <label><input type="checkbox" name="employment_status[]" value="<?=$status->employment_status_id?>">
                        <?=$status->status?></label>
                    </div><!-- /.checkbox -->
                <?php } ?>
            </div>

            <div class="form-group col-xs-12 col-sm-3">
              <h6>Salary</h6>                  
                <?php foreach ($salary_ranges as $key => $range) { ?>
                    <div class="checkbox">
                        <input type="checkbox" name="salary_range[]" value="<?=$range->salary_range_id?>">
                        <label><?=$range->salary_range?></label>
                    </div><!-- /.checkbox -->
                <?php } ?>
            </div>

            <div class="form-group col-xs-12 col-sm-3">
              <h6>Location</h6>
                <div class="loc-height">
                <?php foreach ($countries as $key => $country) { ?>
                    <div class="checkbox">
                        <input type="checkbox" name="country[]" value="<?=$country->country_id?>"> 
                        <label><?=$country->country?></label>
                    </div><!-- /.checkbox -->
                <?php } ?>
                </div>
            </div>
        
            <div class="form-group col-xs-12 col-sm-3">
              <h6>Level of position</h6>
                <div class="loc-height">
                <?php foreach ($career_levels as $key => $level) { ?>
                    <div class="checkbox">
                        <input type="checkbox" name="career_level[]" value="<?=$level->career_level_id?>">
                        <label><?=$level->career_level?></label>
                    </div><!-- /.checkbox -->
                <?php } ?>
                </div>
            </div>

          </div>

          <div class="button-group hidden">
            <div id="filter_results" class="action-buttons">
              <button type="button" class="btn btn-primary btn-block btn-reset-filter">Apply filter</button>
            </div>
          </div>

        </form>

      </div>

    </header>
    <!-- END Page header -->


    <!-- Main container -->
    <main>
      <section class="no-padding-top bg-alt">
        <div class="container">
          <div class="row">
			<ul class="breadcrumb pg-bc">
			  <li><a href="<?php echo base_url(); ?>">Home</a></li>
			  <li>Listing</li>
			</ul>
            <div class="col-xs-12">
              <br>
              <h5>We found <strong id="listing_total"><?php echo count($jobs)?></strong> matches
              <p class="hidden">you're watching <i>10</i> to <i>20</i></p></h5>
            </div>

            <!-- Job item -->
            <div class="col-xs-12">
                <div class="positions-list">
                    <?php foreach ($jobs as $key => $job) { ?>
                        <div class="item-block">
                          <header>
                            <div class="hgroup">
                              <a href="<?php echo base_url().'posting/'.$job->job_ref_no; ?>"><h4><?php echo $job->position; ?></h4></a>
                              <h5><?php echo $job->company_name; ?> <span class="label label-success"><?php if(is_job_already_save($job->job_profile_id) > 0){?>Position Saved<?php }else{ ?><a href="<?php echo base_url() ?>save_job_position/<?php echo $job->job_ref_no?>" <?php echo is_user_logged_in() ? '' : 'data-target="#login_modal" data-toggle="modal"'?>>Save Position</a><?php } ?></span></h5>
                            </div>
                            <time datetime="<?php echo $job->posted_date; ?>"><?php $date=date_create($job->posted_date);?> <?php echo date_format($date,"Y/m/d");?></time>
                          </header>

                          <footer>
                            <ul class="details cols-3">
                              <li>
                                <i class="fa fa-map-marker"></i>
                                <span><?php echo $job->country?></span>
                              </li>

                              <li>
                                <i class="fa fa-clock-o"></i>
                                <span>
                                    <?php if($job->employment_status_id == 1){
                                        echo 'Full Time';
                                    }else if($job->employment_status_id == 2){
                                        echo 'Part Time';
                                    }else if($job->employment_status_id == 2){
                                        echo 'Temporary';
                                    } ?>
                                </span>
                              </li>

                              <li>
                                <i class="fa fa-suitcase"></i>
                                <span>Job Ref:<?php echo $job->job_ref_no?></span>
                              </li>
                            </ul>
                          </footer>
                        </div>
                    <?php } ?>
                </div>
            </div>
            <!-- END Job item -->



          </div>


          <!-- Page navigation -->
          <?php echo $pagination; ?>
          <!-- END Page navigation -->

        </div>
      </section>
    </main>
    <!-- END Main container -->

<?php $this->load->view('footer.php'); ?>