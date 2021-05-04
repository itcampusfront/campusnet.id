$(document).ready(function(){
	// Hide submenus
	$('#body-row .collapse').collapse('hide'); 

	// Collapse/Expand icon
	$('#collapse-icon').addClass('fa-angle-double-left'); 

	// Collapse click
	$('[data-toggle=sidebar-colapse]').click(function() {
	    SidebarCollapse();
	});

	function SidebarCollapse () {
	    $('.menu-collapsed').toggleClass('d-none');
	    $('.submenu-icon').toggleClass('d-none');
	    $('#sidebar-container').toggleClass('sidebar-expanded sidebar-collapsed');
	    
	    $('#body-row').toggleClass('collapsed');
	    // Collapse/Expand icon
	    $('#collapse-icon').toggleClass('fa-angle-double-left fa-angle-double-right');
	}
});

// go top
var btn = $('#top-button');

$(window).scroll(function() {
  if ($(window).scrollTop() > 100) {
    btn.addClass('show');
  } else {
    btn.removeClass('show');
  }
});

btn.on('click', function(e) {
  e.preventDefault();
  $('html, body').animate({scrollTop:0}, '10');
});