(function() {
    // Wraps the selection text into span 'Uppercase'
    tinymce.PluginManager.add('uppercase', function( editor, url ) {
        editor.on('init', function(e) {
            this.formatter.register('target_uppercase', {
                inline : 'span',
                classes : 'uppercase'
            });
        });
        editor.addButton('uppercase', {
            text: 'Uppercase',
            icon: false,
            onclick : function() {
                let contents = editor.selection.getContent(),
                    tags = jQuery(jQuery.parseHTML(contents)).find('span.highlighting-gray');
                editor.formatter.toggle('target_uppercase');
            }
        });
    });
    // Wraps the selection text into strong 'green-banner'
    tinymce.PluginManager.add('green_banner', function( editor, url ) {
        editor.on('init', function(e) {
            this.formatter.register('target_green_banner', {
                inline : 'strong',
                classes : 'green-banner'
            });
        });
        editor.addButton('green_banner', {
            text: 'Green',
            icon: false,
            onclick : function() {
                let contents = editor.selection.getContent(),
                    tags = jQuery(jQuery.parseHTML(contents)).find('span.highlighting-gray');
                editor.formatter.toggle('target_green_banner');
            }
        });
    });
    // Contact icons
    tinymce.PluginManager.add("contact_icon", function(editor, url) {
        editor.addButton("contact_icon", {
            text: "Icons",
            icon: false,
            onclick: function() {
                editor.windowManager.open({
                    title: "Adding icon in text",
                    body: [
                        {
                            type: "listbox",
                            name: "icon",
                            label: "Select Icon",
                            values: [
                                { text: "Map", value: "map" },
                                { text: "Mail", value: "mail" },
                                { text: "Whatsapp", value: "whatsapp" },
                                { text: "Facebook", value: "facebook" },
                                { text: "Linkedin", value: "linkedin" },
                            ],
                            value: "map", // Sets the default
                        },
                    ],
                    onsubmit: function (e) {
                        let contents = editor.selection.getContent(),
                            tags = jQuery(jQuery.parseHTML(contents));
                        let icon_class = '';
                        if (e.data.icon === 'map') {
                            icon_class = ' class="icon-map"';
                        } else if (e.data.icon === 'mail') {
                            icon_class = ' class="icon-mail"';
                        } else if (e.data.icon === 'whatsapp') {
                            icon_class = ' class="icon-whatsapp"';
                        } else if (e.data.icon === 'facebook') {
                            icon_class = ' class="icon-facebook"';
                        } else if (e.data.icon === 'linkedin') {
                            icon_class = ' class="icon-linkedin"';
                        }
                        editor.insertContent(
                            '<i' +
                            icon_class +
                            '>' +
                            "</i>"
                        );
                    },
                });
            },
        });
    });
})(jQuery);