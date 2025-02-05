<section class="lh-rooms-section">
    <div class="lh-container">
        <h2 class="lh-section-title">Nuestras Habitaciones</h2>
        <div class="lh-rooms-grid">
            @foreach($habitaciones as $habitacion)
                <div class="lh-room-card" data-room-type="{{ $habitacion->tipo_habitacion }}">
                    <div class="lh-room-image" onclick="openModal({{ $habitacion->id }})">
                        <img src="{{ asset('storage/' . $habitacion->imagenes->first()->img ?? 'resources/img/default-room.jpg') }}" alt="{{ $habitacion->tipo_habitacion }}">
                        <div class="lh-room-overlay">
                            <span class="lh-room-price">Desde ${{ $habitacion->precio }}/noche</span>
                        </div>
                    </div>
                    <div class="lh-room-content">
                        <h3>{{ ucfirst($habitacion->tipo_habitacion) }}</h3>
                        
                        @php
                            $iconos = [
                                'baño' => 'fa-bath',
                                'tv' => 'fa-tv',
                                'cama doble' => 'fa-bed',
                                'vista a la calle'  => 'fa-city',
                                'wifi' => 'fa-wifi',
                                'aire acondicionado' => 'fa-wind'
                            ];
                        @endphp

                        <ul class="lh-room-features">
                            @foreach(explode(',', $habitacion->descripcion) as $caracteristica)
                                @php $caracteristica = trim(strtolower($caracteristica)); @endphp
                                <li>
                                    <i class="fas {{ $iconos[$caracteristica] ?? 'fa-check-circle' }}"></i>
                                    {{ ucfirst($caracteristica) }}
                                </li>
                            @endforeach
                        </ul>
                        <button class="lh-room-button" onclick="openModal({{ $habitacion->id }})">Ver Detalles</button>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="lh-more-rooms">
            <a href="#" class="lh-more-rooms-link">Más Habitaciones</a>
        </div>
    </div>
</section>