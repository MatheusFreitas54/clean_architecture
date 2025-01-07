<?php

namespace Alura\Arquitetura\Dominio\Aluno;

interface RepositorioDeIndicacao {

   public function indicar(Aluno $aluno_indicante, Aluno $aluno_indicado): void;
   public function SalvarAlunoindicado(Aluno $aluno_indicado): void;
}