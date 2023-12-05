<?php
if (isset($_GET['url']) && !empty($_GET['url'])) {
    $url = rtrim($_GET['url'], '/');
    $url = filter_var($url, FILTER_SANITIZE_URL);
    require_once "./database.php";
    $db = new Database;
    $db->query("SELECT * FROM links where id=:url");
    $db->bind(":url", $url);
    $route = $db->single();
    if ($route) {
        $route = $route->link;
        header("location: https://$route");
        exit();
    } else {
        $err = "Unkown link";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Url Shortener</title>
    <link rel="stylesheet" href="index.css">
    <link rel="shortcut icon" href="./icon.svg" type="image/x-svg">
    <script src="./app.js" defer></script>
</head>

<body>
    <?php if (isset($err)) { ?>
        <script type="text/javascript">
            alert("<?=$err;?>");
        </script>
    <?php }?>
    <section id="hero">
        <img src="./illustration.png" alt="">
        <div>
            <h1>Simple URL Shortener</h1>
            <p>
                Create short urls for easy and efficient usage.
            </p>
        </div>
    </section>
    <section id="form">
        <form action="">
            <div class="input">
                <label for="urls">https://</label>
                <input type="text" id="urls" name="urls" placeholder="wwww.example.com">
                <input type="submit" value="Go">
            </div>
            <div class="result hide">
                <h5>Result</h5>
            </div>
        </form>
    </section>
    <footer>
        <small>Created by</small>
        <a href="https://twitter.com/samsmith_kruz">
            <img src="./logo.svg" alt="">
        </a>
    </footer>
</body>

</html>