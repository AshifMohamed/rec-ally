<div class="modal fade" id="modal_reply_to_message<?=$key?>">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button
          type="button"
          class="close"
          data-dismiss="modal"
          aria-hidden="true"
        >
          &times;
        </button>
        <h4 class="modal-title"><?=$messages['subject']?></h4>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-12 col-sm-12">
            <form
              action="<?=base_url()?>candidate/reply_to_message"
              method="POST"
              role="form"
            >
              <div class="col-md-8 col-sm-8 left-padding section-content">
                <input
                  type="hidden"
                  name="candidate_message_id"
                  id="candidate_message_id"
                  value="<?=$messages['candidate_message_id']?>"
                />

                <h4>Message</h4>
                <textarea
                  class="col-md-12 col-sm-12"
                  rows="10"
                  required="required"
                  name="message"
                  id="message"
                ></textarea>

                <div class="form-actions">
                  <button type="submit" class="btn btn-primary">
                    Send Reply
                  </button>
                </div>
              </div>
            </form>
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
