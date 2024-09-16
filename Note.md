Voici comment insérer une date dans une table MySQL en utilisant le type de données DATE :

## Créer une table avec une colonne DATE

```sql
CREATE TABLE events (
  id INT AUTO_INCREMENT PRIMARY KEY,
  event_name VARCHAR(255) NOT NULL,
  event_date DATE NOT NULL
);
```

La colonne `event_date` est de type DATE et ne peut contenir que des dates valides au format AAAA-MM-JJ.

## Insérer une date manuellement

```sql
INSERT INTO events (event_name, event_date)
VALUES ('Conférence MySQL', '2023-10-29');
```

La date est spécifiée entre apostrophes au format AAAA-MM-JJ.

## Insérer la date actuelle

```sql
INSERT INTO events (event_name, event_date)
VALUES ('Atelier MySQL', CURRENT_DATE());
```

La fonction CURRENT_DATE() retourne la date du jour du serveur MySQL.

## Convertir une chaîne de date

Si votre date n'est pas au format AAAA-MM-JJ, vous pouvez utiliser la fonction STR_TO_DATE() pour la convertir :

```sql
INSERT INTO events (event_name, event_date)
VALUES ('Journée MySQL', STR_TO_DATE('29/10/2023', '%d/%m/%Y'));
```

Ici, le format de la date dans la chaîne est spécifié comme %d/%m/%Y.

En résumé, pour insérer une date dans MySQL :

- Utilisez le type de données DATE pour la colonne
- Spécifiez la date au format AAAA-MM-JJ entre apostrophes 
- Utilisez CURRENT_DATE() pour la date actuelle
- Utilisez STR_TO_DATE() pour convertir une chaîne de date

Assurez-vous que le format de la date correspond bien à celui attendu par MySQL pour éviter les erreurs d'insertion.

Citations:
[1] https://www.statology.org/mysql-insert-date/
[2] https://www.ntchosting.com/encyclopedia/databases/mysql/insert-date/
[3] https://www.mysqltutorial.org/mysql-basics/mysql-insert-date/
[4] https://www.w3schools.com/mysql/mysql_dates.asp
[5] https://www.statology.org/mysql-insert-datetime/
[6] https://stackoverflow.com/questions/9907210/mysql-date-formats-difficulty-inserting-a-date
[7] https://dev.mysql.com/doc/refman/8.4/en/date-and-time-literals.html

---

Pour spécifier qu'une colonne doit être unique dans une table MySQL, vous pouvez utiliser la contrainte UNIQUE. Voici comment procéder :

## Créer une table avec une colonne UNIQUE

```sql
CREATE TABLE users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(255) UNIQUE NOT NULL,
  email VARCHAR(255) NOT NULL
);
```

Dans cet exemple, la colonne `username` est définie comme UNIQUE. Cela signifie que chaque valeur dans cette colonne doit être unique et ne peut pas se répéter.

## Ajouter une contrainte UNIQUE à une table existante

Si vous voulez ajouter une contrainte UNIQUE à une table existante, vous pouvez utiliser l'instruction ALTER TABLE :

```sql
ALTER TABLE users
ADD UNIQUE (email);
```

Cela ajoutera une contrainte UNIQUE sur la colonne `email`.

## Nommer une contrainte UNIQUE

Vous pouvez également nommer explicitement une contrainte UNIQUE pour plus de clarté :

```sql
CREATE TABLE users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(255),
  email VARCHAR(255),
  CONSTRAINT unique_email UNIQUE (email)
);
```

Ici, la contrainte UNIQUE sur la colonne `email` est nommée `unique_email`.

## Vérifier les contraintes UNIQUE existantes

Pour afficher les contraintes UNIQUE d'une table, vous pouvez utiliser la requête suivante :

```sql
SHOW INDEX FROM users WHERE Key_name != 'PRIMARY';
```

Cela affichera toutes les contraintes UNIQUE (et autres index) de la table `users`, à l'exception de la clé primaire.

En résumé, pour définir une colonne comme unique dans MySQL :

- Utilisez le mot-clé UNIQUE lors de la création de la table
- Ajoutez une contrainte UNIQUE avec ALTER TABLE sur une table existante
- Nommez explicitement la contrainte UNIQUE pour plus de clarté
- Vérifiez les contraintes UNIQUE existantes avec SHOW INDEX

Cela garantira que les valeurs dans la colonne spécifiée seront uniques et ne se répéteront pas dans la table.