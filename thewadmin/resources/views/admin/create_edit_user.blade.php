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
							
							<div class="col-xl-12 col-lg-12">
								<div class="m-portlet m-portlet--full-height m-portlet--tabs  ">
									<div class="m-portlet__head">
										<div class="m-portlet__head-tools">	
											<div class="headingpage">
												<i class="flaticon-lock-1"></i>
												@if(isset($result_data['franchise_user_id']))
													Edit Franchise User
												@else
													Create Franchise User
												@endif
												

											</div>											
										</div>										
									</div>

									{!! \Helpers::show_message() !!}
									
									<div class="tab-content">
										<div class="tab-pane active" id="m_user_profile_tab_1">
											{{ Form::open(array('class' => 'm-form m-form--fit m-form--label-align-right','id' => 'id_create_users','route' => 'save_user_data')) }}
											<!--<form class="m-form m-form--fit m-form--label-align-right">  -->
												<div class="m-portlet__body editusertbl">
													<div class="form-group m-form__group row">
														<div class=" col-6">
															<label for="example-text-input" class="col-4 col-form-label">
																First Name<span style="color:red">*</span>
															</label>
															<div class="col-8">
																<!--<input class="form-control m-input" name="first_name" type="text" value="" placeholder="First Name">-->
																{{ Form::text('first_name',isset($result_data['first_name'])?$result_data['first_name']:"",array('class' => 'form-control m-input','placeholder' => 'First Name','autocomplete' => 'off')) }}
															</div>
														</div>
														<div class="col-6">
															<label for="example-text-input" class="col-4 col-form-label">
																Last Name<span style="color:red">*</span>
															</label>
															<div class="col-8">
																<!--<input class="form-control m-input" name="last_name" type="text" value="" placeholder="Last Name">-->
																{{ Form::text('last_name',isset($result_data['last_name'])?$result_data['last_name']:"",array('class' => 'form-control m-input','placeholder' => 'Last Name','autocomplete' => 'off')) }}
															</div>
														</div>
													</div>
													<div class="form-group m-form__group row">
														<div class="col-6">
															<label for="example-text-input" class="col-4 col-form-label">
																Email<span style="color:red">*</span>
															</label>
															<div class="col-8">
																<!--<input class="form-control m-input" name="last_name" type="text" value="" placeholder="Last Name">-->
																{{ Form::text('email',isset($result_data['email'])?$result_data['email']:"",array('class' => 'form-control m-input','placeholder' => 'Email','autocomplete' => 'off','id' => 'id_email')) }}
															</div>
														</div>
														<div class="col-6">
															<label for="example-text-input" class="col-4 col-form-label">
																Mobile<span style="color:red">*</span>
															</label>
															<div class="col-8">
																<!--<input class="form-control m-input" name="last_name" type="text" value="" placeholder="Last Name">-->
																{{ Form::text('mobile',isset($result_data['mobile'])?$result_data['mobile']:"",array('class' => 'form-control m-input','placeholder' => 'Mobile','autocomplete' => 'off','id' => 'id_mobile')) }}
															</div>
														</div>	
													</div>
													<div class="form-group m-form__group row">
														<div class="col-6">
															<label for="example-text-input" class="col-4 col-form-label">
																Password
																@if(!isset($result_data['franchise_user_id']))
																	<span style="color:red">*</span>
																@endif
															</label>
															<div class="col-8">
																<!--<input class="form-control m-input" type="text" value="">-->
																{{ Form::password('password',array('class' => 'form-control m-input','placeholder' => 'Password','autocomplete' => 'off','id' => 'id_new_password')) }}

															</div>
														</div>	
														<div class="col-6">
															<label for="example-text-input" class="col-4 col-form-label">
																Confirm Password
																@if(!isset($result_data['franchise_user_id']))
																	<span style="color:red">*</span>
																@endif
															</label>
															<div class="col-8">
																<!--<input class="form-control m-input" type="text" value="">-->
																{{ Form::password('cpassword',array('class' => 'form-control m-input','placeholder' => 'Confirm Password','autocomplete' => 'off')) }}

															</div>
														</div>
													</div>
													<div class="form-group m-form__group row">
														<div class="col-6">
															<label for="example-text-input" class="col-4 col-form-label">
																Address Line 1<span style="color:red">*</span>
															</label>
															<div class="col-8">
																<!--<input class="form-control m-input" type="text" value="" placeholder="Address Line 1">-->
																{{ Form::text('address_line1',isset($result_data['address_line1'])?$result_data['address_line1']:"",array('class' => 'form-control m-input','placeholder' => 'Address Line 1','autocomplete' => 'off')) }}
															</div>
														</div>	
														<div class="col-6">
															<label for="example-text-input" class="col-4 col-form-label">
																Address Line 2
															</label>
															<div class="col-8">
																<!--<input class="form-control m-input" type="text" value="" placeholder="Address Line 1">-->
																{{ Form::text('address_line2',isset($result_data['address_line2'])?$result_data['address_line2']:"",array('class' => 'form-control m-input','placeholder' => 'Address Line 2','autocomplete' => 'off')) }}
															</div>
														</div>
													</div>
													<div class="form-group m-form__group row">
														<div class="form-group m-form__group col-6">
															<label for="example-text-input" class="col-4 col-form-label">
																City<span style="color:red">*</span>
															</label>
															<div class="col-8">
																<!--<input class="form-control m-input" type="text" value="" placeholder="Address Line 1">-->
																{{ Form::text('city',isset($result_data['city'])?$result_data['city']:"",array('class' => 'form-control m-input','placeholder' => 'City','autocomplete' => 'off')) }}
															</div>
														</div>	
														<div class="form-group m-form__group col-6">
															<label for="example-text-input" class="col-4 col-form-label">
																State
															</label>
															<div class="col-8">
																<!--<input class="form-control m-input" type="text" value="" placeholder="Address Line 1">-->
																{{ Form::select('state',$state_data,isset($result_data['state'])?$result_data['state']:"",array('class' => ' m-input js-example-basic-multiple')) }}	
															</div>
														</div>
													</div>
													<div class="form-group m-form__group row">
														<div class="form-group m-form__group col-6">
															<label for="example-text-input" class="col-4 col-form-label">
																Pincode
															</label>
															<div class="col-8">
																<!--<input class="form-control m-input" type="text" value="" placeholder="Pincode">-->
																{{ Form::number('pincode',isset($result_data['pincode'])?$result_data['pincode']:"",array('class' => 'form-control m-input','placeholder' => 'Pincode','autocomplete' => 'off','oninput' => 'if(value.length>10)value=value.slice(0,10)')) }}
															</div>
														</div>
														<div class="form-group m-form__group col-6">
															<label for="example-text-input" class="col-4 col-form-label">
																Role<span style="color:red">*</span>
															</label>
															<div class="col-8">
																<!--<input class="form-control m-input" type="text" value="" placeholder="Address Line 1">-->
																{{ Form::select('role',$role_data,isset($result_data['role'])?$result_data['role']:"",array('class' => ' m-input js-example-basic-multiple')) }}	
															</div>
														</div>
													</div>
													{{ Form::hidden('id',isset($result_data['franchise_user_id'])?$result_data['franchise_user_id']:"",array('class' => 'form-control m-input','placeholder' => 'Address Line 1','autocomplete' => 'off')) }}										
												</div>
												<div class="m-portlet__foot m-portlet__foot--fit">
													<div class="m-form__actions">
														<div class="row">
															<div class="col-4"></div>
															<div class="col-7">
																<button type="submit" class="btn btn-accent m-btn m-btn--custom purplebtn">
																	@if(isset($result_data['franchise_user_id']))
																		Update
																	@else
																		Create
																	@endif
																</button>
																&nbsp;&nbsp;
																<a href="{{url(route('users'))}}" class="btn btn-secondary m-btn m-btn--air m-btn--custom">
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

	<script type="text/javascript">
		
		//This code for set not required upload documents of self employeed
		if("<?php echo isset($result_data['franchise_user_id'])?$result_data['franchise_user_id']:'' ?>" != "") 
		{
			required = false; 
		}
		// alert(required);
	</script>


@endsection


@section('script')

<script type="text/javascript">
	$(document).ready(function() 
	{
		$(".js-example-basic-multiple").select2({
			placeholder: "Select one",
		});
	}); 

</script>

@endsection
