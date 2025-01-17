<?php

namespace Alura\Arquitetura\Testes\Dominio\Aluno;

require_once __DIR__ . '/../../../vendor/autoload.php';

use Alura\Arquitetura\Dominio\Aluno\Telefone;
use PHPUnit\Framework\TestCase;

class TelefoneTest extends TestCase {

   public function testTelefoneNoFormatoInvalidoNaoDevePoderExistir() {
      $invalidDDD = '123';
      $invalidTelefone = '12345';

      $this->expectException(\InvalidArgumentException::class);
      
      new Telefone($invalidDDD, $invalidTelefone);
   }

   public function testTelefoneDevePoderSerRepresentadoComoString() {
      $validDDD = '11';
      $validTelefone = '912345678';

      $telefone = new Telefone($validDDD, $validTelefone);
      
      $this->assertSame('(11) 912345678', (string) $telefone);
   }
}