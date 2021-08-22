<label class="block text-gray-500 text-sm font-bold mb-2 mt-3">Detalles de la Tarjeta:</label>

<div class="flex flex-row">
    <div class="w-30 sm:w-auto">
        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
            name="payu_card" 
            type="text" 
            placeholder="Número Tarjeta">
    </div>

    <div class="w-1/5 ml-3">
        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" 
            name="payu_cvc" 
            type="text" 
            placeholder="CVC">
    </div>

    <div class="w-1/6 ml-3">
        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" 
            name="payu_month" 
            type="text" 
            placeholder="MM">
    </div>

    <div class="w-1/6 ml-2">
        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
            name="payu_year" 
            type="text" 
            placeholder="YY">
    </div>

    <div class="w-40">
        <select class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline ml-3" name="payu_network">
            <option selected>Seleccionar Franquicia</option>
            <option value="visa">VISA</option>
            <option value="amex">AMEX</option>
            <option value="diners">DINERS</option>
            <option value="mastercard">MASTERCARD</option>
        </select>
    </div>
</div>

<div class="flex flex-row mt-3">
    <div class="w-6 sm:w-auto">
        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" 
            name="payu_name" 
            type="text" 
            placeholder="Your Name">
    </div>
    <div class="w-6 sm:w-auto ml-2">
        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" 
            name="payu_email" 
            type="email" 
            placeholder="email@example.com" >
    </div>
</div>

<div class="flex flex-row">
    <div class="col">
        <small class="form-text text-gray-400"  role="alert" >
            Your payment will be converted to {{ strtoupper(config('services.payu.base_currency')) }}
        </small>
    </div>
</div>