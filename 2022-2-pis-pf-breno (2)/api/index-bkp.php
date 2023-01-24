<?php

require_once 'connection/RepositorioEmBDR.php';
require_once 'funcionario/ControladoraFuncionarioEmPDO.php';
require_once 'reserva/Reserva.php';

$con = new Connection();
$pdo = $con->connect();

$funcionario = new ControladoraFuncionarioEmPDO();


$url = $_SERVER['REQUEST_URI'];
$dir = dirname($_SERVER['PHP_SELF']);
$caminho = str_replace($dir, '', $url);
$metodo = $_SERVER['REQUEST_METHOD'];
$arrayRota = explode('/', $caminho);
$rota = end($arrayRota);

//Realizar login
if ($metodo === 'POST' && preg_match('/^login$/i', $rota)) {
    if (isset($_POST['login'], $_POST['senha'])) {
        $login = htmlspecialchars($_POST['login']);
        $senha = htmlspecialchars($_POST['senha']);

        $usuario = $funcionario->login($pdo, $login, $senha);

        if ($usuario) {
            http_response_code(200);
            die(json_encode([
                'usuario' => $usuario,
                'token' => md5(rand() . time()),
            ]));
        }
    }

    http_response_code(401);

    die(json_encode([
        'message' => 'Não autorizado',
    ]));
}

if ($metodo === 'POST' && preg_match('/^reservas$/i', $rota)) {
    $cliente = htmlspecialchars($_POST['cliente']);
    $dia = $_POST['dia'];
    $horario = $_POST['horario'];
    $mesa = htmlspecialchars($_POST['mesa']);
    $idFuncionario = htmlspecialchars($_POST['id']);
    $reserva = new Reserva($cliente, $dia, $horario, $mesa, $situacao);

    if (isset($_POST['cliente'], $_POST['dia'], $_POST['horario'], $_POST['mesa'],)) {
        if ($funcionario->criarReserva($pdo, $reserva->getnomeCliente(), $reserva->getDia(), $reserva->getHorario(), $idFuncionario)) {
            http_response_code(200);
            die('Cadastro realizado com sucesso!');
        }
        http_response_code(400);
        die();
    }
}

if ($metodo === 'GET' && preg_match('/^reservas$/i', $rota)) {

    $reservas = $funcionario->listarReservas($pdo);
    http_response_code(200);
    header('Content-Type: application/json');
    echo json_encode($reservas);
}

if ($metodo === 'PUT' && preg_match('/^reserva$/i', $rota)) {

    header('Content-Type: application/json');
    $data = json_decode(file_get_contents("php://input"), true);

    // $mesa = $data['mesa'];
    $dia = $data['dia'];
    $hora = $data['hora'];

    $reservas = $funcionario->cancelarReserva($pdo, $dia, $hora);
    // http_response_code(200);
}

http_response_code(404);
die(json_encode([
    'message' => 'Not Found',
]));
