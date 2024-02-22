<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.5/dist/sweetalert2.all.min.js"></script>
    <title>
        <?php echo $title ?>
    </title>
    <style>
        <?php

        // include(__DIR__ . "../../../public/css/navbar.css");
        include(__DIR__ . "../../../public/css/$style");
        ?>
    </style>
</head>

<body>
    <?php include(__DIR__ . "/includes/navbar.php"); ?>
    <?php echo $content; ?>
</body>

</html>