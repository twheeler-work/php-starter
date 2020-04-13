<?php
// Get current page depth
$root = Router::trimURI($uri);

return [
    // Root Links -----------
    'ROOT' => [
        'css' => '/public/css/',
        'img' => '/public/images/',
        'js' => '/public/js/',
        'components' => './src/views/components' . $root . '/',
        'common' => './src/views/components' . $root . '/common/',
        'pages' => './src/views' . $root . '/pages/',
        'api' => './src/api/',
        'vendors' => './src/vendors/',
    ],
    'COMPONENTS' => [
        'header' => './src/views/components/header.php',
        'footer' => './src/views/components' . $root . '/footer.php',
        'nav' => './src/views/components' . $root . '/nav.php',
        'main' => './src/views/components' . $root . '/main.php',
        'sidenav' => './src/views/components' . $root . '/sidenav.php',
        'scripts' => './src/views/components/scripts.php'
    ]
];
