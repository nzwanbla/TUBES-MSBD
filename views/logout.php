<?php

    require '../include/Conn_function.php';
    
    if (session_destroy())
    {
        header("Location: ./login.php");
    }

?>