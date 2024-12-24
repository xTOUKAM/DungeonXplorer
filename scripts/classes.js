// classes.js

// Definition Classe Personnage
class Personnage {
    constructor(Nom, PV_MAX, PV_ACTU, Force, Initiative, Mana, MANA_ACTU, Bonus_Armure) {
        this.Nom = Nom;
        this.PV_MAX = PV_MAX;
        this.PV_ACTU = PV_ACTU;
        this.Force = Force;
        this.Initiative = Initiative;
        this.Initiative_Combat = this.Calcul_initiative();
        this.Mana = Mana;
        this.MANA_ACTU = MANA_ACTU;
        this.DEF = this.Calcul_DEF();
        this.Bonus_Armure = Bonus_Armure; 
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

    // Lance un D6 est renvoie la valeur
    Lancer_D6(){
        return Math.floor(Math.random() * 6) + 1;
    }

    // Calcul la Défense du personnage
    Calcul_DEF(){
        if(this.Nom.includes("Voleur")){
            return this.Lancer_D6()+Math.floor(this.Initiative/2) + this.Bonus_Armure;
        }
        else{
            return this.Lancer_D6()+Math.floor(this.Force/2) + this.Bonus_Armure;
        }
    }

    mettreAJourAffichage() {
        const element = document.getElementById(this.Nom.toLowerCase());
        if (element) {
            element.innerHTML = this.afficher(); // Réaffiche les données mises à jour
        }
    }
    
    // Calcul les dégats de l'attaque physique
    Attaque_physique(){
        return this.Lancer_D6()+this.Force+this.Bonus_Armure;
    }

    // Calcul les dégats magiques
    Attaque_Magique(){
        this.Mana -= 0; //Manque valeur de Mana du sort
        return this.Lancer_D6()+this.Lancer_D6(); //Manque valeur sort à voir au niveau BDD
    }

    // Calcul les degats pris par le personnage
    Degats(attaque){
        if(attaque - this.DEF > 0){
            this.PV_ACTU -= attaque - this.DEF;
        }
        this.mettreAJourAffichage();
    }

    // Calcul l'initiative du personnage
    Calcul_initiative(){
        return this.Lancer_D6()+this.Initiative; 
    }

    // Gagne des PV ou du Mana selon le type et la valeur de la Potion
    Boire_potion(Potion){
        if(Potion.type=="PV"){
            this.PV_ACTU += Potion.valeur;
            if(this.PV_ACTU>this.PV_MAX){
                this.PV_ACTU = this.PV_MAX;
            }
        }
        if(Potion.type=="MANA"){
            this.MANA_ACTU += Potion.valeur;
            if(this.MANA_ACTU>this.MANA){
                this.MANA_ACTU = this.MANA;
            }
        }
    }
}


// Definition Classe Monstre
class Monstre {
    constructor(Nom, PV_ACTU, Force, Initiative, Mana) {
        this.Nom = Nom;
        this.PV_ACTU = PV_ACTU;
        this.Force = Force;
        this.Initiative = Initiative;
        this.Initiative_Combat = this.Calcul_initiative();
        this.Mana = Mana;
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

    // Lance un D6 est renvoie la valeur
    Lancer_D6(){
        return Math.floor(Math.random() * 6) + 1;
    }

    // Calcul la Défense du monstre
    Calcul_DEF(){
        return this.Lancer_D6()+Math.floor(this.Force/2);
    }

    // Calcul les dégats de l'attaque physique
    Attaque_physique(){
        return this.Lancer_D6()+this.Force;
    }

    // Calcul les degats pris par le monstre
    Degats(attaque){
        if(attaque - this.DEF > 0){
            this.PV_ACTU -= attaque - this.DEF;
        }
        this.mettreAJourAffichage();
    }

    mettreAJourAffichage() {
        const element = document.getElementById(this.Nom.toLowerCase());
        if (element) {
            element.innerHTML = this.afficher(); // Réaffiche les données mises à jour
        }
    }

    // Calcul l'initiative du monstre
    Calcul_initiative(){
        return this.Lancer_D6()+this.Initiative; 
    }
}
