<?php

namespace App\Providers;

use App\Models\Topic;
use System\View\Composer;

class HomeServiceProvider extends Provider
{
    public function boot()
    {
        //* app.index => app means app directory in view
        return Composer::view(['app.index', 'app.contact', 'app.article', 'app.articles', 'app.about', 'app.show-contact', 'app.login', 'app.register'], function () {
            $topics = Topic::orderBy('created_at', 'DESC')->get();

            return [
                'topics' => $topics,
            ];
        });
    }
}
