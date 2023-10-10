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
            if (($pelicula->getNombre() == "") && ($pelicula->getIsan() == "")) {
                //Caso 1
                //Si el nombre y el ISAN está vacío, se mostrará una advertencia
                unset($this->peliculaArray[null]);
                echo "<span style='color: red;'>Los campos Nombre y Isan estan vacios</span><br>";
            }else{
                foreach ($this->peliculaArray as $key => $value){
                    if($key==$pelicula->getIsan()){
                        //Caso 5
                        if($pelicula->getNombre() == ""){
                            //echo "Si el usuario introduce un número ISAN y no deja el nombre de la película vacío, la película se eliminará de la lista.<br>";
                            echo "<span style='color: LimeGreen;'>Has eliminado la pelicula con el ISAN: $key</span><br>";
                            unset($this->peliculaArray[$pelicula->getIsan()]);
                        }
                        if($pelicula->getNombre() != "" && $pelicula->getAño() != "" && $pelicula->getPuntuacion()){
                            //Caso 4
                            //echo "Si el número ISAN que se introdujo YA existe en la lista y el resto de apartados no están vacíos se actualizará con la información introducida en el formulario.<br>";
                            $value->setNombre($pelicula->getNombre());
                            $value->getAño($pelicula->getAño());
                            $value->getPuntuacion($pelicula->getPuntuacion());

                            echo "<span style='color: LimeGreen;'>Has actualizado la pelicula con el ISAN: $key</span><br>";
                        }
                    }else{
                        //Caso 3
                        if(($pelicula->getNombre() != "") && ($pelicula->getIsan() == "")){
                            //echo "Si sólo el ISAN está vacío mostrará la lista de películas que contienen ese nombre" <br>;
                            if(str_contains($value->getNombre(),$pelicula->getNombre())){
                                echo "<table>";
                                    echo "<tr><th>Nombre</th><th>Año</th><th>Puntuación</th></tr>";

                                        echo "<tr>";
                                        echo "<td>" . $value->getNombre() . "</td>";
                                        echo "<td>" . $value->getAño() . "</td>";
                                        echo "<td>" . $value->getPuntuacion() . "</td>";
                                        echo "</tr>";

                                echo "</table>";

                                unset($this->peliculaArray[null]);
                            }
                        }else{
                            $this->peliculaArray[$pelicula->getIsan()]=$pelicula;
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
                if($array[$i]!="" || $texto=""){
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
    <h3>Añade una pelicula:</h3><br>


    <form action="TopPeliculas.php" method="post">
        <p>Nombre de la pelicula: </p>
            <input type="text" name="nombre" id="nombre" value="<?php if(isset($_POST['nombre'])){ echo htmlentities($_POST['nombre']);}else{ echo '';} ?>">
        <p>ISAN: </p>
            <input type="text" id="ISAN" name="ISAN" value="<?php if(isset($_POST['ISAN'])){ echo htmlentities($_POST['ISAN']);}else{ echo '';} ?>">
        <br>
        <p>Anio:</p>
            <input type="date" id="anio" name="anio" min="1960-01-01" max="2024-01-01" value="<?php if(isset($_POST['anio'])){ echo htmlentities($_POST['anio']);}else{ echo '';} ?>">
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