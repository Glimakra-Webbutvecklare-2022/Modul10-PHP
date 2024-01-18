<?php

include_once "_models/Database.php";
include_once "_models/Language.php";
include_once "_includes/global-functions.php";

$database = new Database();
$language = new Language();

$rows = $language->get_all("language", "ASC");

print_r2($rows);

?>