<?php
// Get current page depth
$root = $_SERVER["DOCUMENT_ROOT"];

return [
    // Root Links -----------
    'ROOT' => [
        'css' => '/public/css/',
        'img' => '/public/images/',
        'js' => '/public/js/',
        'components' => $root . '/src/views/components/',
        'common' => $root . '/src/views/components/common/',
        'pages' => $root . '/src/views/pages/',
        'api' => $root . '/src/api/',
        'vendors' => $root . '/src/vendors/',
    ],
    'COMPONENTS' => [
        'header' => $root . '/src/views/components/header.php',
        'footer' => $root . '/src/views/components/footer.php',
        'nav' => $root . '/src/views/components/nav.php',
        'main' => $root . '/src/views/components/main.php',
        'sidenav' => $root . '/src/views/components/sidenav.php',
        'scripts' => $root . '/src/views/components/scripts.php'
    ]
];
