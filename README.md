Initialisation du projet sur gitlab avant la création du github.

E-commerce : "pizza au lit".
Projet de création en PHP Symfony, Twig & MySQL d'un site de vente de pizzas d'après un cahier des charges.

Le site comprend :
- Une page d'accueil présentant l'établissement.
- Des pages d'inscriptions et de connexion.
- Un catalogue de produits illustrant ces derniers par une image, un nom, une liste des ingredients, une taille , un prix et la possibilité de choisir une quantité d'ajout au panier.
- Une page unique pour chacun des produits.
- Un panier contenant les pizzas choisies, avec possibilité d'incrémenter, décrémenter, supprimer chaque produit.
- Un profil utilisateur sur lequel il est possible de modifier ses coordonnées, consulter l'historique de ses commandes, et reitérer une commande facilement.
- un tableau de bord d'administrateur (le vendeur), lui permettant d'utiliser les actions de CRUD sur les produits , les commandes, et les utilisateurs inscrits.


Créer un containeur docker à l'aide des Dockerfile et Docker-compose fournis.

ROUTES :

localhost:8000/home       : renvoi à la page d'accueil
localhost:8000/register   : renvoi à la page d'inscription
localhost:8000/login      : renvoi à la page de connexion 
localhost:8000/catalogue   : renvoi au catalogue de produits 
localhost:8000/panier     : renvoi au panier du visiteur / utilisateur
localhost:8000/pizza{id}  : renvoi à la page du produit selectionné
localhost:8000/profiluser  : renvoi à la page d'édition du profil utilisateur
localhost:8000/admin      : renvoi au tableau de bord d'administration.

