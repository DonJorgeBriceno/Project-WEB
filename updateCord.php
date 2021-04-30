<?php
    $ID=$_GET['ID'];
    $lon=$_GET['lon'];
    $lat=$_GET['lat'];
    include('Conection.php');
    //Update campo lon y lat en el tejedor en cuestión

    $consulta="UPDATE tejedor
    SET lon='$lon', lat= '$lat' WHERE tejedor.ID='$ID'";
    $result = mysqli_query($connection, $consulta);
    if (!$result) {
        echo "Query Failed en el registro.";
    }else{
        echo "Se ha actualizado el mapa del tejedor";
    }
?>