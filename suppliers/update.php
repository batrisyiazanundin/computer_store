<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
  
// include database and object files
include_once '../config/database.php';
include_once '../objects/suppliers.php';
  
// get database connection
$database = new Database();
$db = $database->getConnection();
  
// prepare product object
$suppliers = new Supplier($db);
  
// get id of product to be edited
$data = json_decode(file_get_contents("php://input"));
  
// set ID property of product to be edited
$suppliers->supplier_id = $data->supplier_id;
  
// set product property values
$suppliers->supplier_id = $data->supplier_id;
$suppliers->supp_name = $data->supp_name;
$suppliers->supp_add = $data->supp_add;
$suppliers->supp_pnum = $data->supp_pnum;
  
// update the product
if($suppliers->update()){
  
    // set response code - 200 ok
    http_response_code(200);
  
    // tell the user
    echo json_encode(array("message" => "Suppliers was updated."));
}
  
// if unable to update the product, tell the user
else{
  
    // set response code - 503 service unavailable
    http_response_code(503);
  
    // tell the user
    echo json_encode(array("message" => "Unable to update supplier."));
}
?>