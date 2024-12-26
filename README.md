# DungeonXplorer

Bienvenue dans **DungeonXplorer**, une application web immersive inspirée des classiques "livres dont vous êtes le héros". Ce projet est réalisé pour l'association "Les Aventuriers du Val Perdu" afin de raviver l'expérience unique des récits interactifs en ligne.

## Description

**DungeonXplorer** est un jeu de dark fantasy dans lequel chaque joueur peut :
- Créer un personnage parmi trois classes : Guerrier, Voleur, ou Magicien.
- S'engager dans une aventure captivante où chaque choix influence l'histoire.
- Sauvegarder sa progression et consulter son profil joueur.

Le site est conçu pour être accessible, responsive, et conforme aux standards du W3C et aux exigences de la norme WCAG AA 2.0.

## Fonctionnalités principales

### Joueurs
- Création de compte et gestion de profil.
- Création de personnage.
- Démarrage ou reprise de l'aventure.
- Suppression de compte.

### Administrateurs
- Gestion complète des fonctionnalités des joueurs.
- Ajout, suppression ou modification des contenus (chapitres, monstres, trésors, images).

## Stack technique
- **Langages :** PHP, MySQL, JavaScript, HTML, CSS.
- **Pattern :** MVC.
- **Framework :** Mini framework PHP.
- **Éditeur :** Visual Studio Code.
- **Versionnage :** Git et GitHub.

## Installation

1. Clonez ce repository :
   ```bash
   git clone https://github.com/votre-compte/dungeonxplorer.git
   ```
2. Sortez le dossier `project` du dossier de base pour éviter les problèmes liés à l'architecture MVC :
   ```bash
   mv dungeonxplorer/project .
   ```
3. Configurez la base de données :
   - Importez le script SQL fourni dans le dossier `project/config`.
   - Configurez les identifiants de votre base de données dans le fichier `config/database.php`.
4. Assurez-vous que votre serveur dispose des extensions PHP nécessaires, notamment `PDO`.
5. Lancez un serveur local pour tester l'application :
   ```bash
   php -S localhost:8000 -t project/
   ```

## Charte graphique
- **Couleurs principales :**
  - Fond principal : `#1A1A1A` (noir doux).
  - Secondaire : `#2E2E2E` (gris anthracite).
  - Texte principal : `#E5E5E5` (gris très clair).
  - Accents : `#C4975E` (or), `#8B1E1E` (rouge sombre), `#4A7A66` (vert jade).
- **Polices :**
  - Titres : Pirata One.
  - Contenu : Roboto (Regular et Bold).
- **Icônes :** Font Awesome.

## Contributions
Les contributions sont les bienvenues ! Merci de suivre les étapes suivantes :
1. Forkez le repository.
2. Créez une branche pour votre fonctionnalité :
   ```bash
   git checkout -b nouvelle-fonctionnalite
   ```
3. Faites vos modifications et soumettez une Pull Request.

## Licence
Ce projet est sous licence MIT. Consultez le fichier `LICENSE` pour plus de détails.

---

**Merci d'avoir choisi DungeonXplorer. Que l'aventure commence !**