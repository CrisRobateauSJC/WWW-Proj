<?php
include 'includes/db_connect.php';
include 'includes/header.php';
include 'includes/nav.php';

// --- Handle quantity updates ---
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['add'])) {
        $item_id = (int) $_POST['item_id'];
        $quantity = (int) $_POST['quantity'];
    
        // Check if this item already exists in the cart
        $checkQuery = "SELECT cart_id, quantity FROM cart WHERE item_id = $item_id";
        $checkResult = $conn->query($checkQuery);
    
        if ($checkResult->num_rows > 0) {
            // Item exists: update the quantity
            $row = $checkResult->fetch_assoc();
            $newQty = $row['quantity'] + $quantity;
            $cart_id = $row['cart_id'];
    
            $conn->query("UPDATE cart SET quantity = $newQty WHERE cart_id = $cart_id");
        } else {
            // Item not in cart: insert new
            $conn->query("INSERT INTO cart (item_id, quantity) VALUES ($item_id, $quantity)");
        }
    
        // Redirect to avoid resubmitting the form on refresh
        header("Location: view-cart.php");
        exit;
    }
    if (isset($_POST['update'])) {
        $cart_id = (int) $_POST['cart_id'];
        $new_qty = (int) $_POST['quantity'];

        if ($new_qty > 0) {
            $conn->query("UPDATE cart SET quantity = $new_qty WHERE cart_id = $cart_id");
        } else {
            $conn->query("DELETE FROM cart WHERE cart_id = $cart_id");
        }
    } elseif (isset($_POST['remove'])) {
        $cart_id = (int) $_POST['cart_id'];
        $conn->query("DELETE FROM cart WHERE cart_id = $cart_id");
    }
}

// --- Fetch all cart items ---
$query = "SELECT cart.cart_id, cart.quantity, items.item_name, items.price 
          FROM cart 
          JOIN items ON cart.item_id = items.item_id";
$result = $conn->query($query);

// --- Calculate total ---
$total = 0;
?>

<main>
  <h2>Your Shopping Cart</h2>

  <?php if ($result->num_rows > 0): ?>
    <table>
  <thead>
    <tr>
      <th>Item</th>
      <th>Price</th>
      <th>Quantity</th>
      <th>Subtotal</th>
      <th>Actions</th> <!-- Matches 5 columns -->
    </tr>
  </thead>
  <tbody>
    <?php while ($row = $result->fetch_assoc()): 
      $subtotal = $row['price'] * $row['quantity'];
      $total += $subtotal;
    ?>
      <tr>
        <td><?php echo htmlspecialchars($row['item_name']); ?></td>
        <td>$<?php echo number_format($row['price'], 2); ?></td>
        <td>
          <form method="post" action="view-cart.php">
            <input type="hidden" name="cart_id" value="<?php echo $row['cart_id']; ?>">
            <input type="number" name="quantity" value="<?php echo $row['quantity']; ?>" min="1" required>
        </td>
        <td>$<?php echo number_format($subtotal, 2); ?></td>
        <td>
            <button type="submit" name="update">Update</button>
            <button type="submit" name="remove" class="remove-button">Remove</button>
          </form>
        </td>
      </tr>
    <?php endwhile; ?>
  </tbody>
</table>

    <h3>Total: $<?php echo number_format($total, 2); ?></h3>

  <?php else: ?>
    <p>Your cart is empty.</p>
  <?php endif; ?>
</main>

<?php 
include 'includes/footer.php';
$conn->close();
?>