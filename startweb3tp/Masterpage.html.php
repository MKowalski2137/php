<!DOCTYPE html>
<html data-bs-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="assets/css/style.css"/>
    
    <script type="text/javascript" src="assets/js/bootstrap/bootstrap.min.js"></script>

</head>
<body>
    <main>
        <?php
        $page = isset($_GET['page'])?$_GET['page']:'index';
        $action = isset($_GET['action'])?$_GET['action']:'action';
        if (is_file($file ='templates/views/'.DIRECTORY_SEPARATOR.$page.DIRECTORY_SEPARATOR.$action.'.php'))
        {include($file);
        }else {
            die('forget about it');

        }
        exit;
        ?>
    </main>
</body>
</html>