<?php

namespace Alura\Arquitetura\Infra\Aluno;

use Alura\Arquitetura\Dominio\Aluno\RepositorioDeIndicacao;
use Alura\Arquitetura\Dominio\Aluno\Aluno;

class RepositorioDeAlunosIndicados implements RepositorioDeIndicacao {

   private \PDO $conexao;

   public function __construct(\PDO $conexao) {
      $this->conexao = $conexao;
   }
   
   public function indicar(Aluno $aluno_indicante, Aluno $aluno_indicado): void {

      $sql = 'INSERT INTO indicacoes (cpf_indicante, cpf_indicado, data_indicacao) 
               VALUES (:cpf_indicante, :cpf_indicado, :data_indicacao)';
      $stmt = $this->conexao->prepare($sql);
      $stmt->bindValue('cpf_indicante', $aluno_indicante->cpf());
      $stmt->bindValue('cpf_indicado', $aluno_indicado->cpf());
      $stmt->bindValue('data_indicacao', date('Y-m-d H:i:s'));
      $stmt->execute();
   }

   public function salvarAlunoIndicado(Aluno $aluno_indicado): void {

      $sql = 'INSERT INTO alunos (cpf, nome, email) VALUES (:cpf, :nome, :email)';
      $stmt = $this->conexao->prepare($sql);
      $stmt->bindValue('cpf', $aluno_indicado->cpf());
      $stmt->bindValue('nome', $aluno_indicado->nome());
      $stmt->bindValue('email', $aluno_indicado->email());
      $stmt->execute();

      $sqlTelefones = 'INSERT INTO telefones (ddd, numero, cpf_aluno) VALUES (:ddd, :numero, :cpf_aluno)';
      $stmtTelefones = $this->conexao->prepare($sqlTelefones);
      $stmtTelefones->bindValue('cpf_aluno', $aluno_indicado->cpf());

      foreach ($aluno_indicado->telefones() as $telefone) {
         $stmtTelefones->bindValue('ddd', $telefone->ddd());
         $stmtTelefones->bindValue('numero', $telefone->telefone());
         $stmtTelefones->execute();
      }
   }

}