import { Component, OnInit } from '@angular/core';
import { HttpClient, HttpErrorResponse, HttpHeaders } from '@angular/common/http';
import { Headers, RequestOptions } from '@angular/http';
import { Constant } from '../../constant/constant.component';
import { Router } from "@angular/router";

@Component({
  selector: 'app-place-order',
  templateUrl: './place-order.component.html',
  styleUrls: ['./place-order.component.css']
})
export class PlaceOrderComponent implements OnInit {

  constructor(private http: HttpClient,private router: Router) { }

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
      console.log(httpOptions);
      let apiUrl = Constant.HOME_URL+`public/index.php/api/postData`;
      return this.http.post(apiUrl,value,httpOptions).subscribe(response => {
        console.log(response)
        if(response['ERROR_CODE'] == 0)
        {
          
          //this.router.navigate(['/verifyotp']);
        }else{
          
        }
       
      });
    }else{ 
     
     console.log("Form is invalid"); 
    }
  }

}
