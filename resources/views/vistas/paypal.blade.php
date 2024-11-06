<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pago con PayPal</title>
    <script src="https://www.paypal.com/sdk/js?client-id=Ads-LChTmvJJE2Qd13s1dLAQ4RwvP5YoTHYjcrMpS2kyhG0HLlmO-DwNA8ExOI3z5LkvowuQ4sDqGSvc"></script>
</head>
<body>
    <div id="paypal-button-container"></div>
    <script>
        paypal.Buttons({
            style: {
                color: 'blue',
                shape: 'pill',
                label: 'pay'
            },
            createOrder: function(data, actions) {
                return actions.order.create({
                    purchase_units: [{
                        amount: {
                            value: '{{ $total }}'
                        }
                    }]
                });
            }
        }).render('#paypal-button-container');
    </script>
</body>
</html>
