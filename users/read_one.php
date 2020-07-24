<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');
  
// include database and object files
include_once '../config/database.php';
include_once '../objects/users.php';
  
// get database connection
$database = new Database();
$db = $database->getConnection();
  
// prepare users object
$users = new Us($db);
  
// set ID property of record to read
$users->id = isset($_GET['id']) ? $_GET['id'] : die();
  
// read the details of user to be edited
$users->readOne();
  
if($users->id!=null){
    // create array
    $us_arr = array(
        "id" =>  $users->id,
        "firstname" => $users->firstname,
        "lastname" => $users->lastname,
        "contact_number" => $users->contact_number,
        "address" => $users->address,
		"password" => $users->password,
		"access_level" => $users->access_level,
		"access_code" => $users->access_code,
        "status" => $users->status,
        "created" => $users->created,
        "modified" => $users->modified,
    );
  
    // set response code - 200 OK
    http_response_code(200);
  
    // make it json format
    echo json_encode($us_arr);
}
  
else{
    // set response code - 404 Not found
    http_response_code(404);
  
    // tell the user user does not exist
    echo json_encode(array("message" => "user does not exist."));
}
?>