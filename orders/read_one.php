<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');
  
// include database and object files
include_once '../config/database.php';
include_once '../objects/orders.php';
  
// get database connection
$database = new Database();
$db = $database->getConnection();
  
// prepare product object
$orders = new Orders($db);
  
// set ID property of record to read
$orders->order_id = isset($_GET['order_id']) ? $_GET['order_id'] : die();
  
// read the details of product to be edited
$orders->readOne();
  
if($orders->order_id!=null){
    // create array
    $orders_arr = array(
        "order_id" =>  $orders->order_id,
        "order_date" => $orders->order_date,
        "id" => $orders->id
    );
  
    // set response code - 200 OK
    http_response_code(200);
  
    // make it json format
    echo json_encode($orders_arr);
}
  
else{
    // set response code - 404 Not found
    http_response_code(404);
  
    // tell the user product does not exist
    echo json_encode(array("message" => "Orders does not exist."));
}
?>