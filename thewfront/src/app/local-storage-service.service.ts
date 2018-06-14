import { Injectable } from '@angular/core';

@Injectable()
export class LocalStorageServiceService {

  channelPartnerTokenKey: string = "channel_partner_token";
  constructor() { }

  public SetAuthorizationData(token){
    localStorage.setItem(this.channelPartnerTokenKey,JSON.stringify(token));
  }

  public GetValueFromLocalStorage()
  {
     let token_data = localStorage.getItem(this.channelPartnerTokenKey);
     return token_data == null ? null:token_data;
  }

  public RemoveValueFromLocalStorage()
  {
      localStorage.removeItem(this.channelPartnerTokenKey);
  }

}
