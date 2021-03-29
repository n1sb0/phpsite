<?php

session_start();

if (isset($_SESSION["userId"])) {   //Se è definita la chiave 'userId' della sessione significa che l'utente è gia loggato
    header('Location: index.php');  //quindi verrà rediretto verso la pagina index 
    exit();
}

if (isset($_GET['user']) && isset($_GET['pass'])) {

    $user = $_GET['user'];
    $pass = $_GET['pass'];

    if ($user != "" && $pass != "")

        read_from_db($user, $pass);
    else echo "<br><p style='color:red;font-size:2.0em'>Inserire nome utente e password</p>";
}


function read_from_db($u, $p)
{

    $servername = "localhost";
    $username = "root";
    $password = "qwerty123";
    $dbname = "world";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT * FROM User where username='" . $u . "' AND password='" . $p . "'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $_SESSION["userId"] = $row['id'];  //Se l'utente esiste e quindi si può considerare che abbia effettuato l'accesso
        //allora imposto la chiave 'userId' della sessione proprio con l'id dell'utente
        header('Location: index.php');  //quindi verrà rediretto verso la pagina index 
        exit();

        echo "<br><p style='color:green;font-size:2.0em'>benvenuto " . $row['nome'] . " !!!</p>";
    } else {
        echo "<br><p style='color:red;font-size:2.0em'>Utente inesistente</p>";
    }
}
?>

<html>

<head>
    <style>
        div,
        p {
            margin-left: 50px;
            margin-top: 20px;
            display: inline-block;
        }

        #main {
            width: 200px;
        }
    </style>
</head>

<body>
    <div id="main">
        <form>
            <div> Username:<input type='text' name='user'></div>
            <div> Password:<input type='text' name='pass'></div>
            <div> <input type='submit' value='Login'></div>
        </form>
    </div>
</body>

</html>