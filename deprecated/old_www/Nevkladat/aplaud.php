<HTML>
<HEAD><TITLE>Upload</TITLE></HEAD>
<BODY>

<?

if (!Empty($akce) and $akce == "Upload") 
{
 if (copy($soubor,$soubor_name)) 
 {  //zdroj,kam
 print "Soubor <b>$soubor_name</b> o velikosti <b>$soubor_size</b> bajt� 
 byl �sp�n� uploadnut na server<BR>";
 }
 else
 {
 print "P�i nahr�v�n� souboru do�lo k chyb�!<BR>";
 }
}
?>


<HR SIZE="1" NOSHADE>

Zadejte jm�no souboru:
<FORM METHOD="post" ENCTYPE="multipart/form-data">
<INPUT TYPE="file" NAME="soubor" SIZE="30">
<INPUT TYPE="submit" NAME="akce" VALUE="Upload">
</FORM>

</BODY>
</HTML>
