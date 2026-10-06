<?php
ob_start();
include "../config.php";
include DBAPI;

$usuarios = null;
$usuario = null;

function index(){
  global $usuarios;
  if(!empty($_POST['users'])){
    $usuario = filter("usuarios", "nome like '%" . $_POST['users'] . "%'");
  } else{
    $usuarios = find_all("usuarios");
  }
}

function upload($pasta_destino, $arquivo_destino, $tipo_arquivo, $nome_temp, $tamanho_arquivo){
  try{
    $nomearquivo = basename($arquivo_destino);
    $uploadOk = 1;
    if(isset($_POST["submit"])){
      $check = getimagesize($nome_temp);
      if($check !== false){
        $_SESSION['message'] = "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
      } else{
        $uploadOk = 0;
        throw new Exception("O arquivo não é uma imagem!");
      }
    }
    if(file_exists($arquivo_destino)){
      $uploadOk = 0;
      throw new Exception("Desculpe, o arquivo já existe!");
    }
    if($tamanho_arquivo > 5000000){
      $uploadOk = 0;
      throw new Exception("Desculpe, mas o arquivo é muito grande!");
    }
    if($tipo_arquivo != "jpg" && $tipo_arquivo != "png" && $tipo_arquivo != "jpeg" && $tipo_arquivo != "gif"){
      $uploadOk = 0;
      throw new Exception("Desculpe, mas só são permitidos arquivos de imagem JPG, JPEG, PNG e GIF!");
    }
    if($uploadOk == 0){
      throw new Exception("Desculpe, mas o arquivo não pode ser enviado.");
    } else{
      if(move_uploaded_file($_FILES["foto"]["tmp_name"], $arquivo_destino)){
        $_SESSION['message'] = "O arquivo " . htmlspecialchars($nomearquivo) . " foi armazenado.";
        $_SESSION['type'] = "success";
      }else{
        throw new Exception("Desculpe, mas o arquivo não pode ser enviado");
      }
    }
  } catch (Exception $e) {
    $_SESSION['message'] = "Aconteceu um erro: " . $e->getMessage();
    $_SESSION['type'] = "danger";
  }
}
/**
 *  Função para formatar as datas
 */
function formatadata($data, $formato)
{
    $dt = new DateTime($data, new DateTimeZone("-0300"));
    return $dt->format($formato);
}

/**
 *  Função para formatar os telefones
 */
function telefone($tel)
{               //15 43221516
    return "(" . substr($tel, 0, 2) . ")" . substr($tel, 2, 5)
        . "-" . substr($tel, 7);
}
/**
 *  Função para formatar CEP
 */
function cep($cep){
  return substr($cep, 0, 5) . "-" . substr($cep, 5);
}
/**
 *  Listagem de Clientes
 */
function index()
{
    global $usuarios;
    $usuarios = find_all("usuario$usuarios");
}

/**
 *  Visualização de um Cliente
 */
function view($id = null)
{
    global $usuario;
    $usuario = find("usuario$usuarios", $id);
}

/**
 *  Cadastro de Clientes
 */
function add() {

  if (!empty($_POST['usuario'])) {
    //TODO continuar aqui
  }
}

/**
 *	Atualizacao/Edicao de Cliente
 */
function edit() {

  $now = new DateTime('now', new DateTimeZone("-0300"));

  if (isset($_GET['id'])) {

    $id = $_GET['id'];

    if (isset($_POST['usuario$usuario'])) {

      $usuario = $_POST['usuario$usuario'];
      $usuario['modified'] = $now->format("Y-m-d H:i:s");

      update("usuario$usuarios", $id, $usuario);
      header("location: index.php");
      exit;
    } else {

      global $usuario;
      $usuario = find('usuario$usuarios', $id);
    } 
  } else {
    header('location: index.php');
    exit;
  }
}

/**
 *  Exclusão de um Cliente
 */
function delete($id = null) {

  global $usuario;
  $usuario = remove("usuario$usuarios", $id);

  header("location: index.php");
  exit;
}