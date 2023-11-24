<div>
    <div class="px-4 sm:px-6 lg:px-8 py-5">
        <div class="sm:flex justify-between sm:items-center">
            <div class="sm:flex-auto">
                <h1 class="text-base font-semibold leading-6 text-gray-900">Emails</h1>
                <p class="mt-2 text-sm text-gray-700">A list of all the emails in your account send through connected services.</p>
            </div>
            <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none gap-x-3 flex">
                <x-secondary-button wire:click="openSendEmail = true">
                    Send Email
                </x-secondary-button>

                <button type="button" wire:click="syncEmail" wire:loading.attr="disabled" wire:loading.class="bg-gray-300" class="inline-flex items-center px-4 py-2 bg-indigo-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                    Sync Emails
                </button>
            </div>
        </div>
        <div class="mt-8 flow-root">
            <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="inline-block w-full py-2 align-middle sm:px-6 lg:px-8">
                    <table class="w-full divide-y divide-gray-300">
                        <thead>
                            <tr class="divide-x divide-gray-200">
                                <th scope="col" class="py-3.5 uppercase text-center text-sm font-semibold text-gray-900">No.</th>
                                <th scope="col" class="py-3.5 uppercase px-4 text-left text-sm font-semibold text-gray-900">Subject</th>
                                <th scope="col" class="px-4 py-3.5 uppercase text-left text-sm font-semibold text-gray-900">From</th>
                                <th scope="col" class="px-4 py-3.5 uppercase text-left text-sm font-semibold text-gray-900">To</th>
                                <th scope="col" class="px-4 py-3.5 uppercase text-right text-sm font-semibold text-gray-900">Sent At</th>
                                <th scope="col" class="py-3.5 uppercase pl-4 pr-4 text-left text-sm font-semibold text-gray-900 sm:pr-0"></th>

                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 bg-white">
                            @forelse($emails as $i => $email)
                            <tr class="divide-x divide-gray-200">
                                <td class="whitespace-nowrap py-4 text-sm font-medium text-gray-900">{{ ++$i }}</td>
                                <td class="whitespace-nowrap py-4 pl-4 pr-4 text-sm font-medium text-gray-900">{{ $email->subject }}</td>
                                <td class="whitespace-nowrap p-4 text-sm text-gray-500">
                                    <div class="flex flex-col text-xs">
                                        <b>{{ $email->from['name'] ?? '-' }}</b>
                                        <span>{{ $email->from['address'] ?? '-' }}</span>
                                    </div>
                                </td>
                                <td class="whitespace-nowrap p-4 text-sm text-gray-500">
                                    <div class="flex flex-col justify-start items-start gap-2 text-xs">
                                        @foreach($email->to as $to)
                                        <span class="inline-flex items-center rounded-md bg-gray-50 hover:bg-gray-100 px-2 py-1 text-xs font-medium text-gray-600 ring-1 ring-inset ring-gray-500/10">{{ $to['emailAddress']['address'] ?? '-' }}</span>
                                        @endforeach
                                    </div>
                                </td>
                                <td class="whitespace-nowrap py-4 pl-4 pr-4 text-sm text-gray-500 sm:pr-0">
                                    {{ $email->sent_at->format('Y-m-d h:i A') }}
                                </td>
                                <td align="center" class="whitespace-nowrap py-4 pl-4 pr-4 text-sm text-gray-500 sm:pr-0">
                                    <a target="_blank" href="{{ $email->web_link }}">View Email</a>
                                </td>
                            </tr>
                            @empty
                            <tr class="divide-x divide-gray-200">
                                <td colspan="7" align="center" class="whitespace-nowrap p-4 text-sm text-gray-500">No data found</td>
                            </tr>
                            @endif

                            <!-- More people... -->
                        </tbody>
                    </table>

                    <div class="mt-8">
                        {!! $emails->links() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>


    <x-dialog-modal wire:model.live="openSendEmail">
        <x-slot name="title">
            {{ __('Send Email ') }}
        </x-slot>

        <x-slot name="content">
            <div class="my-5">
                <x-input type="email" class="mt-1 block w-full" placeholder="{{ __('To Email') }}" wire:model="email" />
                <x-input-error for="email" class="mt-2" />
            </div>

            <div class="mb-5">
                <x-input type="text" class="mt-1 block w-full" placeholder="{{ __('Subject') }}" wire:model="subject" />
                <x-input-error for="subject" class="mt-2" />
            </div>

            <div>
                <textarea class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" placeholder="{{ __('Message') }}" wire:model="message" rows="5"></textarea>
                <x-input-error for="message" class="mt-2" />
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-secondary-button wire:click="$toggle('openSendEmail')" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-secondary-button>

            <x-button type="button" class="ms-3" wire:click="sendEmailNow" wire:loading.class="bg-gray-300" wire:loading.attr="disabled">
                {{ __('Send Now') }}
            </x-button>
        </x-slot>
    </x-dialog-modal>
</div>