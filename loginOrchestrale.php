<?php
  session_start();
  session_destroy();
  session_start();
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
  <body class="bg-dark  text-white">
  <h1 class="text-center text-danger mt-2">PAGINA DI LOGIN</h1>
  <hr>
    <div class="w-50 mx-auto my-auto">
        <!--nome!-->
        <form action="./action2.php" method="GET">
            <div class="mb-3">
                <label for="emailUser" class="form-label">Nome:</label>
                <input type="text" class="form-control" name="nome" id="nome" aria-describedby="emailHelp">
            </div>
            <!--cognome!-->
            <div class="mb-3">
                <label for="emailUser" class="form-label">Cognome:</label>
                <input type="text" class="form-control" name="cognome" id="cognome" aria-describedby="emailHelp">
            </div>
            <!--id!-->
            <div class="mb-3">
                <label for="passwd" class="form-label">ID:</label>
                <input type="password" class="form-control" name='id' id="id">
            </div>
            <button type="submit" class="btn btn-success">Login</button>
        </form>
        <br>
        <div class="text-center">
          <button type="button" class="btn btn-light "><a class="link-dark" href="./index.php">Login come Direttore</a></button>
        </div>
       
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>