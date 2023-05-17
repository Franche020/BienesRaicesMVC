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

  // Mostrar campos condicionales formulario contacto
  const metodoContacto = document.querySelectorAll('input[name="contacto[contacto]"]');
  metodoContacto.forEach(input=>input.addEventListener("click", mostrarMetodosContacto));

} 

function navegacionResponsive() {
  const navegacion = document.querySelector(".navegacion");

  if (navegacion.classList.contains("mostrar")) {
    navegacion.classList.remove("mostrar");
  } else {
    navegacion.classList.add("mostrar");
  }
}

function mostrarMetodosContacto(e){
  contactoDiv = document.querySelector('#contacto');  
  console.log(e.target.value);
  if (e.target.value === 'telefono') {
    contactoDiv.innerHTML = `
    <label for="telefono">Número Teléfono</label>
    <input id="telefono" type="tel" placeholder="Tu Teléfono" name="contacto[telefono]" />
    <p>Elija la fecha y la hora para la llamada</p>
    <label for="fecha">Fecha</label>
    <input type="date" id="fecha" name="contacto[fecha]"/>
    <label for="hora">Hora</label>
    <input type="time" id="hora" min="09:00" max="18:00" name="contacto[hora]"/>
    `;
  } else if(e.target.value ==='email') {
    contactoDiv.innerHTML = `
    <label for="email">Email</label>
    <input id="email" type="email" placeholder="Tu Email" name="contacto[email]" required/>
    `;
  } else {
    contactoDiv.textContent = 'Error';
  }
}


