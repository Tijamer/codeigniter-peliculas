<label for="Titulo">Titulo</label>
<input type="text" name="Titulo" placeholder="Titulo" id="Titulo" value="<?=old('Titulo',$pelicula->titulo)?>">

<label for="categoria_id">Categoria</label>

<select name="categoria_id" id="categoria_id">
    <option value=""></option>
    <?php foreach ($categorias as $c) : ?>
        <option <?= $c->id !== old('categoria_id',$pelicula->categoria_id) ?: 'selected' ?> value="<?= $c->id ?>"><?= $c->titulos ?></option>
    <?php endforeach?>
</select>

<label for="descripcion">Descripcion</label>
<textarea name="descripcion" id="descripcion">
<?=old('descripcion',$pelicula->descripcion)?>
</textarea>
<button type="submit"><?=$op?></button>