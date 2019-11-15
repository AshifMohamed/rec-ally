<?php $this->load->view('partial/portal_header.php'); ?>
<?php $this->load->view('partial/portal_sidebar.php'); ?>
<?php $this->load->view('partial/portal_breadcrumbs.php'); ?>
<!--BEGIN CONTENT-->
                <div class="page-content">
                    <div id="tab-general">
                            <div class="mbl row ">
                                <div class="col-lg-12">
                                    <div class="panel panel-blue col-lg-9 left-padding right-padding" style="background:#FFF;">
                                        <div class="panel-heading">Saved Jobs</div>
                                        <br>
                                       
                                        <div class="panel-body">
                                            <?php $this->load->view('portal/change_email.php'); ?>
                                            <?php $this->load->view('portal/change_password.php'); ?>
                                        </div>
                                    </div>
                                    <?php $this->load->view('partial/portal_job_search.php'); ?>
                                </div>
                            </div>
                    </div>
                </div>
                <!--END CONTENT-->
<?php $this->load->view('partial/portal_footer.php'); ?>
<style type="text/css">

.error {
  color: red;
  margin-left: 5px;
}

</style>
<script type="text/javascript">

 var base_url = "<?php echo base_url() ?>";
 console.log("Base Url is :",base_url);
  $(function() {
       
        $("#btn_change_email").click(function()
        {
          if($('#form_change_email')[0].checkValidity())
          {  
            var old_email = $("#old_email").val();
            var new_email = $("#new_email").val();
     
            $.ajax({
                type: "POST",
                url: base_url + "candidate/change_email", 
                data: {old_email: old_email,
                    new_email: new_email 
                        },
                dataType: "text",  
                cache:false,
                success: 
                    function(data){
                        let res = JSON.parse(data);
                        console.log(data.message);
                        $('#global_notification').removeClass('hidden');
                        res.status ? $('#global_notification').addClass('alert-success') :                         $('#global_notification').addClass('alert-danger')

                        $('#global_notification').text(res.message);
                        $("#global_notification").show().delay(3000).fadeOut();
                       // $('#global_notification').show();
                      //  alert("Successss");  //as a debugging message.
                    }
                });
            }
        });
        
  });

</script>