import { Component, OnInit } from '@angular/core';
import { HttpClient, HttpErrorResponse, HttpHeaders } from '@angular/common/http';
import { Headers, RequestOptions } from '@angular/http';
import { Constant } from '../constant/constant.component';
import { Router } from "@angular/router";
import { CommonService } from "../common.service";

@Component({
  selector: 'app-services',
  templateUrl: './services.component.html',
  styleUrls: ['./services.component.css']
})
export class ServicesComponent implements OnInit {

  responceData: any[] = [];
  servicesArray: any[] = [];
  servicesData: any[] = [];

  constructor(private http: HttpClient,private router: Router,private commonservice: CommonService) { }

  ngOnInit() {

    this.commonservice.showloader();
    let apiUrl = Constant.API_URL+`getServices`;
    return this.http.get(apiUrl).subscribe(response => { 
      console.log(response)
      if(response['ERROR_CODE'] == 0)
      {
         this.servicesArray = ['wash','washiron'];
         this.responceData = response['DATA'];
        //  for(var value of this.responceData)
        //  {  
        //   console.log(value['type']);
        //     if(this.servicesArray[value['type']])
        //     {
             
        //       this.servicesData.push(value);
        //     }
        //  }
        //  console.log(this.servicesData)
      }else{
        
      }
      this.commonservice.hideloader();
     
    });

  }

}
