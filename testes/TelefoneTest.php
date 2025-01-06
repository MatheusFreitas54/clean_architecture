<?php

namespace Alura\Arquitetura\Testes;

require_once __DIR__ . '/../vendor/autoload.php';

use Alura\Arquitetura\Telefone;
USE PHPUnit\Framework\TestCase;

class TelefoneTest extends TestCase {

   public function testTelefoneNoFormatoInvalidoNaoDevePoderExistir() {
      $invalidDDD = '123';
      $invalidTelefone = '12345';

      $this->expectException(\InvalidArgumentException::class);
      
      new Telefone($invalidDDD, $invalidTelefone);
   }

   public function testTelefoneDevePoderSerRepresentadoComoString() {
      // Exemplo de DDD e telefone válidos
      $validDDD = '11'; // DDD válido
      $validTelefone = '912345678'; // Telefone válido (9 dígitos)
  
      // Criando uma instância da classe Telefone
      $telefone = new Telefone($validDDD, $validTelefone);
  
      // Espera que o telefone seja representado como uma string no formato DDD + Telefone
      $this->assertSame('(11) 912345678', (string) $telefone);
   }
}