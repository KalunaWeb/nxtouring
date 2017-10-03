<?php

class db{
  private $host = "localhost";
  private $dbName = "nxtouring";
  private $user = "nxtouring";
  private $pass = "ftg95-430";
  
  private $dbh;
  private $error;
  private $qError;
  
  private $stmt;
  
  public function __construct(){
      //dsn for mysql
    $dsn = "mysql:host=".$this->host.";dbname=".$this->dbName;
    $options = array(
        PDO::ATTR_PERSISTENT    => true,
        PDO::ATTR_ERRMODE       => PDO::ERRMODE_EXCEPTION
        );
    
    try{
        $this->dbh = new PDO($dsn, $this->user, $this->pass, $options);
    }
    //catch any errors
    catch (PDOException $e){
        $this->error = $e->getMessage();
    }
    
  }
  
  public function query($query){
      $this->stmt = $this->dbh->prepare($query);
  }
  
  public function bind($param, $value, $type = null){
      if(is_null($type)){
          switch (true){
              case is_int($value):
                $type = PDO::PARAM_INT;
                break;
              case is_bool($value):
                  $type = PDO::PARAM_BOOL;
                  break;
              case is_null($value):
                  $type = PDO::PARAM_NULL;
                  break;
              default:
                  $type = PDO::PARAM_STR;
          }
      }
    $this->stmt->bindValue($param, $value, $type);
  }
  
  public function execute($val=null){
      return $this->stmt->execute($val);
      
      $this->qError = $this->dbh->errorInfo();
        if(!is_null($this->qError[2])){
	        echo $this->qError[2];
        }
        echo 'done with query';
  }
  
  public function resultset($val=null){
      $this->execute($val);
      return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
  }
  
  public function single(){
      $this->execute();
      return $this->stmt->fetch(PDO::FETCH_ASSOC);
  }
  
  public function rowCount(){
      return $this->stmt->fetchColumn();
  }
  
  public function lastInsertId(){
      return $this->dbh->lastInsertId();
  }
  
  public function beginTransaction(){
      return $this->dbh->beginTransaction();
  }
  
  public function endTransaction(){
      return $this->dbh->commit();
  }
  
  public function cancelTransaction(){
      return $this->dbh->rollBack();
  }
  
  public function debugDumpParams(){
      return $this->stmt->debugDumpParams();
  }
  
  public function queryError(){
      $this->qError = $this->dbh->errorInfo();
      if(!is_null($qError[2])){
          echo $qError[2];
      }
  }
  
}//end class db


class Auth {

	private $_siteKey;
	private $database;
	public $user_id;
	public $username;
	public $email;


