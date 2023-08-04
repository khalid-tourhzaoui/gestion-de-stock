@extends('adminlte::page')
@section('plugins.Datatables',true)
@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="card my-2 bg-light ">
                <div class="card-header" style="background-color:#008F7A">
                    <div class="text-center">
                        <h3 class="text-white">La liste des livraisons</h3>
                    </div>
                </div>
                <div class="card-body" style="overflow-x:auto;">
                    <table id="mytable" class="table table-bordered table-striped">
                        <thead>
                            <tr class="text-center">
                                <th>ID</th>
                                <th>Nom & Prénom</th>
                                <th>Q.C en (KG)|P.C en (DH)</th>
                                <th>Adresse</th>
                                <th>Date du livraison</th>
                                <th>Etat</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data as $item)
                            <tr class="text-center">
                                <td data-label="ID">{{$item->commande->id_commande}}</td>
                                <td data-label="Nom & Prénom">{{$item->commande->user->name}}</td>
                                <td data-label="Q.C en (KG)|P.C en (DH)">{{$item->commande->quantite_commande. '(KG)'.' | '.$item->commande->prix_commande.' (DH)'}}</td>
                                <td data-label="Adresse">{{$item->adresse}}</td>
                                <td data-label="Date du livraison"> {{$item->date_livraison}} DH</td>
                                <td data-label="Etat" class="{{$item->etat===0 ? 'bg-warning':null}}">{{$item->etat===0 ? 'En cours':null}}</td>
                                <td data-label="Action">
                                    @if (Auth::user()->role=="admin")
                                        <a href="{{route('admin-livraison.edit',$item->id_livraison)}}" class="{{$item->etat==0?'btn btn-primary w-50':'btn btn-secondary w-50 disabled'}}">
                                            <i class="fas fa-check"></i>
                                        </a>
                                    @else
                                        <a href="{{route('livreur-livraison.edit',$item->id_livraison)}}" class="{{$item->etat==0?'btn btn-primary w-50':'btn btn-secondary w-50 disabled'}}">
                                            <i class="fas fa-check"></i>
                                        </a>
                                    @endif
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
