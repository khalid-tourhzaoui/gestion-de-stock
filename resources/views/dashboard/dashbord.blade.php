@extends("adminlte::page")
@section("content")
<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="card my-2 bg-light">
                <div class="card-body">
                    @if (Auth::user()->role=="admin")
                    <!--//////////////////////////////////////////////////--admin--/////////////////////////////////////////////////////////////////////////////////////////////////-->
                    <div class="row">
                        <div class="col-4">
                            <div class="small-box bg-gradient-warning">
                                <div class="inner">
                                    <h3 class="text-white">{{ \App\Models\User::where("role",1)->count()}}</h3>
                                    <p class="text-white">Nombre des clients</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-users text-white"></i>
                                </div>
                                <a href="{{ url('admin-utilisateurs') }}" class="small-box-footer">
                                    Plus d'infos <i class="fas fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div>
                        <!-- /***************************************************************** */ -->
                        <div class="col-4">
                            <div class="small-box bg-gradient-success">
                                <div class="inner">
                                    <h3 class="text-white">{{ \App\Models\User::where("role",2)->count()}}</h3>
                                    <p class="text-white">Nombre des fournisseurs</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-users text-white"></i>
                                </div>
                                <a href="{{ url('admin-utilisateurs') }}" class="small-box-footer">
                                    Plus d'infos <i class="fas fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div>
                        <!-- /***************************************************************** */ -->
                        <div class="col-4">
                            <div class="small-box bg-gradient-info">
                                <div class="inner">
                                    <h3 class="text-white">{{ \App\Models\User::where("role",3)->count()}}</h3>
                                    <p class="text-white">Nombre des livreur</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-users text-white"></i>
                                </div>
                                <a href="{{ url('admin-utilisateurs') }}" class="small-box-footer">
                                    Plus d'infos <i class="fas fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4">
                            <div class="small-box bg-gradient-orange">
                                <div class="inner">
                                    <h3 class="text-white">{{ \App\Models\Catalogue::count()}}</h3>
                                    <p class="text-white">Nombre des catalogues</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-archive text-white"></i>
                                </div>
                                <a href="{{ route('admin-catalogue.index') }}" class="small-box-footer">
                                    Plus d'infos <i class="fas fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div>
                        <!------------------------------------------------------------------------>
                        <div class="col-4">
                            <div class="small-box bg-gradient-danger">
                                <div class="inner">
                                    <h3 class="text-white">{{ \App\Models\Reclamation::count()}}</h3>
                                    <p class="text-white">Nombre des réclamations</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-angry text-white"></i>
                                </div>
                                <a href="{{ route('admin-reclamation.index') }}" class="small-box-footer">
                                    Plus d'infos <i class="fas fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div>
                        <!------------------------------------------------------------------------>
                        <div class="col-4">
                            <div class="small-box bg-gradient-secondary">
                                <div class="inner">
                                    <h3 class="text-white">{{ \App\Models\Commande::where("status",0)->count()}}</h3>
                                    <p class="text-white">Nombre des Commandes</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-shopping-cart text-white"></i>
                                </div>
                                <a href="{{ route('admin-reclamation.index') }}" class="small-box-footer">
                                    Plus d'infos <i class="fas fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <!--///////////////////////////////////////////////////////--client--////////////////////////////////////////////////////////////////////////////////////////////-->
                    @elseif (Auth::user()->role=="client")
                    <div class="row">
                        <div class="col-4">
                            <div class="small-box bg-gradient-danger">
                                <div class="inner">
                                    <h3 class="text-white">{{\App\Models\Reclamation::where("id",Auth::user()->id)->count()}}</h3>
                                    <p class="text-white">Nombre des réclamations</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-exclamation-circle text-white"></i>
                                </div>
                                <a href="{{ route('reclamation.index') }}" class="small-box-footer">
                                    Plus d'infos <i class="fas fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div>
                        <!-- /***************************************************************** */ -->
                        <div class="col-4">
                            <div class="small-box bg-gradient-orange">
                                <div class="inner">
                                    <h3 class="text-white">{{\App\Models\Commande::where("id",Auth::user()->id)->count()}}</h3>
                                    <p class="text-white">Nombre du Commande</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-shopping-cart text-white"></i>
                                </div>
                                <a href="{{route('commande.index')}}" class="small-box-footer">
                                    Plus d'infos <i class="fas fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div>
                        <!-- /***************************************************************** */ -->
                        <div class="col-4">
                            <div class="small-box bg-gradient-info">
                                <div class="inner">
                                    <h3 class="text-white">
                                        @foreach($credits as $credit)
                                            {{$credit->prixCommande-$credit->prixPaiement}}
                                        @endforeach
                                    </h3>
                                    <p class="text-white">Total du Crédit en (DH)</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-solid fa-money-bill text-white"></i>
                                </div>
                                <a href="{{route('commande.index')}}" class="small-box-footer">
                                    Plus d'infos <i class="fas fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <!--///////////////////////////////////////////////////////--fournisseur--////////////////////////////////////////////////////////////////////////////////////////////-->
                    @elseif (Auth::user()->role=="fournisseur")
                    <div class="row">
                        <div class="col-4">
                            <div class="small-box bg-gradient-danger">
                                <div class="inner">
                                    <h3 class="text-white">{{\App\Models\Catalogue::where("id",Auth::user()->id)->count()}}</h3>
                                    <p class="text-white">Nombre des employes</p>
                                </div>
                                <div class="icon">
                                    <i class="fas  fa-boxes text-white"></i>
                                </div>
                                <a href="{{ route('catalogue.index') }}" class="small-box-footer">
                                    Plus d'infos <i class="fas fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div>
                        <!-- /***************************************************************** */ -->
                    </div>
                    <!--///////////////////////////////////////////////////////--fournisseur--////////////////////////////////////////////////////////////////////////////////////////////-->
                    @elseif (Auth::user()->role=="livreur")
                    <div class="row">
                        <div class="col-4">
                            <div class="small-box bg-gradient-orange">
                                <div class="inner">
                                    <h3 class="text-white">{{\App\Models\Livraison::where("id",Auth::user()->id)->where("etat",0)->count()}}</h3>
                                    <p class="text-white">Nombre des colis à livrées</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-box text-white"></i>
                                </div>
                                <a href="{{ route('livreur-livraison.index') }}" class="small-box-footer">
                                    Plus d'infos <i class="fas fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div>
                        <!-- /***************************************************************** */ -->
                        <div class="col-4">
                            <div class="small-box bg-gradient-orange">
                                <div class="inner">
                                    <h3 class="text-white">{{\App\Models\Livraison::where("id",Auth::user()->id)->where('etat',1)->count()}}</h3>
                                    <p class="text-white">Nombre des colis à l'historique</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-solid fa-boxes text-white"></i>
                                </div>
                                <a href="{{ route('livreur-livraison.show','historique') }}" class="small-box-footer">
                                    Plus d'infos <i class="fas fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
