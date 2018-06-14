import { Component, OnInit, ViewEncapsulation } from '@angular/core';
import { CommonService } from '../../common.service';
const url = 'assets/demo/default/custom/components/forms/widgets/ion-range-slider.js';

@Component({
  selector: 'app-userlist',
  encapsulation:ViewEncapsulation.None,
  templateUrl: './userlist.component.html',
  styleUrls: ['./userlist.component.css']
})
export class UserlistComponent implements OnInit {

  constructor(private commonservice:CommonService) { }

  ngOnInit() {
   
    this.commonservice.loadScript(url);

  }
//   public loadScript() {
//     console.log('preparing to load...')
//     let node = document.createElement('script');
//     node.src = url;
//     node.type = 'text/javascript';
//     document.getElementsByTagName('head')[0].appendChild(node);
// }

}
