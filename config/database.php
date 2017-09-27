<?php

$dbName = "dev/company.db";

try {
  $pdo = new PDO("sqlite:" . $dbName); 
  $pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
} catch (PDOException $e) {
  die("Connection Error: " . $e->getMessage());
}
