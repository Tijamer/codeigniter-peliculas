<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modulo De Dashboard</title>
</head>

<body>
    <h1>Modulo</h1>
    <?= session('partials/_session')?>
    <?= $this->renderSection('contenido')?>
    
</body>
</html>