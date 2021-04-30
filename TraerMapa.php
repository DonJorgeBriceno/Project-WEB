<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>API Maps</title>
    <link rel="stylesheet" href="Bootstrap/css/bootstrap.min.css">
    <script src="Bootstrap/js/bootstrap.min.js"></script>  
     <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
   integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
   crossorigin=""/>
   <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
   integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
   crossorigin=""></script>
   <script src="script.js"></script> 
</head>

<body>


<?php
include('Conection.php');
$query = "SELECT lon, lat FROM tejedor WHERE lon IS NOT NULL AND lat IS NOT NULL";
          $result = mysqli_query($connection, $query);
          if (!$result) {
              echo "Hubo un error en la consulta";
          } else{
               ?>  
                 
                 
                 <div id="myMap" style="height: 580px; width:900px">
                </div>
                  <script>
                        const tilesProvider ='https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png'
                        let myMap = L.map('myMap').setView([4.7336925, -74.125371], 18)
                        L.tileLayer(tilesProvider, {
                        maxZoom: 15, 
                        }).addTo(myMap)
                  </script>
              <?php 
              while ($row = mysqli_fetch_assoc($result)) {
               ?>   
                <script>
                    L.marker([<?php echo $row['lon']?>,<?php echo $row['lat']?>]).addTo(myMap);
                </script>
                <?php 
              }
              
          }
    
    
?>
</body>

</html>