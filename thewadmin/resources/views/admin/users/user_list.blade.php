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
									Users List
									<a href="{{route('add_user')}}" class="btn btn-accent m-btn m-btn--air m-btn--custom purplebtn createbtn btn-margin">
										Add user
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


							<div class="tab-pane active" id="m_user_profile_tab_1">
											{{ Form::open(array('class' => 'm-form m-form--fit m-form--label-align-right','id' => 'id_search_data','onsubmit' => 'return false;')) }}
												<div class="m-portlet__body">
													
													<div class="form-group m-form__group row">
														
														
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
											

														
															
																<a href="{{url(route('userslist'))}}" class="btn btn-accent m-btn m-btn--custom purplebtn"><i class="fa fa-refresh"></i></a>
															
														
														
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
											<th>Name</th>
											<th>Email</th>
											<th>Mobile</th>
											<th>Alternet Mobile No</th>
											<th>Created Date</th>
											<th>Is Active</th>
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
	        url: '<?php echo route('users_search_data') ?>',
	        type: 'POST', 
	        data: {
		        "_token": $("input[name=_token]").val(),
		        "searchfield": $("input[name=searchfield]").val(),
		        // "merchant_id": $("#id_merchant_id").val(),
		        // "status": $("#id_status").val(),
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
            { data: null ,render: function ( data, type, row ) {
                return data.name;
            } },
            { data: "email" },
            { data: "mobile" },
            { data: "alternet_mobile_no" },
            { data: "created_at" },
            { data: null ,render: function ( data, type, row ) {
                if(data.is_active)
                {
                	return 'Active';
                }else{
                	return 'Inactive';
                }
                
            } },
            { data: null , render: function ( data, type, row ) {
            	var user_view = '<?php echo route('view_user') ?>';
            	var user_edit = '<?php echo route('edit_user') ?>';
            	var action_string = '<a href="'+user_view+'/'+data.id+'" class="m-portlet__nav-link btn m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill editbtn"  title="View Data"><i class="fa fa-eye"></i></a><a href="'+user_edit+'/'+data.id+'" class="m-portlet__nav-link btn m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill editbtn" title="Edit Data"><i class="fa fa-edit"></i></a>';
            	
                return action_string;
            } }
        ],
        
    } );
    
	}
</script>

@endsection
