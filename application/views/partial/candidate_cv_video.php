<!--Modals-->
<div class="modal fade" id="cvVideoModal" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">
          &times;
        </button>
        <h4 class="modal-title">Upload your Video CV</h4>
      </div>
      <div class="modal-body">
        <div class="bs-example">
          <div class="tab-content">
           
            <div id="sectionC" class="tab-pane fade in active">
              <h5>
              </h5>
            <?php if(isset($cv_video_url)) { ?>
             
              <video width="320" height="240" controls="controls">
                <source src="<?=base_url().'uploads/candidate_profiles/cv_videos/'.$cv_video_url ?>" type="<?=getFileMimeType(base_url().'uploads/candidate_profiles/cv_videos/'.$cv_video_url)?>" />
                
              </video> 
              <p>Video format is not supported in this browser ?</p>
              <a href="<?=base_url().'uploads/candidate_profiles/cv_videos/'.$cv_video_url ?>" download>Download here</a>
            <?php } ?>
              <div style="clear:both;"></div>
              <br/>
              <div>
              <input type="hidden" id="candidate_profile_id" value="<?=$candidate_profile_id?>">
											  <form method="POST" id="candidate_cv_video_info_form" name="candidate_cv_video_info_form" action="<?=base_url().'candidate/save_candidate_cv_video'?>" enctype="multipart/form-data">
                        <input type="hidden" name="candidate_profile_id" id="candidate_profile_id" value="<?=isset($profile->candidate_profile_id) ? $profile->candidate_profile_id : 0?>"/>
                        <div class="form-group ">
															<label for="cv_video" class="control-label">
																Upload CV Video</label>
															<div class="form-group">
															<input id="cv_video" name="cv_video" type="file" >
                              </div>
												</div>
                        <div class="form-group text-right mb-0">
															<label class="control-label col-md-2 col-sm-2 col-xs-12"></label>
                              <button class="info-save btn btn-blue" id="save_cv_video">Upload</button>
													</div>
                        </form>
                        </div>
            </div>
            
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">
          Close
        </button>
      </div>
    </div>
  </div>
</div>
