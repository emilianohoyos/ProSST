@extends('layouts.master')
@section('title')
    Clientes
@endsection
@section('css')
    <!-- fullcalendar css -->
    <link href="{{ URL::asset('build/libs/fullcalendar/main.min.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('page-title')
    Clientes
@endsection
@section('body')

    <body>
    @endsection
    @section('content')
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Mis Clientes</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table mb-0">
                                <!-- table mb-0-->

                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nit/Identificación</th>
                                        <th>Razón Social/Nombre</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($clients as $item)
                                        <tr>
                                            <th scope="row">{{ $item->id }}</th>
                                            <td>{{ $item->identification }}</td>
                                            <td>{{ $item->name }}</td>
                                            <td>
                                                <button type="button" data-bs-placement="top" title="Editar"
                                                    onclick="editarModal({{ $item->client_user_id }})"
                                                    class="btn btn-warning waves-effect waves-light">
                                                    <i class="fa fa-pen font-size-16 "></i>
                                                </button>
                                                <button type="button" class="btn btn-danger waves-effect waves-light"
                                                    title="Eliminar" data-bs-toggle="tooltip" data-bs-placement="top"
                                                    onclick="confirmDeleteClientUser({{ $item->client_user_id }})">
                                                    <i class="fa fa-trash font-size-16"></i>
                                                </button>
                                                <form id="delete-client-user-form" method="POST" style="display: none;">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                            <br>
                            <!-- Enlaces de paginación -->
                            {{ $clients->links('pagination::bootstrap-5') }}
                        </div>

                    </div>
                </div>
            </div>


        </div>
        @include('clients.modal.edit')
    @endsection
    @section('scripts')
        <script>
            const myModal = new bootstrap.Modal(document.getElementById('editModal'));

            function editarModal(client_user_id) {
                fetch('client-users/' + client_user_id)
                    .then(response => response.json())
                    .then(data => {
                        console.log(data);

                        document.getElementById('client_user_id').value = data[0].client_user_id;
                        document.getElementById('client_id').value = data[0].client_id;
                        document.getElementById('name').value = data[0].name;
                        document.getElementById('identification').value = data[0].identification;
                        document.getElementById('document_type_id').value = data[0].document_type_id.toString();
                        document.getElementById('person_type_id').value = data[0].person_type_id.toString();
                        document.getElementById('email').value = data[0].email.toString();
                        document.getElementById('headquarters').value = data[0].headquarters.toString();
                        document.getElementById('representative').value = data[0].representative.toString();

                    });

                myModal.show();
            }

            function actualizarDatos() {
                event.preventDefault();
                let client_user_id = document.getElementById('client_user_id').value
                // const url = `/client/${client_user_id}`;
                const form = document.getElementById('editClientForm');
                const formData = new FormData(form);
                console.log(formData);
                Swal.fire({
                    title: '¿Estás seguro?',
                    text: '¿Deseas actualizar los datos del cliente?',
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Sí, actualizar',
                    cancelButtonText: 'Cancelar',
                }).then((result) => {
                    if (result.isConfirmed) {
                        fetch(`client-users-update/${client_user_id}`, {
                                method: 'POST', // o 'PATCH'
                                headers: {
                                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                                },
                                body: formData
                            })

                            .then(response => response.json())
                            .then(data => {
                                console.log(data)

                                Swal.fire({
                                    position: "top-end",
                                    icon: "success",
                                    title: "se ha actualizado el cliente",
                                    showConfirmButton: false,
                                    timer: 1500
                                });
                                myModal.hide();
                                window.location.reload();
                            })
                            .catch(error => console.error('Error:', error));
                    }
                })
            }

            document.addEventListener('DOMContentLoaded', () => {



            });

            function confirmDeleteClientUser(userClientId) {
                Swal.fire({
                    title: '¿Estás seguro?',
                    text: "Esta acción eliminará la relación con el cliente.",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Sí, eliminar',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        const form = document.getElementById('delete-client-user-form');
                        form.action = `/users-clients/${userClientId}`;
                        form.submit();
                    }
                });
            }
        </script>
        <script src="{{ URL::asset('build/js/app.js') }}"></script>
    @endsection
