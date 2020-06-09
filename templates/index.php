<?php
$sidenav = true; /* Use sidenav? */
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Header -->
    <?php include($links['COMPONENTS']['header']) ?>
    <title><?= $site['TITLE'] ?></title>
</head>

<body>
    <!-- Nav -->
    <?php include($links['COMPONENTS']['nav'])  ?>
    <!-- Main -->
    <?php include($links['COMPONENTS']['main']) ?>
    <!-- Footer -->
    <?php include($links['COMPONENTS']['footer']) ?>
    <!-- Scripts -->
    <?php include($links['COMPONENTS']['scripts']) ?>

</body>

</html>