@extends('admin.layouts.header')
@section('title', 'Page Title')


@section('css')



@endsection


@section('content')

<style type="text/css">
	
	::-webkit-datetime-edit-year-field:not([aria-valuenow]),
::-webkit-datetime-edit-month-field:not([aria-valuenow]),
::-webkit-datetime-edit-day-field:not([aria-valuenow]) {
    color: transparent;
}	

</style>

	<div class="m-grid__item m-grid__item--fluid m-wrapper">
    	<!-- <div class="m-subheader ">
			<div class="d-flex align-items-center">
				<div class="mr-auto">
					<h3 class="m-subheader__title">
						Change Password
					</h3>								
				</div>							
			</div>
		</div> -->

		<div class="m-content">
			<div class="row">
				
				<div class="col-xl-12 col-lg-12">
					<div class="m-portlet m-portlet--full-height m-portlet--tabs ">
						<div class="m-portlet__head">
							<div class="m-portlet__head-tools">	
								<div class="headingpage">
									<i class="flaticon-lock-1"></i>
									Employee List
									<a href="{{route('add_employee')}}" class="btn btn-accent m-btn m-btn--air m-btn--custom purplebtn createbtn btn-margin">
										Add Employee
									</a>
								</div>											
							</div>										
						</div>
						{!! \Helpers::show_message() !!}	
						<div class="m-portlet__body">
							
							<!-- <div class="m-form m-form--label-align-right m--margin-top-20 m--margin-bottom-30">
								<div class="row align-items-center">
									<div class="col-xl-8 order-2 order-xl-1">
										<div class="form-group m-form__group row align-items-center">
											<div class="col-md-4">
												<div class="m-input-icon m-input-icon--left">
													<input type="text" class="form-control m-input m-input--solid" placeholder="Search..." id="m_form_search">
													<span class="m-input-icon__icon m-input-icon__icon--left">
														<span>
															<i class="la la-search"></i>
														</span>
													</span>
												</div>
											</div>
										</div>
									</div>
									
								</div>
							</div> -->


							<div class="tab-content userlistbx">
								<div class="tab-pane active instantcashlisttablebx" >
									<div class="table-responsive instantcashlisttablebx2" id="m_user_profile_tab_1">

									<!-- <div id="post_content"></div> -->
									<table class="table table-bordered table-hover" id="html_table">
										<thead class="text-primary">
											<th>No.</th>
											<th>Name</th>
											<th>Email</th>
											<th>Mobile</th>
											<th>Alternet Mobile No</th>
											<th>Address</th>
											<th>Pincode</th>
											<th>Created Date</th>
											<th>Is Active</th>
											<th>Action</th>									
										</thead>
										<tbody>
											@foreach ($result_data as $key=>$row)
											<tr>
												<td>{{++$key}}</td>
												<td>{{$row->first_name." ".$row->last_name}}</td>
												<td>{{$row->email}}</td>
												<td>{{$row->mobile}}</td>
												<td>{{$row->alternet_mobile_no}}</td>
												<td>{{$row->address_line1." ,".$row->address_line2}}</td>
												<td>{{$row->pincode}}</td>
												<td>{{$row->created_at}}</td>
												<td>{{$row->is_active == '1'?"Active":"Inactive"}}</td>
												<td>
													<a href="{{url(route('edit_employee',['id' => $row->admin_user_id]))}}" class="m-portlet__nav-link btn m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill editbtn" title="Edit Data"><i class="fa fa-edit"></i></a>
												</td>
											</tr>
											@endforeach
										</tbody>
									</table>
								</div>
								</div>
								<!-- <div class="tab-pane active" id="m_user_profile_tab_2"></div> -->
							</div>
						</div>
						
					</div>
				</div>
			</div>
		</div>
		
	</div>
@endsection


@section('script')

<!-- <script src="{{asset('public/admin/js/html-table.js')}}" type="text/javascript"></script> -->
<!-- <script type="text/javascript">$('#example').DataTable(); </script> -->
<!-- <script src="{{asset('public/admin/js/table.js')}}" type="text/javascript"></script> -->

<script type="text/javascript">

	$('#html_table').DataTable();

    // call_data();

    /*function call_data()
	{
		showAjaxLoader();
	    var request = $.ajax({
		  url: '',
		  type: "POST",
		  data: $("#id_search_data").serialize(),
		  // dataType: "json"
		});

	    request.done(function(data) {
	    	// console.log(data);
		  $("#post_content").html( data );
		  hideAjaxLoader();
		});

		request.fail(function(jqXHR, textStatus) {
		  alert( "Request failed: " + textStatus );
		  hideAjaxLoader();
		});

	}*/
	// var table = $('#html_table').DataTable();

	// call_ajax_data();

	// function call_ajax_data(){
	// 	showAjaxLoader();

	// var i = 0;
	
	// var table = $('#html_table').DataTable( {
 //        "processing": true,
 //        "searching": false,
 //        "pageLength": 10,
 //        "destroy": true,
 //        "serverSide": true,
 //        "ajax": {
	//         url: '',
	//         type: 'POST', 
	//         data: {
	// 	        "_token": $("input[name=_token]").val(),
	// 	        "searchfield": $("input[name=searchfield]").val(),
	// 	        "merchant_id": $("#id_merchant_id").val(),
	// 	        "status": $("#id_status").val(),
	// 	        "fromdate": $("#id_fromdate").val(),
	// 	        "todate": $("#id_todate").val(),
	// 	        "search_cond": $("#id_search_cond").val(),
	// 	    },
	// 	    "dataSrc": function ( json ) {
 //      				hideAjaxLoader();
 //      				return json.data;
 //    		},
	// 	    // success : function(data) {              
 //      //       	console.log(data);
 //      //   	},	
	//         // dataType: "json", 
 //    	},
 //    	"columns": [
 //    		/*{ data: null ,render: function ( data, type, row ) {
 //                console.log(data);
 //                return ++i;
 //            } },*/
 //            { data: "fb_transaction_id" },
 //            { data: "merchant_id" },
 //            { data: "merchant_order_id" },
 //            { data: null ,render: function ( data, type, row ) {
 //                return data.user_fname+" "+data.user_lname;
 //            } },
 //            { data: "mobile_number" },
 //            { data: "product_value" },
 //            { data: "company_name" },
 //            { data: null ,render: function ( data, type, row ) {
 //            	var statusmsgs = table.ajax.json()['statusmsgs'];
 //            	return statusmsgs[data.status];
 //                //return statusmsgs.a;
 //            } },
 //            { data: "created_at" },
 //            { data: null , render: function ( data, type, row ) {
 //            	var transaction_view = '';
 //            	var action_string = '<a href="'+transaction_view+'/'+data.fb_transaction_id+'" class="m-portlet__nav-link btn m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill editbtn" target="_blank" title="View Data"><i class="fa fa-eye"></i></a>';
            	
 //                return action_string;
 //            } }
 //        ],
        
 //    } );
    
	// }
</script>

@endsection
