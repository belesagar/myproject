import { Component, OnInit } from '@angular/core';
import { HttpClient, HttpErrorResponse, HttpHeaders } from '@angular/common/http';
import { Headers, RequestOptions } from '@angular/http';
import { Constant } from '../../constant/constant.component';
import { Router } from "@angular/router";
import { CommonService } from "../../common.service";

@Component({
  selector: 'app-orderlist',
  templateUrl: './orderlist.component.html',
  styleUrls: ['./orderlist.component.css']
})
export class OrderlistComponent implements OnInit {

  successMessage: string = "";
  errorMessage: string = "";

  responceData: any[] = [];

  show: boolean = false;

  constructor(private http: HttpClient,private router: Router,private commonservice: CommonService) { 
    //This code for check login
    this.commonservice.checkLogin();

  }

  ngOnInit() {
    this.commonservice.showloader();
    let apiUrl = Constant.API_URL+`getOrderlist`;
    return this.http.get(apiUrl).subscribe(response => { 
      // console.log(response)
      if(response['ERROR_CODE'] == 0)
      {
        this.responceData = response['DATA'];
       
      }else{
        this.errorMessage = response['ERROR_DESCRIPTION'];
        this.successMessage = ""; 
      }
      this.commonservice.hideloader();
     
    });

  }

  //This code for showing amount of the product
  display(value)
  {
      this.show = false;
      if(value != "" && value != null)
      {
        this.show = true;
      }
      return this.show;
  }

}
