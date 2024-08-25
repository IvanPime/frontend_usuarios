var btnAgregarUsuario = document.getElementById('btn_agregar_usuario');
var modalEditarUsuario = new bootstrap.Modal(document.getElementById('modalEditarUsuario'));
document.getElementById('modalEditarUsuario').addEventListener('hidden.bs.modal', function () {
    document.body.classList.remove('modal-open');
    document.body.style.overflow = '';
});
var blockUI = new KTBlockUI(document.querySelector("#kt_app_body"), {
    message: '<div class="blockui-message"><span class="spinner-border text-primary"></span> Loading...</div>',
});

btnAgregarUsuario.addEventListener('click', async function () {
    try {
        blockUI.block();
        var rutaObtenerUsuario = btnAgregarUsuario.getAttribute('data-ruta-obtener-usuario');
        const response = await fetch(rutaObtenerUsuario, {
            method: "GET",
            headers: {
                'Content-Type': 'application/json', 
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        });
        if (!response.ok) {
            throw new Error('Error en la petición: ' + response.statusText);
        }
        const resp = await response.json();
        if (resp.estatus) {
            tablaUsuarios.bootstrapTable("load", resp.usuarios);
        } else {
            let errorMessageHTML = '<ul>';
            resp.errores.forEach(function(error) {
                errorMessageHTML += `<li>${error}</li>`;
            });
            errorMessageHTML += '</ul>';
            Swal.fire({
                icon: 'error',
                title: 'Errores de Validación',
                html: errorMessageHTML,
            });
        }
    } catch (error) {
        swal.fire(error.message, "", "error");
    } finally {
        blockUI.release();
    }
});

function nombreFormatter(value, row, index) {
    return `<strong>${row.title} ${row.first} ${row.last}</strong>`;
}

function direccionFormatter(value, row, index) {
    return `${row.city}, ${row.state}, ${row.country}`;
}

function codigoPostalFormatter(value, row, index) {
    return `<span class="badge badge-primary">${row.postcode}</span>`;
}

var tablaUsuarios = $('#tabla_usuarios').bootstrapTable({
    data: usuarios,
});

tablaUsuarios.on('click-row.bs.table', function(e, row, $element) {
    blockUI.block();
    document.getElementById('editarId').value = row.id;
    document.getElementById('editarTitulo').value = row.title;
    document.getElementById('editarNombre').value = row.first;
    document.getElementById('editarApellido').value = row.last;
    document.getElementById('editarCiudad').value = row.city;
    document.getElementById('editarEstado').value = row.state;
    document.getElementById('editarPais').value = row.country;
    document.getElementById('editarCodigoPostal').value = row.postcode;
    document.getElementById('editarCorreo').value = row.email;
    modalEditarUsuario.show();
    blockUI.release();
});

const formEditarUsuario = $("#formEditarUsuario");
const validatorFormEditarUsuario = formEditarUsuario.validate({
    validClass: "is-valid",
    errorClass: "is-invalid",   
    submitHandler: function(form) {
        blockUI.block();
        var rutaEditarUsuario = form.getAttribute('action');
        var datosFormulario = $(form).serializeArray();
        var datosJson = {};
        datosFormulario.forEach(({ name, value }) => {
            datosJson[name] = value;
        });

        /* console.log(datosFormulario); */

        fetch(rutaEditarUsuario, {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            body: JSON.stringify(datosJson),
        })
        .then(resp => resp.json())
        .then(resp => {
            if (resp.estatus) {
                tablaUsuarios.bootstrapTable("load", resp.usuarios);
                modalEditarUsuario.hide();
                validatorFormEditarUsuario.resetForm();
                swal.fire(resp.message, "", "success");
            } else {
                let errorMessageHTML = '<ul>';
                resp.errores.forEach(function(error) {
                    errorMessageHTML += `<li>${error}</li>`;
                });
                errorMessageHTML += '</ul>';
                Swal.fire({
                    icon: 'error',
                    title: 'Errores de Validación',
                    html: errorMessageHTML,
                });
            } 
        })
        .catch(error => swal.fire(error, "", "error"))
        .finally(() => {
            blockUI.release();
        });
    }
});



/*  */


/* document.getElementById('obtenerUsuario').addEventListener('click', function() {
    fetch('/obtener-usuario')
        .then(response => response.json())
        .then(data => {
            if (data.error) {
                alert(data.error);
            } else {
                const usuario = data.results[0];
                const fila = document.createElement('tr');
                fila.innerHTML = `
                    <td>${usuario.name.title} ${usuario.name.first} ${usuario.name.last}</td>
                    <td>${usuario.location.city}, ${usuario.location.state}, ${usuario.location.country}</td>
                    <td>${usuario.location.postcode}</td>
                    <td>${usuario.email}</td>
                    <td><button class="btn btn-success guardar-usuario">Guardar</button></td>
                `;
                document.getElementById('tablaUsuarios').appendChild(fila);
            }
        })
        .catch(error => console.error('Error:', error));
});

document.getElementById('tablaUsuarios').addEventListener('click', function(event) {
    if (event.target.classList.contains('guardar-usuario')) {
        const fila = event.target.parentNode.parentNode;
        const nombre = fila.children[0].textContent;
        const direccion = fila.children[1].textContent;
        const codigo_postal = fila.children[2].textContent;
        const correo = fila.children[3].textContent;

        fetch('/guardar-usuario', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({ nombre, direccion, codigo_postal, correo })
        })
        .then(response => response.json())
        .then(data => {
            if (data.message) {
                alert(data.message);
            } else {
                alert('Error al guardar el usuario');
            }
        })
        .catch(error => console.error('Error:', error));
    }
});
 */