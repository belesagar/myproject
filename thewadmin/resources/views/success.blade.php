@extends('admin.layouts.header')
@section('title', 'Page Title')


@section('css')


@endsection


@section('content')
<!-- <div class="m-grid__item m-grid__item--fluid m-wrapper">
    <div class="container">
        <div class="alert alert-success" style="position: absolute; top: 30%; left: 50%; transform: translate(-30%, -50%);">
            <h4>Your loan is approved by Kissht. Current loan status is <?php echo $statusmsgs[$data['LOAN_STATUS']]; ?>.</h4>
        </div>
    </div>
</div> -->
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
									Transaction Details
								</div>											
							</div>										
						</div>
							
						<div class="m-portlet__body">
							<div class="alert alert-success class_alert_message">
				            	Your loan application is accepted by Kissht. Please submit the required documents and complete the formalities as explained by the Kissht Franchisee to get a fast approval for your loan. Current loan status is <?php echo $statusmsgs[$data['LOAN_STATUS']]; ?>.
				        	</div>
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
									
									<div class="m-portlet__body">										
										<table class="table table-bordered table-hover " id="html_table"><!-- m-datatable -->
										
											<tbody> 
																				
												<tr>
													<th>Transaction Id</th> 
													<td>{{!empty($transactionData["fb_transaction_id"]) ? $transactionData["fb_transaction_id"] : "-"}}</td> 
																	
												</tr>
												<tr>
													<th>Order ID</th> 
													<td>{{!empty($transactionData["merchant_order_id"]) ? $transactionData["merchant_order_id"] : "-"}}</td> 
																				
												</tr>
												<tr>
													<th>Customer Name</th> 
													<td>{{!empty($transactionData["first_name"]) ? $transactionData["first_name"] . " " . $transactionData["last_name"] : ""}}</td> 
																				
												</tr>
												<!-- <tr>
													<th>Loan Status</th> 
													<td>{{!empty($transactionData["status"]) ? $transactionData["status"] : "-"}}</td> 
																				
												</tr> -->
												
											</tbody>
										
										</table>
											
										<a href="{{url(route('instant_cash_uploaddocumnets',['id' => $transactionData['fb_transaction_id']]))}}" target="_blank" class="btn btn-accent m-btn m-btn--air m-btn--custom purplebtn">
										Upload Documents
										</a>

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


@endsection
