<?php
ob_start();
include "../config.php";
include DBAPI;

$customers = null;
$customer = null;

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
    global $customers;
    $customers = find_all("customers");
}

/**
 *  Visualização de um Cliente
 */
function view($id = null)
{
    global $customer;
    $customer = find("customers", $id);
}

/**
 *  Cadastro de Clientes
 */
function add() {

  if (!empty($_POST['customer'])) {
    
    $today = new DateTime('now', new DateTimeZone("-0300"));

    $customer = $_POST['customer'];
    $customer['modified'] = $customer['created'] = $today->format("Y-m-d H:i:s");
    
    save('customers', $customer);
    header("location: index.php");
    exit;
  }
}

/**
 *	Atualizacao/Edicao de Cliente
 */
function edit() {

  $now = new DateTime('now', new DateTimeZone("-0300"));

  if (isset($_GET['id'])) {

    $id = $_GET['id'];

    if (isset($_POST['customer'])) {

      $customer = $_POST['customer'];
      $customer['modified'] = $now->format("Y-m-d H:i:s");

      update("customers", $id, $customer);
      header("location: index.php");
      exit;
    } else {

      global $customer;
      $customer = find('customers', $id);
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

  global $customer;
  $customer = remove("customers", $id);

  header("location: index.php");
  exit;
}