<?php
include_once './lib/form.php';

$name_class = "validate";
$reg_name = "";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$form_data = [
		'reg-name' => generate_field('reg-name'),
		'reg-lastname' => generate_field('reg-lastname'),
		'reg-email' => generate_field('reg-email'),
		'reg-phone' => generate_field('reg-phone'),
	];
	// оброблення даних форми
	// echo '<pre>' ; print_r( $_POST ) ; exit ;
	// етап 1 - валідація
	{ // reg-name
		$name = 'reg-name';
		$value = $form_data[$name]['value'];

		if (is_null($value)) { // наявність самих даних
			$form_data[$name]['message'] = "No reg-name field";
		} else if (strlen($value) < 2) {
			$form_data[$name]['message'] = "Name too short";
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