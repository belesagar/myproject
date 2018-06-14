import { Component, OnInit } from '@angular/core';
import { HttpClient, HttpErrorResponse, HttpHeaders } from '@angular/common/http';
import { Headers, RequestOptions } from '@angular/http';
import { Constant } from '../constant/constant.component';
import { Router } from "@angular/router";
import { LocalStorageServiceService } from '../local-storage-service.service';
import { CommonService } from "../common.service";
// import { Ng4LoadingSpinnerService } from 'ng4-loading-spinner';

@Component({
  selector: 'app-login',
  templateUrl: './login.component.html',
  styleUrls: ['./login.component.css',
  "../../assets/login_css/vendors/bootstrap/dist/css/bootstrap.min.css",
  "../../assets/login_css/vendors/font-awesome/css/font-awesome.min.css",
  "../../assets/login_css/vendors/nprogress/nprogress.css",
  "../../assets/login_css/vendors/animate.css/animate.min.css",
  "../../assets/login_css/build/css/custom.min.css",]
})
export class LoginComponent implements OnInit {

  successMessage: string = "";
  errorMessage: string = "";
  postvalue = [];

  constructor(private http: HttpClient,private router: Router,private localStorageService:LocalStorageServiceService,private commonservice: CommonService) { 
    this.commonservice.checkNotLogin();
    
    // this.spinnerService.show();
  }

  ngOnInit() {

   
    // console.log(this.localStorageService.GetValueFromLocalStorage());
    // this.postvalue['email'] ="gfdg";
    // this.postvalue['pass'] ="gfdg";
    // const httpOptions = {
    //   headers: new HttpHeaders({
    //     'Content-Type':  'application/json',
    //     'username': '36017',
    //     'Access-Control-Allow-Origin': '*',
    //     'password':'N41D9sFQU5E0e8v9PkNa6W3IvIacQrpcjjDdvc0B',
    //     'token':'BZMWYRC7FA8XP1QRDV8BQ548VYY5J2Q3'
    //   })
    // };

    // console.log(this.postvalue);
    // let apiUrl = `http://localhost/kissht/api/v2/user_management/send_otp`;
    // return this.http.post(apiUrl,this.postvalue,httpOptions).subscribe(response => {
    //   console.log(response)
      
     
    // });


  }

  onSubmit({value,valid})
  {
    if(valid)
    {
      this.commonservice.showloader();
      let localstoragetoken = this.localStorageService.GetValueFromLocalStorage();

      // value.push({login_token:localstoragetoken});
      value['login_token'] =  localstoragetoken;
      // console.log(value);
      let apiUrl = Constant.API_URL+`getLoginData`;
      return this.http.post(apiUrl,value).subscribe(response => {
        // console.log(response)
        if(response['ERROR_CODE'] == 0)
        {
          this.successMessage = "Data get successfully.";

          this.localStorageService.SetAuthorizationData(response['DATA']);

          this.errorMessage = "";
          this.router.navigate(['verifyotp']);
        }else{
          this.errorMessage = response['ERROR_DESCRIPTION'];
          this.successMessage = "";
        }
        this.commonservice.hideloader();
      });
    }else{ 
      this.errorMessage = "Enter required fields.";
      this.successMessage = "";
     
    }
  }

  verifyOtp()
  {
    
  }

}
