<?php

namespace Alura\Arquitetura\Infra\Aluno;

use Alura\Arquitetura\Dominio\Aluno\RepositorioDeAluno;
use Alura\Arquitetura\Dominio\Aluno\Aluno;
use Alura\Arquitetura\Dominio\Cpf;
use Alura\Arquitetura\Dominio\Aluno\Telefone;

class RepositorioDeAlunosEmMemoria implements RepositorioDeAluno { 

   private array $alunos = [];

   public function adicionar(Aluno $aluno): void {

      $this->alunos[] = $aluno;
   }

   public function buscarPorCpf(Cpf $cpf): Aluno {

      $alunosFiltrados = array_filter(
         $this->alunos,
         fn ($aluno) => $aluno->cpf() == $cpf
      );

      if(count($alunosFiltrados) === 0) {
         throw new \DomainException("Aluno com CPF {$cpf->numero()} não encontrado.");
      }

      if(count($alunosFiltrados) > 1) {
         throw new \Exception();
      }

      return $alunosFiltrados[0];
   }

   public function buscarTodos(): array {
      return $this->alunos;
   }
}