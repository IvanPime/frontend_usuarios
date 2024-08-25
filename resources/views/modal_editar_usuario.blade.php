<form id="formEditarUsuario" action="{{ route("guardarUsuario") }}">
    <div class="modal fade" id="modalEditarUsuario" tabindex="-1" aria-labelledby="modalEditarUsuarioLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalEditarUsuarioLabel">Editar Usuario</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="editarId" name="id">
                    <div class="mb-3">
                        <label for="editarTitulo" class="form-label">Título</label>
                        <input type="text" class="form-control" id="editarTitulo" name="title" required>
                    </div>
                    <div class="mb-3">
                        <label for="editarNombre" class="form-label">Nombre</label>
                        <input type="text" class="form-control" id="editarNombre" name="first" required>
                    </div>
                    <div class="mb-3">
                        <label for="editarApellido" class="form-label">Apellido</label>
                        <input type="text" class="form-control" id="editarApellido" name="last" required>
                    </div>
                    <div class="mb-3">
                        <label for="editarCiudad" class="form-label">Ciudad</label>
                        <input type="text" class="form-control" id="editarCiudad" name="city" required>
                    </div>
                    <div class="mb-3">
                        <label for="editarEstado" class="form-label">Estado</label>
                        <input type="text" class="form-control" id="editarEstado" name="state" required>
                    </div>
                    <div class="mb-3">
                        <label for="editarPais" class="form-label">País</label>
                        <input type="text" class="form-control" id="editarPais" name="country" required>
                    </div>
                    <div class="mb-3">
                        <label for="editarCodigoPostal" class="form-label">Código Postal</label>
                        <input type="number" class="form-control" id="editarCodigoPostal" name="postcode" required>
                    </div>
                    <div class="mb-3">
                        <label for="editarCorreo" class="form-label">Correo</label>
                        <input type="email" class="form-control" id="editarCorreo" name="email" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                </div>
            </div>
        </div>
    </div>
</form>
