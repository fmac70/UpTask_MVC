<?php

namespace Classes;

use PHPMailer\PHPMailer\PHPMailer;

class Email
{
    // Email class implementation
	protected $email;
	protected $nombre;
	protected $token;

	public function __construct($email = null, $nombre = null, $token = null)
	{
		$this->email = $email;
		$this->nombre = $nombre;
		$this->token = $token;
	}

	public function enviarConfirmacion()
	{
		// Implementar lógica para enviar email de confirmación
		// Puedes usar una librería como PHPMailer o SwiftMailer para enviar el email
		// Aquí solo se muestra un ejemplo básico de cómo podrías estructurar el método
		$mail = new PHPMailer();
		$mail->isSMTP();
		$mail->Host = 'sandbox.smtp.mailtrap.io';
		$mail->SMTPAuth = true;
		$mail->Port = 2525;
		$mail->Username = '54f83bbb4e7628';
		$mail->Password = '2e55d064582615';

		$mail->setFrom('fmac70@gmail.com', 'UpTask - Administrador de Proyectos');
		$mail->addAddress($this->email, $this->nombre);
		$mail->Subject = 'Confirma tu cuenta en UpTask';
		$mail->isHTML(true);
		$mail->charSet = 'UTF-8';
		
		$contenido = '<html>';
		$contenido .= '<p><strong>Hola ' . $this->nombre . '</strong>,</p>';
		$contenido .= '<p>Gracias por registrarte en UpTask. Por favor, confirma tu cuenta haciendo clic en el siguiente enlace:</p>';
		$contenido .= '<p><a href="http://localhost:3000/confirmar?token=' . $this->token . '">Confirmar Cuenta</a></p>';
		$contenido .= '<p>Si no te registraste en UpTask, puedes ignorar este mensaje.</p>';
		$contenido .= '<p>Saludos,<br>El equipo de UpTask</p>';
		$contenido .= '</html>';	

		$mail->Body = $contenido;
		$mail->send();
		//$asunto  = "Confirma tu cuenta en UpTask";
		/*
		$mensaje = "Hola " . $this->nombre . ",\n\n";
		$mensaje .= "Gracias por registrarte en UpTask. Por favor, confirma tu cuenta haciendo clic en el siguiente enlace:\n\n";
		$mensaje .= "http://tusitio.com/confirmar?token=" . $this->token . "\n\n";
		$mensaje .= "Si no te registraste en UpTask, puedes ignorar este mensaje.\n\n";
		$mensaje .= "Saludos,\nEl equipo de UpTask";
		*/
		// Aquí deberías implementar la lógica para enviar el email usando la librería que elijas
	}
}

