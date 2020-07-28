<?php
// Get current page depth
$root = $_SERVER["DOCUMENT_ROOT"];

return [
    // Root Links -----------
    'ROOT' => [
        'css' => '/public/css/',
        'img' => '/public/images/',
        'js' => '/public/js/',
        'components' => $root . '/' . $site['VIEWS'] . '/components/',
        'common' => $root . '/' . $site['VIEWS'] . '/components/common/',
        'pages' => $root . '/' . $site['VIEWS'] . $router->trimURI() . '/views/',
    ],
    'COMPONENTS' => [
        'header' => $root . '/' . $site['VIEWS'] . '/components/header.php',
        'footer' => $root . '/' . $site['VIEWS'] . '/components/footer.php',
        'nav' => $root . '/' . $site['VIEWS'] . '/components/nav.php',
        'main' => $root . '/' . $site['VIEWS'] . '/components/main.php',
        'sidenav' => $root . '/' . $site['VIEWS'] . '/components/sidenav.php',
        'scripts' => $root . '/' . $site['VIEWS'] . '/components/scripts.php'
    ]
];