	public function __construct($database)
	{
		$this->siteKey =' site key here';
		$this->database = $database;
		
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

	public function isAdmin()
		{
				$this->database->query("SELECT * FROM users WHERE id=:id");
				$this->database->bind(":id", $_SESSION['user_id']);
				$row = $this->database->single();
							
				if ($row['is_admin'] == 1) {
					return true;
				}

				return false;
					
		}

	public function createUser($user_name, $email, $password, $rms_id, $is_admin = 0)
		{

			$is_active = 1;
			$is_verified = 1;
			//Generate user salt
			$user_salt = $this->randomString();

			//Salt and Hash the password
			$password = $user_salt . $password;
			$password = $this->hashData($password);

			//Create verification code
			$code = $this->randomString();

				

				$this->database->query("SELECT * FROM users WHERE email=:email");
				$this->database->bind(":email",$email);
				$count = $this->database->rowCount();

				if($count==0){
					
				$this->database->query("INSERT INTO users(user_name,email,password,user_salt,is_verified,is_active,is_admin,verification_code,rms_id) VALUES(:uname, :email, :pass, :usalt, :verified, :active, :admin, :code, :rms)");
				$this->database->bind(":uname",$user_name);
				$this->database->bind(":email",$email);
				$this->database->bind(":pass",$password);
				$this->database->bind(":usalt",$user_salt);
				$this->database->bind(":verified",$is_verified);
				$this->database->bind(":active",$is_active);
				$this->database->bind(":admin",$is_admin);
				$this->database->bind(":code",$code);
				$this->database->bind(":rms",$rms_id);					
					if($this->database->execute())
					{
						return "registered";
						//sendVerification();
					}
					else
					{
						return "Query could not execute !";
					}
				
				}
				else{
					
					return "1"; //  not available
				}
					
		}

	public function login($email, $password)
		{
			

			$this->database->query("SELECT * FROM users WHERE email=:email");
			$this->database->bind(":email", $email);
			$row = $this->database->single();

		//Salt and hash password for checking
		$password = $row['user_salt'] . $password;
		$password = $this->hashData($password);
			
		//Check email and password hash match this->database row
		$match = false;
		if ($password == $row['password']) {
			$match = true;
		}
			
		//Convert to boolean
		$is_active = (boolean) $row['is_active'];
		$verified = (boolean) $row['is_verified'];
			
		if($match == true) {
			if($is_active == true) {
				if($verified == true) {
					//Email/Password combination exists, set sessions
					//First, generate a random string.
					$random = $this->randomString();
					//Build the token
					$token = $_SERVER['HTTP_USER_AGENT'] . $random;
					$token = $this->hashData($token);
						
					//Setup sessions vars
					session_start();
					$_SESSION['token'] = $token;
					$_SESSION['user_id'] = $row['id'];
					$user_id = $row['id'];
					$username = $row['user_name'];
					$email = $row['email'];

					
						
					//Delete old logged_in_member records for user

						
						$this->database->query("DELETE FROM logged_in_member WHERE user_id=:id");
						$this->database->bind(':id',$_SESSION['user_id']);
						$this->database->execute();
						

					//Insert new logged_in_member record for user
					
						$this->database->query("INSERT INTO logged_in_member (user_id,session_id,token) VALUES(:uid, :sesid, :token)");
						$this->database->bind(":uid",$_SESSION['user_id']);
						$this->database->bind(":sesid",session_id());
						$this->database->bind(":token",$_SESSION['token']);
						$inserted = $this->database->execute();

						//$this->database->query("UPDATE user_profile SET last_login = now() WHERE id = :uid");
						//$this->database->bind(":uid", $row['id']);
						//$this->database->execute();
							
												
				//Logged in
					if($inserted != false) {
						return "ok";
					} 
						
					return 3;
				} else {
					//Not verified
					return 1;
				}
			} else {
				//Not active
				return 2;
			}
		}
			
		//No match, reject
		return 4;
		}
	public function checkSession()
		{
		//Select the row
				$this->database->query("SELECT * FROM logged_in_member WHERE user_id=:uid");
				$this->database->bind(":uid",$_SESSION['user_id']);
				$row = $this->database->single();
					
		if($row) {

			//Check ID and Token
			if(session_id() == $row['session_id'] && $_SESSION['token'] == 	$row['token']) {
				//Id and token match, refresh the session for the next request
				$this->refreshSession();
			return true;
			}
		}

		return false;
		}

	private function refreshSession()
		{
		//Regenerate id
		session_regenerate_id();
			
		//Regenerate token
		$random = $this->randomString();
		//Build the token
		$token = $_SERVER['HTTP_USER_AGENT'] . $random;
		$token = $this->hashData($token); 
			
		//Store in session
		$_SESSION['token'] = $token;		

		$this->database->query("UPDATE logged_in_member SET token=:token, session_id=:sesid WHERE user_id=:uid");
		$this->database->bind(':token', $_SESSION['token']);
		$this->database->bind(':sesid', session_id());
		$this->database->bind(':uid', $_SESSION['user_id']);
		$this->database->execute();
				

		
		}

	public function logout()
	{
		

		$this->database->query("DELETE FROM logged_in_member WHERE user_id=:id AND session_id=:sesid AND token=:token");
		$this->database->bind(':id',$_SESSION['user_id']);
		$this->database->bind(':sesid',session_id());
		$this->database->bind(':token',$_SESSION['token']);
		$this->database->execute();
						
		session_unset();
		session_destroy();


	}

	public function getUser($id) {

		$this->database->query("SELECT * FROM users WHERE id=:uid");
  		$this->database->bind(":uid", $_SESSION['user_id']);
  		$row = $this->database->single();

  		return $row;	
	}
}

//Forum Class Begins

class forum {
    private $database;
    private $TABLE_PREFIX,$IS_ADMIN,$USER_ID,$USERNAME,$EMAIL,$notifyFromEmail,$notifySubject,$notifyCategoryText,$notifyTopicText;

