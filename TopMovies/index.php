<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuario</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/dark.css">
</head>
<style>
    body{
        max-width: 600px;
    }
</style>
<body>
    <h1 style="text-decoration: underline;">Ejercicio TopPeliculas usando Post</h1>
    <br>
<form action="TopPeliculas.php" method="post">
    <label for="usuario">Usuario: 
        <input type="text" name="usuario" id="usuario">
    </label>
    <input type="submit" value="Enviar">
</form>
</body>
</html>