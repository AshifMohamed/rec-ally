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
                                                <div class="col-md-3 col-sm-3 text-center">
                                                    <img class="img-responsive" src="<?=!empty($profile->company_logo)? base_url().'uploads/company_logos/'.$profile->company_logo: base_url().'assets/portal/images/clogo.jpg'?>">
                                                </div>
                                                <div class="col-md-6 col-sm-6 section-content">
                                                    <h4><span id="cn_company_name"><?=isset($profile->name)?$profile->name:''?></h4>
                                                    <p><b>Address : </b> <?=!empty($address) ? '<span id="cn_building_no">'.$address->building_no.'</span>, <span id="cn_building_name">'.$address->building_name.'</span>, <span id="cn_street">'.$address->street.'</span>,  <span id="cn_city">'.$address->city.'</span>, <span id="cn_country">'.$address->country.'</span>' : ''?></p>
                                                    <p><b>Mobile : </b> <span id="cn_mobile"><?=isset($contact->mobile) ? $contact->mobile :'' ?></span></p>
                                                    <p><b>Website :</b> <a target="_blank" href="<?=isset($contact->website)?prep_url($contact->website):'#';?>"><span id="cn_website"><?=isset($contact->website) ? $contact->website :'' ?></span></a></p>
                                                    <p><b>Email : </b> <span id="cn_email"><?=isset($contact->email) ? $contact->email : '' ?></p>
                                                </div>                                                  
                                                <div class="edit-delete pull-right">
                                                    <ul><li><button class="edit-btn edit-basic-company-info" type="submit"><i class="fa fa-pencil-square-o"></i> Edit</button></li></ul>
                                                </div>
                                            </div>                                                      
                                        </div>
                                            <div style="clear:both;"></div>
                                            <form method="POST" id="save_basic_company_info" action="/employer/save_basic_company_info" enctype="multipart/form-data">
                                                <input id="company_profile_id" name="company_profile_id" value="<?=isset($profile->company_profile_id) ? $profile->company_profile_id : '0' ?>" type="hidden">
                                                <input name="address_profile_map_id" id="address_profile_map_id" type="hidden" value="<?=!empty($address) ? $address->address_profile_map_id : 0 ?>"/>
                                                <input name="contact_profile_map_id" id="contact_profile_map_id" type="hidden" value="<?=!empty($contact) ? $contact->contact_profile_map_id : 0 ?>"/>
                                                <input name="address_id" id="address_id" type="hidden" value="<?=!empty($address) ? $address->address_id : 0 ?>"/>
                                                <input name="contact_id" id="contact_id" type="hidden" value="<?=!empty($contact) ? $contact->contact_id : 0 ?>"/>
                                               <div class="bottom-slider">
                                                    <div class="col-md-6 col-sm-6 left-padding">
                                                        <div class="form-group">
                                                            <label for="name" class="control-label">
                                                                company name</label>
                                                            <div class="input-icon right">
                                                                <input id="name" name="name" placeholder="" class="form-control" type="text"></div>
                                                        </div>
                                                        <div style="clear:both;"></div>
                                                        <div class="form-group">
                                                            <label for="website" class="control-label">
                                                                Website</label>
                                                            <div class="input-icon right">
                                                                <input id="website" name="website" placeholder="" class="form-control" type="text"></div>
                                                        </div>
                                                        <div style="clear:both;"></div>
                                                                <div class="form-group">
                                                               <div class="input-icon right">
                                                                   <div class="form-group">
                                                                            <label for="building_no" class="control-label">
                                                                        Building No</label>
                                                                            <input id="building_no" name="building_no" placeholder="" class="form-control" type="text">
                                                                    
                                                                    </div>
                                                                     <div class="form-group">
                                                                            <label for="building_name" class="control-label">
                                                                        Building Name</label>
                                                                            <input id="building_name" name="building_name" placeholder="" class="form-control" type="text">
                                                                    
                                                                    </div>  
                                                                     <div class="form-group">
                                                                        <label for="street" class="control-label">
                                                                Street</label>
                                                                    <input id="street" name="street" placeholder="" class="form-control" type="text">
                                                                    </div>
                                                                     <div class="form-group">
                                                                <label for="city" class="control-label">
                                                                City</label>
                                                                    <select name="city" id="city" class="form-control">
                                                                        <option value="0">Please select</option>
                                                                        <?php 
                                                                        foreach ($cities as $key => $city) { ?>
                                                                            <option value="<?=$city->city_id?>"><?=$city->city?></option>
                                                                        <?php } ?>  
                                                                    </select>
                                                                    </div>
                                                                     <div class="form-group">
                                                                <label for="country" class="control-label">
                                                                Country</label>
                                                                        <select name="country" id="country" class="form-control">
                                                                            <option value="0">Please select</option>
                                                                            <?php 
                                                                            foreach ($countries as $key => $country) { ?>
                                                                                <option value="<?=$country->country_id?>"><?=$country->country?></option>
                                                                            <?php } ?>  
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                    </div>
                                                    <div class="col-md-6 col-sm-6 left-padding">
                                                        
                                                        <div style="clear:both;"></div>
                                                        <div class="form-group">
                                                            <label for="mobile" class="control-label">
                                                                Phone Number</label>
                                                            <div class="input-size">
                                                                        <input id="country_code" name="country_code" placeholder="" class="form-control" type="text">
                                                                        <input id="mobile" name="mobile" placeholder="" class="form-control  col-md-6 col-sm-6" type="text">
                                                            </div>                                                          
                                                        <div style="clear:both;"></div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="email" class="control-label">
                                                                Email Address</label>
                                                            <div class="input-icon right">
                                                                <input id="email" name="email" placeholder="" class="form-control" type="text"></div>
                                                        </div>
                                                        <div style="clear:both;"></div>
                                                        <div class="form-group">
                                                            <label for="inputSubject" class="control-label">
                                                                Company Logo</label>
                                                            <div class="form-group">
                                                            <input id="company_logo" name="company_logo" placeholder="Inlcude some file" type="file"></div>
                                                        </div>
                                                        <div style="clear:both;"></div>
                                                    </div>
                                                     <div style="clear:both;"></div>
                                                    <div class="form-group pull-right">
                                                            <label class="control-label col-md-2 col-sm-2 col-xs-12"></label>
                                                            <button class="info-save btn btn-info ">Save</button>&nbsp
                                                            <button class="btn btn-danger cancel-btn" type="button">Cancel</button>
                                                    </div>
                                                </div>
                                            </form>
                                    </div>
                                </div>
                                <!-- divider -->
                                <div class="panel">
                                    <div class="panel-body">
                                        <div class="row">
                                           <div class="col-md-12 col-sm-12">
                                                <div class="col-md-8 col-sm-8 left-padding section-content">
                                                    <h3>Representative</h3>
                                                    <p><b>Name : </b><span id="cn_name"><?=isset($representative->name)?$representative->name:''?></span></p>
                                                    <p><b>Position : </b> <span id="cn_position"> <?=isset($representative->position)?$representative->position:''?></span></p>
                                                    <p><b>Email : </b> <span id="cn_email"> <?=isset($representative->email)?$representative->email:''?></span></p>
                                                    <p><b>Mobile : </b> <span id="cn_mobile"><?=isset($representative->mobile)?$representative->mobile:''?></span></p>
                                                    <p><b>Skype : </b> <span id="cn_skype"><?=isset($representative->skype)?$representative->skype:''?></span></p>
                                                </div>                                                  
                                                <div class="edit-delete text-right pull-right">
                                                    <ul>
                                                        <li>
                                                            <button class="edit-btn edit-representative-info" type="submit"><i class="fa fa-pencil-square-o"></i> Edit</button>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>                                                      
                                        </div>
                                            <div style="clear:both;"></div>
                                                <form method="POST" id="representative_info" action="/employer/save_representative">
                                                    <input id="company_profile_id" name="company_profile_id" value="<?=isset($profile->company_profile_id) ? $profile->company_profile_id : '0' ?>" type="hidden">
                                                    <input id="company_representative_id" value="<?=isset($representative->company_representative_id)?$representative->company_representative_id:'0'?>" type="hidden" name="company_representative_id">
                                                    <div class="bottom-slider">
                                                        <div class="col-md-8 col-sm-8 left-padding">
                                                            <div class="form-group">
                                                                <label for="inputSubject" class="control-label">
                                                                    Contact name</label>
                                                                <div class="input-icon right">
                                                                    <input id="name" type="text" name="name" placeholder="" class="form-control">
                                                                </div>
                                                            </div>
                                                            <div style="clear:both;"></div>
                                                            <div class="form-group">
                                                                <label for="inputSubject" class="control-label">
                                                                    Contact Position </label>
                                                                <div class="input-icon right">
                                                                    <input id="position" type="text" name="position" placeholder="" class="form-control">
                                                                </div>
                                                            </div>
                                                            <div style="clear:both;"></div>
                                                            <div class="form-group">
                                                                <label for="inputSubject" class="control-label">
                                                                    Email address </label>
                                                                <div class="input-icon right">
                                                                    <input id="email" type="text" name="email" placeholder="" class="form-control">
                                                                </div>
                                                            </div>
                                                            <div style="clear:both;"></div>
                                                            <div class="form-group">
                                                                <label for="inputSubject" class="control-label">
                                                                    Mobile </label>
                                                                <div class="input-icon right">
                                                                    <input id="mobile" type="text" name="mobile" placeholder="" class="form-control">
                                                                </div>
                                                            </div>
                                                            <div style="clear:both;"></div>
                                                            <div class="form-group">
                                                                <label for="inputSubject" class="control-label">
                                                                    Skype account</label>
                                                                <div class="input-icon right">
                                                                    <input id="skype" type="text" name="skype" placeholder="" class="form-control">
                                                                </div>
                                                            </div>
                                                            <div style="clear:both;"></div>
                                                        </div>
                                                        <div style="clear:both;"></div>
                                                         <div class="form-group pull-right">
                                                                    <label class="control-label col-md-2 col-sm-2 col-xs-12"></label>
                                                                    <button class="info-save  btn btn-info save-company-info" id="btn_save_representative" name="btn_save_representative">Save</button>&nbsp
                                                                    <button class="btn btn-danger cancel-btn" type="button">Cancel</button>
                                                         </div>
                                                    </div>

                                                </form>
                                    </div>
                                </div>
                                <!-- divider -->
                                <div class="panel">
                                    <div class="panel-body">
                                        <div class="row">
                                           <div class="col-md-12 col-sm-12">
                                                <div class="col-md-8 col-sm-8 left-padding section-content">
                                                    <h3>Company Info</h3>
                                                    <p><b>Owner : </b> <span id="cn_owner"><?=isset($profile->owner)?$profile->owner:''?></span></p>
                                                    <p><b>Company Type : </b> <span id="cn_type"><?=isset($profile->type)?$profile->type:''?></span></p>
                                                    <p><b>Company License : </b> <span id="cn_license_no"><?=!empty($profile->license_no)?$profile->license_no:''?></span></p>
                                                    <p><b>Total Number of employees : </b> <span id="cn_employee_range"> <?=isset($profile->employee_range)?$profile->employee_range:''?></span></p>
                                                    <p><b>Industry type : </b> <span><?php $value=''; foreach ($industry_collection as $key => $industry){ $value.=$industry->industry.', '?>
                                                                                    <?php } print remove_trailing_commas($value); ?></span></p>
                                                    
                                                </div>                                                  
                                                <div class="edit-delete text-right pull-right">
                                                    <ul>
                                                        <li>
                                                            <button class="edit-btn edit-company-registration-info" type="submit"><i class="fa fa-pencil-square-o"></i> Edit</button>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>                                                      
                                        </div>
                                            <div style="clear:both;"></div>
                                            <form method="POST" id="company_registration_info" action="/employer/save_company_registration_info">
                                                <input id="company_profile_id" name="company_profile_id" value="<?=isset($profile->company_profile_id) ? $profile->company_profile_id : '0' ?>" type="hidden">
                                                <div class="bottom-slider">
                                                    <div class="col-md-8 col-sm-8 left-padding">
                                                        <div class="form-group">
                                                            <label for="owner" class="control-label">
                                                                Owner name</label>
                                                            <div class="input-icon right">
                                                                <input id="owner" type="text" name="owner" placeholder="" class="form-control">
                                                            </div>
                                                        </div>
                                                        <div style="clear:both;"></div>
                                                        <div class="form-group">
                                                            <label for="company_type" class="control-label">
                                                                Company type</label>
                                                            <div class="input-icon right">
                                                              <select class="form-control" id="company_type" name="company_type">
                                                                     <?php 
                                                                    foreach ($company_types as $key => $company_type) { ?>
                                                                        <option value="<?=$company_type->company_type_id?>" <?=$profile->company_type_id==$company_type->company_type_id? 'selected' : ''?>><?=$company_type->type?></option>
                                                                    <?php } ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div style="clear:both;"></div>
                                                        <div class="form-group">
                                                            <label for="license_no" class="control-label">
                                                                License number</label>
                                                            <div class="input-icon right">
                                                                <input id="license_no" type="text" name="license_no" placeholder="" class="form-control"></div>
                                                        </div>
                                                        <div style="clear:both;"></div>
                                                            <div class="form-group">
                                                            <label for="employee_range" class="control-label">
                                                                Total Number of employees</label>
                                                            <div class="input-icon right">
                                                              <select class="form-control" id="employee_range" name="employee_range">
                                                                     <?php 
                                                                    foreach ($employee_ranges as $key => $employee_range) { ?>
                                                                        <option value="<?=$employee_range->employee_range_id?>" value="<?=$employee_range->employee_range_id?>" <?=$profile->employee_range_id==$employee_range->employee_range_id? 'selected' : ''?>><?=$employee_range->employee_range?></option>
                                                                    <?php } ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div style="clear:both;"></div>
                                                            <div class="form-group">
                                                            <label for="industry" class="control-label">
                                                                What are the industries of the company</label>
                                                            <div class="input-icon right">
                                                                 <?php 
                                                                    foreach ($industries as $key => $industry) { ?>
                                                                         <input type="checkbox" id="industry" name="industry[]" value="<?=$industry->industry_id?>" <?=in_array($industry->industry_id, $selected_industries) ? 'checked ' :''?>> <span><?=$industry->industry?></span><br>
                                                                    <?php } ?>
                                                            </div>
                                                        <div style="clear:both;"></div>
                                                        </div>
                                                    </div>
                                                     <div style="clear:both;"></div>
                                                        <div class="form-group pull-right">
                                                                <label class="control-label col-md-2 col-sm-2 col-xs-12"></label>
                                                                <button class="info-save  btn btn-info save-company-info" id="btn_save_company_registration_info" name="btn_save_company_registration_info">Save</button>&nbsp
                                                                    <button class="btn btn-danger cancel-btn" type="button">Cancel</button>

                                                        </div>
                                                </div>
                                            </form>
                                    </div>
                                </div>
                                <!-- divider -->
								   <div class="panel">
                                    <div class="panel-body">
                                        <div class="row">
                                           <div class="col-md-12 col-sm-12">
												<div class="col-md-8 col-sm-8 left-padding section-content">
													<h3>About Company</h3>
													<h5>What you want to tell us about the company</h5>
													<p class="cn_about_company"><?=!empty($profile->about_company)? $profile->about_company :'' ?></p>
												</div>													
												<div class="edit-delete text-right pull-right">
													<ul>
														<li>
															<button class="edit-btn edit-about-company-info" type="submit"><i class="fa fa-pencil-square-o"></i> Edit</button>
														</li>
													</ul>
												</div>
											</div>														
                                        </div>
											<div style="clear:both;"></div>
											<form method="POST" id="about_you_form" name="about_you_form" action="/employer/save_about_company_info">
												<div class="bottom-slider">
													<div class="col-md-8 col-sm-8 left-padding">
														<div class="form-group">
															<label for="about_company" class="control-label">
																What you want to tell about you</label>
															<div class="input-icon right">
																<textarea id="about_company" name="about_company" class="form-control"></textarea>
															</div>
														</div>
														<div style="clear:both;"></div>
													</div>
													<div style="clear:both;"></div>
													<div class="form-group pull-right">
															<label class="control-label col-md-2 col-sm-2 col-xs-12"></label>
															<button class="info-save btn btn-info save-company-info" id="btn_save_about_company">Save</button>&nbsp
                                                            <button class="btn btn-danger cancel-btn" type="button">Cancel</button>
													</div>
												</div>
											</form>
                                    </div>
                                </div>
                            </div>
                            <?php $this->load->view('/partial/portal_candidate_search'); ?>
                        </div>
                      </div>
                    </div>
                <!--END CONTENT-->
<?php $this->load->view('partial/portal_footer.php'); ?>
