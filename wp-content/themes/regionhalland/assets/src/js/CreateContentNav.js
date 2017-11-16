(function($) {

	function CreateContentNav() {
		this.init();
	}

	CreateContentNav.prototype.init = function() {
		
		this.contentNav = $('.content-nav');
		this.headings = $('#main').children('h2, h3, h4, h5')
		
		if (!this.contentNav.length || typeof Waypoint !== 'function' || !this.headings.length) {
			return;
		}

		this.appendContent(this);
		this.addWaypoints(this);

	}


	CreateContentNav.prototype.appendContent = function(target) {

		// this.contentNav.append($('<ul class="content-nav__list"><span class="content-nav__heading">Innehållsmeny</span>'))
		var heading = $('<span/>', {
			class: 'content-nav__heading',
			text: 'Innehållsmeny'
		});

		var list = $('<ul/>', {
			class: 'content-nav__list'
		});

		var listItems = this.headings.each(function(i) {
			$('<li/>', {
				class: 'content-nav__item',
				text: '<a href="#' + this.id + '">' + this.innerHTML + '</a>'
			}).appendTo(list);
		});

		this.contentNav.append(list);
	}
	
	CreateContentNav.prototype.addWaypoints = function(target) {
		this.headings.waypoint(function() {
			target.contentNavList.children().removeClass('active')
			target.contentNavList.children().eq(target.headings.index(this.element)).addClass('active')
		})
	}

	return new CreateContentNav();

})( jQuery );