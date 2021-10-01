<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class MailController extends Controller
{

    public function sendMail($to, $subject, $message) {
        $mail = new PHPMailer(true);
        try {
            //Server settings
            $mail->SMTPDebug = false;                      //Enable verbose debug output
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = 'mail.privateemail.com';                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;     
            $mail->CharSet = 'UTF-8';                              //Enable SMTP authentication
            $mail->Username   = 'info@buscargo.pt';                     //SMTP username
            $mail->Password   = 'Fishandchips100';                               //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;         //Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
            $mail->Port       = 465;                                    //TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

            //Recipients
            $mail->setFrom('info@buscargo.pt', 'BusCargo');
            $mail->addAddress($to);     //Add a recipient
            $mail->addReplyTo('info@buscargo.pt', 'Information');
           
            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = $subject;
            $mail->Body    = $this->setHTMLTemplate($subject, $message);

            $mail->send();
            return true;
        } catch (Exception $e) {
            abort(422, "Message could not be sent. Mailer Error: {$mail->ErrorInfo}");
        }
    }

    protected function setHTMLTemplate($subject, $message) {
        $html = '<!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;700&display=swap" rel="stylesheet"> 
            <title>Mail Template</title>
            <style>
                .container{
                    background: url("https://buscargo.pt/public/images/email_bg.png") no-repeat;
                    background-size: cover;
                    max-width: 600px;
                    min-height: 650px;
                    margin: 0px auto;
                    padding: 30px 50px;
                    color: white;
                    font-family: "Roboto";
                }
                .text{
                    margin-top: 80px;
					width: 85%;
                }
                .bold{ font-weight: 700;}
                .light{ font-weight: 300;}
                p{ margin-top: 30px; font-size: 15px; overflow-wrap: anywhere;}
                .social{
                    margin-top: 180px;
                }
                .item{
                    display: flex;
                    align-items: center;
                    margin-top: 15px;
                    font-size: 15px;
                    align-items: center !important;
                }
                .item img{ margin-right: 17px;}
                .copy{
                    display: flex;
                    justify-content: center;
                    font-size: 12px;
                    margin-top: 110px;
                }
            </style>
        </head>
        <body>
            <div class="container" style="width: 100%; height: 100%;">
                <div class="text">
                    <h2 class="bold">'.$subject.'</h2>
                    <p class="light">
                        '.$message.'
                    </p>
                </div>
        
                <div class="social">					
					<div class="item">
                        <img src="https://buscargo.pt/public/images/phone-call.png" alt="" width="22px"> <span class="bold">+351 210 203 206</span>
                    </div>
		
                    <div class="item">
                        <img src="https://buscargo.pt/public/images/envelope.png" alt="" width="22px"> <span class="bold">info@buscargo.pt</span>
                    </div>
        
                    <div class="item">
                        <img src="https://buscargo.pt/public/images/instagram.png" alt="" width="22px"> <span class="bold">@buscargopt</span>
                    </div>
        
                    <div class="item">
                        <img src="https://buscargo.pt/public/images/facebook.png" alt="" width="22px"> <span class="bold">@buscargotransporte</span>
                    </div>
                </div>

                <div class="copy">
                    &copy; BusCargo LDA. All rights reserved.
                </div>
				
				<div class="logo" style="bottom: 0px">
                    <img src="https://buscargo.pt/public/images/bus_B.png" alt="" srcset="" width="70px">
                </div>
            </div>
        </body>
        </html>';
        return $html;
    }
}
