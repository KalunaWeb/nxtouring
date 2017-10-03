<?php

class current {

	private $headers = [
    'X-SUBDOMAIN:nxav',
    'X-AUTH-TOKEN:g1Qjsw4mALkfmZgKw46x',
    'Accept: application/json',
    'Content-Type: application/json'
	];

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
}
?>
