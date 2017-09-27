<?php
require_once("templates/_header.php");
require_once("config/database.php");
require_once("libs/functions.php");

//use query for non-MySQL database
$sql = "SELECT * FROM products ORDER BY id ASC";
$stmt = $pdo->query($sql);
echo "<br><a href='create.php' class='btn'>Create New Product</a>";

?>
      <div class="page-header">
        <h1>Read Products</h1>
      </div>
      <div class="data-rows">
        <table>
          <thead>
            <tr>
              <th>ID</th>
              <th>Name</th>
              <th>Description</th>
              <th>Price</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php 
              while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                extract($row);
                echo "<tr>";
                echo "<td>{$id}</td>";
                echo "<td>{$name}</td>";
                echo "<td>{$description}</td>";
                echo "<td>{$price}</td>";
                echo "<td>";
                echo "<a href='read_one.php?id={$id}'>" . Read . "</a>";
                echo "<a href='update.php?id={$id}'>" . Edit . "</a>";
                echo "<a href='#' onClick='delete_user({$id});'>" . Delete . "</a>";
                echo "</td>";
                echo "</tr>";
              }
            ?>
          </tbody>
        </table>
        <?php if (!$pdo->query($sql)->fetchColumn()): ?>
          <div>No records found.</div>
        <?php endif; ?>
      </div>
<?php
require_once("templates/_footer.php");
?>
