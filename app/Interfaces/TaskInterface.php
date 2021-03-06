<?php


    namespace App\Interfaces;


    use App\Http\Requests\CreateTask;
    use App\Http\Requests\UpdateTask;
    use Illuminate\Http\JsonResponse;
    use Illuminate\Http\Request;

    interface TaskInterface
    {
        /**
         * @return object
         */
        public function getTasks(): object;

        /**
         * @param string $id
         * @return null|string
         */
        public function getTask(string $id): ?string;

        /**
         * @param CreateTask $request
         * @return array|null
         */
        public function createTask(CreateTask $request): ?array;

        /**
         * @param Request $request
         * @return array|null
         */
        public function addPrerequisites(Request $request): ?array;

        /**
         * @param UpdateTask $request
         * @return array|null
         */
        public function updateTask(UpdateTask $request): ?array;

        /**
         * @param $id
         * @return array|null
         */
        public function deleteTask($id): ?array;
    }
