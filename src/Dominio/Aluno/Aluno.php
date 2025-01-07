<?php

namespace Alura\Arquitetura\Dominio\Aluno;

use Alura\Arquitetura\Dominio\Cpf;
use Alura\Arquitetura\Dominio\Email;

class Aluno {
   private Cpf $cpf;
   private string $nome;
   private Email $email;
   private array $telefones;

   public static function comCpfNomeEEmail(string $cpf, string $nome, string $email): self {

      return new Aluno(new Cpf($cpf), $nome, new Email($email));

   }

   public function __construct(Cpf $cpf, string $nome, Email $email) {

      $this->cpf = $cpf;
      $this->nome = $nome;
      $this->email = $email;

   }
   
   
   public function adicionarTelefone(string $ddd, string $numero) {

      $this->telefones[] = new Telefone($ddd, $numero);
      return $this;

   }

}


// (new Aluno(new Cpf('123'), 'Matheus', new Email('email')))
//    ->adicionarTelefone('11', '999999999');

// $aluno = Aluno::comCpfNomeEEmail('123', 'Carla', 'carla@gmail.com');