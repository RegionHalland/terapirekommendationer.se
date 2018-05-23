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
})( jQuery );

// (function($) {
	// var client = algoliasearch('16DY3X1DMY', 'efd311c980dd4dc470f5629ab96a1377')
	// var index = client.initIndex('tr_wp_posts_page');

	// $('#search-input').autocomplete({
	// 	debug: true,
	// 	hint: true,
	// 	cssClasses: {
	// 		noPrefix: true,
	// 		root: 'col-12',
	// 		input: '',
	// 		dropdownMenu: 'search-header__results',
	// 		suggestions: 'search-header__suggestions',
	// 		suggestion: 'search-header__suggestion',
	// 		dataset: 'search__dataset'
	// 	},
	//   	templates: {
	//     	dropdownMenu: '<div class="search__dataset-1"></div>'
	//     },
	// 	openOnFocus: true,
	// 	// autoselectOnBlur: false,
	// 	autoWidth: false,
	// }, [
	// {
	// 	source: $.fn.autocomplete.sources.hits(index, { hitsPerPage: 5 }),
	// 	displayKey: 'post_title',
	// 	templates: {

	// 		suggestion: function(suggestion) {
	// 			var markup  = '<span class="search-header__hit">' + suggestion._highlightResult.post_title.value + '</span>';
	//   				markup += '<div class="search-header__breadcrumbs">';

	//   			for (var i = 0; i < suggestion.breadcrumbs.length; i++) {
	//   				markup += '<span class="search-header__breadcrumb h6">' + suggestion.breadcrumbs[i] + '</span>';
	//   				if (i !== suggestion.breadcrumbs.length - 1) {
	//   					markup += '<svg aria-hidden="true" class="search-header__breadcrumb  icon"><use xlink:href="#arrow-right"/></svg>';
	//   				}
	//   			}
	//   				markup += '</div>';

	//   			return markup;
	// 		}
	// 	}
	// }
	// ]).on('autocomplete:selected', function(event, suggestion, dataset) {
	// 	// console.log(suggestion, dataset);
	// 	window.location.href = suggestion.permalink;
	// });
// })( jQuery );
(function($) {

	function ContentNav() {
		this.init();
	}

	ContentNav.prototype.init = function(target) {
		this.contentNav = $('.content-nav');
		this.contentNavList = $('.content-nav__list');
		this.contentNavItems = this.contentNavList.children('.content-nav__item');
		this.headings = $('#main').children('h3:not(:empty)');

		if (!this.contentNav.length || typeof Waypoint !== 'function') {
			return;
		}

		this.stickContentNav(this);
		this.addWaypoints(this);
	}

	ContentNav.prototype.stickContentNav = function(target) {
		var stickContentNav = new Waypoint.Sticky({
  			element: target.contentNav,
  			wrapper: '<div/>',
  			stuckClass: 'fixed top-0'
		})
	}

	ContentNav.prototype.addWaypoints = function(target) {
		if (!this.headings.length) {
			return;
		}

		this.headings.waypoint(function(direction) {
			if (direction === 'down') {
				target.contentNavItems.removeClass('active')
				target.contentNavItems.eq(target.headings.index(this.element)).addClass('active')
			}
		}, { offset: '2' })

		this.headings.waypoint(function(direction) {
			if (direction === 'up') {
				target.contentNavItems.removeClass('active')
				target.contentNavItems.eq(target.headings.index(this.element)).addClass('active')

			}
		}, { offset: '-2' });
	}

	return new ContentNav();

})( jQuery );
(function($) {
	var search = docsearch({
		apiKey: '6278d32db4b0c634970c4f20b22a230c',
		indexName: 'terapirekommendationer',
		inputSelector: '#search-input',
		debug: false, // Set debug to true if you want to inspect the dropdown
		autocompleteOptions: {
			cssClasses: {
				root: 'algolia-autocomplete col-12',
				prefix: 'ds'
			}
		}
	});

	// If no search results are shown
	search.autocomplete.on('autocomplete:empty', debounce(function(e) {
		window.dataLayer.push({
			event: 'successfulSearch',
			page: '/search?q=' + this.value
		}, {
            'event': 'failedSearch',
            'eventCategory': 'Failed search',  
            'eventAction': this.value
        })
	}, 350));
	
	// If search results were found
	search.autocomplete.on('autocomplete:shown', debounce(function(e) {
		window.dataLayer.push({
			event: 'successfulSearch',
			path: '/search?q=' + this.value
		})
	}, 350));

	// Debounce
	function debounce(func, wait, immediate) {
		var timeout;
		return function() {
			var context = this, args = arguments;
			var later = function() {
				timeout = null;
				if (!immediate) func.apply(context, args);
			};
			var callNow = immediate && !timeout;
			clearTimeout(timeout);
			timeout = setTimeout(later, wait);
			if (callNow) func.apply(context, args);
		};
	};

})( jQuery );
(function($) {

	function ToggleSubmenuItems() {
		this.init();
	}

	ToggleSubmenuItems.prototype.init = function () {
		var self = this;
		$(document).on('click', 'button[data-load-submenu]', function(e) {
			e.preventDefault();

			if (!self.useAjax(this)) {
				self.toggleSibling(this);
			} else {
				self.ajaxLoadItems(this);
				self.toggleSibling(this);
			}
		});
	};

	ToggleSubmenuItems.prototype.useAjax = function (target) {
		if ($(target).parents('li').first().children("ul").length) {
			return false;
		}

		return true;
	};

	ToggleSubmenuItems.prototype.ajaxLoadItems = function (target) {
		var markup = '';
		var parentId = this.getItemId(target);

		if(typeof parentId == 'undefined') {
			window.location.href = $(target).siblings("a").attr('href');
			return false;
		}

		$(target).parents('li').first().addClass('is-loading');

		$.ajax({
			url: HbgPrimeArgs.api.root + 'municipio/v1/navigation/' + parentId,
			method: 'GET',
			beforeSend: function (xhr) {
				xhr.setRequestHeader('X-WP-Nonce', HbgPrimeArgs.api.nonce);
			}
		}).done(function (response) {
			if (response.length !== "") {
				$(target).parents('li').first().append(response);
				$(target).siblings('.sub-menu');
			} else {
				window.location.href = $(target).attr('href');
			}

			$(target).parents('li').first().removeClass('is-loading');
		}.bind(target)).fail(function () {
			window.location.href = $(target).attr('href');
		}.bind(target));
	};

	ToggleSubmenuItems.prototype.getItemId = function (target) {
		return $(target).data('load-submenu');
	};

	ToggleSubmenuItems.prototype.toggleSibling = function (target) {
		$(target).parents('li').first().toggleClass('is-expanded');
	};

	return new ToggleSubmenuItems();

})( jQuery );
(function($) {

	function ToggleVerticalNav() {
		this.init();
	}

	ToggleVerticalNav.prototype.init = function() {
		
		this.nav = $('.vertical-nav')
		
		if (!this.nav.length) {
			return
		}

		this.header = this.nav.children('.vertical-nav__header');
		this.toggleButton = this.header.children('.vertical-nav__button');

		this.bind(this);

	}

	ToggleVerticalNav.prototype.bind = function(target) {
		this.toggleButton.on('click', this.toggleNav.bind(this));
	}

	ToggleVerticalNav.prototype.toggleNav = function() {
		this.nav.toggleClass('open');
	}

	return new ToggleVerticalNav();

})( jQuery );