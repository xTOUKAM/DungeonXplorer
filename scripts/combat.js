// combat.js

// Variables globales
var spells = []; // Variable globale pour stocker les sorts du personnage
var monstre;
var perso;

// Variable globale pour stocker la fonction resolve de la promesse
let resolveActionJoueur = null;

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
        console.log('Données récupérées:', data); // Afficher les données dans la console

        // Vérifier si les sorts existent dans les données
        if (!data.spells || !Array.isArray(data.spells)) {
            console.error("Les sorts ne sont pas présents ou ne sont pas un tableau dans les données JSON.");
            return;
        }

        // Création du personnage
        perso = new Personnage(
            data.personnage.id, // Utiliser l'ID depuis les données JSON
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
        if (persoDiv) {
            persoDiv.innerHTML = perso.afficher();
        } else {
            console.error("Élément avec l'ID 'perso' non trouvé dans le HTML.");
        }

        // Création du monstre
        monstre = new Monstre(
            data.monstre.name,
            data.monstre.pv,
            data.monstre.strength,
            data.monstre.initiative,
            data.monstre.mana
        );

        // Stocker les sorts dans la variable globale
        spells = data.spells;
        console.log("Sorts récupérés :", spells);

        // Affichage du monstre
        const monsterDiv = document.getElementById('monstre');
        if (monsterDiv) {
            monsterDiv.innerHTML = monstre.afficher();
        } else {
            console.error("Élément avec l'ID 'monstre' non trouvé dans le HTML.");
        }

        // Lance le combat
        Combat();
    } catch (error) {
        console.error('Erreur lors de l\'utilisation des données:', error);
    }
}

// Appel de la fonction pour récupérer et utiliser les données
utiliserDonnees();

// Fonction pour mettre à jour le personnage dans la base de données à la fin du combat
function envoyerMajPerso(id, pv, mana) {
    fetch('../models/updatePersonnage.php', {
        method: 'POST',
        headers: { 
            'Content-Type': 'application/x-www-form-urlencoded' 
        },
        body: new URLSearchParams({
            id: id,
            pv: pv,
            mana: mana
        })
    })
    .then(response => response.json()) // Récupère la réponse en JSON
    .then(data => {
        if(data.status === 'success') {
            console.log("Mise à jour réussie !", data.message);
        } else {
            console.error("Erreur de mise à jour :", data.message);
        }
    })
    .catch(error => {
        console.error("Erreur réseau/fetch :", error);
    });
}

// Afficher ou masquer la barre d'actions (boutons)
function afficherBarreActions(visible) {
    const barreActions = document.querySelector('.actions-bar');
    if (!perso.Nom.includes("Magicien")) {
        const boutonMag = document.getElementById('bouton-mag');
        if (boutonMag) {
            boutonMag.style.display = 'none';
        }
    }
    if (barreActions) {
        barreActions.style.display = visible ? 'flex' : 'none'; // Affiche ou cache la barre
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
                // Envoyer les mises à jour au backend à la fin du combat
                envoyerMajPerso(perso.id, perso.PV_ACTU, perso.MANA_ACTU);
                // Rediriger vers victoire.html
                document.location.href = "victoire.html";
                combatTermine = true;
                break;
            }

            // Passe la main au monstre
            current = monstre;
        } else {
            // Tour du monstre
            afficherBarreActions(false);
            const attaque = monstre.Attaque_physique();
            const degatsAppliques = perso.Degats(attaque);
            console.log(`Le monstre attaque le personnage et lui inflige ${degatsAppliques} dégâts après défense.`);

            if (perso.PV_ACTU <= 0) {
                console.log("Le personnage est mort...");
                // Envoyer les mises à jour au backend à la fin du combat
                envoyerMajPerso(perso.id, perso.PV_ACTU, perso.MANA_ACTU);
                // Rediriger vers defaite.html
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
        resolveActionJoueur = resolve; // Stocker la fonction resolve

        const boutonPhy = document.getElementById('bouton-phy');
        const boutonMag = document.getElementById('bouton-mag');
        const boutonPopo = document.getElementById('bouton-popo');

        // Vérifier que les boutons existent
        if (!boutonPhy || !boutonMag || !boutonPopo) {
            console.error("Un ou plusieurs boutons d'action n'ont pas été trouvés dans le HTML.");
            resolve(); // Résoudre la promesse pour éviter de bloquer le combat
            return;
        }

        // Définir les gestionnaires d'événements séparés
        const onPhy = () => {
            const attaque = perso.Attaque_physique();
            const degatsAppliques = monstre.Degats(attaque);
            console.log(`Attaque Physique: ${attaque} - Défense Monstre: ${monstre.DEF} = Dégâts Réels: ${degatsAppliques}`);
            perso.mettreAJourAffichage();
            monstre.mettreAJourAffichage();
            actions();
            resolve();
        };

        const onMag = () => {
            ouvrirmenuSorts();
            // La résolution de la promesse se fera dans utiliserSort()
        };

        const onPopo = () => {
            // Implémenter la logique pour boire une potion
            const potion = { type: "PV", valeur: 20 }; // Exemple de potion qui restaure 20 PV
            perso.Boire_potion(potion);
            console.log(`Potion utilisée: +${potion.valeur} PV`);
            perso.mettreAJourAffichage();
            actions();
            resolve();
        };

        // Ajouter les écouteurs d'événements
        boutonPhy.addEventListener('click', onPhy);
        boutonMag.addEventListener('click', onMag);
        boutonPopo.addEventListener('click', onPopo);

        // Fonction pour retirer les écouteurs d'événements
        const actions = () => {
            boutonPhy.removeEventListener('click', onPhy);
            boutonMag.removeEventListener('click', onMag);
            boutonPopo.removeEventListener('click', onPopo);
        };

        // Gestionnaire pour fermer le menu sans résoudre la promesse
        const closeModal = () => {
            fermermenuSorts();
            // Ne pas appeler resolve() ici
            // Permet au joueur de choisir une autre action
        };

        // Ajouter un écouteur pour fermer le menu
        const closeButton = document.querySelector('.close-button');
        if (closeButton) {
            closeButton.addEventListener('click', closeModal);
        }

        // Fermer le menu si l'utilisateur clique en dehors du contenu du menu
        window.addEventListener('click', (event) => {
            const menu = document.getElementById('spell-menu');
            if (event.target === menu) {
                closeModal();
            }
        });
    });
}

