import {Component, ElementRef, OnInit} from '@angular/core';
import {ApigameService} from "../apigame.service";

@Component({
  selector: 'game-component',
  templateUrl: './game-component.component.html',
  styleUrls: ['./game-component.component.css']
})
export class GameComponentComponent implements OnInit {

  public games : any = [];
  public title;
  public loadingMask;

  constructor(private gameService: ApigameService, private elRef:ElementRef) {
    this.title = "Game Project"
    this.loadingMask = "hide";
  }

  ngOnInit(): void {
    this.getAllGames();
  }
  /*ngAfterViewInit() {
    // assume dynamic HTML was added before
    this.elRef.nativeElement.querySelector('.remove-game').addEventListener('click',
      this.removeGame.bind(this)
    );
  }*/
  getAllGames(){
    /*var item = {
      name : "game name",
      desc: "desc",
      store : "store"
    }
    this.games.push(item);
    this.games.push(item);*/
    this.loadingMask = "show";
    this.gameService.getAllGames("get_games").subscribe((data: any)=>{
      console.log(data);
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
