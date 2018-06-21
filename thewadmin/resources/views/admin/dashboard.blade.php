@extends('admin.layouts.header')
@section('title', 'Page Title')


@section('css')
	

@endsection


@section('content')
	<div class="m-grid__item m-grid__item--fluid m-wrapper">

		{!! \Helpers::show_message() !!}

	
			<div class="m-subheader ">
				<div class="d-flex align-items-center">
					<div class="mr-auto">
						<h3 class="m-subheader__title">
							Dashboard
						</h3>								
					</div>							
				</div>
			</div>
			<div class="m-content">						
				<div class="row">
					
					
					<div class="col-xl-4">
						<div class="m-portlet">
							<a href="{{route('employeelist')}}">
								<div class="loantypemainbx">
									<div class="loantypeimgbx">
											<img src="{{asset('public/admin/images/loan-type/view-transaction.png')}}" alt="finance"/>
									</div>
									<div class="loantypebx">
											<h3 class="m-portlet__head-text hedingtext1"> Employee List </h3>
									</div>
								</div>										
							</a>
						</div>
					</div>
					<div class="col-xl-4">
						<div class="m-portlet"> 
							<a href="{{route('userslist')}}">
								<div class="loantypemainbx">
									<div class="loantypeimgbx">
											<img src="{{asset('public/admin/images/loan-type/view-transaction.png')}}" alt="finance"/>
									</div>
									<div class="loantypebx">
											<h3 class="m-portlet__head-text hedingtext1"> Users List </h3>									
									</div>
								</div>
							</a>
						</div>						 			
					</div>
					
				</div>
			</div>
	   
	</div>
	
@endsection


@section('script')


@endsection
