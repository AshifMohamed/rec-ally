<?php $this->load->view('partial/portal_header.php'); ?>
<?php $this->load->view('partial/portal_sidebar.php'); ?>
<?php $this->load->view('partial/portal_breadcrumbs.php'); ?>
<!--BEGIN CONTENT-->
                <div class="page-content">
                    <div id="tab-general">
                            <div class="mbl row ">
                                <div class="col-lg-12">
                                    <div class="panel panel-blue col-lg-9 left-padding right-padding" style="background:#FFF;">
                                        <div class="panel-heading">Settings</div>
                                        <br>
                                       
                                        <div class="panel-body">
                                            <?php $this->load->view('portal/change_email.php'); ?>
                                            <?php $this->load->view('portal/change_password.php'); ?>
                                        </div>
                                    </div>
                                    <?php $this->load->view('partial/portal_candidate_search.php'); ?>
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
                url: base_url + "employer/change_email", 
                data: {old_email: old_email,
                    new_email: new_email 
                        },
                dataType: "text",  
                cache:false,
                success: 
                    function(data){
                        let res = JSON.parse(data);
                    //    console.log(data.message);
                        $('#global_notification').removeClass('hidden');
                        if(res.status)
                    {
                        emptyEmailFields();
                        $('#global_notification').addClass('alert-success')
                    }
                    else
                    {
                        $('#global_notification').addClass('alert-danger')
                    }
                        // res.status ? $('#global_notification').addClass('alert-success') :                         $('#global_notification').addClass('alert-danger')

                        $('#global_notification').text(res.message);
                        $("#global_notification").show().delay(3000).fadeOut();
                       // $('#global_notification').show();
                      //  alert("Successss");  //as a debugging message.
                    }
                });
            }
        });

        $("#btn_change_pwd").click(function() {
        if ($('#form_change_pwd')[0].checkValidity()) {
            var old_pwd = $("#old_password").val();
            var new_pwd = $("#new_password").val();
            var confirm_pwd = $("#confirm_password").val();

            if (validate_password()) {
                $.ajax({
                    type: "POST",
                    url: base_url + "employer/change_password",
                    data: {
                        old_pwd: old_pwd,
                        new_pwd: new_pwd,
                        confirm_pwd: confirm_pwd
                    },
                    dataType: "text",
                    cache: false,
                    success: function(data) {
                        let res = JSON.parse(data);
                      //  console.log(data.message);
                        $('#global_notification').removeClass('hidden');
                        if(res.status)
                       {
                            emptyPasswordFields();
                            $('#global_notification').addClass('alert-success')
                       }
                       else
                       {
                            $('#global_notification').addClass('alert-danger')
                       }
                        // res.status ? $('#global_notification').addClass('alert-success') :
                        //     $('#global_notification').addClass('alert-danger')

                        $('#global_notification').text(res.message);
                        $("#global_notification").show().delay(3000).fadeOut();
                        // $('#global_notification').show();
                        //  alert("Successss");  //as a debugging message.
                    }
                });
            }
        }
    });

    $('#confirm_password').keyup(function(event) {
        return validate_password();
    });

    function validate_password() {
        password = $('#new_password');
        confirm_password = $('#confirm_password')
        if (password.val() != confirm_password.val()) {
            confirm_password.css({
                border: '1px solid red'
            });
            return false;
        } else
            confirm_password.css({
                border: '1px solid #e5e5e5'
            });
        return true;
    }

    function emptyEmailFields()
    {
         $("#old_email").val("");
         $("#new_email").val("");
    }

    function emptyPasswordFields()
    {
        $("#old_password").val("");
         $("#new_password").val("");
         $("#confirm_password").val("");
    }
        
  });

</script>