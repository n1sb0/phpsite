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
            <div> Nome:<input type='text' name='nominativo'></div>
            <div> Cognome:<input type='text' name='cognome'></div>
            <div> Username:<input type='text' name='user'></div>
            <div> Password:<input type='text' name='password'></div>

            <div> <input type='submit' value='Regist'></div>

        </form>
    </div>
</body>

</html>

<?php

if (isset($_SESSION["userId"])) {   //Se è definita la chiave 'userId' della sessione significa che l'utente è gia loggato
    header('Location: index.php');  //quindi verrà rediretto verso la pagina index 
    exit();
} else {

    function write_to_db($n, $c, $u, $p)
    {

        $servername = "localhost";
        $username = "root";
        $password = "qwerty123";
        $dbname = "world";


        // Crea connessione al Database
        $conn = new mysqli($servername, $username, $password, $dbname);
        // Controlla eventuali errori nella connessione
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "INSERT INTO user (username,password,nome,cognome)values ('" . $u . "','" . $p . "','" . $n . "','" . $c . "')";
        $result = $conn->query($sql);

        if ($result === TRUE) {

            echo "<br><p style='color:green;font-size:2.0em'>Registrazione effettuata con successo!</p>";
        } else {
            echo "<br><p style='color:red;font-size:2.0em'>Errore di registrazione </p>";
        }
    }

    if (isset($_GET['nominativo']) && isset($_GET['cognome']) && isset($_GET['user']) && isset($_GET['password'])) {

        $nome = $_GET['nominativo'];
        $cognome = $_GET['cognome'];
        $user = $_GET['user'];
        $pass = $_GET['password'];

        if ($user != "" && $pass != "" && $nome != "" && $cognome != "")

            write_to_db($nome, $cognome, $user, $pass);

        else echo "<br><p style='color:red;font-size:2.0em'>Inserire i dati per la registrazione </p>";
    }
}
?>