<?php

session_start();

if(!isset($_SESSION['customer_id'])){
    header("Location : http://localhost/DBMS/Login%20Form/loginform.html");
    exit();
}
