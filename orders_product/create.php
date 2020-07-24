<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
  
// get database connection
include_once '../config/database.php';
  
// instantiate order_product object
include_once '../objects/orders_product.php';
  
$database = new Database();
$db = $database->getConnection();
  
$orders_product = new OP($db);
  
// get posted data
$data = json_decode(file_get_contents("php://input"));
  
// make sure data is not empty
if(
    !empty($data->product_id) &&
	!empty($data->order_id) &&
	!empty($data->quantity) 
	){
  
    // set order_product property values
    $orders_product->product_id = $data->product_id;
    $orders_product->order_id = $data->order_id;
	$orders_product->quantity = $data->quantity;
  
    // create the order_product
    if($orders_product->create()){
  
        // set response code - 201 created
        http_response_code(201);
  
        // tell the user
        echo json_encode(array("message" => "OP was created."));
    }
  
    // if unable to create the order_product, tell the user
    else{
  
        // set response code - 503 service unavailable
        http_response_code(503);
  
        // tell the user
        echo json_encode(array("message" => "Unable to create orders_product."));
    }
}
  
// tell the user data is incomplete
else{
  
    // set response code - 400 bad request
    http_response_code(400);
  
    // tell the user
    echo json_encode(array("message" => "Unable to create orders_product. Data is incomplete."));
}
?>