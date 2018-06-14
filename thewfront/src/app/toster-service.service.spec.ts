import { TestBed, inject } from '@angular/core/testing';

import { TosterServiceService } from './toster-service.service';

describe('TosterServiceService', () => {
  beforeEach(() => {
    TestBed.configureTestingModule({
      providers: [TosterServiceService]
    });
  });

  it('should be created', inject([TosterServiceService], (service: TosterServiceService) => {
    expect(service).toBeTruthy();
  }));
});
