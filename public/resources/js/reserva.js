document.addEventListener('DOMContentLoaded', function () {
    const currentDate = new Date();
    let currentMonth = currentDate.getMonth();
    let currentYear = currentDate.getFullYear();

    const monthYearElement = document.getElementById('currentMonthYear');
    const calendarDays = document.getElementById('calendarDays');
    const prevYearBtn = document.getElementById('prevYear');
    const nextYearBtn = document.getElementById('nextYear');
    const prevMonthBtn = document.getElementById('prevMonth');
    const nextMonthBtn = document.getElementById('nextMonth');
    const searchInput = document.getElementById('searchInput');

    const monthNames = ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio",
        "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"];

    // Simulación de reservas
    const reservas = [
        {
            fecha_entrada: '2025-01-10',
            fecha_salida: '2025-01-15',
            estado: 'Pendiente'
        },
        {
            fecha_entrada: '2025-01-18',
            fecha_salida: '2025-01-20',
            estado: 'Confirmado'
        }
    ];

    function updateCalendar() {
        monthYearElement.textContent = `${monthNames[currentMonth]} ${currentYear}`;
        calendarDays.innerHTML = '';

        const firstDay = new Date(currentYear, currentMonth, 1).getDay();
        const daysInMonth = new Date(currentYear, currentMonth + 1, 0).getDate();

        for (let i = 0; i < firstDay; i++) {
            calendarDays.appendChild(document.createElement('div'));
        }

        for (let i = 1; i <= daysInMonth; i++) {
            const dayElement = document.createElement('div');
            dayElement.textContent = i;
            dayElement.classList.add('calendar-day');
            if (i === currentDate.getDate() && currentMonth === currentDate.getMonth() && currentYear === currentDate.getFullYear()) {
                dayElement.style.backgroundColor = 'var(--primary-color)';
                dayElement.style.color = '#fff';
            }
            calendarDays.appendChild(dayElement);
        }

        renderReservationBars();
    }

    function renderReservationBars() {
        reservas.forEach(reserva => {
            const entrada = new Date(reserva.fecha_entrada);
            const salida = new Date(reserva.fecha_salida);
            const estadoColor = reserva.estado === 'Pendiente' ? 'orange' : 'green';

            if (
                (entrada.getFullYear() === currentYear && entrada.getMonth() === currentMonth) ||
                (salida.getFullYear() === currentYear && salida.getMonth() === currentMonth)
            ) {
                const startDay = entrada.getMonth() === currentMonth ? entrada.getDate() : 1;
                const endDay = salida.getMonth() === currentMonth ? salida.getDate() : new Date(currentYear, currentMonth + 1, 0).getDate();

                for (let day = startDay; day <= endDay; day++) {
                    const dayElement = calendarDays.querySelector(`.calendar-day:nth-child(${day + firstDay})`);
                    if (dayElement) {
                        const bar = document.createElement('div');
                        bar.style.backgroundColor = estadoColor;
                        bar.style.height = '5px';
                        bar.style.marginTop = '5px';
                        bar.style.borderRadius = '3px';
                        dayElement.appendChild(bar);
                    }
                }
            }
        });
    }

    prevYearBtn.addEventListener('click', () => {
        currentYear--;
        updateCalendar();
        animateCalendar('slideRight');
    });

    nextYearBtn.addEventListener('click', () => {
        currentYear++;
        updateCalendar();
        animateCalendar('slideLeft');
    });

    prevMonthBtn.addEventListener('click', () => {
        if (currentMonth === 0) {
            currentMonth = 11;
            currentYear--;
        } else {
            currentMonth--;
        }
        updateCalendar();
        animateCalendar('slideRight');
    });

    nextMonthBtn.addEventListener('click', () => {
        if (currentMonth === 11) {
            currentMonth = 0;
            currentYear++;
        } else {
            currentMonth++;
        }
        updateCalendar();
        animateCalendar('slideLeft');
    });

    function animateElement(element, animationName) {
        element.style.animation = `${animationName} 0.5s ease`;
        element.addEventListener('animationend', () => {
            element.style.animation = '';
        }, { once: true });
    }

    function animateCalendar(animationName) {
        const calendar = document.querySelector('.calendar-body');
        calendar.style.animation = `${animationName} 0.3s ease`;
        calendar.addEventListener('animationend', () => {
            calendar.style.animation = '';
        }, { once: true });
    }

    updateCalendar();
});


  // CREAR RESERVA
  
  document.addEventListener('DOMContentLoaded', function() {
    const habitacionSelect = document.getElementById('habitacion_id');
    const fechaEntradaInput = document.getElementById('fecha_entrada');
    const fechaSalidaInput = document.getElementById('fecha_salida');
    const diasEstadiaInput = document.getElementById('dias_estadia');
    const costoTotalInput = document.getElementById('costo_total');
    
    let precioHabitacion = 0;

    // Detectar cambio de habitación seleccionada para obtener el precio
    habitacionSelect.addEventListener('change', function() {
        precioHabitacion = habitacionSelect.options[habitacionSelect.selectedIndex].getAttribute('data-precio');
        calcularCostoYEstadia();
    });

    // Detectar cambios en las fechas
    fechaEntradaInput.addEventListener('change', calcularCostoYEstadia);
    fechaSalidaInput.addEventListener('change', calcularCostoYEstadia);

    // Función para calcular los días y el costo total
    function calcularCostoYEstadia() {
        // Validar que las fechas de entrada y salida estén correctamente seleccionadas
        if (fechaEntradaInput.value && fechaSalidaInput.value) {
            const fechaEntrada = new Date(fechaEntradaInput.value);
            const fechaSalida = new Date(fechaSalidaInput.value);

            // Validar que la fecha de salida sea posterior a la fecha de entrada
            if (fechaSalida > fechaEntrada) {
                // Calcular los días de estadía
                const diasEstadia = Math.ceil((fechaSalida - fechaEntrada) / (1000 * 60 * 60 * 24));

                // Calcular el costo total
                const costoTotal = diasEstadia * precioHabitacion;

                // Mostrar los resultados
                diasEstadiaInput.value = diasEstadia;
                costoTotalInput.value = `S/ ${costoTotal.toFixed(2)}`;
            } else {
                // Si la fecha de salida es antes que la de entrada
                alert('La fecha de salida debe ser posterior a la fecha de entrada.');
            }
        }
    }
});

