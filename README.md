Gestion des Billets – JO 2024

Ce projet est une application web de gestion de billets pour les Jeux Olympiques de Paris 2024, réalisée dans le cadre du BTS SIO SLAM à l'ESIC.

Fonctionnalités

- Inscription et connexion des utilisateurs
- Tableau de bord des billets
- CRUD complet sur les billets (Ajouter, Modifier, Supprimer)
- Liste des billets avec informations : nom, email, événement, date, type
- Sécurité simple par sessions PHP

Technologies utilisées

- PHP (Back-end)
- MySQL (Base de données)
- HTML / CSS (Frontend)
- WAMP (Environnement de développement local)

Structure du projet

```
gestion_billets_jo/
├── add_ticket.php
├── dashboard.php
├── delete_ticket.php
├── edit_ticket.php
├── includes/
│   └── db.php
├── index.php
├── login.php
├── logout.php
├── register.php
├── css/
│   └── style.css
└── js/
    └── app.js
```

Installation

1. Cloner le projet dans `C:/wamp64/www` :
```
git clone https://github.com/votre-utilisateur/gestion_billets_jo.git
```

2. Lancer WAMP puis accéder à [http://localhost/phpmyadmin](http://localhost/phpmyadmin)

3. Importer le fichier `jo2024_billets.sql` dans une base de données nommée `jo2024`

4. Lancer l'application depuis :
```
http://localhost/gestion_billets_jo/login.php
```

Identifiants test
- À créer via le formulaire d'inscription (`register.php`)

Réalisé par
**Rayan Fibleuil – BTS SIO SLAM – ESIC** – Juin 2025
