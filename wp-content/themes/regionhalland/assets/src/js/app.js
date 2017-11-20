var Terapirekommendationer;

(function($) {
	
	// Load icon sprite
	// Needs review, check browser support.
	// https://github.com/jonathantneal/svg4everybody

	$.get('https://regionhalland.github.io/styleguide/dist/icons/sprite.svg', function(data) {
		var div = document.createElement('div');
		div.className = 'display-none';
		div.innerHTML = new XMLSerializer().serializeToString(data.documentElement);
		document.body.insertBefore(div, document.body.childNodes[0]);
	});


	var client = algoliasearch('16DY3X1DMY', 'efd311c980dd4dc470f5629ab96a1377')
	var index = client.initIndex('tr_wp_posts_page');
	

	// Smooth scrolling for anchor links
	// https://css-tricks.com/snippets/jquery/smooth-scrolling/

	// Select all links with hashes
	// $('a[href*="#"]').not('[href="#"]').not('[href="#0"]').click(function(event) {
	// 	// On-page links
	// 	if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') && location.hostname == this.hostname) {
	// 		// Figure out element to scroll to
	// 		var target = $(this.hash);
	// 		target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
	// 		// Does a scroll target exist?
	// 		if (target.length) {
	// 			event.preventDefault();

	// 			$('html, body').animate({
	// 				scrollTop: target.offset().top - 10
	// 			}, 800, function() {
	// 				// Callback after animation
	// 				// Must change focus!
	// 				var $target = $(target);
	// 				$target.focus();
					
	// 				if ($target.is(":focus")) { // Checking if the target was focused
	// 					return false;
	// 				}
	// 				$target.attr('tabindex','-1'); // Adding tabindex for elements not focusable
	// 				$target.focus(); // Set focus again
	// 			});
	// 		}
	// 	}
	// });


	$('#search-input').autocomplete({
		debug: true,
		hint: true,
		cssClasses: {
			noPrefix: true,
			root: 'col-12',
			input: '',
			dropdownMenu: 'search-header__results',
			suggestions: 'search-header__suggestions',
			suggestion: 'search-header__suggestion',
			dataset: 'search__dataset'
		},
      	templates: {
        	dropdownMenu: '<div class="search__dataset-1"></div>'
        },
		openOnFocus: true,
		// autoselectOnBlur: false,
		autoWidth: false,
	}, [
	{
		source: $.fn.autocomplete.sources.hits(index, { hitsPerPage: 5 }),
		displayKey: 'post_title',
		templates: {

			suggestion: function(suggestion) {
				var markup  = '<span class="search-header__hit">' + suggestion._highlightResult.post_title.value + '</span>';
	  				markup += '<div class="search-header__breadcrumbs">';

	  			for (var i = 0; i < suggestion.breadcrumbs.length; i++) {
	  				markup += '<span class="search-header__breadcrumb h6">' + suggestion.breadcrumbs[i] + '</span>';
	  				if (i !== suggestion.breadcrumbs.length - 1) {
	  					markup += '<svg aria-hidden="true" class="search-header__breadcrumb  icon"><use xlink:href="#arrow-right"/></svg>';
	  				}
	  			}
	  				markup += '</div>';

	  			return markup;
			}
		}
	}
	]).on('autocomplete:selected', function(event, suggestion, dataset) {
		// console.log(suggestion, dataset);
		window.location.href = suggestion.permalink;
	});

})( jQuery );
