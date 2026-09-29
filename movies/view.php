<?php
include "functions.php";
view($_GET['id']);
include HEADER_TEMPLATE;
?>

<h2 class="mt-2">Filme <?php echo $movie['id']; ?></h2>
<hr>

<?php if (!empty($_SESSION['message'])): ?>
    <div class="alert alert-<?php echo $_SESSION['type']; ?>">
        <?= $_SESSION['message']; ?>
    </div>
<?php endif; ?>

<div class="row">
    <div class="col-md-3 mx-auto">
        <label for="poster">Poster:</label>
        <br>
        <img id="poster" src="fotos/<?= $movie['picture']; ?>" width="200">
    </div>
    <div class="col-md-9 mt-4">
        <dl class="dl-horizontal">
            <dt>Titulo:</dt>
            <dd><?php echo $movie['title']; ?></dd>

            <dt>Diretor:</dt>
            <dd><?php echo $movie['director']; ?></dd>

            <dt>Ano Lançamento:</dt>
            <dd><?php echo $movie['year']; ?></dd>
        </dl>

        <dl class="dl-horizontal">
            <dt>Data de Cadastro:</dt>
            <dd><?php echo formatadata($movie['created'], "d/m/Y - H:i:s"); ?></dd>

            <dt>Data da última atualização:</dt>
            <dd><?php echo formatadata($movie['modified'], "d/m/Y - H:i:s"); ?></dd>
        </dl>
    </div>
</div>

<div id="actions" class="row mt-3">
    <div class="col-md-12">
        <a href="edit.php?id=<?php echo $movie['id']; ?>" class="btn btn-secondary">
            <i class="fa-solid fa-pen-to-square"></i> Editar
        </a>
        <a href="index.php" class="btn btn-light">
            <i class="fa-solid fa-arrow-rotate-left"></i> Voltar
        </a>
    </div>
</div>

<?php include FOOTER_TEMPLATE; ?>