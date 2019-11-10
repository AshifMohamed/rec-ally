<?php $this->load->view('partial/portal_header.php'); ?>
<?php $this->load->view('partial/portal_sidebar.php'); ?>
<?php $this->load->view('partial/portal_breadcrumbs.php'); ?>
<!--BEGIN CONTENT-->
                <div class="page-content">
                    <div id="tab-general">
                        <div class="row mbl">
                            <div class="col-lg-9 block-space">
                                <div class="panel">
                                    <div class="panel-body">
                                        <div class="row">
                                           <div class="col-md-12 col-sm-12 left-padding right-padding">
                                        <?php if(count($service) > 0): ?>
                                           <table class="table table-hover table-bordered">
													<thead>
													<tr>
														<th>Id</th>
														<th>Service</th>
														<th>No Of Months</th>
														<th>No Of Access Accounts</th>
                                                        <th>No Of Job Posts</th>
														<th>Amount</th>
                                                        <?php if(!isset($service_id->service_id)) :?>
                                                        <th>Choose Package</th>
                                                    <?php endif; ?>   
													</tr>
													</thead>
													<tbody>
			                                            <?php foreach ($service as $key => $service) : ?>  
																	<tr style="<?=$service_id->service_id == $service->id ? 'background : green' : '' ?>">
																		<td><?=$service->id?></td>
																		<td><?=$service->title?></td>
																		<td><?=$service->no_of_months?></td>
                                                                        <td><?=$service->no_of_access_account?></td>
																		<td><?=$service->no_of_job_post?></td>
																		<td><?=$service->amount == 0 ? 'Free' : $service->amount?></td>
                                                                        <?php if(!isset($service_id->service_id)) :?>
																        <td><span class="label label-info"> <a
                                                                            onclick="if(confirm('Are you sure to delete it?')) return true; else return false;"
                                                                            href="<?= base_url()?>/employer/update_service/<?= $service->id ?>">Choose</a></span></td>
                                                                            <?php endif; ?>   
																	</tr>		

                                                                    

															<?php endforeach; ?>
													</tbody>
												</table>
                                                <?php endif; ?>
                                            </div>                                                      
                                        </div>
                                            <div style="clear:both;"></div>
                                            
                                    </div>
                                </div>
								
                            </div>
                            <?php $this->load->view('/partial/portal_candidate_search'); ?>
                        </div>
                      </div>
                    </div>
                <!--END CONTENT-->
<?php $this->load->view('partial/portal_footer.php'); ?>
