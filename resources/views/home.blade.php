<script>
    var baseUrl = '<?php echo url('/'); ?>'
</script>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title> Currency Exchangde</title>
    <meta name="description" content="app for currency exchanging">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="all,follow">
    <script>
        var baseUrl = '<?php echo url('/'); ?>'
    </script>
    <!-- Tweaks for older IEs-->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
</head>

<body>
    <div class="container col-6">
        <div class="currency-container bg-light pb-3 pt-3">
            <div class="row mx-0">
                <div class="col-lg-6 pr-0">
                    <p class="mb-0">I want to buy</p>
                    <input type="number" id="currency-input-amount" class="form-control" placeholder="200">
                </div>

                <div class="col-lg-4  align-items-end pl-0">
                    <p class="mb-0">Select currency</p>
                    <select class="form-select" aria-label="Default select example" id="ddlCurrencies">
                        @foreach ($currencies as $currency)
                            <option value={{ $currency->id }}>{{ $currency->name }} ({{ $currency->short_name }})
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-lg-2 d-flex align-items-end ps-0 ">
                    <button type="calculate" class="btn btn-info  text-white" id="calculate-button">
                        Calculate
                    </button>
                </div>
            </div>
        </div>
        <div class="summary-container bg-light mt-5 p-3" id="currencyDetails" style="display: none">
        </div>

        <div id="emailWrap" class="mt-3 bg-light p-3" style="display:none">
            <p>To finalize your purchase enter you e-mail adress</p>
            <div class="col-6">
                <form onsubmit="submitOrder();return false">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Email address</label>
                        <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                            placeholder="Enter email">
                        <input type="submit" value="Purchase" id="buyBtn" class="btn btn-info text-white d-block mt-2">
                    </div>
                </form>
            </div>
        </div>
        <div id="text-error" class="alert alert-danger" role="alert">
        </div>
        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Successful purchase</h5>
                    </div>
                    <div class="modal-body">
                        Your purchase is successfully completed! :)
                    </div>
                    <div class="modal-footer">
                        <button type="button" id="closeBtn" class="btn btn-info text-white"
                            data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.1/trix.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>
</body>

</html>
