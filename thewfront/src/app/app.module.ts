import { BrowserModule } from '@angular/platform-browser';
import { NgModule } from '@angular/core';
import { FormsModule } from '@angular/forms';
import { HttpClientModule} from '@angular/common/http';
import { AppRoutingModule, routingComponents } from './app-routing.module';

import { AppComponent } from './app.component';
import { MiddelComponent } from './layout/middel/middel.component';
import { HeaderComponent } from './layout/header/header.component';
import { SidebarComponent } from './layout/sidebar/sidebar.component';
import { FooterComponent } from './layout/footer/footer.component';
import { HeaderLayoutComponent } from './layout/header-layout/header-layout.component';
import { UserlistComponent } from './users/userlist/userlist.component';
import { Constant } from './constant/constant.component';
import { TosterService } from './toster-service.service';
import { CommonService } from './common.service';
import { PlaceOrderComponent } from './order/place-order/place-order.component';
import { LocalStorageServiceService } from './local-storage-service.service';
import { AuthinterceptorsService } from './interceptors/authinterceptors.service';
import { HTTP_INTERCEPTORS} from '@angular/common/http';
import { OrderdetailsComponent } from './order/orderdetails/orderdetails.component';
import { OrderlistComponent } from './order/orderlist/orderlist.component';
import { LogoutComponent } from './logout/logout.component';
import { LoaderComponent } from './layout/loader/loader.component';
import { LoadingModule } from 'ngx-loading';
import { Ng4LoadingSpinnerModule } from 'ng4-loading-spinner';

@NgModule({
  declarations: [
    AppComponent,
    routingComponents,
    MiddelComponent,
    HeaderComponent,
    SidebarComponent,
    FooterComponent,
    HeaderLayoutComponent,
    UserlistComponent,
    Constant,
    PlaceOrderComponent,
    OrderdetailsComponent,
    OrderlistComponent,
    LogoutComponent,
    LoaderComponent
  ],
  imports: [
    BrowserModule,
    AppRoutingModule,
    FormsModule,
    HttpClientModule,
    LoadingModule,
    Ng4LoadingSpinnerModule.forRoot()
  ],
  providers: [
    {
      provide:HTTP_INTERCEPTORS,
      useClass:AuthinterceptorsService,
      multi:true,
    },
    TosterService,
    CommonService,
    LocalStorageServiceService,
    AuthinterceptorsService],
  bootstrap: [AppComponent]
})
export class AppModule { }
