<?php
require_once 'connection/RepositorioEmBDR.php';

class Connection implements RepositorioEmBDR
{
    private static $pdo = null;

    public function __construct()
    {
    }
    public function connect()
    {
        try {
            if (!isset($pdo)) {
                return $pdo = new PDO("mysql:dbname=saveur;host=localhost;charset=UTF8", "root", "", [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
            }
        } catch (PDOException $e) {
            die("Erro: " . $e->getMessage());
        }
    }

    /**
     * @return mixed
     */
    public function listar()
    {
        $pdo = $this->connect();
        try {
            $ps = $pdo->prepare('SELECT cliente.nome, mesa.numero, mesa.estado, reserva.dia, reserva.hora FROM cliente JOIN reserva 
            ON(cliente.id = reserva.id_cliente) JOIN funcionario ON(funcionario.id=reserva.id_funcionario) JOIN mesa ON(reserva.id = mesa.id_reserva)');
            $ps->execute();
            $reservas = $ps->fetchAll(PDO::FETCH_ASSOC);
            $ps->rowCount() > 0 ? $reservas : null;
        } catch (PDOException $e) {
            die("Erro ao consultar reservas: " . $e->getMessage());
        }
    }


    /**
     * @param mixed $comando
     * @param mixed $parametros
     * @return mixed
     */
    public function remover($comando, $parametros)
    {
    }

    /**
     *
     * @param mixed $comando
     * @param mixed $parametros
     * @return mixed
     */
    public function atualizar($comando, $parametros)
    {
    }

    /**
     *
     * @param mixed $comando
     * @param mixed $parametros
     * @return mixed
     */
    public function inserir($comando, $parametros)
    {
    }
}
