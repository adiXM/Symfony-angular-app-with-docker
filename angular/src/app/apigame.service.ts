import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import {Game} from "./game";

@Injectable({
  providedIn: 'root'
})
export class ApigameService {

  private REST_API_SERVER = "http://localhost:80/api/";

  constructor(private httpClient: HttpClient) { }

  public getAllGames(endpoint: string){
    return this.httpClient.get(this.REST_API_SERVER + endpoint);
  }

  public getGame(endpoint: string, id: string) {
    return this.httpClient.get(this.REST_API_SERVER + endpoint + "/" + id);
  }

  public removeGame(endpoint: string, id : string) {
    return this.httpClient.delete(this.REST_API_SERVER + endpoint + "/" + id);
  }
  public updateGame(endpoint: string, id: string, game: string) {
    return this.httpClient.put<Game>(this.REST_API_SERVER + endpoint + "/" + id, game);
  }
}
