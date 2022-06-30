/*!
 * jquery.requestanimationframe - @VERSION
 * https://github.com/gnarf37/jquery-requestAnimationFrame
 * Requires jQuery 1.8+
 *
 * Copyright (c) @YEAR Corey Frang
 * Licensed under the MIT license.
 */

 ;(function($) {
    if (!window.jQuery) {
        return;
    }

    if ( Number( jQuery.fn.jquery.split( "." )[ 0 ] ) >= 3 ) {
        return;
    }

    var animating;

    function raf() {
        if ( animating ) {
            window.requestAnimationFrame( raf );
            jQuery.fx.tick();
        }
    }

    if ( window.requestAnimationFrame ) {
        jQuery.fx.timer = function( timer ) {
            if ( timer() && jQuery.timers.push( timer ) && !animating ) {
                animating = true;
                raf();
            }
        };

        jQuery.fx.stop = function() {
            animating = false;
        };
    }

})(window.jQuery);