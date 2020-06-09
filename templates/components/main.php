<main class="<?php $sidenav && print_r('sidenav') ?>">
    <?php $sidenav && include($links['COMPONENTS']['sidenav']) ?>
    <?php include($links['ROOT']['pages'] . $page . ".page.php") /*Get page from view*/ ?>
</main>