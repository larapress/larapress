tinymce.init({
    selector: ".HTMLeditor",
    file_browser_callback: '',
    theme: "modern",
    plugins: [
        "advlist autolink lists link image charmap print preview hr anchor pagebreak",
        "searchreplace wordcount visualblocks visualchars code fullscreen",
        "insertdatetime media nonbreaking save table contextmenu directionality",
        "emoticons template paste textcolor"
    ],
    toolbar1: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",
    toolbar2: "print preview media | forecolor backcolor emoticons hr",
    image_advtab: true,
    templates: [
        {title: 'Test template 1', content: 'Test 1'},
        {title: 'Test template 2', content: 'Test 2'}
    ],
    style_formats: [
        {title: 'Headers', items: [
            {title: 'Header 1', format: 'h1'},
            {title: 'Header 2', format: 'h2'},
            {title: 'Header 3', format: 'h3'},
            {title: 'Header 4', format: 'h4'},
            {title: 'Header 5', format: 'h5'},
            {title: 'Header 6', format: 'h6'}
        ]},
        {title: 'Inline', items: [
            {title: 'Bold', icon: 'bold', format: 'bold'},
            {title: 'Italic', icon: 'italic', format: 'italic'},
            {title: 'Underline', icon: 'underline', format: 'underline'},
            {title: 'Strikethrough', icon: 'strikethrough', format: 'strikethrough'},
            {title: 'Superscript', icon: 'superscript', format: 'superscript'},
            {title: 'Subscript', icon: 'subscript', format: 'subscript'},
            {title: 'Code', icon: 'code', format: 'code'}
        ]},
        {title: 'Blocks', items: [
            {title: 'Paragraph', format: 'p'},
            {title: 'Blockquote', format: 'blockquote'},
            {title: 'Div', format: 'div'},
            {title: 'Pre', format: 'pre'}
        ]},
        {title: 'Alignment', items: [
            {title: 'Left', icon: 'alignleft', format: 'alignleft'},
            {title: 'Center', icon: 'aligncenter', format: 'aligncenter'},
            {title: 'Right', icon: 'alignright', format: 'alignright'},
            {title: 'Justify', icon: 'alignjustify', format: 'alignjustify'}
        ]},
        {title: 'Image Size', items: [
            {title: 'Full Width', selector: 'img', classes: 'full-width'},
            {title: 'Half Width', selector: 'img', classes: 'half-width'},
            {title: 'Quarter Width', selector: 'img', classes: 'quarter-width'},
            {title: 'Third Width', selector: 'img', classes: 'third-width'},
            {title: 'No Text Wrap', selector: 'img', classes: 'no-wrap'}
        ]},
        {title: 'Image Location', items: [
            {title: 'Left', selector: 'img', classes: 'img-left'},
            {title: 'Right', selector: 'img', classes: 'img-right'},
            {title: 'Center', selector: 'img', classes: 'img-no-wrap'}
        ]}
    ]
});
