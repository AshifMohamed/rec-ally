<!--Modals-->
<div class="modal fade" id="improveCvModal" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">
          &times;
        </button>
        <h4 class="modal-title">How to improve CV</h4>
      </div>
      <div class="modal-body">
        <div class="bs-example">
          <div class="tab-content">
            <div id="sectionA" class="tab-pane fade in active">
              <h5>
                To improve your online CV strength, the following tips should be
                helpful:
              </h5>
              <p>
                <b>Work Experience:</b> Describe your work experiences in detail
                - try to explain your role with information about your
                responsibilities, projects, initiatives, achievements, etc. If
                you are a fresh graduate or a student, include internships
                and/or professional projects in your work experience.
              </p>
              <p>
                <b>Education:</b> Ensure that you have provided information
                about your highest level of education. It is recommended to list
                other education details as well.
              </p>
              <p>
                <b>Further Information:</b> If you have certifications and
                skills, please provide complete and up-to-date information. List
                all languages you know as this can be useful information for
                employers.
              </p>
            </div>
            <div id="sectionC" class="tab-pane fade in active">
              <h5>
                To improve your online CV strength, the following video should
                be helpful:
              </h5>

              <video width="400" height="240" controls>
                <source src="<?=base_url()?>assets/portal/videos/how-to-improve-cv.ogg" type="video/ogg" />
                <source src="<?=base_url()?>assets/portal/videos/hows-to-improve-cv.mp4" type="video/mp4" />
                
                <!-- fallback to Flash: -->
                <object width="400" height="240" type="application/x-shockwave-flash" data="__FLASH__.SWF">
                    <!-- Firefox uses the `data` attribute above, IE/Safari uses the param below -->
                    <param name="movie" value="<?=base_url()?>assets/portal/videos/how-to-improve-cv.swf" />
                    <!-- <param name="flashvars" value="controlbar=over&amp;image=__POSTER__.JPG&amp;file=__VIDEO__.MP4" /> -->
                    <!-- fallback image. note the title field below, put the title of the video there -->
                    <img src="<?=base_url()?>assets/portal/images/novideo.png" width="400" height="240" alt="How to improve your CV"
                        title="No video playback capabilities, please download the video below" />
                </object>

               </video>    
            </div>
            <div id="sectionB" class="tab-pane fade">
              <h3>Section B</h3>
              <p>
                Vestibulum nec erat eu nulla rhoncus fringilla ut non neque.
                Vivamus nibh urna, ornare id gravida ut, mollis a magna. Aliquam
                porttitor condimentum nisi, eu viverra ipsum porta ut. Nam
                hendrerit bibendum turpis, sed molestie mi fermentum id. Aenean
                volutpat velit sem. Sed consequat ante in rutrum convallis. Nunc
                facilisis leo at faucibus adipiscing.
              </p>
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
