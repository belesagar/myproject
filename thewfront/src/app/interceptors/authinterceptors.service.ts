import { Injectable } from '@angular/core';
import { HttpClient, HttpInterceptor, HttpErrorResponse, HttpHeaders, HttpRequest, HttpHandler, HttpEvent } from '@angular/common/http';
import { Observable } from 'rxjs/Observable';
import { LocalStorageServiceService } from '../local-storage-service.service';

@Injectable()
export class AuthinterceptorsService implements HttpInterceptor {

  constructor(private localStorageService:LocalStorageServiceService) { }

  intercept(req: HttpRequest<any>, next: HttpHandler): Observable<HttpEvent<any>>{
      // console.log("hii interceptors");
      // console.log(req);
      // console.log(this.localStorageService.GetValueFromLocalStorage());

      // const httpOptions = {
      //   headers: new HttpHeaders({
      //     'Content-Type':  'application/json',
      //     // 'Authorization': '1234',
      //     'Access-Control-Allow-Origin': '*',
      //     'dummy': 'dummy',
      //   })
      // };

      

      var tokendata = this.localStorageService.GetValueFromLocalStorage();
      var authHeader = 'Bearer ' + tokendata;
      if(tokendata != null)
      {
        console.log("Local token - "+tokendata);
      }
      
      const authReq = req.clone({
        headers: new HttpHeaders({
          'Content-Type':  'application/json',
          'Authorization': authHeader
        })
      });

      // var dummydata = 'dummydata';
      // // const authReq = req.clone({setHeaders: {'Authorization' :"bele",'abc': dummydata}});
      // const authReq = req.clone({ headers: req.headers.set("dummy", "headerValue") });
      // console.log(authReq);

      return next.handle(authReq);
  }

}
