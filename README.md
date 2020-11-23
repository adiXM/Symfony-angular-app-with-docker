# Symfony-angular-app-with-docker

Pentru a rula proiectul trebuie rulate aceste comenzi:

<code>docker-compose up --build<code>

Pentru partea de symfony, e nevoie de adaugat dependentele astfel:

Deschide CLI pentru container-ul de php si apoi ruleaza <code>composer install<code>
  
  
Ar trebui acum sa fie instalat angular : http://localhost:4200/ si symfony http://localhost

Tot in containerul de php trebuie rulat <code> php bin/console doctrine:database:create</code> si <code>php bin/console doctrine:migrations:migrate</code> pentru a genera baza de date si tabelele aferente.

Pentru generarea unui cont de administrator, rulam <code>http://localhost/api/generate_data</code>
