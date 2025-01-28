document.addEventListener("DOMContentLoaded", () => {
    // Animate numbers in cards
    function animateValue(element, start, end, duration) {
      let startTimestamp = null
      const step = (timestamp) => {
        if (!startTimestamp) startTimestamp = timestamp
        const progress = Math.min((timestamp - startTimestamp) / duration, 1)
        element.innerHTML = Math.floor(progress * (end - start) + start)
        if (progress < 1) {
          window.requestAnimationFrame(step)
        }
      }
      window.requestAnimationFrame(step)
    }
  
    const percentageElement = document.querySelector(".hdr-percentage")
    const countElement = document.querySelector(".hdr-count")
    const amountElement = document.querySelector(".hdr-amount")
  
    animateValue(percentageElement, 0, Number.parseInt(percentageElement.dataset.target), 2000)
    animateValue(countElement, 0, Number.parseInt(countElement.dataset.target), 2000)
    animateValue(amountElement, 0, Number.parseInt(amountElement.dataset.target), 2000)
  
    // Add hover effect to table rows
    const tableRows = document.querySelectorAll(".hdr-table tbody tr")
    tableRows.forEach((row) => {
      row.addEventListener("mouseover", () => {
        row.style.transform = "scale(1.02)"
        row.style.transition = "transform 0.3s ease"
      })
      row.addEventListener("mouseout", () => {
        row.style.transform = "scale(1)"
      })
    })
  
    // Add staggered animation to table rows
    tableRows.forEach((row, index) => {
      row.style.animation = `fadeIn 0.5s ease-out ${index * 0.1}s`
    })
  
    // Add ripple effect to cards
    const cards = document.querySelectorAll(".hdr-card")
    cards.forEach((card) => {
      card.addEventListener("click", function (e) {
        const ripple = document.createElement("div")
        ripple.className = "ripple"
        this.appendChild(ripple)
        const rect = this.getBoundingClientRect()
        const x = e.clientX - rect.left
        const y = e.clientY - rect.top
        ripple.style.left = `${x}px`
        ripple.style.top = `${y}px`
        setTimeout(() => {
          ripple.remove()
        }, 600)
      })
    })
  
    // Add this CSS for the ripple effect
    const style = document.createElement("style")
    style.textContent = `
          .hdr-card {
              position: relative;
              overflow: hidden;
          }
          .ripple {
              position: absolute;
              border-radius: 50%;
              background-color: rgba(255, 255, 255, 0.7);
              transform: scale(0);
              animation: ripple 0.6s linear;
              pointer-events: none;
          }
          @keyframes ripple {
              to {
                  transform: scale(4);
                  opacity: 0;
              }
          }
      `
    document.head.appendChild(style)
  })
  
  