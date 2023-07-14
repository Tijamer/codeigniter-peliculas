<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modulo Web</title>
    <link rel="stylesheet" href="<?= base_url()?>bootstrap/dist/css/bootstrap.min.css">
</head>

<body>
    <?= session('partials/_session')?>
    <?= $this->renderSection('contenido')?>
    
</body>
</html>