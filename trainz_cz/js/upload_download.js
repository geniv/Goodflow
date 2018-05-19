  $(".upload-img-fancy").fancybox({
    helpers: {
      title: {
        type: 'inside'
      },
      overlay: {
        speedOut: 0
      }
    }
  });

  tinymce.init({
    selector: ".obal_upload_sekce .obal_upload_download textarea.tiny-upload",
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

  function typKuidu(value) {
    if (value.split(':').length > 1) {
      return '&lt;' + (value.split(':').length == 2 ? 'kuid' : 'kuid2') +  ':' + value + '&gt;';
    } else {
      return '&lt;kuid(2):(-)xxxxx:yyyyy(:zzz)&gt;';
    }
  }

  function isKuid(value) {
    var patr = /-?[0-9]+:[0-9]+(?::[0-9]+)?/;
    var m = patr.exec(value);
    return m && value == m[0];
  }

  function in_array(needle, haystack) {
    for(var i in haystack) {
        if(haystack[i] == needle) return true;
    }
    return false;
  }

  // inicializace ciselne validace
  function initValidation() {
    $('.kuid_input_plain').numberMask({pattern:/^[\-0-9\:\n]+$/});
    $.fn.autosize && $('.autosize').autosize();
  }

  // hromadna validace kuidu
  function validateKuid(value, out_class) {
    var out = 'Formát: &lt;kuid(2):(-)xxxxx:yyyyy(:zzz)&gt;'; // defaultni format
    var invalid_poc = 0;
    if (value) {
      var value_split = value.split('\n');
      out = '';
      for (var v in value_split) {
        out += typKuidu(value_split[v]) + ' <em>→</em> '+ (isKuid(value_split[v]) ? '<i class="icon-ok-sign"></i>' : '<i class="icon-remove-sign"></i>') + '<br />';
        if (!isKuid(value_split[v])) {
          invalid_poc++;
        }
      }
    }
    $('.addeditbtn_dwn').attr('disabled', invalid_poc != 0);
    $(out_class).html(out);
  }


  function removeCDP(num) {
    $('.row'+num).remove();
    $.jGrowl("Byl odebrán Oddíl #"+ (num + 1) +"!", {
      position: "bottom-right"
    });
  }