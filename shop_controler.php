<?php
include_once './lib/api.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {


    header('Location: ' . $_SERVER['REQUEST_URI']);

    exit;

} else {

    global $_CONTEXT;
    $db = get_db();



    $params = [];
    $where = '';


    $group = $_GET['grp'] ?? false;
    if ($group !== false && $group !== 'all') {
        $where .= ' AND id_group = ?';
        $params[] = $group;
    }   
    $sql = 'SELECT MAX(price) as `products_max_price`, MIN(price) as `products_min_price` FROM products WHERE 1 = 1';

    $sql .= $where;

    $products_count = 0;
    try {
        $q = $db->prepare($sql);
        $q->execute($params);
        $result = $q->fetch(PDO::FETCH_ASSOC);
        $products_max_price = $result['products_max_price'];
        $products_min_price = $result['products_min_price'];
    } catch (PDOException $ex) {
        log_error(__FILE__ . "#" . __LINE__ . $ex->getMessage() . " {$sql}");
        send_error(500);
    }

    $min_price = $_GET['min-price'] ?? false;

    if ($min_price !== false && is_numeric($min_price)) {
        $where .= ' AND price >= ?';
        $params[] = +$min_price;
    }

    $max_price = $_GET['max-price'] ?? false;

    if ($max_price !== false && is_numeric($max_price)) {
        $where .= ' AND price <= ?';
        $params[] = +$max_price;
    }
    $products_per_page = 4;

    $sql = 'SELECT COUNT(*) FROM products WHERE 1 = 1';

    $sql .= $where;

    $products_count = 0;
    try {
        $q = $db->prepare($sql);
        $q->execute($params);
        $products_count = $q->fetch(PDO::FETCH_COLUMN);
    } catch (PDOException $ex) {
        log_error(__FILE__ . "#" . __LINE__ . $ex->getMessage() . " {$sql}");
        send_error(500);
    }

    $last_pages = ceil($products_count / $products_per_page);

    $sql = 'SELECT * FROM products WHERE 1 = 1';

    $current_page = 0;
    if(isset($_GET['page']) && is_numeric($_GET['page'])) {
        $current_page = +($_GET['page']) - 1;
    }

    if($current_page < 0) $current_page = 0;
    if($current_page > $last_pages) $current_page = $last_pages;


    $sql .= $where . ' LIMIT ' . $current_page.', ' . $products_per_page;

    $products = [];
    try {
        $q = $db->prepare($sql);
        $q->execute($params);
        $products = $q->fetchAll();
    } catch (PDOException $ex) {
        log_error(__FILE__ . "#" . __LINE__ . $ex->getMessage() . " {$sql}");
        send_error(500);
    }



    $product_groups;
    $sql = "SELECT * FROM product_groups";
    try {
        $ans = $db->query($sql);
        $product_groups = $ans->fetchAll();
    } catch (PDOException $ex) {
        log_error(__FILE__ . "#" . __LINE__ . $ex->getMessage() . " {$sql}");
        send_error(500);
    }

    include 'shop.php';
}