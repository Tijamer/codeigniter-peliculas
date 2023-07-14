<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modulo De Dashboard</title>
    <link rel="stylesheet" href="<?= base_url()?>bootstrap/dist/css/bootstrap.min.css">
</head>
    
<body>
    <nav class="navbar navbar-expand-lg mb-3">
        <div class="container-fluid">
            <a class="navbar-brand">Code</a>
            <div class="navbar-collapse">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a href="<?= base_url()?>/dashboard/pelicula" class="nav-link">Pelicula</a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= base_url()?>/dashboard/categoria" class="nav-link">Categorias</a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= base_url()?>/dashboard/etiqueta" class="nav-link">Etiquetas</a>
                    </li>
                </ul>
            </div>
            
        </div>
    </nav>
        <div class="container">
        <?= session('partials/_session')?>        
            <div class="card">
                <div class="card-header">
                    <h1><?= $this->renderSection('header')?></h1>
                </div>            
                <div class="card_body">                    
                    <?= $this->renderSection('contenido')?>    
                </div>
            </div>
        </div>
        <script src="<?= base_url()?>bootstrap/dist/js/bootstrap.min.js"></script>
    </body>
</html>