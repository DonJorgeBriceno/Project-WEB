<?php
 include('Conection.php');
    if (isset($_POST["Ingreso"])){ 
       
        $userA= $_POST["userA"];
        $keyA= $_POST["keyA"];

        session_start();

        $consulta="SELECT COUNT(*) AS CONTAR FROM administrador where userA='$userA' and keyA='$keyA'";
        $resultado=mysqli_query($connection,$consulta);
        $filas=mysqli_fetch_array($resultado);
        if($filas['CONTAR']>0){
            $_SESSION['Admin']=$userA;
            header("location:AdministradorHome.php");
        } else{
            include("Indice.html");
     ?>
       <script>alert("ERROR DE AUTENTIFICACION");</script>
      
       <?php
        }
        mysqli_free_result($resultado);
        mysqli_close($connection);
        
    } 

    ?>