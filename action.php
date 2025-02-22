<?php
  //session_destroy();
    session_start();
    if (isset($_GET['emailUser']) && isset($_GET['passwd']) && isset($_GET['cognomeAdmin'])) {
        // Memorizza i dati della sessione solo se non esistono già
        if (!isset($_SESSION['nomeAdmin'])) {
            $_SESSION['nomeAdmin'] = $_GET['emailUser'];
        }
        if (!isset($_SESSION['idAdmin'])) {
            $_SESSION['idAdmin'] = $_GET['passwd'];
        }
        if (!isset($_SESSION['cognomeAdmin'])) {
            $_SESSION['cognomeAdmin'] = $_GET['cognomeAdmin'];
        }
    }

?>
<!doctype html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Menù Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
  <body  class="bg-dark  text-white">   
        <div class="w-50 mx-auto my-auto text-center">
        <?php
            include("connessione.php");
            //var_dump($_GET['emailUser']);
            //var_dump($_GET['passwd']);
            $userName = $_SESSION['nomeAdmin'];
            $idAdmin = $_SESSION['idAdmin'];
            $cognomeAdmin = $_SESSION['cognomeAdmin'];
            
        // echo $userName;
        // echo $idAdmin;
        $check = false;
            $query = mysqli_query($conn, "SELECT direttore.Nome, direttore.ID_Direttore,direttore.Cognome FROM direttore");
            while($row = mysqli_fetch_assoc($query)){
                //echo $row['Nome'];
                if($row['Nome']==$userName && $row['ID_Direttore']==$idAdmin && $row['Cognome']==$cognomeAdmin){
                    echo "<br>";
                    echo "<h6>Bentornato/a " . $row['Nome'] . "</h6>";
                    $check = true;
                    break;
                }
            }   
            if($check == false){
                header("Location: ./index.php"); //redireziona l'utente verso la pagina index.php
                exit;
            }
        ?>
        </div>        
        <h2 class="text-danger text-center">Tutti i tuoi appuntamenti:</h2>
        <DIV class="w-75 mx-auto my-auto text-center">
        <table class="table table-bordered table-hover table-warning">
            <tr>
                <th>ID CONCERTO:</th>
                <th>TITOLO:</th>
                <th>DATA:</th>
                <th>DESCRIZIONE:</th>
                <th>LUOGO:</th>
                <th>ORCHESTRA:</th>
            </tr>
        <?php
            $query = mysqli_query($conn,"SELECT concerto.ID_concerto, concerto.titolo, sala.nome,concerto.data,concerto.descrizione,orchestra.nome as nOrchestra FROM concerto
            join orchestra on orchestra.ID_Orchestra = concerto.ID_Orchestra
            join direttore on direttore.ID_Direttore = orchestra.ID_Direttore
            join sala on sala.ID_Sala = concerto.ID_Sala
            where direttore.ID_Direttore = '$idAdmin'");

            while($row=mysqli_fetch_assoc($query)){
                echo '<tr>';
                echo '<td>' . $row['ID_concerto']. '</td>';
                echo '<td>' . $row['titolo']. '</td>';
                echo '<td>' . $row['data']. '</td>';
                echo '<td>' . $row['descrizione']. '</td>';
                echo '<td>' . $row['nome']. '</td>';
                echo '<td>' . $row['nOrchestra']. '</td>';
                echo '</tr>';
            }
        ?>
        </DIV>
        </table>
        <h2 class="text-danger text-center">Cosa vorresti fare?</h2>
        <div class="container text-center">
            <div class="row">
                <div class="col">
                <form action="./inserimento.php">
                        <h5>Aggiungere un nuovo concerto:</h5>
                        <div class="mb-3">
                            <label for="insertIdc" class="form-label">ID</label>
                            <input type="text" class="form-control" name="insertIdc" id="insertIdc">
                        </div>
                        <div class="mb-3">
                            <label for="insertTitolo" class="form-label">Titolo</label>
                            <input type="text" class="form-control" name="insertTitolo" id="insertTitolo">
                        </div>
                        <div class="mb-3">
                            <label for="insertDesc" class="form-label">Descrizione</label>
                            <input type="text" class="form-control" name="insertDesc" id="insertDesc">
                        </div>
                        <div class="mb-3">
                            <label for="insertGiorno" class="form-label">Data del concerto</label>
                            <input type="date" class="form-control" name="insertGiorno" id="insertGiorno">
                        </div>
                        <div class="mb-3">
                            <label for="insertIds" class="form-label">ID sala</label>
                            <input type="text" class="form-control" name="insertIds" id="insertIds">
                        </div>
                        <div class="mb-3">
                            <label for="insertIdorchestra" class="form-label">ID Orchestra</label>
                            <input type="text" class="form-control" name="insertIdorchestra" id="insertIdorchestra">
                        </div>
                        <button type="submit" class="btn btn-success">Aggiungi</button>
                        </form>
                </div>
                <div class="col">
                <h5>Rimuovere un concerto tramite ID:</h5>
                <form action = "./rimozione.php">
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">ID Concerto</label>
                        <input type="text" class="form-control" id="rmConcerto"name="rmConcerto">
                    </div>
                    <button type="submit" class="btn btn-danger">Elimina</button>
                    </form>
                </div>
            </div>
        </div>
        <br>
            <div class="w-50 mx-auto my-auto text-center mt-5 rounded-2">
                    <h2 class="text-danger">Elenco di tutti i concerti con le relaitive informazioni</h2>
                    <hr>
                    <table class="table table-bordered table-hover rounded-2 table-success">
                    <tr>
                        <th>TITOLO:</th>
                        <th>DATA:</th>
                        <th>ID CONCERTO:</th>
                    </tr>
                    <?php
                        $query2 = mysqli_query($conn, "SELECT concerto.Titolo, concerto.Data, concerto.ID_Concerto FROM concerto");
                        while($row = mysqli_fetch_assoc($query2)){
                            echo'<tr>';
                            echo'<td class="table-active">' . $row['Titolo'] ."</td>";
                            echo"<td>" . $row['Data'] ."</td>";
                            echo"<td>" . $row['ID_Concerto'] ."</td>";
                            echo"</tr>";
                        }
                    ?>
                    </table>
                    <button type="button" class="btn btn-light"><a class="link-dark" href="./index.php">Logout</a></button>
            </div>
        
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>