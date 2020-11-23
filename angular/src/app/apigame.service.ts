import { Injectable } from '@angular/core';
import {HttpClient, HttpHeaders, HttpParams, HttpErrorResponse} from '@angular/common/http';
import {Game} from "./game";
import { Observable, throwError } from 'rxjs';
import { catchError } from 'rxjs/internal/operators';

@Injectable({
  providedIn: 'root'
})
export class ApigameService {

  private REST_API_SERVER = "http://localhost:80/api/";

  constructor(private httpClient: HttpClient) { }

  private handleError(error: HttpErrorResponse): any {
    if (error.error instanceof ErrorEvent) {
      console.error('An error occurred:', error.error.message);
    } else {
      console.error(
        `Backend returned code ${error.status}, ` +
        `body was: ${error.error}`);
    }
    return throwError(
      'Something bad happened; please try again later.');
  }

  public getAllGames(endpoint: string){
    return this.httpClient.get(this.REST_API_SERVER + endpoint).pipe(
      catchError(this.handleError)
    );
  }

  public getGame(endpoint: string, id: string) {
    return this.httpClient.get(this.REST_API_SERVER + endpoint + "/" + id, {withCredentials: true}).pipe(
      catchError(this.handleError)
    );
  }

  public removeGame(endpoint: string, id : string) {
    return this.httpClient.delete(this.REST_API_SERVER + endpoint + "/" + id, {withCredentials: true}).pipe(
      catchError(this.handleError)
    );
  }
  public updateGame(endpoint: string, id: string, game: Game) {
    const params = new HttpParams()
      .set('name', game.name)
      .set('description', game.description)
      .set('store', game.store);
    return this.httpClient.post(this.REST_API_SERVER + endpoint + "/" + id, params, {withCredentials: true}).pipe(
      catchError(this.handleError)
    );
  }
  public newGame(endpoint: string, game: Game) {
    const params = new HttpParams()
      .set('name', game.name)
      .set('description', game.description)
      .set('store', game.store);
    return this.httpClient.post(this.REST_API_SERVER + endpoint, params).pipe(
      catchError(this.handleError)
    );
  }
}
