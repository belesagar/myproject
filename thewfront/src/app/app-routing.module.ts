import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';
import { LoginComponent } from './login/login.component';
import { LogoutComponent } from './logout/logout.component';
import { version } from 'punycode';
import { VerifyotpComponent } from './verifyotp/verifyotp.component';
import { DashboardComponent } from './dashboard/dashboard.component';
import { HeaderComponent } from './layout/header/header.component';
import { MiddelComponent } from './layout/middel/middel.component';
import { UserlistComponent } from './users/userlist/userlist.component';
import { PlaceOrderComponent } from './order/place-order/place-order.component';
import { OrderlistComponent } from './order/orderlist/orderlist.component';
import { OrderdetailsComponent } from './order/orderdetails/orderdetails.component';

const routes: Routes = [
  {path:'', component:LoginComponent},
  {path:'login', component:LoginComponent},
  {path:'logout', component:LogoutComponent},
  {path:'verifyotp', component:VerifyotpComponent},
  // {path:'dashboard', component:DashboardComponent},
  { 
    path: '', 
    component: MiddelComponent,
    children: [
      { path: 'dashboard', component: DashboardComponent, pathMatch: 'full'},
      {path:'orderlist', component:OrderlistComponent},
      {path:'userlist', component:UserlistComponent},
      {path:'orderdetails/:id', component:OrderdetailsComponent},
      {path:'placeorder', component:PlaceOrderComponent},
    ]
},
  {
    path:'header', 
    component:HeaderComponent 
  },
];

@NgModule({
  imports: [RouterModule.forRoot(routes, {useHash: true})],
  exports: [RouterModule]
})
export class AppRoutingModule { }
export const routingComponents = [DashboardComponent,LoginComponent,HeaderComponent,VerifyotpComponent,UserlistComponent,PlaceOrderComponent,OrderdetailsComponent,LogoutComponent]