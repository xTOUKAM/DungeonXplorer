// main.js

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
