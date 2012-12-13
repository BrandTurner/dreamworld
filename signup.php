<?

// User Class for PDO Mapping
class User {
  public $id;
  public $firstname;
  public $lastname;
  public $username;
  public $password;
  public $email;
  public $address;
  public $city;
  public $state;
  public $zip;
}

// Login
if (isset($_POST['login_submit']) && $_POST['login_submit'] == 1) {
	// Define $myusername and $mypassword 
	$username=$_POST['username']; 
	$password=$_POST['password']; 

// To protect MySQL injection (more detail about MySQL injection)
	$username = stripslashes($username);
	$password = stripslashes($password);
//	$username = mysql_real_escape_string($username);
//	$password = mysql_real_escape_string($password);

	try {
		$pdo = new PDO('mysql:host=internal-db.s62517.gridserver.com;dbname=db62517_qs', 'db62517_me', 'g9u8n7star');
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$stmt = $pdo->prepare('SELECT * FROM dw_users WHERE username = :username AND password = :password');
		$stmt->execute(array('username' => $username, 'password' => $password));
		if ($stmt->rowCount() == 1) {
			$stmt->setFetchMode(PDO::FETCH_CLASS, 'User');
			$user = $stmt->fetch();
			echo json_encode($user);
			exit;
		} else {
			$response['sql'] = true;
			echo json_encode($response);
			exit;
		}
	} catch(PDOException $e) {
		echo 'Error: ' . $e->getMessage();
	}
}

// Sign-up
if (isset($_POST['check_submit']) && $_POST['check_submit'] == 1) {
		try {
			// Add Constants file
			$pdo = new PDO('mysql:host=internal-db.s62517.gridserver.com;dbname=db62517_qs', 'db62517_me', 'g9u8n7star');
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

			$stmt = $pdo->prepare('INSERT INTO dw_users VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?)');
		  	$stmt->execute(array(
		    	NULL,
		    	$_POST['firstName'],
		    	$_POST['lastName'],
		    	$_POST['username'],
		    	$_POST['password'],
		    	$_POST['email'],
		    	$_POST['address'],
		    	$_POST['city'],
		    	$_POST['state'],
		    	$_POST['zip']
	  		));


		  	// Instead of just taking POST data to fill out profile form, doing PDO read to show technical competence
		  	$lastInsertedID = $pdo->lastInsertId();
		  	// Time for a query within a query...Queryception!
		  	try {
				$pdo = new PDO('mysql:host=internal-db.s62517.gridserver.com;dbname=db62517_qs', 'db62517_me', 'g9u8n7star');
				$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				$stmt = $pdo->prepare('SELECT * FROM dw_users WHERE id = :id');
				$stmt->execute(array('id' => $lastInsertedID));
				$stmt->setFetchMode(PDO::FETCH_CLASS, 'User');
				$user = $stmt->fetch();
				echo json_encode($user);
				exit;

			} catch(PDOException $e) {
			  echo 'Error: ' . $e->getMessage();
			  exit;
			}

		} catch(PDOException $e) {
			echo 'Error: ' . $e->getMessage();
			exit;
		}
}

// Edit 
if (isset($_POST['update'])) {
	$id = $_POST['userID'];

	if ($_POST['update'] == 1) {
	// Delete the entry and send back to login page
		try {
			$pdo = new PDO('mysql:host=internal-db.s62517.gridserver.com;dbname=db62517_qs', 'db62517_me', 'g9u8n7star');
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$stmt = $pdo->prepare('DELETE FROM dw_users WHERE id = :id');
			$stmt->bindParam(':id', $id);
			$stmt->execute();
			$response['msg'] = "rows deleted" . $stmt->rowCount();
			$response['del'] = $id;
			echo json_encode($reponse);
		} catch(PDOException $e) {
			echo 'Error: ' . $e->getMessage();
		}

	} else if ($_POST['update'] == 0) {
		// Edit the Entry
		/*foreach ($_FILES["images"]["error"] as $key => $error) {
			if ($error == UPLOAD_ERR_OK) {
				$name = $_FILES["images"]["name"][$key];
				move_uploaded_file($_FILES["images"]["tmp_name"][$key], "uploads/" . $_FILES['images']['name'][$key]);
				$imageFileLocation = $_FILES['images']['name'][$key];
			}
		}*/
		echo json_encode($_FILES["images"]);
		exit;
		try {
			$pdo = new PDO('mysql:host=internal-db.s62517.gridserver.com;dbname=db62517_qs', 'db62517_me', 'g9u8n7star');
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$stmt = $pdo->prepare('UPDATE dw_users SET firstname = :firstname, 
														lastname = :lastname,
														username = :username,
														password = :password,
														email = :email,
														address = :address, 
														city = :city,
														state = :state,
														zip = :zip,
														image_name = :image_name
														WHERE id = :id');
			$stmt->execute(array(
			    ':firstname' => $_POST['firstname'],
		    	':lastname' => $_POST['lastname'],
		    	':username' => $_POST['username'],
		    	':password' => $_POST['password'],
		    	':email' => $_POST['email'],
		    	':address' => $_POST['address'],
		    	':city' => $_POST['city'],
		    	':state' => $_POST['state'],
		    	':zip' => $_POST['zip'],
		    	':image_name' => $imageFileLocation,
		    	':id' => $id
	  		));
	  		$response['msg'] = "Rows updated: " . $stmt->rowCount();
	  	} catch(PDOException $e) {
			echo 'Error: ' . $e->getMessage();
		}
	}
}
?>