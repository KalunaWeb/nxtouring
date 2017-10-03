<?php

class current {

	private $headers = [
    'X-SUBDOMAIN:nxav',
    'X-AUTH-TOKEN:g1Qjsw4mALkfmZgKw46x',
    'Accept: application/json',
    'Content-Type: application/json'
	];

	public function __construct()
	{
		$this->siteKey =' site key here';
		
	}

	private function randomString($length = 50)
	{
		$characters ='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$string ='';

		for ($p=0; $p<$length; $p++) {
			$string .= $characters[mt_rand(0,strlen($characters)-1)];
		}

		return $string;
	}

	protected function hashData($data)
	{
		return hash_hmac('sha512',$data,$this->siteKey);
	}

	public function getProduct($id) {
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, "https://api.current-rms.com/api/v1/products/".$id);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $this->headers);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

		$server_output = curl_exec ($ch);
		curl_close ($ch);

		$result = (json_decode($server_output, true));

		return $result;
	}

		public function getProductList() {
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, "https://api.current-rms.com/api/v1/products?page=1&per_page=20&filtermode=all&q[name_or_product_group_name_or_tags_name_cont]=Vehicles");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $this->headers);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

		$server_output = curl_exec ($ch);
		curl_close ($ch);

		$result = (json_decode($server_output, true));

		return $result;
	}
	

	public function getService($id) {
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, "https://api.current-rms.com/api/v1/services/".$id);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $this->headers);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

		$server_output = curl_exec ($ch);
		curl_close ($ch);

		$result = (json_decode($server_output, true));

		return $result;
	}
	
	public function getGroupAvailability($data) {
		$ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://api.current-rms.com/api/v1/availability/group");
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $this->headers);                                                                            
		$server_output = curl_exec($ch);

		$result = (json_decode($server_output, true));

		return $result;
	}

	public function getProductAvailability($data) {
		$ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://api.current-rms.com/api/v1/availability/product");
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $this->headers);                                                                            
		$server_output = curl_exec($ch);

		$result = (json_decode($server_output, true));

		return $result;
	}

	public function checkContact($name) {
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL,"https://api.current-rms.com/api/v1/members?page=1&per_page=20&filtermode=all&q[name_or_primary_address_street_or_work_phone_number_or_work_email_address_or_identity_email_or_tags_name_cont]=".$name);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $this->headers);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

		$server_output = curl_exec ($ch);
		curl_close ($ch);

		$result = (json_decode($server_output, true));

		return $result;
	}

	public function getContact($name, $type) {
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL,"https://api.current-rms.com/api/v1/members?page=1&per_page=20&filtermode=all&q[".$type."]=".$name);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $this->headers);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

		$server_output = curl_exec ($ch);
		curl_close ($ch);

		$result = (json_decode($server_output, true));

		return $result;
	}
/*
	public function getMember($id) {
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL,"https://api.current-rms.com/api/v1/members/".$id);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $this->headers);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

		$server_output = curl_exec ($ch);
		curl_close ($ch);

		$result = (json_decode($server_output, true));

		return $result;
	}
*/
	public function createContact($data) {

		$ch = curl_init('https://api.current-rms.com/api/v1/members');
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");                         
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $this->headers);

		$result = curl_exec($ch);

		return $result;
	}

	public function updateContact($data, $id) {

		$ch = curl_init('https://api.current-rms.com/api/v1/members/'.$id);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");                         
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $this->headers);

		$result = curl_exec($ch);

		return $result;
	}


	public function createOpportunity($data) {

		$ch = curl_init('https://api.current-rms.com/api/v1/opportunities/checkout');
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");	
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $this->headers);

		$server_output = curl_exec ($ch);
		curl_close ($ch);

		$result = (json_decode($server_output, true));

		return $result;
	}

	public function getOpportunity($name, $type) {

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL,"https://api.current-rms.com/api/v1/opportunities?page=1&per_page=20&filtermode=".$type."&view_id=1&q[member_name_cont]=".$name);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $this->headers);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

		$server_output = curl_exec ($ch);
		curl_close ($ch);

		$result = (json_decode($server_output, true));

		return $result;
	}
	public function convertToOrder($id) {

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, "https://api.current-rms.com/api/v1/opportunities/".$id."/convert_to_order");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $this->headers);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

		$server_output = curl_exec ($ch);
		curl_close ($ch);

		$result = (json_decode($server_output, true));

		return $result;
	}

	public function creatediscussion($data) {

		$ch = curl_init('https://api.current-rms.com/api/v1/discussions');
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");	
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $this->headers);

		$result = curl_exec($ch);

		return $result;
	}

	public function getDisc() {
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL,"https://api.current-rms.com/api/v1/discussions/9");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $this->headers);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

		$server_output = curl_exec ($ch);
		curl_close ($ch);

		$result = (json_decode($server_output, true));

		return $result;
	}

	public function getContactById($id) {
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL,"https://api.current-rms.com/api/v1/members/".$id);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $this->headers);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

		$server_output = curl_exec ($ch);
		curl_close ($ch);

		$result = (json_decode($server_output, true));

		return $result;
	}

	public function login($email, $password)
		{
			$type = "work_email_address_or_identity_email_cont";
			$contact = $this->getContact($email, $type);

			//Salt and hash password for checking

			$password = $contact['members'][0]['custom_fields']['user_salt'] . $password;
			$password = $this->hashData($password);

			//Check email and password hash match

			$match = false;

			if ($password == $contact['members'][0]['custom_fields']['web_login_password']) {
				$match = true;
			}

			if($match == true) {

			//Email/Password combination exists, set sessions
			//First, generate a random string.

				$random = $this->randomString();
			//Build the token
				$token = $_SERVER['HTTP_USER_AGENT'] . $random;
				$token = $this->hashData($token);
						
			//Setup sessions vars
				session_start();
				$_SESSION['token'] = $token;
				$_SESSION['user_id'] = $contact['members'][0]['id'];

				return "ok";

			} else {
			//No match, reject
				return 4;
			}

		}	
}
?>
