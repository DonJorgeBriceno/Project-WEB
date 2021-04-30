<?php
     /*Recupero la sesión abierta */
     session_start();
     //error_reporting(0);
     $session = $_SESSION['Admin'];
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
     <title>Panel Administrador</title>
     <link rel="stylesheet" href="Bootstrap/css/bootstrap.min.css">
    <script src="Bootstrap/js/bootstrap.min.js"></script>
    <script src="script.js"></script>
     <script src="jQuery/jquery-3.6.0.min.js"></script>    
     <script src="AlertifyJS/alertify.min.js"></script>
     <link rel="stylesheet" href="AlertifyJS/css/alertify.min.css">
     <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
     <link rel="stylesheet" href="style.css">
  
</head>
<body>
     <h1>Panel del Admin</h1>
     <h2>Hola, <?php echo $_SESSION['Admin']?></h2>
     <a href="CloseSession.php">Cerrar sesión</a>
     
     <div>
     <!-- Muestro tabla para publicaciones -->
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
     <!-- Fin tabla -->
     <!-- Agrego funcionalidad al boton de publicar post-->
     <?php
     include('Conection.php');
     $consulta="SELECT * FROM administrador where userA='$session'"; 
     $temp=mysqli_query($connection,$consulta);
     $row = mysqli_fetch_array($temp);
     $idAdministrador = $row['ID'];  
     
        
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
          $query = "INSERT into publicaciones(id_administrador, titulo, texto, imagen, tipo, rate) VALUES ('$idAdministrador','$titulo', 
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
     <!-- Fin de funcionalidad al publicar -->
     <!-- Guio al modulo de publicaciones-->
     <form action="TraerPublicaciones.php">
         <button type="submit">Ir al Módulo de Publicaciones </button>
     </form>
     
     
     <!-- Pinto todos los actores -->     
     <h3>A continuación podrás Modificar o Eliminar actores</h3>


     <table>
     <table border="1">
        <colgroup span="2" width="100"></colgroup>
        <colgroup span="2" width="100"></colgroup>
        <tr>
          
          <th colspan="6">Datos</th>
          <th colspan="1"></th>
          <th colspan="3">Operaciones</th>
        </tr>
        <tr>
          <td>Tipo</td> 
          <td>Identificacion</td>
          <td>Nombres</td>
          <td>Email</td>
          <td>Direccion</td>
          <td>Contraseña</td>

          <td></td>
          <td></td>
          <td></td>
          <td></td>
        </tr>
         <?php
           $query = "SELECT ID, mailT, nameT, direT, passT from tejedor";
           $result = mysqli_query($connection, $query);
      
           
           while ($row = mysqli_fetch_assoc($result)) {
          ?>
          <tr>
          <td>Tejedor</td>    
          <td><?php echo $row['ID']?></td>
          <td><?php echo $row['nameT']?></td>
          <td><?php echo $row['mailT']?></td>
          <td><?php echo $row['direT']?></td>
          <td><?php echo $row['passT']?></td>
          <td><a href="Operaciones.php?Id=<?php echo $row['ID']?>&Tabla=Tejedor&Op=Modificar">Modificar</a> </td>
          <td></td>
          <td><a href="Operaciones.php?Id=<?php echo $row['ID']?>&Tabla=Tejedor&Op=Eliminar">Eliminar</a> </td>
          <td><a href="#" onclick="javascript:Ubicar('<?php echo $row['direT']?>','<?php echo $row['ID']?>');">Consultar direccion</a> </td>
          </tr>
                         
          <?php
                
           }        
         ?>
          <?php
           $query = "SELECT ID, mailC, nameC, direC, passC from consumidor";
           $result = mysqli_query($connection, $query);
      
           
           while ($row = mysqli_fetch_assoc($result)) {
          ?>
          <tr>
          <td>Consumidor</td>
          <td><?php echo $row['ID']?></td>
          <td><?php echo $row['nameC']?></td>
          <td><?php echo $row['mailC']?></td>
          <td><?php echo $row['direC']?></td>
          <td><?php echo $row['passC']?></td>
          <td><a href="Operaciones.php?Id=<?php echo $row['ID']?>&Tabla=Consumidor&Op=Modificar">Modificar</a> </td>
          <td></td>
          <td><a href="Operaciones.php?Id=<?php echo $row['ID']?>&Tabla=Consumidor&Op=Eliminar">Eliminar</a> </td>
          <td><a href="#"></a> </td>
          </tr>
                         
          <?php
                
           }        
         ?>
       
      </table>

     </table>

     <div>
     <h3>En esta seccion podrás crear nuevos actores</h3>
         <!-- Pinto formulario para crear actor -->
    <form method="post">
        <input type="text" name="nombre" placeholder="¿Cómo se llamará el actor?">
        <input type="text" name="mail" placeholder="¿Cuál será su mail?">
        <input type="text" name="dire" placeholder="¿Qué hay de su dirección?">
        <input type="text" name="pass" placeholder="Su clave...">
        <input type="submit" name="CrearActor" value="Crear Tejedor">
        <input type="submit" name="CrearConsumidor" value="Crear Consumidor">
    </form>
    
    
    <br> <br>
    
     <!-- Guio al módulo para ver el mapa de tejedores-->
     <form action="TraerMapa.php">
         <button type="submit">Ver el mapa de Tejedores </button>
     </form>
     
     <br> <br>
     

    <?php
         if (isset($_REQUEST['CrearActor'])) {
            //Recupero los datos
            $nombreT= $_POST['nombre'];
            $mailT= $_POST['mail'];
            $direT= $_POST['dire'];
            $passT= $_POST['pass'];
            //Hago el insert
            $consulta="INSERT INTO tejedor
            (nameT, mailT, direT, passT) VALUES('$nombreT','$mailT','$direT', '$passT')";
            $result = mysqli_query($connection, $consulta);
            if (!$result) {
            echo "Query Failed on Insert Tejedor.";
            }else{
               echo  '<script type="text/javascript">'
               , 'Alert_Direccion(1,"Le has dado vida a un nuevo Tejedor","AdministradorHome.php");'
               , '</script>';

            }//Cierre del ELSE
         } //Cierre del IF
         else if(isset($_REQUEST['CrearConsumidor'])){
            //Recupero los datos
            $nombreC= $_POST['nombre'];
            $mailC= $_POST['mail'];
            $direC= $_POST['dire'];
            $passC= $_POST['pass'];
          //Hago el insert
          $consulta="INSERT INTO consumidor
          (nameC, mailC, direC, passC) VALUES('$nombreC','$mailC', '$direC', '$passC')";
          $result = mysqli_query($connection, $consulta);
          if (!$result) {
          echo "Query Failed on Insert Consumidor.";
          }else{
               echo  '<script type="text/javascript">'
               , 'Alert_Direccion(1,"Le has dado vida a un nuevo Consumidor","AdministradorHome.php");'
               , '</script>';
          }//Cierre del ELSE
         }//Cierre del IF
    ?>
         <!-- Gestión de ubicación de actores -->
     
    </div>
</body>
</html>