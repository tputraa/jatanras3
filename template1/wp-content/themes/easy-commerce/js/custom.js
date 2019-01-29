( function( $ ) {

  $(document).ready(function($){

  	// Carousel.
  	$('.easy-commerce-featured-products-carousel').slick();

  	// Featured carousel.
  	if( $('#featured-carousel').length > 0 ) {
	  	$('.featured-product-carousel-wrapper').slick();
	}

    // Trigger mobile menu.
    $('#mobile-trigger').sidr({
		timing: 'ease-in-out',
		speed: 500,
		source: '#mob-menu',
		name: 'sidr-main'
    });

    // Implement go to top.
    var $scroll_obj = $( '#btn-scrollup' );
    if ( $scroll_obj.length > 0 ) {
    	$( window ).scroll(function(){
    		if ( $( this ).scrollTop() > 100 ) {
    			$scroll_obj.fadeIn();
    		} else {
    			$scroll_obj.fadeOut();
    		}
    	});

    	$scroll_obj.click(function(){
    		$( 'html, body' ).animate( { scrollTop: 0 }, 600 );
    		return false;
    	});
    } // End if go to top.

  });

} )( jQuery );
