<?php
     $connection = mysqli_connect(
        'localhost', 'root', '', 'project'
      );
      if(!$connection) {
        echo"Error en la conexion base";
      }
?>
