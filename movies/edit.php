<?php 
  include"functions.php"; 
  edit();
  include HEADER_TEMPLATE;
  ?>

<h2>Atualizar Filme</h2>

<form action="edit.php?id=<?php echo $movie['id']; ?>" method="post" enctype="multipart/form-data">
  <!-- area de campos do form -->
  <hr>
  <div class="row">
    <div class="form-group col-md-6">
      <label for="title">Titulo</label>
      <input type="text" class="form-control" id="title" name="movie[title]" value="<?php echo $movie['title']; ?>">
    </div>

    <div class="form-group col-md-6">
      <label for="director">Diretor</label>
      <input type="text" class="form-control" id="director" name="movie[director]" value="<?php echo $movie['director']; ?>">
    </div>
  </div>
  
  <div class="row">
    <div class="form-group col-md-6">
      <div class="column">
        <label for="year">Lançamento</label>
        <input type="text" class="form-control" id="year" name="movie[year]" maxlength="4" value="<?php echo $movie['year']; ?>">
         <label for="modified">Atualização</label>
        <input type="date" class="form-control" id="created" name="movie[modified]" value="<?php echo formatadata($movie['modified'], "Y-m-d"); ?>" disabled>
      </div>
    </div>
    <div class="form-group col-md-3">
      <label for="picture">Foto</label>
      <input type="file" class="form-control" id="picture" name="movie[picture]" accept="image/*">
    </div>
    <div class="form-group col-md-3">
      <label for="image-preview">Pré-Visualização</label>
      <img src="fotos/<?= $movie['picture'] ?>" id="image-preview" height="200px">
    </div>
  </div>
  
  <div id="actions" class="row mt-2">
    <div class="col-md-12">
      <button type="submit" class="btn btn-secondary"><i class="fa-solid fa-floppy-disk"></i> Salvar</button>
      <a href="index.php" class="btn btn-light"><i class="fa-solid fa-rotate-left"></i> Cancelar</a>
    </div>
  </div>
</form>
<script>
  const fileInput = document.getElementById('picture');
  const imagePreview = document.getElementById('image-preview');

  fileInput.addEventListener('change', function (event) {
      const file = event.target.files[0];

      if (file) {
          let reader = new FileReader();

          reader.onload = function (e) {
              imagePreview.src = e.target.result;
          }

          reader.readAsDataURL(file);
      }
  });
</script>
<?php include(FOOTER_TEMPLATE); ?>