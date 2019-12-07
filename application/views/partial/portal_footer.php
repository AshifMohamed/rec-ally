<!--BEGIN FOOTER-->
<!-- <div id="footer">
	<div class="copyright">
		<a href="#"> </a>
	</div>
</div> -->
<!--END FOOTER-->
</div>
<!--END PAGE WRAPPER-->
</div>
</div>

<script src="<?=base_url();?>assets/portal/script/jquery-2.1.1.min.js"></script>
<script src="<?=base_url();?>assets/portal/script/jquery-migrate-1.2.1.min.js"></script>
<script src="<?=base_url();?>assets/portal/script/jquery-ui.js"></script>
<script src="<?=base_url();?>assets/portal/script/bootstrap.min.js"></script>
<script src="<?=base_url();?>assets/portal/script/bootstrap-hover-dropdown.js"></script>
<script src="<?=base_url();?>assets/portal/script/html5shiv.js"></script>
<script src="<?=base_url();?>assets/portal/script/respond.min.js"></script>
<script src="<?=base_url();?>assets/portal/script/jquery.metisMenu.js"></script>
<script src="<?=base_url();?>assets/portal/script/jquery.slimscroll.js"></script>
<script src="<?=base_url();?>assets/portal/script/jquery.cookie.js"></script>
<script src="<?=base_url();?>assets/portal/script/icheck.min.js"></script>
<script src="<?=base_url();?>assets/portal/script/custom.min.js"></script>
<script src="<?=base_url();?>assets/portal/script/jquery.news-ticker.js"></script>
<script src="<?=base_url();?>assets/portal/script/jquery.menu.js"></script>
<script src="<?=base_url();?>assets/portal/script/pace.min.js"></script>
<script src="<?=base_url();?>assets/portal/script/holder.js"></script>
<script src="<?=base_url();?>assets/portal/script/responsive-tabs.js"></script>
<script src="<?=base_url();?>assets/portal/script/jquery.flot.js"></script>
<script src="<?=base_url();?>assets/portal/script/jquery.flot.pie.js"></script>
<script src="<?=base_url();?>assets/portal/script/jquery.flot.stack.js"></script>
<script src="<?=base_url();?>assets/portal/script/jquery.flot.spline.js"></script>
<script src="<?=base_url();?>assets/portal/script/jquery.flot.categories.js"></script>
<!--<script src="<?=base_url();?>assets/portal/script/jquery.flot.tooltip.js"></script>
<script src="<?=base_url();?>assets/portal/script/jquery.flot.fillbetween.js"></script>
-->
<script src="<?=base_url();?>assets/portal/script/zabuto_calendar.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.6/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/js/bootstrap-datetimepicker.min.js"></script>
<!--LOADING SCRIPTS FOR CHARTS-->
<script src="<?=base_url();?>assets/portal/script/highcharts.js"></script>
<script src="<?=base_url();?>assets/portal/script/data.js"></script>
<script src="<?=base_url();?>assets/portal/script/drilldown.js"></script>
<script src="<?=base_url();?>assets/portal/script/exporting.js"></script>

<!-- Farshad added this -->
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

<!--CORE JAVASCRIPT-->
<script src="<?=base_url();?>assets/portal/script/main.js"></script>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-73721047-1', 'auto');
  ga('send', 'pageview');

  // confirmation modal
  function confirmation(url, message){
        $("#dialog").dialog({
            buttons : {
                "Yes" : function() {
                window.location.href = url;
                },
                "No" : function() {
                $(this).dialog("close");
                }
            }
            });
            $("#dialog").html(message);
            $("#dialog").dialog("open");
    }
</script>
<script>
    $(document).ready(function () {

        let base_path = '<?=base_url()?>';
        let ad_image_path = '/uploads/advertisements/';
        let default_image = base_path+ad_image_path+'default_ad.jpg';
        let count = 0;
        let ad_obj = [];
        if ( $( "#ad_banner" ).length ) {
            // console.log("Haveeeeeeeeeeeeeee");
            get_advertisements();
        }

        function rotateImage()
        {
            let img_url = default_image;

            if(ad_obj)
            {
                if(count >= ad_obj.length ) 
                    count = 0;
                console.log("Called ",count)
               console.log(ad_obj[count].image_name)
                img_url = base_path+ad_image_path+ad_obj[count].image_name;
                swapImages(img_url,ad_obj[count].time * 3600000);
            }
            else
            {
                setDefaultImage();
            } 
            count++;  
        }

        function swapImages(img_url,timeout){
            $('#ad_banner').attr('src',img_url);  
            setTimeout(function() {
                rotateImage();
            }, timeout);
        }

        function setDefaultImage(){
            $('#ad_banner').attr('src',default_image);         
        }

        function get_advertisements()
        {
            let post_path = base_path +'/get_advertisements';
            $.ajax({
				type:'GET', 
				url:post_path,
                dataType: 'json',
				success:function(result){
                    if(result.length == 0)
                    {
                        setDefaultImage();
                    }
                    else
                    {
                        ad_obj = result;
                        console.log(ad_obj)
                        count =  getRandomArbitrary(0,ad_obj.length);
                        rotateImage();
                    }
				},
				error:function(err){

				}, 
			});
        }

        function getRandomArbitrary(min, max) 
        {
            return Math.floor(Math.random() * (max - min) + min);
        }

    });

</script>
</body>
</html>