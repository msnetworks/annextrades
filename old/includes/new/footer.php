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
                    <li><i class="fa fa-map-marker" aria-hidden="true"></i> Florida Address: 110 SE 6th Street, Suite 1700
                        Ft. Lauderdale, Florida . 33301
                    </li>
                    <li><i class="fa fa-map-marker" aria-hidden="true"></i> India Address:  17th Floor, Max Towers
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
    <div class="footer-bottom" style="margin-top: 30px;">
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
<script src="assets/js/bootstrap.min.js "></script>
<script src="assets/js/owl.carousel.min.js"></script>
<script src="assets/js/wow.js"></script>

<script type="text/javascript" id="zsiqchat">var $zoho=$zoho || {};$zoho.salesiq = $zoho.salesiq || {widgetcode: "ccc71f7abf6ba42df61c7480021eace46fa3c352e125d11c63d2d3bd75a9a895d98971cb48be2e8ee2912cf02d0355f8", values:{},ready:function(){}};var d=document;s=d.createElement("script");s.type="text/javascript";s.id="zsiqscript";s.defer=true;s.src="https://salesiq.zoho.in/widget";t=d.getElementsByTagName("script")[0];t.parentNode.insertBefore(s,t);</script>

<!-- Start of HubSpot Embed Code --> 
<!-- <script type="text/javascript" id="hs-script-loader" async defer src="//js.hs-scripts.com/5621221.js"></script>  -->
<!-- End of HubSpot Embed Code -->
<script>
    $(document).on('click', '.number-spinner button', function() {
        var btn = $(this),
            oldValue = btn.closest('.number-spinner').find('input').val().trim(),
            newVal = 0;

        if (btn.attr('data-dir') == 'up') {
            newVal = parseInt(oldValue) + 1;
        } else {
            if (oldValue > 1) {
                newVal = parseInt(oldValue) - 1;
            } else {
                newVal = 1;
            }
        }
        btn.closest('.number-spinner').find('input').val(newVal);
    });
    // ===== Scroll to Top ==== 
    $(window).scroll(function() {
        if ($(this).scrollTop() >= 60) { // If page is scrolled more than 50px
            $('#return-to-top').fadeIn(200); // Fade in the arrow
        } else {
            $('#return-to-top').fadeOut(200); // Else fade out the arrow
        }
    });
    $('#return-to-top').click(function() { // When arrow is clicked
        $('body,html').animate({
            scrollTop: 0 // Scroll to top of body
        }, 500);
    });
</script>

<script>
    $(window).scroll(function() {
        var scrl = $(window).scrollTop();
        if (scrl < 50) {
            $('.header').removeClass('fixedbar');
        } else {
            $('.header').addClass('fixedbar');
        }
    });
</script>
<script>
    new WOW().init();
</script>
<script>
    $('#owl-fashion-men').owlCarousel({
        // loop: true,
        // autoplay: false,
        // autoplayTimeout: 3000,
         margin: 15,
        //smartSpeed: 1000, // duration of change of 1 slide
        nav: true,
        items: 1,
        navigation: true,
        responsiveClass: true,
        responsive: {
            0: {
                items: 1,
                nav: true,
                loop: true
            },
            600: {
                items: 1,
                nav: false,
                loop: true
            },
            1000: {
                items: 1,
                nav: true,
                loop: true

            },
            2000: {
                items: 1,
                nav: true,
                loop: true

            }
        }
    })
</script>
<script>
    $('#owl-bannner').owlCarousel({
        loop: true,
        margin: 0,
        autoplay: false,
        autoplay: 4000, // time for slides changes
        smartSpeed: 1000, // duration of change of 1 slide
        nav: true,
        navigation: true,
        responsiveClass: true,
        responsive: {
            0: {
                items: 1,
                nav: true,
                loop: true
            },
            600: {
                items: 1,
                nav: false,
                loop: true
            },
            1000: {
                items: 1,
                nav: true,
                loop: true

            }
        }
    })
</script>


<script>
    $('#top-fashion').owlCarousel({
        loop: true,
        autoplay: false,
        autoplayTimeout: 4000,
        margin: 15,
        smartSpeed: 1000, // duration of change of 1 slide
        nav: true,
        navigation: true,
        responsiveClass: true,
        responsive: {
            0: {
                items: 1,
                nav: true,
                loop: true
            },
            600: {
                items: 2,
                nav: false,
                loop: true
            },
            1000: {
                items: 4,
                nav: true,
                loop: false,
                loop: true
            },
            1400: {
                items: 6,
                nav: true,
                loop: false,
                loop: true
            }
        }
    })
</script>
<script>
    $('#products').owlCarousel({
        loop: true,
        autoplay: false,
        autoplayTimeout: 3500,
        margin: 15,
        smartSpeed: 1000, // duration of change of 1 slide
        nav: true,
        navigation: true,
        responsiveClass: true,
        responsive: {
            0: {
                items: 1,
                nav: true,
                loop: true
            },
            600: {
                items: 2,
                nav: false,
                loop: true
            },
            1000: {
                items: 4,
                nav: true,
                loop: false,
                loop: true
            },
            1400: {
                items: 4,
                nav: true,
                loop: false,
                loop: true
            }
        }
    })
</script>
<script>
    $('#services').owlCarousel({
        loop: true,
        autoplay: false,
        autoplayTimeout: 4000,
        margin: 15,
        smartSpeed: 1000, // duration of change of 1 slide
        nav: true,
        navigation: true,
        responsiveClass: true,
        responsive: {
            0: {
                items: 1,
                nav: true,
                loop: true
            },
            600: {
                items: 2,
                nav: false
            },
            1000: {
                items: 4,
                nav: true,
                loop: false,
                loop: true
            },
            1400: {
                items: 4,
                nav: true,
                loop: false,
                loop: true
            }
        }
    })
</script>
<script>
    $('#featured,#business').owlCarousel({
        loop: true,
        margin: 15,
        smartSpeed: 1000, // duration of change of 1 slide
        nav: true,
        autoplay: false,
        autoplayTimeout: 3000,
        navigation: true,
        responsiveClass: true,
        responsive: {
            0: {
                items: 1,
                nav: true,
                loop: true
            },
            600: {
                items: 2,                
            },
            1000: {
                items: 2,
                nav: true
            },
            1400: {
                items: 2,
                nav: true
            }
        }
    })
</script>
</body>

</html>