    public function __construct($database,$user_id,$username,$email,$is_admin=false) {
        $config['notifyFromEmail'] = 'noreply@uktourbus.co.uk';
        $config['notifySubject'] = 'New post or topic on www.uktourbus.co.uk forums';
        $config['notifyCategoryText'] = 'New topic "%desc" was created in category "%name" by user %user.';
        $config['notifyTopicText'] = 'New post "%desc" was created in topic "%name" by user %user.';
        $config['table_prefix'] = '';

    	$this->database = $database;
    	$this->database->query("SELECT * FROM users WHERE id=:uid");
    	$this->database->bind(":uid", $_SESSION['user_id']);
    	$user = $this->database->single();
        $this->USER_ID = $user['id'];
        $this->USERNAME = $user['user_name'];
        $this->EMAIL = $user['email'];
        $this->ADMIN = $user['is_admin'];
        $this->TABLE_PREFIX = $config['table_prefix'];
        $this->setNotifyOptions($config['notifyFromEmail'],$config['notifySubject'],$config['notifyCategoryText'],$config['notifyTopicText']);

    	

    }

    public function addSection ($name) {
    	if (!$this->checkPermissions('sections')) return '403';
    	$this->database->query('INSERT INTO '.$this->TABLE_PREFIX.'sections (sec_name) VALUES(:name)');
    	$this->database->bind(":name", $name);
    	return $this->database->execute();
    }

    public function editSection ($id) {
    	if(!$this->checkPermissions('sections'))return '403';
        $this->database->query('UPDATE '.$this->TABLE_PREFIX.'sections SET sec_name=:name WHERE sec_id=:id');
        $this->database->bind(":id", (int)$id);
        return $this->database->execute();
    }

    public function delSection($id){
        if(!$this->checkPermissions('sections'))return '403';
        $this->delFromNotifyList(Array('sec_id' => $id));
        $this->database->query('SELECT cat_id FROM '.$this->TABLE_PREFIX.'categories WHERE sec_id = :id');
        $this->database->bind(":id", (int)$id);
        $cats = $this->database->resultset();
        foreach ($cats as $cat_id) {
			$this->database->query('SELECT topic_id FROM '.$this->TABLE_PREFIX.'topics WHERE cat_id = :cid');
			$this->database->bind(":cid", $cat_id);
			while($data = $this->database->single()){
				$this->delTopic($data['topic_id'],false);
			}
			$this->database->query('DELETE FROM '.$this->TABLE_PREFIX.'categories WHERE cat_id=:cid');
			$this->database->bind(":cid", $cat_id);
			$this->databse->execute();
        }
               
        $this->database->query('DELETE FROM '.$this->TABLE_PREFIX.'sections WHERE sec_id=:id');
        $this->database->bind(":id", (int)$id);
        return $this->database->execute();
    }

    public function listSections() {
    	$this->database->query('SELECT * FROM '.$this->TABLE_PREFIX.'sections');
    	return $this->database->resultset();
    }

    
    public function addCategory($name,$desc){
        if(!$this->checkPermissions('categories'))return '403';
        $this->database->query('INSERT INTO '.$this->TABLE_PREFIX.'categories (cat_name, cat_description) VALUES(:name,:desc)');
        $this->database->bind(":name", $name);
        $this->database->bind(":desc", $desc);
        return $this->database->execute();
    }

    public function editCategory($cat_id,$name,$desc){
        if(!$this->checkPermissions('categories'))return '403';
        $this->database->query('UPDATE '.$this->TABLE_PREFIX.'categories SET cat_name=:name, cat_description=:desc WHERE cat_id=:id');
        $this->database->bind(":name", $name);
        $this->database->bind(":desc", $desc);
        $this->database->bind(":id", (int)$cat_id);
        return $this->database->execute();
    }

