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
            dd($tasks);
            return view('home', compact('tasks'));
        }

    }
