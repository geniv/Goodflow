<?

if (($filen <> "")&&($filen <> "none")):

$ftp_server       = "fugess.trainz.cz";
$ftp_user_name    = "jedisoft_fugess";
$ftp_user_pass    = "siemens";


$source_file      = $filen;
$destination_dir  = Explode(".",$filen_name);
$destination_dir[0] = "";
$destination_dir  = "./jds/ftp/".$destination_dir[0];
$destination_file = $destination_dir.$filen_name;

echo "MIME TYPE: ".$filen_type."<br>";
echo "Size: ".$filen_size." B<br>";

// set up basic connection
$conn_id = ftp_ssl_connect($ftp_server); 

// login with username and password
$login_result = ftp_login($conn_id, $ftp_user_name, $ftp_user_pass); 

// check connection
$mode = ftp_pasv($conn_id, TRUE);
if (!$conn_id || !$login_result || !$mode)
 { 
        echo "<br>FTP connection has failed!";
        echo "<br>Attempted to connect to ".$ftp_server." for user ".$ftp_user_name; 
        exit; 
    } else {
        echo "<br>Connected to $ftp_server, for user $ftp_user_name";
    }


// try to create the directory $dir
if (@ftp_mkdir($conn_id, $destination_dir)) {
 echo "<br>successfully created ".$destination_dir."\n";
} else {
 echo "<br>There was a problem while creating".$destination_dir."\n";
}

// upload the file
$upload = ftp_put($conn_id, $destination_file, $source_file, FTP_BINARY); 

// check upload status
if (!$upload) { 
        echo "<br>FTP upload has failed!";
    } else {
        echo "<br>Uploaded $source_file to $ftp_server as $destination_file (".ftp_size($conn_id,$destination_file)." B)";
    }
echo "<br>***<br>";
$dir = ftp_nlist($conn_id, $destination_dir);

foreach ($dir as $file):
  if(@ftp_size($conn_id,$file) == -1):
     echo "<br>[".StrToUpper($file)."]";
    else:
     echo "<br>".$file." - ".@ftp_size($conn_id,$file);
  endif;
endforeach;

// output $contents
echo "<br>***<br>";


// close the FTP stream 
ftp_close($conn_id); 

endif;

?>
<body>
<form name="reip" method="post" enctype="multipart/form-data">
 <input type="file" name="filen" size="10">
 <input type="submit" value="Upload">
</form>
</body>