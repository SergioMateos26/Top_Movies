<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TopPeliculas</title>  
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/dark.css">
</head>
<style>
    body{
        max-width: 550px;
    }
</style>
<body>
    <?php

    include('Pelicula.php');

    class TopPeliculas{

        private $peliculaArray=[];

        public function __construct(){

        }

        public function anadirPelicula($pelicula){

        }



    }
    ?>

    <?php

    //comprobacion de nombre de usuario
        if(isset($_POST["usuario"])){
            $usuario= ($_POST["usuario"]);
        }else{
            $_POST["usuario"]="";
        }
    ?>

    <h1 style="text-decoration: underline;">Hola usuario: <?php { echo $_POST["usuario"] ; } ?></h1>
    <h3>Añade una pelicula:</h3><br>


    <form action="TopPeliculas.php" method="post">
        <p>Nombre de la pelicula: </p>
            <input type="text" name="nombre" id="nombre" value="">
        <p>ISAN: </p>
            <input type="text" id="ISAN" name="ISAN" value="">
        <br>
        <p>Anio:</p>
            <input type="number" id="anio" name="anio" value="">
        <br>
        <p>Puntuacion:</p>
        <select name="combo">
            <option value="">0</option>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
        </select>
        <br><br>
        <button type="submit">Añadir</button><br><br>
        <?php echo "<input type='hidden' name='usuario' value='".$_POST['usuario']."'>" ?>

    </form>
</body>
</html>