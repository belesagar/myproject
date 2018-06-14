import { TestBed, inject } from '@angular/core/testing';

import { AuthinterceptorsService } from './authinterceptors.service';

describe('AuthinterceptorsService', () => {
  beforeEach(() => {
    TestBed.configureTestingModule({
      providers: [AuthinterceptorsService]
    });
  });

  it('should be created', inject([AuthinterceptorsService], (service: AuthinterceptorsService) => {
    expect(service).toBeTruthy();
  }));
});
