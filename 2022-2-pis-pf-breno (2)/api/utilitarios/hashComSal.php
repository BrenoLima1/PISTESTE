<?php

/**
 * Retorna o hash, com sal, do conteúdo informado. 
 * @param string 
 * @return string
 **/
function hashComSal($conteudo)
{
    return hash('sha256', $conteudo . '}]-+$#_ç');
}
