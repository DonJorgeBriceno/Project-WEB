<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Operaciones</title>
    <link rel="stylesheet" href="Bootstrap/css/bootstrap.min.css">
    <script src="Bootstrap/js/bootstrap.min.js"></script>
    <script src="AlertifyJS/alertify.min.js"></script>
    <link rel="stylesheet" href="AlertifyJS/css/alertify.min.css">
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    <script src="script.js"></script>
    <link rel="stylesheet" href="style.css">
    <script src="jQuery/jquery-3.6.0.min.js"></script>
</head>

<body>
    <?php
    //Hago un get de los parámetros necesarios para operar
    include('Conection.php');
    error_reporting(0);
     $id=$_GET['Id'];
     $tabla=$_GET['Tabla'];
     $Ope=$_GET['Op'];
     //Evaluo la operacion
     if($Ope=='Eliminar'){
    //Pido el ID y hago la consulta
    ?>
     <!-- Modal: Operación dar de baja -->

     <div id="MostrarDiv" class="modalDialog" style="display:block;">
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
                 //Establesco la tabla y aplico el query correspondiente  
                    if($tabla=='Tejedor'){
                    $query = "DELETE FROM tejedor WHERE tejedor.ID = $id";
                    } 
                     else if($tabla=='Consumidor'){
                    $query = "DELETE FROM consumidor WHERE consumidor.ID = $id";
                    }
                  $result = mysqli_query($connection, $query);
                if (!$result) {
                    die('Query Failed en el registro.');
                } else{
                    //Invoco el alert con el parámetro TRUE para redireccionar
                    echo  '<script type="text/javascript">'
                    , 'Alert_Direccion(1,"El actor fue eliminado","AdministradorHome.php");'
                    , '</script>';
                    }
            }else if(($_REQUEST['cancel'])){
               //Primero cierro el Modal
                echo  '<script type="text/javascript">'
                , 'CerrarDiv();'
                , '</script>';
                //Invoco el alert con el parámetro FALSE para no redireccionar
                echo  '<script type="text/javascript">'
                , 'Alert_Direccion(3,"Los datos del actor están salvaguardados","AdministradorHome.php");'
                , '</script>';
                } 
     }// Fin Script para confirmacion de eliminar



     //Inicio la modificacion de actores
     else if($Ope=='Modificar'){
        //Compruebo las tablas 
        if($tabla=='Tejedor'){
            $consulta= "SELECT * FROM tejedor WHERE tejedor.ID= $id";
            $temp=mysqli_query($connection, $consulta);             
            $row = mysqli_fetch_array($temp);                          
         ?>
    <!-- Pinto formulario con datos actuales -->
    <form method="post">
        <input type="text" name="nombreT" value="<?php echo $row['nameT']?>">
        <input type="text" name="mailT" value="<?php echo $row['mailT']?>">
        <input type="text" name="direT" value="<?php echo $row['direT']?>">
        <input type="text" name="passT" value="<?php echo $row['passT']?>">
        <input type="submit" name="ModificarTejedor" value="Actualizar Tejedor">
    </form>
    <?php
        //Compruebo las tablas
            } else if($tabla=='Consumidor'){ 
            $consulta="SELECT * FROM consumidor WHERE consumidor.ID= $id";
            $temp=mysqli_query($connection,$consulta);             
            $row = mysqli_fetch_array($temp);                          

            ?>
    <!-- Pinto formulario con datos actuales -->
    <form method="post">
        <input type="text" name="nombreC" value="<?php echo $row['nameC']?>">
        <input type="text" name="mailC" value="<?php echo $row['mailC']?>">
        <input type="text" name="direC" value="<?php echo $row['direC']?>">
        <input type="text" name="passC" value="<?php echo $row['passC']?>">
        <input type="submit" name="ModificarConsumidor" value="Actualizar Consumidor">
    </form>
    <?php
            }
    //Evaluo el click actualizar Tejedor
    if (isset($_REQUEST['ModificarTejedor'])) {
        //Recupero los datos
        $nombreT= $_POST['nombreT'];
        $mailT= $_POST['mailT'];
        $direT= $_POST['direT'];
        $passT= $_POST['passT'];

        //Hago el Update
        $consulta="UPDATE tejedor
        SET nameT='$nombreT', mailT='$mailT', direT='$direT', passT='$passT' WHERE tejedor.ID='$id' ";
        $result = mysqli_query($connection, $consulta);
        if (!$result) {
            echo "Query Failed en el registro.";
        } else{
    ?>
    <script>
    function redireccionar() {
        location.href = "AdministradorHome.php";
    }
    alertify.alert("Se ha actualizado el registro",
        function() {
            alertify.success('Hecho');
            // Redirecciono para no quedarme en blanco
            setTimeout("redireccionar()", 2000);
        });
    </script>
    <?php
        } //Cierre del ELSE
    } //Fin del update para Tejedor  
    //Evaluo el click actualizar Consumidor
    if (isset($_REQUEST['ModificarConsumidor'])) {
        //Recupero los datos
        $nombreC= $_POST['nombreC'];
        $mailC= $_POST['mailC'];
        $direC= $_POST['direC'];
        $passC= $_POST['passC'];
        //Hago el Update
        $consulta="UPDATE consumidor
        SET nameC='$nombreC', mailC='$mailC', direC='$direC', passC='$passC' WHERE consumidor.ID='$id' ";
        $result = mysqli_query($connection, $consulta);
        if (!$result) {
            die('Query Failed en el registro.');
        }else{
        ?>
    <script>
    function redireccionar() {
        location.href = "AdministradorHome.php";
    }
    alertify.alert("Se ha actualizado el registro",
        function() {
            alertify.success('Hecho');
            // Redirecciono para no quedarme en blanco
            setTimeout("redireccionar()", 2000);
        });
    </script>
    <?php
        } 
    }//Cierre del ELSE  
    }//Fin de modificacion de actores
    
    ?>
</body>

</html>