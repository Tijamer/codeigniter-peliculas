<?= $this->extend('Layouts/dashboard')?>
<?= $this->section('contenido')?>
<?= view('partials/_form-error')?>
<?= view('partials/_session')?>
    <form action="/dashboard/pelicula/create" method="post">
    <?= view('dashboard/pelicula/_form',['op' =>'Crear'])?>
    </form>
<?= $this->endSection()?>