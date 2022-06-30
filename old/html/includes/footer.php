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
                    <li><a href="https://www.facebook.com/annexisbusinesssolutions?ref=hl"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                    <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                    <li><a href="#"><i class="fa fa-skype" aria-hidden="true"></i></a></li>
                    <li><a href="#"><i class="fa fa-youtube" aria-hidden="true"></i></a></li>
                    <li><a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
                    <li><a href="#"><i class="fa fa-pinterest-p" aria-hidden="true"></i></a></li>
                </ul>
            </div>
            <div class="col-md-5 social-icons ftr-bt">
                <h3><b>ADDITIONAL LINKS</b></h3>
                <ul>
                    <li><a href="#"><b>Get Started</b></a></li>
                    <li><a href="login.php"><b>Log-in</b></a></li>
                    <li><a href="#"><b>FAQ</b></a></li>
                    
                </ul>
                <ul>
                    <li><a href="#"><b>Pricing</b></a></li>
                    <li><a href="#"><b>About</b></a></li>
                    <li><a href="#"><b>Newsletters</b></a></li>
                </ul>
            </div>
            <div class="col-md-4 social-icons ftr-bt">
                <h3><b>GENERAL INQUIRY<b></h3>
                <ul>
                    <li><i class="fa fa-map-marker" aria-hidden="true"></i> 110 SE 6th Street, Suite 1700
                        Ft. Lauderdale, Florida . 33301
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