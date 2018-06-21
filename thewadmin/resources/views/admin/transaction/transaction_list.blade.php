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
									Merchant Transaction List
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

							<div class="tab-pane active" id="m_user_profile_tab_1">
											{{ Form::open(array('class' => 'm-form m-form--fit m-form--label-align-right','id' => 'id_search_data','onsubmit' => 'return false;')) }}
												<div class="m-portlet__body">
													
													<div class="form-group m-form__group row">
														
														
														<div class="col-md-2">
															<!--<input class="form-control m-input" name="first_name" type="text" value="" placeholder="First Name">-->
															{{ Form::select('status',$statusmsgs_array,'',array('class' => 'form-control m-input selectBox','id' => 'id_status')) }}
															
														</div>
														<div class="col-md-2">
															<!--<input class="form-control m-input" name="first_name" type="text" value="" placeholder="First Name">-->
															{{ Form::select('merchant_id',$merchant_list_array,'',array('class' => 'form-control m-input selectBox ','id' => 'id_merchant_id')) }}
															
														</div>
														<div class="col-md-2">
															<!--<input class="form-control m-input" name="first_name" type="text" value="" placeholder="First Name">-->
															{{ Form::select('search_cond',$search_cond,'',array('class' => 'form-control m-input selectBox ','id' => 'id_search_cond')) }}
															
														</div>
														<div class="col-md-2">
															<!--<input class="form-control m-input" name="first_name" type="text" value="" placeholder="First Name">-->
															{{ Form::text('searchfield',null,array('class' => 'form-control m-input','placeholder' => 'Search Key','autocomplete' => 'off','id' => 'id_searchfield')) }}
															
														</div>
														<div class="col-md-2">
															<!-- <input class="form-control m-input" name="first_name" type="date" value="" placeholder="First Name"> -->
															{{ Form::text('fromdate',null,array('class' => 'form-control m-input m_datepicker_1','placeholder' => 'From Date','autocomplete' => 'off','id' => 'id_fromdate','readonly' => 'true')) }}
															
														</div>
														<div class="col-md-2">
															<!--<input class="form-control m-input" name="first_name" type="text" value="" placeholder="First Name">-->
															{{ Form::text('todate',null,array('class' => 'form-control m-input m_datepicker_1','placeholder' => 'To Date','autocomplete' => 'off','id' => 'id_todate','readonly' => 'true')) }}
															
														</div>
														<div class="col-md-2">
															<button type="button" name="get_flipkart_data" id="id_get_flipkart_data" class="btn btn-accent m-btn m-btn--custom purplebtn" onclick="call_ajax_data()"><i class="fa fa-search"></i></button>  
											

														
															
																<a href="{{url(route('transaction_list'))}}" class="btn btn-accent m-btn m-btn--custom purplebtn"><i class="fa fa-refresh"></i></a>
															
														
														
														</div>
													</div>
																	
												</div>

												
											{{ Form::close() }}
										</div>

							<div class="tab-content userlistbx">
								<div class="tab-pane active instantcashlisttablebx" >
									<div class="table-responsive instantcashlisttablebx2" id="m_user_profile_tab_1">

									<!-- <div id="post_content"></div> -->
									<table class="table table-bordered table-hover" id="html_table">
										<thead class="text-primary">
											<!-- <th>No.</th> -->
											<th>FB Transaction ID</th>
											<th>Merchant ID</th>
											<th>Merchant Order ID</th>
											<th>Name</th>
											<th>Mobile</th>
											<th>Product Value</th>
											<th>Company Name</th>
											<th>Status</th>
											<th>Created Date</th>
											<th>Action</th>									
										</thead>
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

    // call_data();

    /*function call_data()
	{
		showAjaxLoader();
	    var request = $.ajax({
		  url: '<?php echo route('transaction_get_list') ?>',
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

	call_ajax_data();

	function call_ajax_data(){
		showAjaxLoader();

	var i = 0;
	
	var table = $('#html_table').DataTable( {
        "processing": true,
        "searching": false,
        "pageLength": 10,
        "destroy": true,
        "serverSide": true,
        "ajax": {
	        url: '<?php echo route('transaction_get_list') ?>',
	        type: 'POST', 
	        data: {
		        "_token": $("input[name=_token]").val(),
		        "searchfield": $("input[name=searchfield]").val(),
		        "merchant_id": $("#id_merchant_id").val(),
		        "status": $("#id_status").val(),
		        "fromdate": $("#id_fromdate").val(),
		        "todate": $("#id_todate").val(),
		        "search_cond": $("#id_search_cond").val(),
		    },
		    "dataSrc": function ( json ) {
      				hideAjaxLoader();
      				return json.data;
    		},
		    // success : function(data) {              
      //       	console.log(data);
      //   	},	
	        // dataType: "json", 
    	},
    	"columns": [
    		/*{ data: null ,render: function ( data, type, row ) {
                console.log(data);
                return ++i;
            } },*/
            { data: "fb_transaction_id" },
            { data: "merchant_id" },
            { data: "merchant_order_id" },
            { data: null ,render: function ( data, type, row ) {
                return data.user_fname+" "+data.user_lname;
            } },
            { data: "mobile_number" },
            { data: "product_value" },
            { data: "company_name" },
            { data: null ,render: function ( data, type, row ) {
            	var statusmsgs = table.ajax.json()['statusmsgs'];
            	return statusmsgs[data.status];
                //return statusmsgs.a;
            } },
            { data: "created_at" },
            { data: null , render: function ( data, type, row ) {
            	var transaction_view = '<?php echo route('transaction_view') ?>';
            	var action_string = '<a href="'+transaction_view+'/'+data.fb_transaction_id+'" class="m-portlet__nav-link btn m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill editbtn" target="_blank" title="View Data"><i class="fa fa-eye"></i></a>';
            	
                return action_string;
            } }
        ],
        
    } );
    
	}
</script>

@endsection