// Modal Ver Detalles
function elegantModal(button) {
    // Obtener los datos del botón
    var id = button.getAttribute("data-id")
    var cliente = button.getAttribute("data-cliente")
    var dni = button.getAttribute("data-dni")
    var telefono = button.getAttribute("data-telefono")
    var edad = button.getAttribute("data-edad")
    var procedencia = button.getAttribute("data-procedencia")
    var condicion = button.getAttribute("data-condicion")
    var habitacion = button.getAttribute("data-habitacion")
    var precio = button.getAttribute("data-precio")
    var capacidad = button.getAttribute("data-capacidad")
    var descripcion = button.getAttribute("data-descripcion")
    var numero = button.getAttribute("data-numero")
    var entrada = button.getAttribute("data-entrada")
    var salida = button.getAttribute("data-salida")
    var estado = button.getAttribute("data-estado")
  
    // Rellenar los campos del modal con los datos
    document.getElementById("modal-id").innerHTML = `<i class="fas fa-hashtag"></i> ID: ${id}`
    document.getElementById("modal-cliente").textContent = cliente
    document.getElementById("modal-dni").textContent = dni
    document.getElementById("modal-telefono").textContent = telefono
    document.getElementById("modal-edad").textContent = edad
    document.getElementById("modal-procedencia").textContent = procedencia
    document.getElementById("modal-condicion").textContent = condicion
    document.getElementById("modal-habitacion").textContent = habitacion
    document.getElementById("modal-precio").textContent = precio
    document.getElementById("modal-capacidad").textContent = capacidad
    document.getElementById("modal-descripcion").textContent = descripcion
    document.getElementById("modal-numero").textContent = numero
  
    // Formatear y mostrar las fechas
    var fechaEntrada = new Date(entrada)
    var fechaSalida = new Date(salida)
    var options = { year: "numeric", month: "long", day: "numeric" }
    document.getElementById("modal-fechas").innerHTML = `
          <i class="fas fa-calendar-alt"></i>
          ${fechaEntrada.toLocaleDateString("es-ES", options)} - ${fechaSalida.toLocaleDateString("es-ES", options)}
      `
  
    // Mostrar el estado con un icono y color correspondiente
    var estadoElement = document.getElementById("modal-estado")
    var estadoIcono, estadoColor
  
    switch (estado.toLowerCase()) {
      case "confirmada":
        estadoIcono = "fa-check-circle"
        estadoColor = "var(--confirmed-color)"
        break
      case "pendiente":
        estadoIcono = "fa-clock"
        estadoColor = "var(--pending-color)"
        break
      case "cancelada":
        estadoIcono = "fa-times-circle"
        estadoColor = "var(--cancelled-color)"
        break
      default:
        estadoIcono = "fa-info-circle"
        estadoColor = "var(--text-color)"
    }
  
    estadoElement.innerHTML = `<i class="fas ${estadoIcono}" style="color: ${estadoColor};"></i> ${estado}`
    estadoElement.style.color = estadoColor
  
    // Mostrar el modal con una animación suave
    var modal = document.getElementById("elegantModal")
    modal.classList.add("show")
  
    // Ajustar el scroll
    document.body.style.overflow = "hidden"
  
    // Añadir animación a los elementos del modal
    var detailItems = document.querySelectorAll(".elegant-detail-item")
    detailItems.forEach((item, index) => {
      item.style.animationDelay = `${0.1 * index}s`
    })
  
    // Ajustar la altura del contenido del modal
    adjustModalHeight()
  }
  
  function closeModal() {
    var modal = document.getElementById("elegantModal")
    modal.classList.remove("show")
    document.body.style.overflow = "auto"
  }
  
  function handleTouchStart(event) {
    if (event.target.closest(".elegant-modal-content")) return
    closeModal()
  }
  
  function adjustModalHeight() {
    var modalContent = document.querySelector(".elegant-modal-content")
    var modalHeader = document.querySelector(".elegant-modal-header")
    var modalBody = document.querySelector(".elegant-modal-body")
  
    if (modalContent && modalHeader && modalBody) {
      var windowHeight = window.innerHeight
      var headerHeight = modalHeader.offsetHeight
      var maxBodyHeight = windowHeight - headerHeight - 40 // 40px for padding
  
      modalBody.style.maxHeight = `${maxBodyHeight}px`
    }
  }
  
  // Añadir event listener para dispositivos táctiles y redimensionamiento de ventana
  document.addEventListener("DOMContentLoaded", () => {
    var modal = document.getElementById("elegantModal")
    modal.addEventListener("touchstart", handleTouchStart)
    window.addEventListener("resize", adjustModalHeight)
  })
  
  // Cerrar el modal al hacer clic fuera de él
  window.onclick = (event) => {
    var modal = document.getElementById("elegantModal")
    if (event.target == modal) {
      closeModal()
    }
  }
  
  // Añadir efecto de hover a los elementos de detalle
  document.querySelectorAll(".elegant-detail-item").forEach((item) => {
    item.addEventListener("mouseenter", () => {
      item.style.transform = "translateY(-5px)"
    })
    item.addEventListener("mouseleave", () => {
      item.style.transform = "translateY(0)"
    })
  })
  

// MODAL PARA ACTUALIZAR ESTADO DE LA RESERVA
function openEditModal(button) {
  const id = button.getAttribute('data-id');
  const estado = button.getAttribute('data-estado');

  const form = document.getElementById('editForm');
  form.action = `/reservas/${id}`;
  document.getElementById('reservationStatus').value = estado;

  // Show the modal
  const modal = document.getElementById('editModal');
  modal.classList.add('visible');
  document.body.style.overflow = 'hidden'; // Prevent scrolling
}

function closeEditModal() {
  // Hide the modal
  const modal = document.getElementById('editModal');
  modal.classList.remove('visible');
  document.body.style.overflow = 'auto'; // Restore scrolling
}
