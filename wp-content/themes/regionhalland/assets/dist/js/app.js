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
	$('#search-input').autocomplete({ hint: false }, [
	{
		source: $.fn.autocomplete.sources.hits(index, { hitsPerPage: 5 }),
		displayKey: 'my_attribute',
		templates: {
			suggestion: function(suggestion) {
				console.log(suggestion);
	  			return suggestion._highlightResult.post_title.value;
			}
		}
	}
	]).on('autocomplete:selected', function(event, suggestion, dataset) {
		console.log(suggestion, dataset);
	});

})( jQuery );
