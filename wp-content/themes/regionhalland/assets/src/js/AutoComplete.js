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