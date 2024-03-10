
  // Verifica si la cookie de aceptación está establecida
  window.onload = function() {
    var aceptaCookies = document.cookie.split('; ').find(row => row.startsWith('acepta_cookies'));
    console.log(aceptaCookies);
    if (!aceptaCookies) {
        // Si no se han aceptado las cookies, muestra el bloqueo
        document.getElementById('bloqueo').style.display = 'block';
    }
};
