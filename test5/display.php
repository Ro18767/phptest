<?php

$url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

if (!isset($_GET['id'])) { 
    $query = http_build_query(['id' => 0]);
    header("Location: $url?$query", null, 303);
    exit();
}


$id = intval($_GET["id"]);

if ($_SERVER['REQUEST_METHOD'] === "POST") {

    $id = intval($_GET["id"]);
    if ($_POST["button"] === "next") {
        $id++;
    }
    if ($_POST["button"] === "prev") {
        $id--;
    }
    
    $query = http_build_query(['id' => $id]);
    // $extra = 'mypage.php';
    header("Location: $url?$query", null, 303);
    exit();
}
?>
<form action="/display.php" method="POST" target="display_result" id="formssdfsdfdasd" name="asdfsdfdfgfg">
    <input type="submit" name="button" value="next">
    <input type="submit" name="button" value="prev">
</form>
<h1>ID:
    <?= $_GET['id']; ?>
</h1>