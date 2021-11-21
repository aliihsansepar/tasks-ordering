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
         * @return array
         */
        public function getTasks(): array
        {
            $tasks = $this->taskRepository->getTasks();
            return $this->orderTasks($tasks->toArray());
        }

        /**
         * @param array $tasks
         * @return array|string
         */
        private function orderTasks(array $tasks): array
        {
            $completedTasks = [];
            $array_iterator = new ArrayIterator($tasks);
            $error_iterator = 0;
            $counter = count($tasks);

            // Ordered task
            foreach ($array_iterator as $task) {
                if (empty($task['prerequisites'])) {
                    $completedTasks[] = $task['id'];
                } else {
                    $isExist = $this->in_array_all($task['prerequisites'], $completedTasks);
                    if ($isExist) {
                        $completedTasks[] = $task['id'];
                    } else {
                        $array_iterator[$counter++] = $task;
                    }
                }
                $error_iterator++;
                if ($error_iterator > (count($tasks) * 2)) {
                    $completedTasks = 'Please Check Order. The order must be correct for the tasks to begin.';
                    break;
                }
            }

            if (is_array($completedTasks)) {
                $orederedTasks = [];
                $collectTasks = collect($tasks);
                foreach ($completedTasks as $completedTask) {
                    $orederedTasks[] = $collectTasks->where('id', $completedTask)->first();
                }
                $completedTasks = $orederedTasks;
            } elseif (is_string($completedTasks)) {
                $completedTasks = [
                    'message' => $completedTasks,
                    'status' => 'error',
                ];
            }

            return $completedTasks;
        }

        /**
         * Check if ALL needles exist
         * @param array $needles
         * @param array $haystack
         * @return bool
         */
        private function in_array_all(array $needles, array $haystack)
        {
            return empty(array_diff($needles, $haystack));
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
