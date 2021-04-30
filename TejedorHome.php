<?php
     //Recupero la sesión abierta
     session_start();
     error_reporting(0);
     $session = $_SESSION['Tejedor'];
     if($session ==null || $session ==''){
          echo "No has iniciado sesión";
          die();
     }

?>

<!DOCTYPE html>
<html lang="en">
<head>
     <meta charset="UTF-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Home</title>
     <script src="script.js"></script>
     <link rel="stylesheet" href="Bootstrap/css/bootstrap.min.css">
    <script src="Bootstrap/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="style.css">
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
</head>
<body>
<!-- Botonera -->
<a href="CloseSession.php">Cerrar sesión</a>
     <h1>Panel de Publicación</h1>
     <h2>Hola, <?php echo $_SESSION['Tejedor']?></h2>
     <div>
     <table>
          <form method="post" enctype="multipart/form-data">
          <th style="width: 483px;">
          <input type="text" name="titulo" placeholder="Titulo de la publicación"  style="width : 483px; heigth : 15px">
          <textarea name="texto" rows="10" cols="50" placeholder="Escribe aquí lo que quieres vender o cumunicar "></textarea>     
          
          </th>
          
          <th>
          <input type="file" name="foto" >
          <br><br>
          <input type="submit" name="guardar" value="Publicar">
          </th>
          </form>
     </table>
     <?php
     include('Conection.php');
     $consulta="SELECT * FROM tejedor where nameT='$session'"; 
     $temp=mysqli_query($connection,$consulta);
     $row = mysqli_fetch_array($temp);
     $idTejedor = $row['ID'];
     ?>
     <!-- Modal: Operación dar de baja -->
     <a href="#close" onclick="javascript:MostrarDiv();">Solicitar baja</a>
     <div id="MostrarDiv" class="modalDialog">
        <div>
        <a href="#close" title="Close" class="close" onclick="javascript:CerrarDiv();">X</a>
        <form method="post" >
        <input type="submit" class="btn btn-success" name="ok" value="Estoy seguro"></input>
        <input type="submit" class="btn btn-danger" name="cancel" value="Cancelar"></input>
        </form>
        </div>
    </div>
     <!-- Fin Modal: Operacion baja -->
    <?php
    //Evaluo el boton cliqueado
            if(isset($_REQUEST['ok'] )){
               //Primero cierro el Modal
                echo  '<script type="text/javascript">'
                , 'CerrarDiv();'
                , '</script>';
               //Aplico el DELETE en la BBDD
                $query2 = "DELETE FROM tejedor WHERE tejedor.ID = $idTejedor";
                $result = mysqli_query($connection, $query2);
                if (!$result) {
                    die('Query Failed: On delete account');
                } else{
                    //Invoco el alert con el parámetro TRUE para redireccionar
                    echo  '<script type="text/javascript">'
                    , 'Alert_Direccion(1,"Tu perfil como artesano ha sido dado de baja. Serás redireccionado...","Indice.html");'
                    , '</script>';
                }
            }else if(($_REQUEST['cancel'])){
               //Primero cierro el Modal
                echo  '<script type="text/javascript">'
                , 'CerrarDiv();'
                , '</script>';
                //Invoco el alert con el parámetro FALSE para no redireccionar
                echo  '<script type="text/javascript">'
                , 'Alert_Direccion(2,"Sabiamos que lo ibas a reconciderar", "TejedorHome.php");'
                , '</script>';
                }
     //Inicio la operación para las publicaciones
     if (isset($_REQUEST['guardar'])) {
          $titulo= $_POST['titulo'];
          $texto=$_POST['texto'];
         if (isset($_FILES['foto']['name'])) {
             $tipoArchivo = $_FILES['foto']['type'];
             $nombreArchivo = $_FILES['foto']['name'];
             $tamanoArchivo = $_FILES['foto']['size'];
             $imagenSubida = fopen($_FILES['foto']['tmp_name'], 'r');
             $binariosImagen = fread($imagenSubida, $tamanoArchivo);
             $binariosImagen = mysqli_escape_string($connection, $binariosImagen);
          $query = "INSERT into publicaciones(id_tejedor, titulo, texto, imagen, tipo, rate) VALUES ('$idTejedor','$titulo', 
          '$texto', '$binariosImagen', '$tipoArchivo', '0')";
          
          $result = mysqli_query($connection, $query);
               if (!$result) {
                die('Hubo un error subiendo datos planos e imágenes');
                } else{
               ?>
                     <div class="alert alert-primary alert-dismissible fade show" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        <span class="sr-only">Close</span>
                    </button>
                    Publicacion cargada exitosamente
                </div>    
               <?php
                }     

          }
         }
         
     ?>

 
     <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
     <form action="TraerPublicaciones.php">
         <button type="submit">Ir al Módulo de Publicaciones </button>
     </form>
    

</body>
</html>