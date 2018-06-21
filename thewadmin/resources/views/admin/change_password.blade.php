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
												Change Password													
											</div>											
										</div>										
									</div>

									{!! \Helpers::show_message() !!}
									
									<div class="tab-content">
										<div class="tab-pane active" id="m_user_profile_tab_1">
											{{ Form::open(array('class' => 'm-form m-form--fit m-form--label-align-right','id' => 'id_change_password','route' => 'set_change_password')) }}
											<!--<form class="m-form m-form--fit m-form--label-align-right">  -->
												<div class="m-portlet__body">																										
													<div class="form-group m-form__group row">
														<label for="example-text-input" class="col-3 col-form-label">
															Current Password
														</label>
														<div class="col-7">
															<!--<input class="form-control m-input" type="text" value="">-->
															{{ Form::password('old_password',array('class' => 'form-control m-input','placeholder' => 'Current Password','autocomplete' => 'off')) }}

														</div>
													</div>
													<div class="form-group m-form__group row">
														<label for="example-text-input" class="col-3 col-form-label">
															New Password
														</label>
														<div class="col-7">
															<!--<input class="form-control m-input" type="text" value="">-->
															{{ Form::password('new_password',array('class' => 'form-control m-input','id' => 'id_new_password','placeholder' => 'New Password','autocomplete' => 'off')) }}

														</div>
													</div>
													<div class="form-group m-form__group row">
														<label for="example-text-input" class="col-3 col-form-label">
															Re-type New Password
														</label>
														<div class="col-7">
															<!--<input class="form-control m-input" type="text" value="">-->
															{{ Form::password('reenter_password',array('class' => 'form-control m-input','placeholder' => 'Re-type Password','autocomplete' => 'off')) }}

														</div>
													</div>												
												</div>
												<div class="m-portlet__foot m-portlet__foot--fit">
													<div class="m-form__actions">
														<div class="row">
															<div class="col-2"></div>
															<div class="col-7">
																<button type="submit" class="btn btn-accent m-btn m-btn--custom purplebtn">
																	Change Password
																</button>
																&nbsp;&nbsp;
																<a href="dashboard" class="btn btn-secondary m-btn m-btn--air m-btn--custom">
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
