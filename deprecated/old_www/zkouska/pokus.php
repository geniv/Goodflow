<?php
echo
"<script type=\"text/javascript\">
var poz = 0;
function RoztocBuben()
{
document.getElementById('bub').style.top = poz;
poz++;

if (poz == 300)
{
  poz = 0;
}

window.setTimeout('RoztocBuben()', 5);
}
</script>

<div style=\"width: 100; height: 50;\">
<img src=\"buben.bmp\" style=\"position: absolute;\" id=\"bub\" />
</div>

<br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
<br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
<input type=\"button\" value=\"toc\" onclick=\"RoztocBuben();\">

";
?>
