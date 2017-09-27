<?php
require_once("templates/_header.php");
require_once("config/database.php");
require_once("libs/functions.php");

if ($_POST) {
  try {
    $stmt = $pdo->prepare("INSERT INTO products(name, description, price, created, modified) VALUES(:name, :description, :price, :created, :modified)");

    bindAndCheck($stmt, 'name');
    bindAndCheck($stmt, 'description');
    bindAndCheck($stmt, 'price');

    $stmt->bindParam(':created',
      date('Y-m-d H:i:s')
    );

    $stmt->bindParam(':modified',
      date('Y-m-d H:i:s')
    );

    if ($stmt->execute()) echo "<div>" . $stmt->rowCount(). " rows affected. Record was saved successfully.</div>";
    else echo "<div>Unable to save record.</div>";

  } catch (PDOException $e) {
    die("<h1>ERROR:</h1>" . $e->getMessage());
  }
}
?>
      <div class="page-header">
        <h1>Create Product</h1>
        <form action=<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?> method="post">
          <div>
            <label>Name:</label>
            <input type="text" name="name">
          </div>
          <div>
            <label>Description:</label>
            <textarea name="description"></textarea>
          </div>
          <div>
            <label>Price:</label>
            <input type="text" name="price">
          </div>
          <div>
            <button type="submit">Save</button>
            <a href="<?php echo 'http://' . $_SERVER['HTTP_HOST']; ?>">Back to home</a>
          </div>
        </form>
      </div>
<?php
require_once("templates/_footer.php");
?>
