<?php


    namespace App\Providers;


    use App\Interfaces\TaskInterface;
    use App\Repositories\TaskRepository;
    use Illuminate\Support\ServiceProvider;

    class RepositoryServiceProvider extends ServiceProvider
    {
        /**
         * Register any application services.
         *
         * @return void
         */
        public function register()
        {
            $this->app->bind(TaskInterface::class, TaskRepository::class);
        }

        /**
         * Bootstrap any application services.
         *
         * @return void
         */
        public function boot()
        {
        }
    }
