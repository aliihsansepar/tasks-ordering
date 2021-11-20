<?php


    namespace App\Repositories;


    use App\Models\Task;

    class TaskRepository
    {
        /**
         * TaskRepository constructor.
         * @param Task $model
         */
        public function __construct(Task $model)
        {
            $this->model = $model;
        }

        public function getTasks(): array
        {
            $tasks = $this->model::with('amount')->get();
            
            return $tasks;
        }
    }
