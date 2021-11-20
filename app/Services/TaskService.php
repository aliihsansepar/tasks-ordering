<?php


    namespace App\Services;


    use App\Http\Requests\CreateTask;
    use App\Interfaces\TaskInterface;
    use ArrayIterator;

    class TaskService
    {
        /**
         * @var TaskInterface
         */
        private TaskInterface $taskRepository;

        /**
         * TaskService constructor.
         * @param TaskInterface $taskRepository
         */
        public function __construct(TaskInterface $taskRepository)
        {
            $this->taskRepository = $taskRepository;
        }

        /**
         * @return object
         */
        public function getTasks(): object
        {
            $tasks = $this->taskRepository->getTasks();
            return $this->orderTasks($tasks->toArray());
        }


        /**
         * @param $tasks
         * @return array|string
         */
        private function orderTasks($tasks): array
        {
            $completedTasks = [];
            $array_iterator = new ArrayIterator($tasks);
            $error_iterator = 0;

            foreach ($array_iterator as $task) {
                if (empty($task['prerequisites'])) {
                    $completedTasks[$task['id']] = $task;
                } else {
                    foreach ($task['prerequisites'] as $prerequisity) {
                        if (isset($completedTasks[$prerequisity])) {
                            $completedTasks[$task['id']] = $task;
                        } else {
                            $array_iterator[$prerequisity] = $task;
                        }
                    }
                }
                $error_iterator++;
                if ($error_iterator > count($array_iterator)) {
                    $completedTasks[] = ['Please Check Order. The order must be correct for the tasks to begin.'];
                    break;
                }
            }
            dd($completedTasks, 1);
            return $completedTasks;
        }

        /**
         * @param CreateTask $request
         * @return array|null
         */
        public function createTask(CreateTask $request): ?array
        {
            return $this->taskRepository->createTask($request);
        }
    }
