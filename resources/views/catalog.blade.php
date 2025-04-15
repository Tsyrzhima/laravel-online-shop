<a href={{ route('profile') }}>Мой профиль</a>
<a href={{ route('cart') }}>Корзина продуктов</a>
<a href="/user-orders">Мои заказы</a>
<h1 style="color: #04AA6D">Товары нашего магазина</h1>

<div class="container">
    @foreach($products as $product)
    <div class="product">
        <img width="200" height="200" src={{$product->image_url}}>
        <h2>{{$product->name}}</h2>
        <p>{{$product->description}}</p>
        <div class="price">₽ {{$product->price}}</div>
        <p> кол-во <span class="product-quantity" data-product-id={{$product->id}}>
                {{$product->getAmountInCart(\Illuminate\Support\Facades\Auth::user())}}
                        </span>
        </p>
        <div class="form-container">
            <form class="add-form" method="POST" onsubmit="return false">
                @csrf
                <input type="hidden" id="product_id" name="product_id" value = {{$product->id}}>
                <input type="hidden" id="amount-add" name="amount" value = 1>
                <button type = "submit" class="button">+</button>
            </form>
            <form class="decrease-form" method="POST" onsubmit="return false">
                @csrf
                <input type="hidden" id="product_id" name="product_id" value = {{$product->id}}>
                <input type="hidden" id="amount-dec" name="amount" value = 1>
                <button type = "submit" class="button">-</button>
            </form>
            <form action="/product/{{$product->id}}" method="GET">
                @csrf
                <button type="submit" class="button">Отзывы</button>
            </form>
        </div>
    </div>
    @endforeach
</div>

<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script>
    $("document").ready(function () {
        $('.add-form').submit(function (e) {
            e.preventDefault();
            var productId = $(this).find('input[name="product_id"]').val();
            $.ajax({
                type: "POST",
                url: "/add-product",
                data: $(this).serialize(),
                dataType: 'json',
                success: function (response) {
                    console.log(response);
                    // Обновляем количество товаров в бейдже корзины
                    //$('.product-quantity').text(response.amount)
                    $('.product-quantity[data-product-id="' + productId + '"]')
                        .text(response.amount)
                },
                error: function(xhr, status, error) {
                    console.error('Ошибка при добавлении товара:', error);
                }
            });
        });
    });
</script>
<script>
    $("document").ready(function () {
        $('.decrease-form').submit(function (e) {
            e.preventDefault();
            var productId = $(this).find('input[name="product_id"]').val();
            $.ajax({
                type: "POST",
                url: "/decrease-product",
                data: $(this).serialize(),
                dataType: 'json',
                success: function (response) {
                    console.log(response);
                    // Обновляем количество товаров в бейдже корзины
                    $('.product-quantity[data-product-id="' + productId + '"]')
                        .text(response.amount)
                },
                error: function(xhr, status, error) {
                    console.error('Ошибка при добавлении товара:', error);
                }
            });
        });
    });
</script>

<style>
    input[type=text], input[type=password] {
        width: 50%;
        padding: 15px;
        margin: 5px 0 22px 0;
        display: inline-block;
        border: none;
        background: #f1f1f1;
    }

    body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f4;
        margin: 0;
        padding: 20px;
    }

    .container {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
    }

    .product {
        background: #fff;
        border: 1px solid #ddd;
        border-radius: 5px;
        padding: 10px;
        margin: 10px;
        width: calc(33% - 40px);
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        transition: transform 0.2s;
    }

    .product:hover {
        transform: translateY(-5px);
    }

    .product img {
        max-width: 100%;
        border-radius: 5px;
    }

    .product h2 {
        font-size: 18px;
        margin: 10px 0;
    }

    .product p {
        color: #666;
    }

    .product .price {
        font-size: 20px;
        color: #04AA6D;
        margin: 10px 0;
    }

    .button {
        background: #04AA6D;
        color: #fff;
        border: none;
        padding: 15px 30px;
        border-radius: 5px;
        cursor: pointer;
        text-align: center;
        text-decoration: none;
    }

    .button:hover {
        background: #04AA6D;
    }
    .form-container {
        display: flex;
        align-items: center; /* Центрирует элементы по вертикали */
    }
    .form-container form {
        margin-right: 10px; /* Отступ между формами */
    }

</style>

