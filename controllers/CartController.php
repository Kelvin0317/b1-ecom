<?php 
session_start();
require('../models/Model.php');

class CartController {
	public static function add_item() {
		$id = $_POST['id'];
		$quantity = $_POST['quantity'];

		if(!isset($_SESSION['cart'])){
			$_SESSION['cart'][$id] = $quantity;
		}else{
			$_SESSION['cart'][$id] += $quantity;
		}
	}

	public static function update() {
		$id = $_POST['id'];
		$quantity = $_POST['quantity'];
		$_SESSION['cart'][$id] = $quantity;
		header('Location:' . $_SERVER['HTTP_REFERER']);

	}

	public static function delete_cart_item() {
		$id = $_GET['id'];
		unset($_SESSION['cart'][$id]);
		header('Location:' . $_SERVER['HTTP_REFERER']);

	}

	public static function empty_cart() {
		unset($_SESSION['cart']);
		header('Location:' . $_SERVER['HTTP_REFERER']);

	}

	public static function checkout() {

		if(isset($_SESSION['cart'])) {
			$mysqli = new mysqli('localhost','root','','b1_ecom');
			$user_id = $_SESSION['user_details']['id'];
			$total = 0;

			$order_query = "INSERT INTO orders(user_id) VALUES ($user_id)";


			// Model::get_db($order_query);
			$mysqli->query($order_query);
			
			$order_id = $mysqli->insert_id;

			foreach($_SESSION['cart'] as $id => $quantity) {
				$item_query = "SELECT * FROM item WHERE id = $id";
				$item = mysqli_fetch_assoc(Model::get_db($item_query));
				$total += ($item['price'] * $quantity);

				$item_query = "SELECT * FROM item WHERE id = $id";
				$item = mysqli_fetch_assoc(Model::get_db($item_query));
				$item_order_query = "INSERT INTO item_order (item_id, order_id, quantity) VALUES ($id, $order_id, $quantity)";
				Model::get_db($item_order_query);
			}

		$update_order = "UPDATE orders SET total = $total WHERE id = $order_id";
		var_dump($update_order);
		Model::get_db($update_order);
		unset($_SESSION['cart']);
		header('Location: /');
		}
	}

	public static function paypal() {
		if(isset($_SESSION['cart'])) {
			$mysqli = new mysqli('localhost','root','','b1_ecom');
			$user_id = $_SESSION['user_details']['id'];
			$total = 0;

			$order_query = "INSERT INTO orders(user_id) VALUES ($user_id)";
			$mysqli->query($order_query);
			$order_id = $mysqli->insert_id;

			
			foreach($_SESSION['cart'] as $id => $quantity) {
				$item_query = "SELECT * FROM item WHERE id = $id";
				$item = mysqli_fetch_assoc(Model::get_db($item_query));
				$total += ($item['price'] * $quantity);

				$item_query = "SELECT * FROM item WHERE id = $id";
				$item = mysqli_fetch_assoc(Model::get_db($item_query));
				$item_order_query = "INSERT INTO item_order (item_id, order_id, quantity) VALUES ($id, $order_id, $quantity)";
				Model::get_db($item_order_query);
			}
			
		$update_order = "UPDATE orders SET total = $total, `isPaypal` = 1 WHERE id = $order_id";
		Model::get_db($update_order);
		unset($_SESSION['cart']);
		header('Location: /');
		}
	}
}

?>