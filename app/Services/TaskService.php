<?php


    namespace App\Services;


    use App\Interfaces\TaskInterface;

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
            return $this->taskRepository->getTasks();
        }
    }
