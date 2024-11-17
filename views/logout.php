<?php

    require '../include/Admin_function.php';
    
    if (session_destroy())
    {
        header("Location: ./login.php");
    }

?>