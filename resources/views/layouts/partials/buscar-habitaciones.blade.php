<!-- Botón flotante -->
<button class="floating-button" id="searchButton">
    <i class="fas fa-search"></i>
</button>

<!-- Modal de búsqueda -->
<div class="modal" id="searchModal">
    <div class="modal-content">
        <div class="modal-header">
            <h2>Buscar Disponibilidad</h2>
            <button class="close-button" id="closeModal">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div class="modal-body">
            <div class="date-inputs">
                <div class="input-group">
                    <label for="checkIn">Fecha de entrada</label>
                    <div class="input-with-icon">
                        <i class="fas fa-calendar"></i>
                        <input type="text" id="checkIn" placeholder="Seleccione fecha" readonly>
                    </div>
                </div>
                <div class="input-group">
                    <label for="checkOut">Fecha de salida</label>
                    <div class="input-with-icon">
                        <i class="fas fa-calendar"></i>
                        <input type="text" id="checkOut" placeholder="Seleccione fecha" readonly>
                    </div>
                </div>
            </div>
            <button class="search-button">
                <i class="fas fa-search"></i>
                Buscar
            </button>
        </div>
    </div>
</div>