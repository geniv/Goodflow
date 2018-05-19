<HTML>
<HEAD><TITLE>Upload</TITLE></HEAD>
<BODY>

<?

if (!Empty($akce) and $akce == "Upload") 
{
 if (copy($soubor,$soubor_name)) 
 {  //zdroj,kam
 print "Soubor <b>$soubor_name</b> o velikosti <b>$soubor_size</b> bajtù 
 byl úspìšnì uploadnut na server<BR>";
 }
 else
 {
 print "Pøi nahrávání souboru došlo k chybì!<BR>";
 }
}
?>


<HR SIZE="1" NOSHADE>

Zadejte jméno souboru:
<FORM METHOD="post" ENCTYPE="multipart/form-data">
<INPUT TYPE="file" NAME="soubor" SIZE="30">
<INPUT TYPE="submit" NAME="akce" VALUE="Upload">
</FORM>

</BODY>
</HTML>
