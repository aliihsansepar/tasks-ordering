<?php

    namespace App\Http\Controllers;

    use App\Services\TaskService;

    class HomeController extends Controller
    {
        /**
         * @var TaskService
         */
        private TaskService $taskService;

        /**
         * HomeController constructor.
         * @param TaskService $taskService
         */
        public function __construct(TaskService $taskService)
        {
            $this->taskService = $taskService;
        }

        /**
         * @param null
         * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
         */
        public function index()
        {
            $tasksForSelect = [];
            $tasks = $this->taskService->getTasks();
            if (!isset($tasks['status'])) {
                foreach ($tasks as $task) {
                    $tasksForSelect[] = [
                        'id' => $task['id'],
                        'text' => $task['title'],
                    ];
                }
            }else {
                $tasks = $tasks['message'];
            }

            return view('home', compact('tasks', 'tasksForSelect'));
        }
        public function getTasksJson()
        {
            $tasks = $this->taskService->getTasks();
            $tasksForSelect = [];
            foreach ($tasks as $task) {
                $tasksForSelect[$task['id']] = $task['title'];
            }
            return response()->json(['tasks' => $tasksForSelect]);
        }

    }
