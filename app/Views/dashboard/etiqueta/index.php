<?= $this->extend('Layouts/dashboard')?>
<?= $this->section('contenido')?>
<?= view('partials/_session')?>
    <a href="/dashboard/etiqueta/new" class="btn btn-success btn-lg mb-4">Create</a>
    <table class="table">
        <tr>
            <th>
                id
            </th>
            <th>
                Titulo
            </th>
            <th>
                Categoria
            </th>
            <th>
                Opciones
            </th>
        </tr>
            <?php foreach($etiqueta as $key => $p) : ?>
                <tr>
                    <td><?=$p->id?></td>
                    <td><?=$p->titulo?></td>
                    <td><?=$p->categoria?></td>
                    <td>
                    <a href="/dashboard/etiqueta/show/<?=$p->id?>" class="btn btn-secondary btn-sm mt-1">Show</a>
                        <a href="/dashboard/etiqueta/edit/<?=$p->id?>" class="btn btn-primary btn-sm mt-1">Edits</a>                                            
                        <form action="/dashboard/etiqueta/delete/<?=$p->id?>" method="post">
                        <button type="submit" class="btn btn-danger btn-sm mt-1">Delete </button>
                        </form>
                    </td>
                </tr>
            <?php endforeach?>
        </tr>
    </table> 
    <?= $pager->links()?>
<?= $this->endSection()?>