<label for="Titulo">Titulo</label>
<input type="text" name="Titulo" placeholder="Titulo" id="Titulo" value="<?=old('titulo',$etiqueta->titulo)?>">

<label for="categoria_id">Categoria</label>

<select name="categoria_id" id="categoria_id">
    <option value=""></option>
    <?php foreach ($categorias as $c) : ?>
        <option <?= $c->id !== old('categoria_id',$etiqueta->categoria_id) ?: 'selected' ?> value="<?= $c->id ?>"><?= $c->titulos ?></option>
    <?php endforeach?>
</select>

<button type="submit"><?=$op?></button>