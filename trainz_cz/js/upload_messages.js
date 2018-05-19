  tinymce.init({
    selector: ".obal_upload_sekce .obal_upload_message textarea.tiny-upload",
    language: 'cs',
    autoresize_on_init: false,
    autoresize_bottom_margin: 15,
    autoresize_min_height: 200,
    autoresize_max_height: 500,
    height: 200,
    menubar: false,
    resize: true,
    paste_as_text: true,
      plugins: [
        "advlist autolink lists link preview wordcount autoresize contextmenu paste"
      ],
    toolbar: "undo redo | bold italic underline strikethrough superscript subscript | bullist numlist outdent indent | preview",
    contextmenu: "undo redo | link removeformat"
  });

  $("select.upload-select2").select2();
