<?php

interface RepositorioFuncionarioEmPDO
{
    function login($login, $senha);

    function criarReserva($nomeCliente, $dia, $horario, $funcionario);

    function cancelarReserva($dia, $hora);
}
