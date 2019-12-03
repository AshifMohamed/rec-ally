<?php $this->load->view('partial/portal_header.php'); ?>
<?php $this->load->view('partial/portal_sidebar.php'); ?>
<?php $this->load->view('partial/portal_breadcrumbs.php'); ?>
<link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/portal/styles/jplist-custom.css">
<!--BEGIN CONTENT-->
              
                        <div class="mbl">
                           
                            <div>
                            
                            <div class="page-content">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel">
                            <div class="panel-body">
                                <div id="grid-layout-table-1" class="box jplist">
                                        <div class="box text-shadow">
                                            <table class="demo-tbl" id="candidate_search_list"><!--<item>1</item>-->
                                                <thead>
                                                    <tr>
                                                        <th>Profile Pic</th>
                                                        <th>Info</th>
                                                        <th style="width:60px!important;">Action</th>
                                                    </tr>
                                                </thead>
                                                 <tfoot>
                                                    <tr>
                                                        <th>Profile Pic</th>
                                                        <th>Info</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </tfoot>
                                                
                                            </table>
                                        </div>

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

<!-- <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.10/css/jquery.dataTables.min.css"> -->
<!-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.10/css/dataTables.jqueryui.min.css"> -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.10/css/dataTables.bootstrap.min.css">
<style type="text/css">
div.dataTables_wrapper div.dataTables_processing{
    background: #3f516b none repeat scroll 0 0 !important;
    box-shadow: none !important;
    color: #fff !important;
    display: table;
    font-weight: bold !important;
    position: fixed;
    top: 50% !important;
    z-index: 10000000;
    margin-left: 0px!important;
    margin-top: 0px!important;
}
</style>
<script type="text/javascript" src="//cdn.datatables.net/1.10.10/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.10/js/dataTables.bootstrap.min.js"></script>
<script type="text/javascript" src="http://www.appelsiini.net/projects/lazyload/jquery.lazyload.js?v=1.9.1"></script>

<script type="text/javascript">
$(document).ready(function() {
    // $('#candidate_search_list').DataTable();
     var data_obj = {
            keyword_s : '<?=$this->input->get_post('keyword_s') ? $this->input->get_post('keyword_s') : ''?>',
            industry_s : '<?=$this->input->get_post('industry_s') ? $this->input->get_post('industry_s') : ''?>',
            country_s : '<?=$this->input->get_post('country_s') ? $this->input->get_post('country_s') : ''?>',
            experience_level_s : '<?=$this->input->get_post('experience_level_s') ? $this->input->get_post('experience_level_s') : ''?>'
    }

     $('#candidate_search_list').DataTable({
        "processing": true,
        "serverSide": true,
         "ajax" : {
            "url" : "<?=base_url()?>employer/search_candidate_ajax",
            "data":data_obj,
            "dataSrc" : function (json) {
                // return the data that DataTables is to use to draw the table
                console.log(json)
                return json.data;
            }
        }
    } );
});
</script>