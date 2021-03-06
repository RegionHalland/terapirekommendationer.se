(function($) {

	function ToggleSubmenuItems() {
		this.init();
	}

	ToggleSubmenuItems.prototype.init = function () {
		var self = this;
		$(document).on('click', 'button[data-load-submenu]', function(e) {
			e.preventDefault();

			if (!self.useAjax(this)) {
				self.toggleSibling(this);
			} else {
				self.ajaxLoadItems(this);
				self.toggleSibling(this);
			}
		});
	};

	ToggleSubmenuItems.prototype.useAjax = function (target) {
		if ($(target).parents('li').first().children("ul").length) {
			return false;
		}

		return true;
	};

	ToggleSubmenuItems.prototype.ajaxLoadItems = function (target) {
		var markup = '';
		var parentId = this.getItemId(target);

		if(typeof parentId == 'undefined') {
			window.location.href = $(target).siblings("a").attr('href');
			return false;
		}

		$(target).parents('li').first().addClass('is-loading');

		$.ajax({
			url: HbgPrimeArgs.api.root + 'municipio/v1/navigation/' + parentId,
			method: 'GET',
			beforeSend: function (xhr) {
				xhr.setRequestHeader('X-WP-Nonce', HbgPrimeArgs.api.nonce);
			}
		}).done(function (response) {
			if (response.length !== "") {
				$(target).parents('li').first().append(response);
				$(target).siblings('.sub-menu');
			} else {
				window.location.href = $(target).attr('href');
			}

			$(target).parents('li').first().removeClass('is-loading');
		}.bind(target)).fail(function () {
			window.location.href = $(target).attr('href');
		}.bind(target));
	};

	ToggleSubmenuItems.prototype.getItemId = function (target) {
		return $(target).data('load-submenu');
	};

	ToggleSubmenuItems.prototype.toggleSibling = function (target) {
		$(target).parents('li').first().toggleClass('is-expanded');
	};

	return new ToggleSubmenuItems();

})( jQuery );