var showSidebar = function() {
	jQuery('body').removeClass("active-nav").toggleClass("active-sidebar");
	jQuery('.menu-button').removeClass("active-button");					
	jQuery('.sidebar-button').toggleClass("active-button");
}

var showMenu = function() {
	jQuery('body').removeClass("active-sidebar").toggleClass("active-nav");
	jQuery('.sidebar-button').removeClass("active-button");				
	jQuery('.menu-button').toggleClass("active-button");	
}

var getBiggestImageSource = function(srcset) {
	var biggestImageWidth = 0;
	var biggestImageSource;

	var srcsetEntries = srcset.split(',');
	for(var srcsetEntry of srcsetEntries) {
		var tokenizedSrcsetEntry = srcsetEntry.trim().split(' ');
		var imageWidth = parseInt(tokenizedSrcsetEntry[1].substring(0, tokenizedSrcsetEntry[1].length - 1));
		if (imageWidth > biggestImageWidth) {
			biggestImageSource = tokenizedSrcsetEntry[0];
		}
	}

	return biggestImageSource;
}

// add/remove classes everytime the window resize event fires
jQuery(window).resize(function(){
	var off_canvas_nav_display = jQuery('.off-canvas-navigation').css('display');
	var menu_button_display = jQuery('.menu-button').css('display');
	if (off_canvas_nav_display === 'block') {			
		jQuery("body").removeClass("three-column").addClass("small-screen");				
	} 
	if (off_canvas_nav_display === 'none') {
		jQuery("body").removeClass("active-sidebar active-nav small-screen")
			.addClass("three-column");			
	}	
	
});	

jQuery(document).ready(function($) {
		// Toggle for nav menu
		jQuery('.menu-button').click(function(e) {
			e.preventDefault();
			showMenu();							
		});	
		// Toggle for sidebar
		jQuery('.sidebar-button').click(function(e) {
			e.preventDefault();
			showSidebar();									
		});
		// Click on images
		jQuery("[role='main'] img").click(function(e) {
			var biggestImageSource = getBiggestImageSource(e.target.srcset);
			jQuery('body').addClass("noscroll");
			jQuery('.image-viewer').addClass("active");
			jQuery('.image-viewer img').each(function() {
				this.src = biggestImageSource;
			});
		});
		jQuery(".image-viewer").click(function() {
			jQuery('body').removeClass('noscroll');
			jQuery('.image-viewer').removeClass('active');
		});
});
