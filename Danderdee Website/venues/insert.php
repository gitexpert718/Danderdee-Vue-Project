<?php 
session_start();
$postdata = file_get_contents("php://input");
$request = json_decode($postdata);
$role = $request->role;

$_SESSION['role'] = $role;




