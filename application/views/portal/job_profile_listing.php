<?php $this->load->view('partial/portal_header.php'); ?>
<?php $this->load->view('partial/portal_sidebar.php'); ?>
<?php $this->load->view('partial/portal_breadcrumbs.php'); ?>
<!--BEGIN CONTENT-->
                <div class="page-content">
                    <div id="tab-general">
                        <div class="mbl row ">
                            <div class="col-lg-12">
                                <div class="panel panel-blue left-padding right-padding" style="background:#FFF;">
        									<div class="panel-heading">Job Profile Listings</div>
        									<div class="panel-body">
                                                <?php if(count($job_profiles)){ ?>
        										<table class="table table-hover table-bordered">
        											<thead>
        											<tr>
                                                        <th>Job Ref</th>
        												<th>Candidates Applied</th>
        												<th>Position</th>
                                                        <th>Career Level</th>
        												<th>Category</th>
                                                        <th>Location</th>
                                                        <th>Close Date</th>
        												<th>Position Filled</th>
        												<th>Action</th>
        											</tr>
        											</thead>
        											<tbody>
                                                    <?php foreach($job_profiles as $key => $profile) { ?>
        											<tr> 

                                                        <td class="hidden"><input type="hidden" class="job_profile_id" value="<?=$profile->job_profile_id?>"/></td>
                                                        <td><?=$profile->job_ref_no?></td>
        												<td><b><?=get_candidates_applied_count_by_job_profile_id($profile->job_profile_id)?></b> &nbsp;(<a href="<?=base_url()?>employer/job_profile/view_candidates/<?=$profile->job_profile_id?>/applied_candidates" target="_blank">View</a>)</td>
                                                        <td><?=$profile->position?></td>
        												<td><?=$profile->career_level?></td>
        												<td><?=$profile->department?></td>
                                                        <td><?=$profile->country?></td>
                                                        <td><?=$profile->close_date?></td>
        												<td><div class="toggle-position-filled toggle-green"> </div><input id="is_position_filled" name="is_position_filled" class="hidden" type="checkbox" value="<?=$profile->is_position_filled ? 'true' : 'false'?>" <?=$profile->is_position_filled ? 'checked' : ''?> /></td>
        												<td>
                                                            <a href="<?=base_url()?>employer/job_profile/<?=$profile->job_profile_id?>" class="label label-info">Edit</a>
                                                            <a href="<?=has_job_expired($profile->close_date) ? base_url().'employer/job_profile/process_settings/'.$profile->job_profile_id : '#'?>" class="label <?=has_job_expired($profile->close_date) ? 'label-info' : 'label-default'?>">Process Feedback</a>
                                                            <a href="<?=has_job_expired($profile->close_date) ? base_url().'employer/job_profile/process/'.$profile->job_profile_id : '#'?>" class="label <?=has_job_expired($profile->close_date) ? 'label-info' : 'label-default'?>">Start Process</a>
                                                            <a href="<?=base_url()?>posting/<?=$profile->job_ref_no?>"  class="label label-info" target="_blank">View Posting</a>
        												    <a href="<?=base_url()?>employer/delete_job_profile/<?=$profile->job_profile_id?>"  class="label label-info" onclick="if(confirm('Are you sure to delete it?')) return true; else return false;">Delete</a>
                                                        </td>
        											</tr>
                                                    <?php } ?>
        											</tbody>
        										</table> 
                                                <?php }else{ ?>
                                                    <div class="alert alert-info" role="alert">No Job Profiles Created <strong>!</strong></div>
                                                <?php } ?> 
                                            </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- <?php $this->load->view('/partial/portal_candidate_search'); ?> -->
                </div>
              </div>
            </div>
<!--END CONTENT-->
<?php $this->load->view('partial/portal_footer.php'); ?>
<link rel="stylesheet" href="<?=base_url()?>assets/portal/styles/toggles.css">
<link rel="stylesheet" href="<?=base_url()?>assets/portal/styles/toggles-light.css">
<script src="<?=base_url()?>assets/portal/script/toggles.js" type="text/javascript"></script>
<style type="text/css">
.label-info
{
    line-height: 2.4;
}
</style>

<script type="text/javascript">
$(function(){
    $('.toggle-position-filled').each(function(){
        $(this).toggles({checkbox: $(this).next(),on:$(this).next().is(':checked'),text:{on: 'YES',off: 'NO'}}); 
    });
});
</script>