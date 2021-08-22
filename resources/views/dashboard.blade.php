<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Make a Payment') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-gray-200">
                    <form action="{{ route('pay') }}" method="POST" id="paymentForm">
                        @csrf

                        <div class="grid grid-flow-col auto-cols-max">
                            <div class="w-full max-w-xs">
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="">
                                    Cuanto desea pagar?
                                </label>
                                <input type="number" 
                                    name="value"
                                    id="value"
                                    min="5" 
                                    step="0.01" 
                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                    value="{{ mt_rand(500, 100000) / 100 }}">
                                <small class="form-text text-gray-400">
                                    Usar valores con decimales separados por un "."
                                </small>
                            </div>
                            <div class="w-full max-w-xs ml-5">
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="">
                                    Divisa
                                </label>
                                <select name="currency" 
                                    class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline">
                                    @foreach($currencies as $currency)
                                    <option value="{{ $currency->iso }}">{{ strtoupper($currency->iso) }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="w-full max-w-lg mt-3">
                            <label class="block text-gray-700 text-sm font-bold mb-2">
                                Seleccione la Plataforma de Pago a utilizar
                            </label>
                            <div class="form-group" id="toggler">
                                <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
                                    @foreach ($paymentPlatforms as $paymentPlatform)
                                        <label
                                            class="btn btn-outline-secondary rounded m-2 p-1"
                                            data-bs-target="#{{ $paymentPlatform->name }}Collapse"
                                            data-bs-toggle="collapse"
                                            for="{{ $paymentPlatform->name }}"
                                        >
                                            <input
                                                class="btn-check"
                                                type="radio"
                                                name="payment_platform"
                                                value="{{ $paymentPlatform->id }}"
                                                autocomplete="off"
                                                id="{{ $paymentPlatform->name }}"
                                            >
                                            <img class="img-thumbnail" src="{{ asset($paymentPlatform->image) }}">
                                        </label>
                                    @endforeach
                                </div>
                                @foreach ($paymentPlatforms as $paymentPlatform)
                                <div
                                    id="{{ $paymentPlatform->name }}Collapse"
                                    class="collapse"
                                    data-bs-parent="#toggler"
                                >
                                    @includeIf('components.' . strtolower($paymentPlatform->name) . '-collapse')
                                </div>
                            @endforeach
                        </div>
                        </div>

                        <div class="row">
                            <div class="col-auto">
                                <p class="border-bottom border-primary rounded">

                                </p>
                            </div>
                        </div>


                        <div class="text-center">
                            <button type="submit" 
                                id="payButton" 
                                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Pagar
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
