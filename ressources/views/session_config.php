<?php
session_start();
//connection à la bdd
require($_SERVER['DOCUMENT_ROOT'] . '/layout.php');
$_SESSION['current_page'] = $_SERVER['REQUEST_URI'];
