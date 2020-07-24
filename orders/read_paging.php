<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
  
// include database and object files
include_once '../config/core.php';
include_once '../shared/utilities.php';
include_once '../config/database.php';
include_once '../objects/orders.php';
  
// utilities
$utilities = new Utilities();
  
// instantiate database and orders object
$database = new Database();
$db = $database->getConnection();
  
// initialize object
$orders = new Orders($db);
  
// query products
$stmt = $orders->readPaging($from_record_num, $records_per_page);
$num = $stmt->rowCount();
  
// check if more than 0 record found
if($num>0){
  
    // products array
	$order_arr=array();
    $order_arr["records"]=array();
	$order_arr["paging"]=array();
  
    // retrieve our table contents
    // fetch() is faster than fetchAll()
    // http://stackoverflow.com/questions/2770630/pdofetchall-vs-pdofetch-in-a-loop
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);
  
        $order_item=array(
			"order_id" => $order_id,
            "order_date" => $order_date,
			"id" => $id,
        );
  
        array_push($order_arr["records"], $order_item);
    }
  
  
    // include paging
    $total_rows=$orders->count();
    $page_url="{$home_url}orders/read_paging.php?";
    $paging=$utilities->getPaging($page, $total_rows, $records_per_page, $page_url);
    $order_arr["paging"]=$paging;
  
    // set response code - 200 OK
    http_response_code(200);
  
    // make it json format
    echo json_encode($order_arr);
}
  
else{
  
    // set response code - 404 Not found
    http_response_code(404);
  
    // tell the user products does not exist
    echo json_encode(
        array("message" => "No orders found.")
    );
}
?>