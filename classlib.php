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
    public function createClientData()
    {
        // Generate Password
        $characters ='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $user["password"]='';

        for ($p=0; $p<8; $p++) {
            $user["password"].= $characters[mt_rand(0,strlen($characters)-1)];
        }

        //Generate user salt
        $user["user_salt"] = $this->randomString();

        //Salt and Hash the password
        $password = $user["user_salt"] . $user["password"];
        $user["salted_password"] = $this->hashData($password);

        //Create verification code
        $user["verification_code"] = $this->randomString();

        return $user;


    }
	public function getDocuments() {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://api.current-rms.com/api/v1/products/49/prepare_document.pdf?document_id=25");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $this->headers);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        $server_output = curl_exec ($ch);
        curl_close ($ch);

        $result = (json_decode($server_output, true));

        return $result;
		
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

    public function getMultipleContactsById($id) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,"https://api.current-rms.com/api/v1/members?".$id);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $this->headers);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        $server_output = curl_exec ($ch);
        curl_close ($ch);

        $result = (json_decode($server_output, true));

        return $result;
    }
    public function createAttachment($data) {

        $ch = curl_init('https://api.current-rms.com/api/v1/attachments');
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $this->headers);

        $result = curl_exec($ch);

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
				//session_start();
				$_SESSION['token'] = $token;
				$_SESSION['user_id'] = $contact['members'][0]['id'];
                session_write_close();
				return "ok";
				die();

			} else {
			//No match, reject
				return 4;
			}

		}

	public function logout()
		{
								
			session_unset();
			session_destroy();

		}

}

class image {
	private $valid_extensions = array('jpeg', 'jpg'); // valid extensions
	private $path = 'uploads/'; // upload directory

    public function correctImageOrientation($filename)
	{
        if (function_exists('exif_read_data')) {
            $exif = exif_read_data($filename);
            if($exif && isset($exif['Orientation'])) {
                $orientation = $exif['Orientation'];
                if($orientation != 1){
                    $img = imagecreatefromjpeg($filename);
                    $deg = 0;
                    switch ($orientation) {
                        case 3:
                            $deg = 180;
                            break;
                        case 6:
                            $deg = 270;
                            break;
                        case 8:
                            $deg = 90;
                            break;
                    }
                    if ($deg) {
                        $img = imagerotate($img, $deg, 0);
                    }
                    // then rewrite the rotated image back to the disk as $filename
                    imagejpeg($img, $filename, 95);
                    return true;
                } // if there is some rotation necessary
            } // if have the exif orientation info
        } // if function exists
	}

	public function uploadImage ($type)
	{
        {
            $img = $type['name'];
            $tmp = $type['tmp_name'];

            // get uploaded file's extension
            $ext = strtolower(pathinfo($img, PATHINFO_EXTENSION));

            // can upload same image using rand function
            $final_image = rand(1000,1000000).$img;

            // check's valid format
            if(in_array($ext, $this->valid_extensions))
            {
                $path = $this->path.strtolower($final_image);

                if(move_uploaded_file($tmp,$path))
                {
                    $result = $this -> correctImageOrientation($path);

                    return $path;

                }
            }
        }
	}
}
?>
