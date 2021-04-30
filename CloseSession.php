<?php
     
    session_start();
    session_destroy();
    header("location: Indice.html");
?>