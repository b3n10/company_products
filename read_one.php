<?php
$id  = isset($_GET['id']) ? $_GET['id'] : die("Access denied.<br><a href='http://" . $_SERVER['HTTP_HOST'] . "'>Go back</a>");

require_once("templates/_header.php");
require_once("config/database.php");
require_once("libs/functions.php");


try {
  $sql = "SELECT * FROM products WHERE id=:id";

  //use query for non-MySQL database
  $stmt = $pdo->query($sql);
  $stmt->bindParam(1, $id);
  $stmt->execute();

  $row = $stmt->fetch(PDO::FETCH_ASSOC);
  if ($row):
?>
  <div class="page-header">
    <h1>Read Products</h1>
  </div>
  <div class="data-rows">
    <table>
    <thead>
      <tr>
      <th>Name</th>
      <th>Description</th>
      <th>Price</th>
    </tr>
    </thead>
    <tbody>
      <?php
        echo "<td>" . htmlspecialchars($row['name']) . "</td>";
        echo "<td>" . htmlspecialchars($row['description']) . "</td>";
        echo "<td>" . htmlspecialchars($row['price']) . "</td>";
      ?>
    </tbody>
    </table>
    <a href="<?php echo 'http://' . $_SERVER['HTTP_HOST']; ?>">Back to home</a>
  </div>
<?php
  else:
    echo "<p>No record found.</p>";
    echo "<a href='http://" . $_SERVER['HTTP_HOST'] . "'>Back to home</a>";
  endif;
} catch (PDOException $e) {
  die("<h3>Error</h3>" . $e->getMessage());
}
?>
<?php
require_once("templates/_footer.php");
/*
  echo "<table>";
  echo "<thead>";
  echo "<tr>";
  echo "<th>Name</th>";
  echo "<th>Description</th>";
  echo "<th>Price</th>";
  echo "</tr>";
  echo "</thead>";
  echo "<tbody>";
  echo "</tbody>";
  echo "</table>";
 */
?>
