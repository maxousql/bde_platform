<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <title>
        <?php echo $title ?>
    </title>
    <style>
        <?php

        include(__DIR__ . "../../../public/css/navbar.css");
        include(__DIR__ . "../../../public/css/$style");
        ?>
    </style>
</head>

<body>
    <h1>test</h1>
    <?php echo $content; ?>
</body>

</html>