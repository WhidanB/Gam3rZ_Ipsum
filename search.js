const searchInput = document.querySelector(".search");
const searchBar = document.querySelector(".search_bar");

// Ajouter un gestionnaire d'événement sur le clic dans l'input
searchInput.addEventListener("click", function () {
  searchBar.style.backgroundColor = "#a4090d";
});

// Ajouter un gestionnaire d'événement sur le clic en dehors de l'input
document.addEventListener("click", function (event) {
  // Vérifier si le clic est en dehors de la search_bar
  if (!searchBar.contains(event.target)) {
    searchBar.style.backgroundColor = "red";
  }
});
