<?php
class Reserva
{
    private $nomeCliente = '';
    private $dia;
    private $horario;
    private $mesa = 0;

    private $situacao = '';

    public function __construct($nomeCliente, $dia, $horario, $mesa, $situacao)
    {
        $this->setnomeCliente($nomeCliente);
        $this->setDia($dia);
        $this->setHorario($horario);
        $this->setMesa($mesa);
        $this->setSituacao($situacao);
    }

    /**
     * @return mixed
     */
    public function getMesa()
    {
        return $this->mesa;
    }

    /**
     * @param mixed $mesa 
     * @return self
     */
    public function setMesa($mesa): self
    {
        $this->mesa = $mesa;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getHorario()
    {
        return $this->horario;
    }

    /**
     * @param mixed $horario 
     * @return self
     */
    public function setHorario($horario): self
    {
        $this->horario = $horario;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getnomeCliente()
    {
        return $this->nomeCliente;
    }

    /**
     * @param mixed $nomeCliente 
     * @return self
     */
    public function setnomeCliente($nomeCliente): self
    {
        $this->nomeCliente = $nomeCliente;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDia()
    {
        return $this->dia;
    }

    /**
     * @param mixed $dia 
     * @return self
     */
    public function setDia($dia): self
    {
        $this->dia = $dia;
        return $this;
    }

	/**
	 * @return mixed
	 */
	public function getSituacao() {
		return $this->situacao;
	}
	
	/**
	 * @param mixed $situacao 
	 * @return self
	 */
	public function setSituacao($situacao): self {
		$this->situacao = $situacao;
		return $this;
	}
}
