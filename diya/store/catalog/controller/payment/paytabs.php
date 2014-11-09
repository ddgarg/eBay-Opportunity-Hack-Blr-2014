<?php

ob_start();
class ControllerPaymentPaytabs extends Controller {


// class constructor

	public function sendRequest($gateway_url, $request_string){

		$ch = @curl_init();
		@curl_setopt($ch, CURLOPT_URL, $gateway_url);
		@curl_setopt($ch, CURLOPT_POST, true);
		@curl_setopt($ch, CURLOPT_POSTFIELDS, $request_string);
		@curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		@curl_setopt($ch, CURLOPT_HEADER, false);
		@curl_setopt($ch, CURLOPT_TIMEOUT, 30);
		@curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		@curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
		@curl_setopt($ch, CURLOPT_VERBOSE, true);
		$result = @curl_exec($ch);
		if (!$result)
			die(curl_error($ch));

		@curl_close($ch);
		
		return $result;
	}
	









protected function index() {

$this->load->model('checkout/order');

		$this->language->load('payment/paytabs');

		$this->data['button_confirm'] = $this->language->get('button_confirm');




		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/payment/paytabs.tpl')) {
			$this->template = $this->config->get('config_template') . '/template/payment/paytabs.tpl';
		} else {
			$this->template = 'default/template/payment/paytabs.tpl';
		}	
	       	    $this->render();
	
	}







	

  public function success() {

	$this->load->model('checkout/order');

				
       //if api_key exists
      if (isset($_SESSION['api_key'])) {
     
          $api_key = $_SESSION['api_key'];
		  $request_param =array('api_key'=>$api_key, 'payment_reference'=>$_POST['payment_reference']);
		  $request_string = http_build_query($request_param);



		 //Send data for verification
		 $response_data = $this->sendRequest('https://www.paytabs.co/api/verify_payment',$request_string);
		 $object = json_decode($response_data);
         $response = $object->response;


               // Response & Error Codes
				switch ($response) {

					case '0': echo ' The payment is rejected  <br>';
		            echo "<a href='index.php'>Back</a>";
             

			           break;
			        case '1': echo ' The payment is prepared ';
			            break;
			        case '2': echo ' PIN rejected, payment rejected </br>';
			        echo "<a href='index.php'>Back</a>";
			  
			            break;   
					case '3': echo ' PIN accepted, payment approved ';
						break;
	                           


		    case '6': echo ' Payment is completed. 3D secure is also approved ';
		    $this->model_checkout_order->confirm($this->session->data['order_id'], $this->config->get('paytabs_order_status_id'));

			$this->redirect($this->url->link('checkout/success', '', 'SSL'));
		    break;


					case '7': echo ' Unknown status ';
					    break;


					case '10': echo ' The payment is prepared ';
					    break;

					 case '0001':
						$msg = 'Merchant ID and password does not match';
						break;

					case '0002':
						$msg = 'API Key not valid';
						break;

					case '0003':
						$msg = 'Transaction ID not found';
						break;

					case '0004':
						$msg = 'Unknown transaction error occurred';
						break;

					case '0005':
						$msg = 'The currency code is not available for this merchant';
						break;

					default:
						echo 'Unknown Error !';
				echo "<a href='index.php'><br> Please try later</a>";

						break;
				}
									
						
			// if Sessions api_key doesn't exist
   		        } else {
	     	 $error = 'No API Key';
	    	echo 'payment_error=' . $error;
	       }

		


			


		}
 



	public function callback() {
		
   
	} 




	public function send() {
		$this->language->load('payment/paytabs');
        $this->load->model('checkout/order');
		         
	         $gateway_url = 'https://www.paytabs.co/';//
			$request_auth = array(
			'merchant_id' => $this->config->get('paytabs_merchant'),
			'merchant_password' => $this->config->get('paytabs_security')
			);

			$api_data   = $this->sendRequest($gateway_url.'api/authentication/',$request_auth);
			
			$object_api = json_decode($api_data);
			if ($object_api->access=='denied') {
             echo " Something wrong with the Payment Module configuration .. Contact Site Administrator ";
             die;
			}

			$api_key    = $object_api->api_key;

	       $_SESSION['api_key'] = $api_key;   

	       foreach ($this->cart->getProducts() as $product) {
	        	//print_r($this->cart->getProducts());exit();
	        	$product_name     = $product['name'];
	        	$product_quantity = $product['quantity'];
	        	$price_unit     = $product['price'];
	        	$price_total     = $product['total'];
	    	    $products = $product['quantity'] . ' x ' . $product['name'] . ', ';
	         }

		     $order_info = $this->model_checkout_order->getOrder($this->session->data['order_id']);

		   $payment_data = array(

			'api_key'              => $api_key,
			'cc_first_name'        => $order_info['payment_firstname'],
			'cc_last_name'         => $order_info['payment_lastname'],
			'phone_number'         => $order_info['telephone'],
			'billing_address'      => $order_info['payment_address_1'],
			'city'                 => $order_info['payment_city'],
			'state'                => $order_info['payment_zone'],
			'postal_code'          =>  $order_info['payment_postcode'],
			'country'              => $order_info['payment_iso_code_3'],
			'email'                => $order_info['email'],
			'amount'               => $this->currency->format($order_info['total'], $order_info['currency_code'], $order_info['currency_value'], false),
			'currency'             => $order_info['currency_code'],
			'title'                => $order_info['payment_address_1'].' '.$order_info['payment_city'],
			'ip_customer'          => $_SERVER['REMOTE_ADDR'],
			'ip_merchant'          => $_SERVER['SERVER_ADDR'],
            'address_shipping'     => $order_info['payment_address_1'],
            'city_shipping'        => $order_info['payment_city'],
            'state_shipping'       => $order_info['payment_city'],
            'postal_code_shipping' => $order_info['payment_postcode'],
            'country_shipping'     => $order_info['payment_iso_code_3'],
            'quantity'             => $product_quantity,
            "unit_price"           => $price_unit,
            "products_per_title"   => $product_name,
            'ProductCategory'      => $product_name,
            'ProductName'          => $product_name,
            'ShippingMethod'       => 'Paytabs',
            'CustomerId'           =>'16',
            'msg_lang'             =>'English',
            'return_url'           => $this->url->link('payment/paytabs/success', 'order_id=' . $this->session->data['order_id'])

			
		);
        // ;		    



         $request_string1 = http_build_query($payment_data);	
		 $response_data = $this->sendRequest('https://www.paytabs.co/api/create_pay_page', $request_string1);
		 $object = json_decode($response_data);
		 			
		   if(isset($object->payment_url) && $object->payment_url != ''){ 
				 $url = $object->payment_url;
				 $pid = $object->p_id;
                
                 $_SESSION['url'] = $url;
                 $_SESSION['pid'] = $pid;
   
 			}else { 
		         // Here Error
			    echo('<div class="error">Error  </div>');
		  }	


		
		$url = $_SESSION['url'];
		 $this->redirect($url);			
    }
	



}



?>