
###### Formation OPENCLASSROOMS

# Chef de projet multimédia - Développement -projet3

**Enoncé :**
Vous venez de décrocher un contrat avec Jean Forteroche, acteur et écrivain. Il travaille actuellement sur son prochain roman, "Billet simple pour l'Alaska". Il souhaite innover et le publier par épisode en ligne sur son propre site.

Seul problème : Jean n'aime pas WordPress et souhaite avoir son propre outil de blog, offrant des fonctionnalités plus simples. Vous allez donc devoir développer un moteur de blog en PHP et MySQL.
Le livre de Jean Forteroche reste à écrire... mais il sera publié en ligne !
Le livre de Jean Forteroche reste à écrire... mais il sera publié en ligne !

Vous développerez une application de blog simple en PHP et avec une base de données MySQL. Elle doit fournir une interface frontend (lecture des billets) et une interface backend (administration des billets pour l'écriture). On doit y retrouver tous les éléments d'un CRUD :

    Create : création de billets
    Read : lecture de billets
    Update : mise à jour de billets
    Delete : suppression de billets

Chaque billet doit permettre l'ajout de commentaires, qui pourront être modérés dans l'interface d'administration au besoin.
Les lecteurs doivent pouvoir "signaler" les commentaires pour que ceux-ci remontent plus facilement dans l'interface d'administration pour être modérés.

L'interface d'administration sera protégée par mot de passe. La rédaction de billets se fera dans une interface WYSIWYG basée sur TinyMCE, pour que Jean n'ait pas besoin de rédiger son histoire en HTML (on comprend qu'il n'ait pas très envie !).

Vous développerez en PHP sans utiliser de framework pour vous familiariser avec les concepts de base de la programmation. Le code sera construit sur une architecture MVC. Vous développerez autant que possible en orienté objet (au minimum, le modèle doit être construit sous forme d'objet).


Fichiers à fournir

    Code HTML, CSS, PHP et JavaScript
    Export de la base de données MySQL
    Lien vers la page GitHub contenant l'historique des commits
    (votre historique de commits doit montrer une progression régulière par petites étapes)


La soutenance se déroulera en visioconférence avec un mentor validateur. Pour cette soutenance, vous vous positionnerez comme un développeur présentant pendant 25 minutes son travail à son collègue plus senior dans l’agence web afin de vérifier que le projet peut être présenté tel quel à Jean Forteroche. Cette étape sera suivie de 5 minutes de questions/réponses.
Compétences évaluées
Analyser les données utilisées par le site ou l’application
Créer un site Internet, de sa conception à sa livraison
Soutenir et argumenter ses propositions
Récupérer les données d’une base
Récupérer la saisie d’un formulaire utilisateur en langage PHP
Organiser le code en langage PHP
Insérer ou modifier les données d’une base
Construire une base de données
Réalisation d'un blog.

###### Besoin du client:

    Interface CRUD (Create, Read, Update, Delete)
    Interface de rédaction -> TinyMCE
    Commentaires possible sur chaque billet, avec possibilité d'en signaler un pour être modéré
    Administration protégée par un mot de passe

###### Contraintes techniques:

    Base de bonnées MySQL
    Frontend lecture de billet
    Backend administration des billets pour l'écture
    CRUD (create, raed, update, delete)
    Ajout de commentaires possible + médération dans administration
    Possible de signaler les billets
    Interface d'administration basé sur une interface WYSIWYG basé sur TinyMCE.
    Favoriser la POO
    Pattern MVC
### Créer le projet "LiteraryBlog":



Cloner le projet sur Github a partir de son Url ou télécharger le fichier Zip.
Installer les fichiers

######Fichier Config.php

Dans le dossier config faites un 'copier/coller' du fichier _`Config.php.dist`_ et supprimer l’extension .dist

Si vous ne travaillez pas en localhost, ouvrer le fichier et faite vos modifications.

######Base de données

Dans votre système de gestion de bases de données, Créez une bd "**alaskabook**"

Importer à partir du dossier sql, le fichier _`alaskabookStructure.sql`_ et installer les tables.
Si besoin, importer les exemples avec le fichier _`alaskabookFixtures.sql`_

######Configurer l’autoload

Installer composer et faites un `composer require composer/composer` dans votre dossier literaryBlog

Packagist à installer avec composer :

    composer require twig/twig
    composer require twig/extensions
    composer require google/recaptcha

###### Accès à l'administration:

    Authentifiant: Forteroche
    Mot de passe: forteroche
