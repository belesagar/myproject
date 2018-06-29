import { Component, OnInit } from '@angular/core';

@Component({
  selector: 'app-myprofile',
  templateUrl: './myprofile.component.html',
  styleUrls: ['./myprofile.component.css']
})
export class MyprofileComponent implements OnInit {

  email: string = "";
  constructor() { }

  ngOnInit() {
  }

  onSubmitt({value,valid})
  {
      console.log(value);
      if(valid)
    {
    }
  }

}
