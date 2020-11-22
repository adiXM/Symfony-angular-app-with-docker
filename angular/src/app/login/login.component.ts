import {Component, Input, OnInit} from '@angular/core';
import {UserService} from "../user.service";
import { ActivatedRoute, Router } from '@angular/router';
import {HttpParams} from "@angular/common/http";


@Component({
  selector: 'app-login',
  templateUrl: './login.component.html',
  styleUrls: ['./login.component.css']
})
export class LoginComponent implements OnInit {

  @Input() userDataModel: any = {
    username: "",
    password: ""
  };

  constructor(private userService: UserService, private route: ActivatedRoute, private router: Router) { }

  ngOnInit(): void {

  }

  login(): void {
    debugger;
    const params = new HttpParams().append('username', this.userDataModel.username).append('password', this.userDataModel.password);
    this.userService.loginUser("login", params).subscribe((result: any) => {
      console.log(result);
      //this.router.navigate(['/home/']);
    }, (err) => {
      console.log(err);
    });
  }

  getUserLoggedIn(): void {
    debugger;

    const params = new HttpParams().append('username', this.userDataModel.username).append('password', this.userDataModel.password);
    this.userService.getIsLoggedIn("api/get_user").subscribe((result: any) => {
      console.log(result);
      //this.router.navigate(['/home/']);
    }, (err) => {
      console.log(err);
    });
  }

}
