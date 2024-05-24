// $('#calendar').datepicker({
// 		});

!function ($) {
    $(document).on("click","ul.nav li.parent > a ", function(){          
        $(this).find('em').toggleClass("fa-minus");      
    }); 
    $(".sidebar span.icon").find('em:first').addClass("fa-plus");
}

// (window.jQuery);
// 	$(window).on('resize', function () {
//   if ($(window).width() > 768) $('#sidebar-collapse').collapse('show')
// })
// $(window).on('resize', function () {
//   if ($(window).width() <= 767) $('#sidebar-collapse').collapse('hide')
// })


if(document.querySelectorAll('.panel-heading span.clickable').length > 0){
	var closeHide = document.querySelectorAll('.panel-heading span.clickable');
	for(i = 0; i < closeHide.length; i++){
		
		if(closeHide[i].classList.contains('closed')){
			var panel = closeHide[i].closest('.panel');
			var panelBody = panel.querySelector('.panel-body');
			var icon = closeHide[i].querySelector('em');
				panelBody.style.display = 'none';
				closeHide[i].classList.add('panel-collapsed');
				icon.classList.remove('fa-toggle-up');
				icon.classList.add('fa-toggle-down');
		}
	
	}
}

$(document).on('click', '.panel-heading span.clickable', function(e){
    var $this = $(this);
	if(!$this.hasClass('panel-collapsed')) {
		$this.parents('.panel').find('.panel-body').slideUp();
		$this.addClass('panel-collapsed');
		$this.find('em').removeClass('fa-toggle-up').addClass('fa-toggle-down');
	} else {
		$this.parents('.panel').find('.panel-body').slideDown();
		$this.removeClass('panel-collapsed');
		$this.find('em').removeClass('fa-toggle-down').addClass('fa-toggle-up');
	}
})
