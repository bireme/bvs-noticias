(function( $ ) {
    'use strict';

    /**
     * All of the code for your public-facing JavaScript source
     * should reside in this file.
     *
     * Note: It has been assumed you will write jQuery code here, so the
     * $ function reference has been prepared for usage within the scope
     * of this function.
     *
     * This enables you to define handlers, for when the DOM is ready:
     *
     * $(function() {
     *
     * });
     *
     * When the window is loaded:
     *
     * $( window ).load(function() {
     *
     * });
     *
     * ...and/or other possibilities.
     *
     * Ideally, it is not considered best practise to attach more than a
     * single DOM-ready or window-load handler for a particular page.
     * Although scripts in the WordPress core, Plugins and Themes may be
     * practising this, we should strive to set a better example in our own work.
     */

	function getParameterByName(name, url) {
	    if (!url) url = window.location.href;
	    name = name.replace(/[\[\]]/g, "\\$&");
	    var regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)"),
	        results = regex.exec(url);
	    if (!results) return null;
	    if (!results[2]) return '';
	    return decodeURIComponent(results[2].replace(/\+/g, " "));
	}

    $( document ).ready( function() {
	    $('.widget_archives_calendar').each( function() {
	    	var url = $(this).find('.has-posts a').attr('href'),
	    		pt = getParameterByName('p', url);

	    	if (pt != null) {
	    		var el = $(this).find('.menu-container a.title'),
	    		    _href = el.attr('href');

	    		el.attr('href', _href + '?p=' + pt);

	    		$(this).find('.menu-container li a').each( function() {
	    			_href = $(this).attr('href'); 
                	$(this).attr('href', _href + '?p=' + pt);
	    		});
	    	}
	    });
	});

	$('.pagination_container a').live('click', function(e) {  
        e.preventDefault();

        var url = $(this).attr('href'),
        	parts = url.split('/'),
        	link = $(location).attr('href');

        $('.upw-posts').fadeTo('fast', 0, function() {
            $(this).load(link + ' .upw-posts', { page: parts[parts.length-2] }, function() {
                $('.upw-posts').fadeTo('fast', 1);
            });
        });  

        // $('.upw-posts').fadeTo('fast', 0).finish().load(link + ' .upw-posts', { page: parts[parts.length-2] }, function() {
        //     $('.upw-posts').fadeTo('fast', 1).finish();
        // });  
    });

})( jQuery );
