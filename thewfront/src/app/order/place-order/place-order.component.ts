import { Component, OnInit } from '@angular/core';
import { HttpClient, HttpErrorResponse, HttpHeaders } from '@angular/common/http';
import { Headers, RequestOptions } from '@angular/http';
import { Constant } from '../../constant/constant.component';
import { Router } from "@angular/router";
import { CommonService } from "../../common.service";

@Component({
  selector: 'app-place-order',
  templateUrl: './place-order.component.html',
  styleUrls: ['./place-order.component.css']
})
export class PlaceOrderComponent implements OnInit {

  successMessage: string = "";
  errorMessage: string = "";

  name: string = "";
  mobile: string = "";
  address: string = "";
  landmark: string = "";
  pincode: string = "";

  constructor(private http: HttpClient,private router: Router,private commonservice: CommonService) {
    //This code for check login
    this.commonservice.checkLogin();
   }

  ngOnInit() {

    //This code for getting last order data
    let apiUrl = Constant.API_URL+`getLastOrderData`;
    return this.http.get(apiUrl).subscribe(response => {
      console.log(response)
      if(response['ERROR_CODE'] == 0)
      {
        if(response['DATA'].length != 0) 
        {
          let data = response['DATA'];
          console.log(data);
          this.name = data.name;
          this.mobile = data.mobile;
          this.address = data.address_line1;
          this.landmark = data.landmark;
          this.pincode = data.pincode; 
        }
      }
     
    });

  }

  onSubmit({value,valid})
  {
    console.log(value);
    if(valid)
    {
      
      let apiUrl = Constant.API_URL+`getOrderData`;
      return this.http.post(apiUrl,value).subscribe(response => {
        console.log(response)
        if(response['ERROR_CODE'] == 0)
        {
          // this.errorMessage = "";
          // this.successMessage = "Order is successfully placed";
          this.router.navigate(['/orderdetails',response['DATA']['responce_id']]);
        }else{
          this.errorMessage = response['ERROR_DESCRIPTION'];
          this.successMessage = "";
        }
       
      });
    }else{ 
     
     console.log("Form is invalid"); 
    }
  }

}
