/*!
Waypoints - 4.0.1
Copyright © 2011-2016 Caleb Troughton
Licensed under the MIT license.
https://github.com/imakewebthings/waypoints/blob/master/licenses.txt
*/
!function(){"use strict";function t(o){if(!o)throw new Error("No options passed to Waypoint constructor");if(!o.element)throw new Error("No element option passed to Waypoint constructor");if(!o.handler)throw new Error("No handler option passed to Waypoint constructor");this.key="waypoint-"+e,this.options=t.Adapter.extend({},t.defaults,o),this.element=this.options.element,this.adapter=new t.Adapter(this.element),this.callback=o.handler,this.axis=this.options.horizontal?"horizontal":"vertical",this.enabled=this.options.enabled,this.triggerPoint=null,this.group=t.Group.findOrCreate({name:this.options.group,axis:this.axis}),this.context=t.Context.findOrCreateByElement(this.options.context),t.offsetAliases[this.options.offset]&&(this.options.offset=t.offsetAliases[this.options.offset]),this.group.add(this),this.context.add(this),i[this.key]=this,e+=1}var e=0,i={};t.prototype.queueTrigger=function(t){this.group.queueTrigger(this,t)},t.prototype.trigger=function(t){this.enabled&&this.callback&&this.callback.apply(this,t)},t.prototype.destroy=function(){this.context.remove(this),this.group.remove(this),delete i[this.key]},t.prototype.disable=function(){return this.enabled=!1,this},t.prototype.enable=function(){return this.context.refresh(),this.enabled=!0,this},t.prototype.next=function(){return this.group.next(this)},t.prototype.previous=function(){return this.group.previous(this)},t.invokeAll=function(t){var e=[];for(var o in i)e.push(i[o]);for(var n=0,r=e.length;r>n;n++)e[n][t]()},t.destroyAll=function(){t.invokeAll("destroy")},t.disableAll=function(){t.invokeAll("disable")},t.enableAll=function(){t.Context.refreshAll();for(var e in i)i[e].enabled=!0;return this},t.refreshAll=function(){t.Context.refreshAll()},t.viewportHeight=function(){return window.innerHeight||document.documentElement.clientHeight},t.viewportWidth=function(){return document.documentElement.clientWidth},t.adapters=[],t.defaults={context:window,continuous:!0,enabled:!0,group:"default",horizontal:!1,offset:0},t.offsetAliases={"bottom-in-view":function(){return this.context.innerHeight()-this.adapter.outerHeight()},"right-in-view":function(){return this.context.innerWidth()-this.adapter.outerWidth()}},window.Waypoint=t}(),function(){"use strict";function t(t){window.setTimeout(t,1e3/60)}function e(t){this.element=t,this.Adapter=n.Adapter,this.adapter=new this.Adapter(t),this.key="waypoint-context-"+i,this.didScroll=!1,this.didResize=!1,this.oldScroll={x:this.adapter.scrollLeft(),y:this.adapter.scrollTop()},this.waypoints={vertical:{},horizontal:{}},t.waypointContextKey=this.key,o[t.waypointContextKey]=this,i+=1,n.windowContext||(n.windowContext=!0,n.windowContext=new e(window)),this.createThrottledScrollHandler(),this.createThrottledResizeHandler()}var i=0,o={},n=window.Waypoint,r=window.onload;e.prototype.add=function(t){var e=t.options.horizontal?"horizontal":"vertical";this.waypoints[e][t.key]=t,this.refresh()},e.prototype.checkEmpty=function(){var t=this.Adapter.isEmptyObject(this.waypoints.horizontal),e=this.Adapter.isEmptyObject(this.waypoints.vertical),i=this.element==this.element.window;t&&e&&!i&&(this.adapter.off(".waypoints"),delete o[this.key])},e.prototype.createThrottledResizeHandler=function(){function t(){e.handleResize(),e.didResize=!1}var e=this;this.adapter.on("resize.waypoints",function(){e.didResize||(e.didResize=!0,n.requestAnimationFrame(t))})},e.prototype.createThrottledScrollHandler=function(){function t(){e.handleScroll(),e.didScroll=!1}var e=this;this.adapter.on("scroll.waypoints",function(){(!e.didScroll||n.isTouch)&&(e.didScroll=!0,n.requestAnimationFrame(t))})},e.prototype.handleResize=function(){n.Context.refreshAll()},e.prototype.handleScroll=function(){var t={},e={horizontal:{newScroll:this.adapter.scrollLeft(),oldScroll:this.oldScroll.x,forward:"right",backward:"left"},vertical:{newScroll:this.adapter.scrollTop(),oldScroll:this.oldScroll.y,forward:"down",backward:"up"}};for(var i in e){var o=e[i],n=o.newScroll>o.oldScroll,r=n?o.forward:o.backward;for(var s in this.waypoints[i]){var a=this.waypoints[i][s];if(null!==a.triggerPoint){var l=o.oldScroll<a.triggerPoint,h=o.newScroll>=a.triggerPoint,p=l&&h,u=!l&&!h;(p||u)&&(a.queueTrigger(r),t[a.group.id]=a.group)}}}for(var c in t)t[c].flushTriggers();this.oldScroll={x:e.horizontal.newScroll,y:e.vertical.newScroll}},e.prototype.innerHeight=function(){return this.element==this.element.window?n.viewportHeight():this.adapter.innerHeight()},e.prototype.remove=function(t){delete this.waypoints[t.axis][t.key],this.checkEmpty()},e.prototype.innerWidth=function(){return this.element==this.element.window?n.viewportWidth():this.adapter.innerWidth()},e.prototype.destroy=function(){var t=[];for(var e in this.waypoints)for(var i in this.waypoints[e])t.push(this.waypoints[e][i]);for(var o=0,n=t.length;n>o;o++)t[o].destroy()},e.prototype.refresh=function(){var t,e=this.element==this.element.window,i=e?void 0:this.adapter.offset(),o={};this.handleScroll(),t={horizontal:{contextOffset:e?0:i.left,contextScroll:e?0:this.oldScroll.x,contextDimension:this.innerWidth(),oldScroll:this.oldScroll.x,forward:"right",backward:"left",offsetProp:"left"},vertical:{contextOffset:e?0:i.top,contextScroll:e?0:this.oldScroll.y,contextDimension:this.innerHeight(),oldScroll:this.oldScroll.y,forward:"down",backward:"up",offsetProp:"top"}};for(var r in t){var s=t[r];for(var a in this.waypoints[r]){var l,h,p,u,c,d=this.waypoints[r][a],f=d.options.offset,w=d.triggerPoint,y=0,g=null==w;d.element!==d.element.window&&(y=d.adapter.offset()[s.offsetProp]),"function"==typeof f?f=f.apply(d):"string"==typeof f&&(f=parseFloat(f),d.options.offset.indexOf("%")>-1&&(f=Math.ceil(s.contextDimension*f/100))),l=s.contextScroll-s.contextOffset,d.triggerPoint=Math.floor(y+l-f),h=w<s.oldScroll,p=d.triggerPoint>=s.oldScroll,u=h&&p,c=!h&&!p,!g&&u?(d.queueTrigger(s.backward),o[d.group.id]=d.group):!g&&c?(d.queueTrigger(s.forward),o[d.group.id]=d.group):g&&s.oldScroll>=d.triggerPoint&&(d.queueTrigger(s.forward),o[d.group.id]=d.group)}}return n.requestAnimationFrame(function(){for(var t in o)o[t].flushTriggers()}),this},e.findOrCreateByElement=function(t){return e.findByElement(t)||new e(t)},e.refreshAll=function(){for(var t in o)o[t].refresh()},e.findByElement=function(t){return o[t.waypointContextKey]},window.onload=function(){r&&r(),e.refreshAll()},n.requestAnimationFrame=function(e){var i=window.requestAnimationFrame||window.mozRequestAnimationFrame||window.webkitRequestAnimationFrame||t;i.call(window,e)},n.Context=e}(),function(){"use strict";function t(t,e){return t.triggerPoint-e.triggerPoint}function e(t,e){return e.triggerPoint-t.triggerPoint}function i(t){this.name=t.name,this.axis=t.axis,this.id=this.name+"-"+this.axis,this.waypoints=[],this.clearTriggerQueues(),o[this.axis][this.name]=this}var o={vertical:{},horizontal:{}},n=window.Waypoint;i.prototype.add=function(t){this.waypoints.push(t)},i.prototype.clearTriggerQueues=function(){this.triggerQueues={up:[],down:[],left:[],right:[]}},i.prototype.flushTriggers=function(){for(var i in this.triggerQueues){var o=this.triggerQueues[i],n="up"===i||"left"===i;o.sort(n?e:t);for(var r=0,s=o.length;s>r;r+=1){var a=o[r];(a.options.continuous||r===o.length-1)&&a.trigger([i])}}this.clearTriggerQueues()},i.prototype.next=function(e){this.waypoints.sort(t);var i=n.Adapter.inArray(e,this.waypoints),o=i===this.waypoints.length-1;return o?null:this.waypoints[i+1]},i.prototype.previous=function(e){this.waypoints.sort(t);var i=n.Adapter.inArray(e,this.waypoints);return i?this.waypoints[i-1]:null},i.prototype.queueTrigger=function(t,e){this.triggerQueues[e].push(t)},i.prototype.remove=function(t){var e=n.Adapter.inArray(t,this.waypoints);e>-1&&this.waypoints.splice(e,1)},i.prototype.first=function(){return this.waypoints[0]},i.prototype.last=function(){return this.waypoints[this.waypoints.length-1]},i.findOrCreate=function(t){return o[t.axis][t.name]||new i(t)},n.Group=i}(),function(){"use strict";function t(t){this.$element=e(t)}var e=window.jQuery,i=window.Waypoint;e.each(["innerHeight","innerWidth","off","offset","on","outerHeight","outerWidth","scrollLeft","scrollTop"],function(e,i){t.prototype[i]=function(){var t=Array.prototype.slice.call(arguments);return this.$element[i].apply(this.$element,t)}}),e.each(["extend","inArray","isEmptyObject"],function(i,o){t[o]=e[o]}),i.adapters.push({name:"jquery",Adapter:t}),i.Adapter=t}(),function(){"use strict";function t(t){return function(){var i=[],o=arguments[0];return t.isFunction(arguments[0])&&(o=t.extend({},arguments[1]),o.handler=arguments[0]),this.each(function(){var n=t.extend({},o,{element:this});"string"==typeof n.context&&(n.context=t(this).closest(n.context)[0]),i.push(new e(n))}),i}}var e=window.Waypoint;window.jQuery&&(window.jQuery.fn.waypoint=t(window.jQuery)),window.Zepto&&(window.Zepto.fn.waypoint=t(window.Zepto))}();
/*!
Waypoints Sticky Element Shortcut - 4.0.1
Copyright © 2011-2016 Caleb Troughton
Licensed under the MIT license.
https://github.com/imakewebthings/waypoints/blob/master/licenses.txt
*/
!function(){"use strict";function t(s){this.options=e.extend({},i.defaults,t.defaults,s),this.element=this.options.element,this.$element=e(this.element),this.createWrapper(),this.createWaypoint()}var e=window.jQuery,i=window.Waypoint;t.prototype.createWaypoint=function(){var t=this.options.handler;this.waypoint=new i(e.extend({},this.options,{element:this.wrapper,handler:e.proxy(function(e){var i=this.options.direction.indexOf(e)>-1,s=i?this.$element.outerHeight(!0):"";this.$wrapper.height(s),this.$element.toggleClass(this.options.stuckClass,i),t&&t.call(this,e)},this)}))},t.prototype.createWrapper=function(){this.options.wrapper&&this.$element.wrap(this.options.wrapper),this.$wrapper=this.$element.parent(),this.wrapper=this.$wrapper[0]},t.prototype.destroy=function(){this.$element.parent()[0]===this.wrapper&&(this.waypoint.destroy(),this.$element.removeClass(this.options.stuckClass),this.options.wrapper&&this.$element.unwrap())},t.defaults={wrapper:'<div class="sticky-wrapper" />',stuckClass:"stuck",direction:"down right"},i.Sticky=t}();
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
})( jQuery );

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
(function($) {
	var search = docsearch({
		apiKey: '6278d32db4b0c634970c4f20b22a230c',
		indexName: 'terapirekommendationer',
		inputSelector: '#search-input',
		debug: false, // Set debug to true if you want to inspect the dropdown
		autocompleteOptions: {
			cssClasses: {
				root: 'algolia-autocomplete col-12',
				prefix: 'ds'
			}
		}
	});

	// If no search results are shown
	search.autocomplete.on('autocomplete:empty', debounce(function(e) {
		window.dataLayer.push({
			event: 'successfulSearch',
			page: '/search?q=' + this.value
		}, {
            'event': 'failedSearch',
            'eventCategory': 'Failed search',  
            'eventAction': this.value
        })
	}, 350));
	
	// If search results were found
	search.autocomplete.on('autocomplete:shown', debounce(function(e) {
		window.dataLayer.push({
			event: 'successfulSearch',
			path: '/search?q=' + this.value
		})
	}, 350));

	// Debounce
	function debounce(func, wait, immediate) {
		var timeout;
		return function() {
			var context = this, args = arguments;
			var later = function() {
				timeout = null;
				if (!immediate) func.apply(context, args);
			};
			var callNow = immediate && !timeout;
			clearTimeout(timeout);
			timeout = setTimeout(later, wait);
			if (callNow) func.apply(context, args);
		};
	};

})( jQuery );
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