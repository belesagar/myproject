import { Component, OnInit } from '@angular/core';
import { Constant } from '../constant/constant.component';
import { AppComponent } from '../app.component';
import { CommonService } from "../common.service";

@Component({
  selector: 'app-dashboard',
  templateUrl: './dashboard.component.html',
  styleUrls: ['./dashboard.component.css']
})
export class DashboardComponent implements OnInit {

  successMessage: string = "";
  errorMessage: string = "";
  showlogin = false;
  
  message:string;

  constructor(private commonservice: CommonService) { }

  ngOnInit() {
    this.commonservice.showloader();
    this.commonservice.checkLogin();
    // this.data.currentMessage.subscribe(message => this.message = message);
    // this.data.checkLogin("Hello from Sibling");
    this.successMessage = "hiiiiiii";
  }

}
