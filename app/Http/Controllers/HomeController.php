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
         * @return \Illuminate\Http\JsonResponse
         */
        public function index(): \Illuminate\Http\JsonResponse
        {
            $tasks = $this->taskService->getTasks();
            return response()->json($tasks);
        }
    }
