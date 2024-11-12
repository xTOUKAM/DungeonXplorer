document.addEventListener("DOMContentLoaded", () => {
    const buttons = document.querySelectorAll(".button");
    
    buttons.forEach(button => {
        button.addEventListener("click", () => {
            alert("Bienvenue dans l'aventure Dark Fantasy!");
        });
    });
});
