# YouQuote API

YouQuote est une API développée en Laravel pour gérer des citations. Elle permet aux utilisateurs de créer, lire, mettre à jour et supprimer des citations, ainsi que d'obtenir des citations aléatoires et de filtrer les citations en fonction de leur longueur. L'API suit également la popularité des citations et offre une fonctionnalité bonus de génération d'images pour les citations populaires. Une authentification sécurisée via JWT est disponible pour permettre aux utilisateurs de gérer leurs propres citations.

## Fonctionnalités

### Fonctionnalités principales
- **Gestion des citations (CRUD)** : Créer, lire, mettre à jour et supprimer des citations.
- **Citations aléatoires** : Obtenir une ou plusieurs citations de manière aléatoire.
- **Filtrage par longueur** : Filtrer les citations en fonction du nombre de mots.
- **Suivi de la popularité** : Enregistrer la fréquence des demandes pour chaque citation.

### Fonctionnalités bonus
- **Génération d'images** : Créer des images stylisées pour les citations populaires.
- **Authentification** : Gestion sécurisée des utilisateurs via JWT (optionnel).

## Technologies utilisées
- **Backend** : Laravel (architecture monolithique)
- **Base de données** : MySQL ou PostgreSQL
- **Génération d'images** : Intervention Image
- **Authentification** : JWT (JSON Web Tokens)
- **Déploiement** : AWS EC2, Azure VM, ou DigitalOcean Droplet

## Installation

1. Clonez le dépôt :
   ```bash
   git clone https://github.com/bouchramilo/YouQuote-api.git

2. Installez les dépendances :
 ```bash
composer install
````
3. Configurez le fichier .env avec vos informations de base de données.

4. Exécutez les migrations :
 ```bash
php artisan migrate
```
Lancez le serveur :
 ```bash
php artisan serve
```
### Utilisation
**Endpoints de l'API**
- GET /quotes : Récupérer toutes les citations.

- GET /quotes/random : Obtenir une citation aléatoire.

- POST /quotes : Créer une nouvelle citation.

- PUT /quotes/{id} : Mettre à jour une citation existante.

- DELETE /quotes/{id} : Supprimer une citation.

- GET /quotes/popular : Récupérer les citations les plus populaires.

- POST /auth/register : S'inscrire (optionnel).

- POST /auth/login : Se connecter (optionnel).

### Conception UML
Un diagramme UML est disponible dans le dossier docs pour visualiser l'architecture et les relations entre les différentes entités de l'API.
