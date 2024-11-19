<?php

    ob_start();
    session_start();
    session_destroy();
    error_reporting(0);

    require_once('db_connection.php');
    require_once('generate.php');

?>