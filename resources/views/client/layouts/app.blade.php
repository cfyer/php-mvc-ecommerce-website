<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="/assets/css/front.css">
    <link rel="stylesheet" href="/assets/fonts/icofont/icofont.min.css">
    <title>@yield('title')</title>
</head>

<body>
    @include('client.layouts.header')

    @yield('content')

    @include('client.layouts.footer')

    <script defer src="/assets/js/bootstrap.bundle.min.js"></script>
    <script src="/assets/js/jquery.js"></script>
    <script>
        $(document).ready(function() {
            $('.addCart').click(function() {
                let productId = $(this).attr('data-productId');
                let quantity = $('#quantity').val();
                $.ajax({
                    url: '/cart/add/',
                    method: 'post',
                    data: {
                        id: productId,
                        quantity: quantity
                    },
                    success: function(response) {
                        if (response == 1) {
                            alert('This product aleady exists in cart');
                        } else {
                            alert('Added to cart');
                        }
                    }
                });
            });

            $('.incQty').click(function() {
                let productId = $(this).attr('data-productId');
                $.ajax({
                    url: '/cart/quantity/inc/',
                    method: 'post',
                    data: {
                        id: productId,
                    },
                    success: function(response) {
                        location.reload();
                    }
                });
            });

            $('.decQty').click(function() {
                let productId = $(this).attr('data-productId');
                $.ajax({
                    url: '/cart/quantity/dec/',
                    method: 'post',
                    data: {
                        id: productId,
                    },
                    success: function(response) {
                        location.reload();
                    }
                });
            });

            $('.remove').click(function() {
                let productId = $(this).attr('data-productId');
                $.ajax({
                    url: '/cart/remove/item/',
                    method: 'post',
                    data: {
                        id: productId,
                    },
                    success: function(response) {
                        location.reload();
                    }
                });
            });

            $('#removeAll').click(function() {
                $.ajax({
                    url: '/cart/remove/all/',
                    method: 'post',
                    success: function(response) {
                        location.reload();
                    }
                });
            });
        });
    </script>
</body>

</html>
