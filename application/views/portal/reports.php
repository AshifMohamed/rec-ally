<?php $this->load->view('partial/portal_header.php'); ?>
<?php $this->load->view('partial/portal_sidebar.php'); ?>
<?php $this->load->view('partial/portal_breadcrumbs.php'); ?>
<!-- Graph -->
<!-- <link rel="stylesheet" href="<?=base_url()?>assets/portal/styles/example.css">
<link rel="stylesheet" href="<?=base_url()?>assets/portal/styles/material-charts.css">
-->
<!--BEGIN CONTENT-->
<div class="page-content">
    <div id="tab-general">
        <div class="mbl row ">
            <div class="col-lg-12">
                <div class="panel panel-blue col-lg-12 left-padding right-padding" style="background:#FFF;">
            <div class="panel-heading">Dashboard Reports</div>
            <div class="panel-body">
                <div class="portlet box mbl col-md-6 pull-left">
                        <div class="portlet-header">
                            <div class="caption">Opened and Closed Position</div>
                            <div class="tools"><i class="fa fa-chevron-up"></i><!-- <i data-toggle="modal" data-target="#modal-config" class="fa fa-cog"></i><i class="fa fa-refresh"></i><i class="fa fa-times"></i> --></div>
                        </div>
                        <div class="portlet-body">
                            <div id="placeholder" style="width: 100%; height:300px"></div>
                        </div>
                </div>
                <div class="portlet box mbl col-md-6 pull-left">
                        <div class="portlet-header">
                            <div class="caption">Company Website Visited - Count</div>
                            <div class="tools"><i class="fa fa-chevron-up"></i><!-- <i data-toggle="modal" data-target="#modal-config" class="fa fa-cog"></i><i class="fa fa-refresh"></i><i class="fa fa-times"></i> --></div>
                        </div>
                        <div class="portlet-body">
                            <div id="website_linked_clicked" style="width: 100%; height:300px"></div>
                        </div>
                </div>
                <div class="portlet box mbl col-md-12 pull-left">
                        <div class="portlet-header">
                            <div class="caption">Number of Likes</div>
                            <div class="tools"><i class="fa fa-chevron-up"></i><!-- <i data-toggle="modal" data-target="#modal-config" class="fa fa-cog"></i><i class="fa fa-refresh"></i><i class="fa fa-times"></i> --></div>
                        </div>
                        <div class="portlet-body job_likes report_badges">
                            <?php foreach ($liked_jobs as $key => $job): ?>
                                <div class="col-sm-3">
                                    <div class="progress progress-sm">
                                        <div class="progress-bar progress-bar-danger" style="width: 100%;" aria-valuemax="100" aria-valuemin="0" aria-valuenow="100" role="progressbar">
                                            <div class="pull-left">&nbsp;&nbsp;<?=$job->job_ref_no?></div>
                                            <span class="badge badge- pull-right"><?=$job->total_likes?></span>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                            <div class="clearfix"></div>
                            <!-- <div id="bar-chart" style="width: 100%; height:300px"></div> -->
                        </div>
                </div>
                <div class="portlet box mbl col-md-12 pull-left">
                        <div class="portlet-header">
                            <div class="caption">Job Appeared in Search - Count</div>
                            <div class="tools"><i class="fa fa-chevron-up"></i><!-- <i data-toggle="modal" data-target="#modal-config" class="fa fa-cog"></i><i class="fa fa-refresh"></i><i class="fa fa-times"></i> --></div>
                        </div>
                        <div class="portlet-body job_appearances report_badges">
                            <?php foreach ($job_appearances as $key => $appearance): ?>
                                <div class="col-sm-4">
                                    <div class="progress progress-sm">
                                        <div class="progress-bar progress-bar-info" style="width: 100%;" aria-valuemax="100" aria-valuemin="0" aria-valuenow="100" role="progressbar">
                                            <div class="pull-left">&nbsp;&nbsp;<?=$appearance->job_ref_no?></div>
                                            <span class="badge badge pull-right"><?=$appearance->appearance_count?></span>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                            <div class="clearfix"></div>
                            <!-- <div id="job_appearance_chart" style="width: 100%; height:300px"></div> -->
                        </div>
                </div>
                <div class="portlet box mbl col-md-6 pull-left">
                        <div class="portlet-header">
                            <div class="caption">Position Closing Info</div>
                            <div class="tools"><i class="fa fa-chevron-up"></i><!-- <i data-toggle="modal" data-target="#modal-config" class="fa fa-cog"></i><i class="fa fa-refresh"></i><i class="fa fa-times"></i> --></div>
                        </div>
                        <div class="portlet-body">
                            <table class="table table-hover table-bordered">
                                <thead>
                                    <tr>
                                        <th>Job Reference</th>
                                        <th>Closing Date</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($job_profiles as $key => $job_profile) : ?>                                            
                                    <tr>
                                        <td><?=$job_profile->job_ref_no?></td>
                                        <td><?=$job_profile->close_date?></td>
                                        <td><a href="<?=base_url()?>posting/<?=$job_profile->job_ref_no?>"  class="label label-info" target="_blank">View Posting</a></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                        </div>
                </div>
            </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--END CONTENT-->

<?php $this->load->view('partial/portal_footer.php'); ?>

