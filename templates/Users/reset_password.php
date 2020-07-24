<?php
// core configuration
include_once "config/core.php";
 
// set page title
$page_title = "Reset Password";
 
// include login checker
include_once "login_checker.php";
 
// include classes
include_once "config/database.php";
include_once "objects/users.php";
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// initialize objects
$users = new Us($db);
 
// include page header HTML
include_once "layout_head.php";
 
echo "<div class='col-sm-12'>";
 
    // check acess code will be here
// get given access code
$access_code=isset($_GET['access_code']) ? $_GET['access_code'] : die("Access code not found.");
 
// check if access code exists
$users->access_code=$access_code;
 
if(!$users->accessCodeExists()){
    die('Access code not found.');
}
 
else{
    // reset password form will be here
    // post code will be here
    // if form was posted
if($_POST){
 
    // set values to object properties
    $users->password=$_POST['password'];
 
    // reset password
    if($users->updatePassword()){
        echo "<div class='alert alert-info'>Password was reset. Please <a href='{$home_url}login'>login.</a></div>";
    }
 
    else{
        echo "<div class='alert alert-danger'>Unable to reset password.</div>";
    }
}
 
echo "<form action='" . htmlspecialchars($_SERVER["PHP_SELF"]) . "?access_code={$access_code}' method='post'>
    <table class='table table-hover table-responsive table-bordered'>
        <tr>
            <td>Password</td>
            <td><input type='password' name='password' class='form-control' required></td>
        </tr>
        <tr>
            <td></td>
            <td><button type='submit' class='btn btn-primary'>Reset Password</button></td>
        </tr>
    </table>
</form>";
}
 
echo "</div>";
 
// include page footer HTML
include_once "layout_foot.php";
?>