<?php 
    require_once './src/app.controller.php';
?>
<?php
    if($appController->routeConfig['header'] == 'html'){
        require_once './src/includes/header.html.php';
    } else {
        require_once './src/includes/header.json.php';
    }
    require_once './src/app.component.php'
?>
<?php
    if($appController->routeConfig['header'] == 'html'):
?>
</body>
</html>
<?php endif; ?>