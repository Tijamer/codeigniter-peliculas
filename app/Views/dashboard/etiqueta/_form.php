<div class="mb-3">
<label class="form-label mb-3" for="Titulo">Titulo</label>
<input class="form-control" type="text" name="Titulo" placeholder="Titulo" id="Titulo" value="<?=old('titulo',$etiqueta->titulo)?>">
</div>

<div class="mb-3">
    <label class="form-label mb-3" for="categoria_id">Categoria</label>
    <select class="form-control" name="categoria_id" id="categoria_id">
        <option value=""></option>
        <?php foreach ($categorias as $c) : ?>
            <option <?= $c->id !== old('categoria_id',$etiqueta->categoria_id) ?: 'selected' ?> value="<?= $c->id ?>"><?= $c->titulos ?></option>
        <?php endforeach?>
    </select>
</div>

<button type="submit" class="btn btn-primary btn-sm mt-1"><?=$op?></button>
