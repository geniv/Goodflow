
function PrepisRewrite(text, ret)
{
roz = text.toString().split('+');
roz = roz.join('|>plus<|');
roz = roz.split('&');
roz = roz.join('|>amp<|');
roz = roz.split('"');
roz = roz.join('|>uvoz<|');
  $.post("modules/dynamic_eshop/ajax_form.php",
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
    $.post("modules/dynamic_eshop/ajax_form.php",
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
    $.post("modules/dynamic_eshop/ajax_form.php",
          "action=gentime&datum="+datum+"&format="+format,
            function(theResponse)
            {
              $(ret).html(theResponse);
            }
          );
  });
}

function NahledTextu(text, delka, zkraceni, ret)
{
  $(function() {
    $.post("modules/dynamic_eshop/ajax_form.php",
          "action=gentext&text="+text+"&delka="+delka+"&zkraceni="+zkraceni,
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
      roz = value.split('x');
      w = parseInt(roz[0]); //parsnuti velikosti
      h = parseInt(roz[1]);

      if (!isNaN(w) && !isNaN(h))
      {
        if (w == 0 && h == 0)
        {
          $(ret).html('<strong>Ponechá originální velikost</strong>');
          return;
        }

        if (w == 0)
        {
          $(ret).html('<strong>Délka se dopočítává, výška je nastavena</strong>');
          return;
        }

        if (h == 0)
        {
          $(ret).html('<strong>Délka je nastavena, výška se dopočítává</strong>');
          return;
        }

        if (w != 0 && h != 0)
        {
          $(ret).html('<strong>Délka je nastavena, výška je nastavena</strong>');
          return;
        }
      }
        else
      {
        if (value == 'own')
        {
          $(ret).html('<strong>Tato funkce je zakázána !</strong>');
          return;
        }
          else
        {
          $(ret).html('<strong>Špatný zápis !</strong>');
          return;
        }
      }
    }
  });
}
                  