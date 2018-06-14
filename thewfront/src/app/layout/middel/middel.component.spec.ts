import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { MiddelComponent } from './middel.component';

describe('MiddelComponent', () => {
  let component: MiddelComponent;
  let fixture: ComponentFixture<MiddelComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ MiddelComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(MiddelComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