    public function delCategory($cat_id){
        if(!$this->checkPermissions('categories'))return '403';
        $this->delFromNotifyList(Array('cat_id' => $cat_id));
        $this->database->query('SELECT topic_id FROM '.$this->TABLE_PREFIX.'topics WHERE cat_id = :cid');
        $this->database->bind(":cid", (int)$cat_id);
        while($data = $this->database->single()){
			$this->delTopic($data['topic_id'],false);
		}
        $this->database->query('DELETE FROM '.$this->TABLE_PREFIX.'categories WHERE cat_id=:cid');
        $this->database->bind(":cid", (int)$cat_id);
        return $this->database->execute();
    }

    public function listCategories($sec_id,$id=null,$orderBy=null,$limit=null){

    	$sql = 'SELECT cat_id,cat_name,cat_description FROM '.$this->TABLE_PREFIX.'categories WHERE sec_id=:sid';
    	
        if((int)$id) $sql .= ', cat_id=:cid';
        if($orderBy) $sql .= ' ORDER BY '.$orderBy;
        if($limit) $sql .= ' LIMIT '.$limit;
        $this->database->query($sql);
        if ($id) $this->database->bind(":cid", $id);
        $this->database->bind(":sid", $sec_id);
        $result = $this->database->resultset();
        
        return $result;
    }

    public function countCategories(){
        $this->database->query('SELECT * FROM '.$this->TABLE_PREFIX.'catagories');
        $result = $this->database->resultset();
        return count($result);
    }

    public function addTopic($name,$desc,$cat_id,$notify=null){
    	$this->database->query('INSERT INTO '.$this->TABLE_PREFIX.'topics (topic_name, topic_description, cat_id, user_id,topic_post_date) VALUES (:name,:desc,:cid,:uid,now())');
	   	$this->database->bind(":name", $name);
    	$this->database->bind(":desc", $desc);
    	$this->database->bind(":cid", $cat_id);
    	$this->database->bind(":uid", $this->USER_ID);
        $result = $this->database->execute();
        $insId = $this->database->lastInsertId();
		if($notify && $result)$this->addToNotifyList($insId, $cat_id);
        if($result)$this->sendNotify('cat_id', $cat_id, $name.' - '.$desc);
        return $insId;
    }

    public function editTopic($topic_id,$name,$desc,$cat_id){
        if(!$this->checkPermissions('topics', $topic_id))return '403';
        if((int)$cat_id) {$changeCid = '';}
        $this->database->query('UPDATE '.$this->TABLE_PREFIX.'topics SET topic_name=:name, topic_description=:desc, cat_id=:cid WHERE topic_id=:topic');
        $this->database->bind(":name", $name);
        $this->database->bind(":desc", $desc);
        $this->database->bind(":topic", $topic_id);
        if (isset($changeCid)) { $this->database->bind(":cid", (int)$cat_id);}
        return $this->database->execute();
    	}
    


    public function delTopic($topic_id,$checkPerm=true){
        if(!$this->checkPermissions('topics', $topic_id) && $checkPerm)return '403';
		$this->delFromNotifyList(Array('topic_id' => $topic_id));
		$this->database->query('SELECT post_id FROM '.$this->TABLE_PREFIX.'posts WHERE topic_id=:tid');
		$this->database->bind(":tid", (int)$topic_id);
		while($data = $this->database->resultset()){
			$this->delPost($data['pid'],false);
		}

		$this->database->query('DELETE FROM '.$this->TABLE_PREFIX.'topics WHERE topic_id=:tid');
		$this->database->bind(":tid", (int)$topic_id);
        return $this->database->execute();
    }

    public function listTopics($id=null,$orderBy=null,$limit=null,$offset = null){

    	$sql = 'SELECT * FROM '.$this->TABLE_PREFIX.'topics INNER JOIN '.$this->TABLE_PREFIX.'users ON users.id = topics.user_id';

		if((int)$id) $sql .= ' WHERE topic_id=:tid';
		if($orderBy) $sql .= ' ORDER BY '.$orderBy;
        if($limit) $sql .= ' LIMIT '. $limit;
        if($offset) $sql .= ' OFFSET '. $offset;

        $this->database->query($sql);
		if((int)$id) $this->database->bind(":tid", $id);
        $result = $this->database->resultset();
        return $result;
    }

