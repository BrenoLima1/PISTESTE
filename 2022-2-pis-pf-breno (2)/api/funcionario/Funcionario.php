<?php

class Funcionario
{
	private $nome = '';
	private $login = '';
	private $senha = '';

	public function __construct($nome, $login, $senha)
	{
		$this->setNome($nome);
		$this->setLogin($login);
		$this->setSenha($senha);
	}

	/**
	 * @return mixed
	 */
	public function getNome()
	{
		return $this->nome;
	}

	/**
	 * @param mixed $nome 
	 * @return self
	 */
	public function setNome($nome): self
	{
		$this->nome = $nome;
		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getLogin()
	{
		return $this->login;
	}

	/**
	 * @param mixed $login 
	 * @return self
	 */
	public function setLogin($login): self
	{
		$this->login = $login;
		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getSenha()
	{
		return $this->senha;
	}

	/**
	 * @param mixed $senha 
	 * @return self
	 */
	public function setSenha($senha): self
	{
		$this->senha = $senha;
		return $this;
	}
}
