<?php

session_start();

$_SESSION['user_id'] = 1;

$db = new PDO();

if(!isset($_SESSION['user_id'])) {
    die('You are not signed in');
}