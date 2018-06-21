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
						Order List

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
										<a class="nav-link m-tabs__link active tabdata" data-status="ordered" data-toggle="tab" href="#ordered" role="tab">											
											Ordered
										</a>
									</li>
									<li class="nav-item m-tabs__item">
										<a class="nav-link m-tabs__link tabdata" data-status="picked_up" data-toggle="tab" href="#picked_up" role="tab">
											Picked up
										</a>
									</li>
									
									<li class="nav-item m-tabs__item">
										<a class="nav-link m-tabs__link tabdata" data-status="processing" data-toggle="tab" href="#processing" role="tab">
											Processing
										</a>
									</li>
									
									<li class="nav-item m-tabs__item">
										<a class="nav-link m-tabs__link tabdata" data-status="ready" data-toggle="tab" href="#ready" role="tab">
											Ready
										</a>
									</li>
									<li class="nav-item m-tabs__item">
										<a class="nav-link m-tabs__link tabdata" data-status="delivered" data-toggle="tab" href="#delivered" role="tab">
											Delivered
										</a>
									</li>
									<li class="nav-item m-tabs__item">
										<a class="nav-link m-tabs__link tabdata" data-status="payment_pending" data-toggle="tab" href="#payment_pending" role="tab">
											Payment pending
										</a>
									</li>
									<li class="nav-item m-tabs__item">
										<a class="nav-link m-tabs__link tabdata" data-status="cancelled" data-toggle="tab" href="#cancelled" role="tab">
											Cancelled
										</a>
									</li>
								</ul>
							</div>							
						</div>
						<div class="tab-content">

							<!-- This section for showing order list data -->
							<div class="tab-pane active" id="ordered">
								
								<div class="m-portlet__body">										
									<div id="ordered_table" class="class_html_table"></div>								
								</div>
															
							</div>

							<!-- This section for showing picked order list data -->
							<div class="tab-pane " id="picked_up">
								
								<div class="m-portlet__body">	
									<div id="picked_up_table" class="class_html_table"></div>
								</div>
									
							</div>
							
							<!-- This section for showing processing order list data -->
							<div class="tab-pane " id="processing">
								
								<div class="m-portlet__body">	
									<div id="processing_table" class="class_html_table"></div>						
								</div>
									
							</div>

							<!-- This section for showing ready order list data -->
							<div class="tab-pane " id="ready"> 
								
								<div class="m-portlet__body">	
									<div id="ready_table" class="class_html_table"></div>							
								</div>
									
							</div>

							<!-- This section for showing delivered order list data -->
							<div class="tab-pane " id="delivered"> 
								
								<div class="m-portlet__body">	
									<div id="delivered_table" class="class_html_table"></div>							
								</div>
									
							</div>

							<!-- This section for showing payment pending order list data -->
							<div class="tab-pane " id="payment_pending"> 
								
								<div class="m-portlet__body">	
									<div id="payment_pending_table" class="class_html_table"></div>							
								</div>
									
							</div>

							<!-- This section for showing cancelled order list data -->
							<div class="tab-pane " id="cancelled"> 
								
								<div class="m-portlet__body">	
									<div id="cancelled_table" class="class_html_table"></div>							
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
	
	<script type="text/javascript">
		var status;
		$(".tabdata").click(function(){
			$(".class_html_table").html("");
			status = $(this).attr('data-status');

			$.ajax({
			  url: "<?php echo route('orders_table_list') ?>",
			  type: "POST",
			  dataType: "html",
			  success: function(data){
			    $("#"+status+"_table").html(data);
			    call_ajax_data();
			  }
			});

		});

		function call_ajax_data(){
		showAjaxLoader();

	var i = 0;
	
	var table = $('#html_table').DataTable( {
        "processing": true,
        "searching": false,
        "pageLength": 10,
        "destroy": true,
        "serverSide": true,
        "ajax": {
	        url: '<?php echo route('get_order_data') ?>',
	        type: 'POST', 
	        data: {
		        // "_token": $("input[name=_token]").val(),
		        // "searchfield": $("input[name=searchfield]").val(),
		        // "merchant_id": $("#id_merchant_id").val(),
		        // "status": $("#id_status").val(),
		        // "fromdate": $("#id_fromdate").val(),
		        // "todate": $("#id_todate").val(),
		        "status": status,
		    },
		    "dataSrc": function ( json ) {
      				hideAjaxLoader();
      				return json.data;
    		},
		    // success : function(data) {              
      //       	console.log(data);
      //   	},	
	        // dataType: "json", 
    	},
    	"columns": [
    		/*{ data: null ,render: function ( data, type, row ) {
                console.log(data);
                return ++i;
            } },*/
            // { data: null ,render: function ( data, type, row ) {
            //     return data.name;
            // } },
            { data: "name" },
            { data: "mobile" },
            // { data: "alternet_mobile_no" },
            // { data: "created_at" },
            // { data: null ,render: function ( data, type, row ) {
            //     if(data.is_active)
            //     {
            //     	return 'Active';
            //     }else{
            //     	return 'Inactive';
            //     }
                
            // } },
            // { data: null , render: function ( data, type, row ) {
            // 	var user_view = '<?php echo route('view_user') ?>';
            // 	var user_edit = '<?php echo route('edit_user') ?>';
            // 	var action_string = '<a href="'+user_view+'/'+data.id+'" class="m-portlet__nav-link btn m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill editbtn"  title="View Data"><i class="fa fa-eye"></i></a><a href="'+user_edit+'/'+data.id+'" class="m-portlet__nav-link btn m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill editbtn" title="Edit Data"><i class="fa fa-edit"></i></a>';
            	
            //     return action_string;
            // } }
        ],
        
    } );
    
	}


	</script>
@endsection
