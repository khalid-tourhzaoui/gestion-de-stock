@extends('adminlte::page')
@section('plugins.Datatables',true)
@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="card my-2 bg-light ">
                <div class="card-header" style="background-color:#008F7A">
                    <div class="text-center">
                        <h3 class="text-white">La liste des paiements</h3>
                    </div>
                </div>
                <div class="card-body" style="overflow-x:auto;">
                <table id="mytable" class="table table-bordered table-striped">
                    <thead>
                            <tr class="text-center">
                                <th>Nom & Prénom</th>
                                <th>Téléphonne</th>
                                <th>Adress</th>
                                <th>Montant Total</th>
                                <th>Montant à Payer</th>
                                <th>Montant à Reste</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data as $item)
                                <tr class="text-center">
                                    <td data-label="Nom & Prénom">{{$item->name}}</td>
                                    <td data-label="Téléphonne">{{$item->telephonne}}</td>
                                    <td data-label="Adresse">{{$item->adresse}}</td>
                                    <td data-label="Montant Total"> {{$item->prixCommande}}</td>
                                    <td data-label="Montant à Payer"> {{$item->prixPaiement}}</td>
                                    <td data-label="Montant à Reste" class="{{$item->prixCommande-$item->prixPaiement==0 ?'bg-success':'bg-danger'}}">
                                        {{$item->prixCommande-$item->prixPaiement}}
                                    </td>
                                    <td data-label="Actions" class="d-flex justify-content-center align-items-center">
                                        <form id="{{$item->id_user}}"  action="{{route('admin-paiement.destroy',$item->id_user)}}" method="POST">
                                            @method('DELETE')
                                            @csrf
                                        </form>
                                        <button type="submit" onclick="deleteForm({{$item->id_user}})" class="btn btn-sm btn-danger">
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
@endsection
@section('js')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    $(document).ready(function(){
        $('#mytable').DataTable({
            dom:'Bfrtip',
            buttons:['copy','excel','csv','pdf','print','colvis'],
            "pageLength": 4,

            "language": {
        "sEmptyTable":    "",
        "sInfo":          "Affichage de _START_ à _END_ sur _TOTAL_ entrées ",
        "sSearch":        "Chercher:",
        "oPaginate": {

            "sNext":    "Suivant",
            "sPrevious": "Précedent"
        },

    }
        })
    })
    function deleteForm(id){
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {confirmButton: 'btn btn-success m-2',cancelButton: 'btn btn-danger m-2'},buttonsStyling: false})
                swalWithBootstrapButtons.fire({
                title: 'Es-tu sûr?',
                text: "Vous ne pourrez pas revenir en arrière !",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'OUI, supprimer !',
                cancelButtonText: 'NON, Annuler!',
                reverseButtons: true
                }).then((result) => {
                    $
                if (result.isConfirmed) {
                    document.getElementById(id).submit()
                } else if (

                    result.dismiss === Swal.DismissReason.cancel
                ) {
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
<script>
    Swal.fire({
  position: 'top-end',
  icon: 'success',
  title: "{{session()->get('success')}}",
  showConfirmButton: false,
  timer: 1500
})
</script>
@endif

@endsection
