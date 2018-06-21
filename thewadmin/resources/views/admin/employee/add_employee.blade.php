@extends('admin.layouts.header')
@section('title', 'Page Title')


@section('css')
	

@endsection


@section('content')
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
							
							<div class="col-xl-9 col-lg-8">
								<div class="m-portlet m-portlet--full-height m-portlet--tabs  ">
									<div class="m-portlet__head">
										<div class="m-portlet__head-tools">	
											<div class="headingpage">
												<i class="flaticon-lock-1"></i>
												Add Employee													
											</div>											
										</div>										
									</div>

									{!! \Helpers::show_message() !!}
									
									<div class="tab-content">
										<div class="tab-pane active" id="m_user_profile_tab_1">
											{{ Form::open(array('class' => 'm-form m-form--fit m-form--label-align-right','id' => 'id_add_employee','route' => 'add_employee_data')) }}
											<!--<form class="m-form m-form--fit m-form--label-align-right">  -->
												<div class="m-portlet__body">									
													<div class="form-group m-form__group row">
														<label for="example-text-input" class="col-3 col-form-label">
															First Name
														</label>
														<div class="col-7">
															<!--<input class="form-control m-input" type="text" value="">-->
															{{ Form::text('first_name','',array('class' => 'form-control m-input','placeholder' => 'First Name','autocomplete' => 'off')) }}
															<span class="text-danger"> {!! $errors->errormsg->first('first_name') !!} </span>
														</div>
													</div>
													<div class="form-group m-form__group row">
														<label for="example-text-input" class="col-3 col-form-label">
															Last Name
														</label>
														<div class="col-7">
															<!--<input class="form-control m-input" type="text" value="">-->
															{{ Form::text('last_name','',array('class' => 'form-control m-input','id' => 'id_new_password','placeholder' => 'Last Name','autocomplete' => 'off')) }}
															<span class="text-danger"> {!! $errors->errormsg->first('last_name') !!} </span>
														</div>
													</div>
													<div class="form-group m-form__group row">
														<label for="example-text-input" class="col-3 col-form-label">
															Email
														</label>
														<div class="col-7">
															<!--<input class="form-control m-input" type="text" value="">-->
															{{ Form::text('email','',array('class' => 'form-control m-input','placeholder' => 'Email','autocomplete' => 'off')) }}
															<span class="text-danger"> {!! $errors->errormsg->first('email') !!} </span>
														</div>
													</div>	
													<div class="form-group m-form__group row">
														<label for="example-text-input" class="col-3 col-form-label">
															Mobile
														</label>
														<div class="col-7">
															<!--<input class="form-control m-input" type="text" value="">-->
															{{ Form::number('mobile','',array('class' => 'form-control m-input','placeholder' => 'Mobile','autocomplete' => 'off')) }}
															<span class="text-danger"> {!! $errors->errormsg->first('mobile') !!} </span>
														</div>
													</div>	
													<div class="form-group m-form__group row">
														<label for="example-text-input" class="col-3 col-form-label">
															Alternet Mobile No
														</label>
														<div class="col-7">
															<!--<input class="form-control m-input" type="text" value="">-->
															{{ Form::number('alternet_mobile_no','',array('class' => 'form-control m-input','placeholder' => 'Alternet Mobile No','autocomplete' => 'off')) }}
															<span class="text-danger"> {!! $errors->errormsg->first('alternet_mobile_no') !!} </span>
														</div>
													</div>
													<div class="form-group m-form__group row">
														<label for="example-text-input" class="col-3 col-form-label">
															Address 1 
														</label>
														<div class="col-7">
															<!--<input class="form-control m-input" type="text" value="">-->
															{{ Form::text('address_line1','',array('class' => 'form-control m-input','placeholder' => 'Address 1','autocomplete' => 'off')) }}
															<span class="text-danger"> {!! $errors->errormsg->first('address_line1') !!} </span>
														</div>
													</div>	
													<div class="form-group m-form__group row">
														<label for="example-text-input" class="col-3 col-form-label">
															Address 2
														</label>
														<div class="col-7">
															<!--<input class="form-control m-input" type="text" value="">-->
															{{ Form::text('address_line2','',array('class' => 'form-control m-input','placeholder' => 'Address 2','autocomplete' => 'off')) }}
															<span class="text-danger"> {!! $errors->errormsg->first('address_line2') !!} </span>
														</div>
													</div>	
													<div class="form-group m-form__group row">
														<label for="example-text-input" class="col-3 col-form-label">
															Pincode
														</label>
														<div class="col-7">
															<!--<input class="form-control m-input" type="text" value="">-->
															{{ Form::number('pincode','',array('class' => 'form-control m-input','placeholder' => 'Pincode 2','autocomplete' => 'off')) }}
															<span class="text-danger"> {!! $errors->errormsg->first('pincode') !!} </span>
														</div>
													</div>	
													<div class="form-group m-form__group row">
														<label for="example-text-input" class="col-3 col-form-label">
															Role
														</label>
														<div class="col-7">
															<!--<input class="form-control m-input" type="text" value="">-->
															{{ Form::select('role',array('' => 'Select Role','Manager' => 'Manager', 'Employee' => 'Employee', 'Admin' => 'Admin'),'',array('class' => 'form-control m-input selectBox')) }}
															<span class="text-danger"> {!! $errors->errormsg->first('role') !!} </span>
														</div>
													</div>			
													<div class="form-group m-form__group row">
														<label for="example-text-input" class="col-3 col-form-label">
															Is Active
														</label>
														<div class="col-7">
															<!--<input class="form-control m-input" type="text" value="">-->
															{{ Form::select('is_active',array('1' => 'Active', '0' => 'Inactive'),'',array('class' => 'form-control m-input selectBox')) }}
															<span class="text-danger"> {!! $errors->errormsg->first('is_active') !!} </span>
														</div>
													</div>					
												</div>
												<div class="m-portlet__foot m-portlet__foot--fit">
													<div class="m-form__actions">
														<div class="row">
															<div class="col-2"></div>
															<div class="col-7">
																<button type="submit" class="btn btn-accent m-btn m-btn--custom purplebtn">
																	Add
																</button>
																&nbsp;&nbsp;
																<a href="{{route('employeelist')}}" class="btn btn-secondary m-btn m-btn--air m-btn--custom">
																	Cancel
																</a>
															</div>
														</div>
													</div>
												</div>
											<!--</form>-->
											{{ Form::close() }}
										</div>
										<!-- <div class="tab-pane active" id="m_user_profile_tab_2"></div> -->
									</div>
								</div>
							</div>
						</div>
					</div>
		
	</div>
@endsection


@section('script')


@endsection
