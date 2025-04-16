<?php

    function AbrirBaseDatos()
    {
        return mysqli_connect("127.0.0.1:3307", "root", "", "fidetechnology");
    }

    function CerrarBaseDatos($context)
    {
        mysqli_close($context);
    }

?>