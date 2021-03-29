<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Messaggi</title>
</head>

<body>
    <input style="font-size: 1.2em;" type="button" value="<" onclick="document.location.href ='index.php'">
    <div style="display: flex;justify-content: center;">
        <div style="margin-top: 10%;">
            <form>
                <p>Scrivi il tuo messaggio</p>
                <textarea name="msgtext" id="textaria" cols="40" rows="10"></textarea> <br>
                <p>Invia messaggio a: <input name="inviaA" type="text"></p>
                <input type="submit" value="invia" style="margin-left: 85%;">
            </form>
        </div>
    </div>
</body>

</html>

<?php
session_start();
if (isset($_SESSION["userId"])) {

    $servername = "localhost";
    $username = "root";
    $password = "qwerty123";
    $dbname = "world";

    $inviatoA = "";
    $iviatoDa = $_SESSION["userId"];
    $messaggio = "";
    $data = "";

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    if (isset($_GET['inviaA'])) {
        $inviatoA = $_GET["inviaA"];
        $messaggio = $_GET["msgtext"];
        $data = date('Y-m-d H:i:s');

        $inviaAID = "";

        $sql = "SELECT * FROM user where username='" . $inviatoA . "'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $inviaAID = $row['id'];
            $sql = "INSERT INTO messaggi (from_user, to_user,data_messaggio,messaggio) VALUES ('$iviatoDa', '$inviaAID', '$data' ,'$messaggio') ";
            $result = $conn->query($sql);

            echo "<br><p style='color:green;font-size:2.0em'>Il messaggio è stato inviato a: " . $inviatoA . " !!!</p>";
        } else {
            echo "<br><p style='color:red;font-size:2.0em'>Untente: " . $inviatoA . " non esiste.</p>";
        }
    }
} else {
    header('Location: login.php');
    exit();
}
?>