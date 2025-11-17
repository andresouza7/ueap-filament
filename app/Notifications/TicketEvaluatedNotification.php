<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;
use App\Models\Ticket;

class TicketEvaluatedNotification extends Notification
{
    use Queueable;

    protected Ticket $ticket;

    public function __construct(Ticket $ticket)
    {
        $this->ticket = $ticket;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        $months = [
            1 => 'janeiro',
            2 => 'fevereiro',
            3 => 'março',
            4 => 'abril',
            5 => 'maio',
            6 => 'junho',
            7 => 'julho',
            8 => 'agosto',
            9 => 'setembro',
            10 => 'outubro',
            11 => 'novembro',
            12 => 'dezembro',
        ];

        $mail = (new MailMessage)
            ->subject("Folha de ponto avaliada: {$months[$this->ticket->month]}/{$this->ticket->year}")
            ->greeting("Olá {$notifiable->person->name},")
            ->line("Sua folha de ponto para {$months[$this->ticket->month]}/{$this->ticket->year} foi **{$this->ticket->status}** em {$this->ticket->evaluated_at->format('d/m/Y')}.");

        $mail->line("Avaliado por: {$this->ticket->user->login}");

        if ($this->ticket->status === 'rejeitado' && $this->ticket->evaluator_notes) {
            $mail->line("Observações do avaliador: {$this->ticket->evaluator_notes}");
        }

        if ($this->ticket->file_path) {
            $mail->action('Abrir arquivo no Drive', $this->ticket->file_path);
        }

        $mail->line('Atenciosamente,')
            ->line('Equipe de RH');

        return $mail;
    }
}