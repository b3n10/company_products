<?php
date_default_timezone_set('Asia/Manila');

function bindAndCheck($stmt, $placeHolder) {
  $stmt->bindParam( ':' . $placeHolder, htmlspecialchars(strip_tags($_POST[$placeHolder])) );
}
