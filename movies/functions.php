<?php
ob_start();
include "../config.php";
include DBAPI;

$movies = null;
$movie = null;

/**
 *  Função para formatar as datas
 */
function formatadata($data, $formato)
{
    $dt = new DateTime($data, new DateTimeZone("-0300"));
    return $dt->format($formato);
}
/**
 *  Listagem de Filmes
 */
function index()
{
    global $movies;
    $movies = find_all("movies");
}

/**
 *  Visualização de um Filme
 */
function view($id = null)
{
    global $movie;
    $movie = find("movies", $id);
}

/**
 *  Cadastro de Filme
 */
function add() {
    if (!empty($_POST['movie'])) {

        $today = new DateTime('now', new DateTimeZone("-0300"));
        $movie = $_POST['movie'];

        if (isset($_FILES['movie']['error']['picture']) &&
            $_FILES['movie']['error']['picture'] === UPLOAD_ERR_OK) {

            $picture = $_FILES['movie']['name']['picture'];
            $tmp_name = $_FILES['movie']['tmp_name']['picture'];

            move_uploaded_file($tmp_name, "fotos/" . $picture);

            $movie['picture'] = $picture;

        } else {
            $movie['picture'] = "semimagem.png";
        }

        $movie['modified'] = $movie['created'] = $today->format("Y-m-d H:i:s");

        save('movies', $movie);

        header("location: index.php");
        exit;
    }
}

/**
 *	Atualizacao/Edicao de Filme
 */
function edit() {

    $now = new DateTime('now', new DateTimeZone("-0300"));

    if (isset($_GET['id'])) {

        $id = $_GET['id'];

        if (isset($_POST['movie'])) {

            // Busca os dados atuais do filme
            $movieAtual = find('movies', $id);

            // Dados enviados pelo formulário
            $movie = $_POST['movie'];

            // Atualiza a data
            $movie['modified'] = $now->format("Y-m-d H:i:s");

            // Verifica se uma nova imagem foi enviada
            if (isset($_FILES['movie']['error']['picture']) &&
                $_FILES['movie']['error']['picture'] === UPLOAD_ERR_OK) {

                $picture = $_FILES['movie']['name']['picture'];
                $tmp_name = $_FILES['movie']['tmp_name']['picture'];

                // Salva a nova imagem na pasta fotos
                move_uploaded_file($tmp_name, "fotos/" . $picture);

                // Salva o nome da nova imagem no banco
                $movie['picture'] = $picture;

            } else {

                // Nenhuma imagem nova:
                // mantém a imagem que já estava no banco
                $movie['picture'] = $movieAtual['picture'];
            }

            update("movies", $id, $movie);

            header("location: index.php");
            exit;

        } else {

            global $movie;
            $movie = find('movies', $id);
        }

    } else {

        header('location: index.php');
        exit;
    }
}

/**
 *  Exclusão de um Filme
 */
function delete($id = null) {

  global $movie;
  $movie = remove("movies", $id);

  header("location: index.php");
  exit;
}