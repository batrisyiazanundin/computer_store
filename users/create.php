<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
  
// get database connection
include_once '../config/database.php';
  
// instantiate product object
include_once '../objects/users.php';
  
$database = new Database();
$db = $database->getConnection();
  
$users = new Us($db);
  
// get posted data
$data = json_decode(file_get_contents("php://input"));
  
// make sure data is not empty
if(
    !empty($data->firstname) &&
	!empty($data->lastname) &&
    !empty($data->email) &&
	!empty($data->contact_number)&&
	!empty($data->address)&&
	!empty($data->password)&&
    !empty($data->access_level)&&
    !empty($data->access_code)&&
    !empty($data->status)&&
    !empty($data->created)
	){
  
    // set product property values
    
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
    
  
    // create the product
    if($users->create()){
  
        // set response code - 201 created
        http_response_code(201);
  
        // tell the user
        echo json_encode(array("message" => "User was created."));
    }
  
    // if unable to create the product, tell the user
    else{
  
        // set response code - 503 service unavailable
        http_response_code(503);
  
        // tell the user
        echo json_encode(array("message" => "Unable to create user."));
    }
}
  
// tell the user data is incomplete
else{
  
    // set response code - 400 bad request
    http_response_code(400);
  
    // tell the user
    echo json_encode(array("message" => "Unable to create user. Data is incomplete."));
}
?>