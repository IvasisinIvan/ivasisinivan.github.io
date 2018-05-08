<?php
if(@$_POST["hidden"])
{
$dt=date("d F Y, H:i:s"); // дата и время
$mail="ivasisin.ivan@gmail.com"; // e-mail куда уйдет письмо
$title="bbbbbbbbbb"; // заголовок(тема) письма
$fnm=$_POST["fnm"];
$fnm=htmlspecialchars($fnm); // обрабатываем

$text=$_POST["text"];
$text=htmlspecialchars($text); // обрабатываем
$text=str_replace("\r\n","<br>",$text); // обрабатываем

$email=$_POST["email"];
$phone=$_POST["phone"];

$mess="<b>Имя:</b> $fnm<br>";
$mess.="<b>Сообщение:</b> $text<br>";
// ссылка на e-mail
$mess.="<b>E-Mail:</b> <a href='mailto:$email'>$email</a><br>";
$mess.="<b>Телефон:</b> $phone<br>";
$mess.="<b>Дата и Время:</b> $dt";

$headers="MIME-Version: 1.0\r\n";
$headers.="Content-type: text/html; charset=windows-1251\r\n"; //кодировка

mail($mail, $title, $mess, $headers); // отправляем

// выводим уведомление и перезагружаем страничку


}
?>