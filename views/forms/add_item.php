<?php
$title = "Add Item";
function get_content(){
	require '../../middleware/auth.php';
	require_once('../../models/Model.php');	
	$query = "SELECT * FROM categories";
	$categories = Model::get_db($query);	
	?>
	<form class="col-md-6 mx-auto py-5" method="POST" action="/routes/add_item.php" enctype="multipart/form-data">
		<div class="form-group">
			<label>Name</label>
			<input type="text" name="product_name" class="form-control">
		</div>
		<div class="form-group">
			<label>Price</label>
			<input type="number" name="price" class="form-control">
		</div>
		<div class="form-group">
			<label>Description</label>
			<textarea name="description" rows="3" class="form-control" placeholder="Enter your description here..."></textarea>
		</div>
		<div class="form-group">
			<label>Image</label>
			<input type="file" name="image" class="form-control">
		</div>
		<div class="form-group">
			<select class="form-control" name="category_id">
				<?php foreach($categories as $category): ?>
					<option value="<?php echo $category['id'] ?>"><?php echo $category['name'] ?></option>
				<?php endforeach ?>
			</select>
		</div>
		<button class="btn btn-success">Submit</button>
	</form>
	<?php } require '../layout.php' ?>