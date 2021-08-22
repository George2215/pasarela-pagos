<label class="block text-gray-500 text-sm font-bold mb-2 mt-3">Detalles de la Tarjeta:</label>

<div class="flex flex-row">
    <div class="w-30 sm:w-auto">
        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" 
            type="text" 
            name="cardNumber" 
            id="paymentForm__cardNumber" />
    </div>
    <div class="w-1/6 ml-3">
        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" 
            type="text" 
            name="cardExpirationMonth" 
            id="paymentForm__cardExpirationMonth" />
    </div>
    <div class="w-1/6 ml-3">
        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" 
            type="text" 
            name="cardExpirationYear" 
            id="paymentForm__cardExpirationYear" />
    </div>
    <div class="w-1/6 ml-3">
        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" 
            type="text" 
            name="securityCode" 
            id="paymentForm__securityCode" />
    </div>
</div>

<div class="flex flex-row mt-3">
    <div class="w-1/3">
        <select class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline"
            name="issuer"
            id="paymentForm__issuer">
        </select>
    </div>
    <div class="w-1/2 ml-3">
        <select class="block appearance-none w-1/2 bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline ml-3" 
            name="installments" 
            id="paymentForm__installments">
        </select>
    </div>
</div>

<div class="flex flex-row mt-3">
    <div class="w-6 sm:w-auto">
        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" 
            type="text" 
            name="cardholderName" 
            id="paymentForm__cardholderName"/>
    </div>
    <div class="w-6 sm:w-auto ml-2">
        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" 
            type="email" 
            name="cardholderEmail" 
            id="paymentForm__cardholderEmail"/>
    </div>
</div>
<div class="flex flex-row mt-3">
    <div class="w-1/2">
        <select class="block appearance-none w-1/2 bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline" 
            name="identificationType" 
            id="paymentForm__identificationType">
        </select>
    </div>
    <div class="w-1/2 ml-2">
        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" 
            type="text" 
            name="identificationNumber" 
            id="paymentForm__identificationNumber"/>
    </div>
</div>
<div class="flex flex-row">
    <div class="col">
        <small class="form-text text-gray-400"  role="alert" >
            Your payment will be converted to {{ strtoupper(config('services.mercadopago.base_currency')) }}
        </small>
    </div>
</div>
<input type="hidden" id="cardNetwork" name="card_network">
<!--<button type="submit" id="paymentForm__submit">Pagar</button>-->
<div class="flex flex-row">
    <div class="col" id="error">
        <ul>
        </ul>
    </div>
</div>

@push('scripts')
<script>
    const mercadoPago = new MercadoPago('{{ config('services.mercadopago.key') }}');
</script>
<script>
    const valorTotal = document.getElementById("value");
    const cardForm = mercadoPago.cardForm({
        amount: valorTotal.value,
        autoMount: true,
        form: {
            id: "paymentForm",
            cardholderName: {
                id: "paymentForm__cardholderName",
                placeholder: "Titular de la tarjeta",
            },
            cardholderEmail: {
                id: "paymentForm__cardholderEmail",
                placeholder: "E-mail",
            },
            cardNumber: {
                id: "paymentForm__cardNumber",
                placeholder: "Número de la tarjeta",
            },
            cardExpirationMonth: {
                id: "paymentForm__cardExpirationMonth",
                placeholder: "MM",
            },
            cardExpirationYear: {
                id: "paymentForm__cardExpirationYear",
                placeholder: "YYYY",
            },
            securityCode: {
                id: "paymentForm__securityCode",
                placeholder: "CVC",
            },
            installments: {
                id: "paymentForm__installments",
                placeholder: "Cuotas",
            },
            identificationType: {
                id: "paymentForm__identificationType",
                placeholder: "Tipo de documento",
            },
            identificationNumber: {
                id: "paymentForm__identificationNumber",
                placeholder: "Número de documento",
            },
            issuer: {
                id: "paymentForm__issuer",
                placeholder: "Franquicia",
            },
        },
        callbacks: {
            onFormMounted: error => {
                if (error) return console.warn("Form Mounted handling error: ", error);
                console.log("Form mounted");
            },
            onCardTokenReceived: (error, token) => {
                if (error) {
                    //console.warn('Token handling error: ', error)
                    let cajaError = document.querySelector('#error');
                    for(let i=0; i<error.length; i++){
                        cajaError.innerHTML += `<li class="text-red-500 list-none mb-3">${error[i].message}</li>`;
                    }
                }
                token
                //console.log('Token available: ', token)
            },
            onSubmit: event => {
                const mercadoPagoForm = document.getElementById("paymentForm");
                if (mercadoPagoForm.elements.payment_platform.value === "{{ $paymentPlatform->id }}") {
                    event.preventDefault();
                    const {
                        paymentMethodId: payment_method_id,
                        issuerId: issuer_id,
                        cardholderEmail: email,
                        amount,
                        token,
                        installments,
                        identificationNumber,
                        identificationType,
                    } = cardForm.getCardFormData();
                    const data = cardForm.getCardFormData();
                    //console.log(data);
                    fetch("/payments/pay", {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/json",
                        },
                        body: JSON.stringify({
                            token,
                            issuer_id,
                            payment_method_id,
                            transaction_amount: Number(amount),
                            installments: Number(installments),
                            description: "Descripción del producto",
                            payer: {
                                email,
                                identification: {
                                    type: identificationType,
                                    number: identificationNumber,
                                },
                            },
                        }),
                    });
                    mercadoPagoForm.submit();
                }
            },
        },
    });
</script>

@endpush