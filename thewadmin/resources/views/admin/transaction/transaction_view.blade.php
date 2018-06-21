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
						Transaction's View

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
							<div class="m-portlet__head">
								<div class="m-portlet__head-tools">
									<ul class="nav nav-tabs m-tabs m-tabs-line   m-tabs-line--left m-tabs-line--primary" role="tablist">
										<li class="nav-item m-tabs__item">
											<a class="nav-link m-tabs__link active" data-toggle="tab" href="#personal_details" role="tab">											
												Transaction Details
											</a>
										</li>
										<li class="nav-item m-tabs__item">
											<a class="nav-link m-tabs__link " data-toggle="tab" href="#franchise_details" role="tab">
												Product Details
											</a>
										</li>
										{{--@if ($transactionData["number_of_docs_uploaded"] > 0)--}}
											<li class="nav-item m-tabs__item">
												<a class="nav-link m-tabs__link " data-toggle="tab" href="#document_details" role="tab">
													Document Details
												</a>
											</li>
										{{--@endif--}}
										{{--@if ($transactionData["transaction_number_comments"] > 0)--}}
										
											<li class="nav-item m-tabs__item">
												<a class="nav-link m-tabs__link " data-toggle="tab" href="#comments" role="tab">
													Comments
												</a>
											</li>
										{{--@endif--}}
									</ul>
								</div>							
							</div>
							<div class="tab-content">
								<div class="tab-pane active" id="personal_details">
									
										<div class="m-portlet__body">										
											<table class="table table-bordered table-hover " id="html_table"><!-- m-datatable -->
										
										<tbody> 
											@if (!empty($transactionData["fb_transaction_id"]))								
											<tr>
												<th>Transaction Id</th> 
												<td>{{!empty($transactionData["fb_transaction_id"]) ? $transactionData["fb_transaction_id"] : "-"}}</td> 
												<th>Customer Name</th> 
												<td>{{!empty($transactionData["first_name"]) ? $transactionData["first_name"] . " " . $transactionData["last_name"] : ""}}</td> 
																			
											</tr>
											<tr>
												<th>Customer Mobile</th> 
												<td>{{!empty($transactionData["mobile_number"]) ? $transactionData["mobile_number"] : "-"}}</td> 
												<th>Customer Email</th> 
												<td>{{!empty($transactionData["email"]) ? $transactionData["email"] : "-"}}</td> 
																			
											</tr>
											<tr>
												<th>Processing Fee</th> 
												<td>{{!empty($transactionData["processing_fee"]) ? $transactionData["processing_fee"] : "-"}}</td> 
												<th>Down Payment</th> 
												<td>{{!empty($transactionData["down_payment_amount"]) ? $transactionData["down_payment_amount"] : "-"}}</td> 
																			
											</tr>
											@if(isset($transactionData["extended_warranty_offer_accepted"]) && isset($transactionData["extended_warranty_offer_price"]) && $transactionData["extended_warranty_offer_accepted"] == "YES")
												<tr>
													<th>Extended Warranty Tenure</th> 
													<td>{{$transactionData["extended_warranty_tenure_years"]." Year"}}</td> 
													<th>Extended Warranty Amount</th> 
													<td>{{$transactionData["extended_warranty_offer_price"]}}</td> 
																				
												</tr>
											@endif
											<tr>
												<th>Emi  Tenure</th> 
												<td>{{!empty($transactionData["instalment_no_months"]) ? $transactionData["instalment_no_months"] : "-"}}</td> 
												<th>Emi  Amount</th> 
												<td>{{!empty($transactionData["instalment_amount"]) ? $transactionData["instalment_amount"] : "-"}}</td> 
																			
											</tr>
											<tr> 
	                                            <th>Is KYC Completed</th>
	                                            <td>  
	                                                @if (!empty($transactionData["is_kyc_completed"]) && $transactionData["is_kyc_completed"] == "1")
	                                                    <span class='list_values label-success' style='float:none'>YES</span>
	                                                @else
	                                                    <span class='list_values label-danger' style='float:none'>NO</span>
	                                                @endif
	                                            </td>
	                                            <th>Transaction Date</th> 
												<td>{{date("d-m-Y h:i:s", strtotime($transactionData["tarnsaction_created"]))}}</td> 
                                        	</tr>
                                        	<tr>
												<th>Decision Date</th> 
												<td>{{isset($transactionData["transaction_closing_date"]) ? date("d-m-Y h:i:s", strtotime($transactionData["transaction_closing_date"])) : '-'}}</td> 
												<th>Current Disposition Status</th> 
												<td>{{!empty($transactionData["sales_call_disposition"]) ? $transactionData["sales_call_disposition"] : "-"}}</td> 
																			
											</tr>
											<tr>
												<th>Emi  Tenure</th> 
												<td>{{!empty($transactionData["instalment_no_months"]) ? $transactionData["instalment_no_months"] : "-"}}</td> 
												<th>Emi  Amount</th> 
												<td>{{!empty($transactionData["instalment_amount"]) ? $transactionData["instalment_amount"] : "-"}}</td> 
																			
											</tr>
											<tr> 
	                                            <th>Is KYC Completed</th>
	                                            <td>  
	                                                @if (!empty($transactionData["is_kyc_completed"]) && $transactionData["is_kyc_completed"] == "1")
	                                                    <span class='list_values label-success' style='float:none'>YES</span>
	                                                @else
	                                                    <span class='list_values label-danger' style='float:none'>NO</span>
	                                                @endif
	                                            </td>
	                                            <th> {{(!empty($transactionData["payment_request_reason"]) && isset($transactionData["payment_request_reason"])) ? ucwords(strtolower(str_replace('_', ' ', $transactionData["payment_request_reason"]))) : "Processing Fees"}}</th>
	                                            <td>  
	                                                @if (!empty($transactionData["payment_status"]) && in_array($transactionData["payment_status"], array("PAID", "REFUNDED")))
	                                                    <span class='list_values label-success' style='float:none;'>{{$transactionData["payment_status"]}}</span>
	                                                @elseif (!empty($transactionData["payment_status"]) && in_array($transactionData["payment_status"], array("NOT_PAID", "CANCELLED")))
	                                                    <span class='list_values label-danger' style='float:none;'>{{$transactionData["payment_status"]}}</span>
	                                                @else
	                                                    <span class='list_values label-primary' style='float:none;'>{{$transactionData["payment_status"]}}</span>

	                                                	{{$transactionData['payment_amount']}}
	                                                @endif
	                                                
	                                            </td>
	                                        </tr>
	                                        <tr> 
	                                            <th>Is Additional information Present</th>
	                                            <td> 
	                                                @if (!empty($transactionData["is_additional_info_present"]) && $transactionData["is_additional_info_present"] == "1")
	                                                    <span class='list_values label-success' style='float:none'>YES</span>
	                                                @else
	                                                    <span class='list_values label-danger' style='float:none'>NO</span>
	                                                @endif
	                                            </td>
	                                            <th>Is App Downloaded</th>
	                                            <td> 
	                                                @if ( $transactionData["app_downloaded_android"] == "YES" || $transactionData["app_downloaded_ios"] == "YES")
	                                                    <span class='list_values label-success' style='float:none'>YES</span>
	                                                @else
	                                                    <span class='list_values label-danger' style='float:none'>NO</span>
	                                                @endif
	                                            </td>
	                                        </tr>
	                                        <tr> 
	                                            <th>Current Disposition Status</th>
	                                            <td>{{empty($transactionData["sales_call_disposition"]) ? $transactionData["sales_call_disposition"] : "-"}}</td>
	                                            <th>First Disposition Time</th>
                                            	<td>{{!empty($transactionData["first_sales_disposition_time_and_date"]) ? date("d-m-Y", strtotime($transactionData["first_sales_disposition_time_and_date"])) : "-"}}</td>
	                                        </tr>
	                                        <tr> 
	                                            <th>Latest Disposition Time</th>
	                                            <td>{{!empty($transactionData["latest_sales_disposition_time_and_date"]) ? date("d-m-Y", strtotime($transactionData["latest_sales_disposition_time_and_date"])) : "-"}}</td> 
	                                            <th>Number of Docs Uploaded</th>
	                                            <td>{{!empty($transactionData["number_of_docs_uploaded"]) ? $transactionData["number_of_docs_uploaded"] : 0}}</td>
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
								<div class="tab-pane " id="franchise_details">
									
										<div class="m-portlet__body">	

													@if (!empty($transactionData["sku_list"]))
													<table class="table table-bordered table-hover " id="html_table"><!-- m-datatable -->								<thead>
						                                    <th>Product Code</th>
						                                    <th>Product Description</th>
						                                    <th>Product Category</th>
						                                    <th>Amount</th>

					                                    </thead>
					                                    <tbody>
					                                        @foreach ($transactionData["sku_list"] as $data)
					                                            <tr>
					                                                <td>{{isset($data['sku_code']) ? $data['sku_code'] : "-"}}</td>
					                                                <td>{{isset($data['sku_description']) ? $data['sku_description'] : "-"}}</td> 
					                                                <td>{{isset($data['sku_category']) ? $data['sku_category'] : "-"}}</td>
					                                                <td>{{isset($data['sku_price']) ? $data['sku_price'] : "-"}}</td>
					                                            </tr>
					                                        @endforeach
					                                    </tbody>
                                					</table>
													@else
														No product details present.
													@endif
												</tbody>	
											</table>					
										</div>
										
								</div>
								
								<div class="tab-pane " id="document_details">
									
										<div class="m-portlet__body">	

													@if (!empty($transactionData["number_of_docs_uploaded"]) && $transactionData["number_of_docs_uploaded"] > 0)
													<table class="table table-bordered table-hover " id="html_table"><!-- m-datatable -->								<thead>
					                                    <th>Document Type</th>
					                                    <th>Document Category</th> 
					                                    <th>Status</th>
					                                    <th>Rejected Reason</th>
					                                    </thead>
					                                    <tbody>
					                                        @foreach ($transactionData["transactionDocData"] as $data)
					                                            <tr>
					                                                <td>{{($data["document_type"])}}</td>
					                                                <td>{{$data["document_category"]}}</td>                                        
					                                                <td>
					                                                    {{--@if (!empty($data["underwriter_status"]) && in_array($data["underwriter_status"], array("APPROVE")))
					                                                        {{$cls_underwriter_status = "label-success"}}
					                                                    @elseif (!empty($data["underwriter_status"]) && in_array($data["underwriter_status"], array("REWORK")))
					                                                        {{$cls_underwriter_status = "label-danger"}}
					                                                    @else
					                                                    	@php
					                                                        	$cls_underwriter_status = "label-primary"
					                                                        @endphp
					                                                    	<span class='list_values $cls_underwriter_status' >{{ucwords(strtolower(str_replace('_', ' ', $data["underwriter_status"])))}}</span>
					                                                    @endif--}}
					                                                    {{$data["underwriter_status"]}}
					                                                </td>
					                                                <td>{{!empty($data["rework_reason"]) ? $data["rework_reason"] : "-"}}</td>
					                                            </tr>
					                                        @endforeach
					                                    </tbody>
                                					</table>
													
													@else
														No documents present.
													@endif					
										</div>
										
								</div>

								<div class="tab-pane " id="comments"> 
									
										<div class="m-portlet__body">	
											<!--  <h4 class="" style="margin-top:2px;">Total Comments {{$transactionData["transaction_number_comments"]}}</h4> -->
												
												

												
											 	@if (isset($transactionData["transaction_comments"]) && !empty($transactionData["transaction_comments"]))
											 		<!-- <b>Customer Care Comments</b> -->
													<table class="table table-bordered table-hover " id=""><!-- m-datatable -->								
					                                    <tbody>
					                                    	<?php 
					                                    		// $last_index = count($transactionData["transaction_comments"]);
					                                    		// $index = $last_index - 1;
					                                    	 ?>
					                                      
					                                            <tr>
					                                                <td>{{isset($transactionData["transaction_comments"][0]["created_timestamp"]) ? date("d M, Y", strtotime($transactionData["transaction_comments"][0]["created_timestamp"])) : '-'}}</td>
					                                                <td>{{trim($transactionData["transaction_comments"][0]["comment_text"])}}</td> 
					                                            </tr>
					                                       
					                                    </tbody>
                                					</table> 
												@else
													No comments present.
												@endif	
																	
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
