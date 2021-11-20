<?php


    namespace App\Interfaces;


    use App\Http\Requests\CreateTask;
    use App\Http\Requests\UpdateTask;

    interface TaskInterface
    {
        /**
         * @return array
         */
        public function getTasks(): array;

        /**
         * @param string $id
         * @return null|string
         */
        public function getTask(string $id): ?string;

        /**
         * @param CreateTask $request
         * @return array
         */
        public function createTask(CreateTask $request): array;

        /**
         * @param UpdateTask $request
         * @return array
         */
        public function updateTask(UpdateTask $request): array;

        /**
         * @param $id
         * @return array
         */
        public function deleteTask($id): array;
    }
