import { BrowserModule } from '@angular/platform-browser';
import { NgModule } from '@angular/core';

import { AppRoutingModule } from './app-routing.module';
import { GameComponentComponent } from './game-component/game-component.component';
import { HttpClientModule } from '@angular/common/http';
import { EditgameComponent } from './editgame/editgame.component';
import {FormsModule} from "@angular/forms";
import {AppComponent} from "./app.component";
import { LoginComponent } from './login/login.component';
import { NewGameComponent } from './new-game/new-game.component';

@NgModule({
  declarations: [
    AppComponent,
    GameComponentComponent,
    EditgameComponent,
    NewGameComponent,
  ],
  imports: [
    BrowserModule,
    HttpClientModule,
    AppRoutingModule,
    FormsModule
  ],
  providers: [],
  bootstrap: [AppComponent]
})
export class AppModule { }
