<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
  
// include database and object file
include_once '../config/database.php';
include_once '../objects/orders_product.php';
  
// get database connection
$database = new Database();
$db = $database->getConnection();
  
// prepare order_product object
$orders_product = new OP($db);
  
// get order_product id
$data = json_decode(file_get_contents("php://input"));
  
// set order_product id to be deleted
$orders_product->product_id = $data->product_id;
$orders_product->order_id = $data->order_id;

// delete the order_product
if($orders_product->delete()){
  
    // set response code - 200 ok
    http_response_code(200);
  
    // tell the user
    echo json_encode(array("message" => "OP was deleted."));
}
  
// if unable to delete the order_product
else{
  
    // set response code - 503 service unavailable
    http_response_code(503);
  
    // tell the user
    echo json_encode(array("message" => "Unable to delete orders_product."));
}
?>