 
<?php 
session_start();
$url   = $_POST['url'];
$method= $_POST['method'];
$base_url ="http://localhost/ASSESSMENT_3/";
switch ($url) {
	  case 'getCategoryList':
             echo getCategoryList($base_url."product/categories?type=category","GET");
	    break;
	    case 'getProductDetails':
             echo getProductDetails($base_url."product/id?type=getProductDetails&p_id=".$_POST['p_id'],"GET");
	    break;
        case 'addToCartProductById':
             if(!isset($_SESSION['user_id'])){
                $user_id=   $_SESSION['user_id'] =rand(100,1000);
              }else{
                $user_id= $_SESSION['user_id'];
              }
            echo addToCartProductById($base_url."product/cart?type=addToCart&p_id=".$_POST['p_id'].'&user_id='.$user_id,"GET");
      break;

       case 'removeToCartProductById':
          echo removeToCartProductById($base_url."product/cart/remove?type=removeToCartproduct&p_id=".$_POST['p_id'],"GET");
      break;
	  case 'getAllProductList':
	     if(isset($_POST['categoryName'])){

	     		 echo getAllProductList($base_url."product/list?type=allproduct&categoryName=".$_POST['categoryName'],"GET");
	        
	      }else{
	      	 echo getAllProductList($base_url."product/list?type=allproduct&categoryName=All","GET");
	       
	       }
        
	     break;
       case 'getAllCartProductList':
             if(isset($_SESSION['user_id'])){
                $user_id=   $_SESSION['user_id'];
                 echo getAllCartProductList($base_url."product/cart/list?type=allcartproduct&user_id=".$user_id,"GET");
              } 
           
        
       break;
	 default:
		   echo 'not API Found';exit;
		break;
}

 function getCategoryList($url,$method){
    
	$login = 'mksaini';
	$password = '123456';
    $ch = curl_init();
	curl_setopt($ch, CURLOPT_URL,$url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
	curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
	curl_setopt($ch, CURLOPT_USERPWD, "$login:$password");
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST,$method);
	curl_setopt($ch, CURLOPT_POSTFIELDS,array('rm_id' => '4'));
	$result = curl_exec($ch);
	curl_close($ch);


        $result =json_decode($result,true);
        $res ="<ul><li class='cat'>All</li>";
        foreach ($result['data'] as $key => $value) {
        	 
            $res .="<li class='cat'>".$value['categories']."</li>";
        	   
        }
        
        $res .="</ul>";
	 return $res;
 }

function getAllProductList($url,$method){
  
	$login = 'mksaini';
	$password = '123456';
    $ch = curl_init();
	curl_setopt($ch, CURLOPT_URL,$url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
	curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
	curl_setopt($ch, CURLOPT_USERPWD, "$login:$password");
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST,$method);
	$result = curl_exec($ch);
	curl_close($ch);
   
    $result = json_decode($result,true);
	    $res ="<table class='catalog'>
               <tr>
                  <th>ID</th>
                  <th>PRODUCT NAME</th>
                  <th>PRICE</th>
                  <th>AVAILABILITY</th>
               </tr>";
    foreach ($result['data'] as $key => $value) {
    	$res .="<tr><td>".$value['id']."</td>";
        $res .="<td>".$value['name']."</td>";
        $res .="<td>".$value['price']."</td>";
        $res .="<td>".$value['quantity']."</td><td ><span class='view_product' data-id=".$value['id'].">View<span></td></tr>";
     }
     $res .="</table>";
     return $res;
  }
function getAllCartProductList($url,$method){
     error_reporting(0);

  $login = 'mksaini';
  $password = '123456';
    $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL,$url);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
  curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
  curl_setopt($ch, CURLOPT_USERPWD, "$login:$password");
  curl_setopt($ch, CURLOPT_CUSTOMREQUEST,$method);
  $result = curl_exec($ch);
  curl_close($ch);
   
    $result = json_decode($result,true);
      $final_array =array();

     foreach ($result['data'] as $key => $value) {
       $final_array[$value['name']]['id'] =$value['p_id'];
       $final_array[$value['name']]['name'] =$value['name'];
       $final_array[$value['name']]['price'] +=$value['price'];
       $final_array[$value['name']]['quantity'] +=$value['quantity'];
     }  

     $res ="<table id='cart_porduct'>";
     $n=1;
   foreach ($final_array as $key => $p_data) {
           $res .="<tr>
                  <td>".$p_data['quantity']."</td>
                  <td>".$key."</td>
                  <td>$".$p_data['price']."</td>
                  <td><button type='button'class='remvoe-product' data-id=".$p_data['id'].">Remove</button></td>
               </tr>";

               $total+= $p_data['price'];
     }
       $res .="</table><h1>Total : $".$total." </h1>";
     return $res;
  }


  function getProductDetails($url,$method){
  
	$login = 'mksaini';
	$password = '123456';
    $ch = curl_init();
	curl_setopt($ch, CURLOPT_URL,$url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
	curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
	curl_setopt($ch, CURLOPT_USERPWD, "$login:$password");
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST,$method);
	$result = curl_exec($ch);
	curl_close($ch);
      
    $result = json_decode($result,true);
      
	    $res ="<table>
               <tbody><tr> 
                     </tr><tr>
                        <td>Sneaker ID</td>
                        <td>".$result['data'][0]['id']."</td>
                    </tr>
                    <tr>
                        <td>Sneaker Name</td>
                        <td>".$result['data'][0]['name']."</td>
                    </tr>
                    <tr>
                        <td>Sneaker description</td>
                        <td>".$result['data'][0]['description']."</td>
                    </tr>
                    <tr>
                        <td>Sneaker Price</td>
                        <td>$".$result['data'][0]['price']."</td>
                    </tr>
                    <tr>
                    </tr>";
             if($result['data'][0]['quantity']>0){
              $res .="<td><input type='button'  class='add-to-card' data-id=".$result['data'][0]['id']." value='Add to cart'>
                        </td>"  ;         
                      }else{

                    $res .="<td><input type='button'  value='Out Of Stock'>
                        </td>"  ;          
                      }
             
                    
           $res .= "</tbody></table>";

       return $res;
  }

  function addToCartProductById($url,$method){
 
  $login = 'mksaini';
  $password = '123456';
    $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL,$url);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
  curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
  curl_setopt($ch, CURLOPT_USERPWD, "$login:$password");
  curl_setopt($ch, CURLOPT_CUSTOMREQUEST,$method);
  $result = curl_exec($ch);
  curl_close($ch);
  echo "<pre>";
    print_r($result);
    exit;
      
    $result = json_decode($result,true);
    
      
        
  }
 function removeToCartProductById($url,$method){
 
  $login = 'mksaini';
  $password = '123456';
    $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL,$url);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
  curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
  curl_setopt($ch, CURLOPT_USERPWD, "$login:$password");
  curl_setopt($ch, CURLOPT_CUSTOMREQUEST,$method);
  $result = curl_exec($ch);
  curl_close($ch);
  echo "<pre>";
    print_r($result);
    exit;
      
    $result = json_decode($result,true);
    
      
        
  }
 exit;
?>

 
