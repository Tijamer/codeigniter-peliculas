<?= $this->extend('Layouts/dashboard')?>
<?= view('partials/_session')?>
<?= $this->section('contenido')?>

<div class="container">
<form action="" method="post">
<label class="form-label" for="">Categorias</label>
<select class="form-control"name="categoria_id" id="categoria_id">
    <option value=""></option>
    <?php foreach ($categorias as $c) : ?>
        <option <?=$c->id != $categoria_id ?: 'selected' ?> value="<?= $c->id ?>"><?= $c->titulos ?></option>
    <?php endforeach?>
</select>
<label class="form-label" for="">Etiquetas</label>
<select class="form-control" name="etiqueta_id" id="etiqueta_id">
    <option value=""></option>
    <?php foreach ($etiquetas as $e) : ?>
        <option value="<?= $e->id ?>"><?= $e->titulo ?></option>
    <?php endforeach?>
</select>

<button type="submit" id="send">Enviar</button>
</form>
</div>
<script>

    function disableEnableButton() {
        if(document.querySelector('[name=etiqueta_id]').value =='')
        {
            document.querySelector("#send").setAttribute('disabled','disabled')
        }else{
            document.querySelector("#send").removeAttribute('disabled')
        }
    }

    document.querySelector('[name=categoria_id]').onchange = function(event){        
        window.location.href = '<?= route_to('pelicula.etiquetas', $pelicula->id)?>?categoria_id='+this.value
    }
    document.querySelector('[name=etiqueta_id]').onchange = function(event){        
        disableEnableButton()
    }
    disableEnableButton()
</script>