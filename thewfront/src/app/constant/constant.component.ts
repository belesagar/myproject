import { Component, OnInit } from '@angular/core';

@Component({
  selector: 'app-constant',
  templateUrl: './constant.component.html',
  styleUrls: ['./constant.component.css']
})
export class Constant implements OnInit {

  public static get HOME_URL(): string { return "http://192.168.1.60:8000/thew3/"; };
  public static get API_URL(): string { return "http://192.168.1.60:8000/index.php/api/"; };

  constructor() { 
    
  }

  ngOnInit() {
  }

}
