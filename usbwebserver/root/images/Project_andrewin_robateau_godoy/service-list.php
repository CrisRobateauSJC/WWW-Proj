<?php 
include 'includes/db_connect.php';
include 'includes/header.php';
include 'includes/nav.php';

// Get the main category (textbooks, apparel, souvenirs)
$categoryName = $_GET['category'] ?? '';
$subcategory = $_GET['subcategory'] ?? '';
$min_price = $_GET['min_price'] ?? '';
$max_price = $_GET['max_price'] ?? '';

$categoryName = $conn->real_escape_string($categoryName);
$subcategory = $conn->real_escape_string($subcategory);

// Get the category_id
$categoryQuery = "SELECT category_id FROM categories WHERE category_name = '$categoryName'";
$categoryResult = $conn->query($categoryQuery);

if ($categoryResult->num_rows == 0) {
    header('Location: error.php');
    exit;
}

$categoryRow = $categoryResult->fetch_assoc();
$category_id = $categoryRow['category_id'];

// Build the dynamic SQL query
$itemQuery = "SELECT item_id, item_name, price, subcategory FROM items WHERE category_id = $category_id";

if (!empty($subcategory)) {
    $itemQuery .= " AND subcategory = '$subcategory'";
}

if (!empty($min_price) && !empty($max_price)) {
    $itemQuery .= " AND price BETWEEN $min_price AND $max_price";
}

$itemResult = $conn->query($itemQuery);
?>

<main>
  <h2><?php echo ucfirst($categoryName); ?> Available</h2>

  <!-- Filter Form -->
  <form method="get" action="service-list.php">
    <input type="hidden" name="category" value="<?php echo htmlspecialchars($categoryName); ?>">
    
    <label for="subcategory">Subcategory:</label>
    <input type="text" name="subcategory" id="subcategory" placeholder="e.g., Cup" value="<?php echo htmlspecialchars($subcategory); ?>">
    
    <label for="min_price">Min Price:</label>
    <input type="number" name="min_price" id="min_price" step="0.01" value="<?php echo htmlspecialchars($min_price); ?>">
    
    <label for="max_price">Max Price:</label>
    <input type="number" name="max_price" id="max_price" step="0.01" value="<?php echo htmlspecialchars($max_price); ?>">
    
    <button type="submit">Apply Filters</button>
  </form>

  <ul class="item-list">
    <?php if ($itemResult->num_rows > 0): ?>
      <?php while ($item = $itemResult->fetch_assoc()): ?>
        <li>
          <a href="item-details.php?id=<?php echo $item['item_id']; ?>">
            <?php echo htmlspecialchars($item['item_name']); ?> - $<?php echo number_format($item['price'], 2); ?>
          </a> 
          (<?php echo htmlspecialchars($item['subcategory']); ?>)
        </li>
      <?php endwhile; ?>
    <?php else: ?>
      <p>No items match your filters.</p>
    <?php endif; ?>
  </ul>
</main>

<?php 
include 'includes/footer.php';
$conn->close();
?>