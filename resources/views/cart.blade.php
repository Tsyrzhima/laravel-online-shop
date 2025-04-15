<form action="/cart" method="post">
    @csrf
    <a href="/catalog">Каталог продуктов</a>
    <h1 style="color: #04AA6D">Моя корзина</h1>
    <div class="container">
        @foreach($userProducts as $userProduct)
        <div class="product">
            <img width="200" height="200" src={{$userProduct->product->image_url}}>
            <h2>{{$userProduct->product->name}}</h2>
            <p>{{$userProduct->product->description}}</p>
            <p>{{$userProduct->amount}} шт </p>
            <div class="price">₽ {{$userProduct->product->price}}</div>
            <a href="#" class="button">Удалить</a>
        </div>
        @endforeach
    </div>
    <a href="/create-order" methods="GET" class="button">Оформить заказ</a>
</form>

<style>
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
        padding: 20px;
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
        padding: 10px 15px;
        border-radius: 5px;
        cursor: pointer;
        text-align: center;
        text-decoration: none;
    }

    .button:hover {
        background: #04AA6D;
    }
</style>

