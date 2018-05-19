
function KontrolaFormatu(text, sablona, id, out_id)
{
  $.post("http://geniv-laptop/phplayout/modules/dynamic_user/ajax_form.php",
        "action=kontrola&text="+text+"&sablona="+sablona+"&id="+id,
          function(theResponse)
          {
            $("#"+out_id).html(theResponse);
          }
        );
}

function PorovnaniObsahu(idobsah1, idobsah2, out_id)
{
  var text1 = document.getElementById(idobsah1).value;
  var text2 = document.getElementById(idobsah2).value;

  $.post("http://geniv-laptop/phplayout/modules/dynamic_user/ajax_form.php",
        "action=porovnani&text1="+text1+"&text2="+text2,
          function(theResponse)
          {
            $("#"+out_id).html(theResponse);
          }
        );
}

function KontrolaEmalu(email, out_id)
{
  $.post("http://geniv-laptop/phplayout/modules/dynamic_user/ajax_form.php",
        "action=email&email="+email,
          function(theResponse)
          {
            $("#"+out_id).html(theResponse);
          }
        );
}

function KontrolaDuplicity(login, out_id)
{
  $.post("http://geniv-laptop/phplayout/modules/dynamic_user/ajax_form.php",
        "action=duplicita&login="+login,
          function(theResponse)
          {
            $("#"+out_id).html(theResponse);
          }
        );
}

function GetZeme(ip, tvar, out_id)
{
  $.post("http://geniv-laptop/phplayout/modules/dynamic_user/ajax_form.php",
        "action=getzeme&ip="+ip+"&tvar="+tvar,
          function(theResponse)
          {
            $("#"+out_id).html(theResponse);
          }
        );
}

function GetHostName(ip, out_id)
{
  $.post("http://geniv-laptop/phplayout/modules/dynamic_user/ajax_form.php",
        "action=gethostname&ip="+ip,
          function(theResponse)
          {
            $("#"+out_id).html(theResponse);
          }
        );
}

function GetLoginHistory(id, prava, tvar, out_id)
{
  $.post("http://geniv-laptop/phplayout/modules/dynamic_user/ajax_form.php",
        "action=getloginhistory&id="+id+"&prava="+prava+"&tvar="+tvar,
          function(theResponse)
          {
            $("#"+out_id).html(theResponse);
          }
        );
}
