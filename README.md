# API-Restful-blog

Documentation de l’API RESTful “Blog”

 

Introduction 
Voici la documentation de L’API RESTful “Blog”! Cette API permet de gère les ressources par exemple des utilisateurs, des articles et autre à l’aide des méthode http standard. Pour notre part nous avons seulement utiliser les articles.

 

 

Points d’accès (Endpoint)

 

Les points d’accès suivants sont disponibles dans l’API:

 

Ressource “Article”

 

Récupérer tous les Articles
•    URL:’/api/articles’
•    Méthode: ’GET’
•    Description : Récupère la liste de tous les articles enregistrés dans le système.
•    Réponse : Un tableau JSON contenant les informations de tous les articles.

 

Récupérer un Articles par un ID
•    URL:’/api/article/{id}’
•    Méthode: ’GET’
•    Description : Récupère l’information d’un article spécifique en fonction de leur ID.
•    Paramètre de l’URL :
           ‘{id}’: L’identifiant unique de l’article. 
•    Réponse : Un objet JSON contenant les informations de l’article.

 

 

Créer un Articles
•    URL:’/api/article/create’
•    Méthode: ’POST’
•    Description : créer un nouvel article dans le système.
•    Corps de la requête : Un objet JSON contenant les détails du nouvel article à créer.
•    Réponse : Un objet JSON contenant les informations du nouvel article.

 

 

Mettre à jour un Articles 
•    URL:’/api/articles/create’
•    Méthode: ’Put’
•    Description : Mettre à jour les informations d’un article existant en fonction de son ID.
•    Paramètre de l’URL :
           ‘{id}’: L’identifiant unique de l’article. 
•    Corps de la requête : Un objet JSON contenant les nouvelles informations de l’article.
•    Réponse : Un objet JSON contenant les informations de l’article après la mise à jour.

 

 

Mettre à jour un titre d’Articles 
•    URL:’/api/articles/update_title/{id}’
•    Méthode: ’Patch’
•    Description : Mettre à jour le titre d’un article spécifique en fonction de son ID. Seuls les champs spécifiés seront modifiés.
•    Paramètre de l’URL :
           ‘{id}’: L’identifiant unique de l’article. 
•    Corps de la requête : Un objet JSON contenant les champs à mettre à jour.
•    Réponse : Un objet JSON contenant les informations de l’article après la mise à jour du titre.

 

 

Supprimer un Articles
•    URL:’/api/articles/delete/{id}’
•    Méthode: ’DELETE’
•    Description : supprimer un article spécifique en fonction de son ID.
•    Paramètre de l’URL :
           ‘{id}’: L’identifiant unique de l’article. 
•    Réponse : Un message de confirmation indiquant que l’objet a été supprimer avec succès.

 

 

Codes d’état HTTP

 

Voici une liste des codes d’état http utilisés dans les réponses API
•    200 OK : La requête a réussi, La réponse contient les données demandées.
•    201 Created : la resource a été créée avec succès.
•    204 No Content : La requête a réussi, mais il n’y a pas de contenue à renvoyer.
•    400 Bad request : La requête était invalide ou mal formée.
•    404 Not Found : La ressource demandée n’a demandé n’a pas trouvée.
•    500 Internal Server Error : Une erreur interne du serveur s’est produite.

 

 

Exemples
  // Définition d'une route pour recuperer un seul article

 

$app->get('/api/article/{id}', function (Request $request, Response $response, $args) use ($db) {

 

    // Get the article ID from the URL

 

    $id = $args['id'];

 

 

    // Instantiation du modèle article en passant la connexion à la base de données

 

    $article = new Article($db);

 

 

     // Récupération un article depuis la base de données

 

     $result = $article->retrieveArticle($id);

 

 

     // Vérification si des articles ont été trouvés

 

     if ($result->rowCount() > 0) {

 

         $articles = $result->fetchAll(PDO::FETCH_ASSOC);

 

 

         // Retour l'articles en tant que réponse JSON

 

         $response->getBody()->write(json_encode($articles));

 

         return $response->withHeader('Content-Type', 'application/json')->withStatus(200);

 

       

 

     }

 

     else {

 

        // Aucun article trouvé

 

         $response->getBody()->write(json_encode(['message' => 'No articles found.']));

 

         return $response->withHeader('Content-Type', 'application/json')->withStatus(404);

 

     }

 

});

 

 

Exemple: 
public function retrieveArticle($id)

 

    {

 

        // créer une requête

 

        $query = 'SELECT

 

            c.name as category_name,

 

            a.id,

 

            a.category_id,

 

            a.title,

 

            a.url_image,

 

            a.content

 

            FROM

 

            ' . $this->table . ' a

 

            LEFT JOIN

 

            categories c ON a.category_id = c.id

 

            WHERE a.id = :id';

 

                   

 

            //préparer la déclaration

 

            $stmt = $this->conn->prepare($query);

 

 

            // Paramètre de liaison

 

            $stmt->bindParam(':id', $id);

 

 

            //exécuter la requête

 

            $stmt->execute();

 

 

            return $stmt;

 

    }    

 


Conclusion
Vous pouvez maintenant utiliser ces points d’accès pour gérer les utilisateurs et les articles de votre application. Si vous avez des questions ou des problèmes n’hésitez pas à nous contacter.