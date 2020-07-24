<?php
// core configuration
include_once "config/core.php";
 
// include classes
include_once 'config/database.php';
include_once 'objects/users.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// initialize objects
$users = new Us($db);
 
// set access code
$users->access_code=isset($_GET['access_code']) ? $_GET['access_code'] : "";
 
// verify if access code exists
if(!$users->accessCodeExists()){
    die("ERROR: Access code not found.");
}
 
// redirect to login
else{
     
    // update status
    $users->status=1;
    $users->updateStatusByAccessCode();
     
    // and the redirect
    header("Location: {$home_url}login.php?action=email_verified");
}
?>