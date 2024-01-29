tinymce.init({
	selector: "#item_message",
	setup : function(ed) {
                  ed.on('change', function(e) {
                     // Your text from the tinyMce box will now be passed to your  text area ... 
                     $("#item_message").text(ed.getContent()); 
                  });
            },
	plugins: "image  paste advlist autolink lists link image charmap print preview anchor",
	toolbar: 'paste | insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link | image',
    image_dimensions: false,
         image_class_list: [
            {title: 'Responsive', value: 'img-fluid'}
        ],
    relative_urls : false,
    remove_script_host : false,
    convert_urls : true,
	menubar:false,
    statusbar: false,
    skin: "oxide-dark",
    content_css: "dark",
	content_style: ".mce-content-body {font-size:15px;font-family:Arial,sans-serif;}",
	height: 400,
	width: "100%"
});


