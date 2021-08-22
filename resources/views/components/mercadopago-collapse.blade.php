<label class="block text-gray-500 text-sm font-bold mb-2 mt-3">Detalles de la Tarjeta:</label>

<div class="flex flex-row">
    <div class="w-30 sm:w-auto">
        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" 
            type="text" 
            id="cardNumber"
            data-checkout="cardNumber"
            placeholder="Número Tarjeta">
    </div>

    <div class="w-1/5 ml-3">
        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="text" data-checkout="securityCode" placeholder="CVC">
    </div>

    <div class="w-1/6 ml-3">
        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="text" data-checkout="cardExpirationMonth" placeholder="MM">
    </div>

    <div class="w-1/6 ml-2">
        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="text" data-checkout="cardExpirationYear" placeholder="YY">
    </div>
</div>

<div class="flex flex-row mt-3">
    <div class="w-6 sm:w-auto">
        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="text" data-checkout="cardholderName" placeholder="Nombre Completo">
    </div>
    <div class="w-6 sm:w-auto ml-2">
        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="email" data-checkout="cardholderEmail" placeholder="email@example.com" name="email">
    </div>
</div>


<div class="flex flex-row mt-3">
    <div class="w-32">
        <select 
        class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline" 
        data-checkout="docType"></select>
    </div>
    <div class="ml-3">
        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="text" data-checkout="docNumber" placeholder="Documento">
    </div>
</div>

<div class="flex flex-row">
    <div class="col">
        <small class="form-text text-gray-400"  role="alert" >
            Your payment will be converted to {{ strtoupper(config('services.mercadopago.base_currency')) }}
        </small>
    </div>
</div>

<div class="flex flex-row">
    <div class="col">
        <small class="form-text text-red-400" id="paymentErrors" role="alert"></small>
    </div>
</div>

<input type="hidden" id="cardNetwork" name="card_network">
<input type="hidden" id="cardToken" name="card_token">


@push('scripts')
<script>
    const mercadoPago = window.Mercadopago;
    mercadoPago.setPublishableKey('{{ config('services.mercadopago.key') }}');
    mercadoPago.getIdentificationTypes();
</script>

<script>
    function setCardNetwork()
    {
        const cardNumber = document.getElementById("cardNumber");
        mercadoPago.getPaymentMethod(
            { "bin": cardNumber.value.substring(0,6) },
            function(status, response) {
                const cardNetwork = document.getElementById("cardNetwork");
                cardNetwork.value = response[0].id;
                //console.log(response);
            }
        );
    }
</script>

<script>
    const mercadoPagoForm = document.getElementById("paymentForm");
    mercadoPagoForm.addEventListener('submit', function(e) {
        if (mercadoPagoForm.elements.payment_platform.value === "{{ $paymentPlatform->id }}") {
            e.preventDefault();
            mercadoPago.createToken(mercadoPagoForm, function(status, response) {
                if (status != 200 && status != 201) {
                    const errors = document.getElementById("paymentErrors");
                    errors.textContent = response.cause[0].description;
                } else {
                    const cardToken = document.getElementById("cardToken");
                    setCardNetwork();
                    cardToken.value = response.id;
                    mercadoPagoForm.submit();
                }
            });
        }
    });
</script>
@endpush