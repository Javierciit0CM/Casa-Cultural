document.addEventListener("DOMContentLoaded", () => {
    const modal = document.getElementById("rmModal")
    const openModalBtn = document.getElementById("rmOpenModal")
    const closeModalBtn = document.getElementById("rmCloseModal")
    const form = document.getElementById("rmRoomRegistrationForm")
    const fileInput = document.getElementById("rmRoomImages")
    const imagePreview = document.getElementById("rmImagePreview")
  
    // Image preview
    fileInput.addEventListener("change", (e) => {
      const files = e.target.files
      for (let i = 0; i < files.length; i++) {
        const file = files[i]
        if (!file.type.startsWith("image/")) continue
        addImagePreview(file)
      }
    })
  
    function addImagePreview(file) {
      const reader = new FileReader()
      reader.onload = (e) => {
        const div = document.createElement("div")
        div.className = "rm-image-preview-item"
  
        const img = document.createElement("img")
        img.src = e.target.result
  
        const removeBtn = document.createElement("button")
        removeBtn.className = "rm-image-remove"
        removeBtn.innerHTML = "&times;"
        removeBtn.addEventListener("click", () => {
          div.remove()
        })
  
        div.appendChild(img)
        div.appendChild(removeBtn)
        imagePreview.appendChild(div)
      }
      reader.readAsDataURL(file)
    }
  })
  
  
  /*Detalles*/

  document.addEventListener("DOMContentLoaded", () => {
    // Initialize Feather icons
    feather.replace()
  
    const modal = document.getElementById("luxe-image-modal")
    const modalImg = document.getElementById("luxe-modal-image")
    const closeBtn = document.getElementsByClassName("luxe-close-button")[0]
    const prevBtn = document.getElementById("luxe-prev-button")
    const nextBtn = document.getElementById("luxe-next-button")
    const images = document.querySelectorAll(".luxe-room-image")
    let currentImageIndex = 0
  
    // Open modal and set image
    images.forEach((img, index) => {
      img.onclick = function () {
        modal.style.display = "block"
        modalImg.src = this.src
        currentImageIndex = index
        updateNavButtons()
      }
    })
  
    // Close modal
    closeBtn.onclick = () => {
      modal.style.display = "none"
    }
  
    // Navigate to previous image
    prevBtn.onclick = () => {
      currentImageIndex = (currentImageIndex - 1 + images.length) % images.length
      modalImg.src = images[currentImageIndex].src
      updateNavButtons()
    }
  
    // Navigate to next image
    nextBtn.onclick = () => {
      currentImageIndex = (currentImageIndex + 1) % images.length
      modalImg.src = images[currentImageIndex].src
      updateNavButtons()
    }
  
    // Update navigation buttons visibility
    function updateNavButtons() {
      prevBtn.style.display = images.length > 1 ? "block" : "none"
      nextBtn.style.display = images.length > 1 ? "block" : "none"
    }
  
    // Close modal on outside click
    window.onclick = (event) => {
      if (event.target == modal) {
        modal.style.display = "none"
      }
    }
  
    // Keyboard navigation
    document.addEventListener("keydown", (e) => {
      if (modal.style.display === "block") {
        if (e.key === "ArrowLeft") {
          prevBtn.click()
        } else if (e.key === "ArrowRight") {
          nextBtn.click()
        } else if (e.key === "Escape") {
          modal.style.display = "none"
        }
      }
    })
  
    // Animate elements on scroll
    const animateOnScroll = () => {
      const elements = document.querySelectorAll(".luxe-fade-in, .luxe-slide-in")
      elements.forEach((element) => {
        const elementTop = element.getBoundingClientRect().top
        const elementBottom = element.getBoundingClientRect().bottom
        if (elementTop < window.innerHeight && elementBottom > 0) {
          element.style.opacity = "1"
          element.style.transform = "translateY(0)"
        }
      })
    }
  
    window.addEventListener("scroll", animateOnScroll)
    animateOnScroll() // Initial check on page load
  })
  
// EDIT

