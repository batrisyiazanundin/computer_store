<?php
class OP{
  
    // database connection and table name
    private $conn;
    private $table_name = "orders_product";
  
    // object properties
	public $product_id;
    public $order_id;
	public $quantity;
  
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }
	
	// read products
	function read(){
  
    // select all query
    $query = "SELECT
                o.order_id, op.product_id, op.order_id, op.quantity
            FROM
                orders_product op
                LEFT JOIN
                    orders o
                        ON op.order_id = o.order_id
            ORDER BY
                op.product_id DESC";
				
	$query1 = "SELECT
                p.product_id, op.product_id, op.order_id, op.quantity
            FROM
                orders_product op
                RIGHT JOIN
                    product p
                        ON op.order_id = p.product_id
            ORDER BY
                op.product_id DESC";
  

    // prepare query statement
    $stmt = $this->conn->prepare($query);
	$stmt1 = $this->conn->prepare($query1);
	
    // execute query
    $stmt->execute();
	$stmt1->execute();
  
    return $stmt;
	return $stmt1;
}
}
?>