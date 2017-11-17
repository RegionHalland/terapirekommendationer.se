(function($) {

	function CreateContentNav() {
		this.init();
	}

	CreateContentNav.prototype.init = function() {
		
		this.contentNav = $('.content-nav');
		this.headings = $('#main').children('h2, h3, h4')
		
		if (!this.contentNav.length || typeof Waypoint !== 'function' || !this.headings.length) {
			return;
		}

		this.appendContent(this);
		this.addWaypoints(this);

	}

	CreateContentNav.prototype.appendContent = function(target) {

		var list = $('<ul/>', {
			class: 'content-nav__list'
		});

		$('<span/>', {
			class: 'content-nav__heading',
			text: 'Innehållsmeny'
		}).appendTo(list);

		var listItems = this.headings.each(function(i) {
			var li = $('<li/>', {
				class: 'content-nav__item',
			}).appendTo(list);

			$('<a/>', {
				 class: 'content-nav__link',
				 href: '#' + this.id,
				 text: this.innerHTML
			}).appendTo(li);
		});

		this.contentNav.append(list);
	}
	
	CreateContentNav.prototype.addWaypoints = function(target) {
		// Add waypoints for headings
		this.headings.waypoint(function() {
			target.contentNav.children('ul').children().removeClass('active')
			target.contentNav.children('ul').children().eq(target.headings.index(this.element)).addClass('active')
		})

		// Add waypoint for content-nav
		target.contentNav.waypoint(function() {
			target.contentNav.toggleClass('fixed top-0 mt4');
		})
	}

	return new CreateContentNav();

})( jQuery );