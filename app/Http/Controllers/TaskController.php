<?php


    namespace App\Http\Controllers;


    use App\Http\Requests\CreateTask;
    use App\Services\TaskService;
    use Illuminate\Http\Request;

    class TaskController extends Controller
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

        public function create()
        {
            $tasks = $this->taskService->getTasks();
            $countries = json_decode(file_get_contents(storage_path('app/public/countries.json')), 1);
            return view('tasks.create', compact('countries', 'tasks'));
        }

        public function store(CreateTask $request)
        {
            $response = $this->taskService->createTask($request);
            return response()->json($response);
        }

        public function addPrerequisites(Request $request)
        {
            $response = $this->taskService->addPrerequisites($request);
            return response()->json($response);
        }

        public function order()
        {
            return response()->json($this->taskService->orderTasks());
        }
    }
