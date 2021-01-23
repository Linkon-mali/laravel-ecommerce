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
						<form class="form-horizontal" action="{{url('/save_slider')}}" method="post" enctype="multipart/form-data">
                            {{ csrf_field() }}
						  <fieldset>                    

                            <div class="control-group">
								<label class="control-label">Slider Image</label>
								<div class="controls">
								  <div class="uploader"><input type="file" name="slider_image" required=""><span class="filename" style="user-select: none;">No file selected</span><span class="action" style="user-select: none;">Choose File</span></div>
								</div>
							  </div>

                            <div class="control-group hidden-phone">
							  <label class="control-label" for="textarea2">Pablication status</label>
							  <div class="controls">
                              <input type="checkbox" name="publication_status" value="1" required="">
							  </div>
                            </div>
                            
							<div class="form-actions">
							  <button type="submit" class="btn btn-primary">Add Slider</button>
							  <button type="reset" class="btn">Cancel</button>
							</div>
						  </fieldset>
						</form>   

					</div>
				</div><!--/span-->

			</div><!--/row-->

@endsection