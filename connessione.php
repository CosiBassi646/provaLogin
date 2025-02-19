<?php

$host = "localhost";
$user = "root";
$pass = "";
$db = "ConcertoDB";

// Creazione connessione
$conn = mysqli_connect($host, $user, $pass, $db);

// Controllo errore connessione
if (!$conn) {
    die("Connessione al database fallita: " . mysqli_connect_error());
}

// echo "Connessione riuscita!";

?>