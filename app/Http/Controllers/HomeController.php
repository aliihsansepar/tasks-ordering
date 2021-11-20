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
            $tasks = $this->taskService->getTasks();
            return view('welcome', compact('tasks'));
        }
    }
