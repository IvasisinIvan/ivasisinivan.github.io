<?php

session_start();

$data['result']='error';


function validStringLength($string,$min,$max) {
  $length = mb_strlen($string,'UTF-8');
  if (($length<$min) || ($length>$max)) {
    return false;
  }
  else {
    return true;
  }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $data['result']='success';
    if (isset($_POST['name'])) {
      $name = $_POST['name'];
      if (!validStringLength($name,2,30)) {
        $data['name']='The name field contains an invalid character count.';   
        $data['result']='error';     
      }
    } else {
      $data['result']='error';
    } 
    if (isset($_POST['email'])) {
      $email = $_POST['email'];
      if (!filter_var($email,FILTER_VALIDATE_EMAIL)) {
        $data['email']='Email field entered incorrectly';
        $data['result']='error';
      }
    } else {
      $data['result']='error';
    }
    if (isset($_POST['message'])) {
      $message = $_POST['message'];
      if (!validStringLength($message,20,500)) {
        $data['message']='The message field contains an invalid character count.';     
        $data['result']='error';   
      }      
    } else {
      $data['result']='error';
    } 
    if (isset($_POST['captcha'])) {
      $captcha = $_POST['captcha'];
    } else {
      $data['result']='error';
    if ($data['result']=='success') {
      if ($_SESSION["code"] != $captcha) {

        $data['result']='invalidCaptcha';
      }
    }
  } else {

    $data['result']='error';
  }    
 
  if ($data['result']=='success') {

    $output = "---------------------------------" . "\n";
    $output .= date("d-m-Y H:i:s") . "\n";
    $output .= "Name: " . $name . "\n";
    $output .= "Email: " . $email . "\n";
    $output .= "Mesaj: " . $message . "\n";
    if (file_put_contents(dirname(__FILE__).'/message.txt', $output, FILE_APPEND | LOCK_EX)) {
      $data['result']='success';
    } else {
      $data['result']='error';         
    } 


    require_once dirname(__FILE__) . 'PHPMailerAutoload.php';

    $output = "Data: " . date("d-m-Y H:i") . "\n";
    $output .= "Name: " . $name . "\n";
    $output .= "Email: " . $email . "\n";
    $output .= "Mesaj: " . "\n" . $message . "\n";

    $mail = new PHPMailer;

    $mail->CharSet = 'UTF-8'; 
    $mail->From      = 'ivasisin.ivan@gmail.com';
    $mail->FromName  = 'Book';
    $mail->Subject   = 'Message from feedback';
    $mail->Body      = $output;
    $mail->AddAddress( 'ivasisin.ivan@gmail.com' );
    if ($mail->Send()) {
      $data['result']='success';
    } else {
      $data['result']='error';
    }      

  }

  echo json_encode($data);
?>