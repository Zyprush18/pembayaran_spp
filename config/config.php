<?php

require './vendor/autoload.php';

$dotenv = new Symfony\Component\Dotenv\Dotenv();
$dotenv->load('./.env');

$host = $_ENV['DB_HOST'];
$port =$_ENV['DB_PORT'];
$username = $_ENV['DB_USERNAME'];
$password = $_ENV['DB_PASSWORD'];
$db_name = $_ENV['DB_DATABASE'];