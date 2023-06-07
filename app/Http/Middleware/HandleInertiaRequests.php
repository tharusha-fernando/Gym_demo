<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Inertia\Middleware;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that's loaded on the first page visit.
     *
     * @see https://inertiajs.com/server-side-setup#root-template
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determines the current asset version.
     *
     * @see https://inertiajs.com/asset-versioning
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    public function version(Request $request): ?string
    {
        return parent::version($request);
    }

    /**
     * Defines the props that are shared by default.
     *
     * @see https://inertiajs.com/shared-data
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function share(Request $request): array
    {
        $sharedData = parent::share($request);

        $user = auth()->user();

        $sharedData['flash'] = [
            'message' => session('message'),
            'alert' => session('alert'),
        ];

        if ($user) {
            $sharedData['user'] = [
                'name' => $user->name,
                'email' => $user->email,
                'notifications' => $user->unreadNotifications->sortByDesc('created_at')->take(5),

            ];
            //$sharedData['user'] = [
             //   'notifications' => $user->unreadNotifications,
                //'email' => $user->email,
           // ];
        }

        return $sharedData;
    }
}
