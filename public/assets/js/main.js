$(document).ready(function () {
    document.getElementById("text-error").style.display = 'none'
    $(document).on('click', '#calculate-button', function (e) {
        e.preventDefault();
        amount = $("#currency-input-amount").val();
        if ($("#currency-input-amount").val()) {
            document.getElementById("text-error").innerHTML = "";
            document.getElementById("text-error").style.display = 'none'
            calculateCurrencyAmountAjax($('#ddlCurrencies').val(), amount);
        } else {
            document.getElementById("text-error").style.display = 'block'
            document.getElementById("text-error").innerHTML = "Currency amount must be entered";
        }
    });
});
function submitOrder(){
    console.log('aaaa');
    amount = $("#currency-input-amount").val();
    currency_id = $('#ddlCurrencies').val();
    email = $("#exampleInputEmail1").val();
    if ($("#currency-input-amount").val() && $("#exampleInputEmail1").val()) {
        document.getElementById("text-error").innerHTML = "";
        document.getElementById("text-error").style.display = 'none'
        createOrderAjax(amount, email, currency_id);
    } else {
        document.getElementById("text-error").style.display = 'block'
        document.getElementById("text-error").innerHTML = "All data must be entered";
    }
}

function calculateCurrencyAmountAjax(currency_id, amount) {
    $.ajax({
        url: baseUrl + "/api/v1/app/currency_data_info/" + currency_id,
        method: "GET",
        success: function (responese) {
            showCalculationDetails(responese.data, amount);
        }, error: function (xhr, error) {
            console.log(xhr);
        }
    })
}

function showCalculationDetails(data, amount) {
    foreign_currency_amount = amount * data.currency_exchange_rate;
    currency_surcharge_amount = (data.currency_surcharge / 100) * foreign_currency_amount;
    foreign_currency_amount_purchased = foreign_currency_amount - currency_surcharge_amount;
    currency_discount_amount = (data.currency_discount / 100) * foreign_currency_amount_purchased;
    foreign_currency_amount_purchased += currency_discount_amount;

    let content = "";
    content += `<p>You get ${foreign_currency_amount_purchased.toFixed(2)} ${data.currency} for ${amount} USD</p>
        <hr/>
      <div class="p-3">
        <div class="row justify-content-between">
            <div class="col-6">
                <p>Currency exchange rate amount</p>
            </div>
            <div class="col-6 text-end">
                <p>${data.currency_exchange_rate}</p>
            </div>
        </div>

        <div class="row justify-content-between">
            <div class="col-6">
                <p>Currency surcharges amount</p>
            </div>
            <div class='col-6 text-end'>
                <p>${currency_surcharge_amount.toFixed(2)} ${data.currency}</p>
            </div>
        </div>
        <div class="row justify-content-between">
            <div class="col-6">
                <p>Currency discount</p>
            </div>
            <div class="col-6 text-end">
                <p>${data.currency_discount}%</p>
            </div>
        </div>
      </div>`;

    document.getElementById("currencyDetails").style.display = 'block';
    document.getElementById("currencyDetails").innerHTML = content;
    document.getElementById("emailWrap").style.display = 'block';
}

function createOrderAjax(amount, email, currency_id) {
    console.log(amount, email, currency_id);
    $.ajax({
        url:baseUrl+"/api/v1/app/order",
        method:"POST",
        data:{
            amount:amount,
            currency_id:currency_id,
            email:email
        },success:function(responese){
            console.log(responese.data);
            console.log('aha');
            $("#exampleModal").modal('show');
        },error:function(xhr,error){
            console.log(xhr);
        }

    })
}

let closeModalBtn =  document.getElementById("closeBtn");
closeModalBtn.addEventListener('click', function(){
   location.reload(); 
});