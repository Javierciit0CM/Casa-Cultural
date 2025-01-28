// Crear

document.addEventListener("DOMContentLoaded", () => {
  const form = document.getElementById("restaurantForm")
  const errorContainer = document.getElementById("errorContainer")
  const errorList = document.getElementById("errorList")
  const imageInput = document.getElementById("imagenes")
  const imagePreviewContainer = document.getElementById("imagePreviewContainer")
  const fullscreenOverlay = document.getElementById("fullscreenOverlay")
  const fullscreenImage = document.getElementById("fullscreenImage")
  const closeFullscreen = document.getElementById("closeFullscreen")

  imageInput.addEventListener("change", (e) => {
    imagePreviewContainer.innerHTML = ""
    const files = e.target.files

    for (let i = 0; i < files.length; i++) {
      const file = files[i]
      const reader = new FileReader()

      reader.onload = (e) => {
        const previewWrapper = document.createElement("div")
        previewWrapper.classList.add("rr-image-preview-wrapper")

        const img = document.createElement("img")
        img.src = e.target.result
        img.classList.add("rr-image-preview", "fade-in")
        img.addEventListener("click", () => showFullscreen(e.target.result))

        const removeBtn = document.createElement("button")
        removeBtn.innerHTML = "&times;"
        removeBtn.classList.add("rr-image-remove-btn")
        removeBtn.addEventListener("click", (event) => {
          event.stopPropagation()
          previewWrapper.remove()
          updateFileInput()
        })

        previewWrapper.appendChild(img)
        previewWrapper.appendChild(removeBtn)
        imagePreviewContainer.appendChild(previewWrapper)
      }

      reader.readAsDataURL(file)
    }
  })

  function showFullscreen(src) {
    fullscreenImage.src = src
    fullscreenOverlay.style.display = "flex"
    document.body.style.overflow = "hidden"
  }

  closeFullscreen.addEventListener("click", () => {
    fullscreenOverlay.style.display = "none"
    document.body.style.overflow = "auto"
  })

  fullscreenOverlay.addEventListener("click", (e) => {
    if (e.target === fullscreenOverlay) {
      fullscreenOverlay.style.display = "none"
      document.body.style.overflow = "auto"
    }
  })

  function updateFileInput() {
    const remainingPreviews = imagePreviewContainer.querySelectorAll(".rr-image-preview-wrapper")
    if (remainingPreviews.length === 0) {
      imageInput.value = ""
    }
  }
})

