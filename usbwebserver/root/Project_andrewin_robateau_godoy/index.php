<?php // index.php (Home Page)
include 'includes/header.php';
include 'includes/nav.php';
?>
<!--
<!DOCTYPE html>
<head>
    <link rel="stylesheet" href="style.css">
    <script src="js/script.js"></script>
</head>
-->
<main>
  <section class="hero">
    <h1>Welcome to SJC Book Haven</h1>
    <p>Your one-stop shop for textbooks, SJC apparel, and souvenirs.</p>
  </section>
  <section class="services">
    <h2>Our Services</h2>
    <ul>
      <li><a href="service-list.php?category=textbooks">Textbook Rentals & Purchases</a></li>
      <li><a href="service-list.php?category=apparel">SJC Apparel</a></li>
      <li><a href="service-list.php?category=souvenirs">Souvenirs</a></li>
    </ul>
  </section>
</main>

<?php include 'includes/footer.php'; ?>

<!-- CSS in css/style.css -->
<!-- JS in js/script.js -->