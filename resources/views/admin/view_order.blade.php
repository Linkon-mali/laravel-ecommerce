@extends('admin_layout')

@section('admin_content')
			
			<ul class="breadcrumb">
				<li>
					<i class="icon-home"></i>
					<a href="index.html">Dashboard</a> 
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
			<div>
                <div class="box span6">
					<div class="box-header" data-original-title="">
						<h2><i class="halflings-icon user"></i><span class="break"></span>Customer details</h2>
						
					</div>
					<div class="box-content">
					<table >
						  <thead>
							  <tr role="row">
								<th style="width: 212px;">Customer name</th>
								<th style="width: 116px;">Mobile number</th>
							  </tr>
						  </thead>

					  <tbody role="alert" aria-live="polite" aria-relevant="all">
                            <tr class="odd">
								<td class=" center">{{$order_by_id->coustomer_name}}</td>
								<td class="center ">{{$order_by_id->mobile_number}}</td>
						    </tr>
							</tbody>
						</table>          
					</div>
				</div><!--/span-->

                <div class="box span6">
					<div class="box-header" data-original-title="">
						<h2><i class="halflings-icon user"></i><span class="break"></span>Shipping details</h2>
						
					</div>
					<div class="box-content">
					<table >
						  <thead>
							  <tr role="row">
								<th style="width: 289px;">Receiver name</th>
								<th style="width: 212px;">Address</th>
								<th  style="width: 248px;">Mobile</th>
								<th  style="width: 248px;">Email</th>
							  </tr>
						  </thead>

					  <tbody role="alert" aria-live="polite" aria-relevant="all">
                            <tr class="odd">
								<td class=" center">{{$order_by_id->shipping_first_name}}</td>
								<td class="center ">{{$order_by_id->shipping_address}}</td>
								<td class="center ">{{$order_by_id->shipping_mobile_number}}</td>
								<td class="center ">{{$order_by_id->shipping_email}}</td>
						    </tr>
							</tbody>
						</table>          
					</div>
				</div>
            </div>
        <div col-md-12>
            <div class="box span12">
					<div class="box-header" data-original-title="">
						<h2><i class="halflings-icon user"></i><span class="break"></span>Order details</h2>
						
					</div>
					<div class="box-content">
					<table >
						  <thead>
							  <tr role="row">
								<th style="width: 112px;">Id</th>
								<th style="width: 212px;">Product name</th>
								<th style="width: 212px;">Product price</th>
								<th style="width: 248px;">Product salse quantity</th>
								<th style="width: 212px;">Product sub total</th>
							  </tr>
						  </thead>

					  <tbody role="alert" aria-live="polite" aria-relevant="all">
                       
                            <tr class="odd">
								<td class="center">{{$order_by_id->order_id}}</td>
								<td class="center ">{{$order_by_id->product_name}}</td>
								<td class="center ">{{$order_by_id->product_price}}</td>
								<td class="center ">{{$order_by_id->product_sales_quantity}}</td>
						    </tr>
							</tbody>
                            <tfoot>
                              <tr>
                                <td colspan="4">Total with vat:</td>
                                <td class="center ">{{$order_by_id->order_total}}</td>
                              </tr>
                            </tfoot>
						</table>          
					</div>
				</div>
			
		</div><!--/row-->

    </div>

@endsection