document.addEventListener("DOMContentLoaded", () => {
  const form = document.getElementById("rmuRoomUpdateForm")
  const fileInput = document.getElementById("rmuRoomImages")
  const imagePreview = document.getElementById("rmuImagePreview")
  const existingImages = document.querySelector(".rmu-existing-images")
  const modal = document.getElementById("rmuImageModal")
  const modalImg = document.getElementById("rmuModalImage")
  const closeModal = document.querySelector(".rmu-modal-close")

  // Handle file input change
  fileInput.addEventListener("change", (e) => {
    handleFileInputChange(e.target.files)
  })
  // Handle deleting existing images
  existingImages.addEventListener("click", (e) => {
    if (e.target.classList.contains("rmu-delete-image") || e.target.closest(".rmu-delete-image")) {
      const button = e.target.closest(".rmu-delete-image")
      const imageId = button.dataset.imageId
      deleteExistingImage(imageId)
    } else if (e.target.tagName === "IMG") {
      showImageModal(e.target.src)
    }
  })

  // Handle clicks on preview images
  imagePreview.addEventListener("click", (e) => {
    if (e.target.tagName === "IMG") {
      showImageModal(e.target.src)
    }
  })

  // Close modal when clicking the close button
  closeModal.addEventListener("click", () => {
    modal.style.display = "none"
  })

  // Close modal when clicking outside the image
  modal.addEventListener("click", (e) => {
    if (e.target === modal) {
      modal.style.display = "none"
    }
  })

  // Function to show image in modal
  function showImageModal(src) {
    modalImg.src = src
    modal.style.display = "block"
  }

  // Function to handle file input change
  function handleFileInputChange(files) {
    imagePreview.innerHTML = ""
    for (let i = 0; i < files.length; i++) {
      const file = files[i]
      if (file.type.startsWith("image/")) {
        const imgContainer = document.createElement("div")
        imgContainer.className = "rmu-preview-item"

        const img = document.createElement("img")
        img.file = file

        const deleteBtn = document.createElement("button")
        deleteBtn.className = "rmu-delete-preview"
        deleteBtn.innerHTML = '<i class="fas fa-times"></i>'
        deleteBtn.onclick = (e) => {
          e.stopPropagation()
          imgContainer.remove()
          updateFileInput()
        }

        imgContainer.appendChild(img)
        imgContainer.appendChild(deleteBtn)
        imagePreview.appendChild(imgContainer)

        const reader = new FileReader()
        reader.onload = ((aImg) => (e) => {
          aImg.src = e.target.result
        })(img)
        reader.readAsDataURL(file)
      }
    }
  }

  // Function to update file input after deleting preview
  function updateFileInput() {
    const dt = new DataTransfer()
    const previews = imagePreview.querySelectorAll(".rmu-preview-item img")
    previews.forEach((preview) => {
      dt.items.add(preview.file)
    })
    fileInput.files = dt.files
  }

  // Function to delete existing image
  function deleteExistingImage(imageId) {
    const imageItem = document.querySelector(`.rmu-image-item[data-image-id="${imageId}"]`)
    if (imageItem) {
      // Create a hidden input to mark the image for deletion on the server
      const hiddenInput = document.createElement("input")
      hiddenInput.type = "hidden"
      hiddenInput.name = "eliminar_imagenes[]"
      hiddenInput.value = imageId
      form.appendChild(hiddenInput)

      // Remove the image item from the DOM
      imageItem.remove()
    }
  }

  function validateForm() {
    const errors = []
    const requiredFields = form.querySelectorAll("[required]")
    requiredFields.forEach((field) => {
      if (!field.value.trim()) {
        errors.push(`El campo ${field.previousElementSibling.textContent} es requerido.`)
      }
    })
    return errors
  }

  function showErrors(errors) {
    const errorAlert = document.getElementById("rmuErrorAlert")
    const errorList = document.getElementById("rmuErrorList")
    errorList.innerHTML = ""
    errors.forEach((error) => {
      const li = document.createElement("li")
      li.textContent = error
      errorList.appendChild(li)
    })
    errorAlert.style.display = "block"

    // Smooth scroll to error messages
    errorAlert.scrollIntoView({ behavior: "smooth", block: "start" })
  }
})