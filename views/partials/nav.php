<?php session_start(); ?>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="#">Navbar</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
    <div class="navbar-nav">
      <a class="nav-link active" href="/">Home</a>
      <?php if(isset($_SESSION['user_details']) && $_SESSION['user_details']['isAdmin']): //if admin is loggedin ?>
      <a class="nav-link" href="/views/forms/add_item.php">Add Item</a>
      <a class="nav-link" href="/views/forms/transactions.php">Transactions</a>
      <a class="nav-link" href="/routes/logout.php">Logout</a>
      <?php elseif(isset($_SESSION['user_details']) && !$_SESSION['user_details']['isAdmin']): //if a normal user is loggedin ?>
      <a class="nav-link" href="/views/cart.php">Cart <span class="badge badge-info" id="cart_count">
        <?php if(isset($_SESSION['cart']) && count($_SESSION['cart'])): ?>
          <?php echo array_sum($_SESSION['cart']); ?>
        <?php else: ?>
          0
        <?php endif; ?>
      </span></a>
      <a class="nav-link" href="/views/forms/transactions.php">Transactions</a>
      <a class="nav-link" href="/routes/logout.php">Logout</a>
      <?php else: //else no one is loggedin?>
      <a class="nav-link" href="/views/forms/login.php">Login</a>
      <a class="nav-link" href="/views/forms/register.php">Register</a>
      <?php endif; ?>
    </div>
  </div>
</nav>