<section class="room-section">
    <div class="room-grid">
        @foreach($habitaciones as $habitacion)
        <div class="room-card" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
            <div class="room-image" data-bs-toggle="modal" data-bs-target="#modal-{{ $habitacion->id }}">
                @if($habitacion->imagenes->isNotEmpty())
                    <img src="{{ asset('storage/' . $habitacion->imagenes->first()->img) }}" alt="{{ $habitacion->tipo_habitacion }}">
                @else
                    <img src="{{ asset('resources/img/default-room.jpg') }}" alt="Imagen no disponible">
                @endif
                <div class="room-overlay">
                    <span class="room-price">Desde ${{ $habitacion->precio }}/noche</span>
                </div>
            </div>
            <div class="room-info">
                <h2 class="room-name">{{ $habitacion->tipo_habitacion }}</h2>
                <ul class="room-features">
                    <li><i class="fas fa-user-friends"></i> {{ $habitacion->capacidad_maxima }} personas</li>
                    @foreach(explode(',', $habitacion->descripcion) as $desc)
                        <li>
                            @switch(true)
                                @case(str_contains(strtolower($desc), 'baño'))
                                    <i class="fas fa-bath"></i>
                                    @break
                                @case(str_contains(strtolower($desc), 'vista'))
                                    <i class="fas fa-eye"></i>
                                    @break
                                @case(str_contains(strtolower($desc), 'wifi'))
                                    <i class="fas fa-wifi"></i>
                                    @break
                                @case(str_contains(strtolower($desc), 'cocina'))
                                    <i class="fas fa-utensils"></i>
                                    @break
                                @case(str_contains(strtolower($desc), 'cafetera'))
                                    <i class="fas fa-coffee"></i>
                                    @break
                                @case(str_contains(strtolower($desc), 'escritorio'))
                                    <i class="fas fa-briefcase"></i>
                                    @break
                                @case(str_contains(strtolower($desc), 'servicio'))
                                    <i class="fas fa-concierge-bell"></i>
                                    @break
                                @default
                                    <i class="fas fa-check"></i>
                            @endswitch
                            {{ ucfirst(trim($desc)) }}
                        </li>
                    @endforeach
                </ul>
                <a href="{{ route('habitaciones.show', $habitacion->id) }}" class="book-btn">Reservar Ahora</a>
            </div>
        </div>  
        @endforeach
    </div>
</section>