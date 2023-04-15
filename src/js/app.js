document.addEventListener("DOMContentLoaded", function () {
  eventListeners();
  
  //darkMode();
  
  modoSeleccionado();
});

let darkModeActive

function modoSeleccionado () {

  opcionUsuario = localStorage.getItem('darkModeActive');
  //console.log(opcionUsuario);

  switch (opcionUsuario) {
   
    case 'true':
      document.body.classList.remove("dark-mode");
      userDarkMode();
      break;

    case 'false':
      document.body.classList.add("dark-mode");
      userDarkMode();
      break;

    default:
      systemDarkMode();
      userDarkMode();
      break;

  }
}

function systemDarkMode() {
  const prefiereDarkMode = window.matchMedia("(prefers-color-scheme: dark)");

    if (prefiereDarkMode.matches) {
      document.body.classList.add("dark-mode");
    } else {
      document.body.classList.remove("dark-mode");
    }
    // Si el sistema operativo cambia el modo
    prefiereDarkMode.addEventListener("change", function () {
      if (prefiereDarkMode.matches) {
        document.body.classList.add("dark-mode");
      } else {
        document.body.classList.remove("dark-mode");
      }
    });
    
} 

function userDarkMode () {
  
    // Si el usuario ha elegido un modo
    const botonDarkMode = document.querySelector(".dark-mode-boton");
    
    botonDarkMode.addEventListener("click", function () {
      
      document.body.classList.toggle("dark-mode");
      darkModeActive = document.body.classList.contains('dark-mode');

      if (darkModeActive) {
        localStorage.setItem('darkModeActive', false);
      } else {
        localStorage.setItem('darkModeActive', true);
      }
    });
}

// BURGER MENU

function eventListeners() {
  const mobileMenu = document.querySelector(".mobile-menu");

  mobileMenu.addEventListener("click", navegacionResponsive);
}

function navegacionResponsive() {
  const navegacion = document.querySelector(".navegacion");

  if (navegacion.classList.contains("mostrar")) {
    navegacion.classList.remove("mostrar");
  } else {
    navegacion.classList.add("mostrar");
  }
}



