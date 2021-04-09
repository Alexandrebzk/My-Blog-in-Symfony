## Configuration

### Modifier le .env avec la bonne BDD
```
DATABASE_URL="mysql://USERNAME:PASSWORD@HOST:PORT/DB_NAME?serverVersion=SERVER_VERSION"
```
### Créer la bdd

```
symfony console doctrine:database:create
```
### Créer les tables etc
```
symfony console doctrine:migrations:migrate
```
### Remplir la bdd
```
symfony console doctrine:fixtures:load
```
Utilisateur exemple : mail@mail.com/1234567
### run le serveur
```
symfony serve
```
### Aller voir ce que ça donne
[My blog](http://localhost:8000/home)
