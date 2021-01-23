@extends('admin_layout')

@section('admin_content')

<ul class="breadcrumb">
				<li>
					<i class="icon-home"></i>
					<a href="index.html">Dashboard</a>
					<i class="icon-angle-right"></i> 
				</li>
				<li>
					<i class="icon-edit"></i>
					<a href="#">Add Product</a>
				</li>
			</ul>
			                <p class="alert-success"><?php 
							$exception=Session::get('exception');
								if($exception){
								echo $exception;
								Session::put('exception', null);
								}
							?></p>
			<div class="row-fluid sortable">
				<div class="box span12">
					<div class="box-header" data-original-title>
						<h2><i class="halflings-icon edit"></i><span class="break"></span>Product Add Form</h2>
						<div class="box-icon">
							<a href="#" class="btn-setting"><i class="halflings-icon wrench"></i></a>
							<a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
							<a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
						</div>
					</div>

					<div class="box-content">
						<form class="form-horizontal" action="{{url('/save_product')}}" method="post" enctype="multipart/form-data">
                            {{ csrf_field() }}
						  <fieldset>
							<div class="control-group">
							  
							<div class="control-group">
							  <label class="control-label" for="date01">Product Name</label>
							  <div class="controls">
								<input type="text" class="input-xlarge" id="date01" name="product_name" required="">
							  </div>
							</div>

                            <div class="control-group">
								<label class="control-label" for="selectError3">Product Catagory</label>
								<div class="controls">
								  <select id="selectError3" name="catagory_id">
                                      <option>select catagory</option>
                                  <?php 
							 $all_published_catagory=DB::table('catagory_tbl')
													 ->where('publication_status', 1)
													 ->get();
					            foreach($all_published_catagory as $v_catagory) {?>

                                     <option value="{{$v_catagory->catagory_id}}">{{$v_catagory->catagory_name}}</option>

									<?php } ?>
									
								  </select>
								</div>
							  </div>

                            <div class="control-group">
								<label class="control-label" for="selectError3">Manufacture Name</label>
								<div class="controls">
								  <select id="selectError3" name="manufacture_id">
                                       <option>select manufacture</option>

                                  <?php 
							     $all_published_manufacture=DB::table('manufacture_tbl')
													 ->where('publication_status', 1)
													 ->get();
					            foreach($all_published_manufacture as $v_manufacture) {?>

<option value="{{$v_manufacture->manufacture_id}}">{{$v_manufacture->manufacture_name}}</option>

									<?php } ?>

								  </select>
								</div>
							</div>                              
         
							<div class="control-group hidden-phone">
							  <label class="control-label" for="textarea2">Product Short Description</label>
							  <div class="controls">
								<textarea class="cleditor" name="product_short_description" id="textarea2" rows="3" required=""></textarea>
							  </div>
                            </div>

                            <div class="control-group hidden-phone">
							  <label class="control-label" for="textarea2">Product Long Description</label>
							  <div class="controls">
								<textarea class="cleditor" name="product_long_description" id="textarea2" rows="3" required=""></textarea>
							  </div>
                            </div>

                            <div class="control-group">
							  <label class="control-label" for="date01">Product Price</label>
							  <div class="controls">
								<input type="text" class="input-xlarge" id="date01" name="product_price" required="">
							  </div>
							</div>

                            <div class="control-group">
								<label class="control-label">Product Image</label>
								<div class="controls">
								  <div class="uploader"><input type="file" name="product_image"><span class="filename" style="user-select: none;">No file selected</span><span class="action" style="user-select: none;">Choose File</span></div>
								</div>
							  </div>

                            <div class="control-group">
							  <label class="control-label" for="date01">Product Size</label>
							  <div class="controls">
								<input type="text" class="input-xlarge" id="date01" name="product_size" required="">
							  </div>
							</div>

                            <div class="control-group">
							  <label class="control-label" for="date01">Product Color</label>
							  <div class="controls">
								<input type="text" class="input-xlarge" id="date01" name="product_color" required="">
							  </div>
							</div>

                            <div class="control-group hidden-phone">
							  <label class="control-label" for="textarea2">Pablication status</label>
							  <div class="controls">
                              <input type="checkbox" name="publication_status" value="1" >
							  </div>
                            </div>
                            
							<div class="form-actions">
							  <button type="submit" class="btn btn-primary">Add Product</button>
							  <button type="reset" class="btn">Cancel</button>
							</div>
						  </fieldset>
						</form>   

					</div>
				</div><!--/span-->

			</div><!--/row-->

@endsection