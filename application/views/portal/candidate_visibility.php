<?php $this->load->view('partial/portal_header.php'); ?>
<?php $this->load->view('partial/portal_sidebar.php'); ?>
<?php $this->load->view('partial/portal_breadcrumbs.php'); ?>
<style>
        #canvas .circle {
            display: inline-block;
            margin: 1em;
        }

        .circles-decimals {
            font-size: .4em;
        }
    </style>
<!--BEGIN CONTENT-->
                <div class="page-content">
                    <div id="tab-general">
                                <div class="panel col-lg-9 left-padding right-padding" style="background:#FFF;">
                                    <div class="panel-heading">Profile Visibility</div>
                                    <div class="panel-body">
                                        <div id="canvas">
                                            <div class="portlet box mbl col-md-6">
                                                    <div class="portlet-header">
                                                        <div class="caption">How Many Times My Profile Viewed in Total</div>
                                                        <!-- <div class="tools"><i class="fa fa-chevron-up"></i><i data-toggle="modal" data-target="#modal-config" class="fa fa-cog"></i><i class="fa fa-refresh"></i><i class="fa fa-times"></i></div> -->
                                                    </div>
                                                    <div class="portlet-body">
                                                        <div class="circle" id="circles-2"></div>
                                                    </div>
                                            </div>
                                            <div class="portlet box mbl col-md-6 pull-left">
                                                    <div class="portlet-header">
                                                        <div class="caption">How Many Times Employers Viewed My Profile</div>
                                                        <!-- <div class="tools"><i class="fa fa-chevron-up"></i><i data-toggle="modal" data-target="#modal-config" class="fa fa-cog"></i><i class="fa fa-refresh"></i><i class="fa fa-times"></i></div> -->
                                                    </div>
                                                    <div class="portlet-body">
                                                        <div class="circle" id="circles-1"></div>
                                                    </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                           <?php $this->load->view('partial/portal_job_search.php'); ?>
                        </div>
                      </div>
                    </div>
                <!--END CONTENT-->

<?php $this->load->view('partial/portal_footer.php'); ?>
<script src="<?=base_url()?>assets/portal/script/circles.min.js"></script>
<script>
        var colors = [
                ['#BEE3F7', '#45AEEA'],['#F4BCBF', '#D43A43']
            ],
            circles = []; 

        for (var i = 1; i <= 2; i++) {
            if(i == 1)
                percentage = <?=$employer_views?>;
            else
                percentage= <?=$cv_views?>;
            var child = document.getElementById('circles-' + i),
                circle = Circles.create({
                    id:         child.id,
                    value: percentage,
                    maxValue: percentage,
                    number:     250,
                    radius:     150,
                    width:      25,
                    duration:   200,
                    colors:     colors[i - 1]
                });
            circles.push(circle);
        }

        // window.onresize = function(e) {
        //     for (var i = 0; i < circles.length; i++) {
        //         circles[i].updateRadius(getWidth());
        //     }
        // };

        function getWidth() {
            return window.innerWidth / 20;
        }
</script>
