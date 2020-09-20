<?php 
 wp_enqueue_media();
?>

<div class="row" style="margin-top:20px;">
	<div class="col-sm-12">
		<div class="panel panel-primary">
		  <div class="panel-heading">Create Book</div>
		  <div class="panel-body">
		  	<form class="form-horizontal" method="post" action="javascript:void(0)" id="frm-create-book">
			  <div class="form-group">
			    <label class="control-label col-sm-2" for="dd_book_shelf">Select Book Shelf:</label>
			    <div class="col-sm-4">
			      <select class="form-control" required="" name="dd_book_shelf">
			      	<option value="">Choose Shelf</option>
					  <?php 
					  	if(count($book_shelf) > 0){
							  foreach($book_shelf as $key=>$value){
								  ?>
									<option value="<?php echo $value->id?>" ><?php echo ucwords($value->shelf_name)?></option>
								  <?php
							  }
						  }
					  ?>
			      	
			      	
			      </select>
			    </div>
			  </div>
			  <div class="form-group">
			    <label class="control-label col-sm-2" for="txt_name">Name:</label>
			    <div class="col-sm-4">
			      <input type="text" required class="form-control" name="txt_name" id="txt_name" placeholder="Enter Name">
			    </div>
			  </div>
			  <div class="form-group">
			    <label class="control-label col-sm-2" for="txt_email">Email:</label>
			    <div class="col-sm-4">
			      <input type="email" required class="form-control" name="txt_email" id="txt_email" placeholder="Enter Email">
			    </div>
			  </div>
			  <div class="form-group">
			    <label class="control-label col-sm-2" for="txt_publication">Publication:</label>
			    <div class="col-sm-4">
			      <input type="text" class="form-control" name="txt_publication" id="txt_publication" placeholder="Enter Publication">
			    </div>
			  </div>
			  <div class="form-group">
			    <label class="control-label col-sm-2" for="text_description">Desciption:</label>
			    <div class="col-sm-4">
			      <textarea class="form-control" id="text_description" name="text_description" placeholder="Enter Desciption"></textarea>
			    </div>
			  </div>
			  <div class="form-group">
			    <label class="control-label col-sm-2" for="txt_image">Book Image:</label>
			    <div class="col-sm-4">
			      <input type="button" type="button" value="Upload Image"  class="form-control" name="txt_image" id="txt_image">
			      <img src="" style="height: 80px;width:80px" id="book_image" />
			      <input type="hidden" name="book_cover_image" id="book_cover_image" />
			    </div>
			  </div>
			  <div class="form-group">
			    <label class="control-label col-sm-2" for="txt_cost">Book Cost:</label>
			    <div class="col-sm-4">
			      <input type="number" required min="1" class="form-control" name="txt_cost" id="txt_cost" placeholder="Enter Book Cost">
			    </div>
			  </div>
			  <div class="form-group">
			    <label class="control-label col-sm-2" for="dd_status">Status:</label>
			    <div class="col-sm-4">
			      <select class="form-control" name="dd_status">
			      	<option value="1">Active</option>
			      	<option value="0">Inctive</option>
			      </select>
			    </div>
			  </div>
			 
			  <div class="form-group"> 
			    <div class="col-sm-offset-2 col-sm-4">
			      <button type="submit" class="btn btn-success">Submit</button>
			    </div>
			  </div>
			</form>
		  </div>
		</div>
	</div>
</div>