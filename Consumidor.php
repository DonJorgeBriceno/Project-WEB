<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="script.js"></script>
</head>

<body>

    <?php
 include('Conection.php');
    if (isset($_POST["Ingreso"])){ 
       
        $userC= $_POST["userC"];
        $keyC= $_POST["keyC"];

        session_start();

        $consulta="SELECT COUNT(*) AS CONTAR FROM consumidor where mailC='$userC' and passC='$keyC'";
        $consulta2="SELECT nameC FROM consumidor where mailC='$userC' and passC='$keyC'";

        $temp=mysqli_query($connection,$consulta2);
        $row = mysqli_fetch_array($temp);
        $name = $row['nameC'];

        $resultado=mysqli_query($connection,$consulta);
        $filas=mysqli_fetch_array($resultado);
        if($filas['CONTAR']>0){
            $_SESSION['Consumidor']=$name;
            header("location:TraerPublicaciones.php");
        } else{
            include("Indice.html");
     ?>
    <script>
    alert("ERROR DE AUTENTIFICACION");
    </script>

    <?php
        }
        mysqli_free_result($resultado);
        mysqli_close($connection);
        
    }   
    else if (isset($_POST["Registro"])){
        
        $nameC= $_POST["nameC"];
        $passC= $_POST["passC"];
        $mailC= $_POST["mailC"];
        $direC= $_POST["direC"];

        //Recorrer BBDD para verificar que no hayan datos repetidos
        $aux=true;
        $query= "SELECT nameC, mailC, direC FROM consumidor";
        $res = mysqli_query($connection, $query);
        while ($row = mysqli_fetch_assoc($res)) {
          if($nameC==$row['nameC']){
            $aux=false;  
            echo  '<script type="text/javascript">'
            , 'Alert_Direccion(3,"Ya existe un usuario con tu mismo nombre, sé creativo :(","Indice.html");'
            , '</script>';
          } elseif($mailC==$row['mailC']){
            $aux=false;  
            echo  '<script type="text/javascript">'
            , 'Alert_Direccion(3,"Este correo ya se registró :(","Indice.html");'
            , '</script>';

          }elseif($direC==$row['direC']){
            $aux=false;  
            echo  '<script type="text/javascript">'
            , 'Alert_Direccion(3,"Tu dirección ya está en uso :O","Indice.html");'
            , '</script>';
          }
          
        }//Cierre del while para recorrer la BBDD   
        
        if($aux){
                $query = "INSERT into consumidor(nameC, passC, mailC, direC) VALUES ('$nameC', '$passC', '$mailC', '$direC')";
                $result = mysqli_query($connection, $query);

                if (!$result) {
                die('Query Failed en el registro de la tabla consumidor');
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