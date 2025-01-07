<?php

namespace Alura\Arquitetura\Dominio\Aluno;

use Alura\Arquitetura\Dominio\Cpf;
use Alura\Arquitetura\Dominio\Email;

class FabricaAluno {

   private ?Aluno $aluno = null;

   //Padrão Builder com uma Factory
   public function comCpfEmailENome(string $numeroCpf, string $email, string $nome) {

      $this->aluno = (new Aluno(new Cpf($numeroCpf), $nome, new Email($email)));
      return $this;

   }

   public function adicionaTelefone(string $ddd, string $numero) {

      if ($this->aluno === null) {
         throw new \BadMethodCallException("O aluno deve ser criado antes de adicionar um telefone.");
      }

      $this->aluno->adicionarTelefone($ddd, $numero);
      return $this;

   }

   public function aluno(): Aluno
   {
      if ($this->aluno === null) {
         throw new \BadMethodCallException("O aluno ainda não foi criado.");
      }

      return $this->aluno;
   }
}