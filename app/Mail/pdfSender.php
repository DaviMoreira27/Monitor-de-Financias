<?php

namespace App\Mail;

use App\Models\FinanciasMes;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class pdfSender extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(public FinanciasMes $financiasMes)
    {
        
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            replyTo: [
                new Address('davimsantana2706@gmail.com', 'Balanço de Gastos'),
            ],
            subject: 'Relatório de gastos e faturamento mensal',
        );
    }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content()
    {
        return new Content(
            view: 'pdf.mail-template',
            with: [
                'month' => $this->financiasMes->month,
                'year' => $this->financiasMes->year,
                'gastosMes' => $this->financiasMes->gastosMes,
                'faturaDinheiro' => $this->financiasMes->faturaDinheiro,
                'faturaCartao' => $this->financiasMes->faturaCartao,
                'faturamentoMes' => $this->financiasMes->faturamentoMes,
                'bFinal' => $this->financiasMes->bFinal,
            ]
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    public function attachments()
    {
        return [
            // Attachment::fromPath('')
            // ->as('relatorio.pdf')
            // ->withMime('application/pdf'),
        ];
    }
}
