<?php

header('Content-Type: text/html; charset=UTF-8');

require('app/config/config.php');
require('app/config/db.php');
require('app/functions/validate.function.php');
require('app/functions/helper.function.php');

/*
$page = isset($_GET['page']) ? $_GET['page'] : 'index';
$action = isset($_GET['action]) ? $_GET['action]: 'index';
if (is_file('templates' . DIRECTORY_SEPARATOR . $page . DIRECTORY_SEPARATOR . $action '.php'))
{
	
}
else
{
	die('Forget about it');
}
*/
if($_SERVER['REQUEST_METHOD'] == 'POST')
{
	fieldRequired('Imię', $_POST['name']);
	fieldRequired('Nazwisko', $_POST['surname']);
	fieldRequired('E-mail', $_POST['email']);
	fieldRequired('Hasło', $_POST['password']);
	if(!$isError)
	{
		isEmail('E-mail', $_POST['email']);
	}

	if (!$isError)
	{	
		/* status Bool(true|false), msg String) */
		$dbStatus = [];
		$password = md5(PASS_SALT . $_POST['password']);
		$query = "INSERT INTO users SET user_name = '{$_POST['name']}', user_surname = '{$_POST['surname']}', user_email = '{$_POST['email']}', user_password = '$password'";
		if ($db->query($query))
		{
			$dbStatus = ['status' => 'success', 'msg' => 'Data was inserted Successfully'];
		}
		else
		{
			$dbStatus = ['status' => 'warning', 'msg' => 'Data has not been inserted!'];
		}
	}
}

?>

<!DOCTYPE html>
<html data-bs-theme="dark">
    <head>
		<meta charset="utf-8">
		<link rel="stylesheet" href="assets/css/bootstrap/bootstrap.min.css" />
		<link rel="stylesheet" href="assets/css/style.css" />

		<script type="text/javascript" src="assets/js/bootstrap/bootstrap.min.js"></script>
	</head>
	
	<body>
		<main>
			<section class="content">
				<?php 
					if (isset($dbStatus['status']))
					{
						showMessage($dbStatus['status'], $dbStatus['msg']);
					}
					include ('templates/form.html.php');
				?>
			</section>
			<section class="content">
				<?php 
					if (isset($_REQUEST['action']))
					{
						$action = $_REQUEST['action'];
						switch ($action)
						{
							case 'delete':
								if (isset($_REQUEST['id']) && !empty($_REQUEST['id']))
								{
									$id = (int) $_REQUEST['id'];
									if ($db->query("DELETE FROM users WHERE id = $id"))
									{
										showMessage('info', 'Selected record was deleted from DB');	
									}
									else
									{
										showMessage('warning', 'Record has not been deleted');
									}
								}
								break;
						}
					}
					include ('templates/users.html.php');
				?>
			</section>
		</main>
	</body>
</html>