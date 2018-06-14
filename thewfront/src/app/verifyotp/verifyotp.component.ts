import { Component, OnInit } from '@angular/core';
import { HttpClient, HttpErrorResponse, HttpHeaders } from '@angular/common/http';
import { Headers, RequestOptions } from '@angular/http';
import { Constant } from '../constant/constant.component';
import { Router } from "@angular/router";
import { CommonService } from "../common.service";

@Component({
  selector: 'app-verifyotp',
  templateUrl: './verifyotp.component.html',
  styleUrls: ['./verifyotp.component.css',
  "../../assets/login_css/vendors/bootstrap/dist/css/bootstrap.min.css",
  "../../assets/login_css/vendors/font-awesome/css/font-awesome.min.css",
  "../../assets/login_css/vendors/nprogress/nprogress.css",
  "../../assets/login_css/vendors/animate.css/animate.min.css",
  "../../assets/login_css/build/css/custom.min.css",]
})
export class VerifyotpComponent implements OnInit {

  successMessage: string = "";
  errorMessage: string = "";

  constructor(private http: HttpClient,private router: Router,private commonservice: CommonService) { 
    this.commonservice.checkNotLogin();

  }

  ngOnInit() {
  }

  onSubmit({value,valid})
  {
    if(valid)
    {
      const httpOptions = {
        headers: new HttpHeaders({
          'Content-Type':  'application/json',
          'Authorization': '1234',
          'Access-Control-Allow-Origin': '*',
        })
      };
      // console.log(httpOptions);
      let apiUrl = Constant.API_URL+`verifyOtp`;
      return this.http.post(apiUrl,value).subscribe(response => {
        console.log(response)
        if(response['ERROR_CODE'] == 0)
        {
          this.successMessage = "Data get successfully.";
          this.errorMessage = "";
          this.router.navigate(['/dashboard']);
        }else{
          this.errorMessage = response['ERROR_DESCRIPTION'];
          this.successMessage = "";
        }
       
      });
    }else{ 
      this.errorMessage = "Enter required fields.";
      this.successMessage = "";
     console.log("Form is invalid"); 
    }
  }

}
