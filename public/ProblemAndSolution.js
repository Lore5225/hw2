const hamburgerIcon = document.getElementById("hamburger__icon");
const nav = document.querySelector("nav");

hamburgerIcon.addEventListener("click", () => {
  nav.classList.toggle("open");
});

const tendine = document.querySelectorAll("nav h1");

function menuTendina(event) {
  const container = event.currentTarget;
  const text = container.nextElementSibling;

  if (window.innerWidth <= 768) {
    text.classList.toggle("nav-text-open");
  } else {
    document.querySelectorAll(".nav-text").forEach((navText) => {
      if (navText !== text) {
        navText.classList.remove("nav-text-open");
      }
    });
    text.classList.add("nav-text-open");
  }
}

for (const tendina of tendine) {
  if (window.innerWidth > 768) {
    tendina.addEventListener("mouseover", menuTendina);
  } else {
    tendina.addEventListener("click", menuTendina);
  }
}

document.querySelector("nav").addEventListener("mouseleave", function () {
  document.querySelectorAll(".nav-text").forEach((navText) => {
    navText.classList.remove("nav-text-open");
  });
});

