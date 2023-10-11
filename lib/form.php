<?php
function generate_field($name)
{
    return [
        'name' => $name,
        'value' => $_POST[$name] ?? null,
        'message' => '',
    ];
}
function generate_file_field($name)
{
    return [
        'name' => $name,
        'value' => null,
        'message' => '',
    ];
}

function get_file_field_value($name, $multiple = false)
{
    return $_FILES[$name];
}



?>