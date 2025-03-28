    // Menú desplegable para dispositivos móviles
    const navLinks = document.querySelector('nav ul');
    const menuToggle = document.createElement('button');
    menuToggle.innerText = '☰';
    menuToggle.style.fontSize = '24px';
    menuToggle.style.background = 'none';
    menuToggle.style.border = 'none';
    menuToggle.style.color = '#fff';
    menuToggle.style.cursor = 'pointer';
    document.querySelector('header').appendChild(menuToggle);
    menuToggle.addEventListener('click', () => {
        navLinks.classList.toggle('active');
    });
    // Efectos para el botón "Conoce más"
    const btnServicios = document.getElementById('btn-servicios');
    btnServicios.addEventListener('mouseover', () => {
        btnServicios.style.backgroundColor = '#d35400';
    });
    btnServicios.addEventListener('mouseout', () => {
        btnServicios.style.backgroundColor = '#e67e22';
    });
    // Efectos para el botón de envío
    const btnEnviar = document.getElementById('btn-enviar');
    btnEnviar.addEventListener('mouseover', () => {
        btnEnviar.style.backgroundColor = '#d35400';
    });
    btnEnviar.addEventListener('mouseout', () => {
        btnEnviar.style.backgroundColor = '#e67e22';
    });