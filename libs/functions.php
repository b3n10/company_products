<?php

function bindAndCheck($stmt, $placeHolder) {
  $stmt->bindParam( ':' . $placeHolder, htmlspecialchars(strip_tags($_POST[$placeHolder])) );
}
