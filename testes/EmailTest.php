<?php

namespace Alura\Arquitetura\Testes;

require_once __DIR__ . '/../vendor/autoload.php';

use Alura\Arquitetura\Dominio\Email;
USE PHPUnit\Framework\TestCase;

class EmailTest extends TestCase {

   public function testEmailNoFormatoInvalidoNaoDevePoderExistir() {

      $this->expectException(\InvalidArgumentException::class);
      new Email('email inválido');
   }

   public function testEmailDevePoderSerRepresentadoComoString() {
      
      $email = new Email('endereco@example.com');
      $this->assertSame('endereco@example.com', (string) $email);
   }
}