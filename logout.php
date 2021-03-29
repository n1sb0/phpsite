<?php
session_start();

if (isset($_SESSION["userId"])) {   //se l'utente è loggato allora per eseguire il logout semplicemente distruggo la sessione o cancello la chiave "userId"
	session_destroy();
	//$_SESSION["userId"]=null;		//alternativa
}

header('Location: login.php');  //dopo il logout faccio il redirect verso il login
exit();
