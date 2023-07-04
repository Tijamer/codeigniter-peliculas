<label for="Titulo">Titulo</label>
<input type="text" name="Titulo" placeholder="Titulo" id="Titulo" value="<?=$pelicula['titulo']?>">
<label for="descripcion">Descripcion</label>
<textarea name="descripcion" id="descripcion">
<?=$pelicula['descripcion']?>
</textarea>
<button type="submit"><?=$op?></button>