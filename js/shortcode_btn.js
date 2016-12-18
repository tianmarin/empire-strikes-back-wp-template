/*global tinymce*/
/*global tinyMCE*/
jQuery(document).ready(function() {
	tinymce.create('tinymce.plugins.esb_subpages_plugin', {
		init : function(ed, url) {
			// Register command for when button is clicked
			ed.addCommand('esb_subpages_insert_shortcode', function() {
				var selected = tinyMCE.activeEditor.selection.getContent();
				var content;
				if( selected ){
					//If text is selected when button is clicked
					//Wrap shortcode around it.
					content = ''+selected+'[subpages]';
				}else{
					content =  '[subpages]';
				}
				tinymce.execCommand('mceInsertContent', false, content);
			});
			// Register buttons - trigger above command when clicked
			ed.addButton('esb_subpages_button', {
				title : 'Agregar bloque de subpaginas',
				cmd : 'esb_subpages_insert_shortcode',
				icon : 'newdocument',
				//image: url + '/path/to/image.png'
			});
			window.console.log(url);
		},   
	});

	// Register our TinyMCE plugin
	// first parameter is the button ID1
	// second parameter must match the first parameter of the tinymce.create() function above
	tinymce.PluginManager.add('esb_subpages_button', tinymce.plugins.esb_subpages_plugin);
});