var option_TinyMCE = {
    height: "500",
    selector: 'textarea.content',
    entity_encoding : "raw",
    setup: function (ed) {
        ed.on('DblClick', function (e) {
            if (e.target.nodeName == 'IMG') {
                tinyMCE.activeEditor.execCommand('mceImage');
            }
        });

        ed.addButton('post_block_top', {
            type: 'button',
            text: 'Post Block Top',
            onclick: function () {
                ed.insertContent('[postblock id="top"]');

            }
        });

        ed.addButton('post_block_bottom', {
            type: 'button',
            text: 'Post Block Bottom',
            onclick: function () {
                ed.insertContent('[postblock id="bottom"]');
            }
        });

        ed.add

    },
    plugins: [
        "advlist autolink autosave link image lists charmap print preview hr anchor pagebreak spellchecker template",
        "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
        "table contextmenu directionality emoticons template textcolor paste textcolor colorpicker textpattern link image",
    ],

    toolbar1: "newdocument | bold italic underline strikethrough | alignleft aligncenter alignright alignjustify | styleselect formatselect fontselect fontsizeselect",
    toolbar2: "searchreplace | bullist numlist | outdent indent blockquote | undo redo | link unlink image media code | forecolor backcolor",
    toolbar3: "table | removeformat | charmap emoticons | spellchecker | template restoredraft insertfile | post_block_top post_block_bottom",
    rel_list : [
        {title: 'Do Follow', value: 'dofollow'},
        {title: 'No Follow', value: 'nofollow'}
    ],
    // paste_as_text: true,
    menubar: false,
    element_format: 'html',
    extended_valid_elements: "iframe[src|width|height|name|align], embed[width|height|name|flashvars|src|bgcolor|align|play|loop|quality|allowscriptaccess|type|pluginspage]",
    toolbar_items_size: 'small',
    relative_urls: false,
    remove_script_host: true,
    convert_urls: true,
    verify_html: false,
    style_formats: [
        {title: 'Bold text', inline: 'b'},
        {title: 'Red text', inline: 'span', styles: {color: '#ff0000'}},
        {title: 'Red header', block: 'h1', styles: {color: '#ff0000'}},
        {title: 'Example 1', inline: 'span', classes: 'example1'},
        {title: 'Example 2', inline: 'span', classes: 'example2'},
        {title: 'Table styles'},
        {title: 'Table row 1', selector: 'tr', classes: 'tablerow1'}
    ]
}

tinymce.init(option_TinyMCE);