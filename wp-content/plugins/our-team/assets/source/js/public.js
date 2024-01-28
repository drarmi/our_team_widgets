(function ($) {
	"use strict";

	var logoCarousel = function ($scope, $) {
		var $_this = $scope.find('.logo-carousel');
		var $currentID = '#' + $_this.attr('id');
		var $mobile_column = $_this.data('mobile-column');
		var $leptop_column = $_this.data('leptop-column');
		var $pc_column = $_this.data('pc-column');
		var $show_carrousel = $_this.data('show-carrousel');



		var owl = $($currentID);
		owl.owlCarousel({
			loop: true,
			margin: true,
			nav: true,
			dots: true,
			responsive: {
				0: {
					items: $mobile_column > 2 ? 2 : $mobile_column
				},
				600: {
					items: $leptop_column > 3 ? 3 : $leptop_column
				},
				1000: {
					items: $pc_column > 4 ? 4 : $pc_column
				}
			}
		})
	}

	$(window).on('elementor/frontend/init', function () {
		elementorFrontend.hooks.addAction('frontend/element_ready/our-team-custom-widget.default', logoCarousel);
	});
})(jQuery);