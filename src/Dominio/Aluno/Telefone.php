<?php

namespace Alura\Arquitetura\Dominio\Aluno;

class Telefone implements \Stringable {
   private string $ddd;
   private string $telefone;

   public function __construct(string $ddd, string $telefone) {
      
      if (!preg_match('/^[1-9]{2}$/', $ddd)) {
         throw new \InvalidArgumentException('DDD inválido. Deve ter 2 dígitos numéricos entre 11 e 99.');
      }

      if (!preg_match('/^\d{8,9}$/', $telefone)) {
         throw new \InvalidArgumentException('Telefone inválido. Deve ter 8 ou 9 dígitos numéricos.');
      }

      $this->ddd = $ddd;
      $this->telefone = $telefone;
   }

   public function ddd(): string {
      return $this->ddd;
   }

   public function telefone(): string {
      return $this->telefone;
   }

   public function __toString(): string
   {
      return "({$this->ddd}) {$this->telefone}";
   }
}