// Fonction pour ouvrir le menu des sorts
function ouvrirmenuSorts() {
    const menu = document.getElementById('spell-menu');
    if (!menu) {
        console.error("Élément avec l'ID 'spell-menu' non trouvé dans le HTML.");
        return;
    }
    menu.style.display = 'block';
    afficherSorts(); // Affiche les sorts dans le menu
}

// Fonction pour fermer le menu des sorts
function fermermenuSorts() {
    const menu = document.getElementById('spell-menu');
    if (menu) {
        menu.style.display = 'none';
    }
}

// Fonction pour afficher les sorts dans la liste du menu
function afficherSorts() {
    const spellList = document.getElementById('spell-list');
    if (!spellList) {
        console.error("Élément avec l'ID 'spell-list' non trouvé dans le HTML.");
        return;
    }
    spellList.innerHTML = ''; // Réinitialise la liste

    if (spells.length === 0) {
        spellList.innerHTML = '<li>Aucun sort disponible.</li>';
        return;
    }

    console.log(`Affichage des sorts: ${spells.length} sorts disponibles.`);
    spells.forEach((spell, index) => {
        console.log(`Sort ${index}:`, spell);
        const li = document.createElement('li');
        li.innerHTML = `
            <button class="spell-button" data-index="${index}">
                ${spell.spell_name} - Dégâts: ${spell.damage}, Coût Mana: ${spell.mana_cost}
            </button>
        `;
        spellList.appendChild(li);
    });

    // Ajouter des écouteurs d'événements aux boutons des sorts
    const spellButtons = document.querySelectorAll('.spell-button');
    spellButtons.forEach(button => {
        button.addEventListener('click', () => {
            const spellIndex = button.getAttribute('data-index');
            utiliserSort(spellIndex);
            fermermenuSorts(); // Ferme le menu après la sélection
        });
    });
}

// Gestionnaire de fermeture du menu
const closeButton = document.querySelector('.close-button');
if (closeButton) {
    closeButton.addEventListener('click', fermermenuSorts);
}

// Fermer le menu si l'utilisateur clique en dehors du contenu du menu
window.addEventListener('click', (event) => {
    const menu = document.getElementById('spell-menu');
    if (event.target === menu) {
        fermermenuSorts();
    }
});

// Fonction pour utiliser un sort sélectionné
function utiliserSort(index) {
    const spell = spells[index];
    if (!spell) {
        console.error("Sort invalide sélectionné.");
        if (resolveActionJoueur) resolveActionJoueur();
        return;
    }

    // Vérifier si le personnage a assez de mana
    if (perso.MANA_ACTU < spell.mana_cost) {
        alert("Mana insuffisant pour lancer ce sort !");
        if (resolveActionJoueur) resolveActionJoueur();
        return;
    }

    // Calcul des dégâts : 2d6 + dégâts du sort
    const degatsAttaqueMagique = perso.Attaque_Magique(); // 2d6
    const degatsTotal = degatsAttaqueMagique + spell.damage; // 2d6 + dégâts du sort
    console.log(`Dégâts magiques: 2d6 (${degatsAttaqueMagique}) + ${spell.damage} = ${degatsTotal}`);

    // Appliquer les dégâts au monstre et obtenir les dégâts réels
    const degatsAppliques = monstre.Degats(degatsTotal);
    console.log(`Le sort ${spell.spell_name} inflige ${degatsAppliques} dégâts après défense.`);

    // Réduire le mana du personnage
    perso.MANA_ACTU -= spell.mana_cost;
    perso.mettreAJourAffichage();

        // Résoudre la promesse pour permettre au monstre de prendre son tour
        if (resolveActionJoueur) {
            resolveActionJoueur();
        }
}
