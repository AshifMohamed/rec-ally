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
                                    <!-- <div class="jplist-ios-button"><i class="fa fa-sort"></i>jPList Actions</div>
                                    <div class="jplist-panel box panel-top">
                                        <button type="button" data-control-type="reset" data-control-name="reset" data-control-action="reset" class="jplist-reset-btn btn btn-default">Reset<i class="fa fa-share mls"></i></button>
                                        <div data-control-type="drop-down" data-control-name="paging" data-control-action="paging" class="jplist-drop-down form-control">
                                            <ul class="dropdown-menu">
                                                <li><span data-number="3"> 3 per page</span></li>
                                                <li><span data-number="5"> 5 per page</span></li>
                                                <li><span data-number="10" data-default="true"> 10 per page</span></li>
                                                <li><span data-number="all"> view all</span></li>
                                            </ul>
                                        </div>
                                        <div data-control-type="drop-down" data-control-name="sort" data-control-action="sort" data-datetime-format="{month}/{day}/{year}" class="jplist-drop-down form-control">
                                            <ul class="dropdown-menu">
                                                <li><span data-path="default">Sort by</span></li>
                                                <li><span data-path=".title" data-order="asc" data-type="text">Title A-Z</span></li>
                                                <li><span data-path=".title" data-order="desc" data-type="text">Title Z-A</span></li>
                                                <li><span data-path=".desc" data-order="asc" data-type="text">Description A-Z</span></li>
                                                <li><span data-path=".desc" data-order="desc" data-type="text">Description Z-A</span></li>
                                                <li><span data-path=".like" data-order="asc" data-type="number" data-default="true">Likes asc</span></li>
                                                <li><span data-path=".like" data-order="desc" data-type="number">Likes desc</span></li>
                                                <li><span data-path=".date" data-order="asc" data-type="datetime">Date asc</span></li>
                                                <li><span data-path=".date" data-order="desc" data-type="datetime">Date desc</span></li>
                                            </ul>
                                        </div>
                                        <div class="text-filter-box">
                                            <div class="input-group"><span class="input-group-addon"><i class="fa fa-search"></i></span><input data-path=".title" type="text" value="" placeholder="Filter by Position" data-control-type="textbox" data-control-name="title-filter" data-control-action="filter" class="form-control"/></div>
                                        </div>
                                        <div class="text-filter-box">
                                            <div class="input-group"><span class="input-group-addon"><i class="fa fa-search"></i></span><input data-path=".desc" type="text" value="" placeholder="Filter by Category" data-control-type="textbox" data-control-name="desc-filter" data-control-action="filter" class="form-control"/></div>
                                        </div>
                                        <div data-type="Page {current} of {pages}" data-control-type="pagination-info" data-control-name="paging" data-control-action="paging" class="jplist-label btn btn-default"></div>
                                        <div data-control-type="pagination" data-control-name="paging" data-control-action="paging" class="jplist-pagination"></div>
                                    </div> -->
                                    <?php if(count($candidates) > 0): ?>
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
                                                <tbody>
                                                    <?php foreach ($candidates as $key => $candidate) : ?>
                                                        <tr class="tbl-item"><!--<img/>-->
                                                            <td class="img col-md-2 col-sm-2"><img width="120" class="img-responsive pro-img lazy" data-original="<?=(!empty($candidate->profile_pic_name)) ? base_url().'uploads/candidate_profiles/'.$candidate->profile_pic_name : base_url().'assets/portal/images/avatar.png'?>">   </td>
                                                            <!--<data></data>-->
                                                            <td class="td-block">
                                                                <p class="title"><?=ucwords(strtolower($candidate->first_name.' '.$candidate->last_name))?></p>
                                                                <?php if(isset($candidate->career_level)): ?>
                                                                    <h6 style="margin-top:0px;margin-bottom:4px;"> 
                                                                            <?=isset($candidate->career_level) ? $candidate->career_level.', ':''?>
                                                                            <?=isset($candidate->department) ? $candidate->department :''?>
                                                                    </h6>   
                                                                <?php endif; ?>
                                                                <?=isset($candidate->email) ? '<a href="#">'.$candidate->email.'</a>':''?>
                                                                <p class="desc"><?php if(!empty($candidate->about_you)):?><?=limit_words($candidate->about_you,60)?><?php endif; ?></p>
                                                            </td>
                                                            <td class="td-block">
                                                                <a href="<?=base_url()?>employer/view_candidate/<?=$candidate->candidate_profile_id?>" target="_blank">View Profile</a>
                                                            </td>
                                                        </tr>
                                                    <?php endforeach; ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    <?php else: ?>
                                        <div class="alert alert-info" role="alert"> No Candidates matching your search criteria!</div>
                                    <?php endif; ?>

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
<script type="text/javascript" src="//cdn.datatables.net/1.10.10/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.10/js/dataTables.bootstrap.min.js"></script>
<script type="text/javascript" src="http://www.appelsiini.net/projects/lazyload/jquery.lazyload.js?v=1.9.1"></script>

<script type="text/javascript">
$(document).ready(function() {
    $('#example,#candidate_search_list').DataTable();
    $("img.lazy").lazyload();

    $(document).on('click','.paginate_button a',function() {
        $("img.lazy").lazyload();
    })
});
</script>