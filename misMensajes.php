<?php
     /*Recupero sesión abierta*/
     
     include('Conection.php');
          session_start();
          error_reporting(0);
          $volver='';
          try{
            if($_SESSION['Tejedor']){
                $destinatario=$_SESSION['Tejedor'];
                $volver= "TejedorHome.php";
             } else if($_SESSION['Consumidor']){
                $destinatario=$_SESSION['Consumidor'];
                $volver= "TraerPublicaciones.php";
             }else{
                $destinatario=$_SESSION['Administrador'];
                $volver= "AdministradorHome.php";
             }
             
        }
        catch(Exception $e){
            echo "Hubo un error al intentar recuperar la sesión abierta:  ".$e;
        }
        
     /*Consulto a la BBDD los mensajes para el destinatario que tiene la sesion activa */
     $query = "SELECT mensaje, remitente FROM buzon WHERE destinatario='$destinatario'";
          $result = mysqli_query($connection, $query);
          if (!$result) {
    ?>
            <script>alert("Hubo un error al recuperar los mensajes del buzón")</script>
    <?php
            
          }else{
    /*Pinto la respuesta del query*/
    ?>
     <link rel="stylesheet" href="Bootstrap/css/bootstrap.min.css">
    <script src="Bootstrap/js/bootstrap.min.js"></script>
    <a href= "<?php echo $volver ?>">Volver</a>
    <div>
        
        <table class="table table-dark" style="margin: 0 auto; width: 800" >
            <thead>
                    <tr>
                    <th scope="col">Remitente</th>
                    <th scope="col">Mensaje</th>
                    </tr>
            </thead>
            <tbody>
                <?php
                    while ($row = mysqli_fetch_assoc($result)) {
                ?>
                    <tr>
                    <td><?php echo $row['remitente']; ?></td>
                    <td><?php echo $row['mensaje']; ?></td>
                    </tr>
                <?php
                    }
                ?>  
            </tbody>
        </table>
        
    </div>

    <?php       
            }
?>