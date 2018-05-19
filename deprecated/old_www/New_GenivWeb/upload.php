<?

// Skript, ktery uploaduje (nahrava) soubory na server. Skript je potreba
// umistit do adresare /www . Nahravani souboru probiha do adresare /data ,
// ktery neni pristupny pomoci URL, ale pouze pres FTP. Pokud bude skript
// umisten jinde nez v adresari /www , tak je potreba take ve skriptu
// upravit cestu k adresari /data : ../Data/

if ($akce == "Upload") {

    if (move_uploaded_file ($soubor, "../Data/$soubor_name")) {

      echo "Soubor $soubor_name o velikosti $soubor_size bajtù 

       byl uspesne uploadnut na server<BR>";
    }

    else {

      echo "Pri nahravani souboru doslo k chybe!<BR>";

    }
}

echo "<HR SIZE=1 NOSHADE>";
echo "Zadejte jmeno souboru";
echo "<FORM ACTION=upload.php METHOD=post ENCTYPE=multipart/form-data>";
echo "<INPUT TYPE=file NAME=soubor SIZE=30>";
echo "<INPUT TYPE=submit NAME=akce VALUE=Upload>";

?>