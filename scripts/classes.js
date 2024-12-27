// classes.js

// ---------------------
// Classe Personnage
// ---------------------
class Personnage {
    constructor(id, Nom, PV_MAX, PV_ACTU, Force, Initiative, Mana, MANA_ACTU, Bonus_Armure) {
        // Conversion en nombre pour éviter qu'une chaîne s'insère
        this.id = id; // Ajout de l'ID
        this.Nom = Nom;
        this.PV_MAX = parseInt(PV_MAX, 10);
        this.PV_ACTU = parseInt(PV_ACTU, 10);
        this.Force = parseInt(Force, 10);
        this.Initiative = parseInt(Initiative, 10);
        this.Mana = parseInt(Mana, 10);
        this.MANA_ACTU = parseInt(MANA_ACTU, 10);
        this.Bonus_Armure = parseInt(Bonus_Armure, 10);

        // Calcul initial
        this.Initiative_Combat = this.Calcul_initiative();
        this.DEF = this.Calcul_DEF();
    }

    afficher() {
        return `
            <h2>Nom : ${this.Nom}</h2>
            <p><strong>PV : </strong>${this.PV_ACTU} / ${this.PV_MAX}</p>
            <p><strong>Mana : </strong>${this.MANA_ACTU} / ${this.Mana}</p>
            <p><strong>Force : </strong>${this.Force}</p>
            <p><strong>Initiative : </strong>${this.Initiative}</p>
            <p><strong>Armure : </strong>${this.Bonus_Armure}</p>
        `;
    }

    // Lance un D6 et renvoie la valeur [1..6]
    Lancer_D6() {
        return Math.floor(Math.random() * 6) + 1;
    }

    // Calcul la Défense du personnage
    Calcul_DEF() {
        const d6 = this.Lancer_D6();
        let def = 0;
        if (this.Nom.includes("Voleur")) {
            def = d6 + Math.floor(this.Initiative / 2) + this.Bonus_Armure;
        } else {
            def = d6 + Math.floor(this.Force / 2) + this.Bonus_Armure;
        }
        return def;
    }

    // Met à jour l'affichage du personnage dans la div #perso
    mettreAJourAffichage() {
        const element = document.getElementById('perso');
        if (element) {
            element.innerHTML = this.afficher();
        }
    }

    // Calcul des dégâts de l'attaque physique
    Attaque_physique() {
        const d6 = this.Lancer_D6();
        return d6 + this.Force + this.Bonus_Armure;
    }

    // Calcul des dégâts magiques 2d6
    Attaque_Magique() {
        const d6a = this.Lancer_D6();
        const d6b = this.Lancer_D6();
        return d6a + d6b;
    }

    // Calcul des dégâts subis
    Degats(attaque) {
        const degatsReels = attaque - this.DEF;
        let damageApplied = 0;
        if (degatsReels > 0) {
            this.PV_ACTU -= degatsReels;
            if (this.PV_ACTU < 0) this.PV_ACTU = 0; // Empêcher les PV négatifs
            damageApplied = degatsReels;
        }
        this.mettreAJourAffichage();
        return damageApplied; // Retourne les dégâts réellement appliqués
    }

    // Calcul l'initiative du personnage
    Calcul_initiative() {
        const d6 = this.Lancer_D6();
        return d6 + this.Initiative;
    }

    // Gagner des PV ou du Mana (via potion)
    Boire_potion(Potion) {
        const valeur = parseInt(Potion.valeur, 10);
        if (Potion.type === "PV") {
            this.PV_ACTU += valeur;
            if (this.PV_ACTU > this.PV_MAX) {
                this.PV_ACTU = this.PV_MAX;
            }
        }
        if (Potion.type === "MANA") {
            this.MANA_ACTU += valeur;
            if (this.MANA_ACTU > this.Mana) {
                this.MANA_ACTU = this.Mana;
            }
        }
        this.mettreAJourAffichage();
    }
}


// ---------------------
// Classe Monstre
// ---------------------
class Monstre {
    constructor(Nom, PV_ACTU, Force, Initiative, Mana) {
        this.Nom = Nom;
        this.PV_ACTU = parseInt(PV_ACTU, 10);
        this.Force = parseInt(Force, 10);
        this.Initiative = parseInt(Initiative, 10);
        this.Mana = parseInt(Mana, 10);

        // Calcul initial
        this.Initiative_Combat = this.Calcul_initiative();
        this.DEF = this.Calcul_DEF();
    }

    afficher() {
        return `
            <h2>Nom : ${this.Nom}</h2>
            <p><strong>PV : </strong>${this.PV_ACTU}</p>
            <p><strong>Mana : </strong>${this.Mana}</p>
            <p><strong>Force : </strong>${this.Force}</p>
            <p><strong>Initiative : </strong>${this.Initiative}</p>
        `;
    }

    // Lance un D6 et renvoie la valeur [1..6]
    Lancer_D6() {
        return Math.floor(Math.random() * 6) + 1;
    }

    // Calcul la Défense du monstre
    Calcul_DEF() {
        const d6 = this.Lancer_D6();
        return d6 + Math.floor(this.Force / 2);
    }

    // Calcul l'initiative du monstre
    Calcul_initiative() {
        const d6 = this.Lancer_D6();
        return d6 + this.Initiative;
    }

    // Attaque physique
    Attaque_physique() {
        const d6 = this.Lancer_D6();
        return d6 + this.Force;
    }

    // Dégâts subis
    Degats(attaque) {
        const degatsReels = attaque - this.DEF;
        let damageApplied = 0;
        if (degatsReels > 0) {
            this.PV_ACTU -= degatsReels;
            if (this.PV_ACTU < 0) this.PV_ACTU = 0; // Empêcher les PV négatifs
            damageApplied = degatsReels;
        }
        this.mettreAJourAffichage();
        return damageApplied; // Retourne les dégâts réellement appliqués
    }

    // Met à jour l'affichage du monstre dans la div #monstre
    mettreAJourAffichage() {
        const element = document.getElementById('monstre');
        if (element) {
            element.innerHTML = this.afficher();
        }
    }
}
