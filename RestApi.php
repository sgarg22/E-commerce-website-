<?php
class RestApi{
    private $host  = 'localhost';
    private $user  = 'root';
    private $password   = "";
    private $database  = "sneakerhub";      
    private $empTable = 'emp';	
    private $cartTable = 'cart';	
	private $dbConnect = false;
    public function __construct(){
        if(!$this->dbConnect){ 
            $conn = new mysqli($this->host, $this->user, $this->password, $this->database);
            if($conn->connect_error){
                die("Error failed to connect to MySQL: " . $conn->connect_error);
            }else{
                $this->dbConnect = $conn;
            }
        }
    }
     // geting category list by using restapi


    public function getCategory() {		
		$empQuery = "SELECT categories FROM `stock` GROUP BY categories";	
		$resultData = mysqli_query($this->dbConnect, $empQuery);
		$categorydata = array('status'=>200);
		while( $data = mysqli_fetch_assoc($resultData) ) {
			$categorydata['data'][] = $data;
		}
		header('Content-Type: application/json');
		echo json_encode($categorydata);	
	}

 public function getAllPrduct($category) {

       if($category=="All"){
       	$empQuery = "SELECT * FROM `stock`";
       }else{
         
         $empQuery = "SELECT * FROM `stock` WHERE categories='".$category."'";
          
       } 		  
		$resultData = mysqli_query($this->dbConnect, $empQuery);
		$allProductdata = array('status'=>200);
		while( $data = mysqli_fetch_assoc($resultData) ) {
			$allProductdata['data'][] = $data;
		}
		header('Content-Type: application/json');
		echo json_encode($allProductdata);	
	}

	 public function allcartproduct($user_id) {

        $empQuery = "SELECT * FROM `cart`  WHERE user_session_id='".$user_id."'"; 	
        $resultData = mysqli_query($this->dbConnect, $empQuery);
		$allProductdata = array('status'=>200);
		while( $data = mysqli_fetch_assoc($resultData) ) {
			$allProductdata['data'][] = $data;
		}
	 
		header('Content-Type: application/json');
		echo json_encode($allProductdata);	
	}

  public function getProductDetails($p_id) {

        $empQuery = "SELECT * FROM `stock` WHERE id='".$p_id."'"; 		  
		$resultData = mysqli_query($this->dbConnect, $empQuery);
		$allProductdata = array('status'=>200);
		while( $data = mysqli_fetch_assoc($resultData) ) {
			$allProductdata['data'][] = $data;
		}
		header('Content-Type: application/json');
		echo json_encode($allProductdata);	
	}

	 public function addTocart($p_id,$user_id) {
        $empQuery = "SELECT * FROM `stock` WHERE id='".$p_id."'"; 		  
		$resultData = mysqli_query($this->dbConnect, $empQuery);
	    $data = mysqli_fetch_assoc($resultData);
        $name=$data["name"];
		$price=$data["price"];
		$quantity=1;
	    $empQuery="
			INSERT INTO ".$this->cartTable." 
			SET name='".$name."', p_id='".$p_id."', quantity='".$quantity."',price='".$price."', user_session_id='".$user_id."'";
		if( mysqli_query($this->dbConnect, $empQuery)) {
			$messgae = "Add To Cart.";
			$status = 1;			
		} 
		$Response = array(
			'status' => $status,
			'status_message' => $messgae
		);
		header('Content-Type: application/json');
		echo json_encode($Response);
	 }
	  public function removeToCartproduct($p_id) { 		
	     
	     $empQuery = "
				DELETE FROM ".$this->cartTable." 
				WHERE p_id = '".$p_id."'	ORDER BY p_id DESC";	
			if( mysqli_query($this->dbConnect, $empQuery)) {
				$messgae = " Cart Product delete.";
				$status = 1;			
			}   		
		 $Response = array(
			'status' => $status,
			'status_message' => $messgae
		);
		header('Content-Type: application/json');
		echo json_encode($Response);	
	}




	private function getData($sqlQuery) {
		$result = mysqli_query($this->dbConnect, $sqlQuery);
		if(!$result){
			die('Error in query: '. mysqli_error());
		}
		$data= array();
		while ($row = mysqli_fetch_array($result, MYSQL_ASSOC)) {
			$data[]=$row;            
		}
		return $data;
	}
	private function getNumRows($sqlQuery) {
		$result = mysqli_query($this->dbConnect, $sqlQuery);
		if(!$result){
			die('Error in query: '. mysqli_error());
		}
		$numRows = mysqli_num_rows($result);
		return $numRows;
	}
	
	 
 
}
?>