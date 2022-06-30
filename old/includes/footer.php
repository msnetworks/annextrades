<?php
    if ($logo == "") {
        $logo = "logo.png";
    } else {
        if (file_exists("images/" . $logo)) {
            $logo = $logo;
        } else {
            $logo = "logo.png";
        }
    }
?>
<footer>
    <div class="container">
        <div class="row">
            <div class="col-md-3 social-icons">
                <a class="navbar-brand logo" href="index.php"><img src="assets/images/logo.png" alt="logo"></a>
                <ul>
                    <li><a target="_blank" href="https://www.facebook.com/Annexis.net"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                    <li><a target="_blank" href="https://twitter.com/AnnexisBusiness?s=09"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                    <!-- <li><a target="_blank" href="#"><i class="fa fa-skype" aria-hidden="true"></i></a></li> -->
                    <li><a target="_blank" href="https://www.youtube.com/channel/UCepBlxUFpaYBtHRCYTLTZGw"><i class="fa fa-youtube" aria-hidden="true"></i></a></li>
                    <li><a target="_blank" href="https://instagram.com/annexisbusinesssolutions?igshid=y20vdk20hf30"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
                    <li><a target="_blank" href="https://www.linkedin.com/company/annexis-business-solutions"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
                </ul>
            </div>
            <div class="col-md-5 social-icons ftr-bt">
                <h3>ADDITIONAL LINKS</h3>
                <ul>
                    <li><a href="https://annexis.net/registration/?source=Annextrades&package=BusinessPortal">Get Started</a></li>
                    <li><a href="login.php">Log-in</a></li>
                    <li><a href="faq_contactus.php">FAQ</a></li>
                </ul>
                
                <ul>
                    <li><a href="https://www.annexis.net/pricing-packages/">Pricing</a></li>
                    <li><a href="http://www.annexis.net/about-annexis/" target="_blank">About</a></li>
                    <li><a href="privacy_policy.php" target="_blank">Privacy Policy</a></li>
                    <li><a href="terms_of_use.php" target="_blank">Terms & Condition</a></li>
                    <!-- <li><a href="#">Newsletters</a></li> -->
                </ul>
            </div>
            <div class="col-md-4 social-icons ftr-bt">
                <h3>GENERAL INQUIRY</h3>
                <ul>
                    <li><strong>Florida Address: </strong><i class="fa fa-map-marker" aria-hidden="true"></i> 110 SE 6th Street, Suite 1700
                        Ft. Lauderdale, Florida . 33301
                    </li>
                    <li><strong>India Address: </strong><i class="fa fa-map-marker" aria-hidden="true"></i>  17th Floor, Max Towers
                        Sector-16 DND Flyway, Noida 201301
                    </li>
                    <li><i class="fa fa-globe" aria-hidden="true"></i><a href="http://www.annextrades.com/">www.annextrades.com</a></li>
                    <li><i class="fa fa-envelope-o" aria-hidden="true"></i><a href="mailto:info@annextrades.com">info@annextrades.com</a></li>
                    
                    <li><i class="fa fa-phone" aria-hidden="true"></i><a href="tel:+18666142950">1 (888) 614-2950</a></li>
                    <li><i class="fa fa-clock-o" aria-hidden="true"></i>Mon-Sat (9 am - 6 pm, EST)</li>
                </ul>
            </div>
        </div>

    </div>
    <div class="footer-bottom">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <p>Copyright <?= date('Y'); ?> ANNEXTrades. All Rights Reserved.</p>
                </div>
                <div class="col-md-6 text-right">
                    <p>ANNEXIS Your Bridge to Expansion & Increased Market Share</p>
                </div>
            </div>
        </div>
    </div>
</footer>
<a href="javascript: " id="return-to-top"><i class="fa fa-chevron-up "></i></a>
</div>
</body>

</html>