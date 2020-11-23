import { Component, OnInit, Input } from '@angular/core';
import {ApigameService} from "../apigame.service";
import { ActivatedRoute, Router } from '@angular/router';


@Component({
  selector: 'app-editgame',
  templateUrl: './editgame.component.html',
  styleUrls: ['./editgame.component.css']
})
export class EditgameComponent implements OnInit {

  @Input() gameData: any = {name: '', store: '', description: ''};

  constructor(private gameService: ApigameService, private route: ActivatedRoute, private router: Router) { }

  ngOnInit(): void {
    debugger;
    this.gameService.getGame("get_game", this.route.snapshot.params.id).subscribe((data: any) => {
      console.log(data);
      this.gameData = data;
    }, (err) => {
      console.log(err);
      const notif = {notification : "You ar not logged or logged in as administrator"};
      this.router.navigate(['/home/'], {state: notif});
    })
  }
  updateGame(): void {
    console.log(this.gameData);
    this.gameService.updateGame("update_game",this.route.snapshot.params.id, this.gameData).subscribe((result) => {
      const notif = {notification : "Success!"};
      this.router.navigate(['/home/'], {state: notif});
    }, (err) => {
      console.log(err);
      const notif = {notification : "You ar not logged or logged in as administrator"};
      this.router.navigate(['/home/'], {state: notif});
    });
  }

}
