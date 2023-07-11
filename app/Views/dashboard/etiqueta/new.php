<?= $this->extend('Layouts/dashboard')?>
<?= $this->section('contenido')?>
<?= view('partials/_form-error')?>
<?= view('partials/_session')?>
    <form action="/dashboard/etiqueta/create" method="post">
    <?= view('dashboard/etiqueta/_form',['op' =>'Crear'])?>
    </form>
<?= $this->endSection()?>