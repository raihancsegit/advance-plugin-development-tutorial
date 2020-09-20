<div class="row" style="margin-top:20px;">
	<div class="col-sm-12">
		<div class="panel panel-primary">
		  <div class="panel-heading">List Book</div>
		  <div class="panel-body">
		  	<table id="tbl-list-book" class="display" style="width:100%">
        <thead> 
            <tr>
                <th>#ID</th>
                <th>Name</th>
                <th>Shelf Name</th>
                <th>Email</th>
                <th>Publication</th>
                <th>Book Image</th>
                <th>Amount</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            if(count($books_data) > 0){

                foreach ($books_data as $key => $value) {
                   ?>
                   <tr>
                       <td><?php echo $value->id; ?></td>
                       <td><?php echo strtoupper($value->name); ?></td>
                       <td><?php echo !empty($value->shelf_name) ? $value->shelf_name : "<i>No Shelf</i>"; ?></td>
                       <td><?php echo $value->email; ?></td>
                       <td><?php echo !empty($value->publication) ? $value->publication : "<i>No Publication</i>"; ?></td>
                       <td>
                        <?php
                        if(!empty($value->book_image)){
                            ?>
                            <img src="<?php echo $value->book_image; ?>" style="height: 50px;width: 50px;"/>
                            <?php
                        }else{
                            echo "<i>No Image</i>";
                        }
                        ?>
                        
                       </td>
                       <td><?php echo $value->amount; ?></td>
                       <td><?php echo $value->status == 1 ? "<button class='btn btn-success'>Active</button>" : "<button class='btn btn-danger'>Inactive</button>"; ?></td>
                       <td>
                           <button class="btn btn-danger btn-delete-book" data-id="<?php echo $value->id; ?>">Delete</button>
                       </td>
                   </tr>
                   <?php
                }
            }
            ?>
        </tbody>
        <tfoot>
            <tr>
                <th>#ID</th>
                <th>Name</th>
                <th>Shelf Name</th>
                <th>Email</th>
                <th>Publication</th>
                <th>Book Image</th>
                <th>Amount</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </tfoot>
    </table>
		  </div>
		</div>
	</div>
</div>