document.addEventListener("DOMContentLoaded", () => {
    const widget = document.getElementById("whatsappWidget")
    const toggleButton = widget.querySelector(".whatsapp-widget-toggle")
    const closeButton = widget.querySelector(".whatsapp-widget-close")
    const sendButton = widget.querySelector(".whatsapp-widget-send")
    const optionButtons = widget.querySelectorAll(".whatsapp-widget-option")
    const input = widget.querySelector(".whatsapp-widget-input")
  
    let isVisible = false
  
    function toggleVisibility() {
      if (window.pageYOffset > 100 && !isVisible) {
        widget.style.display = "block"
        setTimeout(() => (widget.style.opacity = "1"), 50)
        isVisible = true
      } else if (window.pageYOffset <= 100 && isVisible) {
        widget.style.opacity = "0"
        setTimeout(() => (widget.style.display = "none"), 500)
        isVisible = false
      }
    }
  
    function toggleWidget() {
      widget.classList.toggle("active")
    }
  
    function closeWidget() {
      widget.classList.remove("active")
    }
  
    function sendMessage() {
      const message = input.value.trim()
      if (message) {
        const phoneNumber = "+51916410461" // Reemplaza con tu número de WhatsApp
        const encodedMessage = encodeURIComponent(message)
        window.open(`https://wa.me/${phoneNumber}?text=${encodedMessage}`, "_blank")
        input.value = ""
      }
    }
  
    function selectOption(e) {
      const option = e.target.textContent
      input.value = `Me gustaría obtener información sobre: ${option}`
    }
  
    window.addEventListener("scroll", toggleVisibility)
    toggleButton.addEventListener("click", toggleWidget)
    closeButton.addEventListener("click", closeWidget)
    sendButton.addEventListener("click", sendMessage)
    optionButtons.forEach((button) => button.addEventListener("click", selectOption))
  
    input.addEventListener("keypress", (e) => {
      if (e.key === "Enter") {
        sendMessage()
      }
    })
  
    // Animación suave al cargar la página
    setTimeout(toggleVisibility, 500)
  })
  
  