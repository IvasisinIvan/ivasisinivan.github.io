<?
$name=$_POST['name'];
$subject=$_POST['theme'];
$e_mail=$_POST['e_mail'];
$headers=$_POST['headers'];
$message=$_POST['message'];
/* Адрес получателя*/
$toMail = 'ivasisin.ivan@gmail.com';
$headers  = "From: $name <$e_mail> \n";
    mail ("$toMail", "$subject", 
"\nИмя : $name
E-mail : $e_mail
Тема сообщения : $subject
Подробнее : $message\n\n", "$headers");
?>