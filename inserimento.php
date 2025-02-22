<?php
    session_start();
?>
<!doctype html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>pagina di inserimento</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
  <body>
    <h1>inserimento</h1>
    <?php
        (include "./connessione.php");
        $idOrchestra = $_GET['insertIdorchestra'];
        $sala = $_GET['insertIds'];
        $giorno = $_GET['insertGiorno'];
        $titolo = $_GET['insertTitolo'];
        $descrizione = $_GET['insertDesc'];
        $idConcerto = $_GET['insertIdc'];
        $query = mysqli_query($conn, "INSERT INTO concerto (ID_Concerto,Titolo, Descrizione, `Data`, ID_Sala, ID_Orchestra) 
        VALUES ('$idConcerto','$titolo', '$descrizione', '$giorno', '$sala', '$idOrchestra')");
        header("Location: ./action.php");
        exit;


    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>