<html>

<head>
    <title><?php echo "Titolo della pagina"; ?></title>
</head>

<body>
    Sono le ore <?php echo date('H:i'); ?> del giorno <?php echo date('d/m/Y'); ?>.
    <br>
</body>

</html>

<?php
session_start();
if (isset($_SESSION["userId"])) {

    $servername = "localhost";
    $username = "root";
    $password = "qwerty123";
    $dbname = "world";
    $nome = "";

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    if (isset($_GET['nome'])) {
        $nome = $_GET["nome"];
        $sql = "UPDATE user SET nome='$nome' WHERE id=" . $_SESSION["userId"] . "";
        $result = $conn->query($sql);
    } else {
        $sql = "SELECT * FROM User where id=" . $_SESSION["userId"] . "";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $nome = $row['nome'];
        }
    }

    echo "<br><p style='color:red;font-size:2.0em'>Benvenuto " . $nome . " !!!</p>";
    echo "<br><form><p style ='color:green; font-size:1.0em'> Cambia nome: <input type='text' name='nome'> <input type='submit' value='Cambia'></p></form>";
    echo "<a href='messaggi.php' style='color:blue;font-size:1.5em'>Scrivi un messaggio</a> <br>";
    echo "<a href='logout.php' style='color:blue;font-size:2.0em'>Logout</a>";
} else {
    echo "<br><p style='color:red;font-size:2.0em'>Ciao Utente Anonimo</p>";
    echo "<a href='login.php' style='color:blue;font-size:2.0em'>Login</a>";
}
?>