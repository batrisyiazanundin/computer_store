<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');
  
// include database and object files
include_once '../config/database.php';
include_once '../objects/suppliers.php';
  
// get database connection
$database = new Database();
$db = $database->getConnection();
  
// prepare product object
$suppliers = new Supplier($db);
  
// set ID property of record to read
$suppliers->supplier_id = isset($_GET['supplier_id']) ? $_GET['supplier_id'] : die();
  
// read the details of product to be edited
$suppliers->readOne();
  
if($suppliers->supp_name!=null){
    // create array
    $supplier_arr = array(
        "supplier_id" =>  $suppliers->supplier_id,
        "supp_name" => $suppliers->supp_name,
        "supp_add" => $suppliers->supp_add,
        "supp_pnum" => $suppliers->supp_pnum
    );
  
    // set response code - 200 OK
    http_response_code(200);
  
    // make it json format
    echo json_encode($supplier_arr);
}
  
else{
    // set response code - 404 Not found
    http_response_code(404);
  
    // tell the user product does not exist
    echo json_encode(array("message" => "Suppliers does not exist."));
}
?>