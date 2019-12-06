 <div class="col-lg-3">
                                        <div class="panel panel-green">
                                            <div class="panel-heading">
                                                Search Candidate</div>
                                            <div class="panel-body pan">
                                                <form action="<?=base_url()?>employer/search_candidate" method="GET">
                                                <div class="form-body pal">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <label for="inputName" class="control-label">
                                                                            Keyword</label>
                                                                            <div class="input-icon right">
                                                                                <i class="fa fa-search"></i>
                                                                                <input id="keyword_s" name="keyword_s" type="text" placeholder="Keyword" class="form-control" /></div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-12">
                                                                            <div class="form-group">
                                                                                <select class="form-control" name="industry_s" id="industry_s">
                                                                                    <option value="">Please select</option>
                                                                                    <?php 
                                                                                    foreach (get_industries_list() as $key => $industry) { ?>
                                                                                        <option value="<?=$industry->industry_id?>"><?=$industry->industry?></option>
                                                                                    <?php } ?> 
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-12">
                                                                            <div class="form-group">
                                                                                 <select class="form-control" name="country_s" id="country_s">
                                                                                        <option value="">Please select</option>
                                                                                        <?php 
                                                                                        foreach (get_countries_list() as $key => $country) { ?>
                                                                                            <option value="<?=$country->country_id?>"><?=$country->country?></option>
                                                                                        <?php } ?>  
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-12">
                                                                            <div class="form-group">
                                                                                <select class="form-control" name="experience_level_s" id="experience_level_s">
                                                                                   <option value="">Please select..</option>
                                                                                    <?php foreach (get_experince_list() as $key => $level) {?>
                                                                                        <option value="<?=$level->experience_level_id?>"><?=$level->level?></option>
                                                                                    <?php } ?>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-actions text-right pal">
                                                    <button class="btn btn-blue" type="submit">
                                                        Search</button>
                                                </div>
                                                </form>
                                            </div>
                                        </div>
                                        <div class="panel panel-green">
                                            <img src="<?=base_url()?>assets/portal/images/jobs.jpg" class="img-responsive">
                                        </div>
                            </div>