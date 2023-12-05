<?php
$url = htmlspecialchars(htmlentities(json_decode(file_get_contents("php://input"))->url));
$url = rtrim($url, '/');
$url = filter_var($url, FILTER_SANITIZE_URL);
if ($url) {
    require_once "./database.php";
    $db = new Database;
    while (true) {
        $id = bin2hex(random_bytes(5));
        $db->query("SELECT * FROM links where id=:id");
        $db->bind(":id", $id);
        if (!$db->single()) {
            $db->query("INSERT INTO links(id,link) VALUES(:id,:link)");
            $db->bind(":id", $id);
            $db->bind(":link", $url);
            $db->execute();
            header("Content-Type: application/json; charset: UTF-8");
            echo json_encode(array(
                "status"=> "success",
                "route"=> $id,
            ));
            break;
        }
    }
}
