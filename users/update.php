<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
  
// include database and object files
include_once '../config/database.php';
include_once '../objects/users.php';
  
// get database connection
$database = new Database();
$db = $database->getConnection();
  
// prepare user object
$users = new Us($db);
  
// get id of user to be edited
$data = json_decode(file_get_contents("php://input"));
  
// set ID property of user to be edited
$users->id = $data->id;
  
// set user property values
	$users->id = $data->id;
    $users->firstname = $data->firstname;
	$users->lastname = $data->lastname;
    $users->email = $data->email;
    $users->contact_number = $contact_number;
	$users->address = $data->address;
	$users->password = $data->password;
	$users->access_level = $data->access_level;
    $users->access_code = $data->access_code;
    $users->status = $data->status;
    $users->created = $data->created;
    $users->modified = $data->modified;

// update the user
if($users->update()){
  
    // set response code - 200 ok
    http_response_code(200);
  
    // tell the user
    echo json_encode(array("message" => "User was updated."));
}
  
// if unable to update the user, tell the user
else{
  
    // set response code - 503 service unavailable
    http_response_code(503);
  
    // tell the user
    echo json_encode(array("message" => "Unable to update user."));
}
?>