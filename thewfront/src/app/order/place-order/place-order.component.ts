import { Component, OnInit } from '@angular/core';
import { HttpClient, HttpErrorResponse, HttpHeaders } from '@angular/common/http';
import { Headers, RequestOptions } from '@angular/http';
import { Constant } from '../../constant/constant.component';
import { Router } from "@angular/router";
import { CommonService } from "../../common.service";
import { FormGroup, FormBuilder, Validators,FormControl,FormArray } from '@angular/forms';
import { TosterService } from '../../toster-service.service';

@Component({
  selector: 'app-place-order',
  templateUrl: './place-order.component.html',
  styleUrls: ['./place-order.component.css']
})
export class PlaceOrderComponent implements OnInit {

  placeorder: FormGroup;

  successMessage: string = "";
  errorMessage: string = "";

  value: string = "";
  username: string = "";
  usermobile: string = "";
  useraddress: string = "";
  userlandmark: string = "";
  userpincode: string = "";

  slotArray: any[] = [];

  constructor(private http: HttpClient,private router: Router,private commonservice: CommonService,private frmBuilder: FormBuilder,private toasterService:TosterService) {
    // this.commonservice.checkconnection();
    //This code for check login
    this.commonservice.checkLogin();
   }

  ngOnInit() {

    //This is slot array
    this.slotArray.push({'8.00AM':'10:00AM','10.00AM':'01:00PM','01.00PM':'04:00PM','04.00PM':'07:00PM','07.00PM':'10:00PM'});
    console.log(this.slotArray);
    //This function for validation
    this.createForm();
    
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
          this.username = data.name;
          this.usermobile = data.mobile;
          this.useraddress = data.address_line1;
          this.userlandmark = data.landmark;
          this.userpincode = data.pincode; 
        }
      }
     
    });

  }

  get pick_up_date() { return this.placeorder.get('pick_up_date'); }
  get slot() { return this.placeorder.get('slot'); }
  get name() { return this.placeorder.get('name'); }
  get mobile() { return this.placeorder.get('mobile'); }
  get address() { return this.placeorder.get('address'); }
  get landmark() { return this.placeorder.get('landmark'); }
  get pincode() { return this.placeorder.get('pincode'); }
  get var_id() { return this.placeorder.get('var_id'); }

  public createForm()
  {
    this.placeorder = this.frmBuilder.group({
        pick_up_date:['',Validators.compose([
          Validators.required,
        ])],
        slot:['',Validators.compose([
          Validators.required,
        ])],
        name:['',Validators.compose([
          Validators.required,
          Validators.minLength(3),
          Validators.pattern("[a-zA-Z ]*")
        ])],
        mobile:['',Validators.compose([
          Validators.required,
          Validators.minLength(10),
          // Validators.maxLength(10)
        ])],
        address:['',Validators.compose([
          Validators.required,
          Validators.minLength(3)
        ])],
        landmark:['',Validators.compose([
          Validators.required,
          // Validators.minLength(3)
        ])],
        pincode:['',Validators.compose([
          Validators.required,
          // Validators.minLength(10),
          // Validators.maxLength(10)
        ])],
      })
  }

  onSubmit()
  {
    console.log(this.placeorder.value);
    if(this.placeorder.valid)
    {
      this.value = this.placeorder.value;
      let apiUrl = Constant.API_URL+`getOrderData`;
      return this.http.post(apiUrl,this.value).subscribe(response => {
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
      this.toasterService.Error("","Please enter required field.");
      // console.log("Form is invalid"); 
    }
  }

}
