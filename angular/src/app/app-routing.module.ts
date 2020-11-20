import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';
import {GameComponentComponent} from "./game-component/game-component.component";
import {EditgameComponent} from "./editgame/editgame.component";

const routes: Routes = [
  { path: '', redirectTo: 'home', pathMatch: 'full'},
  { path: 'home', component: GameComponentComponent },
  { path: 'edit-game/:id', component: EditgameComponent, data: { title: 'Edit Game' }}

];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }

