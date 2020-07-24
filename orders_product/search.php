<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
  
// include database and object files
include_once '../config/core.php';
include_once '../config/database.php';
include_once '../objects/orders_product.php';
  
// instantiate database and employee object
$database = new Database();
$db = $database->getConnection();
  
// initialize object
$orders_product = new OP($db);
  
// get keywords
$keywords=isset($_GET["s"]) ? $_GET["s"] : "";
  
// query products
$stmt = $orders_product->search($keywords);
$num = $stmt->rowCount();
  
// check if more than 0 record found
if($num>0){
  
    // products array
	$op_arr=array();
    $op_arr["records"]=array();
  
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
  
    // set response code - 200 OK
    http_response_code(200);
  
    // show products data
    echo json_encode($op_arr);
}
  
else{
    // set response code - 404 Not found
    http_response_code(404);
  
    // tell the user no products found
    echo json_encode(
        array("message" => "No orders product found.")
    );
}
?>