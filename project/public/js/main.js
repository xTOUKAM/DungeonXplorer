// main.js
import Combat from './battle.js';

// Fonction pour afficher les alertes de succès ou d'erreur
function showAlert(message, type) {
    const alertPlaceholder = document.createElement('div');
    alertPlaceholder.className = `alert alert-${type}`;
    alertPlaceholder.textContent = message;
    document.body.prepend(alertPlaceholder);
    setTimeout(() => {
        alertPlaceholder.remove();
    }, 3000);
}

// Exemple d'utilisation de la fonction d'alerte
document.addEventListener('DOMContentLoaded', () => {
    const successMessage = document.querySelector('#success-message');
    if (successMessage) {
        showAlert(successMessage.textContent, 'success');
    }

    const errorMessage = document.querySelector('#error-message');
    if (errorMessage) {
        showAlert(errorMessage.textContent, 'danger');
    }
});

// Exemple d'initialisation
const hero = { name: 'Héros', strength: 20, pv: 100, armor: 5 };
const monster = { name: 'Gobelin', strength: 15, pv: 50, armor: 3 };

const combat = new Combat(hero, monster);
combat.start();
console.log(combat.log);

