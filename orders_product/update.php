<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
  
// include database and object files
include_once '../config/database.php';
include_once '../objects/orders_product.php';
  
// get database connection
$database = new Database();
$db = $database->getConnection();
  
// prepare employee object
$orders_product = new OP($db);
  
// get id of employee to be edited
$data = json_decode(file_get_contents("php://input"));
  
// set ID property of employee to be edited
$orders_product->product_id = $data->product_id;

// set employee property values
$orders_product->product_id = $data->product_id;
$orders_product->order_id = $data->order_id;
$orders_product->quantity = $data->quantity;

// update the employee
if($orders_product->update()){
  
    // set response code - 200 ok
    http_response_code(200);
  
    // tell the user
    echo json_encode(array("message" => "orders_product was updated."));
}
  
// if unable to update the employee, tell the user
else{
  
    // set response code - 503 service unavailable
    http_response_code(503);
  
    // tell the user
    echo json_encode(array("message" => "Unable to update orders_product."));
}
?>