<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <link rel="stylesheet" href="<?= media(); ?>/css/error.css">
    <link rel="shortcut icon" href="<?= media(); ?>/images/icon.png" type="image/x-icon">
    <!------ Include the above in your HEAD tag ---------->
    <title>Página no encontrada</title>
</head>

<body>
    <h1>Página no encontrada</h1>
    <p class="zoom-area"><b>Error:</b> verifique la dirección ingresada e intente de nuevo.</p>
    <section class="error-container">
        <span><span>4</span></span>
        <span>0</span>
        <span><span>4</span></span>
    </section>
    <div class="link-container">
        <a href="<?=base_url()?>/dashboard" class="more-link"><i class="fa-solid fa-house"></i> Inicio</a>
    </div>
    <script src="<?= media(); ?>/js/fontawesome.js"></script>
</body>

</html>