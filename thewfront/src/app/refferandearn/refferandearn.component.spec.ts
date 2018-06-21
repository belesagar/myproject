import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { RefferandearnComponent } from './refferandearn.component';

describe('RefferandearnComponent', () => {
  let component: RefferandearnComponent;
  let fixture: ComponentFixture<RefferandearnComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ RefferandearnComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(RefferandearnComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
