<?php

namespace Alura\Arquitetura\Dominio;

class Cpf implements \Stringable {
   private string $cpf;

   public function __construct(string $cpf) {
      
      if (!$this->isValidCPF($cpf)) {
         throw new \InvalidArgumentException(
            'CPF inválido'
         );
      }

      $this->cpf = $cpf;
   }

   /**
    * Verifica se o CPF é válido.
    *
    * @param string $cpf
    * @return bool
    */

   private function isValidCPF(string $cpf): bool {
      $cpf = preg_replace('/\D/', '', $cpf);

      if (strlen($cpf) !== 11) {
         return false;
      }

      if (preg_match('/^(\d)\1*$/', $cpf)) {
         return false;
      }

      for ($t = 9; $t < 11; $t++) {
         $sum = 0;
         for ($i = 0; $i < $t; $i++) {
            $sum += $cpf[$i] * (($t + 1) - $i);
         }

         $digit = ((10 * $sum) % 11) % 10;

         if ($cpf[$t] != $digit) {
            return false;
         }
      }

      return true;
   }

   public function __toString(): string
   {
      return $this->cpf;
   }
}