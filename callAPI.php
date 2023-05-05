 <?php
  

  $username = $_SERVER['PHP_AUTH_USER'];
  $password = $_SERVER['PHP_AUTH_PW'];
  // echo 'sdf';exit;
  if($username!="mksaini" || $password!="123456"){

  	$return = array(
	    'status' => 401,
	    'message' => "authorization failed"
	);
	  echo json_encode($return); 
  }else{
        include('class/RestApi.php');
        $api = new RestApi();
        $type = $_GET['type'];

  switch ($type) {
  case 'category':
        $api->getCategory();
       break;
      case 'addToCart':
          $api->addTocart($_GET['p_id'],$_GET['user_id']);
       break;
       case 'removeToCartproduct':
          $api->removeToCartproduct($_GET['p_id']);
       break;
  case 'getProductDetails':
        $api->getProductDetails($_GET['p_id']);
       break;
    case 'allproduct':
          if(isset($_GET['categoryName']) && $_GET['categoryName']!="All"){
           $api->getAllPrduct($_GET['categoryName']);
         }else{

          $api->getAllPrduct("All");
         }
       break;
   case 'allcartproduct':
           $api->allcartproduct($_GET['user_id']);
        break;
   default:
       echo 'not API Found';exit;
    break;
}


   
		
    
		


  }
 
 
?>