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
include_once '../objects/products.php';
  
$database = new Database();
$db = $database->getConnection();
  
$products = new Product($db);
  
// get posted data
$data = json_decode(file_get_contents("php://input"));
  
// make sure data is not empty
if(
    !empty($data->product_id) &&
    !empty($data->brand) &&
	!empty($data->product_name) &&
    !empty($data->price) &&
	!empty($data->supplier_id)
	){
  
    // set product property values
    $products->product_id = $data->product_id;
    $products->brand = $data->brand;
	$products->product_name = $data->product_name;
    $products->price = $data->price;
    $products->supplier_id = $data->supplier_id;
  
    // create the product
    if($products->create()){
  
        // set response code - 201 created
        http_response_code(201);
  
        // tell the user
        echo json_encode(array("message" => "Products was created."));
    }
  
    // if unable to create the product, tell the user
    else{
  
        // set response code - 503 service unavailable
        http_response_code(503);
  
        // tell the user
        echo json_encode(array("message" => "Unable to create products."));
    }
}
  
// tell the user data is incomplete
else{
  
    // set response code - 400 bad request
    http_response_code(400);
  
    // tell the user
    echo json_encode(array("message" => "Unable to create products. Data is incomplete."));
}
?>