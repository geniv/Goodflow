
  function GetZeme(ip, tvar, ret)
  {
    $.post("ajax_funkce.php",
          "action=getzeme&ip="+ip+"&tvar="+tvar,
            function(theResponse)
            {
              $(ret).html(theResponse);
            }
          );
  }

  function GetHostName(ip, ret)
  {
    $.post("ajax_funkce.php",
          "action=gethostname&ip="+ip,
            function(theResponse)
            {
              $(ret).html(theResponse);
            }
          );
  }

  function GetSize(cesta, ret)
  {
    $.post("ajax_funkce.php",
          "action=getsize&cesta="+cesta,
            function(theResponse)
            {
              $(ret).html(theResponse);
            }
          );
  }

  function GetAdrSize(cesta, rek, ret)
  {
    $.post("ajax_funkce.php",
          "action=getadrsize&cesta="+cesta+"&rek="+rek,
            function(theResponse)
            {
              $(ret).html(theResponse);
            }
          );
  }

  function GetAvgSize(cesta, rek, ret)
  {
    $.post("ajax_funkce.php",
          "action=getavgsize&cesta="+cesta+"&rek="+rek,
            function(theResponse)
            {
              $(ret).html(theResponse);
            }
          );
  }

  function GetValue(key, ret)
  {
    $.post("ajax_funkce.php",
          "action=getvalue&key="+key,
            function(theResponse)
            {
              $(ret).html(theResponse);
            }
          );
  }

  function GetModulUpdate(include, classa, ret)
  {
    $.post("ajax_funkce.php",
      "action=getmoduleupdate&include="+include+"&class="+classa,
        function(theResponse)
        {
          $(ret).html(theResponse);
        }
      );
  }

  function SetPermit(id, adresa, stav, ret)
  {
    $.post("ajax_funkce.php",
          "action=setpermit&id="+id+"&adresa="+adresa+"&stav="+stav,
            function(theResponse)
            {
              $(ret).html(theResponse);
              ZpracujHlasku(ret);
            }
          );
  }

  function ZpracujHlasku(ret)
  {
    $(ret).fadeIn('slow').delay(2000).fadeOut('slow');
  }

  function Hodiny(ret, obnova)
  {
    window.setInterval(function(){
      $.post("ajax_funkce.php",
        "action=cas",
          function(theResponse)
          {
            $(ret).html(theResponse);
          }
        );
    }, obnova);
  }