<?php $this->load->view('header.php'); ?>

<!-- Page header -->
    <header class="page-header bg-img size-lg" style="background-image: url(<?php echo base_url(); ?>assets/img/bg-banner1.jpg)">
        <div class="container">
          
            <?php if(is_user_logged_in()): ?>
                <?php if(is_job_liked($job->job_profile_id) <= 0): ?>
                    <a href="<?=base_url()?>like_job/<?=$job->job_ref_no?>" class="like-job">Like</a>
                <?php else : echo 'Job Liked!'; endif; ?>
            <?php endif; ?>
            <?php
            $successfull_application = $this->input->get('status');
            if($job->is_position_filled){ ?>
                <div class="ad-alert ad-closed"><strong>Sorry!</strong> This position has been filled.</div>
            <?php }
            elseif($has_applied && $has_applied != -1){ 
                if(!isset($successfull_application)){ ?>
                    <div class="ad-alert ad-applied"><strong>Buddy!</strong> You have applied for this position.</div>
                <?php } else { ?>
                    <div class="ad-alert ad-applied"><strong>Congratualtions!</strong> Job Application Successful</div>
            <?php } } elseif($is_ad_expired){ ?>
                    <div class="ad-alert ad-xpired"><strong>Sorry!</strong> This ad is expired.</div>
            <?php } 
            elseif($profile_score < 80 && is_user_logged_in()){ ?>
                    <div class="ad-alert ad-xpired"><strong>Sorry!</strong> Please complete your profile.</div>
            <?php } ?>
        
        <div class="header-detail">
          <img class="logo" src="<?=!empty($job->company_logo)? base_url().'uploads/company_logos/'.$job->company_logo: base_url().'assets/portal/images/clogo.jpg'?>" alt="<?=$job->company_name?>">
          <div class="hgroup">
            <h1><?=$job->position?></h1>
            <h3><a href="#"><?=$job->company_name?></a></h3>
          </div>
          <time datetime="2016-03-03 20:00">2 days ago</time>
          <hr>
          <!-- <p class="lead">You will help Google build next-generation web applications like Gmail, Google Docs, Google Analytics, and the Google eBookstore and eBook readers. As a Front End Engineer at Google, you will specialize in building responsive and elegant web UIs with AJAX and similar technologies. You may design or work on frameworks for building scalable frontend applications. We are looking for engineers who are passionate about and have experience building leading-edge user experience, including dynamic consumer experiences.</p> -->

          <!-- <ul class="details cols-3"> -->
            <!-- <li> -->
              <!-- <i class="fa fa-map-marker"></i> -->
              <!-- <span>Menlo Park, CA</span> -->
            <!-- </li> -->

            <!-- <li> -->
              <!-- <i class="fa fa-briefcase"></i> -->
              <!-- <span>Full time</span> -->
            <!-- </li> -->

            <!-- <li> -->
              <!-- <i class="fa fa-money"></i> -->
              <!-- <span>$90,000 - $110,000 / year</span> -->
            <!-- </li> -->

            <!-- <li> -->
              <!-- <i class="fa fa-clock-o"></i> -->
              <!-- <span>40h / week</span> -->
            <!-- </li> -->

            <!-- <li> -->
              <!-- <i class="fa fa-flask"></i> -->
              <!-- <span>2+ years experience</span> -->
            <!-- </li> -->

            <!-- <li> -->
              <!-- <i class="fa fa-certificate"></i> -->
              <!-- <a href="#">Master or Bachelor</a> -->
            <!-- </li> -->
          <!-- </ul> -->
                    <?php $screening_elements = explode(',',$job->posting_elements); ?>
                    <table class="table jb-description-table">
			<tbody>
                            <?php if(in_array('country', $screening_elements)): ?>
                            <tr>
                                <td>Location </td>
                                <td><?=remove_trailing_commas($job->country.', '.$job->city)?></td>
                            </tr>
                            <?php endif; ?>
                            <tr>
                                <td>Vacancy </td>
                                <td><?=$job->job_ref_no?></td>
                            </tr>
                            <?php if(in_array('industry', $screening_elements)): ?>
                            <tr>
                                <td>Company Industry </td>
                                <td><?php $value=''; foreach ($industries as $key => $industry){ $value.=$industry->industry.', '?>
                                    <?php } print remove_trailing_commas($value); ?></td>
                            </tr>
                            <?php endif; ?>
                            <?php if(in_array('job_history_category', $screening_elements)): ?>
                            <tr>
                                <td>Job Families </td>
                                <td><?php $value=''; foreach ($job_history_categories as $key => $job_history_category) { $value.=$job_history_category->history_category.', '?>
                                    <?php } print remove_trailing_commas($value); ?></td>
                            </tr>
                            <?php endif; ?>
                            <?php if(in_array('nationality', $screening_elements)): ?>
                            <tr>
                                <td>Open to Nationality </td>
                                <?php if(!isset($is_all_nationality)): ?>
                                    <td><?php $value=''; foreach ($nationalities as $key => $nationality) { $value.=$nationality->nationality.', '?>
                                <?php } print remove_trailing_commas($value);?></td>
                                <?php else: ?>
                                    <td> Any Nationality </td>
                                <?php endif; ?>
                            </tr>
                            <?php endif; ?>
                            <?php if(in_array('gender', $screening_elements)): ?>
                            <tr>
                                <td>Gender </td>
                                <td><?=ucwords(str_replace(',',' , ',$job->genders))?></td>
                            </tr>
                            <?php endif; ?>
                            <?php if(in_array('language', $screening_elements)): ?>
                            <tr>
                                <td>Language</td>
                                <td><?php $value=''; foreach ($languages as $key => $language) { $value.=$language->language.', '?>
                                <?php } print remove_trailing_commas($value);?></td>
                            </tr>
                            <?php endif; ?>
                            <?php if(in_array('experience_level', $screening_elements)): ?>
                            <tr>
                                <td>Experience Level </td>
                                <td><?=$job->experience_level?></td>
                            </tr>
                            <?php endif; ?>
                            <?php if(in_array('career_level', $screening_elements)): ?>
                            <tr>
                                <td>Position Level</td>
                                <td><?=$job->career_level?></td>
                            </tr>
                            <?php endif; ?>
                            <?php if(in_array('mobility', $screening_elements)): ?>
                            <tr>
                                <td>Mobility</td>
                                <td><?php $value=''; foreach($mobilities as $key => $mobility) { $value.=$mobility->mobility.', '?>
                                <?php } print remove_trailing_commas($value);?></td>
                            </tr>
                            <?php endif; ?>
                            <?php if(in_array('minimum_education_requirement', $screening_elements)): ?>
                            <tr>
                                <td>Minimum Education Requirement</td>
				<td><?=$job->degree_type?></td>
                            </tr>
                            <?php endif; ?>
                            <?php if(in_array('notice_period', $screening_elements)): ?>
                            <tr>
                                <td>Notice Period </td>
				<td><?=$job->notice_period?></td>
                            </tr>
                            <?php endif; ?>
                            <?php if(in_array('preferred_age', $screening_elements)): ?>
                            <tr>
                                <td>Preferred Age</td>
                                <td><?=$job->age?></td>
                            </tr>
                            <?php endif; ?>
                            <?php if(in_array('maritial_status', $screening_elements)): ?>
                            <tr>
                                <td>Marital Status</td>
                                <td><?=$job->maritial_status?></td>
                            </tr>
                            <?php endif; ?>
                            <?php if(in_array('visa_status', $screening_elements)): ?>
                            <tr>
                                <td>Preferred Visa Status</td>
                                <td><?=$job->visa_status?></td>
                            </tr>
                            <?php endif; ?>
                            <?php if(in_array('driving_license_country', $screening_elements)): ?>
                            <tr>
                                <td>Driving License Required </td>
                                <td><?php $value=''; foreach ($driving_licenses as $key => $license) { $value.=$license->country.', '?>
                                <?php } print remove_trailing_commas($value);?></td>
                            </tr>
                            <?php endif; ?>
                            <?php if(in_array('salary_range', $screening_elements)): ?>
                            <tr>
                                <td>Salary Range</td>
                                <td><?=$job->salary_range?></td>
                            </tr>
                            <?php endif; ?>
                            <?php if(in_array('department', $screening_elements)): ?>
                            <tr>
                                <td>Department</td>
                                <td><?=$job->department?></td>
                            </tr>
                            <?php endif; ?>
                            <?php if(in_array('employment_status', $screening_elements)): ?>
                            <tr>
                                <td>Employement Status</td>
                                <td><?=$job->employment_status?></td>
                            </tr>
                            <?php endif; ?>
                            <?php if(in_array('employment_status', $screening_elements)): ?>
                            <tr>
                                <td class="jb-expiry">Job Expiry</td>
                                <td><?=$job->close_date?></td>
                            </tr>
                            <?php endif; ?>
			</tbody>
		  </table>
          <div class="button-group">
            <ul class="social-icons">
              <li class="title">Share on</li>
              <li><a class="facebook" href="#"><i class="fa fa-facebook"></i></a></li>
              <li><a class="google-plus" href="#"><i class="fa fa-google-plus"></i></a></li>
              <li><a class="twitter" href="#"><i class="fa fa-twitter"></i></a></li>
              <li><a class="linkedin" href="#"><i class="fa fa-linkedin"></i></a></li>
            </ul>

            <div class="action-buttons">
                <?php if((get_user_type() == 'candidate' && !$is_ad_expired && !$job->is_position_filled && !$has_applied && $profile_score >= 80) && is_user_logged_in()): ?>
                    <a href="<?=base_url()?>apply_job/<?=$job->job_ref_no?>"><button class="btn btn-success" type="button">Apply Now</button></a>
                <?php elseif(!is_user_logged_in()): ?>
                    <a class="btn btn-success" type="button" href="<?php echo site_url('login');?>">Apply Now</a>
                <?php endif; ?>
            </div>
          </div>

        </div>
      </div>
    </header>
    <!-- END Page header -->


    <!-- Main container -->
    <main>

      <!-- Job detail -->
      <section>
        <div class="container">

            <?php if(in_array('job_description', $screening_elements)): ?>
                <h4>Job Description</h4>
                <p><?=$job->job_description?></p>
            <?php endif; ?>
            <br>
            <?php if(in_array('job_duties', $screening_elements)): ?>	
                <h4>Job Duties</h4>
                <p><?=$job->job_duties?></p>
            <?php endif; ?>

            <div class="action-buttons pull-right">
              <a class="btn btn-success" href="job-apply.html">Apply now</a>                
                <?php if((get_user_type() == 'candidate' && !$is_ad_expired && !$job->is_position_filled && !$has_applied && $profile_score >= 80) && is_user_logged_in()): ?>
                    <a href="<?=base_url()?>apply_job/<?=$job->job_ref_no?>"><button class="btn btn-success" type="button">Apply Now</button></a>
                <?php elseif(!is_user_logged_in()): ?>
                    <button class="btn btn-success" type="button" <?=is_user_logged_in() ? '' : 'data-target="#login_modal" data-toggle="modal"'?>>Apply Now</button>
                <?php endif; ?>
            </div>
        </div>
      </section>
      <!-- END Job detail -->

    </main>
    <!-- END Main container -->

<?php $this->load->view('footer.php'); ?>