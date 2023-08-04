<?php

namespace App\Providers;
use App\AdminLTE\AccountMenuBuildingEvent;
// use App\Models\Handbook;
use Illuminate\Events\Dispatcher;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;
use JeroenNoten\LaravelAdminLte\Events\BuildingMenu;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(Dispatcher $events)
    {

        app('view')->addNamespace('adminlte', resource_path("views/vendor/adminlte"));
        app('translator')->addNamespace("site", resource_path("lang/vendor/site"));

        // Account menu
        $events->listen(AccountMenuBuildingEvent::class, function (AccountMenuBuildingEvent $event) {
            foreach (config("app.account.navigation") as $item) {
                $event->menu->add($item);
            }
        });

        $events->listen(BuildingMenu::class, function (BuildingMenu $event) {
            if(auth()->user()->role=='admin'){
            $event->menu->add(
                    // ['header' => 'NAVIGATION_PRINCIPALE'],<i class="fa-solid fa-users-gear"></i>
                        [
                        'text' => 'profile',
                        'url'  => '/profile',
                        'icon' => 'fas fa-fw fa-user',
                        ],
                        [
                        'text' => "Tableau de bord",
                        'url'  => 'dashboard/admin',
                        'icon' => 'fas fa-tachometer-alt',
                        ],
                        [
                            'text' => 'Gérer Les utilisateurs',
                            'icon' => 'fas  fa-users',
                            'submenu'=>[
                                [
                                    'text' => 'La liste des utilisateurs',
                                    'url'  => '/admin-utilisateurs',
                                    'icon' => 'fas  fa-list',
                                ],
                                [
                                    'text' => 'Ajouter un utilisateur',
                                    'url'  => 'dashboard/admin/create',
                                    'icon' => 'fas  fa-user-plus',
                                ],
                            ]
                        ],
                        [
                            'text' => 'Gérer les Commandes',
                            'icon' => 'fas fa-shopping-cart',
                            'submenu' => [
                                [
                                    'text'    => 'La liste des Commandes',
                                    'url'     =>'/admin-commande',
                                    'icon'    => 'fas fa-fw fa-list',
                                    // 'icon'    => 'fas fa-solid fa-box-dollar',
                                ],
                                [
                                    'text'    => 'Historique/Commandes',
                                    'url'     =>route("admin-commande.show","historique"),
                                    'icon' => 'fas fa-clock',
                                    // 'icon'    => 'fas fa-solid fa-box-dollar',
                                ],
                            ]
                        ],
                        [
                            'text'    => 'Gérer les Livraison',
                                'icon'    => 'fas fa-fw fa-truck',
                            'submenu' => [
                                [
                                    'text'    => 'La liste des livraisons',
                                    'url'     =>'/admin-livraison',
                                    'icon'    => 'fas fa-fw fa-list',
                                ],
                                [
                                    'text'    => 'Historique des Livraisons',
                                    'url'     =>route('admin-livraison.show','historique'),
                                    'icon'    => 'fas fa-fw fa-list',
                                ],
                                [
                                    'text'    => 'Ajouter une livraison',
                                    'url'     =>'/admin-livraison/create',
                                    //'icon'    => 'fas fa-fw fa-list',
                                    'icon'    => 'fas fa-plus',
                                ],
                            ],
                        ],
                        [
                            'text'    => 'Gérer les paiements',
                                'icon'    => 'fas fa-money-bill',
                            'submenu' => [
                                [
                                    'text'    => 'La liste des livraisons',
                                    'url'     =>'/admin-paiement',
                                    'icon'    => 'fas fa-fw fa-list',
                                ],
                                [
                                    'text'    => 'Ajouter un paiement',
                                    'url'     =>'/admin-paiement/create',
                                    //'icon'    => 'fas fa-fw fa-list',
                                    'icon'    => 'fas fa-dollar-sign',
                                ],
                            ],
                        ],
                        [
                            'text' => 'Gérer Les Réclamations',
                            'url'  => '/admin-reclamation',
                            'icon' => 'fas fa-comment',
                        ],
                        [
                            'text'    => 'Gérer Les Catalogues',
                            'url'     =>'/admin-catalogue',
                            'icon'    => 'fas fa-archive',
                        ],

        );
        }else if(auth()->user()->role=='fournisseur'){
            $event->menu->add(
                // ['header' => 'Navigation Principale'],
                [
                    'text' => 'profile',
                    'url'  => '/profile',
                    'icon' => 'fas fa-fw fa-user',
                ],

                [
                    'text' => "Tableau de bord",
                        'url'  => '/dashboard/fournisseur',
                      'icon' => 'fas fa-tachometer-alt',
               ],

                [
                        'text' => 'La liste des catalogues',
                        'url'  => 'fournisseur/catalogue',
                        'icon' => 'fas fa-list',
                ],
                [
                        'text' => 'Ajouter un catalogue',
                        'url'  => 'fournisseur/catalogue/create',
                        'icon' => 'fas fa-user-plus',
                ],

            );

        }else if(auth()->user()->role=="client"){
            $event->menu->add(
                [
                    'text' => 'profile',
                    'url'  => '/profile',
                    'icon' => 'fas fa-fw fa-user',
                ],
                [
                     'text' => "Tableau de bord",
                     'url'  => '/dashboard/client',
                     'icon' => 'fas fa-fw fa-home',
                ],

                [
                    'text'    => 'La liste des Commandes',
                    'url'     =>'/client/commande',
                    'icon' => 'fas fa-list',
                ],
                [
                    'text'    => 'Historique/Commandes',
                    'url'     =>route("commande.show","historique"),
                    'icon' => 'fas fa-clock',
                ],

                [
                    'text'    => 'Ajouter une Commande',
                    'url'     =>'/client/commande/create',
                    'icon' => 'fas fa-solid fa-cart-plus',
                ],

                [
                    'text'    => 'Liste des Réclamation',
                    'url'     =>'/client/reclamation',
                    'icon' => 'fas fa-list',
                ],
                [
                    'text'    => 'Ajouter une Reclamation',
                    'url'     =>'/client/reclamation/create',
                    'icon' => 'fas fa-comment'
                ],
            );
        }else if(auth()->user()->role=="livreur"){
            $event->menu->add(
                [
                    'text' => 'profile',
                    'url'  => '/profile',
                    'icon' => 'fas fa-fw fa-user',
                ],
                [
                    'text' => "Tableau de bord",
                    'url'  => '/dashboard/livreur',
                    'icon' => 'fas fa-fw fa-home',
               ],
               [
                    'text' => 'La liste des Livraison',
                    'url'  => '/livreur-livraison',
                    'icon' => 'fas fa-fw fa-list',
                ],
               [
                    'text' => "Historique/Livraison",
                    'url'  => route('livreur-livraison.show','historique'),
                    'icon' => 'fas fa-clock',
                ],

            );
        }
        });
    }
}
