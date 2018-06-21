<table class="table table-bordered table-hover" id="html_table"><!-- m-datatable -->
	<thead class="text-primary">
		<th>No.</th>
		<th>FB Transaction ID</th>
		<th>Merchant Order ID</th>
		<th>Name</th>
		<th>Mobile</th>
		<th>Product Value</th>
		<th>Status</th>
		<th>Created Date</th>
		<th>Action</th>									
	</thead>
	<tbody> 
		@foreach ($data as $key => $row_data)		
			<tr id="row">
				<td>{{++$key}}</td> 
				<td>{{$row_data['fb_transaction_id']}}</td> 
				<td>{{$row_data['merchant_order_id']}}</td> 
				<td>{{$row_data['user_fname']." ".$row_data['user_lname']}}</td> 
				<td>{{$row_data['mobile_number']}}</td> 
				<td>{{$row_data['product_value']}}</td> 
				<td>{{$statusmsgs_array[$row_data['status']]}}</td> 
				<td>{{$row_data['created_at']}}</td> 
				<td>
					<a href="{{url(route('transaction_view',['id' => $row_data['fb_transaction_id']]))}}" target="_blank" class="m-portlet__nav-link btn m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill editbtn" title="View Transaction">
						<i class="fa fa-eye"></i>                  
					</a>		
				</td>								
			</tr>
		@endforeach
	</tbody> 
	
</table>

<script type="text/javascript">
		
	 $('#html_table').DataTable( {
    "processing": true,
    "pageLength": 20,
    } );

</script>