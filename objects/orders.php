<?php
class Orders{
  
    // database connection and table name
    private $conn;
    private $table_name = "orders";
  
    // object properties
	public $order_id;
    public $order_date;
    public $id;
  
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }
	
	// read products
	function read(){
  
  
  
    // select all query
    $query = "SELECT
                u.id, o.order_id, o.order_date, o.id
            FROM
                orders o
                LEFT JOIN
                    users u
                        ON o.id = u.id
            ORDER BY
                o.order_id DESC";
  

    // prepare query statement
    $stmt = $this->conn->prepare($query);
  
    // execute query
    $stmt->execute();
  
    return $stmt;
}

	// create orders
	function create(){
  
    // query to insert record
    $query = "INSERT INTO
                " . $this->table_name . "
            SET
                order_id=:order_id,
				order_date=:order_date,
				id=:id";
				
    // prepare query
    $stmt = $this->conn->prepare($query);
  
    // sanitize
    $this->order_id=htmlspecialchars(strip_tags($this->order_id));
	$this->order_date=htmlspecialchars(strip_tags($this->order_date));
	$this->id=htmlspecialchars(strip_tags($this->id));
  
    // bind values
    $stmt->bindParam(":order_id", $this->order_id);
	$stmt->bindParam(":order_date", $this->order_date);
    $stmt->bindParam(":id", $this->id);
  
    // execute query
    if($stmt->execute()){
        return true;
    }
  
    return false;
      
}

// used when filling up the update orders form
function readOne(){
  
    // query to read single record
    $query = "SELECT
                o.order_id, o.order_date, o.id
            FROM
                " . $this->table_name . " o
                LEFT JOIN
                    users u
                       ON o.id = u.id
            WHERE
                o.order_id = ?
            LIMIT
                0,1";
  
    // prepare query statement
    $stmt = $this->conn->prepare( $query );
  
    // bind id of product to be updated
    $stmt->bindParam(1, $this->order_id);
  
    // execute query
    $stmt->execute();
  
    // get retrieved row
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
  
    // set values to object properties
    $this->order_id = $row['order_id'];
    $this->order_date = $row['order_date'];
    $this->id= $row['id'];
}

// update the orders
function update(){
  
    // update query
    $query = "UPDATE
                " . $this->table_name . "
            SET
				order_id=:order_id,
				order_date=:order_date, 
				id=:id
            WHERE
                order_id =:order_id";
  
    // prepare query statement
    $stmt = $this->conn->prepare($query);
  
    // sanitize
	$this->order_id=htmlspecialchars(strip_tags($this->order_id));
	$this->order_date=htmlspecialchars(strip_tags($this->order_date));
	$this->id=htmlspecialchars(strip_tags($this->id));

    // bind new values
    $stmt->bindParam(":order_id", $this->order_id);
	$stmt->bindParam(":order_date", $this->order_date);
    $stmt->bindParam(":id", $this->id);
  
    // execute the query
    if($stmt->execute()){
        return true;
    }
  
    return false;
}

// delete the orders
function delete(){
  
    // delete query
    $query = "DELETE FROM " . $this->table_name . " WHERE order_id = ?";
  
    // prepare query
    $stmt = $this->conn->prepare($query);
  
    // sanitize
    $this->order_id=htmlspecialchars(strip_tags($this->order_id));
  
    // bind id of record to delete
    $stmt->bindParam(1, $this->order_id);
  
    // execute query
    if($stmt->execute()){
        return true;
    }
  
    return false;
}

// search products
function search($keywords){
  
    // select all query
    $query = "SELECT
                u.id, o.order_id, o.order_date, o.id
            FROM
                orders o
                LEFT JOIN
                    users u
                        ON o.id = u.id
            WHERE
                o.order_date LIKE ?
            ORDER BY
                o.order_id DESC";
  
    // prepare query statement
    $stmt = $this->conn->prepare($query);
  
    // sanitize
    $keywords=htmlspecialchars(strip_tags($keywords));
    $keywords = "%{$keywords}%";
  
    // bind
    $stmt->bindParam(1, $keywords);
    $stmt->bindParam(2, $keywords);
    $stmt->bindParam(3, $keywords);
  
    // execute query
    $stmt->execute();
  
    return $stmt;
}

// read products with pagination
public function readPaging($from_record_num, $records_per_page){
  
    // select query
    $query = "SELECT
                u.id, o.order_id, o.order_date, o.id
            FROM
                orders o
                LEFT JOIN
                    users u
                        ON o.id = u.id
            ORDER BY o.order_id DESC
            LIMIT ?, ?";
  
    // prepare query statement
    $stmt = $this->conn->prepare( $query );
  
    // bind variable values
    $stmt->bindParam(1, $from_record_num, PDO::PARAM_INT);
    $stmt->bindParam(2, $records_per_page, PDO::PARAM_INT);
  
    // execute query
    $stmt->execute();
  
    // return values from database
    return $stmt;
}

// used for paging products
public function count(){
    $query = "SELECT COUNT(*) as total_rows FROM " . $this->table_name . "";
  
    $stmt = $this->conn->prepare( $query );
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
  
    return $row['total_rows'];
}
}
?>