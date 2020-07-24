<?php
class Product{
  
    // database connection and table name
    private $conn;
    private $table_name = "products";
  
    // object properties
	public $product_id;
    public $brand;
    public $product_name;
	public $price;
    public $supplier_id;
  
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }
	
	// read products
	function read(){
  
    // select all query				
	$query = "SELECT
                p.product_id, p.brand, p.product_name, p.price,  p.supplier_id
            FROM
                products p
                LEFT JOIN
                    suppliers s
                        ON p.supplier_id = s.supplier_id
            ORDER BY
                p.product_id DESC";
  

    // prepare query statement
    $stmt = $this->conn->prepare($query);
  
    // execute query
    $stmt->execute();
  
    return $stmt;
}

	// create product
	function create(){
  
    // query to insert record
    $query = "INSERT INTO
                " . $this->table_name . "
            SET
                product_id=:product_id,
				brand=:brand, 
				product_name=:product_name,
				price=:price, 
				supplier_id=:supplier_id";
				
    // prepare query
    $stmt = $this->conn->prepare($query);
  
    // sanitize
    $this->product_id=htmlspecialchars(strip_tags($this->product_id));
	$this->brand=htmlspecialchars(strip_tags($this->brand));
	$this->product_name=htmlspecialchars(strip_tags($this->product_name));
    $this->price=htmlspecialchars(strip_tags($this->price));
	$this->supplier_id=htmlspecialchars(strip_tags($this->supplier_id));
  
    // bind values
    $stmt->bindParam(":product_id", $this->product_id);
	$stmt->bindParam(":brand", $this->brand);
    $stmt->bindParam(":product_name", $this->product_name);
	$stmt->bindParam(":price", $this->price);
	$stmt->bindParam(":supplier_id", $this->supplier_id);
  
    // execute query
    if($stmt->execute()){
        return true;
    }
  
    return false;
      
}

// used when filling up the update product form
function readOne(){
  
    // query to read single record
    $query = "SELECT
                p.product_id, p.product_name, p.brand, p.price
            FROM
                " . $this->table_name . " p
                LEFT JOIN
                    suppliers s
                        ON p.supplier_id = s.supplier_id
            WHERE
                p.product_id = ?
            LIMIT
                0,1";
  
    // prepare query statement
    $stmt = $this->conn->prepare( $query );
  
    // bind id of product to be updated
    $stmt->bindParam(1, $this->product_id);
  
    // execute query
    $stmt->execute();
  
    // get retrieved row
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
  
    // set values to object properties
    $this->product_id = $row['product_id'];
	$this->product_name = $row['product_name'];
    $this->price = $row['price'];
    $this->brand = $row['brand'];
    $this->supplier_id = $row['supplier_id'];
	
}

// update the product
function update(){
  
    // update query
    $query = "UPDATE
                " . $this->table_name . "
            SET
				brand=:brand, 
				price=:price, 
				product_id=:product_id, 
				product_name=:product_name, 
				supplier_id=:supplier_id
            WHERE
                product_id = :product_id";
  
    // prepare query statement
    $stmt = $this->conn->prepare($query);
  
    // sanitize
	$this->product_id=htmlspecialchars(strip_tags($this->product_id));$this->product_name=htmlspecialchars(strip_tags($this->product_name));
	$this->brand=htmlspecialchars(strip_tags($this->brand));
	$this->product_name=htmlspecialchars(strip_tags($this->product_name));
    $this->price=htmlspecialchars(strip_tags($this->price));
	$this->supplier_id=htmlspecialchars(strip_tags($this->supplier_id));
	
    // bind new values
    $stmt->bindParam(":product_id", $this->product_id);
	$stmt->bindParam(":brand", $this->brand);
    $stmt->bindParam(":product_name", $this->product_name);
	$stmt->bindParam(":price", $this->price);
	$stmt->bindParam(":supplier_id", $this->supplier_id);
  
    // execute the query
    if($stmt->execute()){
        return true;
    }
  
    return false;
}

// delete the product
function delete(){
  
    // delete query
    $query = "DELETE FROM " . $this->table_name . " WHERE product_id = ?";
  
    // prepare query
    $stmt = $this->conn->prepare($query);
  
    // sanitize
    $this->product_id=htmlspecialchars(strip_tags($this->product_id));
  
    // bind id of record to delete
    $stmt->bindParam(1, $this->product_id);
  
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
                 p.product_id, p.product_name, p.brand, p.price, p.supplier_id, s.supp_pnum
            FROM
                " . $this->table_name . " p
                LEFT JOIN
                    suppliers s
                        ON p.supplier_id = s.supplier_id
            WHERE
                p.product_name LIKE ? OR p.brand LIKE ? OR s.supp_pnum LIKE ?
            ORDER BY
                p.supplier_id ASC";
  
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
                p.product_id, p.product_name, p.brand, p.price, p.supplier_id, s.supp_add
            FROM
                " . $this->table_name . " p
                LEFT JOIN
                    suppliers s
                        ON p.supplier_id = s.supplier_id
            ORDER BY p.brand ASC
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

public function count(){
    $query = "SELECT COUNT(*) as total_rows FROM " . $this->table_name . "";
  
    $stmt = $this->conn->prepare( $query );
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
  
    return $row['total_rows'];
}

}
?>