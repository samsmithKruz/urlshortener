<?php
$url = htmlspecialchars(htmlentities(urlencode(json_decode(file_get_contents("php://input"))->url)));
$url = rtrim($url, '/');
$url = filter_var($url, FILTER_SANITIZE_URL);
if ($url) {
    require_once "./database.php";
}


print_r($url);
