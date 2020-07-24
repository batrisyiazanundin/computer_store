<?php
// required header
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
  
// include database and object files
include_once '../config/database.php';
include_once '../objects/suppliers.php';
  
// instantiate database and category object
$database = new Database();
$db = $database->getConnection();
  
// initialize object
$suppliers = new Supplier($db);
  
// query categorys
$stmt = $suppliers->read();
$num = $stmt->rowCount();
  
// check if more than 0 record found
if($num>0){
  
    // products array
    $supplier_arr=array();
    $supplier_arr["records"]=array();
  
    // retrieve our table contents
    // fetch() is faster than fetchAll()
    // http://stackoverflow.com/questions/2770630/pdofetchall-vs-pdofetch-in-a-loop
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);
  
        $supplier_item=array(
            "supplier_id" => $supplier_id,
            "supp_name" => $supp_name,
            "supp_add" => ($supp_add),
			"supp_pnum" => $supp_pnum
        );
  
        array_push($supplier_arr["records"], $supplier_item);
    }
  
    // set response code - 200 OK
    http_response_code(200);
  
    // show categories data in json format
    echo json_encode($supplier_arr);
}
  
else{
  
    // set response code - 404 Not found
    http_response_code(404);
  
    // tell the user no categories found
    echo json_encode(
        array("message" => "No supplier found.")
    );
}

?>