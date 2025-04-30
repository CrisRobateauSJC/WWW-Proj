<?php 
include 'includes/db_connect.php';
include 'includes/header.php';
include 'includes/nav.php';

// Initialize variables
$searchResults = [];
$searchPerformed = false;

// Check if a search is happening
if (isset($_GET['q']) && !empty(trim($_GET['q']))) {
    // Search from the header search box
    $searchTerm = $conn->real_escape_string(trim($_GET['q']));
    $query = "SELECT item_id, item_name, price FROM items 
              WHERE item_name LIKE '%$searchTerm%' OR brand LIKE '%$searchTerm%' OR description LIKE '%$searchTerm%' OR subcategory LIKE'%$searchTerm%'";
    $result = $conn->query($query);
    $searchPerformed = true;
} elseif (isset($_GET['category']) || isset($_GET['brand']) || isset($_GET['min_price']) || isset($_GET['max_price'])) {
    // Search from the search form
    $conditions = [];

    if (!empty($_GET['category'])) {
        $category = $conn->real_escape_string($_GET['category']);
        $conditions[] = "subcategory = '$category'";
    }

    if (!empty($_GET['brand'])) {
        $brand = $conn->real_escape_string($_GET['brand']);
        $conditions[] = "brand LIKE '%$brand%'";
    }

    if (!empty($_GET['min_price']) && !empty($_GET['max_price'])) {
        $min_price = (float) $_GET['min_price'];
        $max_price = (float) $_GET['max_price'];
        $conditions[] = "price BETWEEN $min_price AND $max_price";
    }

    if (!empty($conditions)) {
        $whereClause = implode(' AND ', $conditions);
        $query = "SELECT item_id, item_name, price FROM items WHERE $whereClause";
        $result = $conn->query($query);
        $searchPerformed = true;
    }
}
?>

<main>
  <h2>Search for Items</h2>

  <!-- Search Form -->
  <form method="get" action="search-item.php">
    <label for="category">Subcategory:</label>
    <input type="text" name="category" id="category" placeholder="e.g., Cup">

    <label for="brand">Brand:</label>
    <input type="text" name="brand" id="brand" placeholder="e.g., SJC Apparel">

    <label for="min_price">Min Price:</label>
    <input type="number" name="min_price" step="0.01">

    <label for="max_price">Max Price:</label>
    <input type="number" name="max_price" step="0.01">

    <button type="submit">Search</button>
  </form>

  <?php if ($searchPerformed): ?>
    <h3>Search Results:</h3>
    <?php if (isset($result) && $result->num_rows > 0): ?>
      <ul class="item-list">
        <?php while ($item = $result->fetch_assoc()): ?>
          <li>
            <a href="item-details.php?id=<?php echo $item['item_id']; ?>">
              <?php echo htmlspecialchars($item['item_name']); ?> - $<?php echo number_format($item['price'], 2); ?>
            </a>
          </li>
        <?php endwhile; ?>
      </ul>
    <?php else: ?>
      <p>No items matched your search.</p>
    <?php endif; ?>
  <?php endif; ?>
</main>

<?php 
include 'includes/footer.php';
$conn->close();
?>