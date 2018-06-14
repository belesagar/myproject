import { Component, OnInit } from '@angular/core';
import { HttpClient, HttpErrorResponse, HttpHeaders } from '@angular/common/http';
import { Headers, RequestOptions } from '@angular/http';
import { Constant } from '../constant/constant.component';
import { Router } from "@angular/router";
import { LocalStorageServiceService } from '../local-storage-service.service';

@Component({
  selector: 'app-logout',
  templateUrl: './logout.component.html',
  styleUrls: ['./logout.component.css']
})
export class LogoutComponent implements OnInit {

  successMessage: string = "";
  errorMessage: string = "";

  constructor(private http: HttpClient,private router: Router,private localStorageService:LocalStorageServiceService) { }

  ngOnInit() {

    let apiUrl = Constant.API_URL+`logout`;
      return this.http.get(apiUrl).subscribe(response => {
        console.log(response)
        if(response['ERROR_CODE'] == 0)
        {
          
          this.localStorageService.RemoveValueFromLocalStorage();

          // this.errorMessage = "";
          this.router.navigate(['login']);
        }else{
          this.errorMessage = response['ERROR_DESCRIPTION'];
          this.successMessage = "";
        }
       
      });

  }

}
