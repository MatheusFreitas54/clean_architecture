<?php

namespace Alura\Arquitetura\Infra\Aluno;

use Alura\Arquitetura\Dominio\Aluno\RepositorioDeAluno;
use Alura\Arquitetura\Dominio\Aluno\Aluno;
use Alura\Arquitetura\Dominio\Cpf;
use Alura\Arquitetura\Dominio\Aluno\Telefone;

class RepositorioDeAlunoComPdo implements RepositorioDeAluno {

   private \PDO $conexao;

   public function __construct(\PDO $conexao) {

      $this->conexao = $conexao;
   }
   

   public function adicionar(Aluno $aluno): void {

      // $this->conexao->beginTransaction();

      $sql = 'INSERT INTO alunos VALUES (:cpf, :nome, :email);';
      $stmt = $this->conexao->prepare($sql);
      $stmt->bindValue('cpf', $aluno->cpf());
      $stmt->bindValue('nome', $aluno->nome());
      $stmt->bindValue('email', $aluno->email());
      $stmt->execute();

      /** @var Telefone $telefone */
      foreach ($aluno->telefones() as $telefone) {

         $sql = 'INSERT INTO telefones VALUES (:ddd, :numero, :cpf_aluno)';
         $stmt = $this->conexao->prepare($sql);
         $stmt->bindValue('ddd', $telefone->ddd());
         $stmt->bindValue('numero', $telefone->telefone());
         $stmt->bindValue('cpf_aluno', $aluno->cpf());
         $stmt->execute();
      }

      // $this->conexao->commit();
   }

   public function buscarPorCpf(Cpf $cpf): Aluno {
      $aluno = Aluno::comCpfNomeEEmail('1231321', 'Matheus', 'Matheus@gmail.com.br');
      return $aluno;
   }

   public function buscarTodos(): array {
      return [];
   }
}