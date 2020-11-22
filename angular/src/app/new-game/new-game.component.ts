import {Component, Input, OnInit} from '@angular/core';
import {ApigameService} from "../apigame.service";
import {ActivatedRoute, Router} from "@angular/router";

@Component({
  selector: 'app-new-game',
  templateUrl: './new-game.component.html',
  styleUrls: ['./new-game.component.css']
})
export class NewGameComponent implements OnInit {

  @Input() gameData: any = {name: '', store: '', description: ''};

  constructor(private gameService: ApigameService, private route: ActivatedRoute, private router: Router) { }


  ngOnInit(): void {
  }

  createNewGame(): void {
    this.gameService.newGame("new_game", this.gameData).subscribe((result) => {
      console.log(result);
      this.router.navigate(['/home/']);
    }, (err) => {
      console.log(err);
    });
  }

}
