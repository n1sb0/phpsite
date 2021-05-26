<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link rel="stylesheet" href="Style.css" />
        <link href="https://cdn.jsdelivr.net/npm/boxicons@2.0.5/css/boxicons.min.css" rel="stylesheet" />
        <style>
            table, th, td {
            border: 1px solid black;
            }
        </style>
        
    </head>
    <body>
        
    <div class="nav__menu" id="nav-menu">
        <ul class="nav__list">
        <li class="nav__item"><a href="Prodotti.php" class="nav__link">Prodotti</a></li>
          <li class="nav__item"><a href="Clienti_Fornitori.php" class="nav__link active">Clienti/Fornitori</a></li>
          <li class="nav__item"><a href="Magazzino.php" class="nav__link">Magazzino</a></li>
          <li class="nav__item"><a href="Ordini_Clienti.php" class="nav__link">Ordini Clienti</a></li>
          <li class="nav__item"><a href="Ordini_Fornitori.php" class="nav__link">Ordini Fornitori</a></li>
        </ul>
      </div>

      <br>

    <?php
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "maturita";

        // Crea connessione al Database
        $conn = new mysqli($servername, $username, $password, $dbname);
        // Controlla eventuali errori nella connessione
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "SELECT * FROM clienti_fornitori";

        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo "<center>";
            echo "<table><tr><th>ID</th><th>Codice</th><th>Tipo</th><th>intestazione_aziendale</th>
            <th>Indirizzo</th><th>cap</th><th>Provincia</th><th>Partitaiva</th>
            <th>Telefono</th><th>Email</th></tr>";
            //crea in output una riga con 3 colonne per ciascun record
            while($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>" . $row["id"]. "</td>
                        <td>" . $row["codice"]. "</td>
                        <td>" . $row["tipo"]. "</td>
                        <td>" . $row["intestazione_aziendale"]. "</td>
                        <td>" . $row["indirizzo"]. "</td>
                        <td>" . $row["cap"]. "</td>
                        <td>" . $row["provincia"]. "</td>
                        <td>" . $row["partita_iva"]. "</td>
                        <td>" . $row["telefono"]. "</td>
                        <td>" . $row["email"]. "</td>
                    </tr>";
            }
            echo "</table>";
            echo "</center>";
        } else {
            echo "0 results";
        }
        $conn->close();
    ?>
    </body>
</html>