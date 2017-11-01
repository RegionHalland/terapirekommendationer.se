(function() {
	// Create plugin
	tinymce.create('tinymce.plugins.tr', {
		init: function(editor, url) {
			
			var parents;
			var parent;

			editor.on('nodeChange', function(e) {
				parent = e.parents[e.parents.length - 1];
				parents = e.parents;
			})

			editor.addButton('infobox_background', {
				type: 'button',
				text: 'Blå bakgrund',
				icon: false,
				onclick: function() {
					var selection = tinyMCE.activeEditor.selection;
					var bm = selection.getBookmark();
					var btn = this;

					if (parents.filter(function(e) { return e.nodeName == 'DIV'; }).length > 0) {
						var content = jQuery(parent).contents();
						jQuery(content).unwrap()

					} else {
						selection.setContent(
							'<div class="infobox--background">'+ selection.getContent() +'</div>'
						);
					}

					selection.moveToBookmark(bm);
					tinyMCE.activeEditor.undoManager.add()
				}
			});

			editor.addButton('infobox_border', {
				type: 'button',
				text: 'Blå ram',
				icon: false,
				onclick: function() {
					var selection = tinyMCE.activeEditor.selection;
					var bm = selection.getBookmark();

					if (parents.filter(function(e) { return e.nodeName == 'DIV'; }).length > 0) {
						var content = jQuery(parent).contents();
						jQuery(content).unwrap()

					} else {
						selection.setContent(
							'<div class="infobox--border">'+ selection.getContent() +'</div>'
						);
					}
					
					selection.moveToBookmark(bm);
					tinyMCE.activeEditor.undoManager.add()
				}
			});

			editor.addButton('infobox_children', {
				type: 'button',
				text: 'Målgrupp: Barn',
				icon: false,
				onclick: function() {
					var selection = tinyMCE.activeEditor.selection;
					var bm = selection.getBookmark();

					if (parents.filter(function(e) { return e.nodeName == 'DIV'; }).length > 0) {
						var content = jQuery(parent).find('.infobox__content').html();
						jQuery(parent).remove();
						selection.setContent(content)
					} else {
						selection.setContent(
							'<div class="infobox--children"><header class="infobox__header"><strong>Barn</strong></header><div class="infobox__content">'+ selection.getContent() +'</div></div>'
						);
					}

					selection.moveToBookmark(bm);
					tinyMCE.activeEditor.undoManager.add()
				}
			});


			editor.addButton('infobox_elder', {
				type: 'button',
				text: 'Målgrupp: Äldre',
				icon: false,
				onclick: function() {
					var selection = tinyMCE.activeEditor.selection;
					var bm = selection.getBookmark();

					if (parents.filter(function(e) { return e.nodeName == 'DIV'; }).length > 0) {
						var content = jQuery(parent).find('.infobox__content').html();
						jQuery(parent).remove();
						selection.setContent(content)
						
					} else {
						selection.setContent(
							'<div class="infobox--elderly"><header class="infobox__header"><strong>Äldre</strong></header><div class="infobox__content">'+ selection.getContent() +'</div></div>'
						);
					}

					selection.moveToBookmark(bm);
					tinyMCE.activeEditor.undoManager.add()
				}
			});

			// Register format for figure comment
			//tinymce.activeEditor.formatter.register('figure_comment_format', {
			//	inline: 'span',
			//	styles: {
			//		color: 'red',
			//		background: 'green'
			//	}
			//});

			editor.addButton('figure_comment', {
				type: 'button',
				text: 'Kommentar till Redaktion',
				icon: false,
				onclick: function() {
					// Register format for figure comment
					editor.formatter.register('figure_comment_format', {
						inline: 'span',
						classes: 'figurecomment',
						styles: {
							padding: '2px',
							color: '#ff0000',
							backgroundColor: '#ffbebe'
						}
					});

					editor.formatter.toggle('figure_comment_format');

					var btn = this;
					editor.formatter.formatChanged('figure_comment_format', function(state) {
						btn.active(state)
					});



				}
			});

			/*var buttons = [
				{
					label: 'Blå bakgrund',
					name: 'infobox_background',
					class: 'infobox--background',
					beforeContent: '<div class="infobox--background">',
					afterContent: '</div>'
				},
				{
					label: 'Blå ram',
					name: 'infobox_border',
					class: 'infobox--border',
					beforeContent: '<div class="infobox--border">',
					afterContent: '</div>'
				},
				{
					label: 'Målgrupp: Äldre',
					name: 'infobox_elder',
					class: 'infobox--children',
					beforeContent: '<div class="infobox--children"><header class="infobox__header">Ange målgrupp</header><div class="infobox__content">',
					afterContent: '</div></div>'
				},
				{
					label: 'Målgrupp: Barn',
					name: 'infobox_children',
					class: '',
					beforeContent: '<div class="infobox--elderly"><header class="infobox__header">Ange målgrupp</header><div class="infobox__content">',
					afterContent: '</div></div>',
				}
			]

			for (var i = 0; i < buttons.length; i++) {
				(function() {
					var button = buttons[i];
					editor.addButton(button.name, {
						type: 'button',
						text: button.label,
						icon: false,
						onclick: function() {
							var content = jQuery(parent).contents();
							
							if (content.parent().is('div')) {
								// var content = jQuery(parent).contents();
								// 
								//jQuery(content).unwrap()
								var children = jQuery(parent).children().not('div').clone;
								//jQuery(parent).remove('div');
								//jQuery(parent).remove('header');
								//jQuery(parent).contents().unwrap();
								
								

							} else {
								jQuery(parent).wrap('<div class="infobox--children"><header class="infobox__header">Ange målgrupp</header><div class="infobox__content"></div></div>');
							}



						
							 //var selection = editor.selection;
							 //selection.setContent(button.beforeContent + parents + button.afterContent)

							 //jQuery('#firstul').innerHTML = parents[1].outerHTML;
							// var parent = selection.getNode();
							
							/*if (!parent.classList.contains(button.classes)) {
								selection.setContent(button.beforeContent +  parents + button.afterContent)
								// this.active(true);
							} else {
								parent.classList.remove(button.classes);
								// this.active(false);
							}
						}
					});
				}())
			}*/
		}
	});

	// Register plugin
	tinymce.PluginManager.add( 'tr', tinymce.plugins.tr );
})();