<?php

namespace Alura\Arquitetura\Infra\Aluno;

use Alura\Arquitetura\Aplicacao\Indicacao\EnviaEmailIndicacao;
use Alura\Arquitetura\Dominio\Aluno\Aluno;

class EnviaEmailIndicacaoPhp implements EnviaEmailIndicacao {

   public function enviaPara(Aluno $alunoIndicado): void {
      
      $to = $alunoIndicado->email();
      $subject = "Você foi indicado para se juntar à nossa plataforma!";
      $message = "
         Olá, {$alunoIndicado->nome()}!

         Você foi indicado por um de nossos alunos para se juntar à nossa plataforma.

         Estamos ansiosos para vê-lo(a) aqui. Caso tenha alguma dúvida, entre em contato conosco.

         Atenciosamente, Equipe Tecnica
      ";
      $headers = [
         'From' => 'no-reply@gmail.com',
         'Reply-To' => 'suporte@gmail.com',
         'X-Mailer' => 'PHP/' . phpversion()
      ];

      $headersString = '';
      foreach ($headers as $key => $value) {
         $headersString .= "$key: $value\r\n";
      }

      $enviado = mail($to, $subject, $message, $headersString);

      if (!$enviado) {
         throw new \RuntimeException("Falha ao enviar o e-mail para {$alunoIndicado->email()}.");
      }
   }
   
}