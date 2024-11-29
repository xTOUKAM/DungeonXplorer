
//Recupere les données et vérifie qu'elles sont retenus
// Fonction pour récupérer les données JSON depuis une URL avec async/await
async function obtenirDonnees(url) {
    try {
        // Envoi de la requête HTTP
        const response = await fetch(url);
        
        // Vérification si la réponse est valide (code HTTP 200)
        if (!response.ok) {
            throw new Error('Erreur réseau');
        }
        
        // Attendre et récupérer la réponse au format JSON
        const data = await response.json();
        
        // Retourner les données récupérées
        return data;
    } catch (error) {
        // Gestion des erreurs
        console.error('Erreur lors de la récupération des données:', error);
        throw error;
    }
}

// Utilisation de la fonction obtenirDonnees pour récupérer les données
async function utiliserDonnees() {
    try {
        const data = await obtenirDonnees('https://dev-letelli236.users.info.unicaen.fr/models/JsonCombat.php');
        console.log(data); // Afficher les données dans la console

        // Création du personnage avec les données récupérées
        var perso = new Personnage(
            data.personnage.name, 
            data.personnage.base_pv, 
            data.personnage.pv, 
            data.personnage.strength, 
            data.personnage.initiative, 
            data.personnage.base_mana, 
            data.personnage.mana, 
            data.personnage.armor
        );

        // Affichage du personnage sur la page web
        const persoDiv = document.getElementById('perso');
        persoDiv.innerHTML = perso.afficher(); // Appel de la méthode afficher() de la classe Personnage

        // Création du personnage avec les données récupérées
        var monstre = new Monstre(
            data.monstre.name,  
            data.monstre.pv, 
            data.monstre.strength, 
            data.monstre.initiative,  
            data.monstre.mana, 
            data.monstre.armor
        );

        // Affichage du personnage sur la page web
        const monsterDiv = document.getElementById('monstre');
        monsterDiv.innerHTML = monstre.afficher();
    } catch (error) {
        console.error('Erreur lors de l\'utilisation des données:', error);
    }
}

// Appeler la fonction pour récupérer et utiliser les données
utiliserDonnees();



// Definition Classe personnage tous les paramètres du construteur doivent 
class Personnage {
    constructor(Classe, PV_MAX, PV_ACTU, Force, Initiative, Mana,MANA_ACTU, Bonus_Armure) {
        this.Classe = Classe;
        this.PV_MAX = PV_MAX;
        this.PV_ACTU = PV_ACTU;
        this.Force = Force;
        this.Initiative = Initiative;
        this.Initiative_Combat = this.Calcul_initiative;
        this.Mana = Mana;
        this.MANA_ACTU = MANA_ACTU;
        this.DEF = this.Calcul_DEF;
        this.Bonus_Armure = Bonus_Armure; 
    }

    afficher() {
        return `
            <h2>Nom : ${this.Classe}</h2>
            <p><strong>PV : </strong>${this.PV_ACTU} / ${this.PV_MAX}</p>
            <p><strong>Mana : </strong>${this.MANA_ACTU} / ${this.Mana}</p>
            <p><strong>Force : </strong>${this.Force}</p>
            <p><strong>Initiative : </strong>${this.Initiative}</p>
            <p><strong>Armure : </strong>${this.Bonus_Armure}</p>
        `;
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
}

class Monstre {
    constructor(Nom, PV_ACTU, Force, Initiative, Mana) {
        this.Nom = Nom;
        this.PV_ACTU = PV_ACTU;
        this.Force = Force;
        this.Initiative = Initiative;
        this.Initiative_Combat = this.Calcul_initiative;
        this.Mana = Mana;
        this.DEF = this.Calcul_DEF;
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
        return Math.random() * (6-1+1) + 1;
    }

    // Calcul la Défense du personnage
    Calcul_DEF(){
        return this.Lancer_D6+Math.floor(this.Force/2);
    }

    // Calcul les dégats de l'attaque physique
    Attaque_physique(){
        return this.Lancer_D6+this.Force;
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

}



