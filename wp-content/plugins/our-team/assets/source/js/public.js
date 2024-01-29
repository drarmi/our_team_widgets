(function ($) {
	"use strict";
	var originalHTML = "";

	function returnOriginalHTML(settings) {
		$.each(settings, function (index, value) {
			let image = value.slider_image.url ? value.slider_image.url : "";
			let title = value.slider_title ? value.slider_title : "";
			let description = value.slider_description ? value.slider_description : "";
			let show_bottom = value.show_bottom_our_team ? value.show_bottom_our_team : "";
			let link = value.slider_link ? value.slider_link.url : "";
			let link_text = value.slider_link_text ? value.slider_link_text : "";

			let newElement = `
		<div class="item item-wrapper">
			<div class="image-wrapper">
				<img src="${image}" alt="${title}" />
			</div>
			<div class="title">
				<h3>${title}</h3>
			</div>
			<div class="item_description">
				${description}
			</div>
	`;

			if (show_bottom === 'yes') {
				newElement += `<a href="${link}" class="${link_text}"></a>`;
			}
			newElement += '</div>';

			originalHTML += newElement;

		});
	}

	function rootUpdate($mobile_column = 2, $leptop_column = 3, $pc_column = 4) {
		var root = document.documentElement;
		root.style.setProperty('--MOBILE-COLUMN', $mobile_column);
		root.style.setProperty('--LEPTOP-COLUMN', $leptop_column);
		root.style.setProperty('--PS-COLUMN', $pc_column);
	}

	var logoCarousel = function ($scope, $) {
		var $_this = $scope.find('.team-carousel');
		var $currentID = '#' + $_this.attr('id');
		var $mobile_column = $_this.data('mobile-column') < 2 ? $_this.data('mobile-column') : 2;
		var $leptop_column = $_this.data('leptop-column') < 3 ? $_this.data('leptop-column') : 3;
		var $pc_column = $_this.data('pc-column') < 4 ? $_this.data('pc-column') : 4;
		var $show_carrousel = $_this.data('show-carrousel');
		var settings = $_this.data('settings') ? $_this.data('settings').slider : "";

		var owl = $($currentID);
		let container = $('.about-usour-team-widget-cover');
		let content = $('.block-wrapper');

		if (content.html()) {
			originalHTML = content.html();
		} else {
			if (settings) {
				returnOriginalHTML(settings);
			}
		}

		if ($show_carrousel) {
			rootUpdate($mobile_column, $leptop_column, $pc_column);
			if (!owl.hasClass('owl-loaded')) {
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
				});
			}
		} else {
			owl.trigger('destroy.owl.carousel').removeClass('owl-loaded');
			if (originalHTML) {
				container.empty();
				container.append('<div class="block-wrapper">' + originalHTML + '</div>');
				rootUpdate($mobile_column, $leptop_column, $pc_column);
			}

		}
	};

	$(window).on('elementor/frontend/init', function () {
		elementorFrontend.hooks.addAction('frontend/element_ready/our-team-custom-widget.default', logoCarousel);
	});


})(jQuery);
