@extends('admin.layouts.header')
@section('title', 'Page Title')


@section('css')
	
	 <style>
      /* Always set the map height explicitly to define the size of the div element that contains the map. */
		#map { height: 100%; }
		html, body { height: 100%; margin: 0; padding: 0; }
		.controls { background-color: #fff; border-radius: 2px; border: 1px solid transparent; box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3); box-sizing: border-box; font-family: Roboto; font-size: 15px; font-weight: 300; height: 29px; margin-left: 17px; margin-top: 10px; outline: none; padding: 0 11px 0 13px; text-overflow: ellipsis; width: 400px; }
		.controls:focus { border-color: #4d90fe; }
		.title { font-weight: bold; }
		#infowindow-content { display: none; }
		#map #infowindow-content { display: inline; }
    </style>


@endsection


@section('content')
	<div class="m-grid__item m-grid__item--fluid m-wrapper">
    	<div class="m-subheader ">
			<div class="d-flex align-items-center">
				<div class="mr-auto">
					<h3 class="m-subheader__title ">
						Merchant Activation -> {{$result_data['label']}}
					</h3>
				</div>
			</div>
		</div>
		<!-- END: Subheader -->
		<div class="m-content">
			<div class="row">

				<?php  
					$add_document_type = '';
                    $add_proof_img = '';
                    $ifsc_code_img = '';
                    $vat_no_img = '';
                    $pan_no_img = '';
                    $last_bank_statement_img = "";
                    $shop_establishment_license_img = "";
                    $shop_interior = '';
                    $shop_entrance = '';
                    $shop_interior_1 = '';
                    $shop_interior_2 = '';
                    $shop_interior_3 = '';
				?>


				{!! \Helpers::show_message() !!}
					
					@if ($result_data['is_registration_completed'] == 0) 

					<div class="col-12">
						<div class="progressbx">
							<div class="progress">
								  <div class="progress-bar" role="progressbar" aria-valuenow="{{$form_progress}}"
								  aria-valuemin="0" aria-valuemax="100" style="width:{{$form_progress}}">
									{{$form_progress}}
								  </div>
							</div>
						</div>
					</div>					
					<div class="col-xl-12 col-lg-12">
						<div class="m-portlet m-portlet--full-height m-portlet--tabs  ">
							<div class="m-portlet__head">
								<div class="m-portlet__head-tools">
									<ul class="nav nav-tabs m-tabs m-tabs-line   m-tabs-line--left m-tabs-line--primary" role="tablist">
										<li class="nav-item m-tabs__item">
											<a class="nav-link m-tabs__link {{ $type == 'store_details'?'active':'' }}" data-toggle="tab" href="#store_details" role="tab">											
												Store Details
											</a>
										</li>
										
										<li class="nav-item m-tabs__item">
											<a class="nav-link m-tabs__link {{ $type == 'kyc_details'?'active':'' }}" data-toggle="tab" href="#kyc_details" role="tab">
												Kyc Details
											</a>
										</li>
										<li class="nav-item m-tabs__item">
											<a class="nav-link m-tabs__link {{ $type == 'upload_documents'?'active':'' }}" data-toggle="tab" href="#upload_documents" role="tab">
												Upload Documents 
											</a>
										</li>
										<li class="nav-item m-tabs__item">
											<a class="nav-link m-tabs__link {{ $type == 'location'?'active':'' }}" data-toggle="tab" href="#location" role="tab">
												Location 
											</a>
										</li>
										<li class="nav-item m-tabs__item">
											<a class="nav-link m-tabs__link {{ $type == 'categories'?'active':'' }}" data-toggle="tab" href="#categories" role="tab">
												Categories 
											</a>
										</li>
										<li class="nav-item m-tabs__item">
											<a class="nav-link m-tabs__link {{ $type == 'submit_form'?'active':'' }}" data-toggle="tab" href="#submit_form" role="tab">
												Submit Form 
											</a>
										</li>
									</ul>
								</div>							
							</div>
							<div class="tab-content">
								<div class="tab-pane {{ $type == 'store_details'?'active':'' }}" id="store_details">
									{{ Form::open(array('class' => 'm-form m-form--fit m-form--label-align-right','id' => 'id_store_details','route' => 'get_merchant_activation_data')) }}
										<!--<form class="m-form m-form--fit m-form--label-align-right">-->
											<div class="m-portlet__body">										
												<div class="form-group m-form__group row">
													<div class="col-12 ml-auto headigbx">
														<h3 class="m-form__section">
															Store Details
														</h3>
													</div>
												</div>
												
												<div class="form-group m-form__group row">
													<label for="example-text-input" class="col-4 col-form-label">
														Store Name<span style="color:red">*</span>
													</label>
													<div class="col-7">
														<!--<input class="form-control m-input" type="text" value="" placeholder="Store Name">-->
														{{ Form::text('reg_business_name',$result_data['label'],array('class' => 'form-control m-input','placeholder' => 'Store Name','autocomplete' => 'off')) }}
													</div>
												</div> 
																						
												<div class="form-group m-form__group row">
													<label for="example-text-input" class="col-4 col-form-label">
														Business Type<span style="color:red">*</span>
													</label>
													<div class="col-7">
														{{ Form::select('regbusinesstype',array('' => 'Select Business Type', 'Sole Proprietorship' => 'Sole Proprietorship', 'Public Limited' => 'Public Limited', 'Private Limited' => 'Private Limited', 'Partnership' => 'Partnership','Self Employed' => 'Self Employed','Others' => 'Others'),$result_data['business_type'],array('class' => 'form-control form-control2 m-input')) }}
													</div>
												</div>
												<div class="form-group m-form__group row">
													<label for="example-text-input" class="col-4 col-form-label">
														Business Address 1
													</label>
													<div class="col-7">
														{{ Form::text('reg_business_add1',$result_data['address_line1'],array('class' => 'form-control m-input business_field','id' => 'id_business_address_line2','placeholder' => 'Business Address 1','autocomplete' => 'off')) }}
													</div>
												</div>
												<div class="form-group m-form__group row">
													<label for="example-text-input" class="col-4 col-form-label">
														Business Address 2
													</label>
													<div class="col-7">
														{{ Form::text('reg_business_add2',$result_data['address_line2'],array('class' => 'form-control m-input business_field','id' => 'id_business_address_line2','placeholder' => 'Business Address 2','autocomplete' => 'off')) }}
													</div>
												</div>
													
												<div class="form-group m-form__group row">
													<label for="example-text-input" class="col-4 col-form-label">
														Pincode<span style="color:red">*</span>
													</label>
													<div class="col-7">
														<!--<input class="form-control m-input" type="text" value="" placeholder="Pincode">-->
														{{ Form::number('reg_business_pincode',$result_data['pincode'],array('class' => 'form-control m-input business_field','placeholder' => 'Pincode','autocomplete' => 'off','oninput' => 'if(value.length>10)value=value.slice(0,10)','id' => 'id_business_pincode')) }}
													</div>
												</div>
													
													
												{{ Form::hidden('type','store_details') }}								
												{{ Form::hidden('id',$result_data['merchant_id']) }}								
											</div>
											<div class="m-portlet__foot m-portlet__foot--fit">
												<div class="m-form__actions">
													<div class="row">												
														<div class="col-12">
															<div class="activitybtnbx">
																<button type="submit" class="btn btn-accent m-btn m-btn--air m-btn--custom purplebtn">
																	Next
																</button>
																<!--&nbsp;&nbsp;
																<button type="reset" class="btn btn-secondary m-btn m-btn--air m-btn--custom">
																	Cancel
																</button>-->
															</div>
														</div>
													</div>
												</div>
											</div>
										<!--</form>	-->
										{{ Form::close() }}						
								</div>
								
								<div class="tab-pane {{ $type == 'kyc_details'?'active':'' }}" id="kyc_details">
									{{ Form::open(array('class' => 'm-form m-form--fit m-form--label-align-right','id' => 'id_kyc_details','route' => 'get_merchant_activation_data')) }}
									<!--<form class="m-form m-form--fit m-form--label-align-right">-->
										<div class="m-portlet__body">										
											<div class="form-group m-form__group row">
												<div class="col-12 ml-auto headigbx">
													<h3 class="m-form__section">
														Kyc Details
													</h3>
												</div>
											</div>
											<div class="form-group m-form__group row">											
												<label for="example-text-input" class="col-4 col-form-label">
													Pan No<span style="color:red">*</span>
												</label>
												<div class="col-7">
													{{ Form::text('pan_no',$result_data['pan_number'],array('class' => 'form-control m-input','placeholder' => 'Pan No','autocomplete' => 'off','oninput' => 'if(value.length>10)value=value.slice(0,10)','style' => 'text-transform:uppercase')) }}
												</div>
											</div>
											<div class="form-group m-form__group row">											
												<label for="example-text-input" class="col-4 col-form-label">
													Beneficiary Name<span style="color:red">*</span>
												</label>
												<div class="col-7">
													{{ Form::text('beneficiary_name',$result_data['account_holder_name'],array('class' => 'form-control m-input','placeholder' => 'Beneficiary Name','autocomplete' => 'off')) }}
												</div>
											</div>
											<div class="form-group m-form__group row">
												<label for="example-text-input" class="col-4 col-form-label">
													Bank Name<span style="color:red">*</span>
												</label>
												<div class="col-7">
													
													{{ Form::text('bank_name',$result_data['bank_name'],array('class' => 'form-control m-input','placeholder' => 'Bank Name','autocomplete' => 'off')) }}

												</div>
											</div>
											<div class="form-group m-form__group row">											
												<label for="example-text-input" class="col-4 col-form-label">
													Branch Name<span style="color:red">*</span>
												</label>
												<div class="col-7">
													{{ Form::text('baranch_name',$result_data['bank_branch'],array('class' => 'form-control m-input','placeholder' => 'Branch Name','autocomplete' => 'off')) }}
												</div>
											</div>	
											<div class="form-group m-form__group row">
												<label for="example-text-input" class="col-4 col-form-label">
													Account Number<span style="color:red">*</span>
												</label>
												<div class="col-7">
													{{ Form::number('account_no',$result_data['bank_account_number'],array('class' => 'form-control m-input','placeholder' => 'Account Number','autocomplete' => 'off')) }}											
												</div>
											</div>							
											<div class="form-group m-form__group row">											
												<label for="example-text-input" class="col-4 col-form-label">
													IFSC Code<span style="color:red">*</span>
												</label>
												<div class="col-7">
													{{ Form::text('ifsc_code',$result_data['bank_ifsc_code'],array('class' => 'form-control m-input','placeholder' => 'IFSC Code','autocomplete' => 'off','style' => 'text-transform:uppercase')) }}
												</div>
											</div>	
											<div class="form-group m-form__group row">											
												<label for="example-text-input" class="col-4 col-form-label">
													VAT / TIN No<span style="color:red">*</span>
												</label>
												<div class="col-7">
													{{ Form::text('vat_no',$result_data['vat_number'],array('class' => 'form-control m-input','placeholder' => 'VAT / TIN No','autocomplete' => 'off','style' => 'text-transform:uppercase')) }}
												</div>
											</div>  	
											{{ Form::hidden('type','kyc_details') }}
										</div>
										<div class="m-portlet__foot m-portlet__foot--fit">
											<div class="m-form__actions">
												<div class="row">												
													<div class="col-12">
														<div class="activitybtnbx">
															<button type="submit" class="btn btn-accent m-btn m-btn--air m-btn--custom purplebtn">
																Next
															</button>
															<!--&nbsp;&nbsp;
															<button type="reset" class="btn btn-secondary m-btn m-btn--air m-btn--custom">
																Cancel
															</button>-->
														</div>
													</div>
												</div>
											</div>
										</div>
									<!--</form>	-->
									{{ Form::close() }}
								</div>
							
								<div class="tab-pane {{ $type == 'upload_documents'?'active':'' }}" id="upload_documents">
									{{ Form::open(array('class' => 'm-form m-form--fit m-form--label-align-right','id' => 'id_merchant_upload_documents','route' => 'get_merchant_activation_data','enctype' => 'multipart/form-data')) }}
									<!--<form class="m-form m-form--fit m-form--label-align-right">-->
										
										
										<?php

													$add_document_type = '';
                                                    $add_proof_img = '';
                                                    $ifsc_code_img = '';
                                                    $vat_no_img = '';
                                                    $pan_no_img = '';
                                                    $shop_interior = '';
                                                    $shop_entrance = '';
                                                    $shop_interior_1 = '';
                                                    $shop_interior_2 = '';
                                                    $shop_interior_3 = '';

                                                    for ($i = 0; $i < count($merchant_doc); $i++) {
                                                        if (isset($merchant_doc[$i]['document_category'])) {
                                                            if ($merchant_doc[$i]['document_category'] == 11) {
                                                                $ifsc_code_img = $merchant_doc[$i]['document_url'];
                                                            } if ($merchant_doc[$i]['document_category'] == 2) {
                                                                $add_proof_img = $merchant_doc[$i]['document_url'];
                                                                $add_document_type = $merchant_doc[$i]['document_type'];
                                                            } if ($merchant_doc[$i]['document_category'] == 31) {
                                                                $vat_no_img = $merchant_doc[$i]['document_url'];
                                                            } if ($merchant_doc[$i]['document_category'] == 9) {
                                                                $pan_no_img = $merchant_doc[$i]['document_url'];
                                                            }

                                                            if ($merchant_doc[$i]['document_category'] == 29) {
                                                                $last_bank_statement_img = $merchant_doc[$i]['document_url'];
                                                            }
                                                            if ($merchant_doc[$i]['document_category'] == 32) {
                                                                $shop_establishment_license_img = $merchant_doc[$i]['document_url'];
                                                            }
                                                            if ($merchant_doc[$i]['document_type'] == 108) {
                                                                $shop_interior = $merchant_doc[$i]['document_url'];
                                                            }
                                                            if ($merchant_doc[$i]['document_type'] == 109) {
                                                                $shop_entrance = $merchant_doc[$i]['document_url'];
                                                            }
                                                            if ($merchant_doc[$i]['document_type'] == 110) {
                                                                $shop_interior_1 = $merchant_doc[$i]['document_url'];
                                                            }
                                                            if ($merchant_doc[$i]['document_type'] == 111) {
                                                                $shop_interior_2 = $merchant_doc[$i]['document_url'];
                                                            }
                                                            if ($merchant_doc[$i]['document_type'] == 115) {
                                                                $shop_interior_3 = $merchant_doc[$i]['document_url'];
                                                            }
                                                        }
                                                    }

										?>

										<div class="m-portlet__body">


											<div class="form-group m-form__group row">
												<div class="col-12 ml-auto headigbx">
													<h3 class="m-form__section">
														Upload Documents
													</h3>
												</div>
											</div>
											<div class="form-group m-form__group row">											
												<label for="example-text-input" class="col-4 col-form-label">
													Upload Pan Image
													@if ($ifsc_code_img == "")
														<span style="color:red">*</span>
													@endif
												</label>
												<div class="col-7">
													<div class="uploadmainbx">
														<!--<input type="file">-->
														
														<!--<input class="form-control uploadfile1" type="text">-->
														{{ Form::text('',null,array('class' => 'form-control uploadfile1')) }}
														<input class="btn uploadbtn" type="button" value="select file">
														{{ Form::file('pan_no_img') }}
													</div>
												</div>
                                                                                                @if ($pan_no_img != "")
                                                                                                    <a href="{{ $pan_no_img }}" target="_blank" title="View" class="btn btn-info document-visiblebtn"><i class="flaticon-visible"></i></a>
                                                                                                @endif
											</div>
											
											<div class="form-group m-form__group row">											
												<label for="example-text-input" class="col-4 col-form-label">
													Upload Cancelled Cheque Image
													@if ($ifsc_code_img == "")
                                                        <span style="color:red">*</span>
                                                    @endif
												</label>
												<div class="col-7">
													<div class="uploadmainbx">
														<!--<input type="file">-->
														
														<!--<input class="form-control uploadfile1" type="text">-->
														{{ Form::text('',null,array('class' => 'form-control uploadfile1')) }}
														<input class="btn uploadbtn" type="button" value="select file">
														{{ Form::file('ifsc_code_img') }}
													</div>
												</div>
												@if ($ifsc_code_img != "")
													<a href="{{ $ifsc_code_img }}" target="_blank" title="View" class="btn btn-info document-visiblebtn"><i class="flaticon-visible"></i></a>
												@endif
											</div>
											<!--<div class="form-group m-form__group row">											
												<label for="example-text-input" class="col-4 col-form-label">
													Address proof of business address
												</label>
												<div class="col-3">
													<select class="form-control form-control2 m-input">
														<option value="">Select</option>
														<option value="9">Passport</option>
														<option value="10" selected="selected">Voter ID Card</option>
														<option value="11">Aadhar Card Back</option>
														<option value="12">Telephone / Mobile (Postpaid) Bill</option>
														<option value="13">Electricity Bill</option>
														<option value="14">Water Bill</option>
														<option value="15">Gas Bill</option>
														<option value="16">Insurance Premium Receipt</option>
														<option value="17">Rent/Lease Agreement</option>
														<option value="35">Drivers License</option>
													</select>
												</div>
												<div class="col-4">
													<div class="uploadmainbx">
														<input type="file">
														<input class="form-control uploadfile1" type="text">
														<input class="btn uploadbtn" type="button" value="select file">
													</div>												
												</div>
											</div>-->
											<div class="form-group m-form__group row">											
												<label for="example-text-input" class="col-4 col-form-label">
													Address proof of business address
													@if ($add_proof_img == "")
                                                        <span style="color:red">*</span>
                                                    @endif
												</label>
												<div class="col-3">
													{{ Form::select('add_document_type',$documents_data[2],$add_document_type,array('class' => ' m-input js-example-basic-multiple')) }}	
												</div>
												<div class="col-4">
													<div class="uploadmainbx">
														<!--<input type="file">-->
														
														<!--<input class="form-control uploadfile1" type="text">-->
														{{ Form::text('',null,array('class' => 'form-control uploadfile1')) }}
														<input class="btn uploadbtn" type="button" value="select file">
														{{ Form::file('add_proof_img') }}
													</div>                                             
												</div>
												@if ($add_proof_img != "")
													<a href="{{ $add_proof_img }}" target="_blank" title="View" class="btn btn-info document-visiblebtn"><i class="flaticon-visible"></i></a>
												@endif
											</div>
											<div class="form-group m-form__group row">											
												<label for="example-text-input" class="col-4 col-form-label">
													Last 3 Months Bank Statement
													@if ($last_bank_statement_img == "")
                                                        <span style="color:red">*</span>
                                                    @endif
												</label>
												<div class="col-7">
													<div class="uploadmainbx">
														<!--<input type="file">-->
														
														<!--<input class="form-control uploadfile1" type="text">-->
														{{ Form::text('',null,array('class' => 'form-control uploadfile1')) }}
														<input class="btn uploadbtn" type="button" value="select file">
														{{ Form::file('last_bank_statement_img') }}
													</div>
												</div>
												@if ($last_bank_statement_img != "")
													<a href="{{ $last_bank_statement_img }}" target="_blank" title="View" class="btn btn-info document-visiblebtn"><i class="flaticon-visible"></i></a>
												@endif
											</div>
											<div class="form-group m-form__group row">											
												<label for="example-text-input" class="col-4 col-form-label">
													Shop Establishment License
													@if ($shop_establishment_license_img == "")
                                                        <span style="color:red">*</span>
                                                    @endif
												</label>
												<div class="col-7">
													<div class="uploadmainbx">
														<!--<input type="file">-->
														
														<!--<input class="form-control uploadfile1" type="text">-->
														{{ Form::text('',null,array('class' => 'form-control uploadfile1')) }}
														<input class="btn uploadbtn" type="button" value="select file">
														{{ Form::file('shop_establishment_license_img') }}
													</div>
												</div>  
												@if ($shop_establishment_license_img != "") 
													<a href="{{ $shop_establishment_license_img }}" target="_blank" title="View" class="btn btn-info document-visiblebtn"><i class="flaticon-visible"></i></a>
												@endif
											</div>	
											<div class="form-group m-form__group row">											
												<label for="example-text-input" class="col-4 col-form-label">
													Shop Interior
													@if ($shop_interior == "")
                                                        <span style="color:red">*</span>
                                                    @endif
												</label>
												<div class="col-7">
													<div class="uploadmainbx">
														<!--<input type="file">-->
														
														<!--<input class="form-control uploadfile1" type="text">-->
														{{ Form::text('',null,array('class' => 'form-control uploadfile1','placeholder' => 'Shop Interior(Store Photos)')) }}
														<input class="btn uploadbtn" type="button" value="select file">
														{{ Form::file('shop_interior') }}
													</div>
												</div>  
												@if ($shop_interior != "") 
													<a href="{{ $shop_interior }}" target="_blank" title="View" class="btn btn-info document-visiblebtn"><i class="flaticon-visible"></i></a>
												@endif
											</div>
											<div class="form-group m-form__group row">											
												<label for="example-text-input" class="col-4 col-form-label">
													Shop Entrance
													@if ($shop_entrance == "")
                                                        <span style="color:red">*</span>
                                                    @endif
												</label>
												<div class="col-7">
													<div class="uploadmainbx">
														<!--<input type="file">-->
														
														<!--<input class="form-control uploadfile1" type="text">-->
														{{ Form::text('',null,array('class' => 'form-control uploadfile1','placeholder' => 'Shop Entrance(Store Photos)')) }}
														<input class="btn uploadbtn" type="button" value="select file">
														{{ Form::file('shop_entrance') }}
													</div>
												</div>  
												@if ($shop_entrance != "") 
													<a href="{{ $shop_entrance }}" target="_blank" title="View" class="btn btn-info document-visiblebtn"><i class="flaticon-visible"></i></a>
												@endif
											</div>
											<div class="form-group m-form__group row">											
												<label for="example-text-input" class="col-4 col-form-label">
													Shop Interior 1 
													@if ($shop_interior_1 == "")
                                                        <span style="color:red">*</span>
                                                    @endif
												</label>
												<div class="col-7">
													<div class="uploadmainbx">
														<!--<input type="file">-->
														
														<!--<input class="form-control uploadfile1" type="text">-->
														{{ Form::text('',null,array('class' => 'form-control uploadfile1','placeholder' => 'Shop Interior 1(Store Photos)')) }}
														<input class="btn uploadbtn" type="button" value="select file">
														{{ Form::file('shop_interior_1') }}
													</div>
												</div>  
												@if ($shop_interior_1 != "") 
													<a href="{{ $shop_interior_1 }}" target="_blank" title="View" class="btn btn-info document-visiblebtn"><i class="flaticon-visible"></i></a>
												@endif
											</div>
											<div class="form-group m-form__group row">											
												<label for="example-text-input" class="col-4 col-form-label">
													Shop Interior 2 
													@if ($shop_interior_2 == "")
                                                        <span style="color:red">*</span>
                                                    @endif
												</label>
												<div class="col-7">
													<div class="uploadmainbx">
														<!--<input type="file">-->
														
														<!--<input class="form-control uploadfile1" type="text">-->
														{{ Form::text('',null,array('class' => 'form-control uploadfile1','placeholder' => 'Shop Interior 2(Store Photos)')) }}
														<input class="btn uploadbtn" type="button" value="select file">
														{{ Form::file('shop_interior_2') }}
													</div>
												</div>  
												@if ($shop_interior_2 != "") 
													<a href="{{ $shop_interior_2 }}" target="_blank" title="View" class="btn btn-info document-visiblebtn"><i class="flaticon-visible"></i></a>
												@endif
											</div>
											<div class="form-group m-form__group row">											
												<label for="example-text-input" class="col-4 col-form-label">
													Shop Interior 3 
													@if ($shop_interior_3 == "")
                                                        <span style="color:red">*</span>
                                                    @endif
												</label>
												<div class="col-7">
													<div class="uploadmainbx">
														<!--<input type="file">-->
														
														<!--<input class="form-control uploadfile1" type="text">-->
														{{ Form::text('',null,array('class' => 'form-control uploadfile1','placeholder' => 'Shop Interior 3(Store Photos)')) }}
														<input class="btn uploadbtn" type="button" value="select file">
														{{ Form::file('shop_interior_3') }}
													</div>
												</div>  
												@if ($shop_interior_3 != "") 
													<a href="{{ $shop_interior_3 }}" target="_blank" title="View" class="btn btn-info document-visiblebtn"><i class="flaticon-visible"></i></a>
												@endif
											</div>
											{{ Form::hidden('type','upload_documents') }}																											
										</div>
										<div class="m-portlet__foot m-portlet__foot--fit">
											<div class="m-form__actions">
												<div class="row">												
													<div class="col-12">
														<div class="activitybtnbx">
															<button type="submit" class="btn btn-accent m-btn m-btn--air m-btn--custom purplebtn">
																Next
															</button>
															<!--&nbsp;&nbsp;
															<button type="reset" class="btn btn-secondary m-btn m-btn--air m-btn--custom">
																Cancel
															</button>-->
														</div>
													</div>
												</div>
											</div>
										</div>
									<!--</form>	-->
									{{ Form::close() }}
								</div>

								<div class="tab-pane {{ $type == 'location'?'active':'' }}" id="location">
									{{ Form::open(array('class' => 'm-form m-form--fit m-form--label-align-right','id' => 'id_location','route' => 'get_merchant_activation_data')) }}
									<!--<form class="m-form m-form--fit m-form--label-align-right">-->
										<div class="m-portlet__body">
											<div class="mapmainbx">
												<div class="form-group m-form__group row">
													<div class="col-12 ml-auto headigbx">
														<h3 class="m-form__section">
															Store Location
														</h3>
													</div>
												</div>
												<div class="form-group m-form__group row">	
													<!--<form class="form-inline margin-bottom-10 mapfindbx" action="#">-->
														<div class="input-group">
															<!--<input type="text" name="location_address" class="form-control" id="pac-input" placeholder="address...">-->

															{{ Form::text('location_address',null,array('class' => 'form-control','id' => 'pac-input','placeholder' => 'address...')) }}

															<!--<span class="input-group-btn">
																<button class="btn btn-primary locationsearchbtn" id="m_gmap_8_btn">
																	<i class="fa fa-search"></i>
																</button>
															</span>-->
														</div>
														{{ Form::hidden('latitude',null,array('class' => 'form-control uploadfile1','id' => 'id_latitude')) }}
														{{ Form::hidden('longitude',null,array('class' => 'form-control uploadfile1','id' => 'id_longitude')) }}
													<!--</form>-->
													<div id="map" style="width:100%; height:350px;"></div>
													
												</div>
												{{ Form::hidden('type','location') }}
											</div>
										</div>
										<div class="m-portlet__foot">
											<div class="m-form__actions">
												<div class="row">												
													<div class="col-12">
														<div class="activitybtnbx">
															<button type="button" id="id_submit_location" class="btn btn-accent m-btn m-btn--air m-btn--custom purplebtn">
																Next
															</button>
															<!--&nbsp;&nbsp;
															<button type="reset" class="btn btn-secondary m-btn m-btn--air m-btn--custom">
																Cancel
															</button>-->
														</div>
													</div>
												</div>
											</div>
										</div>
									<!--</form>-->
									{{ Form::close() }}
								</div>

								<div class="tab-pane {{ $type == 'categories'?'active':'' }}" id="categories">
									{{ Form::open(array('class' => 'm-form m-form--fit m-form--label-align-right','id' => 'id_categories','route' => 'get_merchant_activation_data')) }}
										<div class="m-portlet__body">										
											<div class="form-group m-form__group row">
												<div class="col-12 ml-auto headigbx">
													<h3 class="m-form__section">
														Store Category{{$result_data['merchant_id']}}
													</h3>
												</div>
											</div>
											@php

												$merchant_cat_arr = $category_data['DATA'];

                                                $mid_count = round(count($merchant_cat_arr) / 2);
											@endphp
											<div class="form-group m-form__group row">
												<h5 class="selectcatetrans">Select category for transaction*</h5>
											</div>
											<div class="form-group m-form__group row">
												<div class="col-6">
													<div class="table-responsive categories-table">
														<table border="0" cellpadding="0" cellspacing="0">
															<tr>
																<th>No</th>
																<th>Category Name</th>
																<th>Status</th>
															</tr> 
															@for($i = 0;$i < $mid_count; $i++)
																@php $value = $merchant_cat_arr[$i]; @endphp
																<tr>
																	<td>{{($i + 1)}}</td>
																	<td>{{$value['collateral_name']}}</td>
																	<td>
																		<div class="m-checkbox-list activecheck">									
																			<label class="m-checkbox m-checkbox--state-brand checkaccepttxt1">
																				<input type="checkbox" name="categorycheck[]" id="categorycheck[]" class="class_categorycheck" value="<?php echo $value['collateral_name']; ?>" <?php echo (($result_data['merchant_id'] == $value['merchant_id']) && ($value['is_active'] == '1')) ? "checked" : ""; ?>>		
																																
																				<span></span>
																			</label>	 								
																		</div>
																	</td>
																</tr>
															@endfor
														</table>
													</div>												
												</div>
												<div class="col-6">
													<div class="table-responsive categories-table">
														<table border="0" cellpadding="0" cellspacing="0">
															<tr>
																<th>No</th>
																<th>Category Name</th>
																<th>Status</th>
															</tr>
															@for($i = $mid_count;$i < count($merchant_cat_arr); $i++)
																@php $value = $merchant_cat_arr[$i]; @endphp
															<tr>
																<td>{{($i + 1)}}</td>
																<td>{{$value['collateral_name']}}</td>
																<td>
																	<div class="m-checkbox-list activecheck">									
																		<label class="m-checkbox m-checkbox--state-brand checkaccepttxt1">
																			<input type="checkbox" name="categorycheck[]" id="categorycheck[]" class="class_categorycheck" value="<?php echo $value['collateral_name']; ?>" <?php echo (($result_data['merchant_id'] == $value['merchant_id']) && ($value['is_active'] == '1')) ? "checked" : ""; ?>>		
																																
																			<span></span>
																		</label>									
																	</div>
																</td>
															</tr>
															@endfor
														</table>
													</div>
												</div>											
											</div>
										</div>
										{{ Form::hidden('type','categories') }}
										<div class="m-portlet__foot m-portlet__foot--fit">
											<div class="m-form__actions">
												<center><span><font color="red">Select atleast one category.</font></span></center>
												<br>
												<div class="row">												
													<div class="col-12">
														<div class="activitybtnbx">
															<button type="submit" class="btn btn-accent m-btn m-btn--air m-btn--custom purplebtn">
																Next
															</button>
															<!--&nbsp;&nbsp;
															<button type="reset" class="btn btn-secondary m-btn m-btn--air m-btn--custom">
																Cancel
															</button>-->
														</div>
													</div>
												</div>
											</div>
										</div>
									<!--</form>	-->
									{{ Form::close() }}								
								</div>
								
								<div class="tab-pane {{ $type == 'submit_form'?'active':'' }}" id="submit_form">
									{{ Form::open(array('class' => 'm-form m-form--fit m-form--label-align-right','id' => 'id_merchant_submit_form','route' => 'get_merchant_activation_data')) }}
									<!--<form class="m-form m-form--fit m-form--label-align-right">-->
										<div class="m-portlet__body">								
											<div class="form-group m-form__group row">
												<div class="col-12 ml-auto headigbx">
													<h3 class="m-form__section">
														Store Location
													</h3>
												</div>
											</div>
											<div class="form-group m-form__group row">	
												<div class="m-checkbox-list">									
													<label class="m-checkbox m-checkbox--state-brand checkaccepttxt1">
														<!--<input type="checkbox" >-->
														{{ Form::checkbox('agree_terms','agree_terms') }}
														I have read and understood the terms and conditions,the franchise agreement, and the privacy policy and agree to abide by them at all times.
														<span></span>
													</label>									
												</div>										
											</div>
											{{ Form::hidden('type','submit_form') }}
										</div>
										<div class="m-portlet__foot">
											<div class="m-form__actions">
												<div class="row">												
													<div class="col-12">
														<div class="activitybtnbx">
															<button type="submit" class="btn btn-accent m-btn m-btn--air m-btn--custom purplebtn">
																SUBMIT
															</button>
															<!--&nbsp;&nbsp;
															<button type="reset" class="btn btn-secondary m-btn m-btn--air m-btn--custom">
																Cancel
															</button>-->
														</div>
													</div>
												</div>
											</div>
										</div>
									<!--</form>	-->
									{{ Form::close() }}
								</div>
								
							</div>
						</div>
					</div>
				
					@else

					<div class="m-grid__item m-grid__item--fluid m-wrapper activationmainbx">
						<div class="m-content m-portlet">
							<div class="m-portlet--full-height">								
								<div class="activation-sucessbx">									
									<h3>Dear Merchant !!</h3>
									<p>Your merchant application is currently being processed by our OnBoarding team. If we require any additional information or documents from you, our team will be reaching out to you. </p>
									<p>Once your application is approved, you will receive notification from us and you will be able to start transactions for your customers. </p>
									<div class="thankstxtbx">
										<div class="thankstxt1">Sincerely,</div>
										<div class="thankstxt2">The Kissht Team</div>
									</div>
								</div>
								
							</div>
						</div>

						
						
					</div>
					@endif

			</div>
		</div>
		

	</div>

	<script type="text/javascript">
		
		//This code for set not required upload documents of self employeed
		if("<?php echo $result_data['business_type'] ?>" == "Self Employed")
		{
			required = false; 
		}

		if("<?php echo $pan_no_img ?>" != "")
		{
			pan_no_img = false;
		}

		if("<?php echo $ifsc_code_img ?>" != "")
		{
			ifsc_code_img = false;
		}

		if("<?php echo $add_proof_img ?>" != "")
		{
			add_proof_img = false;
		}

		if("<?php echo $last_bank_statement_img ?>" != "")
		{
			last_bank_statement_img = false;
		}

		if("<?php echo $shop_establishment_license_img ?>" != "")
		{
			shop_establishment_license_img = false;
		}
		if("<?php echo $shop_interior ?>" != "")
		{
			shop_interior = false;
		}
		if("<?php echo $shop_entrance ?>" != "")
		{
			shop_entrance = false;
		}
		if("<?php echo $shop_interior_1 ?>" != "")
		{
			shop_interior_1 = false;
		}
		if("<?php echo $shop_interior_2 ?>" != "")
		{
			shop_interior_2 = false;
		}
		if("<?php echo $shop_interior_3 ?>" != "")
		{
			shop_interior_3 = false;
		}

		// alert(required);
	</script>


@endsection


@section('script')
	<script type="text/javascript">
		$(document).ready(function(){
			$('.uploadmainbx input[type="file"]').change(function(e){
				$(this).siblings('input[type="text"]').val(e.target.files[0].name);
			});
		});
	</script>
	
	
	<!-- <script src="//maps.google.com/maps/api/js?key=AIzaSyDBGVDv5fOFgfW4ixNZL_2krgkriGu6vvc" type="text/javascript"></script> -->
	<!--<script src="{{asset('public/admin/js/gmaps1.js')}}" type="text/javascript"></script>-->
	<!--end::Page Vendors -->
	<!--begin::Page Resources -->
	<!--<script src="{{asset('public/admin/js/google-maps.js')}}" type="text/javascript"></script>-->
	<!--end::Page Resources -->

	<!--begin::Validation form -->
	
	<!--end::Validation form -->


	<script type="text/javascript">
		
		$(document).ready(function() 
		{
			$(".js-example-basic-multiple").select2({
				placeholder: "Select one",
			});
		}); 

	</script>


   
    <script>
     // This example adds a search box to a map, using the Google Place Autocomplete
      // feature. People can enter geographical searches. The search box will return a
      // pick list containing a mix of places and predicted search terms.

      // This example requires the Places library. Include the libraries=places
      // parameter when you first load the API. For example:
      // <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">
      /*
      function initAutocomplete() {
        var map = new google.maps.Map(document.getElementById('map'), {
          center: {lat: -33.8688, lng: 151.2195},
          zoom: 13,
          mapTypeId: 'roadmap'
        });
        var geocoder = new google.maps.Geocoder();
        // Create the search box and link it to the UI element.
        var input = document.getElementById('pac-input');
        var searchBox = new google.maps.places.SearchBox(input);
        map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

        // Bias the SearchBox results towards current map's viewport.
        map.addListener('bounds_changed', function() {
          searchBox.setBounds(map.getBounds());
        });

        var markers = [];
        // Listen for the event fired when the user selects a prediction and retrieve
        // more details for that place.
        searchBox.addListener('places_changed', function() {
          var places = searchBox.getPlaces();

          if (places.length == 0) {
            return;
          }

          // Clear out the old markers.
          markers.forEach(function(marker) {
            marker.setMap(null);
          });
          markers = [];

          // For each place, get the icon, name and location.
          var bounds = new google.maps.LatLngBounds();
          places.forEach(function(place) {
            if (!place.geometry) {
              console.log("Returned place contains no geometry");
              return;
            }
            var icon = {
              url: place.icon,
              size: new google.maps.Size(71, 71),
              origin: new google.maps.Point(0, 0),
              anchor: new google.maps.Point(17, 34),
              scaledSize: new google.maps.Size(25, 25)
            };

            // Create a marker for each place.
            markers.push(new google.maps.Marker({
              map: map,
              icon: icon,
              title: place.name,
              position: place.geometry.location
            }));

            if (place.geometry.viewport) {
              // Only geocodes have viewport.
              bounds.union(place.geometry.viewport);
            } else {
              bounds.extend(place.geometry.location);
            }
          });
          map.fitBounds(bounds);
        });

        google.maps.event.addListener(map, 'click', function(event) {
          geocoder.geocode({
            'latLng': event.latLng
          }, function(results, status) {
            if (status == google.maps.GeocoderStatus.OK) {
              if (results[0]) {
                console.log(results);
                alert("Latitude: "+results[0].geometry.location.lat());
      			alert("Longitude: "+results[0].geometry.location.lng());
              }
            }
          });
      });

      }
      */

     /* var geocoder;
var map;
var marker;
var infowindow = new google.maps.InfoWindow({
  size: new google.maps.Size(150, 50)
});

function initialize() {
  geocoder = new google.maps.Geocoder();
  var latlng = new google.maps.LatLng(-34.397, 150.644);
  var mapOptions = {
    zoom: 8,
    center: latlng,
    mapTypeId: google.maps.MapTypeId.ROADMAP
  }
  map = new google.maps.Map(document.getElementById('map'), mapOptions);
  google.maps.event.addListener(map, 'click', function() {
    infowindow.close();
  });
}

function geocodePosition(pos) {
  geocoder.geocode({
    latLng: pos
  }, function(responses) {
    if (responses && responses.length > 0) {
      marker.formatted_address = responses[0].formatted_address;
    } else {
      marker.formatted_address = 'Cannot determine address at this location.';
    }
    infowindow.setContent(marker.formatted_address + "<br>coordinates: " + marker.getPosition().toUrlValue(6));
    infowindow.open(map, marker);
  });
}

function codeAddress() {
  var address = document.getElementById('address').value;
  geocoder.geocode({
    'address': address
  }, function(results, status) {
    if (status == google.maps.GeocoderStatus.OK) {
      map.setCenter(results[0].geometry.location);
      if (marker) {
        marker.setMap(null);
        if (infowindow) infowindow.close();
      }
      marker = new google.maps.Marker({
        map: map,
        draggable: true,
        position: results[0].geometry.location
      });
      google.maps.event.addListener(marker, 'dragend', function() {
        geocodePosition(marker.getPosition());
      });
      google.maps.event.addListener(marker, 'click', function() {
        if (marker.formatted_address) {
          infowindow.setContent(marker.formatted_address + "<br>coordinates: " + marker.getPosition().toUrlValue(6));
        } else {
          infowindow.setContent(address + "<br>coordinates: " + marker.getPosition().toUrlValue(6));
        }
        infowindow.open(map, marker);
      });
      google.maps.event.trigger(marker, 'click');
    } else {
      alert('Geocode was not successful for the following reason: ' + status);
    }
  });
}

google.maps.event.addDomListener(window, "load", initialize);

*/

		//This for getting latitude and latitude 
 	  var latitude = 19.076154471571943;
      var longitude = 72.87759457510379;

      //This code for checking latitude and longitude is available or not
      var check_latlong_avilability = 'no';

      //console.log(check_latlong_avilability);

      function initAutocomplete() {
        var map = new google.maps.Map(document.getElementById('map'), {
          center: {lat: latitude, lng: longitude},
          zoom: 7,
          draggable: true,
         // mapTypeId: 'roadmap' 
        });
        var geocoder = new google.maps.Geocoder();
        // Create the search box and link it to the UI element.
        var input = document.getElementById('pac-input');
        var searchBox = new google.maps.places.SearchBox(input);
        map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

        // Bias the SearchBox results towards current map's viewport.
        map.addListener('bounds_changed', function() {
          searchBox.setBounds(map.getBounds());
        });
       
        var markers = [];

        var location = new google.maps.LatLng(latitude, longitude);
        // var accuracy = position.coords.accuracy;
 		

        call_marker(location,"direct");


        // Listen for the event fired when the user selects a prediction and retrieve
        // more details for that place.
        searchBox.addListener('places_changed', function() {


          var places = searchBox.getPlaces();

          if (places.length == 0) {
            return;
          }

          // Clear out the old markers.
          markers.forEach(function(marker) {
            marker.setMap(null);
          });
          markers = [];

          // For each place, get the icon, name and location.
          var bounds = new google.maps.LatLngBounds();
          places.forEach(function(place) {
            if (!place.geometry) {
              console.log("Returned place contains no geometry");
              return;
            }
            
            call_marker(place);

           

            if (place.geometry.viewport) {
              // Only geocodes have viewport.
              bounds.union(place.geometry.viewport);
            } else {
              bounds.extend(place.geometry.location);
            }
          });
          map.fitBounds(bounds);


        });


        //This callmaker fuction is call for storing value of latitude and longitude
        function call_marker(place,type = "")
        {
            // var icon = {
            //   url: place.icon,
            //   size: new google.maps.Size(71, 71),
            //   origin: new google.maps.Point(0, 0),
            //   anchor: new google.maps.Point(17, 34),
            //   scaledSize: new google.maps.Size(25, 25)
            // };

            map.setCenter(place);

            if(type == "")  //This if codition is exacute when dada is pass on click
            {
            	console.log(place.geometry.location);
              var marker1 = new google.maps.Marker({
                map: map,
                //icon: icon,
                title: place.name,
                draggable: true,
                position: place.geometry.location
              });

              // var latlng = new google.maps.LatLng(latitude, longitude);

		        geocoder.geocode({ 'latLng': place.geometry.location }, function (results, status) {
		                if (status == google.maps.GeocoderStatus.OK) {
		                    if (results[1]) {
		                        // console.log(results[1].formatted_address);
		                        $("#id_latitude").val(results[1].geometry.location.lat());
            					$("#id_longitude").val(results[1].geometry.location.lng());
		                    }
		                }
		            });

            }else{
              var marker1 = new google.maps.Marker({
                position: location, 
                map: map, 
                draggable: true,
                title: "You are here! Drag the marker to the exact location."
              });

              	//This code for getting address using latitude and longitude
              	var latlng = new google.maps.LatLng(latitude, longitude);

		        geocoder.geocode({ 'latLng': latlng }, function (results, status) {
		                if (status == google.maps.GeocoderStatus.OK) {
		                    if (results[1]) {
		                        // alert("Location: " + results[1].formatted_address);

		                        //This code is execute when latitude and longitude is avialable
		                        if(check_latlong_avilability == "yes")
		                        {
		                        	$("#pac-input").val(results[1].formatted_address);
		                    	}
		                    }
		                }
		            });

            }
            // Create a marker for each place.
            markers.push(marker1);

             // Add a "drag end" event handler
            google.maps.event.addListener(marker1, 'dragend', function() {
              //updateInput(this.position.lat(), this.position.lng());

               console.log(this.position.lat()+"------"+this.position.lng());
              geocodePosition(marker1.getPosition(),this.position);
            });

        }

        //
        function geocodePosition(pos,locationData) {
		        geocoder.geocode({
		          latLng: pos
		        }, function(responses) {
		          if (responses && responses.length > 0) {
		            console.log(locationData.lat()+"------"+locationData.lng());
		            console.log(responses[0].formatted_address);

		            $("#pac-input").val(responses[0].formatted_address);
		            $("#id_latitude").val(locationData.lat());
		            $("#id_longitude").val(locationData.lng());

		          } else {
		            console.log('Cannot determine address at this location.');
		            alert('Cannot determine address at this location.');
		          }
		        });
      }

      	//This code for getting data on click anywhere in map
        google.maps.event.addListener(map, 'click', function(event) {
	          geocoder.geocode({
	            'latLng': event.latLng
	          }, function(results, status) {
	            if (status == google.maps.GeocoderStatus.OK) {
	              if (results[0]) {
	                //alert(results[0].formatted_address);
	              }
	            }
	          });
      });

      }
 	

    </script>

<script src="https://maps.googleapis.com/maps/api/js?libraries=places&key=AIzaSyB71EguX_3hV_Q39RGjA2vuP-TrUOfl3JY&callback=initAutocomplete" type="text/javascript" async defer></script>
	
	
@endsection
