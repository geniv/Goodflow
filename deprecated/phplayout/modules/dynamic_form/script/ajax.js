
  function KontrolaFormatu(text, id, ret)
  {
    $.post("http://geniv-asus/phplayout/modules/dynamic_form/ajax_form.php",
      "action=kontrola&text="+text+"&id="+id,
        function(theResponse)
        {
          $(ret).html(theResponse);
          if (theResponse == 'dobre')
          {
            $(ret+'_fin').css('color', '#000');
          }
            else
          {
            $(ret+'_fin').css('color', '#ff0000');
          }
        }
      );
  }
                  