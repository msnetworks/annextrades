<div class="category-row-wrap" style="top: 54; box-shadow: none !important; padding: 0;" id="categ">
    <div class="all-category-box">
        <button class="category-btn" style="padding-left: 15px;">
            <svg width="17" height="15" viewBox="0 0 17 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                <line y1="0.5" x2="17" y2="0.5" stroke="#212529" />
                <line y1="7.5" x2="17" y2="7.5" stroke="#212529" />
                <line y1="14.5" x2="17" y2="14.5" stroke="#212529" />
            </svg>
            <span style="font-size: 15px;"><b>Categories</b></span>
            <svg width="12" height="7" viewBox="0 0 12 7" fill="none" xmlns="http://www.w3.org/2000/svg">
                <line x1="0.353553" y1="0.646439" x2="5.35355" y2="5.64644" stroke="#5B5B5B" />
                <path d="M11 0.707099L5.35344 6.35355" stroke="#5B5B5B" />
            </svg>
        </button>
        <div class="all-categories"  style="padding: 15px;">
            <?php include("includes/new/product_categories.php"); ?>
        </div>  

    </div>
    <div class="hot-categories">
        <?php include "includes/new/featured_categories.php"; ?>
    </div>
</div>
<!-- <script>
    var fixmeTop = $('#categ').offset().top;       // get initial position of the element

        $(window).scroll(function() {                  // assign scroll event listener

            var currentScroll = $(window).scrollTop(); // get current position

            if (currentScroll >= fixmeTop) {           // apply position: fixed if you
                $('#categ').css({                      // scroll to that element or below it
                    position: 'fixed',
                    top: '54px',
                    left: '0',
                    width: '100%',
                    background: '#fff'
                });
            } else {                                   // apply position: static
                $('#categ').css({                      // if you scroll above it
                    position: 'absolute'
                });
            }

        });
</script> -->