    public function searchTopics($like, $limit){
    	$this->database->query('SELECT topic_name FROM topics WHERE topic_name LIKE ?');
    	return $this->database->resultset(array("%$like%"));
    }

     public function countTopics($cid){
    	$this->database->query('SELECT * FROM '.$this->TABLE_PREFIX.'topics WHERE cat_id = :cid');
    	$this->database->bind(":cid", $cid);
    	$result = $this->database->resultset();
    	return count($result);
    }

    public function addPost($text,$topic_id,$notify=false){
		if(!(int)$topic_id || empty($text))return false;
		$this->database->query('INSERT INTO '.$this->TABLE_PREFIX.'posts (text,topic_id,user_id) VALUES(:text,:tid,:uid)');
		$this->database->bind(":text", $text);
		$this->database->bind(":tid", (int)$tid);
		$this->database->bind(":uid", $this->USER_ID);
        $result = $this->database->execute();
        if($notify && $result)$this->addToNotifyList($topic_id);
        if($result)$this->sendNotify('topic_id',$topic_id,$text);
        return $result;
    }

    public function editPost($post_id,$text,$topic_id=null){
        if(!$this->checkPermissions('posts', $post_id))return '403';
        if((int)$topic_id) {$changeTid = ', topic_id=:tid'; $this->database->bind(":tid", $topic_id);
        $this->database->query('UPDATE '.$this->TABLE_PREFIX.'posts SET text=:text'.$changeTid.' WHERE post_id=:pid');
        $this->database->bind(":text", $text);
        $this->database->bind(":pid", $post_id);
        return $this->database->execute();
    	}
    }

    public function delPost($post_id,$checkPerm=true){
        if(!$this->checkPermissions('posts', $post_id) && $checkPerm)return '403';
        $this->database->query('DELETE FROM '.$this->TABLE_PREFIX.'posts WHERE post_id=:pid');
        $this->database->bind(":pid",(int)$pid);
        return $this->database->execute();
    }

    public function listPosts($topic_id,$orderBy=null,$limit=null){

    	$sql = 'SELECT * FROM '.$this->TABLE_PREFIX.'posts WHERE topic_id=:tid';

		if($orderBy) $sql .= ' ORDER BY '.$orderBy;
        if($limit) $sql .= ' LIMIT '. $limit;

        $this->database->query($sql);

        $this->database->query($sql);
        $this->database->bind(":tid", (int)$topic_id);
        $result = $this->database->resultset();
        return $result;
    }

    public function countPosts($id, $mode){
    	if ($mode == "cat") $sql = "SELECT * FROM ".$this->TABLE_PREFIX."posts WHERE cat_id = :id";
    	if ($mode == "topic") $sql = "SELECT * FROM ".$this->TABLE_PREFIX."posts WHERE topic_id = :id";
    	$this->database->query($sql);
    	$this->database->bind(":id", (int)$id);
        return count($this->database->resultset());
    }

