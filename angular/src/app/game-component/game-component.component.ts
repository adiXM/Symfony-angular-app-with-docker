import {Component, ElementRef, OnInit} from '@angular/core';
import {ApigameService} from "../apigame.service";
import {ActivatedRoute, Router} from "@angular/router";

@Component({
  selector: 'game-component',
  templateUrl: './game-component.component.html',
  styleUrls: ['./game-component.component.css']
})
export class GameComponentComponent implements OnInit {

  public games : any = [];
  public title;
  public loadingMask;
  public notification = '';

  constructor(private gameService: ApigameService, private route: Router) {
    this.title = "Game Project"
    this.loadingMask = "hide";
    debugger;
    if(window.history.state.notification !== undefined) {
      this.notification = window.history.state.notification;
    }
  }

  ngOnInit(): void {
    this.getAllGames();
  }
  getAllGames(){
    this.loadingMask = "show";
    this.gameService.getAllGames("get_games").subscribe((data: any)=>{
      this.games = data;
      this.loadingMask = "hide";
    })
  }
  removeGame(id: string) {
    this.gameService.removeGame("remove_game",id)
      .subscribe(() => {
          this.getAllGames();
        }, (err) => {
          console.log(err);
          this.notification = "You ar not logged or logged in as administrator";
        }
      );
  }


}
