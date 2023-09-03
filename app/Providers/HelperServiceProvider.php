<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Country;
use App\Models\Post;
use App\Models\Sport;
use App\Models\Transaction;
use App\Models\Business;
use App\Models\Status;
use App\Models\Membership;
use App\Models\Notification;
use App\User;
use App\Utils\PermissionHelper;
use Illuminate\Support\Arr;
use Illuminate\Support\ServiceProvider;

class HelperServiceProvider extends ServiceProvider
{
    use PermissionHelper;

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer(['cms.layouts.sidebar'], function ($view) {
            $view->with('menuItems', $this->getMenu());
        });

        view()->composer(['cms.layouts.header'], function ($view) {
            $view->with('notification_number', $this->getCMSNotificationNumber());
        });

        view()->composer(['cms.layouts.app'], function ($view) {
        });

        view()->composer(['cms.business-contract.create'], function ($view) {
        });



        try {
            $company = null;
        } catch (\Exception $e) {
            $company = null;
        }

        view()->composer(['cms.layouts.form.javascript', 'cms.layouts.datatable.javascript', 'cms.layouts.form.elements.file'], function ($view) use ($company) {
            $view->with('company', $company);
        });
    }


    static function selectedBusiness()
    {

        $pending = Status::query()->where('slug', 'pending')->first();

        $businesses = Business::query()
            // ->where(function ($q) {
            //     $q->where('owner_id', auth()->user()->_id)
            //         ->orWhereIn('_id', auth()->user()->relatedBusinesses())
            //         ->orWhere('_id', auth()->user()->business_id);
            // })
            ->where('owner_id', auth()->user()->_id)
            // ->where('status_id', '!=', $pending->_id)
            ->get();

        try {
            session()->put('selected_business', $businesses->first()->_id);
        } catch (\Exception $e) {
        }


        $business = Business::query()->find(session()->get('selected_business'));
        return $business == null ? json_encode(['_id', '-1']) : $business;
    }


    public function getCategories()
    {
        if (auth()->check()) {
            $categories = Category::all();
        }

        return $categories;
    }

    public function getNotificationNumber()
    {
        $v = Business::query()->find(session()->get('selected_business'));

        if ($v != null) {
            $num = Notification::query()
                ->where('read', 0)
                ->where(function ($q) use ($v) {
                    $q->where('to', $v->_id)->orWhere('from', $v->_id);
                })->count();
        } else {
            $num = 0;
        }

        return $num;
    }

    public function getCMSNotificationNumber()
    {
        $num = Notification::query()->where('read', 0)->where(function ($q) {
            $q->where('to', 'admin')->orWhere('from', 'amdin');
        })->count();

        return $num;
    }


    public function getMenu()
    {
        $menu = [
            'dashboard' => [
                'display' => 'Dashboard',
                'class' => '',
                'access_ids' => [1000],
                'icon' => 'fas fa-th-large',
                'allowed_roles' => ['dev', 'admin'],
                'href' => route('dashboard')
            ],

            'setting' => [
                'allow_permission_check' => true, //flag to check permission or not, note if not found, it is true
                'allowed_roles' => ['dev', 'admin'],
                'display' => 'Setting',
                'access_ids' => [1020],
                'icon' => 'fas fa-circle',
                'href' => route('setting.index')
            ],
            'Realestatemanagement' => [
                'allow_permission_check' => true, //flag to check permission or not, note if not found, it is true
                'display' => 'Realestate Management',
                'access_ids' => [],
                'icon' => 'fas fa-cog fa-fw',
                'allowed_roles' => ['dev', 'admin'],
                'submenu' => [
                    'realestate' => [
                        'allow_permission_check' => true, //flag to check permission or not, note if not found, it is true
                        'allowed_roles' => ['dev', 'admin'],
                        'display' => 'Realestate Projects',
                        'access_ids' => [1019],
                        'icon' => '	fas fa-university',
                        'href' => route('realestate.index')
                    ],
                    'project-feature' => [
                        'allow_permission_check' => true, //flag to check permission or not, note if not found, it is true
                        'allowed_roles' => ['dev', 'admin'],
                        'display' => 'Project Features',
                        'access_ids' => [1019],
                        'icon' => '	fas fa-gift',
                        'href' => route('project-feature.index')
                    ],
                    'project-service' => [
                        'allow_permission_check' => true, //flag to check permission or not, note if not found, it is true
                        'allowed_roles' => ['dev', 'admin'],
                        'display' => 'Project Services',
                        'access_ids' => [1019],
                        'icon' => '	fas fa-server',
                        'href' => route('project-service.index')
                    ],
                    'project-guarantee' => [
                        'allow_permission_check' => true, //flag to check permission or not, note if not found, it is true
                        'allowed_roles' => ['dev', 'admin'],
                        'display' => 'Project Guarantee',
                        'access_ids' => [1019],
                        'icon' => '	fas fa-pencil-square-o',
                        'href' => route('project-guarantee.index')
                    ],
                    'project-category' => [
                        'allow_permission_check' => true, //flag to check permission or not, note if not found, it is true
                        'allowed_roles' => ['dev', 'admin'],
                        'display' => 'Project Category',
                        'access_ids' => [1019],
                        'icon' => '	fas fa-clone',
                        'href' => route('project-category.index')
                    ],

                    'sales-status' => [
                        'allow_permission_check' => true, //flag to check permission or not, note if not found, it is true
                        'allowed_roles' => ['dev', 'admin'],
                        'display' => 'Sales Status',
                        'access_ids' => [1019],
                        'icon' => '	fas fa-cog fa-fw',
                        'href' => route('sales-status.index')
                    ],
                    'apartment-status' => [
                        'allow_permission_check' => true, //flag to check permission or not, note if not found, it is true
                        'allowed_roles' => ['dev', 'admin'],
                        'display' => 'Apartment Status',
                        'access_ids' => [1019],
                        'icon' => '	fas fa-cog fa-fw',
                        'href' => route('apartment-status.index')
                    ],
                    'apperance' => [
                        'allow_permission_check' => true, //flag to check permission or not, note if not found, it is true
                        'allowed_roles' => ['dev', 'admin'],
                        'display' => 'Appearance Module',
                        'access_ids' => [1019],
                        'icon' => '	fas fa-cog fa-fw',
                        'href' => route('appearance-module.index')
                    ],
                ]
            ],

            'Businessmanagement' => [
                'allow_permission_check' => true, //flag to check permission or not, note if not found, it is true
                'display' => 'Business Management',
                'access_ids' => [],
                'icon' => 'fas fa-cog fa-fw',
                'allowed_roles' => ['dev', 'admin'],
                'submenu' => [
                    'business-project' => [
                        'allow_permission_check' => true, //flag to check permission or not, note if not found, it is true
                        'allowed_roles' => ['dev', 'admin'],
                        'display' => 'Business Projects',
                        'access_ids' => [1020],
                        'icon' => 'fas fa-circle',
                        'href' => route('business-project.index')
                    ],
                    'business-category' => [
                        'allow_permission_check' => true, //flag to check permission or not, note if not found, it is true
                        'allowed_roles' => ['dev', 'admin'],
                        'display' => 'Business Category',
                        'access_ids' => [1019],
                        'icon' => '	fas fa-clone',
                        'href' => route('business-category.index')
                    ],
                ]
            ],
            'Servicemanagement' => [
                'allow_permission_check' => true, //flag to check permission or not, note if not found, it is true
                'display' => 'Service Management',
                'access_ids' => [],
                'icon' => 'fas fa-cog fa-fw',
                'allowed_roles' => ['dev', 'admin'],
                'submenu' => [
                    'service' => [
                        'allow_permission_check' => true, //flag to check permission or not, note if not found, it is true
                        'allowed_roles' => ['dev', 'admin'],
                        'display' => 'Service',
                        'access_ids' => [1020],
                        'icon' => 'fas fa-circle',
                        'href' => route('service.index')
                    ],
                    'service-category' => [
                        'allow_permission_check' => true, //flag to check permission or not, note if not found, it is true
                        'allowed_roles' => ['dev', 'admin'],
                        'display' => 'Service Category',
                        'access_ids' => [1020],
                        'icon' => 'fas fa-circle',
                        'href' => route('service-category.index')
                    ],
                ]
            ],
            'Aboutmanagement' => [
                'allow_permission_check' => true, //flag to check permission or not, note if not found, it is true
                'display' => 'About Management',
                'access_ids' => [],
                'icon' => 'fas fa-cog fa-fw',
                'allowed_roles' => ['dev', 'admin'],
                'submenu' => [

                    'About' => [
                        'allow_permission_check' => true, //flag to check permission or not, note if not found, it is true
                        'allowed_roles' => ['dev', 'admin'],
                        'display' => 'About',
                        'access_ids' => [1020],
                        'icon' => 'fas fa-circle',
                        'href' => route('about.index')
                    ],
                    'AboutInfo' => [
                        'allow_permission_check' => true, //flag to check permission or not, note if not found, it is true
                        'allowed_roles' => ['dev', 'admin'],
                        'display' => 'About Info',
                        'access_ids' => [1020],
                        'icon' => 'fas fa-circle',
                        'href' => route('about-info.index')
                    ],
                    'OurValue' => [
                        'allow_permission_check' => true, //flag to check permission or not, note if not found, it is true
                        'allowed_roles' => ['dev', 'admin'],
                        'display' => 'Our Value',
                        'access_ids' => [1020],
                        'icon' => 'fas fa-circle',
                        'href' => route('our-value.index')
                    ],
                    'OurGoal' => [
                        'allow_permission_check' => true, //flag to check permission or not, note if not found, it is true
                        'allowed_roles' => ['dev', 'admin'],
                        'display' => 'Our Goal',
                        'access_ids' => [1020],
                        'icon' => 'fas fa-circle',
                        'href' => route('our-goal.index')
                    ],
                ]
            ],
            'Usermanagement' => [
                'allow_permission_check' => true, //flag to check permission or not, note if not found, it is true
                'display' => 'Users Management',
                'access_ids' => [],
                'icon' => 'fas fa-cog fa-fw',
                'allowed_roles' => ['dev', 'admin'],
                'submenu' => [

                    'users' => [
                        'allow_permission_check' => true, //flag to check permission or not, note if not found, it is true
                        'allowed_roles' => ['dev', 'admin'],
                        'display' => 'Users',
                        'access_ids' => [1020],
                        'icon' => 'fas fa-user',
                        'href' => route('user.index')
                    ],
                    'teams' => [
                        'allow_permission_check' => true, //flag to check permission or not, note if not found, it is true
                        'allowed_roles' => ['dev', 'admin'],
                        'display' => 'Teams',
                        'access_ids' => [1020],
                        'icon' => 'fas fa-user',
                        'href' => route('team.index')
                    ],
                    'managers' => [
                        'allow_permission_check' => true, //flag to check permission or not, note if not found, it is true
                        'allowed_roles' => ['dev', 'admin'],
                        'display' => 'Managers',
                        'access_ids' => [1020],
                        'icon' => 'fas fa-user',
                        'href' => route('manager.index')
                    ],
                ]
            ],

            'banners' => [
                'allow_permission_check' => true, //flag to check permission or not, note if not found, it is true
                'allowed_roles' => ['dev', 'admin'],
                'display' => 'Banners',
                'access_ids' => [1020],
                'icon' => 'fas fa-image',
                'href' => route('banner.index')
            ],
            'social-service' => [
                'allow_permission_check' => true, //flag to check permission or not, note if not found, it is true
                'allowed_roles' => ['dev', 'admin'],
                'display' => 'Social Services',
                'access_ids' => [1020],
                'icon' => 'fas fa-image',
                'href' => route('social-service.index')
            ],
            'award' => [
                'allow_permission_check' => true, //flag to check permission or not, note if not found, it is true
                'allowed_roles' => ['dev', 'admin'],
                'display' => 'awards',
                'access_ids' => [1020],
                'icon' => 'fas fa-image',
                'href' => route('award.index')
            ],
            'locations' => [
                'allow_permission_check' => true, //flag to check permission or not, note if not found, it is true
                'allowed_roles' => ['dev', 'admin'],
                'display' => 'Locations',
                'access_ids' => [1020],
                'icon' => 'fas fa-circle',
                'href' => route('location.index')
            ],

            'statuses' => [
                'allow_permission_check' => true, //flag to check permission or not, note if not found, it is true
                'allowed_roles' => ['dev', 'admin'],
                'display' => 'Statuses',
                'access_ids' => [1020],
                'icon' => 'fas fa-circle',
                'href' => route('status.index')
            ],

            'apartment-request' => [
                'allow_permission_check' => true, //flag to check permission or not, note if not found, it is true
                'allowed_roles' => ['dev', 'admin'],
                'display' => 'Apartment Requests',
                'access_ids' => [1020],
                'icon' => 'fas fa-circle',
                'href' => route('apartment-request.index')
            ],
            'villa-request' => [
                'allow_permission_check' => true, //flag to check permission or not, note if not found, it is true
                'allowed_roles' => ['dev', 'admin'],
                'display' => 'Villa Requests',
                'access_ids' => [1020],
                'icon' => 'fas fa-circle',
                'href' => route('villa-request.index')
            ],
            'plot-request' => [
                'allow_permission_check' => true, //flag to check permission or not, note if not found, it is true
                'allowed_roles' => ['dev', 'admin'],
                'display' => 'Plot Requests',
                'access_ids' => [1020],
                'icon' => 'fas fa-circle',
                'href' => route('plot-request.index')
            ],
            'office-request' => [
                'allow_permission_check' => true, //flag to check permission or not, note if not found, it is true
                'allowed_roles' => ['dev', 'admin'],
                'display' => 'Office Requests',
                'access_ids' => [1020],
                'icon' => 'fas fa-circle',
                'href' => route('office-request.index')
            ],
            'contact-request' => [
                'allow_permission_check' => true, //flag to check permission or not, note if not found, it is true
                'allowed_roles' => ['dev', 'admin'],
                'display' => 'Contact Requests',
                'access_ids' => [1020],
                'icon' => 'fas fa-circle',
                'href' => route('contact-request.index')
            ],
            'maintenance-request' => [
                'allow_permission_check' => true, //flag to check permission or not, note if not found, it is true
                'allowed_roles' => ['dev', 'admin'],
                'display' => 'Maintenance Requests',
                'access_ids' => [1020],
                'icon' => 'fas fa-circle',
                'href' => route('maintenance-request.index')
            ],
            'blog' => [
                'allow_permission_check' => true, //flag to check permission or not, note if not found, it is true
                'allowed_roles' => ['dev', 'admin'],
                'display' => 'Blogs',
                'access_ids' => [1020],
                'icon' => 'fas fa-circle',
                'href' => route('blog.index')
            ],


            // 'posts' => [
            //     'allow_permission_check' => true,//flag to check permission or not, note if not found, it is true
            //     'allowed_roles' => ['dev', 'admin'],
            //     'display' => 'Posts',
            //     'access_ids' => [1019],
            //     'icon' => '	fas fa-cog fa-fw',
            //     'href' => route('post.index')
            // ],
        ];

        // ksort($menu['management']['submenu']);
        return $this->drawMenu($menu);
    }


    function drawMenu($menu, $flag_first_time = true)
    {
        static $menu_view = "";

        $menu_view .= !$flag_first_time ? '<ul class="nav child_menu">' : '<ul class="nav side-menu">';

        foreach ($menu as $key => $value) {
            $icon = !isset($value['icon']) ? "" : "<i class='{$value['icon']}'></i>";

            if ($this->grantDraw(request()->permissions, $value['access_ids'], request()->permission_name)) {
                if (Arr::has($value, 'submenu')) {
                    if (!isset($value['submenu'])) {
                        if (Arr::has($value, 'class')) {
                            $menu_view .=
                                "<li class='{$value['class']}'><a href='{$value['href']}'>$icon {$value['display']}</a></li>";
                        } else {
                            $menu_view .=
                                "<li><a href='{$value['href']}'>$icon {$value['display']}</a></li>";
                        }
                    } else {
                        if ($flag_first_time) {
                            $menu_view .=
                                "<li class='" . (Arr::has($value, 'class') ? $value['class'] : "") . "'><a>$icon {$value['display']}<span class='fas fa-chevron-right float-right'></span></a>";
                        } else {
                            $menu_view .=
                                "<li class='" . (Arr::has($value, 'class') ? $value['class'] : "") . "'><a>$icon {$value['display']}<span class='fas fa-plus float-right'></span></a>";
                        }

                        $this->drawMenu($value['submenu'], false);
                        $menu_view .= '</li>';
                    }
                } else {
                    if (Arr::has($value, 'class')) {
                        $menu_view .=
                            "<li class='{$value['class']}'><a href='{$value['href']}'>$icon {$value['display']}</a></li>";
                    } else {
                        $menu_view .=
                            "<li><a href='{$value['href']}'>$icon {$value['display']}</a></li>";
                    }
                }
            }
        }

        $menu_view .= '</ul>';

        return $menu_view;
    }

    private function grantDraw($permissions, $ids, $role_name)
    {
        if (in_array($role_name, ['dev', 'admin', 'business-owner']))
            return true;

        $internalIds = [];

        foreach ($permissions as $key => $value) {
            if (array_key_exists('read', $value))
                $internalIds[] = $key;
        }

        return sizeof(array_intersect($internalIds, $ids)) > 0;
    }
}
