<?php
  //session_destroy();
    session_start();
    if (isset($_GET['cognome']) && isset($_GET['nome']) && isset($_GET['id'])) {
        // Memorizza i dati della sessione solo se non esistono già
        if (!isset($_SESSION[''])) {
            $_SESSION['nomeS'] = $_GET['nome'];
        }
        if (!isset($_SESSION[''])) {
            $_SESSION['idS'] = $_GET['id'];
        }
        if (!isset($_SESSION[''])) {
            $_SESSION['cognomeS'] = $_GET['cognome'];
        }
    }

?>
<!doctype html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Menù orchestrale</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
  <body  class="bg-dark text-white">   
    <?php
        (include "./connessione.php");
        $nome = $_SESSION['nomeS'];
        $cognome =  $_SESSION['cognomeS'];
        $id = $_SESSION['idS'];
        $check = false;
        $query = mysqli_query($conn, "SELECT orchestrale.Nome, orchestrale.ID_Orchestrale,orchestrale.Cognome FROM orchestrale");
        while($row = mysqli_fetch_assoc($query)){
            //echo $row['Nome'];
            if($row['Nome']==$nome && $row['ID_Orchestrale']==  $id && $row['Cognome']== $cognome){ //controllo se è registrato come Admin
                echo "<br>"; 
                echo '<h6 class=text-center>Bentornato/a ' . $row['Nome'] . '</h6>';
                $check = true;
                break;
            }
        }   
        if($check == false){
            header("Location: ./loginOrchestrale.php");
            exit;
        }
    ?>
    <div class="text-center w-75 mx-auto my-auto">
    <h2 class="text-danger text-center">TUTTI I TUOI PROSSIMI APPUNTAMENTI:</h2>
    <hr>
    <table class="table table-bordered table-warning">
        <tr>
            <th>ID CONCERTO:</th>
            <th>TITOLO:</th>
            <th>DATA:</th>
            <th>DESCRIZIONE:</th>
            <th>LUOGO:</th>
            <th>ORCHESTRA:</th>
        </tr>
    <?php
        $query = mysqli_query($conn,"SELECT concerto.ID_Concerto, concerto.Titolo, concerto.data, concerto.Descrizione, orchestra.Nome, sala.Nome as ns
        from  orchestrale
        join orchestra_orchestrale on orchestra_orchestrale.ID_Orchestrale = orchestrale.ID_Orchestrale
        join orchestra on orchestra.ID_Orchestra = orchestra_orchestrale.ID_Orchestra
        join concerto on concerto.ID_Orchestra = orchestra.ID_Orchestra
        join sala on sala.ID_Sala = concerto.ID_Sala
        where orchestrale.ID_Orchestrale = $id
        AND concerto.Data > curdate()
        ");
        while($row=mysqli_fetch_assoc($query)){
            echo '<tr>';
            echo '<td>' . $row['ID_Concerto'] . '</td>';
            echo '<td>' . $row['Titolo'] . '</td>';
            echo '<td>' . $row['data'] . '</td>';
            echo '<td>' . $row['Descrizione'] . '</td>';
            echo '<td>' . $row['ns'] . '</td>';
            echo '<td>' . $row['Nome'] . '</td>';
            echo '</tr>';
        }
    ?>
    </table>
    </div>
    <div class="text-center">
          <button type="button" class="btn btn-light "><a class="link-dark" href="./loginOrchestrale.php">LogOut</a></button>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>