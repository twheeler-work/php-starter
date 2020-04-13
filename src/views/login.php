<?php session_start();
$sidenav = false; /* Use sidenav? */
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Header -->
    <?php include($links['COMPONENTS']['header']) ?>
    <title>Login - <?= $site['TITLE'] ?></title>
</head>

<body class="<?= $page  ?>">
    <!-- Nav -->
    <?php include_once($links['COMPONENTS']['nav']) ?>
    <!-- Main -->
    <?php include($links['COMPONENTS']['main']) ?>
    <!-- Scripts -->
    <?php include($links['COMPONENTS']['scripts']) ?>

</body>

</html>