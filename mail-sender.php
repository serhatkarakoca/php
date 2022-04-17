<?php
include "config.php";
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;
// Gerekli dosyaları include ediyoruz
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/Exception.php';
require 'PHPMailer/SMTP.php';
$mail = new PHPMailer(true);

$code = rand(100000,1000000);


$userMail =$_POST["email"];

$stmp = mysqli_query($connect,"select * from users where email ='$userMail'");

class Result{
    
    public $result;
    public $tf;

}
$result = new Result();


$control = mysqli_fetch_assoc(mysqli_query($connect,"select * from users where email ='$userMail'"));

if(mysqli_num_rows($stmp)>0){  
$id =$control["id"];
$update = mysqli_query($connect,"UPDATE users SET code='$code' WHERE id='$id'");
try {
    //SMTP Sunucu Ayarları
    $mail->SMTPDebug = 0; // DEBUG Kapalı: 0, DEBUG Açık: 2
    $mail->isSMTP();
    $mail->Host       = 'mail.example.com'; // Email sunucu adresi.
    $mail->SMTPAuth   = true; // SMTP kullanici dogrulama kullan
    $mail->Username   = 'info@example.com'; // SMTP sunucuda tanimli email adresi
    $mail->Password   = '111'; // SMTP email sifresi
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // SSL icin `PHPMailer::ENCRYPTION_SMTPS` kullanin. SSL olmadan 587 portundan gönderim icin `PHPMailer::ENCRYPTION_STARTTLS` kullanin
    $mail->Port       = 587; // Eger yukaridaki deger `PHPMailer::ENCRYPTION_SMTPS` ise portu 465 olarak guncelleyin. Yoksa 587 olarak birakin
    $mail->setFrom('info@example.com', 'example'); // Gonderen bilgileri yukaridaki $mail->Username ile aynı deger olmali
    //Alici Ayarları
    $mail->addAddress("$userMail", 'example Kullanıcısı'); // Alıcı bilgileri
    //$mail->addAddress('ALICI2@domainadi.com'); // İkinci alıcı bilgileri
    //$mail->addReplyTo('YANITADRESI@domainadi.com'); // Alıcı'nın emaili yanıtladığında farklı adrese göndermesini istiyorsaniz aktif edin
    //$mail->addCC('CC@domainadi.com');
    //$mail->addBCC('BCC@domainadi.com');
    // Mail Ekleri
    //$mail->addAttachment('https://cdn.domainhizmetleri.com/var/tmp/file.tar.gz'); // Attachment ekleme
    //$mail->addAttachment('https://cdn.domainhizmetleri.com/tmp/image.jpg', 'new.jpg'); // Opsiyonel isim degistirerek Attachment ekleme
    // İçerik
    $mail->isHTML(true); // Gönderimi HTML türde olsun istiyorsaniz TRUE ayarlayin. Düz yazı (Plain Text) icin FALSE kullanin
    $mail->Subject = 'Verification Code';
    $mail->Body    = "Merhaba hesabınızın şifresini yenilemeniz için bu kodu gönderiyoruz.<b> Kod : $code </b>";
    $mail->send();
                $result->tf=true;
                $result->result="Kod gonderildi tamamlandi";
                echo(json_encode($result));
    
} catch (Exception $e) {
    echo "Ops! Email iletilemedi. Hata: {$mail->ErrorInfo}";
}
}
?>