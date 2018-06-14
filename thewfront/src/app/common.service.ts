import { Injectable } from '@angular/core';
import { HttpClient, HttpErrorResponse } from '@angular/common/http';
import { Headers, RequestOptions } from '@angular/http';
import { TosterService } from './toster-service.service';
import { Constant } from './constant/constant.component';
import { Router } from "@angular/router";
import { LocalStorageServiceService } from './local-storage-service.service';
import { BehaviorSubject } from 'rxjs/BehaviorSubject';
import { Ng4LoadingSpinnerService } from 'ng4-loading-spinner';

@Injectable()
export class CommonService {

  showlogin: string = 'true';
  token_id: string = "";

  postData = {};

  private messageSource = new BehaviorSubject('default message');
  currentMessage = this.messageSource.asObservable(); 

  public status: BehaviorSubject<boolean> = new BehaviorSubject<boolean>(false);

  constructor(private http: HttpClient,private toasterService:TosterService,private router: Router,private localStorageService:LocalStorageServiceService,private spinnerService: Ng4LoadingSpinnerService) { 
    
  }

  loadScript(url :string)
  {
    // console.log('preparing to load...')
    let node = document.createElement('script');
    node.src = url;
    node.type = 'text/javascript';
    document.getElementsByTagName('head')[0].appendChild(node);
  }

  checkLogin()
  {     
      this.showloader();
       this.token_id = this.localStorageService.GetValueFromLocalStorage();
        this.postData = {
          token_id: JSON.parse(this.token_id)
        };

        let apiUrl = Constant.API_URL+`checklogin`;
        return this.http.post(apiUrl,this.postData).subscribe(response => {
        
          if(response['ERROR_CODE'] == 0)
          {
           
          }else{
            this.router.navigate(['/login']);
          }
          this.hideloader();
        });
       
  }

  checkNotLogin()
  {     
        this.showloader();
        this.token_id = this.localStorageService.GetValueFromLocalStorage();
        this.postData = {
          token_id: JSON.parse(this.token_id)
        };
        // console.log(this.postData);
        let apiUrl = Constant.API_URL+`checknotlogin`;
        return this.http.post(apiUrl,this.postData).subscribe(response => {
          // console.log(response);
          if(response['ERROR_CODE'] == 0)
          {
            
            // this.router.navigate(['/dashboard']);
          }else{
            this.router.navigate(['/dashboard']);
          }
          this.hideloader();
        });
       
  }

  showloader()
  {
   
    this.spinnerService.show();
  }

  hideloader()
  {
    this.spinnerService.hide();
  }

}
