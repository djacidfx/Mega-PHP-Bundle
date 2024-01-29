tinymce.init({
	selector: "#item_message",
	setup : function(ed) {
                  ed.on('change', function(e) {
                     // This will print out all your content in the tinyMce box
                     console.log('the content '+ed.getContent());
                     // Your text from the tinyMce box will now be passed to your  text area ... 
                     $("#item_message").text(ed.getContent()); 
                  });
            },
	plugins: "code image textcolor paste advlist autolink lists link image charmap print preview anchor",
	toolbar: 'code | forecolor  | paste | insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link | image',
    image_dimensions: false,
         image_class_list: [
            {title: 'Responsive', value: 'img-fluid'}
        ],
    relative_urls : false,
    remove_script_host : false,
    convert_urls : true,
	menubar:false,
    statusbar: false,
	content_style: ".mce-content-body {font-size:15px;font-family:Arial,sans-serif;}",
	height: 400,
	width: "100%"
});

tinymce.init({
	selector: ".new_txtarea",
	setup : function(eds) {
                  eds.on('change', function(e) {
                     // This will print out all your content in the tinyMce box
                     console.log('the content '+eds.getContent());
                     // Your text from the tinyMce box will now be passed to your  text area ... 
                     $(".new_txtarea").text(eds.getContent()); 
                  });
            },
	plugins: "code image textcolor paste advlist autolink lists link image charmap print preview anchor",
	toolbar: 'forecolor  | paste | insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link | image',
    image_dimensions: false,
         image_class_list: [
            {title: 'Responsive', value: 'img-fluid'}
        ],
    relative_urls : false,
    remove_script_host : false,
    convert_urls : true,
	menubar:false,
    statusbar: false,
	content_style: ".mce-content-body {font-size:15px;font-family:Arial,sans-serif;}",
	height: 400,
	width: "100%"
});

