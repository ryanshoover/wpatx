// FONT REPLACEMENT
// Replace all tags with cufon equivalant
//	Cufon.replace('h1,h3,h4,h5,h6,#commentform label');
//	Cufon.replace('h2:not(.nocufon)');
//

// JQUERY

//jQuery.noConflict(); - not needed unless you are pulling from an external jquery library

jQuery(document).ready(function($){


	$('.gfield_required').replaceWith('<span class="gfield_required"><small>required</small></span>');
	$('#membership-level-grid div.twocol:nth-child(even)').addClass('chalt');
	$('#broker-team-plans-table tbody tr:nth-child(even)').addClass('chalt');

	$('.fourcol').each( function(i) {
	if( i % 3 != 2 )
		return;
	$(this).addClass('bar');
	});
	$('.chats .fourcol:nth-of-type(3n)').addClass('last');
	
	$('#membership-level-grid .twocol:nth-of-type(2n+2)').addClass('alt');
	
	// last widget - remove lower border
	$('.grid_4.threecol .widget:last').addClass('last');
	$('.threecol.last .widget:last').addClass('last');
	$('.fivecol.last .widget:last').addClass('last');
	$('#footer .widget li:last').css('border-bottom','none');
	
	   // Clear searchform on click
		$("#searchform #s").click(function(){
			$(this).val("");   
		});

	
	// Gravity Forms - auto-clear default value
	jQuery.fn.cleardefault = function() {
	   return this.focus(function() {
			if( this.value == this.defaultValue ) {
				 this.value = "";
			}
	   }).blur(function() {
			if( !this.value.length ) {
				 this.value = this.defaultValue;
			}
	   });
	};
	$('.clearit input, .clearit textarea').cleardefault();

	
		// Dropdown Menu config
		$("ul.sf-menu").supersubs({ 
            minWidth:    12,   // minimum width of sub-menus in em units 
            maxWidth:    14,   // maximum width of sub-menus in em units 
            extraWidth:  1     // extra width can ensure lines don't sometimes turn over 
                               // due to slight rounding differences and font-family 
        }).superfish();  // call supersubs first, then superfish, so that subs are 
                         // not display:none when measuring. Call before initialising 
                         // containing tabs for same reason.
	
	
	// Softbutton = soft fade on hover, used for social media icons
	$(".softbutton a").stop().fadeTo("fast", .55);
	$(".softbutton a").hover(
		function(){
			$(this).stop().fadeTo("fast", 1);
		},
		function(){
			$(this).stop().fadeTo("fast", .55);
		}
	);
	
	
	// Promo slider setup, inserted on when promo is in use to save bandwidth
	
	$('#promos').cycle({ 
		fx:     'fade', 
		speed:  1000, 
		timeout: 3000,
		pager: '#promo-nav',
		pause: 1,
		height: 400,
		pauseOnPagerHover: 1,
		fastOnEvent: 350,
		pagerAnchorBuilder: function(idx, slide) { 
			return "#promo-nav li:eq("+ idx +") a"; 
		}
	});

	$('.jolt .widgettitle.nocufon').html(function(i, oldHtml) {
    	return oldHtml.replace(/(\s)(\w+)/, '$1<strong>$2</strong>');
	});

	$('.jolt .widgettitle.nocufon').html(function(i, oldHtml) {
    	return oldHtml.replace(/(\w+)(\s)(\w+)(\s)/, '$1$2 <br> $3$4');
	});
	
	$('.jolt .widgettitle.nocufon').html(function(i, oldHtml) {
    	return oldHtml.replace(/(\w+)(!)/, '<strong>$1</strong>$2');
	});


});// end jquery