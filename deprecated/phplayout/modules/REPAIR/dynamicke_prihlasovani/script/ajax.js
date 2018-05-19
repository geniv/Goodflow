
  function PreviewPrefix(text, ret)
  {
    $.post("http://geniv-asus/phplayout/modules/dynamicke_prihlasovani/ajax_form.php",
      "action=testprefix&text="+text,
        function(theResponse)
        {
          $(ret).html(theResponse);
        }
      );
  }

  function AktualniKapacita(id, typ, tvar, ret)
  {
    $.post("http://geniv-asus/phplayout/modules/dynamicke_prihlasovani/ajax_form.php",
      "action=currcap&id="+id+"&typ="+typ+"&tvar="+tvar,
        function(theResponse)
        {
          $(ret).html(theResponse);
        }
      );
  }

  function GetZeme(ip, tvar, ret)
  {
    $.post("http://geniv-asus/phplayout/modules/dynamicke_prihlasovani/ajax_form.php",
          "action=getzeme&ip="+ip+"&tvar="+tvar,
            function(theResponse)
            {
              $(ret).html(theResponse);
            }
          );
  }

  function GetHostName(ip, ret)
  {
    $.post("http://geniv-asus/phplayout/modules/dynamicke_prihlasovani/ajax_form.php",
          "action=gethostname&ip="+ip,
            function(theResponse)
            {
              $(ret).html(theResponse);
            }
          );
  }

  var globret;
  function NastavHodnotu(id, val, ret)
  {
    $.post("http://geniv-asus/phplayout/modules/dynamicke_prihlasovani/ajax_form.php",
          "action=setvalue&id="+id+"&val="+val,
            function(theResponse)
            {
              $(ret).html(theResponse);
              globret = ret;
              setTimeout("SchovejHlasku()", 3000);
              if (val)
              {
                $('#registrovani_uzivatele_id_'+id).addClass(' zucastneny_uzivatel');
              }
                else
              {
                $('#registrovani_uzivatele_id_'+id).removeClass(' zucastneny_uzivatel');
              }
            }
          );
          ZobrazHlasku(ret);
  }

  function ZobrazHlasku(ret)
  {
    $(function() {
      $(ret).fadeIn('slow');
    });
  }

  function SchovejHlasku(ret)
  {
    if (ret == null)
    {
      ret = globret;
    }

    $(function() {
      $(ret).fadeOut('slow');
    });
  }
