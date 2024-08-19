<footer id="footer" class="footer position-relative">

    <div class="container footer-top">
      <div class="row gy-4">
        <div class="col-lg-4 col-md-6 footer-about">
          <a href="https://repair.digitalisasi.net/" class="logo d-flex align-items-center">
            <span class="sitename text-secondary">Digital Repair</span>
          </a>
          <div class="footer-contact pt-3">
            <p>Jl. Tukad Pancoran IV block A4 no 12B</p>
            <p>Denpasar - Bali</p>
            <p class="mt-3"><strong>Phone:</strong> <span>+62 898 0000 703</span></p>
            <p><strong>Email:</strong> <span>repair@digitalisasi.net</span></p>
          </div>
          <div class="d-none social-links d-flex mt-4">
            <a href=""><i class="bi bi-twitter-x"></i></a>
            <a href=""><i class="bi bi-facebook"></i></a>
            <a href=""><i class="bi bi-instagram"></i></a>
            <a href=""><i class="bi bi-linkedin"></i></a>
          </div>
        </div>

        <div class="col-lg-2 col-md-3 footer-links">
          <h4>Useful Links</h4>
          <ul>
            <li><a href="<?= $page[1]; ?>#hero">Home</a></li>
            <li><a href="<?= $page[1]; ?>#about">About us</a></li>
            <li><a href="<?= $page[1]; ?>#services">Services</a></li>
            <li><a href="<?= $page[1]; ?>#">Terms of service</a></li>
            <li><a href="<?= $page[1]; ?>#">Privacy policy</a></li>
          </ul>
        </div>

        <div class="col-lg-2 col-md-3 footer-links">
          <h4>Our Services</h4>
          <ul>
            <li><a href="javascript:void(0)">Product Repair</a></li>
            <li><a href="javascript:void(0)">Product maintenance</a></li>
            <li><a href="javascript:void(0)">Web Development</a></li>
            <li><a href="javascript:void(0)">Network troubleshooter</a></li>
            <li><a href="javascript:void(0)">Consultation</a></li>
          </ul>
        </div>

        <div class="col-lg-4 col-md-12 footer-newsletter">
          <h4>Our Newsletter</h4>
          <p>Subscribe to our newsletter and receive the latest news about our products and services!</p>
          <form action="forms/newsletter.php" method="post" class="php-email-form">
            <div class="newsletter-form"><input type="email" name="email"><input type="submit" value="Subscribe" disabled></div>
            <div class="loading">Loading</div>
            <div class="error-message"></div>
            <div class="sent-message">Your subscription request has been sent. Thank you!</div>
          </form>
        </div>

      </div>
    </div>

    <div class="container copyright text-center mt-4">
      <p>© <span>Copyright</span> <strong class="px-1 sitename text-secondary">Digital Repair</strong><span>All Rights Reserved</span></p>
      <div class="credits">
        Designed by <a href="https://digitalisasi.net/">Digitalisasi.net</a>
      </div>
    </div>

  </footer>