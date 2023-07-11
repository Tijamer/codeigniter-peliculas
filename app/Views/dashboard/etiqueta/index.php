<?= $this->extend('Layouts/dashboard')?>
<?= $this->section('contenido')?>
    <a href="/dashboard/etiqueta/new">Create</a>
    <table>
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
                    <a href="/dashboard/etiqueta/show/<?=$p->id?>">Show</a>
                        <a href="/dashboard/etiqueta/edit/<?=$p->id?>">Edits</a>                        
                    
                        <form action="/dashboard/etiqueta/delete/<?=$p->id?>" method="post">
                        <button type="submit">Delete </button>
                        </form>
                    </td>
                </tr>
            <?php endforeach?>
        </tr>
    </table> 
<?= $this->endSection()?>