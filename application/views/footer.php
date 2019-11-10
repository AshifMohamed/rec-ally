<!-- Site footer -->
    <footer class="site-footer">

      <!-- Top section -->
      <div class="container">
        <div class="row">
          <div class="col-sm-12 col-md-6">
            <h6>About</h6>
            <p>An employment website is a web site that deals specifically with employment or careers. Many employment websites are designed to allow employers to post job requirements for a position to be filled and are commonly known as job boards. Other employment sites offer employer reviews, career and job-search advice, and describe different job descriptions or employers. Through a job website a prospective employee can locate and fill out a job application.</p>
          </div>

          <div class="col-xs-6 col-md-3">
            <h6>Company</h6>
            <ul class="footer-links">
              <li><a href="<?=base_url()?>">Home</a></li>
              <li><a href="<?=base_url()?>about_us">About us</a></li>
              <li><a href="<?=base_url()?>terms_conditions">Terms &amp; Conditions</a></li>
              <li><a href="<?=base_url()?>privacy_policy">Privacy policy</a></li>
              <li><a href="<?=base_url()?>contact_us">Contact us</a></li>
            </ul>
          </div>

          <div class="col-xs-6 col-md-3">
            <h6>Trending jobs</h6>
            <ul class="footer-links">
              <li><a href="#">Front-end developer</a></li>
              <li><a href="#">Android developer</a></li>
              <li><a href="#">iOS developer</a></li>
              <li><a href="#">Full stack developer</a></li>
              <li><a href="#">Project administrator</a></li>
            </ul>
          </div>
        </div>

        <hr>
      </div>
      <!-- END Top section -->

      <!-- Bottom section -->
      <div class="container">
        <div class="row">
          <div class="col-md-8 col-sm-6 col-xs-12">
            <p class="copyright-text">Copyrights &copy; <?php echo date('Y'); ?> All Rights Reserved by <a href="<?=base_url()?>">Recruitment Ally</a>.</p>
          </div>

          <div class="col-md-4 col-sm-6 col-xs-12">
            <ul class="social-icons">
              <li><a class="facebook" href="https://www.facebook.com/webnetally/"><i class="fa fa-facebook"></i></a></li>
              <li><a class="twitter" href="https://twitter.com/amjeddmour"><i class="fa fa-twitter"></i></a></li>
              <li><a class="linkedin" href="https://www.linkedin.com/company/webnet-ally?trk=top_nav_home"><i class="fa fa-linkedin"></i></a></li>
              <!-- <li><a class="instagram" href="#"><i class="fa fa-instagram"></i></a></li> -->
            </ul>
          </div>
        </div>
      </div>
      <!-- END Bottom section -->

    </footer>
    <!-- END Site footer -->


    <!-- Back to top button -->
    <a id="scroll-up" href="#"><i class="ti-angle-up"></i></a>
    <!-- END Back to top button -->

    <!-- Scripts -->
    <script src="<?php echo base_url(); ?>assets/js/app.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/custom.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/owl.carousel.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/script.js" defer="defer"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.ezmark.js"></script>

    <script src="<?=base_url();?>assets/portal/script/jquery.flot.js"></script>
<script src="<?=base_url();?>assets/portal/script/jquery.flot.pie.js"></script>
<script src="<?=base_url();?>assets/portal/script/jquery.flot.stack.js"></script>
<script src="<?=base_url();?>assets/portal/script/jquery.flot.spline.js"></script>
<script src="<?=base_url();?>assets/portal/script/jquery.flot.categories.js"></script>

  </body>
<script>
  $(document).ready(function() {
    var owl = $('.owl-carousel');
    owl.owlCarousel({
      margin: 10,
      nav: true,
      loop: true,
      responsive: {
        0: {
          items: 1
        },
        600: {
          items: 3
        },
        1000: {
          items: 3
        }
      }
    })
  })
</script>
</html>