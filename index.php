<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use Slim\Middleware\MethodOverrideMiddleware; // needs to be enabled in the case of delete
use DI\Container;
use Slim\Factory\AppFactory;

require_once __DIR__ . '/vendor/autoload.php';

// Inclusion du fichier de configuration
require_once __DIR__ . '/includes/config.php';

// Inclusion du fichier du modèle
require_once __DIR__ . '/core/article.php';

// Création d'un conteneur
$container = new Container();

// Création d'une nouvelle instance de l'application Slim avec le conteneur
$app = AppFactory::create(null, $container);

// Activation de la surcharge de méthode (dans le cas de DELETE)
$app->addRoutingMiddleware();
$app->add(MethodOverrideMiddleware::class);

// Ajout du middleware de parsing du corps des requêtes
$app->addBodyParsingMiddleware();


// Définition d'une route pour récupérer les articles
$app->get('/api/articles', function (Request $request, Response $response, array $args) use ($db) {
   
    // Instantiate the article model and pass the database connection
    $article = new Article($db);

     // Récupération des articles depuis la base de données
    $result = $article->read();

    // Vérification si des articles ont été trouvés
    if ($result->rowCount() > 0) {
        $articles = $result->fetchAll(PDO::FETCH_ASSOC);

        // Retour des articles en tant que réponse JSON
        $response->getBody()->write(json_encode($articles));
        return $response->withHeader('Content-Type', 'application/json')->withStatus(200);
       
    }
    else {
       // Aucun article trouvé
        $response->getBody()->write(json_encode(['message' => 'No articles found.']));
        return $response->withHeader('Content-Type', 'application/json')->withStatus(404);
    }

});

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

// Définition d'une route pour supprimer un article
$app->delete('/api/article/delete/{id}', function (Request $request, Response $response, $args) use ($db) {
    // Get the article ID from the URL
    $id = $args['id'];

    // Instantiation du modèle article en passant la connexion à la base de données
    $article = new Article($db);

    // Suppression de l'article
    if ($article->delete($id)) {
       // Retour d'une réponse JSON de succès
        $data = ['message' => 'article deleted successfully'];
        $response->getBody()->write(json_encode($data));
        return $response->withHeader('Content-Type', 'application/json')->withStatus(200);

    } else {
        // Retour d'une réponse JSON d'erreur
        $data = ['message' => 'Failed to delete article'];
        $response->getBody()->write(json_encode($data));
        return $response->withHeader('Content-Type', 'application/json')->withStatus(500);
    }
});

// Définition d'une route pour mettre à jour un article
$app->put('/api/article/update/{id}', function (Request $request, Response $response, $args) use ($db) {
    // Récupération de l'ID de l'article depuis l'URL
    $id = $args['id'];

    // Récupération des données mises à jour de l'article depuis le corps de la requête
    $data = $request->getParsedBody();
    $title = $data['title'] ?? '';
    $content = $data['content'] ?? '';
    $url_image = $data['url_image'] ?? '';
    // Instantiation du modèle article en passant la connexion à la base de données
    $article = new Article($db);

    // Update the article
    if ($article->update($id, $title, $content,$url_image)) {
        // Return a success JSON response
        $data = ['message' => 'article updated successfully'];
        $response->getBody()->write(json_encode($data));
        return $response->withHeader('Content-Type', 'application/json')->withStatus(200);
    } else {
        // Return an error JSON response
        $data = ['message' => 'Failed to update article'];
        $response->getBody()->write(json_encode($data));
        return $response->withHeader('Content-Type', 'application/json')->withStatus(500);
    }
});

$app->patch('/api/article/update_title/{id}', function (Request $request, Response $response, $args) use ($db) {
    // Get the article ID from the URL
    $id = $args['id'];

    // Get the updated article data from the request body
    $data = $request->getParsedBody();
    $title = $data['title'] ?? '';
   

    // Instantiate the article model and pass the database connection
    $article = new Article($db);

    // Update the article
    if ($article->update_title($id, $title)) {
        // Return a success JSON response
        $data = ['message' => 'article title updated successfully'];
        $response->getBody()->write(json_encode($data));
        return $response->withHeader('Content-Type', 'application/json')->withStatus(200);
    } else {
        // Return an error JSON response
        $data = ['message' => 'Failed to update title of the article'];
        $response->getBody()->write(json_encode($data));
        return $response->withHeader('Content-Type', 'application/json')->withStatus(500);
    }
});

// Définition d'une route pour creer un nouveau  article
$app->post('/api/article/create', function (Request $request, Response $response, $args) use ($db) {
 

    // Récupération les nouvelles données pour creer un nouveau article
    $data = $request->getParsedBody();
    $title = $data['title'] ?? '';
    $content = $data['content'] ?? '';
    $url_image = $data['url_image'] ?? '';
    $category_id = $data['category_id'] ?? '';
    // Instantiation du modèle article en passant la connexion à la base de données
    $article = new Article($db);

    // Update the article
    if ($article->create($title, $content,$url_image,$category_id)) {
        // Return a success JSON response
        $data = ['message' => 'article created successfully'];
        $response->getBody()->write(json_encode($data));
        return $response->withHeader('Content-Type', 'application/json')->withStatus(200);
    } else {
        // Return an error JSON response
        $data = ['message' => 'Failed to create article'];
        $response->getBody()->write(json_encode($data));
        return $response->withHeader('Content-Type', 'application/json')->withStatus(500);
    }
});

// Run the Slim app
$app->run();
