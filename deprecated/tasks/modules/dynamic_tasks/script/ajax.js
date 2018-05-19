
//vyhledani uzivatele do naseptavace
function SearchUser(text, tvar, user_in, user_out, out_id)
{
  $('#'+out_id).fadeIn('slow');
  $.post("http://geniv-asus/tasks/modules/dynamic_tasks/ajax_form.php",
        "action=searchuser&text="+text+"&tvar="+tvar+"&user_in="+user_in+"&user_out="+user_out+"&out="+out_id,
          function(theResponse)
          {
            $("#"+out_id).html(theResponse);
          }
        );
}

//vlozeni textu do formulare z naseptavace
function InsertSearchUser(in_id, login, vystup, out_id, user)
{
  $('#'+vystup).fadeOut('slow');
  $('#'+in_id).val(login);
  $('#'+out_id).val(user);
}


//vyhledani uzivatele do naseptavace
function SearchTym(text, tvar, login, id_out, out_id)
{
  $('#'+out_id).fadeIn('slow');
  $.post("http://geniv-asus/tasks/modules/dynamic_tasks/ajax_form.php",
        "action=searchtym&text="+text+"&tvar="+tvar+"&login="+login+"&id_out="+id_out+"&out="+out_id,
          function(theResponse)
          {
            $("#"+out_id).html(theResponse);
          }
        );
}

//vlozeni textu do formulare z naseptavace
function InsertSearchTym(in_id, login, vystup, out_id, user)
{
  $('#'+vystup).fadeOut('slow');
  $('#'+in_id).val(login);
  $('#'+out_id).val(user);
}


//zjisteni nazvu zeme
function GetZeme(ip, tvar, out_id)
{
  $.post("http://geniv-asus/tasks/modules/dynamic_tasks/ajax_form.php",
        "action=getzeme&ip="+ip+"&tvar="+tvar,
          function(theResponse)
          {
            $("#"+out_id).html(theResponse);
          }
        );
}

//zjisteni hostu
function GetHostName(ip, out_id)
{
  $.post("http://geniv-asus/tasks/modules/dynamic_tasks/ajax_form.php",
        "action=gethostname&ip="+ip,
          function(theResponse)
          {
            $("#"+out_id).html(theResponse);
          }
        );
}
