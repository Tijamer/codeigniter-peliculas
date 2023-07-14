<div class="mb-3">
    <label class="form-label" for="Titulo">Titulo</label>
    <input class="form-control" type="text" name="Titulo" placeholder="Titulo" id="Titulo" value="<?=old('Titulo',$pelicula->titulo)?>">
</div>

<div class="mb-3">
    <label class="form-label" for="categoria_id">Categoria</label>
        <select class="form-control" name="categoria_id" id="categoria_id">
            <option value=""></option>
                <?php foreach ($categorias as $c) : ?>
                    <option <?= $c->id !== old('categoria_id',$pelicula->categoria_id) ?: 'selected' ?> value="<?= $c->id ?>"><?= $c->titulos ?></option>
                <?php endforeach?>
        </select>
</div>

<div class="mb-3">
    <label class="form-label" for="descripcion">Descripcion</label>
<textarea class="form-control" name="descripcion" id="descripcion">
<?=old('descripcion',$pelicula->descripcion)?>
</textarea>
</div>
<div class="mb-3">
    <?php if ($pelicula->id) : ?>
        <label class="form-label" for="imagen">Imagen</label>
        <input class="form-control" type="file" name="imagen" id="imagen">
    <?php endif?>
</div>
<button type="submit" class="btn btn-primary btn-sm mt-1"><?=$op?></button>