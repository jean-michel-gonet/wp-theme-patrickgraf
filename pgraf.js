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

// add/remove classes everytime the window resize event fires
jQuery(window).resize(function(){
	var off_canvas_nav_display = $('.off-canvas-navigation').css('display');
	var menu_button_display = $('.menu-button').css('display');
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
});
