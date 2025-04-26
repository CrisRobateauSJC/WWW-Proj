<?php 
include 'includes/header.php';
include 'includes/nav.php';

// Define fake data for now (this would later come from a database)
$items = [
    'textbooks' => [
        ['id' => 1, 'name' => 'Intro to Computer Science', 'price' => '$59.99'],
        ['id' => 2, 'name' => 'Advanced Mathematics', 'price' => '$75.50'],
    ],
    'apparel' => [
        ['id' => 3, 'name' => 'SJC Hoodie', 'price' => '$39.99'],
        ['id' => 4, 'name' => 'SJC Baseball Cap', 'price' => '$19.99'],
    ],
    'souvenirs' => [
        ['id' => 5, 'name' => 'SJC Coffee Mug', 'price' => '$12.99'],
        ['id' => 6, 'name' => 'SJC Keychain', 'price' => '$5.99'],
    ]
];

// Read category from URL (e.g., ?category=textbooks)
$category = $_GET['category'] ?? '';

// Check if the category exists
if (!array_key_exists($category, $items)) {
    header('Location: error.php');
    exit;
}

?>

<main>
  <h2><?php echo ucfirst($category); ?> Available</h2>
  <ul class="item-list">
    <?php foreach ($items[$category] as $item): ?>
      <li>
        <a href="item-details.php?id=<?php echo $item['id']; ?>">
          <?php echo htmlspecialchars($item['name']); ?> - <?php echo $item['price']; ?>
        </a>
      </li>
    <?php endforeach; ?>
  </ul>
</main>

<?php include 'includes/footer.php'; ?>