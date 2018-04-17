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