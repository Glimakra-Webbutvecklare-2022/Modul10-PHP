<?php

include_once "_models/Database.php";
include_once "_models/Language.php";

$database = new Database();
$language = new Language();

$rows = $language->get_all();

print_r($rows);

?>