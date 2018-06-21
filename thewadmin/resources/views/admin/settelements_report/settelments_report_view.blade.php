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
    	<div class="m-subheader ">
			<div class="d-flex align-items-center">
				<div class="mr-auto">
					<h3 class="m-subheader__title ">
						Settlement Details

					</h3>
				</div>
			</div>
		</div>
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
							<div class="tab-content">
								<div class="tab-pane active" id="personal_details">
									
										<div class="m-portlet__body">										
											<table class="table table-bordered table-hover " id="html_table"><!-- m-datatable -->
										
										<tbody> 
											@if (!empty($transactionData["merchant_order_id"]))								
											<tr>
												<th>Merchant Order Id</th> 
												<td>{{!empty($transactionData["merchant_order_id"]) ? $transactionData["merchant_order_id"] : "-"}}</td> 
												<th>Transaction Closing Date</th> 
												<td>{{!empty($transactionData["transaction_closing_date"]) ? $transactionData["transaction_closing_date"] : ""}}</td> 
																			
											</tr>
											<tr>
												<th>Transaction Closing Date</th> 
												<td>{{!empty($transactionData["transaction_closing_date"]) ? $transactionData["transaction_closing_date"] : "-"}}</td> 
												<th>Customer Email</th> 
												<td>{{!empty($transactionData["user_email"]) ? $transactionData["user_email"] : "-"}}</td> 
																			
											</tr>
											<tr>
												<th>Customer Name</th> 
												<td>{{!empty($transactionData["user_fname"]) ? $transactionData["user_fname"] . " " . $transactionData["user_lname"] : ""}}</td>
												<th>Customer Mobile</th> 
												<td>{{!empty($transactionData["user_mobile"]) ? $transactionData["user_mobile"] : "-"}}</td> 
																			
											</tr>
											
												<tr>
													<th>Product Value</th> 
													<td>{{$transactionData["product_value"]}}</td> 
													<th>Loan Amount</th> 
													<td>{{$transactionData["loan_amount"]}}</td> 
																				
												</tr>
											
											<tr>
												<th>MDR Rate</th> 
												<td>{{!empty($transactionData["mdr_rate"]) ? $transactionData["mdr_rate"] : "-"}}</td> 
												<th>MDR Amount</th> 
												<td>{{!empty($transactionData["mdr_amount"]) ? $transactionData["mdr_amount"] : "-"}}</td> 
																			
											</tr>
											
                                        	<tr>
												<th>Service Tax Rate</th> 
												<td>{{isset($transactionData["service_tax_rate"]) ? $transactionData["service_tax_rate"] : '-'}}</td> 
												<th>Service Tax Amount</th> 
												<td>{{!empty($transactionData["service_tax_amount"]) ? $transactionData["service_tax_amount"] : "-"}}</td> 
																			
											</tr>
											<tr>
												<th>Paid In Store</th> 
												<td>{{!empty($transactionData["paid_in_store"]) ? $transactionData["paid_in_store"] : "-"}}</td> 
												<th>Adjustment Amount</th> 
												<td>{{!empty($transactionData["adjustment_amount"]) ? $transactionData["adjustment_amount"] : "-"}}</td> 
																			
											</tr>
											
	                                        <tr> 
	                                            <th>Adjustment Description</th>
	                                            <td>{{!empty($transactionData["adjustment_desc"]) ? $transactionData["adjustment_desc"] : "-"}}</td>
	                                            <th>Settlement Amount</th>
                                            	<td>{{!empty($transactionData["settlement_amount"]) ? $transactionData["settlement_amount"] : "-"}}</td>
	                                        </tr>
	                                        <tr> 
	                                            <th>Account</th>
	                                            <td>{{!empty($transactionData["account_entry_type"]) ? $transactionData["account_entry_type"] : "-"}}</td>
	                                            <th>Settlement Date</th>
                                            	<td>{{!empty($transactionData["settlement_date"]) ? $transactionData["settlement_date"] : "-"}}</td>
	                                        </tr>
	                                        <tr> 
	                                            <th>Is Settled</th>
	                                            <td>{{!empty($transactionData["is_settled"]) ? $transactionData["is_settled"] : "-"}}</td>
	                                            <th>Transaction Type</th>
                                            	<td>{{!empty($transactionData["transaction_type"]) ? $transactionData["transaction_type"] : "-"}}</td>
	                                        </tr>
	                                        <tr> 
	                                            <th>UTR No</th>
	                                            <td>{{!empty($transactionData["bank_utr_no"]) ? $transactionData["bank_utr_no"] : "-"}}</td>
	                                            <th>Paid Via Bank</th>
                                            	<td>{{!empty($transactionData["paid_via_bank"]) ? $transactionData["paid_via_bank"] : "-"}}</td>
	                                        </tr>
	                                        <tr> 
	                                            <th>Merchant Bank Name</th>
	                                            <td>{{!empty($transactionData["bank_name"]) ? $transactionData["bank_name"] : "-"}}</td>
	                                            <th>Merchant Bank Ifsc Code</th>
                                            	<td>{{!empty($transactionData["bank_ifsc_code"]) ? $transactionData["bank_ifsc_code"] : "-"}}</td>
	                                        </tr>
	                                        <tr> 
	                                            <th>Merchant Bank Account Number</th>
	                                            <td>{{!empty($transactionData["bank_account_no"]) ? $transactionData["bank_account_no"] : "-"}}</td>
	                                            <th>Merchant Account Holder Name</th>
                                            	<td>{{!empty($transactionData["bank_account_holder_name"]) ? $transactionData["bank_account_holder_name"] : "-"}}</td>
	                                        </tr>
	                                        @else
	                                        	<tr> 	
		                                            <th>No Details Found</th>
		                                            
		                                        </tr>
	                                        @endif
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
