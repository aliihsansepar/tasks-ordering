<?php


    namespace App\Repositories;


    use App\Http\Requests\CreateTask;
    use App\Http\Requests\UpdateTask;
    use App\Interfaces\TaskInterface;
    use App\Models\Amount;
    use App\Models\Task;
    use Illuminate\Http\JsonResponse;
    use Illuminate\Http\Request;

    class TaskRepository implements TaskInterface
    {
        /**
         * TaskRepository constructor.
         * @param Task $model
         */
        public function __construct(Task $model)
        {
            $this->model = $model;
        }

        public function getTasks(): object
        {
            return $this->model->with('amount')->get();
        }

        /**
         * @param string $id
         * @return string|null
         */
        public function getTask(string $id): ?string
        {
            return $this->model->with('amount')->findOrFail($id);
        }

        /**
         * @param CreateTask $request
         * @return array|null
         */
        public function createTask(CreateTask $request): ?array
        {
            $task = $this->model->create([
                'title' => $request->title,
                'type' => $request->type,
                'prerequisites' => $request->prerequisites,
                'country' => $request->country,
            ]);

            $amount = collect();
            if ($request->has('amount') && !is_null($request->amount)) {
                $amount = Amount::create([
                    "task_id" => $task->id,
                    "currency" => $request->currency,
                    "amount" => $request->amount
                ]);
            }

            if ($task) {
                return ['messsage' => 'Task Created Successfuly', 'status' => 1];
            }
            return ['messsage' => 'Error Occurred', 'status' => 0];
        }

        public function updateTask(UpdateTask $request): ?array
        {
            // TODO: Implement updateTask() method.
        }

        public function deleteTask($id): ?array
        {
            // TODO: Implement deleteTask() method.
        }

        public function addPrerequisites(Request $request): ?array
        {
            $task = Task::find($request->task_id);
            $task->prerequisites = collect($task->prerequisites)->merge($request->prerequisites);
            $task->save();
            return ['messsage' =>  $task->title . ' Prerequisites Added Successfuly', 'status' => 1];
        }
    }
