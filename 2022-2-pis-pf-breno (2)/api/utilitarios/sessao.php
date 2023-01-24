<?php

/**
 * Registra um usuário como logado.
 *
 * @param string $login Login do usuário.
 * @param string $nome Nome do usuário.
 */
function registrarUsuarioLogado($login, $nome)
{
    session_start();
    session_regenerate_id(true);
    $_SESSION['login'] = $login;
    $_SESSION['nome'] = $nome;
}
