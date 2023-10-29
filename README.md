# API-RESTfull de la plateforme blog

### L'introduction
Pour ce projet nous allons convertir l'application backend actuelle (l'application du blog qui est telle qu'elle a été presenter lors des cours) en une application API RESTful avec une approche orientée objet(telle qu'indiquer dans le TP#2).
### Caractéristiques
* Les utilisateurs peuvent créer, récupérer, mettre à jour et supprimer des données du blog.
### Guide d'installation
* copier le lien suivant [ici](https://github.com/badia8835/API-Restful-blog).
* Importer la base de données du blog sur le serveur local:
    * Le script de la base de données "blog2023" est dans le dossiée principale;
    * Il est nécessaire de préciser dans le fichier API-RESTful/includes/config.php le nom de la base de données, ainsi que les identifiants "root" et le mot de passe.
* Ouvrir le projet "API RESTfull" dans Visual studio code.
### Utilisation
* Lancez la commande `php -S localhost:3000` dans le terminal de Visual Studio Code pour débuter l'exécution de l'application.
* Connectez-vous à l'API à l'aide de Postman à l'aide de l'URI `http://localhost:3000{api_endpoints}?apiKey={api_key}`.
    * utilisateur: `?apiKey=user_key`
    * administrateur: `?apiKey=admin_key`
* Exemple d'URI pour obtenir la liste de toutes les articles `http://localhost:3000/api/articles?apiKey=user_key`
    * la liste des endpoints de l'API Ci-dessous
### API Endpointes
| Verbes HTTP | Endpoints | Action | Paramètres
| --- | --- | --- | --- |
| GET | /api/articles | Récupère la liste de tous les articles enregistrés. |
| GET | /api/article/{id} | Récupère l’information d’un article spécifique en fonction de leur ID. |  ‘{id}’: L’identifiant unique de l’article. |
| POST | /api/articles/create | créer un nouvel article |
| PUT | /api/article/update/{id} | Mettre à jour les informations d’un article existant en fonction de son ID. | ‘{id}’: L’identifiant unique de l’article. |
| PATCH | /api/articles/update_title/{id} | Mettre à jour le titre d’un article spécifique en fonction de son ID. Seuls les champs spécifiés seront modifiés. | ‘{id}’: L’identifiant unique de l’article. |
| DELETE | /api/articles/delete/{id} | supprimer un article spécifique en fonction de son ID. | ‘{id}’: L’identifiant unique de l’article. |
### Technologies utilisées
* [PHP](https://www.php.net/downloads.php) PHP (Hypertext Preprocessor) est un langage de scripts conçu pour le développement d'applications Web.
* [Composer](https://getcomposer.org/download/) Composer est un gestionnaire de dépendances pour les projets PHP. Il permet de gérer les bibliothèques et les packages nécessaires à votre application PHP en automatisant le processus de téléchargement, d'installation et de mise à jour des dépendances.
* [Slim Framework](https://www.slimframework.com/docs/v4/) Slim est un framework PHP léger et minimaliste conçu pour la création d'applications web et d'APIs (interfaces de programmation d'applications) RESTful.
This is a NodeJS web application framework.
* [MySQL Workbench and Server](https://dev.mysql.com/downloads/workbench/) est un outil de modélisation de BD qui intègre:
Le développement SQL, l’administration de BD, le design de BD, la création et la maintenance de BD.
### Auteurs
* [Joelle Audet](https://github.com/joe1824579)
* [Badia Sellam](https://github.com/badia8835)
* [Mélanie Baril]()
