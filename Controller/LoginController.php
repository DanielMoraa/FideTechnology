<?php
    if(isset($_POST["btnIniciarSesion"]))
    {
        //echo $_POST["txtIdentificacion"] . ' ' .  $_POST["txtContrasenna"];
        //Cálculo, validación, lógica de negocio, etc.
        //Llamar al Modelo, pasarle id y contra para ver si existe en la BD

        header('location: ../../View/Login/home.php'); 
    }
?>