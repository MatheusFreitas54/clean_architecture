<?php

namespace Alura\Arquitetura\Aplicacao\Aluno\MatricularAluno;

use Alura\Arquitetura\Dominio\Aluno\RepositorioDeAluno;
use Alura\Arquitetura\Dominio\Aluno\Aluno;

class MatricularAluno {

   private RepositorioDeAluno $repositorioDeAluno;

      public function __construct(RepositorioDeAluno $repositorioDeAluno) {
         $this->repositorioDeAluno = $repositorioDeAluno;
      }

      public function executa(MatricularAlunoDto $dados): void {
         // Criação do aluno
         $aluno = Aluno::comCpfNomeEEmail(
            $dados->cpfAluno,
            $dados->nomeAluno,
            $dados->emailAluno
         );

         foreach ($dados->telefones as $telefone) {
            $aluno->adicionarTelefone($telefone->ddd(), $telefone->telefone());
         }

         $this->repositorioDeAluno->adicionar($aluno);
      }
}