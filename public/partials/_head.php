<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $text_ln['meta_title']  ?></title>
    <meta name="description"
          content="<?= $text_ln['meta_description'] ?>">
    <meta name="author" content="<?= $text['name'] . " " . $text['surname1'] . " - " . $text['surname2']  ?>">
    <meta name="keywords" content="<?= $text_ln['meta_keywords'] ?>">

    <meta http-equiv="Content-Security-Policy" content="
    default-src 'self';
    script-src 'unsafe-inline' 'self' *.youtube.com *.google-analytics.com;
    style-src 'unsafe-inline' 'self' *.youtube.com https://fonts.googleapis.com;
    font-src 'unsafe-inline' 'self' https://fonts.gstatic.com;
    frame-src 'self' 'unsafe-inline' *.youtube.com;
    child-src 'self' *.youtube.com;
    media-src 'self' *.youtube.com;
    object-src 'self' *.youtube.com;
    img-src 'self' *.silviamendez.net *.google-analytics.com">

    <link rel="alternate" href="http://silviamendez.net/" hreflang="es-es" />
    <link rel="alternate" href="http://silviamendez.net/es/" hreflang="es-es" />
    <link rel="alternate" href="http://silviamendez.net/eu/" hreflang="eu-es" />

    <link rel="shortcut icon" href="../img/favicon.ico" type="image/x-icon">

    <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../fonts/font-awesome/css/font-awesome.css">

    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <link href='https://fonts.googleapis.com/css?family=Lato:400,700,900,300' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,700,800,600,300' rel='stylesheet' type='text/css'>

</head>