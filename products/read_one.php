<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');
  
// include database and object files
include_once '../config/database.php';
include_once '../objects/products.php';
  
// get database connection
$database = new Database();
$db = $database->getConnection();
  
// prepare product object
$products = new Product($db);
  
// set ID property of record to read
$products->product_id = isset($_GET['product_id']) ? $_GET['product_id'] : die();
  
// read the details of product to be edited
$products->readOne();
  
if($products->product_name!=null){
    // create array
    $product_arr = array(
        "product_id" =>  $products->product_id,
        "product_name" => $products->product_name,
        "brand" => $products->brand,
        "price" => $products->price,
        "supplier_id" => $products->supplier_id
  
    );
  
    // set response code - 200 OK
    http_response_code(200);
  
    // make it json format
    echo json_encode($product_arr);
}
  
else{
    // set response code - 404 Not found
    http_response_code(404);
  
    // tell the user product does not exist
    echo json_encode(array("message" => "Products does not exist."));
}
?>