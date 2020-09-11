<?php
/**
 * Created by PhpStorm.
 * User: ASUS
 * Date: 9/6/2020
 * Time: 1:18 PM
 */

session_start();
session_destroy();
header('location:login.php');