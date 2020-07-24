<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
  
// include database and object files
include_once '../config/core.php';
include_once '../shared/utilities.php';
include_once '../config/database.php';
include_once '../objects/orders_product.php';
  
// utilities
$utilities = new Utilities();
  
// instantiate database and order_product object
$database = new Database();
$db = $database->getConnection();
  
// initialize object
$orders_product = new OP($db);
  
// query products
$stmt = $orders_product->readPaging($from_record_num, $records_per_page);
$num = $stmt->rowCount();
  
// check if more than 0 record found
if($num>0){
  
    // products array
    $op_arr=array();
    $op_arr["records"]=array();
    $op_arr["paging"]=array();
  
    // retrieve our table contents
    // fetch() is faster than fetchAll()
    // http://stackoverflow.com/questions/2770630/pdofetchall-vs-pdofetch-in-a-loop
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);
  
        $op_item=array(
			"product_id" => $product_id,
			"order_id" => $order_id,
			"quantity" => $quantity
        );
  
        array_push($op_arr["records"], $op_item);
    }
  
  
    // include paging
    $total_rows=$orders_product->count();
    $page_url="{$home_url}orders_product/read_paging.php?";
    $paging=$utilities->getPaging($page, $total_rows, $records_per_page, $page_url);
    $op_arr["paging"]=$paging;
  
    // set response code - 200 OK
    http_response_code(200);
  
    // make it json format
    echo json_encode($op_arr);
}
  
else{
  
    // set response code - 404 Not found
    http_response_code(404);
  
    // tell the user products does not exist
    echo json_encode(
        array("message" => "No products found.")
    );
}
?>