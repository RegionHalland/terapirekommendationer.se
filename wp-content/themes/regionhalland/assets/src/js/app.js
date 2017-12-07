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

	// Initialize GA
	ga('create', 'UA-110777448-2', 'auto');
})( jQuery );
