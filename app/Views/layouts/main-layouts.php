<?php

/**
 * @var array $product
 * @var array $getAllProducts
 * @var array $getCategory
 * @var array $getAllReviews
 * @var array $content
 * @var array $data
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <!-- AdminLTE CSS -->
    <link rel="stylesheet" href="/public/assets/admin/css/adminlte.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

    <?php layout('header', $data); ?>
    <?php layout('sidebar', $data); ?>

    <div class="content-wrapper">
        <div class="content">
            <div class="container-fluid">
                <?php echo isset($content) ? $content : ''; dd($content);?>
                
            </div>
        </div>
    </div>

    <?php layout('footer', $data); ?>

</div>
<script src="/public/assets/admin/js/adminlte.min.js"></script>
</body>
</html>