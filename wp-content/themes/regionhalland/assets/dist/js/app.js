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
