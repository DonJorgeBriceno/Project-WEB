<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="script.js"></script>
</head>

<body>

    <?php
 include('Conection.php');
        error_reporting(0);
    if (isset($_POST["Ingreso"])){ 
       
        $userT= $_POST["userT"];
        $keyT= $_POST["keyT"];

        session_start();

        $consulta="SELECT COUNT(*) AS CONTAR FROM tejedor where mailT='$userT' and passT='$keyT'";
        $consulta2="SELECT * FROM tejedor where mailT='$userT' and passT='$keyT'";
        $resultado=mysqli_query($connection,$consulta);

        $temp=mysqli_query($connection,$consulta2);

        $filas=mysqli_fetch_array($resultado);


        $row = mysqli_fetch_array($temp);
        $name = $row['nameT'];
       
        
        if($filas['CONTAR']>0){
            $_SESSION['Tejedor']=$name;
            header("location:TejedorHome.php");
        } else{
            echo  '<script type="text/javascript">'
            , 'Alert_Direccion(3,"Error de autenticación","Indice.html");'
            , '</script>';
        }

        mysqli_free_result($resultado);
        mysqli_close($connection);
        
    }   
    else if (isset($_POST["Registro"])){        
        $nameT= $_POST["nameT"];
        $passT= $_POST["passT"];
        $mailT= $_POST["mailT"];
        $direT= $_POST["direT"];
        //Recorrer BBDD para verificar que no hayan datos repetidos
        $aux=true;
        $query= "SELECT nameT, mailT, direT FROM tejedor";
        $res = mysqli_query($connection, $query);
        while ($row = mysqli_fetch_assoc($res)) {
          if($nameT==$row['nameT']){
            $aux=false;  
            echo  '<script type="text/javascript">'
            , 'Alert_Direccion(3,"Ya existe un usuario con tu mismo nombre, sé creativo :(","Indice.html");'
            , '</script>';
          } elseif($mailT==$row['mailT']){
            $aux=false;  
            echo  '<script type="text/javascript">'
            , 'Alert_Direccion(3,"Este correo ya se registró :(","Indice.html");'
            , '</script>';

          }elseif($direT==$row['direT']){
            $aux=false;  
            echo  '<script type="text/javascript">'
            , 'Alert_Direccion(3,"Tu dirección ya está en uso :O","Indice.html");'
            , '</script>';
          }
          
        }//Cierre del while para recorrer la BBDD   
          
        if($aux){
            $query = "INSERT into tejedor(nameT, passT, mailT, direT) VALUES ('$nameT', '$passT', '$mailT','$direT')";
            $result = mysqli_query($connection, $query);

            if (!$result) {
            die('Query Failed en el registro.');
            } else{
            echo  '<script type="text/javascript">'
               , 'Alert_Direccion(1,"El registro fue exitoso, ¡serás enviado a la pantalla principal para que inicies sesión!","Indice.html");'
               , '</script>';
            
            }    
        }  

          
        
        
}
?>

</body>

</html>