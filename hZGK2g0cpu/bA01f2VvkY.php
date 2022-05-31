<?php 

date_default_timezone_set('Asia/Hong_Kong');

include_once('..\phpmailer\PHPMailer.php');
include_once('..\phpmailer\SMTP.php');
include_once('..\phpmailer\Exception.php');

use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

$mail = new PHPMailer\PHPMailer\PHPMailer;

$body = 
'<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1" name="viewport">
    <meta name="x-apple-disable-message-reformatting">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title></title>
</head>
<body style="background-color: #000;font-family: Arial, Helvetica, sans-serif;position: absolute;left: 50%;transform: translateX(-50%);">
    <div>
        <table width="100%">
            <tbody>
                <tr>
                    <td>
                        <table align="center">
                            <tbody>
                                <tr>
                                    <td>
                                        <table>
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <table>
                                                            <tbody>
                                                                <tr>
                                                                    <td>
                                                                        <table>
                                                                            <tbody>
                                                                                <tr>
                                                                                    <td>
                                                                                        <a href="#">
                                                                                            <img src="cid:doorknock" alt="Logo" style="display: block;" title="Logo" width="150">
                                                                                        </a>
                                                                                    </td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <table align="center">
                            <tbody>
                                <tr>
                                    <td>
                                        <table>
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <table style="width: 100%;">
                                                            <tbody>
                                                                <tr>
                                                                    <td style="width:600px">
                                                                        <table style="width: 100%;">
                                                                            <tbody>
                                                                                <tr>
                                                                                    <td style="text-align: -webkit-center;">
                                                                                        <a href="#">
                                                                                            <img class="adapt-img" src="cid:paper_airplane" alt="Image" style="display: block;" title="Image" width="500">
                                                                                        </a>
                                                                                    </td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <table align="center">
                            <tbody>
                                <tr>
                                    <td>
                                        <table style="width: 620px; background-color: #f7f7f7;padding:10px;border-radius: 10px;">
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <table style="width: 100%;">
                                                            <tbody>
                                                                <tr>
                                                                    <td>
                                                                        <table>
                                                                            <tbody>
                                                                                <tr>
                                                                                    <td style="text-align: -webkit-center;">
                                                                                        <h2>We Are DoorKnock</h2>
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td>
                                                                                        <p>Thanks for your signing up. We are so happy that you use DoorKnock password manager. Please click the button below to activate your account.</p>
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td style="text-align: -webkit-center;margin-top: 20px;">
                                                                                        <span>
                                                                                            <a href="https://dkpm.com/hZGK2g0cpu/yX9lCJtLcW?ALXEjY8McZ='.$access_token.'" target="_blank" style="background-color: #973c35;text-decoration: none;color: #fff;padding: 10px;font-size: 23px;border-radius: 7px;">Activate Account</a>
                                                                                        </span>
                                                                                    </td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                        <table style="margin-top:50px;">
                                                                            <tbody>
                                                                                <tr>
                                                                                    <td style="margin-top: 20px;">
                                                                                        <span>Trouble clicking? Copy and paste this URL into your browser.</span>
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td style="margin-top: 20px;">
                                                                                        <span>
                                                                                            <a href="https://dkpm.com/hZGK2g0cpu/yX9lCJtLcW?ALXEjY8McZ='.$access_token.'" target="_blank">https://dkpm.com/hZGK2g0cpu/yX9lCJtLcW?ALXEjY8McZ='.$access_token.'</a>
                                                                                        </span>
                                                                                    </td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <table align="center" style="margin-top:50px">
                            <tbody>
                                <tr>
                                    <td style="background-color: #f7f7f7;border-radius: 7px;padding: 10px;">
                                        <table style="width: 600px;">
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <table style="width: 100%;">
                                                            <tbody>
                                                                <tr>
                                                                    <td style="text-align: -webkit-center;">
                                                                        <table>
                                                                            <tbody>
                                                                                <tr>
                                                                                    <td style="text-align: -webkit-center;">
                                                                                        <table>
                                                                                            <tbody>
                                                                                                <tr>
                                                                                                    <td>
                                                                                                        <a href="https://www.facebook.com/sharer/sharer.php?u=https://dkpm.com" target="_blank"><img title="Facebook" src="cid:facebook" alt="Fb" width="32" height="32"></a>
                                                                                                    </td>
                                                                                                    <td>
                                                                                                        <a href="https://twitter.com/intent/tweet?url=https://dkpm.com" target="_blank"><img title="Twitter" src="cid:twitter" alt="Tw" width="32" height="32"></a>
                                                                                                    </td>
                                                                                                    <td>
                                                                                                        <a href="https://www.linkedin.com/sharing/share-offsite/?url=https://dkpm.com" target="_blank"><img title="Linkedin" src="cid:linkedin" alt="Yt" width="32" height="32"></a>
                                                                                                    </td>
                                                                                                    <td>
                                                                                                        <a href="https://www.pinterest.com/pin/create/link/?url=https://dkpm.com" target="_blank"><img title="Pinterest" src="cid:pinterest" alt="P" width="32" height="32"></a>
                                                                                                    </td>
                                                                                                </tr>
                                                                                            </tbody>
                                                                                        </table>
                                                                                    </td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <table align="center" style="margin-top:20px">
                            <tbody>
                                <tr>
                                    <td style="background-color: #f7f7f7;border-radius: 7px;padding: 10px;">
                                        <table style="width: 600px;">
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <table style="width: 100%;">
                                                            <tbody>
                                                                <tr>
                                                                    <td style="text-align: -webkit-center;">
                                                                        <table>
                                                                            <tbody>
                                                                                <tr>
                                                                                    <td style="text-align: -webkit-center;">
                                                                                        <span>If you have any problems, please contact <a href="mailto:customer-services@dkpm.com">cs@dkpm.com</a></span>
                                                                                    </td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <table align="center" style="margin-top:20px;">
                            <tbody>
                                <tr>
                                    <td>
                                        <table style="width: 600px;">
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <table>
                                                            <tbody>
                                                                <tr>
                                                                    <td style="text-align: -webkit-center;width: 560px;">
                                                                        <table style="width: 100%;">
                                                                            <tbody>
                                                                                <tr style="width: 100%;">
                                                                                    <td>
                                                                                        <div style="color: #fff;text-align: center;font-size: 20px;" id="slogan">- DO A <img src="cid:doorknock_text" width="150" style="vertical-align: top;" /> BEFORE ENTERING -</div>
                                                                                    </td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                        <table style="width: 100%;margin-top: 10px;">
                                                                            <tbody>
                                                                                <tr style="width: 100%;">
                                                                                    <td style="text-align: -webkit-center;">
                                                                                        <a href="#">
                                                                                            <img src="cid:doorknock_logo" alt width="200">
                                                                                        </a>
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td style="text-align: -webkit-center;color: #fff">
                                                                                        <p>dkpm.com © 2022</p>
                                                                                    </td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</body>
