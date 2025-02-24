# PHPSimul avec Laravel

**PHPSimul** est un projet qui a vu le jour en 2006 sous forme d'un script PHP/SQL créé par une équipe de développeurs amateurs, menée par Sébastien CAPARROS. Ce projet permettait de créer un **jeu par navigateur**, à l'instar de jeux populaires comme OGame, Les Royaumes Renaissants ou Travian. Sa grande particularité résidait dans sa flexibilité, permettant une personnalisation totale : création de races, technologies et univers uniques.

PHPSimul a laissé une empreinte avec sa version **1.3**, mais cette dernière est tombée en désuétude avec des failles de sécurité et de nombreuses imperfections. Aujourd'hui, ce projet renaît sous un nouveau jour grâce à l'intégration du **framework Laravel**, offrant ainsi une architecture moderne et robuste pour les futurs développements.

## À propos de PHPSimul 1.3

### Description

La version 1.3 de PHPSimul comprenait :

- Un **panneau d'administration** pour gérer l'ensemble du jeu.
- Un **forum**, un **chat**, et un **livre d'or**.
- Des **technologies** et des **races** entièrement personnalisables.
- Une grande flexibilité permettant de concevoir des jeux sur mesure, adaptés à des thématiques variées (aliens, schtroumpfs, etc.).

Malheureusement, PHPSimul 1.3 s'est arrêté après cette version, mais il reste disponible pour les curieux, avec des fichiers à télécharger sur le dépôt GitHub de PHPSimul. Soyez toutefois prudent en l'installant, car il contient des failles de sécurité et doit être exécuté localement via des outils comme Wampserver ou EasyPHP.

### Télécharger PHPSimul 1.3

Vous pouvez télécharger PHPSimul 1.3 à partir des liens suivants :
- **GitHub** : [GitHub](https://github.com/AlexisAmand/PHPSimul)
- **Version zippée** : [Télécharger PHPSimul 1.3](https://github.com/boitasite/phpsimul-1-3)
- **Version dézippée** : Accessible dans le dossier "phpsimul-1-3" du dépôt GitHub.

> **Avertissement** : Pour faire fonctionner PHPSimul 1.3, il est nécessaire de supprimer 3 fichiers : `backup_v1.3.sql`, `backup_v1.3.php` et `systeme/config.php`.

PHPSimul est **Open Source**, donc gratuit et modifiable. Vous êtes libre de l’adapter selon vos besoins.


---

## Refactorisation avec Laravel

Cette version refactorisée de PHPSimul utilise le **framework Laravel** pour moderniser l'architecture et offrir une meilleure évolutivité et sécurité. Laravel facilite la gestion des routes, des bases de données et des tâches récurrentes grâce à son ORM Eloquent et à ses outils intégrés.

### Fonctionnalités de la version Laravel :

- **Architecture MVC** : Utilisation du modèle **Modèle-Vue-Contrôleur** pour séparer clairement la logique de l'application.
- **Sécurité améliorée** : Avec la gestion des utilisateurs et des permissions via Laravel.
- **Gestion simplifiée de la base de données** : Grâce à Laravel Migrations et Eloquent ORM.
- **Interface moderne** : Intégration de technologies modernes comme Vue.js ou Tailwind CSS pour l'interface utilisateur (en fonction de l'implémentation).
- **API RESTful** : Exposition d'API pour interagir avec l'application à distance.

## Prérequis

Avant de commencer, vous devez avoir installé les outils suivants :

- **PHP** (version 8.x ou supérieure)
- **Composer** (gestionnaire de dépendances PHP)
- **MySQL** ou **MariaDB** (ou toute autre base de données compatible avec Laravel)
- **Node.js** et **NPM** pour la gestion des dépendances front-end (si applicable)

## Installation

### Cloner le dépôt

```bash
git clone https://github.com/boitasite/phpsimul-laravel.git
cd phpsimul-laravel
```

### Installer les dépendances

```bash
composer install
npm install
```

### Configuration de l'environnement

Copiez le fichier `.env.example` en `.env` et configurez-le selon votre environnement local :

```bash
cp .env.example .env
```

Ensuite, modifiez les paramètres de connexion à la base de données et autres configurations dans le fichier `.env`.

### Générer la clé d'application

```bash
php artisan key:generate
```

### Migration de la base de données

```bash
php artisan migrate
```

### Lancer l'application

Pour démarrer le serveur local :

```bash
php artisan serve
```

Vous pouvez maintenant accéder à l'application à l'adresse [http://127.0.0.1:8000](http://127.0.0.1:8000).

## Structure du projet

La structure des répertoires dans cette version Laravel :

```
/phpsimul-laravel
├── /app                # Logique de l'application (modèles, contrôleurs, etc.)
├── /config             # Configuration de l'application
├── /database           # Migrations et seeders
├── /resources          # Vues, fichiers front-end
├── /routes             # Définition des routes
├── /storage            # Stockage des fichiers, logs, etc.
└── /tests              # Tests unitaires et fonctionnels
```

## Contribuer

Ce projet est ouvert à la contribution ! Si vous souhaitez participer, suivez ces étapes :

1. Forkez le dépôt.
2. Créez une branche pour vos modifications : `git checkout -b ma-fonctionnalité`.
3. Committez vos modifications avec un message clair.
4. Pushez la branche et soumettez une pull request.

## Licence

Distribué sous la licence MIT. Voir `LICENSE` pour plus de détails.

---

Ainsi, ce `README.md` donne un aperçu complet de PHPSimul, tout en détaillant la refactorisation en Laravel. Cela permet aux utilisateurs de comprendre l’histoire du projet tout en ayant une vue d’ensemble de la version moderne.
