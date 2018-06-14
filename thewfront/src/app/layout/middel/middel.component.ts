import { Component, OnInit } from '@angular/core';
import { CommonService } from "../../common.service";

@Component({
  selector: 'app-middel',
  templateUrl: './middel.component.html',
  styleUrls: ['./middel.component.css'] 
})
export class MiddelComponent implements OnInit {

  constructor(private commonservice: CommonService) { }

  ngOnInit() {
    this.commonservice.checkLogin();
  }

}
