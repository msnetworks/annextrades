(function($){

    $.fn.extend({ 

        hoverZoom: function(settings) {
 
            var defaults = {
                overlay: true,
                overlayColor: '#2e9dbd',
                overlayOpacity: 0.9,
                zoom: 25,
                speed: 300
            };
             
            var settings = $.extend(defaults, settings);
         
            return this.each(function() {
            
                var s = settings;
                var hz = $(this);
                var image = $('img', hz);

                image.load(function() {
                    
                    if(s.overlay === true) {
                        $(this).parent().append('<div class="zoomOverlay" />');
                        $(this).parent().find('.zoomOverlay').css({
                            opacity:0, 
                            display: 'block', 
                            backgroundColor: s.overlayColor
                        }); 
                    }
                
                    var width = $(this).width();
                    var height = $(this).height();
                
                    $(this).fadeIn(1000, function() {
                        $(this).parent().css('background-image', 'none');
                        hz.hover(function() {
                            $('img', this).stop().animate({
                                height: height + s.zoom,
                                marginLeft: -(s.zoom),
                                marginTop: -(s.zoom)
                            }, s.speed);
                            if(s.overlay === true) {
                                $(this).parent().find('.zoomOverlay').stop().animate({
                                    opacity: s.overlayOpacity
                                }, s.speed);
                            }
                        }, function() {
                            $('img', this).stop().animate({
                                height: height,
                                marginLeft: 0,
                                marginTop: 0
                            }, s.speed);
                            if(s.overlay === true) {
                                $(this).parent().find('.zoomOverlay').stop().animate({
                                    opacity: 0
                                }, s.speed);
                            }
                        });
                    });
                });    
            });
        }
    });
})(jQuery);

        $(function() {
        
        	
            $('.blue').hoverZoom({
                overlayColor: '#3498db',
                zoom: 0
            });
            
            $('.green').hoverZoom({
                overlayColor: '#1abc9c',
                zoom: 0
            });
            
            $('.pink').hoverZoom({
                overlayColor: '#bd2e75',
                zoom: 0
            });
            
            $('.black').hoverZoom({
                overlayColor: '#2f2f2f',
                zoom: 0
            });
            
            $('.alizarin').hoverZoom({
                overlayColor: '#e74c3c',
                zoom: 0
            });
            
            /* USAGE
            
            $('#pink').hoverZoom({
                overlay: true, // false to turn off (default true)
                overlayColor: '#2e9dbd', // overlay background color
                overlayOpacity: 0.7, // overlay opacity
                zoom: 25, // amount to zoom (px)
                speed: 300 // speed of the hover
            });
            
            */
            
        }); 
