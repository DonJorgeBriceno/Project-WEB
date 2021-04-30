<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="Bootstrap/css/bootstrap.min.css">
    <script src="Bootstrap/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <!-- Recupero sesión abierta -->
    <?php
    include('Conection.php');
    error_reporting(0);
         session_start();
         $cadena='';
         $userReaccion='Nadie';
            try{
                if($_SESSION['Tejedor']){
                    $remitente=$_SESSION['Tejedor'];
                    $userReaccion=$remitente;
                    $bandera= 1;
                   $cadena= $remitente. ", tu perfil como artesano te da la bienvenida";
                 } else if($_SESSION['Consumidor']){
                    $remitente=$_SESSION['Consumidor'];
                    $bandera= 2;
                    $userReaccion=$remitente;
                    $cadena= $remitente. ", los consumidores como tú hacen que el folklore trascienda";
                 }else{
                    $remitente=$_SESSION['Admin'];
                    $bandera= 3;
                    $userReaccion=$remitente;
                    $cadena= $remitente. ", la administración es el nucleo de todo proyecto";
                 }
                 echo $cadena;
            }
            catch(Exception $e){
                echo "Hubo un error al intentar recuperar la sesión abierta:  ".$e;

            }
         
        
    ?>

</head>

<body>
    <!-- Botonera -->
    <br>
    <a href="CloseSession.php">Cerrar tu sesion</a>
    <br><br>
    <?php      
    if($bandera==1){
        ?>
    <a href="TejedorHome.php">Volver a publicar</a>
    <?php   
    }
    if($bandera==3){
    ?>
    <a href="AdministradorHome.php">Volver a publicar</a>

    <?php   
    }
    ?>
    <a href="#close" onclick="javascript:mostrarBuzon();">Enviar mensaje</a>
    <a href="misMensajes.php">Leer mensajes</a>
    <!-- Enviar mensajes -->
    <div id="buzon" class="modalDialog">
        <div>
            <a href="#close" title="Close" class="close" onclick="javascript:cerrarBuzon();">X</a>
            <h4>Escribe tu mensaje</h4>
            <form method="post" enctype="multipart/form-data">
                <p>Remite:</p>
                <input type="text" name="remitente" class="form-control" value="<?php echo $remitente ?>" readonly>
                <input type="text" name="destinatario" class="form-control" placeholder="¿A quién va?">
                <br>
                <textarea name="mensaje" rows="10" cols="10" placeholder="Escribe aquí lo que quieres cumunicar "
                    style="width : 360px; heigth : 105px;"></textarea>
                <br>
                <input type="submit" name="envioMensaje" value="Iniciar charla">

            </form>
        </div>
    </div>
    <!-- Evaluo acción en el botón para enviar mensajes -->
    <?php
         if (isset($_REQUEST['envioMensaje'])) {
          $remitente= $_POST['remitente'];
          $destinatario=$_POST['destinatario'];
          $mensaje=$_POST['mensaje'];
          $query = "INSERT into buzon(remitente, destinatario, mensaje) VALUES ('$remitente','$destinatario', 
          '$mensaje')";
          $result = mysqli_query($connection, $query);
          if (!$result) {
        ?>
    <script>
    alert("Hubo un error al contactar con el buzón")
    </script>
    <?php
                      
            }else{
        ?>
    <script>
    alert("El mensaje fue enviado con éxito")
    </script>
    <?php
            }

         }
    ?>
    <!-- Pinto las publicaciones -->
   
    <div class="container mt-3">
        <div class="row">
            <div class="col-12">
                <table class="table table-bordered" style="margin: 0 auto; width: 800">
                    <tbody>
                        <?php
                        $label="¡Reaccionar!";        
                        /*Aquí pinto la tarjeta para las publicaciones de Tejedores*/
                        $query = "SELECT * from publicaciones INNER JOIN tejedor on tejedor.ID=publicaciones.id_tejedor ";
                        $res = mysqli_query($connection, $query);
                        while ($row = mysqli_fetch_assoc($res)) {
                            if($userReaccion==$row['user_reaccion']){
                                $label="Quitar Reaccion";
                                $userReaccion=" ";
                            }
                            
                        ?>
                        <tr class="table-danger" style="text-align:center;">
                            <th><?php 
                            
                                echo $row['nameT'];   
                            ?></th>
                        </tr>

                        <tr>
                            <th><?php echo $row['titulo']; ?></th>

                            <?php
                                 if($row['imagen']!=null){ 
                            ?>
                            <th colspan="1" rowspan="3" style="text-align: center;">
                                <img width="100%" height="100%" src="data:<?php echo $row['tipo']; ?>;base64,
                                <?php 
                                echo  base64_encode($row['imagen']);  
                            ?>">
                            </th>
                            <?php
                                }
                            ?>

                        <tr>
                            <th><?php echo $row['texto']; ?></th>
                        </tr>
                        </tr>
                        <tr class="table-info">
                       
                            <th>Le gusta a <?php echo $row['rate']; ?> personas,
                            <a class="reaccion" onclick= "javascript:pasarID(<?php echo $row['IDPublicacion']; ?>,'<?php echo $userReaccion;?>');
                            "style="cursor: pointer"><?php echo $label?></a>
                            </th>
                        </tr>
                        </tr>
                        <tr>
                            <th><br></th>
                        </tr>
                        <!-- Fin de tarjeta -->
                        <?php
                        
                    }
                    ?>
                        <?php
                    $label="¡Reaccionar!";
                        /*Aquí pinto la tarjeta para las publicaciones del Administrador*/
                        $query = "SELECT * from publicaciones INNER JOIN administrador on administrador.ID=publicaciones.id_administrador";
                        $res = mysqli_query($connection, $query);
                        while ($row = mysqli_fetch_assoc($res)) {
                            if($userReaccion==$row['user_reaccion']){
                                $label="Quitar Reaccion"; 
                                $userReaccion=" ";
                            }
                            
                        ?>
                        <tr class="table-danger" style="text-align:center;">
                            <th><?php 
                                echo $row['userA'];   
                            ?></th>
                        </tr>


                        <tr>
                            <th><?php echo $row['titulo']; 
                            
                            ?></th>

                            <?php
                                 if($row['imagen']!=null){ 
                            ?>
                                <th colspan="1" rowspan="3" style="text-align: center;">
                                <img width="50%" height="50%" src="data:<?php echo $row['tipo']; ?>;base64,
                            <?php 
                                echo  base64_encode($row['imagen']);  
                            ?>">
                            </th>
                            <?php
                                }
                            ?>
                            

                        <tr>
                            <th><?php echo $row['texto']; ?></th>
                        </tr>
                        </tr>
                        <tr class="table-info">
                            <th>Le gusta a   <?php echo $row['rate']; ?> personas,
                                <a class="reaccion" onclick= "javascript:pasarID(<?php echo $row['IDPublicacion']; ?>,'<?php echo $userReaccion;?>');
                                "style="cursor: pointer"><?php echo $label?></a>
                            </th>
                        </tr>
                        </tr>
                        <tr>
                            <th><br></th>
                        </tr>
                        <!-- Fin de tarjeta -->

                        <?php
                        
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
<script src="script.js"></script>

</html>