</html>';

try {
    $mail->isSMTP();                     
    $mail->SMTPAuth = true;
    $mail->SMTPSecure = "tls";
    $mail->SMTPOptions = array(
        'ssl' => array(
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true
        )
    );
    $mail->Port = 587;
    $mail->Host = 'smtp.gmail.com';
    $mail->Username = "20154953@learner.hkuspace.hku.hk";
    $mail->Password = "Cry174ways464";

    $mail->Charset = 'UTF-8';
    $mail->Priority = 1;
    $mail->setFrom('no_reply@dkpm.com','DoorKnock Password Manager');
    $mail->addAddress($user_email); 
    $mail->isHTML(true);
    $mail->Subject = 'Activate Account';
    $mail->Body = $body;
    $mail->AddEmbeddedImage("../images/facebook_email.png","facebook");
    $mail->AddEmbeddedImage("../images/twitter_email.png","twitter");
    $mail->AddEmbeddedImage("../images/pinterest_email.png","pinterest");
    $mail->AddEmbeddedImage("../images/linkedin_email.png","linkedin");
    $mail->AddEmbeddedImage("../images/doorknock.png","doorknock");
    $mail->AddEmbeddedImage("../images/doorknock_logo.png","doorknock_logo");
    $mail->AddEmbeddedImage("../images/doorknock_text.png","doorknock_text");
    $mail->AddEmbeddedImage("../images/paper_airplane.png","paper_airplane");
    $mail->Send();
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}

?>