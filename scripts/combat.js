// combat.js

// Variables globales
var monstre;
var perso;

// Fonction pour récupérer les données JSON
async function obtenirDonnees(url) {
    try {
        const response = await fetch(url);
        if (!response.ok) {
            throw new Error('Erreur réseau');
        }
        
        const data = await response.json();
        return data;
    } catch (error) {
        console.error('Erreur lors de la récupération des données:', error);
        throw error;
    }
}

// Fonction pour utiliser les données
async function utiliserDonnees() {
    try {
        const data = await obtenirDonnees('https://dev-letelli236.users.info.unicaen.fr/models/JsonCombat.php');
        console.log(data); // Afficher les données dans la console

        // Création du personnage
        perso = new Personnage(
            data.personnage.name, 
            data.personnage.base_pv, 
            data.personnage.pv, 
            data.personnage.strength, 
            data.personnage.initiative, 
            data.personnage.base_mana, 
            data.personnage.mana, 
            data.personnage.armor
        );

        // Affichage du personnage
        const persoDiv = document.getElementById('perso');
        persoDiv.innerHTML = perso.afficher();

        // Création du monstre
        monstre = new Monstre(
            data.monstre.name,
            data.monstre.pv,
            data.monstre.strength,
            data.monstre.initiative,
            data.monstre.mana
        );

        // Affichage du monstre
        const monsterDiv = document.getElementById('monstre');
        monsterDiv.innerHTML = monstre.afficher();

        // Lance le combat
        Combat();
    } catch (error) {
        console.error('Erreur lors de l\'utilisation des données:', error);
    }
}

// Appel de la fonction pour récupérer et utiliser les données
utiliserDonnees();

// Afficher ou masquer la barre d'actions (boutons)
function afficherBarreActions(visible) {
    const barreActions = document.querySelector('.actions-bar');
    if(!perso.Nom.includes("Magicien")){
        document.getElementById('bouton-mag').style.display = 'none';
    }
    if (visible) {
        barreActions.style.display = 'flex'; // Affiche la barre
    } else {
        barreActions.style.display = 'none'; // Cache la barre
    }
}

// Fonction principale de combat
async function Combat() {
    // Calcul de l'initiative pour déterminer qui commence
    monstre.Initiative_Combat = monstre.Calcul_initiative();
    perso.Initiative_Combat = perso.Calcul_initiative();

    let current; // Celui qui joue le tour actuel
    if (monstre.Initiative_Combat > perso.Initiative_Combat) {
        current = monstre;
    } else {
        current = perso;
    }

    let combatTermine = false;
    while (!combatTermine) {
        if (current === perso) {
            // Tour du personnage
            afficherBarreActions(true);
            await attendreActionJoueur();

            if (monstre.PV_ACTU <= 0) {
                console.log("Le monstre est vaincu !");
                // document.location.href = "victoire.html";
                combatTermine = true;
                break;
            }

            // Passe la main au monstre
            current = monstre;
        } else {
            // Tour du monstre
            afficherBarreActions(false);
            const degats = monstre.Attaque_physique();
            perso.Degats(degats);
            console.log(`Le monstre attaque le personnage et lui inflige ${degats} dégâts.`);

            if (perso.PV_ACTU <= 0) {
                console.log("Le personnage est mort...");
                document.location.href = "defaite.html";
                combatTermine = true;
                break;
            }

            // Passe la main au personnage
            current = perso;
        }
    }
}

// Fonction d'attente de l'action du joueur
function attendreActionJoueur() {
    return new Promise((resolve) => {
        const boutonPhy = document.getElementById('bouton-phy');
        const boutonMag = document.getElementById('bouton-mag');
        const boutonPopo = document.getElementById('bouton-popo');

        const actions = () => {
            boutonPhy.removeEventListener('click', actions);
            boutonMag.removeEventListener('click', actions);
            boutonPopo.removeEventListener('click', actions);
            resolve();
        };

        boutonPhy.addEventListener('click', () => {
            monstre.Degats(perso.Attaque_physique());
            actions();
        });

        boutonMag.addEventListener('click', () => {
            monstre.Degats(perso.Attaque_Magique());
            actions();
        });

        boutonPopo.addEventListener('click', () => {
            //boire une potion
            actions();
        });
    });
}
