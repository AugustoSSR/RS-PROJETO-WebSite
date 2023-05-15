<?php

// Configurações do banco de dados
$host = '108.167.188.237';
$username = 'eletr258';
$password = 'THTBE1504lrlse!@#';
$dbName = 'eletr258_eletrictel';

// Conexão com o banco de dados
$conn = new mysqli($host, $username, $password, $dbName);

// Verifica se houve algum erro na conexão
if ($conn->connect_error) {
    die('Erro na conexão com o banco de dados: ' . $conn->connect_error);
}
