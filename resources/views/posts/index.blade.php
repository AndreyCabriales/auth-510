<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Posts') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            {{-- Aqui empieza el form post --}}
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">          
                    <form method="POST" action="{{route('posts.store')}}">
                        @csrf
                        <textarea name="message"
                        class="block w-full rounded-md border-gray-300 bg-white text-black shadow-sm
                            @error('message')dark:border-red-500 @enderror
                                focus:border-yellow-600 focus:ring focus:ring-indigo-200 focus:ring-opacity-50
                                dark:border-gray-600 dark:bg-black dark:text-white
                                dark:focus:border-indigo-300 datk:focus:ring dark:focus:ring-indigo-200 dark:focus-ring-opacity-50"
                                placeholder="{{__('What\'s do you think?')}}">{{old('message')}}
                            </textarea>
                            {{--<input type="text" value="{{old('nombredelcampo')}}">--}}
                            {{-- Método para ver errores con blade --}}
                            {{-- <div class="mt-3">@error('message'){{$message}} @enderror</div> --}}
                            {{-- Método para ver errores con tailwind --}}
                           <x-input-error :messages="$errors->get('message')"></x-input-error>
                        <x-primary-button class=mt-6>
                            <span>
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M7.5 8.25h9m-9 3H12m-9.75 1.51c0 1.6 1.123 2.994 2.707 3.227 1.129.166 2.27.293 3.423.379.35.026.67.21.865.501L12 21l2.755-4.133a1.14 1.14 0 0 1 .865-.501 48.172 48.172 0 0 0 3.423-.379c1.584-.233 2.707-1.626 2.707-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0 0 12 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v6.018Z" />
                                  </svg>
                            </span>
                            {{__("posting")}}</x-primary-button>
                    </form>
                </div>
            </div>
        </div>
        {{-- Aui termina el form post --}}
        @foreach ($posts as $post)
            

        <div class="mt-6 bg-white dark:bg-gray-800 shadow-sm rounded-lg divide-y dark:divide-gray-900">
            <div class="p-6 flex space-x-2">
                <svg class="h-6 w-6 text-gray-600 dark:text-gray-400 -scale-x-100" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M7.5 8.25h9m-9 3H12m-9.75 1.51c0 1.6 1.123 2.994 2.707 3.227 1.129.166 2.27.293 3.423.379.35.026.67.21.865.501L12 21l2.755-4.133a1.14 1.14 0 0 1 .865-.501 48.172 48.172 0 0 0 3.423-.379c1.584-.233 2.707-1.626 2.707-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0 0 12 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v6.018Z" />
                </svg>
                <div class="flex-1">
                    <div class="flex justify-between items-center">
                        <div>
                            <span class="text-gray-800 dark:text-gray-200">
                                {{$post->user->name}}
                            </span>
                            <small class="ml-2 text-sm text-gray-600 dark:text-gray-400">
                                {{-- {{$post->created_at->diffForHumans()}} --}}
                                {{$post->created_at->format('d M Y h:i a')}}
                            </small>
                            {{-- Utilizando operadores comparativo --}}
                            {{-- @if($post->created_at != $post->updated_at)
                                <small class="ml-2 text-sm text-gray-600 dark:text-gray-400">
                                    &middot; {{__('Edited')}}
                                </small>
                            @endif --}}
                             {{-- Utilizando operadores de control comparativo --}}
                             @unless($post->created_at->eq($post->updated_at))
                             <small class="ml-2 text-sm text-gray-600 dark:text-gray-400">
                                 &middot; {{__('Edited')}}
                             </small>
                         @endunless                               
                        </div>
                    </div>
                    <p class="mt-4 text-lg text-gray-900 drak:text-gray-100">
                        {{$post->message}}
                    </p>
                </div>
                {{--@if ($post->user_id == auth()->id())--}}
                @can('update', $post)
                <x-dropdown>
                    <x-slot name="trigger">
                        <button>
                            <svg class="w-8 h-5 text-gray-300 bg-gray-600 rounded-md dark:text-gray-200 dark:hover:bg-gray-500 dark:rounded-md" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 12a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0ZM12.75 12a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0ZM18.75 12a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z" />
                            </svg>
                        </button>
                    </x-slot>
                    <x-slot name="content">
                        <x-dropdown-link :href="route('posts.edit', $post->id)">{{__('Edit')}}</x-dropdown-link>
                        {{-- Esto es eliminar Directamente --}}
                        {{-- <form action="{{route('posts.destroy', $post->id)}}" method="POST">
                            @csrf
                            @method('DELETE')
                            <x-dropdown-link :href="route('posts.destroy', $post->id)" onclick="event.preventDefault(); this.closest('form').submit();">
                                {{__('Delete')}}
                            </x-dropdown-link>
                        </form> --}}
                        <div x-data="{showConfirm: false}">
                            <form id="delete-post-form-{{$post->id}}" action="{{route('posts.destroy', $post)}}" method="POST">
                                @csrf
                                @method('DELETE')

                                {{-- Crear el boton para abrir el modal --}}
                                <x-dropdown-link href="#" x-on:click.stop.prevent="showConfirm = true">
                                    {{__('Delete')}}
                                </x-dropdown-link>
                            </form>  
                                {{-- Diseño del modal de confirmaciòn --}}
                                <div x-show="showConfirm" x-cloak class="fixed inset-0 flex items-center justify-center bg-black/50 p-4" x-on:click="showConfirm = false">
                                    <div class="bg-white dark:bg-gray-800 p-6 rounded-lg w-80">
                                        {{-- Contenido del Modal --}}
                                        <h2 class="text-lg font-semibold text-gray-900 dark:text-gray-100">
                                            {{__('Are you sure you want to delete this posts?')}}
                                        </h2>
                                        <p class="text-gray-600 dark:text-gray-300 mt-2 text-sm">
                                            {{__('This action cannot be undone!')}}
                                        </p>
                                        {{-- Botones de Confirmacion y Cancelacion --}}
                                        <div class="mt-4 flex justify-end space-x-2">
                                            <button x-on:click="showConfirm = false"
                                                class="px-4 py-2 rounded dark:rounded-md bg-gray-300 dark:bg-gray-700 dark:text-gray-200 hover:bg-gray-400 dark:hover:bg-gray-600">
                                                {{__('No, keep it!')}}
                                            </button>

                                            <Button x-on:click="document.getElementById('delete-post-form-{{$post->id}}').submit()"
                                                class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">
                                                {{__('Yes, delete it!')}}
                                            </Button>
                                        </div>
                                    </div>
                                </div>
                        </div>
                    </x-slot>
                </x-dropdown>
                @endcan
                {{-- @sendif --}}
            </div>
        </div> 
    </div>
    @endforeach
     {{-- Aqui termina los posts --}}
</x-app-layout>