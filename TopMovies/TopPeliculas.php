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
            if ($pelicula->getNombre() == "" && $pelicula->getIsan() == "") {
                // Caso 1: Si el nombre y el ISAN están vacíos, se mostrará una advertencia
                echo "<span style='color: red;'>Los campos Nombre y ISAN están vacíos</span><br>";
            } else {
                if ($pelicula->getIsan() == "") {
                    // Caso 3: Si el ISAN está vacío y el nombre no, mostrar la lista de películas con ese nombre
                    $nombreBuscado = strtolower($pelicula->getNombre()); // Convertir el nombre a minúsculas para comparar sin distinción de mayúsculas y minúsculas
                    $encontradas = [];
        
                    foreach ($this->peliculaArray as $key => $value) {
                        $nombrePelicula = strtolower($value->getNombre());
                        if (strpos($nombrePelicula, $nombreBuscado) !== false) {
                            // La película contiene el nombre buscado
                            $encontradas[] = $value;
                        }
                    }
        
                    if (!empty($encontradas)) {
                        // Mostrar la lista de películas encontradas
                        echo "<table>";
                        echo "<tr><th>Nombre</th><th>Año</th><th>Puntuación</th></tr>";
                        foreach ($encontradas as $peliculaEncontrada) {
                            echo "<tr>";
                            echo "<td>" . $peliculaEncontrada->getNombre() . "</td>";
                            echo "<td>" . $peliculaEncontrada->getAño() . "</td>";
                            echo "<td>" . $peliculaEncontrada->getPuntuacion() . "</td>";
                            echo "</tr>";
                        }
                        echo "</table>";
                    } else {
                        // No se encontraron películas con el nombre buscado
                        echo "<span style='color: red;'>No se encontraron películas con el nombre buscado.</span><br>";
                    }
        
                } else {
                    $key = $pelicula->getIsan();
                    if (isset($this->peliculaArray[$key])) {
                        // Caso 5: Actualizar la película existente si el ISAN ya existe en la lista
                        if ($pelicula->getNombre() == "") {
                            // Si el nombre está vacío, elimina la película
                            unset($this->peliculaArray[$key]);
                            echo "<span style='color: LimeGreen;'>Has eliminado la película con el ISAN: $key</span><br>";
                        } else {
                            // Si el nombre no está vacío, actualiza la película con los nuevos datos
                            $this->peliculaArray[$key]->setNombre($pelicula->getNombre());
                            $this->peliculaArray[$key]->setAño($pelicula->getAño());
                            $this->peliculaArray[$key]->setPuntuacion($pelicula->getPuntuacion());
                            echo "<span style='color: LimeGreen;'>Has actualizado la película con el ISAN: $key</span><br>";
                        }
                    } else {
                        // Caso 4: Agregar la película si no existe en la lista y al menos uno de los campos no está vacío
                        if ($pelicula->getNombre() != "" || $pelicula->getIsan() != "") {
                            $this->peliculaArray[$key] = $pelicula;
                        }
                    }
                }
            }
        }
        
        


        //metodo para convertir el Array en String
        public function array_String(){
            $string="";
            foreach ($this->peliculaArray as $key => $value){
                if($value->getIsan()!=" " && $value->getNombre()!=" " && $value->getPuntuacion()!=" " && $value->getAño()!=1){
                    $string .= $value->getIsan().",".$value->getNombre().",".$value->getPuntuacion().",".$value->getAño()."/";
                }
            }
            return $string;
        }

        //metodo para convertir el String en Array
        public function string_Array($texto){
            $array=explode("/",$texto);
            for ($i=0; $i < count($array); $i++) { 
                $array_peli=explode(",",$array[$i]);
                if($array[$i]!="" || $texto==""){
                    $peli=new Pelicula($array_peli[0],$array_peli[1],$array_peli[2],$array_peli[3]);
                    $this->peliculaArray[$array_peli[0]]=$peli;
                }
            }
        }


        //metodo para mostrar los datos
        public function mostrarDatos(){
            echo "<br><br>";
            echo "<span style='color: LimeGreen;'>Todas las peliculas que has añadidos:</span>";
            $datos = "<table>";
            $datos .= "<tr><th>Nombre</th><th>ISAN</th><th>Puntuacion</th><th>Año</th></tr>";

            foreach ($this->peliculaArray as $key => $value) {
                $nombre = $value->getNombre();
                $isan = $value->getIsan();
                $puntuacion = $value->getPuntuacion();
                $anio = $value->getAño();

                $datos .= "<tr><td>$nombre</td><td>$isan</td><td>$puntuacion</td><td>$anio</td></tr>";
            }

            $datos .= "</table>";
            return $datos;
        }



    }
    ?>

    <?php

    //Concatenar peliculas
        $concatenado = new TopPeliculas();
        if (isset($_POST['concatenado'])) {
            $concatenado->string_Array($_POST['concatenado']."/".$_POST['ISAN'].",".$_POST['nombre'].",".$_POST['combo'].",".$_POST['anio']."/");
        }

    //comprobacion de nombre de usuario
        if(isset($_POST["usuario"])){
            $usuario= ($_POST["usuario"]);
        }else{
            $_POST["usuario"]="";
        }
    ?>


    <h1 style="text-decoration: underline;">Hola usuario: <?php { echo $_POST["usuario"] ; } ?></h1>
    <h3>Ejercicio usando POST:</h3><br>


    <form action="TopPeliculas.php" method="post">
        <p>Nombre de la pelicula: </p>
            <input type="text" name="nombre" id="nombre" value="<?php if(isset($_POST['nombre'])){ echo htmlentities($_POST['nombre']);}else{ echo '';} ?>">
        <p>ISAN: </p>
            <input type="text" id="ISAN" name="ISAN" value="<?php if(isset($_POST['ISAN'])){ echo htmlentities($_POST['ISAN']);}else{ echo '';} ?>">
        <br>
        <p>Anio:</p>
        <input type="number" id="anio" name="anio" min="1960" max="<?php echo date("Y"); ?>" value="<?php if(isset($_POST['anio'])){ echo htmlentities($_POST['anio']);}else{ echo '';} ?>">
        <br>
        <p>Puntuacion:</p>
        <select name="combo" >
            <option value="">0</option>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
        </select>
        <br><br>
        <button type="submit" name="enviar">Añadir</button><br><br>
        <?php echo "<input type='hidden' name='usuario' value='".$_POST['usuario']."'>" ?>


        <?php

        if(isset($_POST["ISAN"]) && isset($_POST["nombre"]) && isset($_POST["anio"]) && isset($_POST["combo"])){
            $peli=new Pelicula(htmlentities($_POST['ISAN']),htmlentities($_POST['nombre']),htmlentities($_POST['combo']),htmlentities($_POST['anio']));

            //concateno las peliculas
            $concatenado->anadirPelicula($peli);

            //muestro los datos
            echo $concatenado->mostrarDatos();
        }

        ?>
        <?php echo "<input type='hidden' name='concatenado' value='".$concatenado->array_String()."' >" ?>
    </form>
</body>
</html>