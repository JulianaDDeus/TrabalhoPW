<?php
include "functions.php";
index();
include HEADER_TEMPLATE;
?>

<header class="mt-2">
    <div class="row">
        <div class="col-sm-6">
            <h2>Filmes</h2>
        </div>
        <div class="col-sm-6 text-end h2">
            <a class="btn btn-secondary" href="add.php"><i class="fa-solid fa-square-plus"></i> Novo Filme</a>
            <a class="btn btn-light" href="index.php"><i class="fa-solid fa-refresh"></i> Atualizar</a>
        </div>
    </div>
</header>

<?php if (!empty($_SESSION['message'])): ?>
    <div class="alert alert-<?php echo $_SESSION['type']; ?> alert-dismissible fade show" role="alert">
        <?php echo $_SESSION['message']; ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php //clear_messages(); ?>
<?php endif; ?>

<hr>

<table class="table table-hover">
    <thead>
        <tr>
            <th>ID</th>
            <th width="20%">Titulo</th>
            <th>Diretor</th>
            <th>Lançamento</th>
            <th>Atualizado em</th>
            <th>Foto</th>
            <th>Opções</th>
        </tr>
    </thead>
    <tbody>
        <?php if ($movies): ?>
            <?php foreach ($movies as $movie): ?>
                <tr>
                    <td>
                        <?php echo $movie['id']; ?>
                    </td>
                    <td>
                        <?php echo $movie['title']; ?>
                    </td>
                     </td>
                    <td>
                        <?php echo $movie['director']; ?>
                    </td>
                    <td>
                        <?php echo $movie['year']; ?>
                    </td>
                    <td>
                        <?php
                        $dt = new DateTime($movie['modified'], new DateTimeZone("-0300"));
                        echo $dt->format("d/m/Y - H:i:s");
                        ?>
                    </td>
                    <td>
                        <img src="fotos/<?php echo $movie['picture']; ?>" class="img-thumbnail shadow foto" width="120px"></style>
                    </td>
                    <td class="actions text-end">
                        <a href="view.php?id=<?php echo $movie['id']; ?>" class="btn btn-sm btn-light">
                            <i class="fa-solid fa-eye"></i> Visualizar
                        </a>
                        <a href="edit.php?id=<?php echo $movie['id']; ?>" class="btn btn-sm btn-secondary">
                            <i class="fa-solid fa-pen-to-square"></i> Editar
                        </a>
                        <a href="#" class="btn btn-sm btn-dark" data-bs-toggle="modal" data-bs-target="#delete-modal"
                            data-customer="<?php echo $movie['id']; ?>">
                            <i class="fa-solid fa-trash-can"></i> Excluir
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="6">Nenhum registro encontrado.</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>

<?php 
include "modal.php";
include FOOTER_TEMPLATE; 
?>