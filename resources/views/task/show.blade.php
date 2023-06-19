<x-app-layout>

        <x-slot name="header">
            <div class="flex justify-between">
                <div>
                    <a href="{{route('task.index')}}" class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                        Back
                    </a>
                </div>

                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                    Preview To-do
                </h2>
            </div>
        </x-slot>


        <div class="py-12 max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="p-6 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg pb-6">
                <div class="flex items-baseline">
                    <div class="text-xl font-bold text-gray-900 dark:text-gray-100">
                        {{ $task->title }}
                    </div>

                    <div class="ml-3 dark:text-gray-400">
                        {{ $task->due_date->format('Y-m-d H:i') }}
                    </div>

                    @if($task->completed)
                    <div class="ml-3 dark:text-green-400 font-bold">
                        Completed
                    </div>
                    @else

                        @if($task->due_date->IsPast())
                        <div class="ml-3 dark:text-gray-400">
                            Expired
                        </div>
                        @else
                        <div class="ml-3 dark:text-cyan-400 font-bold">
                            Active
                        </div>
                        @endif

                    @endif
                </div>

                <div class="pt-2 text-gray-900 dark:text-gray-100">
                    {{ $task->description }}
                </div>

                <div class="flex mt-4">
                    @if($task->completed == false)
                    <div class="mr-3">
                        <form action="{{route('task.update', $task->id)}}" method="post">
                            @method("PATCH")
                            @csrf

                            <input type="hidden" name="completed" value="1">

                            <button type="submit" class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                                Complete
                            </button>
                        </form>
                    </div>

                    <a href="{{route('task.edit', $task->id)}}" class="mr-3 bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                        Edit
                    </a>
                    @endif

                    <div class="mr-3">
                        <form action="{{route('task.delete', $task->id)}}" method="post">
                            @method("DELETE")
                            @csrf

                            <button type="submit" class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                                Delete
                            </button>
                        </form>
                    </div>
                </div>

            </div>
        </div>

</x-app-layout>
