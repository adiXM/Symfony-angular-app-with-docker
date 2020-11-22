import { Injectable } from '@angular/core';
import {HttpClient, HttpHeaders, HttpParams} from "@angular/common/http";

@Injectable({
  providedIn: 'root'
})
export class UserService {

  private REST_API_SERVER = "http://localhost:80/";

  public userData : object = [];

  constructor(private httpClient: HttpClient) { }

  public loginUser(endpoint: string, loginData: HttpParams) {
    return this.httpClient.get(this.REST_API_SERVER + endpoint + "/",{params: loginData});
  }

  public getUserData(){
    this.userData = {
      "username" : localStorage.getItem('username'),
      "token" : localStorage.getItem('token')
    };
    return this.userData;
  }

  public getIsLoggedIn(endpoint: string) {

    const HTTP_OPTIONS = {
      headers: new HttpHeaders({
        'Content-Type':  'application/json',
        'Access-Control-Allow-Credentials' : 'true',
        'Access-Control-Allow-Origin': '*',
        'Access-Control-Allow-Methods': 'GET, POST, PATCH, DELETE, PUT, OPTIONS',
        'Access-Control-Allow-Headers': 'Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With',
      })
    };
    const head = new HttpHeaders({
      'Access-Control-Allow-Credentials': 'true'
    });

    head.append('Access-Control-Allow-Methods', 'GET');
    debugger;
    return this.httpClient.get(this.REST_API_SERVER + endpoint + "/", {
      withCredentials: true,
      headers: head
    });
  }


}
