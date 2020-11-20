import { TestBed } from '@angular/core/testing';

import { ApigameService } from './apigame.service';

describe('ApigameService', () => {
  let service: ApigameService;

  beforeEach(() => {
    TestBed.configureTestingModule({});
    service = TestBed.inject(ApigameService);
  });

  it('should be created', () => {
    expect(service).toBeTruthy();
  });
});
