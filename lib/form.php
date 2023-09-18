<?php
function generate_field($name)
{
    return [
        'name' => $name,
        'value' => $_POST[$name] ?? null,
        'message' => '',
    ];
}

?>