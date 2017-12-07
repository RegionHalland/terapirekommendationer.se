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
		ga('send', {
			hitType: 'event',
			eventCategory: 'Search',
			eventAction: 'search',
			eventLabel: this.value
		});
		ga('send', 'pageview', '/search?q=' + this.value);
	}, 350));
	
	// If search results were found
	search.autocomplete.on('autocomplete:shown', debounce(function(e) {
		ga('send', 'pageview', '/search?q=' + this.value);
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