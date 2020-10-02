<?php 
	$title = "Cart";
	function get_content(){
	require('../../models/Model.php');

	$query_order = "SELECT * FROM item_order";
	$items_order = Model::get_db($query_order);

	$query = "SELECT * FROM orders";
	$orders =  Model::get_db($query);
?>

<div class="container mt-5">	
<?php if($_SESSION['user_details']['isAdmin'] == 1): ?>	
	<?php foreach ($orders as $item): ?>
			<h6><?php echo "ORDER #". $item['id'] ."  ". $item['date_purchassed']?></h6>
			<table class="table border table-hover">
				<thead char="thead-dark">
					<tr>
						<th>Name</th>
						<th>Price</th>
						<th>Quantity</th>
						<th>Subtotal</th>
						<th></th>
					</tr>
				</thead>
				<?php foreach ($items_order as $order): ?>
					<?php 
						$hi = $order['item_id'];
						$query_item = "SELECT * FROM item WHERE id = $hi" ;
						$item_name = mysqli_fetch_assoc(Model::get_db($query_item));
					?>
					<?php if($order['order_id'] == $item['id']): ?>
						<tbody>
							<tr class="border-bottom">
								<td><?php echo $item_name['name'] ?></td>
								<td><?php echo $item_name['price'] ?></td>
								<td><?php echo $order["quantity"] ?></td>
								<td><?php echo $item_name['price'] * $order["quantity"]; ?></td>
								<td></td>
							</tr>
						</tbody>
					<?php endif; ?>
				<?php endforeach; ?>
					<tbody>
						<tr>
							<td></td>
							<td></td>
							<td></td>
							<td><?php echo $item['total'] ?></td>
							<td></td>
						</tr>
					</tbody>
			</table>
	<?php endforeach; ?>
<?php else: ?>
	<?php foreach ($orders as $item): ?>
		<?php $error = 0; ?>
		<?php if($item['user_id'] == $_SESSION['user_details']['id']): ?>
			<h6><?php echo "ORDER #". $item['id'] ."  ". $item['date_purchassed']?></h6>
			<table class="table border table-hover">
				<thead char="thead-dark">
					<tr>
						<th>Name</th>
						<th>Price</th>
						<th>Quantity</th>
						<th>Subtotal</th>
						<th></th>
					</tr>
				</thead>
				<?php foreach ($items_order as $order): ?>
					<?php 
						$hi = $order['item_id'];
						$query_item = "SELECT * FROM item WHERE id = $hi" ;
						$item_name = mysqli_fetch_assoc(Model::get_db($query_item));
					?>
					<?php if($order['order_id'] == $item['id']): ?>
						<tbody>
							<tr class="border-bottom">
								<td><?php echo $item_name['name'] ?></td>
								<td><?php echo $item_name['price'] ?></td>
								<td><?php echo $order["quantity"] ?></td>
								<td><?php echo $item_name['price'] * $order["quantity"]; ?></td>
								<td></td>
							</tr>
						</tbody>
					<?php endif; ?>
				<?php endforeach; ?>
					<tbody>
						<tr>
							<td></td>
							<td></td>
							<td></td>
							<td><?php echo $item['total'] ?></td>
							<td></td>
						</tr>
					</tbody>
			</table>
		<?php else: ?>
			<?php $error = 1; ?>
		<?php endif; ?>
	<?php endforeach; ?>
	<?php if($error == 1): ?>
		<h1 class="text-center my-5">No Orders</h1>
	<?php endif; ?>
<?php endif; ?>
</div>
<?php 
	}
	require '../layout.php';
?>