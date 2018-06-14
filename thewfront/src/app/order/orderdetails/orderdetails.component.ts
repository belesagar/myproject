import { Component, OnInit } from '@angular/core';
import { HttpClient, HttpErrorResponse, HttpHeaders } from '@angular/common/http';
import { Headers, RequestOptions } from '@angular/http';
import { Constant } from '../../constant/constant.component';
import { Router, ActivatedRoute } from "@angular/router";
import { CommonService } from '../../common.service';
const url = 'assets/demo/default/custom/components/forms/widgets/ion-range-slider.js';

@Component({
  selector: 'app-orderdetails',
  templateUrl: './orderdetails.component.html',
  styleUrls: ['./orderdetails.component.css']
})
export class OrderdetailsComponent implements OnInit {


  successMessage: string = "";
  errorMessage: string = "";

  postData = {};
  status = [
    "Ordered", "Picked up",
    "Processing", "Ready",
    "Delivered"
  ];
  orderdetails: string = "";
  
  order_id:string;
  
  constructor(private http: HttpClient,private router: Router,private route: ActivatedRoute,private commonservice:CommonService) { 
   
    //This code for check login    
    this.commonservice.checkLogin();

  }

  ngOnInit() {

    //This service for loading script
    this.commonservice.loadScript(url);

    this.route.params.subscribe(params => { this.order_id = params['id']; });
    this.postData = {
      order_id: this.order_id
    };
    console.log(this.postData); 
    let apiUrl = Constant.API_URL+`getOrderDetails`;
      return this.http.post(apiUrl,this.postData).subscribe(response => {
        console.log(response)
        if(response['ERROR_CODE'] == 0)
        {
          if(response['DATA'].length != 0)
          {
            this.orderdetails = response['DATA'][0];
            console.log(this.orderdetails)
          }else{
             this.router.navigate(['/orderlist']);
          }

          // this.errorMessage = "";
          // this.successMessage = "Order is successfully placed";
          //this.router.navigate(['/verifyotp']);
        }else{
          this.errorMessage = response['ERROR_DESCRIPTION'];
          this.successMessage = "";
        }
       
      });

  }

}
