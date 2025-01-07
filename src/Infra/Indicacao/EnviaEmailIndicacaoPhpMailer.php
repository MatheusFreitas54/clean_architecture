<?php

namespace Alura\Arquitetura\Infra\Aluno;

use Alura\Arquitetura\Aplicacao\Indicacao\EnviaEmailIndicacao;
use Alura\Arquitetura\Dominio\Aluno\Aluno;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class EnviaEmailIndicacaoPhpMailer implements EnviaEmailIndicacao
{
   private PHPMailer $mailer;

   public function __construct(PHPMailer $mailer) {
      $this->mailer = $mailer;
   }

   public function enviaPara(Aluno $alunoIndicado): void {
      $mailer = new PHPMailer(true);

      try {
         // Configurações do servidor SMTP
         $mailer->isSMTP();
         $mailer->Host = 'smtp.gmail.com';
         $mailer->SMTPAuth = true;
         $mailer->Username = 'seu-email@gmail.com';
         $mailer->Password = 'sua-senha';
         $mailer->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
         $mailer->Port = 587;

         $mailer->setFrom('seu-email@gmail.com', 'Equipe Técnica');
         $mailer->addAddress($alunoIndicado->email(), $alunoIndicado->nome());

         $mailer->Subject = 'Você foi indicado para se juntar à nossa plataforma!';
         $mailer->Body = "
            Olá, {$alunoIndicado->nome()}!

            Você foi indicado por um de nossos alunos para se juntar à nossa plataforma.

            Estamos ansiosos para vê-lo(a) aqui. Caso tenha alguma dúvida, entre em contato conosco.

            Atenciosamente,
            Equipe Técnica
         ";
         $mailer->isHTML(false);

         if (!$mailer->send()) {
            throw new \RuntimeException("Falha ao enviar o e-mail: " . $mailer->ErrorInfo);
         }
      } catch (Exception $e) {
         throw new \RuntimeException("Erro ao enviar o e-mail: " . $e->getMessage());
      }
   }
}
