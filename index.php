<?php
include "config.php";
include DBAPI;
if(!isset($_SESSION)) session_start();
include HEADER_TEMPLATE;
try {
    $db = open_database();
    $erro = "";
} catch (Exception $e) {
    $erro = $e->getMessage();
}
?>

<h1>Dashboard</h1>
<hr>

<?php if ($erro == ""): ?>

    <div class="row">
        <div class="col-xs-6 col-sm-3 col-md-2">
            <a href="customers/add.php" class="btn btn-secondary">
                <div class="row">
                    <div class="col-xs-12 text-center">
                        <i class="fa fa-user-plus fa-5x"></i>
                    </div>
                    <div class="col-xs-12 text-center">
                        <p>Novo Cliente</p>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-xs-6 col-sm-3 col-md-2">
            <a href="customers" class="btn btn-light">
                <div class="row">
                    <div class="col-xs-12 text-center">
                        <i class="fa fa-users fa-5x"></i>
                    </div>
                    <div class="col-xs-12 text-center">
                        <p>Clientes</p>
                    </div>
                </div>
            </a>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-xs-6 col-sm-3 col-md-2">
            <a href="movies/add.php" class="btn btn-secondary">
                <div class="row">
                    <div class="col-xs-12 text-center">
                        <i class="fa fa-square-plus fa-5x"></i>
                    </div>
                    <div class="col-xs-12 text-center">
                        <p>Novo Filme</p>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-xs-6 col-sm-3 col-md-2">
            <a href="movies" class="btn btn-light">
                <div class="row">
                    <div class="col-xs-12 text-center">
                        <i class="fa fa-film fa-5x"></i>
                    </div>
                    <div class="col-xs-12 text-center">
                        <p>Filmes</p>
                    </div>
                </div>
            </a>
        </div>
    </div>
    <?php if(isset($_SESSION['user'])) : ?>
        <?php if($_SESSION['user'] == "admin") : ?>
            <div class="row" id="actions">
                <div class="col-xs-6 col-sm-3 col-md-2">
                    <a href="users/add.php" class="btn btn-secondary">
                        <div class="row">
                            <div class="col-xs-12 text-center">
                                <i class="fa-solid fa-user-tie fa-5x"></i>
                            </div>
                            <div class="col-xs-12 text-center">
                                <p>Novo Usuário</p>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-xs-6 col-sm-3 col-md-2">
                    <a href="movies" class="btn btn-light">
                        <div class="row">
                            <div class="col-xs-12 text-center">
                                <i class="fa fa-user-lock fa-5x"></i>
                            </div>
                            <div class="col-xs-12 text-center">
                                <p>Usuários</p>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        <?php endif; ?>
    <?php endif; ?>
<?php else: ?>
    <div class="alert alert-danger" role="alert">
        <p><strong>ERRO:</strong> Não foi possível Conectar ao Banco de Dados!<br>
            <?= $erro ?>
        </p>
    </div>
    <?php if(!empty($_SESSION['message'])) : ?>
        <div class="alert alert-<?php echo $_SESSION['type']; ?> alert-dismissible" role="alert">
            <p><strong>ERRO:</strong> Não foi possível Conectar o Banco de Dados!<br>
            <?php echo $_SESSION['message']; ?></p>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>
<?php endif; ?>

<?php include FOOTER_TEMPLATE; ?>