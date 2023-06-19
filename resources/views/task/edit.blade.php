<x-app-layout>

    <x-slot name="header">
        <div class="flex justify-between">
            <div class>
                <a href="{{route('task.index')}}" class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                    Back
                </a>
            </div>

            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Edit To-do
            </h2>
        </div>
    </x-slot>

    <div class="container max-w-xl mx-auto mt-4">
        <form method="POST" action="{{ route('task.update', $task->id) }}">
            @csrf
            @method("PATCH")

            <!-- Tittle -->
            <div>
                <x-input-label for="title" :value="__('Title')" />
                <x-text-input id="title" class="block mt-1 w-full" type="text" name="title" :value="$task->title ?? ''" required autofocus/>
                <x-input-error :messages="$errors->get('title')" class="mt-2" />
            </div>

            <!-- Description -->
            <div class="mt-4">
                <x-input-label for="description" :value="__('Description')" />

                <textarea
                name="description"
                class="w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" required
            >{{ $task->description ?? '' }}</textarea>
                <x-input-error :messages="$errors->get('description')" class="mt-2" />
            </div>

            <div class="mt-4">
                <x-input-label for="due_date" value="Due Date"/>

                <input type="date" name="due_date" id="due_date" value="{{$task->due_date->format('Y-m-d')}}" class="w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                <x-input-error :messages="$errors->get('due_date')" class="mt-2" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-primary-button class="ml-4">
                    Update
                </x-primary-button>
            </div>
        </form>
    </div>
</x-app-layout>
