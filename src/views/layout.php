<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.0/css/dataTables.dataTables.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.0/css/dataTables.tailwindcss.css">

    <script src="https://cdn.datatables.net/2.0.0/js/dataTables.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdn.datatables.net/2.0.0/js/dataTables.js"></script>
    <scrip src="https://cdn.datatables.net/2.0.0/js/dataTables.tailwindcss.js">
        </script>

        <script src="https://cdn.tailwindcss.com"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.5/dist/sweetalert2.all.min.js"></script>
        <title>
            <?php echo $title ?>
        </title>
        <style>
            <?php include(__DIR__ . "../../../public/css/$style"); ?>
        </style>
</head>

<body>
    <?php if ($currentPage != 'error') {
        include(__DIR__ . "/includes/navbar.php");
    } ?>
    <?php echo $content; ?>
</body>

</html>