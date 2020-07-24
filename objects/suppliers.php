<?php
class Supplier{
  
    // database connection and table name
    private $conn;
    private $table_name = "suppliers";
  
    // object properties
    public $supplier_id;
    public $supp_name;
    public $supp_add;
    public $supp_pnum;
  
    public function __construct($db){
        $this->conn = $db;
    }
  
    
	public function read(){
  
    //select all data
    $query = "SELECT
                supplier_id, supp_name, supp_add, supp_pnum
            FROM
                " . $this->table_name . "
            ORDER BY
                supp_name";
  
    $stmt = $this->conn->prepare( $query );
    $stmt->execute();
  
    return $stmt;
}


	function create(){
  
    // query to insert record
    $query = "INSERT INTO
                " . $this->table_name . "
            SET
                supplier_id=:supplier_id, supp_name=:supp_name, supp_add=:supp_add, supp_pnum=:supp_pnum";
  
    // prepare query
    $stmt = $this->conn->prepare($query);
  
    // sanitize
    $this->supplier_id=htmlspecialchars(strip_tags($this->supplier_id));
    $this->supp_name=htmlspecialchars(strip_tags($this->supp_name));
    $this->supp_add=htmlspecialchars(strip_tags($this->supp_add));
    $this->supp_pnum=htmlspecialchars(strip_tags($this->supp_pnum));
  
    // bind values
    $stmt->bindParam(":supplier_id", $this->supplier_id);
    $stmt->bindParam(":supp_name", $this->supp_name);
    $stmt->bindParam(":supp_add", $this->supp_add);
    $stmt->bindParam(":supp_pnum", $this->supp_pnum);
  
    // execute query
    if($stmt->execute()){
        return true;
    }
  
    return false;
      
}

	function readOne(){
  
    // query to read single record
    $query = "SELECT
                supplier_id, supp_name, supp_add, supp_pnum
            FROM
                " . $this->table_name . " 
            WHERE
                supplier_id = ?
            LIMIT
                0,1";
  
    // prepare query statement
    $stmt = $this->conn->prepare( $query );
  
    // bind id of product to be updated
    $stmt->bindParam(1, $this->supplier_id);
  
    // execute query
    $stmt->execute();
  
    // get retrieved row
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
  
    // set values to object properties
    $this->supplier_id = $row['supplier_id'];
    $this->supp_name = $row['supp_name'];
    $this->supp_add = $row['supp_add'];
    $this->supp_pnum = $row['supp_pnum'];
}

	function update(){
  
    // update query
    $query = "UPDATE
                " . $this->table_name . "
            SET
                supplier_id = :supplier_id,
                supp_name = :supp_name,
                supp_add = :supp_add,
                supp_pnum = :supp_pnum
            WHERE
                supplier_id = :supplier_id";
  
    // prepare query statement
    $stmt = $this->conn->prepare($query);
  
    // sanitize
    $this->supplier_id=htmlspecialchars(strip_tags($this->supplier_id));
    $this->supp_name =htmlspecialchars(strip_tags($this->supp_name ));
    $this->supp_add=htmlspecialchars(strip_tags($this->supp_add));
    $this->supp_pnum=htmlspecialchars(strip_tags($this->supp_pnum));
  
    // bind new values
    $stmt->bindParam(':supplier_id', $this->supplier_id);
    $stmt->bindParam(':supp_name', $this->supp_name);
    $stmt->bindParam(':supp_add', $this->supp_add);
    $stmt->bindParam(':supp_pnum', $this->supp_pnum);
  
    // execute the query
    if($stmt->execute()){
        return true;
    }
  
    return false;
}

function delete(){
  
    // delete query
    $query = "DELETE FROM " . $this->table_name . " WHERE supplier_id = ?";
  
    // prepare query
    $stmt = $this->conn->prepare($query);
  
    // sanitize
    $this->supplier_id=htmlspecialchars(strip_tags($this->supplier_id));
  
    // bind id of record to delete
    $stmt->bindParam(1, $this->supplier_id);
  
    // execute query
    if($stmt->execute()){
        return true;
    }
  
    return false;
}

function search($keywords){
  
    // select all query
    $query = "SELECT
                supplier_id, supp_name, supp_add, supp_pnum
            FROM
               " . $this->table_name . " 
            WHERE
                supp_name LIKE ? 
            ORDER BY
                supplier_id DESC";
  
    // prepare query statement
    $stmt = $this->conn->prepare($query);
  
    // sanitize
    $keywords=htmlspecialchars(strip_tags($keywords));
    $keywords = "%{$keywords}%";
  
    // bind
    $stmt->bindParam(1, $keywords);
  
    // execute query
    $stmt->execute();
  
    return $stmt;
}

public function readPaging($from_record_num, $records_per_page){
  
    // select query
    $query = "SELECT
                supplier_id, supp_name, supp_add, supp_pnum
            FROM
                " . $this->table_name . " 
            ORDER BY supplier_id DESC
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