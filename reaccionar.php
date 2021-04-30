<?php
     include('Conection.php');
     $idPublicacion = $_GET['idPublicacion'];
     $userReaccion = $_GET['userReaccion'];
     $action = $_GET['action'];
     echo "Id tomada ".$idPublicacion." UserReaccion: ". $userReaccion;
     if($action=='reaccionar'){
          $query = "UPDATE publicaciones SET rate= (rate+1), user_reaccion='$userReaccion' WHERE publicaciones.IDPublicacion=$idPublicacion";
          $result = mysqli_query($connection, $query);
          if (!$result) {
               echo "Query Failed en el registro.";
          }else{
               
               echo "Query Success: Se subió el like.";
          }

     }
     if($action=='quitarReaccion'){
          $query = "UPDATE publicaciones SET rate= (rate-1), user_reaccion='$userReaccion' WHERE publicaciones.IDPublicacion=$idPublicacion";
          $result = mysqli_query($connection, $query);
          if (!$result) {
               echo "Query Failed en el registro.";
          }else{
               echo "Query Success: Se quitó el like.";
          }
     }
?>