    public function latestTopics($cat_id){
    	$this->database->query('SELECT topic_id, topic_name, user_name, topic_post_date FROM topics 
    							JOIN user_profile ON topics.topic_post_date > user_profile.last_login 
    							JOIN users ON topics.user_id = users.id');
    	$results = $this->database->resultset();
    	return $results;
    }

    public function newPostCount($cat_id){
    	$this->database->query('SELECT topics.topic_id, topic_name, user_name, post_date FROM posts 
    							JOIN user_profile ON posts.post_date > user_profile.last_login 
    							JOIN users ON posts.user_id = users.id
    							JOIN topics ON posts.topic_id = topics.topic_id');
    	$results = $this->database->resultset();
    	
    	return count($results);
    }

    public function latestPosts($cat_id) {
    		$this->database->query('SELECT * FROM topics WHERE cat_id = :cid ORDER BY last_post_date DESC LIMIT 1');
    		$this->database->bind(":cid", $cat_id);
    		$row = $this->database->single();
    		return $row;


    }

    private function addToNotifyList($topic_id=null,$cat_id=null){
        if(!(int)$topic_id && !(int)$cat_id)return false;
        $this->database->query('INSERT INTO '.$this->TABLE_PREFIX.'forum_notify (user_id,email,topic_id,cat_id) VALUES(:uid,:email,:tid,:cid)');
        $this->database->bind(":uid", $this->USER_ID);
        $this->database->bind(":email", $this->EMAIL);
        $this->database->bind(":tid", $topic_id);
        $this->database->bind(":cid", $cat_id);
        return $this->database->execute();
    }

    private function delFromNotifyList($id=Array()){
        if(!is_array($id))$id = Array('notify_id' => $id);
        if(!count($id))return false;
        foreach($id as $key => $val){
            $where[] = ''.$key.'="'.$val.'"';
        }
        $where = join(' AND ', $where);

        $this->database->query('DELETE FROM '.$this->TABLE_PREFIX.'forum_notify WHERE '.$where);
        return $this->database->execute();
    }

    public function sendNotify($mode,$id,$desc){
        if(!(int)$id)return false;
        switch ($mode){
            case 'topic_id':
                $where = 'topic_id=:tid';                
                $notifyText = $this->notifyTopicText;
                $this->database->query('SELECT topic_name FROM '.$this->TABLE_PREFIX.'topics WHERE topic_id=:tid');
                $this->database->bind(":tid", (int)$id);
                $result = $this->database->single();
                $data['name'] = $result['topic_name'];
                break;
            case 'cat_id':
                $where = 'cat_id=:cid';
                $notifyText = $this->notifyCategoryText;
                $this->database->query('SELECT cat_name FROM '.$this->TABLE_PREFIX.'categories WHERE cat_id=:cid');
                $this->database->bind(":cid", (int)$id);
                $result = $this->database->single();
                $data['name'] = $result['cat_name'];
                break;
            default:
                return false;
        }
        $notifyText = strtr($notifyText, Array('%user' => utf8_decode($this->USERNAME), '%desc' => utf8_decode($desc), '%name' => utf8_decode($data['name'])));
        $this->database->query('SELECT email FROM '.$this->TABLE_PREFIX.'forum_notify WHERE '.$where.' AND user_id!=:uid');
        $this->database->bind(":uid", $this->USER_ID);
        if ($where == 'topic_id=:tid') {
        	$this->database->bind(":tid", $id);
        }
        if ($where == 'cat_id=:cid') {
        	$this->database->bind(":cid", $id);
        }
        while($data = $this->database->resultset()){
            $mailer=new Mailer($this->notifyFromEmail,$this->notifyFromEmail,$data['email'],$this->notifySubject,$notifyText);
            $mailer->send();
        }
    }

    private function setNotifyOptions($notifyFromEmail,$notifySubject,$notifyCategoryText,$notifyTopicText){
        $this->notifyFromEmail = $notifyFromEmail;
        $this->notifySubject = $notifySubject;
        $this->notifyCategoryText = $notifyCategoryText;
        $this->notifyTopicText = $notifyTopicText;
    }


    private function checkPermissions($method,$id=null){
        switch ($method){
            case 'categories':
                if(!$this->ADMIN)return false;
                break;
            case 'topics':
                $this->database->query('SELECT topic_id FROM '.$this->TABLE_PREFIX.'topics WHERE topic_id= :id AND user_id=:uid');
                $this->database->bind(":id", (int)$id);
                $this->database->bind(":uid", $this->USER_ID);
                $checkUid = $this->database->resultset();

                if(!$this->ADMIN && !count($checkUid))return false;
                break;

            case 'posts':
                $this->database->query('SELECT post_id FROM '.$this->TABLE_PREFIX.'posts WHERE post_id=:pid AND user_id=:uid');
                $this->database->bind(":pid", (int)$id);
                $this->database->bind(":uid", $this->USER_ID);
                $checkUid = $this->database->resultset();

                if(!$this->ADMIN && !count($checkUid))return false;

                break;
            default:
                return false;
        }
        return true;
    }

}

?>
