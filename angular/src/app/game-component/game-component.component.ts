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

  constructor(private gameService: ApigameService, private route: ActivatedRoute) {
    this.title = "Game Project"
    this.loadingMask = "hide";
    this.notification = "success";
    //this.route.snapshot.params['notification']
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
        }
      );
  }


}
