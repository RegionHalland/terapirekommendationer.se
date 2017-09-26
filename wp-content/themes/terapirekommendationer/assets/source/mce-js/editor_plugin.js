(function() {
    tinymce.create('tinymce.plugins.Wptuts', {
        /**
         * Initializes the plugin, this will be executed after the plugin has been created.
         * This call is done before the editor instance has finished it's initialization so use the onInit event
         * of the editor instance to intercept that event.
         *
         * @param {tinymce.Editor} ed Editor instance that the plugin is initialized in.
         * @param {string} url Absolute URL to where the plugin is located.
         */
        init : function(ed, url) {
            /*ed.addButton('showrecent', {
                title : 'Add recent posts shortcode',
                cmd : 'mceWRAP',
                icon: 'pricon-smiley-cool',
            });*/

            /*ed.addButton('showrecent', {
                title : 'Add recent posts shortcode',
                cmd : 'mceWRAP',
                icon: 'pricon-smiley-cool',
            });*/

            ed.addButton('mybutton', {
              type: 'menubutton',
              text: 'Innehållstyper',
              icon: false,
              menu: [{
                text: 'Informationsruta med blå bakgrund',
               /*onPostRender: function() {
                var _this = this;   // reference to the button itself
                ed.on('NodeChange', function(e) {
                    //activate the button if this parent has this class
                    var is_active = jQuery( ed.selection.getNode() ).hasClass('infobox--background');
                    _this.active( is_active );
                })
                },*/
                onclick: function() {
                    var selection = tinyMCE.activeEditor.selection.getContent();
                    tinyMCE.activeEditor.selection.setContent('<div class="infobox--background">' + selection + '</div>');
                //ed.dom.toggleClass( ed.selection.getNode(), 'infobox--background' );
                //this.active( !this.active() ); //toggle the button too
                /*selection = tinyMCE.activeEditor.selection.getContent();
                var elem_type = ed.selection.getNode().nodeName; // Get element type
                console.log(tinyMCE.activeEditor.selection)
                    if( elem_type !== 'DIV') {
                        return tinyMCE.activeEditor.selection.setContent('<div class="infobox--background">' + selection + '</div>');
                    }*/
                    // Removes all paragraphs in the active editor
                    //tinyMCE.activeEditor.selection.dom.remove(tinyMCE.activeEditor.selection.dom.select('div'));
                    //return tinyMCE.activeEditor.selection.setContent(selection);
                }
              }, {
                text: 'Informationsruta med blå ram',
                onclick: function() {
                    var selection = tinyMCE.activeEditor.selection.getContent();
                    tinyMCE.activeEditor.selection.setContent('<div class="infobox--border">' + selection + '</div>');
                }
              }, {
                text: 'Målgruppsanpassat innehåll - Barn/ungdom',
                onclick: function() {
                    var selection = tinyMCE.activeEditor.selection.getContent();
                    tinyMCE.activeEditor.selection.setContent(
                        '<div><header>Ange målgrupp</header><div>'+selection+'</div></div>'
                    );
                }
              }, {
                text: 'Målgruppsanpassat innehåll - Äldre',
                onclick: function() {
                    var selection = tinyMCE.activeEditor.selection.getContent();
                    tinyMCE.activeEditor.selection.setContent(
                        '<div><header>Ange målgrupp</header><div>'+selection+'</div></div>'
                    );
                }
              }
              ]
            });
        },
 
        /**
         * Creates control instances based in the incomming name. This method is normally not
         * needed since the addButton method of the tinymce.Editor class is a more easy way of adding buttons
         * but you sometimes need to create more complex controls like listboxes, split buttons etc then this
         * method can be used to create those.
         *
         * @param {String} n Name of the control to create.
         * @param {tinymce.ControlManager} cm Control manager to use inorder to create new control.
         * @return {tinymce.ui.Control} New control instance or null if no control was created.
         */
        createControl : function(n, cm) {
            return null;
        },
 
        /**
         * Returns information about the plugin as a name/value array.
         * The current keys are longname, author, authorurl, infourl and version.
         *
         * @return {Object} Name/value array containing information about the plugin.
         */
        getInfo : function() {
            return {
                longname : 'Wptuts Buttons',
                author : 'Lee',
                authorurl : 'http://wp.tutsplus.com/author/leepham',
                infourl : 'http://wiki.moxiecode.com/index.php/TinyMCE:Plugins/example',
                version : "0.1"
            };
        }
    });
 
    // Register plugin
    tinymce.PluginManager.add( 'wptuts', tinymce.plugins.Wptuts );
})();