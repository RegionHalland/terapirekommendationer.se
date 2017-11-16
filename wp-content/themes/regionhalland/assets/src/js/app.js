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
	

	$('#search-input').autocomplete({
		hint: true,
		cssClasses: {
			noPrefix: true,
			root: 'col-12',
			input: '',
			dropdownMenu: 'search-header__results',
			suggestions: 'search__suggestions',
			// suggestion: 'search__suggestion',
			dataset: 'search__dataset'
		},
      	templates: {
        	dropdownMenu: '<ul class="search__dataset-1"></ul>',
        	suggestion: '<h1 class="search__suggestionz"></h1>'
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

	  			return '<span class="search-header__hit">' + suggestion._highlightResult.post_title.value + '</span>';
			}
		}
	}
	]).on('autocomplete:selected', function(event, suggestion, dataset) {
		console.log(suggestion, dataset);
		window.location.href = suggestion.permalink;
	});

})( jQuery );
