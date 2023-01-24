<?php
require_once 'connection/connection.php';
require_once 'funcionario/RepositorioFuncionarioEmPDO.php';
class ControladoraFuncionarioEmPDO implements RepositorioFuncionarioEmPDO
{
    protected PDO $pdo;
    protected Connection $connection;
    public function __construct()
    {
        $this->connection = new Connection();
        $this->pdo = $this->connection->connect();
    }

    public function login($login, $senha)
    {
        try {
            $ps = $this->pdo->prepare('SELECT * FROM funcionario WHERE login = ? AND senha = ?');
            $ps->execute([$login, $senha]);
            $ps->setFetchMode(PDO::FETCH_ASSOC);
            $data = $ps->fetch();

            if (!$data) {
                return null;
            }

            $hidden = ['senha'];

            $data = array_filter(
                $data,
                fn ($key) => !in_array($key, $hidden, true),
                ARRAY_FILTER_USE_KEY
            );

            return $data;
        } catch (PDOException $e) {
            throw new Exception("Falha na conexão : " . $e->getMessage());
        }
    }

    /**
     * @param mixed $reserva
     * @return mixed
     */

    public function numeroMesa($mesa)
    {
        $ps = $this->pdo->prepare('SELECT id from mesa WHERE numero = ?');
        $ps->execute([$mesa]);
        $ps->fetchAll(PDO::FETCH_ASSOC);
    }

    public function criarReserva($nomeCliente, $dia, $horario, $funcionario)
    {
        $pdo = $this->pdo;

        try {
            $pdo->beginTransaction();

            $ps = $pdo->prepare("INSERT INTO reserva(id_funcionario, id_mesa, dia, hora, situacao, cliente) VALUES (?, 15,?, ?, 'em espera', ?)");
            $ps->execute([$funcionario, $dia, $horario, $nomeCliente]);

            $pdo->commit();

            return $ps->rowCount() > 0 ? true : false;
        } catch (PDOException $e) {
            $pdo->rollBack();
            throw new Exception('Falha na transação: ' . $e->getMessage());
        }
    }

    public function listarReservas()
    {
        try {
            $ps = $this->pdo->query("SELECT funcionario.nome as funcionario,reserva.cliente as cliente, mesa.numero as mesa, reserva.dia as dia, reserva.hora as hora,
            reserva.situacao as situacao FROM reserva join funcionario ON(funcionario.id = reserva.id_funcionario) JOIN mesa ON (mesa.id = reserva.id_mesa)
             WHERE situacao <> 'cancelada' AND situacao <> 'ocorrendo' ORDER BY dia, hora, mesa");
            return $ps->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die('Falha na listagem de reservas. ' . $e->getMessage());
        }
    }

    /**
     *
     * @param mixed $reserva
     * @return mixed
     */
    public function cancelarReserva($dia, $hora)
    {
        $pdo = $this->pdo;

        try {
            $pdo->beginTransaction();

            $ps = $pdo->prepare("UPDATE reserva SET situacao = 'cancelada' WHERE dia = ?, horario = ?");
            $ps->execute([$dia, $hora]);
            $pdo->commit();
        } catch (PDOException $e) {
            $pdo->rollBack();
            die('Falha ao cancelar reserva: ' . $e->getMessage());
        }
    }


    /**
     * function instance
     *
     * @return self
     */
    public static function instance(): self
    {
        return (new static());
    }
}
