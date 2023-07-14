<?= $this->extend('Layouts/dashboard')?>
<?= $this->section('contenido')?>
<?= view('partials/_session')?>
    <h1><?= $etiqueta->titulo ?></h1>
<?= $this->endSection()?>