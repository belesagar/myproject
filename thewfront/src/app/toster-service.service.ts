import { Injectable } from '@angular/core';
declare var toastr:any
@Injectable()
export class TosterService {

  constructor() { }

  Success(title :string,message?:string)
  {
    toastr.success(title,message);
  }

  Error(title :string,message?:string)
  {
    toastr.error(title,message);
  }

  Warning(title :string,message?:string)
  {
    toastr.warning(title,message);
  }

  Info(message?:string) 
  {
    toastr.info(message);
  }

}
