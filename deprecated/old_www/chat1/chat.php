<!doctype html public "-//w3c//dtd html 3.2//en">
    <!-- 
    /* 	This chat has been created by Nicola Delbono <key5@key5.com>			*/
    /*	you can modify and/or use the code for free. Pleeease keep these three lines	*/
    /*	into your customized chat										*/
    -->
    <!-- Tested on WinNT4.0 SP4 -->
    <html>
    <head>
    <title>Php3 chat</title>
    <meta name="GENERATOR" content="Arachnophilia 4.0">
    <meta name="FORMATTER" content="Arachnophilia 4.0">
    <!-- Arachnophilia is free but !careware! -->
    <!-- http://www.arachnoid.com/arachnophilia/index.html -->
    </head>
    <body bgcolor="#ffffff" text="#000000" link="#0000ff" vlink="#800080" alink="#ff0000">
    <?
    $person = str_replace ("\n"," ", $person);
    $person = str_replace ("<", " ", $person);
    $person = str_replace (">", " ", $person);
    $person = stripslashes ($person);
    ?>
    <form action="chat.php3" method="post">
    Nickname: <input type="text" name="person" size="40" maxlength="80" value="<? echo $person; ?>"><br>
    Your message: <textarea name="message" rows="3" cols="40"></textarea>
    <input type="submit" value="Send/refresh">
    </form>
    <?
    /*	the $chat_file_ok is a txt file (or whatever else) I use for				*/
    /*	messages storage										*/
    $chat_file_ok = "msg.txt";
    /*	$chat_lenght is the number of messages displayed				*/
    $chat_lenght = 10;
    /*	$max_file_size is the maximum file size the msg.txt file can reach		*/
    /*	assuming that any chatter doesn't write a message longer than		*/
    /*	$max_single_msg_lenght (this case: 100,000 bytes = 100Kb)		*/
    $max_single_msg_lenght = 100000;
    $max_file_size = $chat_lenght * $max_single_msg_lenght;
    /* check if file size is over maximum	(set with $max_file_size )			*/
    $file_size= filesize($chat_file);
    /*	if file size is more than allowed then							*/
    /*			reads last $chat_lenght messages (last lines of msg.txt file)	*/
    /*			and stores them in $lines array						*/
    /*			then deletes the "old" msg.txt file and create a new msg.txt	*/
    /*			pushing the "old" messages stored in $lines array into the	*/
    /*			"new" msg.txt file using $msg_old.					*/
    /*		Note: this is done in order to avoid huge msg.txt file size.		*/
    			
    if ($file_size > $max_file_size) {
    /* reads file and stores each line $lines' array elements	*/
    $lines = file($chat_file_ok);
    /*get number of lines								*/
    $a = count($lines);
    $u = $a - $chat_lenght;
    for($i = $a; $i >= $u ;$i--){
    		$msg_old = $lines[$i] . $msg_old;
    	}
    $deleted = unlink($chat_file_ok);
    $fp = fopen($chat_file_ok, "a+");
    $fw = fwrite($fp, $msg_old);
    fclose($fp);
    }
    /* the following is because every message has to be		*/
    /* placed into one single line in the msg.txt file.			*/
    /* You can render \n (new lines) with "<br>" html tag anyway.	*/
    $msg = str_replace ("\n"," ", $message);
    /*	if the user writes something...					*/
    /*		the new message is appended to the msg.txt file	*/
    /*	REMEMBER: the message is appended, hence, if 	*/
    /*		you want the last message to be displayed as the	*/
    /*		 first one, you have to 					*/
    /*		1. store the lines (messages) into the array		*/
    /*		2. read the array in reverse order				*/
    /*		3. post the messages in the output file (the chat)	*/
    /* I added these three lines in order to avoid buggy html code and slashes	*/
    $msg = str_replace ("\n"," ", $message);
    $msg = str_replace ("<", " ", $msg);
    $msg = str_replace (">", " ", $msg);
    $msg = stripslashes ($msg);		
    if ($msg != ""){
    $fp = fopen($chat_file_ok, "a+");
    $fw = fwrite($fp, "\n<b>$person :</b> $msg<br>");
    fclose($fp);
    }
    $lines = file($chat_file_ok);
    $a = count($lines);
    $u = $a - $chat_lenght;
    /*	reads the array in reverse order and outputs to chat	*/
    for($i = $a; $i >= $u ;$i--){
    		echo $lines[$i] . "<hr>";
    	}
    ?>
    </body>
    </html>