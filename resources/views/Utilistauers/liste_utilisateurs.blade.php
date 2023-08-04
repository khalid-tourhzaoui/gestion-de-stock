@extends('adminlte::page')
@section('plugins.Datatables',true)
@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="card my-2 bg-light "> 
                <div class="card-header" style="background-color:#008F7A">
                    <div class="text-center">
                        <h3 class="text-white">La liste des utilisateurs</h3>
                    </div>
                </div>
                <div class="card-body" style="overflow-x:auto;">
                    <!-- Form for filtering users based on type -->
                    <form class="row mb-2" method="post" action="{{ url('admin-utilisateurs') }}">
                        @csrf
                        <div class="col-sm-8">
                            <select name="typeUser" class="form-control mt-1" id="users">
                                <option value="1">Clients</option>
                                <option value="2">Fournisseurs</option>
                                <option value="3">Livreurs</option>
                            </select>
                        </div>
                        <div class="col-sm-2">
                            <button class="btn btn-outline-success w-100 mt-1" type="submit">Chercher</button>
                        </div>
                    </form>
                    <!-- Datatable to display user data -->
                    <table id="mytable" class="table table-bordered table-striped">
                        <thead>
                            <tr class="text-center">
                                <th>Nom & Prénom</th>
                                <th>CIN</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Adresse & Téléphone</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Loop through the users data and display them in the table -->
                            @foreach($data as $item)
                                <tr class="text-center">
                                    <td data-label="Nom & Prénom">{{ $item->name }}</td>
                                    <td data-label="CIN">{{ $item->cin }}</td>
                                    <td data-label="Email">{{ $item->email}}</td>
                                    <td data-label="Role">{{ $item->role }}</td>
                                    <td data-label="Adresse & Téléphone">{{$item->adresse.' | '.$item->telephonne}}</td>
                                    <td data-label="Actions" class="d-flex justify-content-center align-items-center">
                                        <!-- Add action buttons here (e.g., view, edit, delete) -->
                                        <!-- For example, the view and edit links for each user -->
                                        <a href="{{ route('admin.show', $item->id) }}" class="btn btn-sm btn-primary">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('admin.edit', $item->id) }}" class="btn btn-sm btn-warning mx-2">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <!-- Add a form for user deletion using the deleteForm function -->
                                        <form id="deleteForm{{ $item->id }}" action="{{ route('admin.destroy', $item->id) }}" method="POST">
                                            @method('DELETE')
                                            @csrf
                                        </form>
                                        <button type="button" onclick="deleteForm('{{ $item->id }}')" class="btn btn-sm btn-danger">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody> 
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<!-- DataTables script for table sorting and filtering -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready(function(){
        $('#mytable').DataTable({
            dom:'Bfrtip',
            buttons:['copy','excel','csv','pdf','print','colvis'],
            "pageLength": 4,

            "language": {
                "sEmptyTable": "",
                "sInfo": "Affichage de _START_ à _END_ sur _TOTAL_ entrées ",
                "sSearch": "Chercher:",
                "oPaginate": {
                    "sNext": "Suivant",
                    "sPrevious": "Précedent"
                },
            }
        })
    })

    // Function to confirm and handle user deletion
    function deleteForm(id){
        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {confirmButton: 'btn btn-success m-2', cancelButton: 'btn btn-danger m-2'},
            buttonsStyling: false
        });

        swalWithBootstrapButtons.fire({
            title: 'Es-tu sûr?',
            text: "Vous ne pourrez pas revenir en arrière !",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'OUI, supprimer !',
            cancelButtonText: 'NON, Annuler!',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('deleteForm' + id).submit();
            } else if (result.dismiss === Swal.DismissReason.cancel) {
                swalWithBootstrapButtons.fire(
                    'Annulé.',
                    'Votre fichier imaginaire est en sécurité. :)',
                    'error'
                )
            }
        })
    }
</script>
@if (session()->has('success'))
<!-- Show a success message using SweetAlert when needed -->
<script>
    Swal.fire({
        position: 'top-end',
        icon: 'success',
        title: "{{ session()->get('success') }}",
        showConfirmButton: false,
        timer: 1500
    })
</script>
@endif
@endsection
