<?php

<script language=\"JavaScript\">
function cas()
{
cas = new Date()
h=cas.getHours();
m=cas.getMinutes();
cas.innerText=\"�as: \"+h+\":\"+m;
}
</sctipt>

<meta http-equiv=\"refresh\" content=\"2;url=pisnicka.mid\">



function datum()
{
if(date("n")=="1"){$mes="Leden";}
if(date("n")=="2"){$mes="�nor";}
if(date("n")=="3"){$mes="B�ezen";}
if(date("n")=="4"){$mes="Duben";}
if(date("n")=="5"){$mes="Kv�ten";}
if(date("n")=="6"){$mes="�erven";}
if(date("n")=="7"){$mes="�ervenec";}
if(date("n")=="8"){$mes="Srpen";}
if(date("n")=="9"){$mes="Z���";}
if(date("n")=="10"){$mes="��jen";}
if(date("n")=="11"){$mes="Listopad";}
if(date("n")=="12"){$mes="Prosinec";}

return "Dnes je: ".date("j").". $mes, ".date("Y");
}

//H:i

?>
