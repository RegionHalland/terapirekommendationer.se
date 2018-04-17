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