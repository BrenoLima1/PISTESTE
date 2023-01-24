<?php
    interface RepositorioEmBDR{

        function listar();

        function remover($comando, $parametros);

        function atualizar($comando, $parametros);

        function inserir($comando, $parametros);

    }
