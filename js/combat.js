// Definition Classe personnage tous les paramètres du construteur doivent 
class Personnage {
    Personnage(Classe, PV_MAX, PV_ACTU, ATT_PHY, ATT_MAG, Force, Initiative, Mana,MANA_ACTU, Bonus_Armure) {
        this.Classe = Classe;
        this.PV_MAX = PV_MAX;
        this.PV_ACTU = PV_ACTU;
        this.ATT_PHY = ATT_PHY;
        this.ATT_MAG = ATT_MAG;
        this.Force = Force;
        this.Initiative = Initiative;
        this.Initiative_Combat = this.Calcul_initiative;
        this.Mana = Mana;
        this.MANA_ACTU = MANA_ACTU;
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
            this.PV_MAX -= attaque - this.DEF;
        }
       
    }

    // Calcul l'initiative du personnage
    Calcul_initiative(){
        return this.Lancer_D6+this.Initiative; 
    }

    // Gagne des PV ou du Mana selon le type et la valeur de la Potion
    Boire_potion(Potion){
        if(Potion.type=="PV"){
            this.PV_ACTU += Potion.valeur;
            if(this.PV_ACTU>this.PV_MAX){
                this.PV_ACTU = this.PV_MAX
            }
        }
        if(Potion.type=="MANA"){
            this.MANA_ACTU += Potion.valeur;
            if(this.MANA_ACTU>this.MANA){
                this.MANA_ACTU = this.MANA;
            }
        }
    }

    // Choisir une action
    Choisir_action(action){
        if(action == "Boire_Potion"){
            //recuperer la potion avec requete SQl
            // Potion = Potion(type,valeur);
            this.Boire_potion(Potion);
        }
        if(action == "Attaque_MAG"){
            // recuperer la valeur et le cout du sort
            this.Attaque_Magique;
        }
        else{
            this.Attaque_physique;
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


