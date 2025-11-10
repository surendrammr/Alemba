$(document).ready( function() {
	var slider = $.fn.fsvs({
		speed : 1000,
		bodyID : 'fsvs-body',
		selector : '> .slide',
		mouseSwipeDisance : 100,
		afterSlide : function(){},
		beforeSlide : function(){},
		endSlide : function(){},
		mouseWheelEvents : true,
		mouseWheelDelay : false,
		scrollableArea : 'scrollable',
		mouseDragEvents : false,
		touchEvents : true,
		arrowKeyEvents : true,
		pagination : true,
		nthClasses : false,
		detectHash : true
	});
	//slider.slideUp();
	//slider.slideDown();
	//slider.slideToIndex( index );
	//slider.unbind();
	//slider.rebind();
});