<?php

namespace Alura\Arquitetura\Testes\Dominio;

require_once __DIR__ . '/../../vendor/autoload.php';

use Alura\Arquitetura\Dominio\Cpf;
use PHPUnit\Framework\TestCase;

class CpfTest extends TestCase {

   public function testCpfComNumeroNoFormatoInvalidoNaoDevePoderExistir() {

      $this->expectException(\InvalidArgumentException::class);
      new Cpf('12345678910');
   }

   public function testCpfDevePoderSerRepresentadoComoString() {
      
      $cpf = new Cpf('271.094.450-20');
      $this->assertSame('271.094.450-20', (string) $cpf);
   }

   public function testCpfDevePoderSerRepresentadoComoStringSegundaVersao() {
      
      $cpf = new Cpf('27109445020');
      $this->assertSame('27109445020', (string) $cpf);
   }
}