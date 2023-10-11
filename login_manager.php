<?php
include_once "lib/form.php";

function is_valid_form($form_data)
{
    ; { // login
        $name = 'login';
        $value = $form_data[$name]['value'];

        if (is_null($value)) { // наявність самих даних
            return false;
        } else if (strlen($value) < 2) {
            return false;
        }
    }

    ; { // password
        $name = 'password';
        $value = $form_data[$name]['value'];

    }
    return true;
}

$form_data = [
    'login' => generate_field('login'),
    'password' => generate_field('password'),
];

if (!is_valid_form($form_data)) {
    echo json_encode(null);
    exit;
}
$login = $form_data['login']['value'];
$password = $form_data['password']['value'];


$row;

try {

    $q = $db->prepare(<<<SQL
    SELECT * FROM users
    WHERE `login` = ?
    SQL);
    
    $q->execute([
        $login,
    ]);

    $row = $q->fetch(PDO::FETCH_ASSOC);
} catch (PDOException $ex) {
    echo json_encode($ex->getMessage());
    exit;
}

if (empty($row)) {
    http_response_code(401);
    exit;
}

if (sha1($row['salt'] . md5($password)) !== $row['pass_dk']) {
    http_response_code(401);
    exit;
}

$_SESSION[ 'auth-user-id' ] = $row[ 'id' ];

http_response_code(200);

echo json_encode([
    'id' => $row['id'],
    'login' => $row['login'],
    'name' => $row['name'],
    'email' => $row['email'],
    'avatar' => $row['avatar'],
]);

exit;
/*
Д.З. Скласти запит на перевірку того, що є у БД користувач
із логіном, що передано у параметрах запиту.
Вилучити з БД відомості про всі поля цього користувача,
повернути у відповідь на запит
*/