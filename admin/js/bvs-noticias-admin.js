(function( $ ) {
	'use strict';

	/**
	 * All of the code for your admin-facing JavaScript source
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

	$(document).ready(function() {

        var obj_id = '';

        $('.header-banner,.header-logo,.layout-background').click(function() {
            obj_id = $(this).attr('id');
            obj_id = '#' + obj_id.replace( /(:|\.|\[|\])/g, "\\$1" );
            tb_show('Upload a Image', 'media-upload.php?referer=media_page&type=image&TB_iframe=true&width=755&post_id=0', false);

            window.send_to_editor = function(html) {
                var hostname = window.location.hostname;
                var src = $(html).attr('src');
                var image_url = (src !== undefined) ? src : $('img', html).attr('src');
                if (image_url.indexOf(hostname) != -1) {
                    image_url = image_url.replace(/https?:\/\/[^\/]+/i, '');
                }
                $(obj_id).val(image_url);
                tb_remove();
            }

            return false;
        });

    });

})( jQuery );
