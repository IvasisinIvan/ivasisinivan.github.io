<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
        crossorigin="anonymous"></script>
    <title>Document</title>
</head>

<body>
    <div class="container-fluid">
        <nav>
            <header>
                <img id=logo src="HTML5-Logo.png" alt="logo">
            </header>

            <div class=menu>
                <a href="index.html">Products</a>
                <a href="contact.php">Contact</a>
                <a href="about.html">About</a>
            </div>
        </nav>

       
            
        <form action='contact.php' method="post">
            <p> Ваше имя: </p>
            <input type="text" name="fnm" value="">
            <p> Сообщение: </p>
            <textarea name="text"></textarea>
            <p> E-Mail: </p>
            <input type="text" name="email" value"">
            <p> Контактный телефон: </p>
            <input type="text" name="phone" value="">
            
           
            <input type="submit" value="отправить" name="Submit" onClick="return Formdata(this.form)">
            </form>

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
           


       
</body>

</html>