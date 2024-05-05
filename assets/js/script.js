const navbar_hamburguer = document.getElementById("navbar-hamburguer");
const aside = document.getElementById("aside");

navbar_hamburguer.addEventListener("click", () => {
  navbar_hamburguer.classList.toggle('open')
  aside.classList.toggle('open')
})