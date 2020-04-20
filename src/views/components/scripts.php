<!-- Error message-->
<?php require_once($links['ROOT']['common'] . "error.message.php") ?>

<!-- Scripts -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<?php if ($isIE) : ?>
    <!-- for ie browsers -->

<?php else : ?>
    <!-- For modern browsers -->

<?php endif ?>

<script src="<?= $links["ROOT"]["js"] ?>index.js?v=<?= $site['VERSION'] ?>"></script>