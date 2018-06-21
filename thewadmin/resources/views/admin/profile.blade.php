@extends('admin.layouts.header')
@section('title', 'Page Title')


@section('css')
	

@endsection


@section('content')
	<div class="m-grid__item m-grid__item--fluid m-wrapper">
    	<div class="m-subheader ">
			<div class="d-flex align-items-center">
				<div class="mr-auto">
					<h3 class="m-subheader__title">
						Welcome Profile
					</h3>								
				</div>							
			</div>
		</div>

		{!! \Helpers::show_message() !!}

		<div class="m-content">
			<div class="row">
				<div class="col-xl-3 col-lg-4">
					<div class="m-portlet m-portlet--full-height">
						<div class="m-portlet__body">
							<div class="m-card-profile">
								<div class="m-card-profile__title m--hide">
									Your Profile
								</div>
								<div class="m-card-profile__pic">
									<div class="m-card-profile__pic-wrapper">
										<img src="{{asset('public/admin/images/users/defaultuser.png')}}" alt=""/>
									</div>
								</div>
								<div class="m-card-profile__details">
									<span class="m-card-profile__name">
										{{$result_data[0]->first_name}} {{$result_data[0]->last_name}}
									</span>
									<a href="" class="m-card-profile__email m-link">
										{{$result_data[0]->email}}
									</a>
								</div>
							</div>
							<ul class="m-nav m-nav--hover-bg m-portlet-fit--sides">
								<li class="m-nav__separator m-nav__separator--fit"></li>
								<li class="m-nav__section m--hide">
									<span class="m-nav__section-text">
										Section
									</span>
								</li>
								<li class="m-nav__item">
									<a href="profile" class="m-nav__link">
										<i class="m-nav__link-icon flaticon-profile-1"></i>
										<span class="m-nav__link-title">
											<span class="m-nav__link-wrap">
												<span class="m-nav__link-text">
													My Profile
												</span>
												<!--<span class="m-nav__link-badge">
													<span class="m-badge m-badge--success"> 
														2
													</span>
												</span>-->
											</span>
										</span>
									</a>
								</li>
								<!--<li class="m-nav__item">
									<a href="profile&amp;demo=default.html" class="m-nav__link">
										<i class="m-nav__link-icon flaticon-share"></i>
										<span class="m-nav__link-text">
											Activity
										</span>
									</a>
								</li>
								<li class="m-nav__item">
									<a href="profile&amp;demo=default.html" class="m-nav__link">
										<i class="m-nav__link-icon flaticon-chat-1"></i>
										<span class="m-nav__link-text">
											Messages
										</span>
									</a>
								</li>
								<li class="m-nav__item">
									<a href="profile&amp;demo=default.html" class="m-nav__link">
										<i class="m-nav__link-icon flaticon-graphic-2"></i>
										<span class="m-nav__link-text">
											Sales
										</span>
									</a>
								</li>-->											
							</ul>
							<!--<div class="m-portlet__body-separator"></div>
							<div class="m-widget1 m-widget1--paddingless">
								<div class="m-widget1__item">
									<div class="row m-row--no-padding align-items-center">
										<div class="col-12">
											<h3 class="m-widget1__title">
												Member Profit
											</h3>														
										</div>
										<div class="col">
											<span class="m-widget1__desc">
												Awerage Weekly Profit
											</span>
										</div>
										<div class="col m--align-right">
											<span class="m-widget1__number m--font-brand">
												<i class="fa fa-inr" aria-hidden="true"></i> 17,800
											</span>
										</div>
									</div>
								</div>
								
							</div>-->
						</div>
					</div>
				</div>
				<div class="col-xl-9 col-lg-8">
					<div class="m-portlet m-portlet--full-height m-portlet--tabs  ">
						<div class="m-portlet__head">
							<div class="m-portlet__head-tools">
								<ul class="nav nav-tabs m-tabs m-tabs-line   m-tabs-line--left m-tabs-line--primary" role="tablist">
									<li class="nav-item m-tabs__item">
										<a class="nav-link m-tabs__link active" data-toggle="tab" href="#m_user_profile_tab_1" role="tab">
											<i class="flaticon-share m--hide"></i>
											Update Profile
										</a>
									</li>
									<!-- <li class="nav-item m-tabs__item">
										<a class="nav-link m-tabs__link" data-toggle="tab" href="#m_user_profile_tab_2" role="tab">
											Messages
										</a>
									</li>
									<li class="nav-item m-tabs__item">
										<a class="nav-link m-tabs__link" data-toggle="tab" href="#m_user_profile_tab_3" role="tab">
											Settings
										</a>
									</li> -->
								</ul>
							</div>
							
						</div>
						<div class="tab-content">
							<div class="tab-pane active" id="m_user_profile_tab_1">
								{{ Form::open(array('class' => 'm-form m-form--fit m-form--label-align-right','id' => 'id_profile_details','route' => 'update_profile_details')) }}
											<!--<form class="m-form m-form--fit m-form--label-align-right">  -->
									<div class="m-portlet__body">
										<div class="form-group m-form__group m--margin-top-10 m--hide">
											<div class="alert m-alert m-alert--default" role="alert">
												The example form below demonstrates common HTML form elements that receive updated styles from Bootstrap with additional classes.
											</div>
										</div>
										<div class="form-group m-form__group row">
											<div class="col-12 ml-auto headigbx">
												<h3 class="m-form__section">
													1. Personal Details
												</h3>
											</div>
										</div>
										<div class="form-group m-form__group row">
											<label for="example-text-input" class="col-3 col-form-label">
												Email
											</label>
											<div class="col-7">
												{{ Form::text('',$result_data[0]->email,array('class' => 'form-control m-input','placeholder' => 'Email','autocomplete' => 'off','readonly' => 'true')) }}
											</div>
										</div>
										<div class="form-group m-form__group row">
											<label for="example-text-input" class="col-3 col-form-label">
												Phone No.
											</label>
											<div class="col-7">
												{{ Form::text('',$result_data[0]->mobile,array('class' => 'form-control m-input','placeholder' => 'Phone No.','autocomplete' => 'off','readonly' => 'true')) }}
											</div>
										</div>
										<div class="form-group m-form__group row">
											<label for="example-text-input" class="col-3 col-form-label">
												First Name
											</label>
											<div class="col-7">
												{{ Form::text('first_name',$result_data[0]->first_name,array('class' => 'form-control m-input','placeholder' => 'First Name','autocomplete' => 'off')) }}
												<span class="text-danger"> {!! $errors->errormsg->first('first_name') !!} </span>
											</div>
										</div>
										<div class="form-group m-form__group row">
											<label for="example-text-input" class="col-3 col-form-label">
												Last Name
											</label>
											<div class="col-7">
												{{ Form::text('last_name',$result_data[0]->last_name,array('class' => 'form-control m-input','placeholder' => 'Last Name','autocomplete' => 'off')) }}
												<span class="text-danger"> {!! $errors->errormsg->first('last_name') !!} </span>
											</div>
										</div>
										<div class="form-group m-form__group row">
											<label for="example-text-input" class="col-3 col-form-label">
												Alternet Mobile No.
											</label>
											<div class="col-7">
												{{ Form::text('alternet_mobile_no',$result_data[0]->alternet_mobile_no,array('class' => 'form-control m-input','placeholder' => 'Alternet Mobile No','autocomplete' => 'off')) }}
												<span class="text-danger"> {!! $errors->errormsg->first('alternet_mobile_no') !!} </span>
											</div>
										</div>
										<!-- <div class="m-form__seperator m-form__seperator--dashed m-form__seperator--space-2x"></div>
										<div class="form-group m-form__group row">
											<div class="col-12 ml-auto headigbx">
												<h3 class="m-form__section">
													2. Address
												</h3>
											</div>
										</div>
										<div class="form-group m-form__group row">
											<label for="example-text-input" class="col-3 col-form-label">
												Address Line 1
											</label>
											<div class="col-7">
												{{-- Form::text('address_line1',$result_data['address_line1'],array('class' => 'form-control m-input','placeholder' => 'Address Line 1','autocomplete' => 'off')) --}}
											</div>
										</div>
										<div class="form-group m-form__group row">
											<label for="example-text-input" class="col-3 col-form-label">
												Address Line 2
											</label>
											<div class="col-7">
												{{-- Form::text('address_line2',$result_data['address_line2'],array('class' => 'form-control m-input','placeholder' => 'Address Line 2','autocomplete' => 'off')) --}}
											</div>
										</div>
										<div class="form-group m-form__group row">
											<label for="example-text-input" class="col-3 col-form-label">
												State
											</label>
											<div class="col-7">
												{{-- Form::select('state',$state_data,$result_data['state'],array('class' => ' m-input js-example-basic-multiple')) --}}
											</div>
										</div>
										<div class="form-group m-form__group row">
											<label for="example-text-input" class="col-3 col-form-label">
												City
											</label>
											<div class="col-7">
												{{-- Form::text('city',$result_data['city'],array('class' => 'form-control m-input','placeholder' => 'City','autocomplete' => 'off')) --}}
											</div>
										</div>
										<div class="form-group m-form__group row">
											<label for="example-text-input" class="col-3 col-form-label">
												Postcode
											</label>
											<div class="col-7">
												{{-- Form::number('pincode',$result_data['pincode'],array('class' => 'form-control m-input','placeholder' => 'Pincode','autocomplete' => 'off','oninput' => 'if(value.length>10)value=value.slice(0,10)')) --}}
											</div>
										</div> -->													
									</div>
									<div class="m-portlet__foot m-portlet__foot--fit">
										<div class="m-form__actions">
											<div class="row">
												<div class="col-2"></div>
												<div class="col-7">
													<button type="submit" class="btn btn-accent m-btn m-btn--custom purplebtn">
														Save changes
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
	
	<script type="text/javascript">
		
		$(document).ready(function() 
		{
			$(".js-example-basic-multiple").select2({
				placeholder: "Select a State",
			});
		}); 

	</script>

@endsection
