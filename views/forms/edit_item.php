<?php
	$title = "Edit Item";
	function get_content(){
	require_once('../../models/Model.php');	
	$id = $_GET['id'];
	$query = "SELECT * FROM item WHERE id = $id" ;
	$item = mysqli_fetch_assoc(Model::get_db($query));
	$query_categories = "SELECT * FROM categories";
	$categories = Model::get_db($query_categories);

	?>

	<form class="col-md-6 mx-auto py-5" method="POST" action="/routes/edit_item.php?id=<?php echo $id ?>" enctype="multipart/form-data">
		<div class="form-group">
			<label>Name</label>
			<input type="text" value="<?php  echo $item['name'] ?>" name="product_name" class="form-control">
		</div>
		<div class="form-group">
			<label>Price</label>
			<input type="text" value="<?php  echo $item['price'] ?>" name="price" class="form-control">
		</div>
		<div class="form-group">
			<label>Description</label>
			<textarea name="description"  rows="3" class="form-control"><?php  echo $item['description'] ?></textarea>
		</div>
		<div class="form-group">
			<label>Image</label>
			<input type="file" name="image" class="form-control">
		</div>
		<div class="form-group">
			<select class="form-control" name="category_id">
				<?php foreach($categories as $category): ?>
					<?php if($category['id'] == $item['category_id']): ?>
						<option selected value="<?php echo $category['id'] ?>"><?php echo $category['name'] ?></option>
					<?php else: ?>
						<option value="<?php echo $category['id'] ?>"><?php echo $category['name'] ?></option>
					<?php endif ?>
				<?php endforeach ?>
			</select>
		</div>
		<button class="form-control mt-2 btn btn-success">Submit</button>
	</form>
	<?php } require '../layout.php' ?>