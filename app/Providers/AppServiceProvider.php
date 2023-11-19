<?php

namespace App\Providers;

use App\Models\Group;
use App\Models\Program;
use App\Models\Question;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
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
        
        view()->composer('Admins.adminsidenav', function($view){
            $programs = Program::all();
            $groups = Group::all();
            $question = Question::all();
            $view->with(['AllPrograms' => $programs, 'AllGroups' => $groups , 'AllQuestions' => $question]);
        });
    }    
}

