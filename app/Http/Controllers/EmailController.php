<?php

namespace App\Http\Controllers;
use Mail;

class EmailController extends Controller
{
    public function sendEmail($email_cliente, $nome_cliente)
    {
        try {
            Mail::raw(
                'Parabéns '.$nome_cliente.', Seu pedido foi finalizado com sucesso!',
                function ($message) use ($email_cliente, $nome_cliente) {
                    $message->to($email_cliente)
                            ->subject('Olá '.$nome_cliente);
                }
            );
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }
}
