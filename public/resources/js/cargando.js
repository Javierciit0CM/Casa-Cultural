document.addEventListener("DOMContentLoaded", () => {
    const loadingScreen = document.getElementById("loading-screen")
    const percentageText = document.querySelector(".percentage")
    const loadingText = document.querySelector(".loading-text")
    const circlePath = document.querySelector(".circle-path")
  
    const loadingPhrases = ["Iniciando Administrador", "Cargando Módulos", "Actualizando Datos", "Preparando Interfaz"]
  
    let progress = 0
    let phraseIndex = 0
  
    const interval = setInterval(() => {
      progress += 1
      if (progress > 100) progress = 100
  
      percentageText.textContent = `${progress}%`
      circlePath.style.strokeDashoffset = 251.2 - (251.2 * progress) / 100
  
      if (progress % 25 === 0) {
        loadingText.textContent = loadingPhrases[phraseIndex]
        phraseIndex = (phraseIndex + 1) % loadingPhrases.length
      }
  
      if (progress === 100) {
        clearInterval(interval)
        setTimeout(hideLoadingScreen, 500)
      }
    }, 40)
  
    function hideLoadingScreen() {
      loadingScreen.classList.add("fade-out")
      setTimeout(() => {
        loadingScreen.style.display = "none"
      }, 500)
    }
  })
  
  function showLoadingScreen() {
    const loadingScreen = document.getElementById("loading-screen")
    const percentageText = document.querySelector(".percentage")
    const loadingText = document.querySelector(".loading-text")
    const circlePath = document.querySelector(".circle-path")
    const loadingModules = document.querySelector(".loading-modules")
  
    const loadingPhrases = ["Iniciando Administrador", "Cargando Módulos", "Actualizando Datos", "Preparando Interfaz"]
  
    // Reiniciar elementos
    percentageText.textContent = "0%"
    loadingText.textContent = loadingPhrases[0]
    circlePath.style.strokeDashoffset = 251.2
    loadingModules.style.width = "0"
  
    loadingScreen.classList.remove("fade-out")
    loadingScreen.style.display = "flex"
  
    let progress = 0
    let phraseIndex = 0
  
    const interval = setInterval(() => {
      progress += 1
      if (progress > 100) progress = 100
  
      percentageText.textContent = `${progress}%`
      circlePath.style.strokeDashoffset = 251.2 - (251.2 * progress) / 100
  
      if (progress % 25 === 0) {
        loadingText.textContent = loadingPhrases[phraseIndex]
        phraseIndex = (phraseIndex + 1) % loadingPhrases.length
      }
  
      if (progress === 100) {
        clearInterval(interval)
        setTimeout(() => {
          loadingScreen.classList.add("fade-out")
          setTimeout(() => {
            loadingScreen.style.display = "none"
          }, 500)
        }, 500)
      }
    }, 40)
  }
  
  