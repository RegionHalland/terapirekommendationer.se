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

			editor.addButton('infobox_children', {
				type: 'button',
				text: 'Målgrupp: Barn och Ungdomar',
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
							'<div class="infobox--children"><header class="infobox__header"><strong>Barn och Ungdomar</strong></header><div class="infobox__content">'+ selection.getContent() +'</div></div>'
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
		}
	});

	// Register plugin
	tinymce.PluginManager.add( 'tr', tinymce.plugins.tr );
})();