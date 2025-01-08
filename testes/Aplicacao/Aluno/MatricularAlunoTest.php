<?php

namespace Alura\Arquitetura\Testes\Aplicacao\Aluno;

use Alura\Arquitetura\Aplicacao\Aluno\MatricularAluno\MatricularAluno;
use Alura\Arquitetura\Aplicacao\Aluno\MatricularAluno\MatricularAlunoDto;
use Alura\Arquitetura\Dominio\Aluno\Aluno;
use Alura\Arquitetura\Dominio\Cpf;
use Alura\Arquitetura\Infra\Aluno\RepositorioDeAlunosEmMemoria;
use PHPUnit\Framework\TestCase;

class MatricularAlunoTest extends TestCase {

   public function testAlunoDeveSerAdicionadoAoRepositorio() {
      
      $dadosAluno = new MatricularAlunoDto(
         '947.104.500-21',
         'Teste',
         'email@example.com',
      );
      $repositorioDeAluno = new RepositorioDeAlunosEmMemoria();
      $useCase = new MatricularAluno($repositorioDeAluno);

      $useCase->executa($dadosAluno);

      $aluno = $repositorioDeAluno->buscarPorCpf(new Cpf('947.104.500-21'));
      $this->assertSame('Teste', (string) $aluno->nome());
      $this->assertSame('email@example.com', (string) $aluno->email());
      $this->assertEmpty($aluno->telefones());
   }
}