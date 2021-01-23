@extends('admin_layout')

@section('admin_content')
			
			<ul class="breadcrumb">
				<li>
					<i class="icon-home"></i>
					<a href="index.html">Home</a> 
					<i class="icon-angle-right"></i>
				</li>
				<li><a href="#">Tables</a></li>
			</ul>

			<p class="alert-success"><?php 
						 $exception=Session::get('exception');
							if($exception){
							echo $exception;
							Session::put('exception', null);
							}
						?></p>

			<div class="row-fluid sortable ui-sortable">		
				<div class="box span12">
					<div class="box-header" data-original-title="">
						<h2><i class="halflings-icon user"></i><span class="break"></span>Members</h2>
						<div class="box-icon">
							<a href="#" class="btn-setting"><i class="halflings-icon wrench"></i></a>
							<a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
							<a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
						</div>
					</div>
					<div class="box-content">
						<div id="DataTables_Table_0_wrapper" class="dataTables_wrapper" role="grid"><div class="row-fluid"><div class="span6"><div id="DataTables_Table_0_length" class="dataTables_length"><label><select size="1" name="DataTables_Table_0_length" aria-controls="DataTables_Table_0"><option value="10" selected="selected">10</option><option value="25">25</option><option value="50">50</option><option value="100">100</option></select> records per page</label></div></div><div class="span6"><div class="dataTables_filter" id="DataTables_Table_0_filter"><label>Search: <input type="text" aria-controls="DataTables_Table_0"></label></div></div></div><table class="table table-striped table-bordered bootstrap-datatable datatable dataTable" id="DataTables_Table_0" aria-describedby="DataTables_Table_0_info">
						  <thead>
							  <tr role="row">
								<th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Username: activate to sort column descending" style="width: 289px;">Catgory Id</th>
								<th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Date registered: activate to sort column ascending" style="width: 212px;">Catagory Name</th>
								<th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Role: activate to sort column ascending" style="width: 116px;">Catagory Description</th>
								<th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Status: activate to sort column ascending" style="width: 123px;">Status</th>
								<th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Actions: activate to sort column ascending" style="width: 248px;">Actions</th>
							  </tr>
						  </thead>

					@foreach($allmanufacture_info as $v_manufacture) 

					  <tbody role="alert" aria-live="polite" aria-relevant="all"><tr class="odd">
								<td class="  sorting_1">{{ $v_manufacture->manufacture_id }}</td>
								<td class="center ">{{ $v_manufacture->manufacture_name }}</td>
								<td class="center ">{{ $v_manufacture->manufacture_description }}</td>
								<td class="center ">

								 @if( $v_manufacture->publication_status == 1 )
									<span class="btn btn-success">Active</span>
								 @else 
                                    <span class="btn btn-danger">Inactive</span>
								 @endif

								</td>
								<td class="center ">
								@if( $v_manufacture->publication_status == 1)
									<a class="btn btn-danger" href="{{url('/unactive_manufacture/'.$v_manufacture->manufacture_id)}}">
										<i class="halflings-icon white thumbs-down"></i>                                            
									</a>
									@else
									<a class="btn btn-success" href="{{url('/active_manufacture/'.$v_manufacture->manufacture_id)}}">
										<i class="halflings-icon white thumbs-up"></i>                                            
									</a>

									@endif
									<a class="btn btn-info" href="{{url('/edit_manufacture/'.$v_manufacture->manufacture_id)}}">
										<i class="halflings-icon white edit"></i>                                            
									</a>
									<a class="btn btn-danger" href="{{url('/delete_manufacture/'.$v_manufacture->manufacture_id)}}">
										<i class="halflings-icon white trash"></i> 
									</a>
								 </td>
							  </tr>
							</tbody>
						@endforeach
						</table><div class="row-fluid"><div class="span12"><div class="dataTables_info" id="DataTables_Table_0_info">Showing 1 to 10 of 32 entries</div></div><div class="span12 center"><div class="dataTables_paginate paging_bootstrap pagination"><ul><li class="prev disabled"><a href="#">← Previous</a></li><li class="active"><a href="#">1</a></li><li><a href="#">2</a></li><li><a href="#">3</a></li><li><a href="#">4</a></li><li class="next"><a href="#">Next → </a></li></ul></div></div></div></div>            
					</div>
				</div><!--/span-->
			
			</div><!--/row-->

@endsection