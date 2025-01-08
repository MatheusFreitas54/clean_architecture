<?php

namespace Alura\Arquitetura\Aplicacao\Aluno\MatricularAluno;

use Alura\Arquitetura\Dominio\Aluno\Telefone;

class MatricularAlunoDto {

   public string $cpfAluno;
   public string $nomeAluno;
   public string $emailAluno;

   /** @var Telefone[] */
   public array $telefones = [];


   public function __construct(string $cpfAluno, string $nomeAluno, string $emailAluno, array $telefones = [])
   {
      $this->cpfAluno = $cpfAluno;
      $this->nomeAluno = $nomeAluno;
      $this->emailAluno = $emailAluno;

      foreach ($telefones as $telefone) {
         if (!$telefone instanceof Telefone) {
            throw new \InvalidArgumentException('Cada telefone deve ser uma instância de Telefone.');
         }
         $this->telefones[] = $telefone;
      }
   }

   public static function comTelefone(string $cpfAluno, string $nomeAluno, string $emailAluno, string $ddd, string $numero): self
   {
      $telefone = new Telefone($ddd, $numero);
      return new self($cpfAluno, $nomeAluno, $emailAluno, [$telefone]);
   }
}