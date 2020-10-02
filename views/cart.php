<?php
	$title = 'Cart';
	function get_content() {
	require('../models/Model.php');
	if(isset($_SESSION['cart']) && count($_SESSION['cart'])):
?>
<div class="container py-5">
	<table class="table table-hover">
		<thead class="thead-light">
			<tr>
				<th>Name</th>
				<th>Price</th>
				<th>Quantity</th>
				<th>Subtotal</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			<?php
				$total = 0;
				foreach ($_SESSION['cart'] as $id => $quantity):
				$query = "SELECT * FROM item WHERE id = $id";
				$item = mysqli_fetch_assoc(Model::get_db($query));
				$subtotal = $item['price'] * $quantity;
				$total += $subtotal;
			?>
			<tr>
				<td><?php echo $item['name']; ?></td>
				<td><?php echo $item['price']; ?></td>
				<td>
					<form method="POST" action="/routes/update_cart.php">
						<input type="hidden" name="id" value="<?php echo $item['id']; ?>">
						<input type="number" name="quantity" value="<?php echo $quantity; ?>" class='form-control quantity_input' min='1'>
					</form>
				</td>
				<td><?php echo $subtotal; ?></td>
				<td>
					<a href="../routes/delete_cart_item.php?id=<?php echo $id ?>" class="btn btn-danger">Delete</a>
				</td>
			</tr>
			<?php endforeach; ?>
			<tr>
				<td><a href="../routes/empty_cart.php" class="btn btn-danger">Empty Cart</a></td>
				<td>
					<button class="btn btn-success" data-toggle='modal' data-target='#checkout_modal'>Checkout</button>
					<div class="modal fade" id="checkout_modal">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title">Confirm Checkout</h5>
								</div>
								<div class="modal-body">
									<p>Are you sure about your order?</p>
								</div>
								<div class="modal-footer">
									<button class="btn btn-secondary" data-dismiss='modal'>Close</button>
									<a href="/routes/checkout.php" class="btn btn-success">Checkout</a>
								</div>
							</div>
						</div>
					</div>
				</td>
				<td id="paypal-button-container">
				</td>
				<td>Total: MYR <?php echo number_format($total, 2); ?></td>
			</tr>
		</tbody>
	</table>
	<script src="https://www.paypal.com/sdk/js?client-id=ATxonj8O_Cz4_V3LAbExsioHFQ7lKEeA-_imZadJuGnv-bWpcaf88AxuODfSZxWUGJWNVOHyjIDQAcFl"></script>
	<script>
	paypal.Buttons({
		createOrder: function(data, actions) {
			return actions.order.create({
				purchase_units: [{
					amount: {
						value: <?php echo $total; ?>
					}
				}]
			})
		},
		onApprove: function(data, actions) {
			return actions.order.capture().then(function(details) {
				window.location.replace("/routes/paypal.php");			
			})
		}
	}).render('#paypal-button-container');
	</script>
	<script type="text/javascript">
		let quantityInputs = document.querySelectorAll('.quantity_input');
		quantityInputs.forEach( input => {
			input.addEventListener('change', () => {
				input.parentElement.submimt();
			})
		})
	</script>
	<?php else: ?>
	<div class="bg-dark py-3 text-center text-white"><h2>You cart is empty</h2></div>
</div>
<?php
	endif;
	}
	require './layout.php';
?>