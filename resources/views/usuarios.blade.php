@extends('layouts.main')

@push('styles')
	<link href="{{ asset('assets/plugins/custom/bootstraptable/css/bootstrap-table.min.css') }}" type="text/css" rel="stylesheet" />
@endpush

@section('content')
    <div class="card card-custom">
        <div class="card-header">
            <div class="card-title">
                <span class="card-icon">
                    <i class="fa-solid fa-user"></i>
                </span>
                <h3 class="card-label">
                    Usuarios
                </h3>
            </div>
            <div class="card-toolbar">
                <button id="btn_agregar_usuario" class="btn btn-primary" data-ruta-obtener-usuario="{{ route("obtenerUsuario") }}">
                    <i class="fas fa-plus"></i> Obtener usuario
                </button>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table 
                    class="table text-center table-row-redirect gy-5" 
                    id="tabla_usuarios"
                    data-toggle="table"
                    data-unique-id="id">
                    <thead>
                        <tr>
                            <th data-field="id">ID</th>
                                <th data-field="nombre" data-formatter="nombreFormatter">Nombre</th>
                                <th data-field="direccion" data-formatter="direccionFormatter">Dirección</th>
                                <th data-field="codigo_postal" data-formatter="codigoPostalFormatter">Código Postal</th>
                            <th data-field="email">Correo</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
    @include("modal_editar_usuario")
@endsection

@push('scripts')
    <script>
        var usuarios = @json($usuarios);
    </script>
	<script src="{{ asset('assets/plugins/custom/bootstraptable/js/bootstrap-table.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/custom/bootstraptable/js/bootstrap-table-es-SP.js') }}"></script>
    <script src="{{ asset('assets/plugins/custom/jqueryvalidate/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/custom/jqueryvalidate/messages_es.js') }}"></script>
    <script src="{{ asset('js/usuarios.js') }}"></script>
@endpush

