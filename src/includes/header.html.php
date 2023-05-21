<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?=$appController->routeConfig['title']?></title>
    <link href='https://fonts.googleapis.com/css?family=IBM+Plex+Serif' rel='stylesheet'>
    <link rel='stylesheet' href='http://localhost/Tienda/assets/css/fontawesome-free-5.12.0-web/css/all.css'>
    <link rel="stylesheet" href="http://localhost/Tienda/assets/css/animate.css">
    <?php
        $css = [];
        if (isset($appController->routeConfig['css'])) {
            $css = $appController->routeConfig['css'];
        }
        foreach ($css as $key => $val):
    ?>
    <link rel='stylesheet' href='http://localhost/Tienda/assets/css/<?=$val?>'>
    <link rel="stylesheet" href="http://localhost/Tienda/assets/css/styles.css">
    <?php endforeach; ?>

</head>
<body>
