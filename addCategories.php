<?php


include("config.php");


$query=mysqli_query($connect,"INSERT INTO `categories` (`id`, `pid`, `categoryName`) VALUES
	(1, 0, 'Bilgisayar'),
	(2, 1, 'Dizüstü Bilgisayarlar'),
	(3, 1, 'Masaüstü Bilgisayarlar'),
	(4, 1, 'Oyun Bilgisayarları'),
    (5, 1, 'Tablet'),
    (6, 1, 'Çevre Birimleri'),
    (7, 1, 'Aksesuarlar'),
    (8, 1, 'Monitör'),
    (9, 1, 'Sunucu (Server)'),
    (10, 1, 'Yazılım'),
    (11, 2, 'Acer'),
    (12, 2, 'Aidata'),
    (13, 2, 'Alienware'),
    (14, 2, 'Apple MacBook'),
    (15, 2, 'Arçelik'),
    (16, 2, 'Asus'),
    (17, 2, 'Beko'),
    (18, 2, 'BenQ'),
    (19, 2, 'Casper'),
    (20, 2, 'Dell'),
    (21, 2, 'Exper'),
    (22, 2, 'Fujitsu'),
    (23, 2, 'Google'),
    (24, 2, 'Grundig'),
    (25, 2, 'HP'),
    (26, 2, 'Hometech'),
    (27, 2, 'Huawei'),
    (28, 2, 'IBM'),
    (29, 2, 'Lenovo'),
    (30, 2, 'LG'),
    (31, 2, 'Microsoft'),
    (32, 2, 'Monster'),
    (33, 2, 'MSI'),
    (34, 2, 'Samsung'),
    (35, 2, 'Smartbook'),
    (36, 2, 'Sony'),
    (37, 2, 'Toshiba'),
    (38, 2, 'Vestel'),
    (39, 2, 'Xiaomi'),
    (40, 2, 'Diğer'),
    (41, 0, 'Cep Telefonları'),
    (42, 41, 'Apple'),
    (43, 41, 'Samsung')");
    
    if($query){
           echo("eklendi");
    }
    else{
        echo("eklenemedi");
    }



?>