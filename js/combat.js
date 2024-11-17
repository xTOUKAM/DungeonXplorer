// Definition Classe personnage tous les paramètres du construteur doivent 
class Personnage {
    Personnage(Classe, PV, PV_ACTU, ATT_PHY, ATT_MAG, Force, Initiative, Mana, Bonus_Armure) {
        this.Classe = Classe;
        this.PV = PV;
        this.PV_ACTU = PV_ACTU;
        this.ATT_PHY = ATT_PHY;
        this.ATT_MAG = ATT_MAG;
        this.Force = Force;
        this.Initiative = Initiative;
        this.Initiative_Combat = this.Calcul_initiative;
        this.Mana = Mana;
        this.DEF = this.Calcul_DEF;
        this.Bonus_Armure = Bonus_Armure; 
    }

    // Lance un D6 est renvoie la valeur
    Lancer_D6(){
        return Math.random() * (6-1+1) + 1;
    }

    // Calcul la Défense du personnage
    Calcul_DEF(){
        if(this.Classe = "Voleur"){
            return this.Lancer_D6+Math.floor(this.Initiative/2) + this.Bonus_Armure;
        }
        else{
            return this.Lancer_D6+Math.floor(this.Force/2) + this.Bonus_Armure;
        }
    }

    // Calcul les dégats de l'attaque physique
    Attaque_physique(){
        return this.Lancer_D6+this.Force+this.Bonus_Armure;
    }

    // Calcul les dégats magiques
    Attaque_Magique(){
        this.Mana -= 0;//Manque valeur de Mana du sort
        return this.Lancer_D6+this.Lancer_D6; //Manque valeur sort à voir au niveau BDD
    }

    // Calcul les degats pris par le personnage
    Degats(attaque){
        if(attaque-this.def>0){
            this.PV -= attaque - this.DEF;
        }
       
    }

    // Calcul l'initiative du personnage
    Calcul_initiative(){
        return this.Lancer_D6+this.Initiative; 
    }

    // 
    Boire_potion(Potion){
        if(Potion.type=="PV"){
            this.PV_ACTU += Potion.valeur;
            if(this.PV_ACTU>this.PV){
                this.PV_ACTU = this.PV
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

// Définit la classe Potion
class Potion{
    Potion(type,valeur){
        this.type = type;
        this.valeur = valeur;
    }
}


