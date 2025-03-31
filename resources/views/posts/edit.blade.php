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
                    <form method="POST" action="{{route('posts.update', $post->id)}}">
                        @method('PATCH')
                        @csrf
                        <textarea name="message"
                        class="block w-full rounded-md border-gray-300 bg-white text-black shadow-sm
                            @error('message')dark:border-red-500 @enderror
                                focus:border-yellow-600 focus:ring focus:ring-indigo-200 focus:ring-opacity-50
                                dark:border-gray-600 dark:bg-black dark:text-white
                                dark:focus:border-indigo-300 datk:focus:ring dark:focus:ring-indigo-200 dark:focus-ring-opacity-50"
                                placeholder="{{__('What\'s do you think?')}}"
                                >{{old('message', $post->message)}}</textarea>
                            {{--<input type="text" value="{{old('nombredelcampo')}}">--}}
                            {{-- Método para ver errores con blade --}}
                            {{-- <div class="mt-3">@error('message'){{$message}} @enderror</div> --}}
                            {{-- Método para ver errores con tailwind --}}
                           <x-input-error :messages="$errors->get('message')"></x-input-error>
                        <x-primary-button class=mt-6>
                            {{__("Save Changes")}}</x-primary-button>
                    </form>
                </div>
            </div>
        {{-- Aui termina el form post --}}
        </div> 
    </div>
</x-app-layout>