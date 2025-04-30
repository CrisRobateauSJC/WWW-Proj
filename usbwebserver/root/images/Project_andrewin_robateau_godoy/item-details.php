<?php 
include 'includes/db_connect.php';
include 'includes/header.php';
include 'includes/nav.php';

// Get the item ID from the URL
$item_id = $_GET['id'] ?? '';

if (!is_numeric($item_id)) {
    header('Location: error.php');
    exit;
}

// Fetch the item details from the database
$itemQuery = "SELECT items.item_name, items.brand, items.price, items.description, items.quantity, categories.category_name AS category
              FROM items
              JOIN categories ON items.category_id = categories.category_id
              WHERE item_id = $item_id";
$itemResult = $conn->query($itemQuery);

if ($itemResult->num_rows == 0) {
    // No item found
    header('Location: error.php');
    exit;
}

$item = $itemResult->fetch_assoc();
?>

<main>
  <section class="item-details">
    <h2><?php echo htmlspecialchars($item['item_name']); ?></h2>
    <p><strong>Brand:</strong> <?php echo htmlspecialchars($item['brand'] ?? 'N/A'); ?></p>
    <p><strong>Category:</strong> <?php echo htmlspecialchars(ucfirst($item['category'])); ?></p>
    <p><strong>Price:</strong> $<?php echo number_format($item['price'], 2); ?></p>
    <p><strong>Description:</strong> <?php echo nl2br(htmlspecialchars($item['description'])); ?></p>
    <p><strong>In Stock:</strong> <?php echo $item['quantity']; ?> available</p>

    <?php if ($item['quantity'] > 0): ?>
      <form action="view-cart.php" method="post" class="add-to-cart-form">
        <input type="hidden" name="item_id" value="<?php echo $item_id; ?>">
        <label for="quantity">Quantity:</label>
        <input type="number" name="quantity" id="quantity" value="1" min="1" max="<?php echo $item['quantity']; ?>" required>
        <button type="submit" name="add">Add to Cart</button>
      </form>
    <?php else: ?>
      <p style="color: red;"><strong>Out of Stock</strong></p>
    <?php endif; ?>
  </section>
</main>

<?php 
include 'includes/footer.php';
$conn->close();
?>