<!-- graph -->
    <!--<script src="<?=base_url()?>assets/portal/script/material-charts.js"></script>
    <script src="<?=base_url()?>assets/portal/script/example.js"></script> -->
    <style type="text/css"> 
        .report_badges{padding-bottom: 5px!important}
        .report_badges .progress-bar{padding: 3px;} 
        .report_badges .progress.progress-sm{height:24px!important;margin-bottom: 15px!important} 
        .report_badges .badge {background-color: #fff !important;font-weight: bold;}
        .job_likes .badge{color:#682782!important;}
        .job_appearances .badge{color:#0b78a3!important;}

    </style>
    <script type="text/javascript">
    function labelFormatter(label, series) {
        return "<div style='font-size:8pt; text-align:center; padding:2px; color:white;'>" + label + "<br/>" + Math.round(series.data[0][1]) + "</div>";
    }
    $(function(){

        // PIE CHART 1 START
        var data = [
        { label: "Opened Positions",  data: <?=count($opened_jobs)?>},
        { label: "Closed Positions",  data: <?=count($closed_jobs)?>}
        ];
            //placeholder.unbind();

            $("#title").text("Label Styles #1");
            $("#description").text("Semi-transparent, black-colored label background.");

            $.plot('#placeholder', data, {
                series: {
                    pie: { 
                        show: true,
                        radius: 1,
                        label: {
                            show: true,
                            radius: 3/4,
                            formatter: function (label, series) {
                                return '<div style="font-size:8pt;text-align:center;padding:2px;color:white;">' + label + '<br/>' + series.data[0][1] + '</div>';

                            },
                            background: { 
                                opacity: 0.5,
                                color: "#000"
                            }
                        }
                    }
                },
                grid: {
                    hoverable: true,
                }
            });

        //PIE CHART 1 END

        //PIE CHART 2 START
        var data = [
        { label: "Times visited",  data: <?=$profile->website_clicked_count?>}
        ];
        $.plot('#website_linked_clicked', data, {
            series: {
                pie: { 
                    show: true,
                    radius: 1,
                    label: {
                        show: true,
                        radius: 2/4,
                        formatter: function (label, series) {
                            return '<div style="font-size:8pt;text-align:center;padding:2px;color:white;">' + label + '<br/>' + series.data[0][1] + '</div>';

                        },
                        background: { 
                            opacity: 0.5,
                            color: "#000"
                        }
                    }
                }
            },
            grid: {
                hoverable: true,
            }
        });

        //PIE CHART 2 END

        var liked_total = '<?=$liked_job_totals?>'.split(',');
        var liked_references = '<?=$liked_job_references?>'.split(',');
        var arr_data = [];
        for (var i = 0; i < liked_total.length; i++) {
            var new_arr = [liked_references[i],parseInt(liked_total[i])];
            arr_data.push(new_arr);
        };
        //console.log(arr_data);
        var d3  = arr_data;      
        //var d3 = [["Jan", 93],["Feb", 78],["Mar", 47],["Apr", 35],["May", 48],["Jun", 26],["Jul", 49],["Aug", 96],["Sep", 54],["Oct", 99],["Nov", 92],["Dec", 43]];
        $.plot("#bar-chart", [{
                data: d3,
                label: "Jobs Liked Count",
                color: "#01b6ad"
            }], {
            series: {
                bars: {
                    align: "center",
                    lineWidth: 0,
                    show: !0,
                    barWidth: .5,
                    fill: .9
                }
            },
            grid: {
                borderColor: "#fafafa",
                borderWidth: 1,
                hoverable: !0
            },
            tooltip: !0,
            tooltipOpts: {
                content: "%x : %y",
                defaultTheme: false
            },
            xaxis: {
                tickColor: "#fafafa",
                mode: "categories"
            },
            yaxis: {
                tickColor: "#fafafa"
            },
            shadowSize: 0
        });

        //START BAR CHART
        var appearance_total = '<?=$appearance_job_count?>'.split(',');
        var appearance_references = '<?=$appearance_job_references?>'.split(',');
        var arr_data = [];
        // for (var i = 0; i < appearance_total.length; i++) {
        //     var new_arr = {label:appearance_references[i],data:parseInt(appearance_total[i],color:'#01b6ad')};
        //     arr_data.push(new_arr);
        // };
        // var new_arr = {data:[appearance_references[i],parseInt(appearance_total[i])],label:appearance_references[i],color: "#01b6ad"};
        for (var i = 0; i < appearance_total.length; i++) {
            // if(appearance_total[i] == '0')
            //     appearance_total[i] = 0.3;
            var new_arr = [appearance_references[i],parseInt(appearance_total[i])];
            arr_data.push(new_arr);
        };
        //console.log(arr_data);
        var d3  = arr_data;      
        //var d3 = [["Jan", 93],["Feb", 78],["Mar", 47],["Apr", 35],["May", 48],["Jun", 26],["Jul", 49],["Aug", 96],["Sep", 54],["Oct", 99],["Nov", 92],["Dec", 43]];
        $.plot("#job_appearance_chart",[{
                data: d3,
                label: "Number of Time Appeared",
                color: "#01b6ad"
            }],{
            series: {
                bars: {
                    align: "center", 
                    lineWidth: 0,
                    show: !0,
                    barWidth: .5,
                    fill: .9
                }
            },
            grid: {
                borderColor: "#fafafa",
                borderWidth: 1,
                hoverable: !0
            },
            tooltip: !0,
            tooltipOpts: {
                content: "%x : %y",
                defaultTheme: false
            },
            xaxis: {
                tickColor: "#fafafa",
                mode: "categories"
            },
            yaxis: {
                tickColor: "#fafafa"
            },
            shadowSize: 0
        });
        //END BAR CHART

});

</script>