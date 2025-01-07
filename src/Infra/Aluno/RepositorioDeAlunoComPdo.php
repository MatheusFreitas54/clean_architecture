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

      $sql = 'INSERT INTO telefones VALUES (:ddd, :numero, :cpf_aluno)';
      $stmt = $this->conexao->prepare($sql);
      $stmt->bindValue('cpf_aluno', $aluno->cpf());

      /** @var Telefone $telefone */
      foreach ($aluno->telefones() as $telefone) {
         $stmt->bindValue('ddd', $telefone->ddd());
         $stmt->bindValue('numero', $telefone->telefone());
         $stmt->execute();
      }

      // $this->conexao->commit();
   }

   public function buscarPorCpf(Cpf $cpf): Aluno {
      $sql = 'SELECT cpf, nome, email FROM alunos WHERE cpf = :cpf';
      $stmt = $this->conexao->prepare($sql);
      $stmt->bindValue('cpf', $cpf->numero());
      $stmt->execute();
      $dadosAluno = $stmt->fetch(\PDO::FETCH_ASSOC);

      if (!$dadosAluno) {
         throw new \DomainException("Aluno com CPF {$cpf->numero()} não encontrado.");
      }

      $aluno = Aluno::comCpfNomeEEmail($dadosAluno['cpf'],$dadosAluno['nome'],$dadosAluno['email']);

      // Busca os telefones do aluno
      $telefones = $this->buscarTelefonePdo($dadosAluno['cpf']);

      if (!empty($telefones)) {
         foreach ($telefones as $telefone) {
            $aluno->adicionarTelefone($telefone['ddd'], $telefone['numero']);
         }
      }

      return $aluno;
   }

   public function buscarTodos(): array {
      $sql = 'SELECT cpf, nome, email FROM alunos';
      $stmt = $this->conexao->query($sql);
      $dadosAlunos = $stmt->fetchAll(\PDO::FETCH_ASSOC);

      $alunos = [];

      foreach ($dadosAlunos as $dadosAluno) {

         $aluno = Aluno::comCpfNomeEEmail($dadosAluno['cpf'],$dadosAluno['nome'],$dadosAluno['email']);

         // Busca os telefones de cada aluno
         $telefones = $this->buscarTelefonePdo($dadosAluno['cpf']);
         
         if (!empty($telefones)) {
            foreach ($telefones as $telefone) {
               $aluno->adicionarTelefone($telefone['ddd'], $telefone['numero']);
            }
         }

         $alunos[] = $aluno;
      }

      return $alunos;
   }

   public function buscarTelefonePdo(string $cpf): array {

      $sqlTelefones = 'SELECT ddd, numero FROM telefones WHERE cpf_aluno = :cpf';
      $stmtTelefones = $this->conexao->prepare($sqlTelefones);
      $stmtTelefones->bindValue('cpf', $cpf);
      $stmtTelefones->execute();

      return $stmtTelefones->fetchAll(\PDO::FETCH_ASSOC);

   }

}