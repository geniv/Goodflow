
function PrepisRewrite(text, ret)
{
roz = text.toString().replace(/\+/g, '|>plus<|');
roz = roz.replace(/\//g, '|>lom<|');
roz = roz.replace(/&/g, '|>amp<|');
roz = roz.replace(/"/g, '|>uvoz<|');
  $.post("modules/dynamic_central/ajax_form.php",
        "action=rewritename&text="+roz,
          function(theResponse)
          {
            $(ret).val(theResponse);
          }
        );
}

function NahledData(datum, format, dny, mesice, tvar, ret)
{
  $(function() {
    $.post("modules/dynamic_central/ajax_form.php",
          "action=gendate&datum="+datum+"&format="+format+"&dny="+dny+"&mesice="+mesice+"&tvar="+tvar,
            function(theResponse)
            {
              $(ret).html(theResponse);
            }
          );
  });
}

function NahledCasu(datum, format, ret)
{
  $(function() {
    $.post("modules/dynamic_central/ajax_form.php",
          "action=gentime&datum="+datum+"&format="+format,
            function(theResponse)
            {
              $(ret).html(theResponse);
            }
          );
  });
}

function NahledTextu(id, text, delka, zkraceni, ret)
{
  $(function() {
    $.post("modules/dynamic_central/ajax_form.php",
          "action=gentext&id="+id+"&text="+text+"&delka="+delka+"&zkraceni="+zkraceni,
            function(theResponse)
            {
              $(ret).html(theResponse);
            }
          );
  });
}

function OvereniExistence(cesta, ret)
{
  $(function() {
    $.post("modules/dynamic_central/ajax_form.php",
          "action=fileexists&cesta="+cesta,
            function(theResponse)
            {
              $(ret).html(theResponse);
            }
          );
  });
}

function ProjdiSlozku(name, cesta, data, ret)
{
  $(function() {
    $.post("modules/dynamic_central/ajax_form.php",
          "action=getdir&name="+name+"&cesta="+cesta+"&data="+data,
            function(theResponse)
            {
              $(ret).html(theResponse);
            }
          );
  });
}

function TypeUpload(value, blok, input, ret)
{
  $(function() {
    if (value == 'own' && value != blok)
    {
      $(ret).html(input); //vlozeni upload inputu
    }
      else
    {
      $(ret).html('');
      roz = value.split('x'); //rozdeleni podle x
      w = parseInt(roz[0]); //parsnuti velikosti
      h = parseInt(roz[1]);

      if (!isNaN(w) && !isNaN(h))
      {
        if (w == 0 && h == 0)
        {
          $(ret).html('<span class=\'popis-elementu\'><strong>Ponechá originální velikost</strong></span>');
          return;
        }

        if (w == 0)
        {
          $(ret).html('<span class=\'popis-elementu\'><strong>Délka se dopočítává, výška je nastavena</strong></span>');
          return;
        }

        if (h == 0)
        {
          $(ret).html('<span class=\'popis-elementu\'><strong>Délka je nastavena, výška se dopočítává</strong></span>');
          return;
        }

        if (w != 0 && h != 0)
        {
          $(ret).html('<span class=\'popis-elementu\'><strong>Délka je nastavena, výška je nastavena</strong></span>');
          return;
        }
      }
        else
      {
        if (value == 'own')
        {
          $(ret).html('<span class=\'popis-elementu\'><strong>Tato funkce je zakázána !</strong></span>');
          return;
        }
          else
        {
          roz1 = value.split('->');
          if (roz1[0] == 'own')
          {
            roz = roz1[1].split('x'); //rozdeleni podle x
            w = parseInt(roz[0]); //parsnuti velikosti
            h = parseInt(roz[1]);

            if (!isNaN(w) && !isNaN(h))
            {
              if (w == 0 && h == 0)
              {
                $(ret).html('<span class=\'popis-elementu\'><strong>Miniatura bude odstraněna a Ponechá originální velikost</strong></span>');
                return;
              }

              if (w == 0)
              {
                $(ret).html('<span class=\'popis-elementu\'><strong>Miniatura bude odstraněna a Délka se dopočítává, výška je nastavena</strong></span>');
                return;
              }

              if (h == 0)
              {
                $(ret).html('<span class=\'popis-elementu\'><strong>Miniatura bude odstraněna a Délka je nastavena, výška se dopočítává</strong></span>');
                return;
              }

              if (w != 0 && h != 0)
              {
                $(ret).html('<span class=\'popis-elementu\'><strong>Miniatura bude odstraněna a Délka je nastavena, výška je nastavena</strong></span>');
                return;
              }
            }
              else
            {
              $(ret).html('<span class=\'popis-elementu\'><strong>Miniatura bude odstraněna a Špatný zápis !</strong></span>');
              return;
            }
          }
            else
          {
            $(ret).html('<span class=\'popis-elementu\'><strong>Špatný zápis !</strong></span>');
            return;
          }
        }
      }
    }
  });
}