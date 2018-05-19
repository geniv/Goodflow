
  function UlozitHodnotu(id, value, ret)
  {
roz = value.toString().replace(/\+/g, '|>plus<|');
roz = roz.replace(/\//g, '|>lom<|');
roz = roz.replace(/&/g, '|>amp<|');
roz = roz.replace(/"/g, '|>uvoz<|');

    $.post("modules/dynamic_config/ajax_form.php",
      "action=savevalue&id="+id+"&value="+roz,
        function(theResponse)
        {
          $(ret).html(theResponse);
        }
      );
      ZpracujHlasku(ret);
  }

  function ZpracujHlasku(ret)
  {
    $(ret).fadeIn('slow').delay(2000).fadeOut('slow');
  }