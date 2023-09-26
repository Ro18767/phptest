<?php

// виконання запиту
try {
    $res = $db->query("SELECT CURRENT_TIMESTAMP UNION SELECT CURRENT_DATE UNION SELECT 1");
    ?>
    <div class="row">
        <div class="col s12 m7">
            <div class="card">
                <div class="card-content">
                    <table>
                        <thead>
                            <tr>
                                <th>CURRENT_TIMESTAMP</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <?= $res->fetch(PDO::FETCH_COLUMN) ?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <?= $res->fetch(PDO::FETCH_COLUMN) ?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <?= $res->fetch(PDO::FETCH_COLUMN) ?>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


    <?php

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