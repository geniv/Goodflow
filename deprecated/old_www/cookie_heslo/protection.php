<?

$user_passwords = array (
	// sem mùžete zadat uživatele a heslo 

	"Jan" => "Novak", 
	"user2" => "password2",
	"user3" => "password3",
	"user4" => "password4"
	);

$logout_page = "logout.php";

$login_page = "login.php";

$invalidlogin_page = "invalidlogin.php";



if ($action == "logout")
{
	Setcookie("logincookie[pwd]","",time() -86400);
	Setcookie("logincookie[user]","",time() - 86400);
	include($logout_page);
	exit;
}
else if ($action == "login")
{
	if (($loginname == "") || ($password == ""))
	{
		include($invalidlogin_page);
		exit;
	}
	else if (strcmp($user_passwords[$loginname],$password) == 0)
	{
		Setcookie("logincookie[pwd]",$password,time() + 86400);
		Setcookie("logincookie[user]",$loginname,time() + 86400);
	}
	else
	{
		include($invalidlogin_page);
		exit;
	}
}
else
{
	if (($logincookie[pwd] == "") || ($logincookie[user] == ""))
	{
		include($login_page);
		exit;
	}
	else if (strcmp($user_passwords[$logincookie[user]],$logincookie[pwd]) == 0)
	{
		Setcookie("logincookie[pwd]",$logincookie[pwd],time() + 86400);
		Setcookie("logincookie[user]",$logincookie[user],time() + 86400);
	}
	else
	{
		include($invalidlogin_page);
		exit;
	}
}
?>