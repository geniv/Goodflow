<?php
echo
"
<script type=\"text/javascript\">
function ajaxFunction()
{
var xmlHttp;
try
  {
  // Firefox, Opera 8.0+, Safari
    xmlHttp=new XMLHttpRequest();
  }
catch (e)
  {
  // Internet Explorer
  try
    {
      xmlHttp=new ActiveXObject(\"Msxml2.XMLHTTP\");
    }
  catch (e)
    {
    try
      {
        xmlHttp=new ActiveXObject(\"Microsoft.XMLHTTP\");
      }
    catch (e)
      {
        alert(\"Your browser does not support AJAX!\");
        return false;
      }
    }
  }
  xmlHttp.onreadystatechange=function()
    {
    if(xmlHttp.readyState==4)
      {
      document.myForm.time.value=xmlHttp.responseText;
      }
    }
  xmlHttp.open(\"GET\",\"time.php\",true);
  xmlHttp.send(null);
  }
</script>


<form name=\"myForm\">
Jméno: <input type=\"text\" name=\"username\" onkeyup=\"ajaxFunction();\" /><br />
Čas: <input type=\"text\" name=\"time\" />
</ form>
";
?>