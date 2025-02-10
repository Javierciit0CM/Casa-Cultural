document.addEventListener('DOMContentLoaded', () => {
    const loadingScreen = document.getElementById('loading-screen');
    const mainContent = document.getElementById('main-content');

    // Función para ocultar la pantalla de carga y mostrar el contenido principal
    function hideLoadingScreen() {
        loadingScreen.style.opacity = '0';
        loadingScreen.style.visibility = 'hidden';
        mainContent.style.display = 'block';
    }

    // Esperar a que todos los recursos de la página se carguen
    window.addEventListener('load', () => {
        // Simular un tiempo mínimo de carga para evitar parpadeos en cargas rápidas
        setTimeout(hideLoadingScreen, 500);
    });
});