<div>

    <div class="p-6 bg-gray-100 dark:bg-gray-700 text-black dark:text-white ">
        {{-- In work, do what you enjoy. --}}

        <div class="flex items-center justify-end px-4 py-3 text-right sm:px-6">
            <x-jet-button class="ml-4" wire:click="createShowModal">
                {{ __('Create') }}
            </x-jet-button>
        </div>


        <div class="overflow-x-auto relative shadow-md sm:rounded-lg">
            <div class="container">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="py-3 px-6">
                                Title
                            </th>
                            <th scope="col" class="py-3 px-6">
                                Link
                            </th>
                            <th scope="col" class="py-3 px-6">
                                Content
                            </th>
                            <th scope="col" class="py-3 px-6">

                            </th>

                        </tr>
                    </thead>
                    <tbody>
                        @if ($data->count() )
                            @foreach ($data as $item)
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">

                                    <td class="py-4 px-6">
                                        {{ $item->title }}
                                    </td>
                                    <td class="py-4 px-6">
                                        <a
                                        class="no-underline hover:underline"
                                        target="_blank"
                                        href="{{ URL::to('/'.$item->slug)}}">
                                        {{$item->slug}}</a>
                                    </td>
                                    <td class="py-4 px-6">
                                        {{$item->content}}
                                    </td>
                                    <td class="py-4 px-6 flex justify-center">
                                        <x-jet-button class="ml-4" wire:click="updateShowModal({{ $item->id }})">
                                            {{ __('Update') }}
                                        </x-jet-button>
                                        <x-jet-danger-button class="ml-4" wire:click="createShowModal">
                                            {{ __('Delete') }}
                                        </x-jet-button>
                                    </td>

                                </tr>
                            @endforeach


                        @else
                            <tr>
                                <td  class="py-4 px-6"> No Record</td>
                            </tr>

                        @endif

                    </tbody>

                </table>
            </div>

        </div>
        <br>
        {{ $data->links() }}

        <div class="flex items-center justify-end px-4 py-3 sm:px-6 max-w-24">

            <x-jet-dialog-modal wire:model="modalFormVisible">


                <x-slot name="title">
                    @if ($errors->any())
                        <div class="">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li style="color: red">{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    {{ __('Save Page') }} {{ $modelId }}
                </x-slot>

                <x-slot name="content">
                    <div class="mt-4">
                        <x-jet-label for="title" value="{{ __('Title') }}" />
                        <x-jet-input id="title"  class="block mt-1 w-full" type="text" wire:model.debounce.800ms='title' />
                    </div>


                    <div class="mt-4">
                        <x-jet-label for="title" value="{{ __('Slug') }}" />
                        <div class="flex">
                            <span class="inline-flex items-center px-3 text-sm text-gray-900 bg-gray-200 rounded-l-md border border-r-0 border-gray-300 dark:bg-gray-600 dark:text-gray-400 dark:border-gray-600">
                            http://localhost:8000/
                            </span>
                            <input wire:model='slug' type="text" id="website-admin" class="rounded-none rounded-r-lg bg-gray-50 border text-gray-900 focus:ring-blue-500 focus:border-blue-500 block flex-1 min-w-0 w-full text-sm border-gray-300 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="">

                        </div>
                    </div>

                    <div class="mt-4">
                        <x-jet-label for="title" value="{{ __('Content') }}" />
                        <div class="rounded-md shadow-sm">
                            <div class="mt-1 bg-white">
                                <div class="body-content" wire:ignore>
                                    <trix-editor
                                        class="trix-content"
                                        x-ref="trix"
                                        wire:model.debounce.100000ms="content"
                                        wire:key="trix-content-unique-key"
                                    ></trix-editor>
                                </div>
                            </div>
                        </div>
                </x-slot>

                <x-slot name="footer">
                    <x-jet-secondary-button wire:click="$toggle('modalFormVisible')" wire:loading.attr="disabled">
                        {{ __('never mind') }}
                    </x-jet-secondary-button>

                    @if ($modelId)
                        <x-jet-button class="ml-3" wire:click="update" wire:loading.attr="disabled">
                            {{ __('Update ') }}
                        </x-jet-button>
                    @else
                        <x-jet-button class="ml-3" wire:click="create" wire:loading.attr="disabled">
                            {{ __('Save ') }}
                        </x-jet-button>
                    @endif



                </x-slot>
            </x-jet-dialog-modal>
        </div>

    </div>

</div>
