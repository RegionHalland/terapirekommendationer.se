var Terapirekommendationer;

(function($) {
	$.get("https://regionhalland.github.io/styleguide/dist/icons/sprite-2.svg", function(data) {
		var div = document.createElement("div");
		div.className = 'no-display';
		div.innerHTML = new XMLSerializer().serializeToString(data.documentElement);
		document.body.insertBefore(div, document.body.childNodes[0]);
	});
})( jQuery );