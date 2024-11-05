# DungeonXplorer

**DungeonXplorer** est un jeu de combat au tour par tour en PHP où les joueurs affrontent des monstres dans des donjons sombres. Choisissez votre classe, utilisez vos compétences, et survivez aux attaques des créatures qui vous attendent !

## Table des matières

- [Fonctionnalités](#fonctionnalités)
- [Classes et Attributs des Personnages](#classes-et-attributs-des-personnages)
- [Règles de Combat](#règles-de-combat)
- [Contribuer](#contribuer)
- [Licence](#licence)

## Fonctionnalités

- **Classes Jouables** : Choisissez entre Guerrier, Voleur ou Magicien, chacun ayant des attributs et capacités uniques.
- **Système de Combat au Tour par Tour** : Attaque physique, magique (pour les Magiciens) ou utilisation de potions.
- **Gestion de l'Initiative** : Les personnages et monstres tirent au sort pour déterminer l'ordre d'attaque, avec des règles de priorité spécifiques.

## Classes et Attributs des Personnages

### Personnages Jouables
Chaque personnage a les attributs suivants :
- **PV** : Points de vie.
- **Initiative** : Utilisée pour déterminer qui attaque en premier.
- **Force** : Utilisée pour les attaques physiques.
- **Mana** : Utilisé pour les attaques magiques (0 pour les Guerriers, maximum de 10 pour les Voleurs).

### Monstres
Les monstres ont également des **PV**, de la **force**, de l'**initiative** et, s'ils sont magiques, un **pool de mana** pour lancer des sorts.

## Règles de Combat

### 1. Initiative
Chaque combattant lance un dé à 6 faces (1D6) auquel s'ajoute son score d'initiative. Celui avec le score le plus élevé attaque en premier. En cas d’égalité :
- **Le monstre prend la priorité**, sauf si le joueur est un Voleur (le Voleur prend alors la priorité).

### 2. Actions Possibles par Tour
- **Attaque Physique** : Basée sur la force du personnage et les bonus de son arme.
- **Attaque Magique** : Réservée aux Magiciens et aux monstres magiques ; dépend de leur mana et du coût des sorts.
- **Utilisation d’une Potion** : Restaure des PV ou du mana, selon la potion utilisée.

### 3. Formule d'Attaque
- **Attaque Physique** : `1D6 + force + bonus_arme`
- **Défense** : 
  - Guerrier/Magicien : `1D6 + force/2 + bonus_armure`
  - Voleur : `1D6 + initiative/2 + bonus_armure`
- **Dégâts** : Si l'attaque dépasse la défense, le défenseur subit la différence en dégâts (`PV -= dégâts`).

### 4. Attaque Magique
Réservée aux Magiciens et aux monstres magiques, et dépend de leur réserve de mana :
- **Formule d'Attaque Magique** : `(1D6 + 1D6) + coût du sort`
- La défense se calcule comme pour une attaque physique.

### 5. Utilisation de Potions
- Le joueur peut restaurer des **PV** ou du **mana** en utilisant des potions spécifiques.
  
## Contribuer

* [Tom Houllegatte](https://github.com/xTOUKAM)
* [Nassim Ramdane](https://github.com/NassimSkoto)
* [Tom Cholot](https://github.com/15cf0408)
* [Elsa Hamon](https://github.com/AstatePNG)
* [Paul Letellier](https://github.com/Paul8710)

## License

DungeonXplorer est protégé par la licence [MIT Licence](./LICENCE).