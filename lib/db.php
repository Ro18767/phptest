<?php

// виконання запиту
try {
    $res = $db->query("SELECT CURRENT_TIMESTAMP");
    $row = $res->fetch();
    print_r($row);
} catch (PDOException $ex) {
    echo $ex->getMessage();
}

// https://www.ietf.org/rfc/rfc2898.txt
$sql = <<<SQL
CREATE TABLE IF NOT EXISTS users (
    `id`        BIGINT          PRIMARY KEY,
    `login`     VARCHAR(64)     NOT NULL,
    `salt`      CHAR(16)        NOT NULL,
    `pass_dk`   CHAR(40)        NOT NULL,
    `name`      VARCHAR(64)     NULL,
    `email`     VARCHAR(64)     NULL,
    `avatar`    VARCHAR(512)    NULL

) ENGINE = InnoDB DEFAULT CHARSET = utf8
SQL;

try {
    $db->query($sql);
    echo 'CREATE OK';
} catch (PDOException $ex) {
    echo $ex->getMessage();
}
?>