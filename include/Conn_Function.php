<?php

if (!isset($_SESSION)) 
{
    session_start();
}

function conn()
{  
    $host = 'localhost';
    $user = 'root';
    $pass = '';
    $database = 'dbperpussman2';

    return mysqli_connect($host, $user, $pass, $database);
}

function query($query)
{
    return mysqli_query(conn(), $query);
}




?>
