<?php
include_once './lib/form.php';

$name_class = "validate";
$reg_name = "";
$path;
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$form_data = [
		'reg-name' => generate_field('reg-name'),
		'reg-lastname' => generate_field('reg-lastname'),
		'reg-email' => generate_field('reg-email'),
		'reg-phone' => generate_field('reg-phone'),
		'reg-avatar' => generate_file_field('reg-avatar'),
	];
	// оброблення даних форми
	// echo '<pre>' ; print_r( $_POST ) ; exit ;
	// етап 1 - валідація

	; { // reg-name
		$name = 'reg-name';
		$value = $form_data[$name]['value'];

		if (is_null($value)) { // наявність самих даних
			$form_data[$name]['message'] = "No reg-name field";
		} else if (strlen($value) < 2) {
			$form_data[$name]['message'] = "Name too short";
		}
	}

	; { // reg-lastname
		$name = 'reg-lastname';
		$value = $form_data[$name]['value'];

	}

	; { // reg-email
		$name = 'reg-email';
		$value = $form_data[$name]['value'];

	}

	; { // reg-phone
		$name = 'reg-phone';
		$value = $form_data[$name]['value'];

	}

	$path = null
	; { // reg-avatar
		$name = 'reg-avatar';
		$file = get_file_field_value($name);
		if (!is_null($file) && $file['error'] == 0 && $file['size'] > 0) {
			$path = '/files/' . uniqid('', true) . '.' . pathinfo($file['name'], PATHINFO_EXTENSION);
			if (!move_uploaded_file($file['tmp_name'], $root_dir . $path)) {
				$path = null;
			}
		}
	}

	$valid = true;
	foreach ($form_data as $key => &$field) {
		if (isset($field['message']) && $form_data['reg-lastname']['message'] !== '') {
			$valid = false;
			break;
		}
	}

	if ($valid) {
		if (empty($db)) {

			echo 'Server error';
	
			exit;
	
		}

		$DBNULL = $db->quote(null, PDO::PARAM_NULL);

		$login = !empty($form_data['reg-name']['value']) ? $db->quote($form_data['reg-name']['value']) : $DBNULL;

		$name = !empty($form_data['reg-lastname']['value']) ? $db->quote($form_data['reg-lastname']['value']) : $DBNULL;

		$password = !empty($form_data['reg-phone']['value']) ? $db->quote($form_data['reg-phone']['value']) : $DBNULL;

		$email = !empty($form_data['reg-email']['value']) ? $db->quote($form_data['reg-email']['value']) : $DBNULL;
		$avatar = !empty($path) ? $db->quote($path) : $DBNULL;

		$salt = $db->quote(substr(md5(uniqid()), 0, 16));
		$dk = $db->quote(sha1($salt . md5($password)));

		$sql = <<<SQL
INSERT INTO users ( `id`, `login`, `salt`, `pass_dk`, `name`, `email`, `avatar`) 
VALUES(
	UUID_SHORT(),
	{$login},
	{$salt},
	{$dk},
	{$name},
	{$email},
	{$avatar} 
)
SQL;

		try {

			$db->query($sql);

			header('Location: /');

			exit;

		} catch (PDOException $ex) {
			// $ex->getMessage();
		}
		
	}

	session_start(); // включення сесії
	// після включення сесії стає доступним $_SESSION
	$_SESSION['form_data'] = json_encode($form_data);


	header('Location: ' . $_SERVER['REQUEST_URI']);

	exit;

	
} else { // запит методом GET
	// перевіряємо, чи є дані у сесії
	session_start(); // включення сесії
	if (isset($_SESSION['form_data'])) {
		$form_data = json_decode($_SESSION['form_data'], JSON_OBJECT_AS_ARRAY);
		unset($_SESSION['form_data']);
		// є передача даних, перевіряємо повідомлення
		if (isset($_SESSION['name_message'])) {
			$name_message = $_SESSION['name_message'];
			unset($_SESSION['name_message']);
		}
		// видаляємо з сесії повідомленя про дані


		foreach ($form_data as $key => &$fuild) {

			if (strlen($fuild['message'])) { // валідація імені не пройшла
				$fuild['class'] = "invalid";
			} else { // успішна валідація
				$fuild['class'] = "valid";
			}
		}
	}
	include 'forms.php';
}