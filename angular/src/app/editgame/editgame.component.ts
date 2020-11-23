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
      const data = {notification : "Success!"};
      this.router.navigate(['/home/', JSON.stringify(data)]);
    })
  }
  updateGame(): void {
    console.log(this.gameData);
    this.gameService.updateGame("update_game",this.route.snapshot.params.id, this.gameData).subscribe((result) => {
      this.router.navigate(['/home/']);
    }, (err) => {
      console.log(err);
    });
  }

}
