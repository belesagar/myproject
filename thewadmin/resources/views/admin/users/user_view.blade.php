@extends('admin.layouts.header')
@section('title', 'Page Title')


@section('css')
	
	 <style>
      /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
      #map {
        height: 100%;
      }
      /* Optional: Makes the sample page fill the window. */
      html, body {
        height: 100%;
        margin: 0;
        padding: 0;
      }
		  .controls {
			background-color: #fff;
			border-radius: 2px;
			border: 1px solid transparent;
			box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
			box-sizing: border-box;
			font-family: Roboto;
			font-size: 15px;
			font-weight: 300;
			height: 29px;
			margin-left: 17px;
			margin-top: 10px;
			outline: none;
			padding: 0 11px 0 13px;
			text-overflow: ellipsis;
			width: 400px;
		  }

		  .controls:focus {
			border-color: #4d90fe;
		  }
		  .title {
			font-weight: bold;
		  }
		  #infowindow-content {
			display: none;
		  }
		  #map #infowindow-content {
			display: inline;
		  }

    </style>


@endsection


@section('content')
	<div class="m-grid__item m-grid__item--fluid m-wrapper">
    	<!-- <div class="m-subheader ">
			<div class="d-flex align-items-center">
				<div class="mr-auto">
					<h3 class="m-subheader__title ">
						User Details

					</h3>
				</div>
			</div>
		</div> -->
		<!-- END: Subheader -->
		<div class="m-content">
			<div class="row">

				{!! \Helpers::show_message() !!}
				
									
					<div class="col-xl-12 col-lg-12">
						<div class="m-portlet m-portlet--full-height m-portlet--tabs  ">
							<!-- <div class="m-portlet__head">
								<div class="m-portlet__head-tools">
									<ul class="nav nav-tabs m-tabs m-tabs-line   m-tabs-line--left m-tabs-line--primary" role="tablist">
										<li class="nav-item m-tabs__item">
											<a class="nav-link m-tabs__link active" data-toggle="tab" href="#personal_details" role="tab">											
												Transaction Details
											</a>
										</li>
										
										
									</ul>
								</div>							
							</div> -->
							<div class="m-portlet__head">
								<div class="m-portlet__head-tools">	
									<div class="headingpage">
										<i class="flaticon-lock-1"></i>
										User Details
										<a href="{{route('edit_user',['id'=>$result_data[0]->id])}}" class="btn btn-accent m-btn m-btn--air m-btn--custom purplebtn createbtn btn-margin">
											Edit
										</a>
									</div>											
								</div>										
							</div>
							<div class="tab-content">
								<div class="tab-pane active" id="personal_details">
									
										<div class="m-portlet__body">										
											<table class="table table-bordered table-hover " id="html_table"><!-- m-datatable -->
										
										<tbody> 
																
											<tr>
												<th>Name</th> 
												<td>{{!empty($result_data[0]->name) ? $result_data[0]->name : "-"}}</td> 
												<th>Email</th> 
												<td>{{!empty($result_data[0]->email) ? $result_data[0]->email : ""}}</td> 
																			
											</tr>
											<tr>
												<th>Mobile</th> 
												<td>{{!empty($result_data[0]->mobile) ? $result_data[0]->mobile : "-"}}</td> 
												<th>Alternet Mobile no</th> 
												<td>{{!empty($result_data[0]->alternet_mobile_no) ? $result_data[0]->alternet_mobile_no : "-"}}</td> 
																			
											</tr>
											<tr>
												<th>Address</th> 
												<td>{{!empty($result_data[0]->address_line1) ? $result_data[0]->address_line1." ,".$result_data[0]->address_line2 : "-"}}</td>
												<th>Landmark</th> 
												<td>{{!empty($result_data[0]->landmark) ? $result_data[0]->landmark : "-"}}</td> 
																			
											</tr>
											
											<tr>
												<th>Pincode</th> 
												<td>{{!empty($result_data[0]->pincode) ? $result_data[0]->pincode : "-"}}</td> 
												<th>Status</th> 
												<td>{{$result_data[0]->is_active == "1"?"Active":"Inavtive"}}</td> 
																			
											</tr>
											
											<tr>
												<th>Created Date</th> 
												<td>{{!empty($result_data[0]->created_at) ? $result_data[0]->created_at : "-"}}</td> 
												<th></th> 
												<td></td> 
																			
											</tr>
											
										</tbody>
										
									</table>
																		
										</div>
																
								</div>
								
								

							</div>
						</div>
					</div>
				
			</div>
		</div>
		

	</div>



@endsection


@section('script')
	

@endsection
