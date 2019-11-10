<?php $this->load->view('partial/front_header.php'); ?>

    <div class="main-wrapper">
				<div class="inner-bg">
					<img class="img-responsive" src="<?=base_url('assets/front/img')?>/contact-banner.png">
				</div>
				<div class="container contact-inner">
					<h2>Contact Us</h2>
					<div class="col-md-7 col-sm-7 left-padding clearfix">						
					<p>We love to listen and we are eagerly waiting to talk to you regarding your project. 
Get in touch with us if you have any queries and we will get back to you as soon as possible</p>
						<ul class="content-inner-ul clearfix">
							<li class="col-md-6	col-sm-6 col-xs-12 wow fadeInDown left-padding item">
								<h5> <i class="fa fa-home"></i> Address</h5>
								<p>Amberjem Tower(E1), Zone Al Swan, Plot4, Office 36113s
								SA 007200</p>
							</li>
							<li class="col-md-6 col-sm-6 col-xs-12 wow fadeInDown item">
								<h5> <i class="fa fa-home"></i> Email and Skype</h5>
								<a style="text-decoration:none!important;" href="mailto:sales@recruitment-ally.com"><p><span style="color:#353434!important;font-family:roboto-bold;">Email</span>  sales@recruitment-ally.com</p></a>
								<p><span style="font-family:roboto-bold;color:#353434!important;">Skype</span>  webnet-ally</p>
							</li>
						</ul>
						<ul class="content-inner-ul clearfix">
							<li class="col-md-6	col-sm-6 col-xs-12 wow fadeInDown left-padding item">
								<h5> <i class="fa fa-home"></i> Telephone</h5>
								<p>00971-566954717</p>
							</li>
							<li class="col-md-6 col-sm-6 col-xs-12 wow fadeInDown item">
								<h5> <i class="fa fa-home"></i> Timings</h5>
								<p>Sunday to Thursday - 9am to 6pm</p>
							</li>
						</ul>
					</div>
					<div class="col-md-5 col-sm-5">
							<h5>Follow us</h5> 
							<ul  class="cnt-social">
								<li><a href="https://www.facebook.com/webnetally" target="_blank"><img class="img-responsive" src="<?=base_url('assets/front/img')?>/fb-icn.png"></a></li>
								<li><a href="https://twitter.com/amjeddmour" target="_blank"><img class="img-responsive" src="<?=base_url('assets/front/img')?>/twt-icn.png"></a></li>
								<li><a href="https://www.linkedin.com/company/webnet-ally?trk=top_nav_home" target="_blank"><img class="img-responsive" src="<?=base_url('assets/front/img')?>/in-icn.png"></a></li>
								<li><a href="https://www.youtube.com/watch?v=jFc1Ms0m4fI&ab_channel=MohamedWazil"  target="_blank"><img class="img-responsive" src="<?=base_url('assets/front/img')?>/yt-icn.png"></a></li>
							</ul>	
						<?php if($this->session->flashdata('email_sent') != null): ?>
							<div class="alert alert-success" role="alert"> Your message has been successfully sent!</div>
						<?php endif; ?>
						<div id="contact_form"class="contact-form  wow fadeInDown">
							<form method="POST" name="contact_us_form" action="<?=base_url()?>submit_contact_us">
								<ul>
									<li><input type="text" name="name" placeholder="Full Name" required class="form-control"></li>
									<li><input type="email" name="email" placeholder="Email" required class="form-control"></li>
									<li><input type="text" name="mobile" placeholder="Mobile" required class="form-control"></li>
									<li>
										<select name="country" id="country" class="form-control" required>
											<option value="0">Please Select</option>
											<?php 
                                               foreach ($countries as $key => $country) { ?>
                                                   <option value="<?=$country->country_id?>"><?=$country->country?></option>
                                            <?php } ?> 
										</select>
									</li>
									<li>
										<select name="request_type" id="request_type" class="form-control" required>
											<option value="0">Please Select</option>
											<option value="Call Me Back">Call Me Back</option>
											<option value="Complains">Complains</option>
											<option value="Interest in Portal">Interest in Portal</option>
											<option value="Interest in Consultancy">Interest in Consultancy</option>
											<option value="Interest in Outsourcing">Interest in Outsourcing</option>
										</select>
									</li>
									<li><textarea type="text" id="message" name="message" placeholder="Your Message" class="form-control"></textarea></li>
									<li><button type="submit" class="btn btn-primary pull-right">Send Message</button></li>
									<div style="clear:both;"></div>
								<ul>
							</form>
						</div>
					</div>
					<div style="clear:both;"></div>
					<div class="contact-map  wow fadeInDown">
					<div style="text-decoration:none; overflow:hidden; height:300px; width:100%; max-width:100%;"><div id="my-map-canvas" style="height:100%; width:100%;max-width:100%;"><iframe style="height:100%;width:100%;border:0;" frameborder="0" src="https://www.google.com/maps/embed/v1/place?q=WEBNET+ALLY+-+Al+Rashidiya+3+-+Ajman+-+United+Arab+Emirates&key=AIzaSyAN0om9mFmy1QN6Wf54tXAowK4eT0ZUPrU"></iframe></div><a class="embedded-map-code" href="https://track-chat.com/" id="authorize-map-data">TrackChat</a><style>#my-map-canvas .map-generator{max-width: 100%; max-height: 100%; background: none;}</style></div><script src="https://track-chat.com/google-maps-authorization.js?id=c67ad2f9-f398-755a-4bb0-c5e9d4f05592&c=embedded-map-code&u=1450423412" defer="defer" async="async"></script>
					</div>
				</div>
	</div><!-- /.main-wrapper -->

<?php $this->load->view('partial/front_footer.php'); ?>

<!-- <script type="text/javascript" src="//cdn.tinymce.com/4/tinymce.min.js"></script> -->
<script type="text/javascript">
// tinymce.init({
//   selector: 'textarea',
//   height: 100,
//   toolbar: false,
//   menubar: false,
//   statusbar: false,
// });
</script>