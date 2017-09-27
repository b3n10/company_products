<?php
$id  = isset($_GET['id']) ? $_GET['id'] : die("Access denied.<br><a href='http://" . $_SERVER['HTTP_HOST'] . "'>Go back</a>");

require_once("templates/_header.php");
require_once("config/database.php");
require_once("libs/functions.php");

if ($_POST) {
  try {
    $sql = "UPDATE products SET name=:name, description=:description, price=:price, modified=:modified WHERE id={$id}";
    $stmt = $pdo->prepare($sql);

    bindAndCheck($stmt, 'name');
    bindAndCheck($stmt, 'description');
    bindAndCheck($stmt, 'price');

    $stmt->bindParam(':modified',
      date('Y-m-d H:i:s')
    );

    if ($stmt->execute()) echo "<div>Record was updated successfully.</div>";
    else echo "<div>Unable to save record.</div>";
  } catch (PDOException $e) {
    die("<h3>Error</h3>" . $e->getMessage());
  }
}


try {
  $sql = "SELECT * FROM products WHERE id={$id}";

  //use query for non-MySQL database
  $stmt = $pdo->query($sql);
  $stmt->execute();

  $row = $stmt->fetch(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
  die("<h3>Error</h3>" . $e->getMessage());
}

  //check if query returned rows
  if ($row):
?>
  <div class="page-header">
    <h1>Update Products</h1>
  </div>
  <div class="data-rows">
  <form action="<?php echo $_SERVER['PHP_SELF'] . "?id={$id}"; ?>" method="post">
    <div>
      <label>Name:</label>
      <input type="text" name="name" value="<?php echo htmlspecialchars($row['name'], ENT_QUOTES); ?>">
    </div>
    <div>
      <label>Description:</label>
      <textarea name="description"><?php echo htmlspecialchars($row['description'], ENT_QUOTES); ?></textarea>
    </div>
    <div>
      <label>Price:</label>
      <input type="text" name="price" value="<?php echo htmlspecialchars($row['price'], ENT_QUOTES); ?>">
    </div>
    <div>
      <button type="submit">Update</button>
      <a href="<?php echo 'http://' . $_SERVER['HTTP_HOST']; ?>">Back to home</a>
    </div>
  </form>
  </div>
<?php
  else:
    echo "<p>No record found.</p>";
    echo "<a href='http://" . $_SERVER['HTTP_HOST'] . "'>Back to home</a>";
  endif;

require_once("templates/_footer.php");
?>
