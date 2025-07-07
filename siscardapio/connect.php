<?php 

define('HOST', '127.0.0.1');
define('USUARIO', 'root');
define('SENHA', 'sis@prod2025');
define('DB', 'siscardapio');

$connect_db = mysqli_connect(HOST, USUARIO, SENHA, DB) or die ('Não foi possível conectar ao DB.');

$connect_db->set_charset("utf8mb4");

?>