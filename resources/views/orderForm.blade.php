<body>
<div class="container">
    <a href="/cart">Корзина</a>
    <h1>Оформление заказа</h1>
    <form action={{ route('createOrder.submit') }} method="POST">
        @csrf
        <label for="name">Имя:</label>
        @error('contact_name')
            <span style="color: red;">{{ $message }}</span>
        @enderror
        <input type="text" id="contact_name" name="contact_name" required value=
            @if(!old('contact_name'))
            "{{$user->name}}"
            @else
            "{{old('contact_name')}}"
            @endif>
        <label for="address">Адрес доставки:</label>
        @error('address')
        <span style="color: red;">{{ $message }}</span>
        @enderror
        <input type="text" id="address" name="address" required value="{{old('address')}}">
        <label for="phone">Номер телефона:</label>
        @error('contact_phone')
        <span style="color: red;">{{ $message }}</span>
        @enderror
        <input type="tel" id="contact_phone" name="contact_phone" placeholder="+7 (___) ___-__-__" required value="{{old('contact_phone')}}">
        <label for="phone">Комментарий:</label>
        <input type="comment" id="comment" name="comment" value="{{old('comment')}}">
        <div class="container">
            @foreach($userProducts as $userProduct)
                <h2>{{$userProduct->product->name}}</h2>
                <label for="amount">Количество:</label>
                <input type="number" id="amount" name="amount" min="1" value="{{$userProduct->amount}}" required>
                <label for="amount">Стоимость за 1 шт:</label>
                <div class="price">₽ {{$userProduct->product->price}}</div>
                <label for="totalProduct">Итого:</label>
                <div class="price">₽ {{$userProduct->sum()}}</div>
            @endforeach
            <h2><label for="totalOrder">Заказ на сумму:</label></h2>
            <div class="price">₽ {{$total}}</div>
        </div>
        <button type="submit">Оформить заказ</button>
    </form>
</div>
</body>
</html>

<style>
    cssbody {
        font-family: Arial, sans-serif;
        background-color: #f4f4f4;
        margin: 0;
        padding: 20px;
    }

    .container {
        max-width: 600px;
        margin: 0 auto;
        padding: 20px;
        background: #fff;
        border-radius: 5px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }

    h1 {
        text-align: center;
    }

    label {
        display: block;
        margin-bottom: 5px;
    }

    input[type="text"],
    input[type="email"],
    input[type="tel"],
    input[type="amount"],
    input[type="comment"],
    select {
        width: 100%;
        padding: 15px;
        margin: 5px 0 22px 0;
        display: inline-block;
        border: none;
        background: #f1f1f1;
    }

    button {
        background: #04AA6D;
        color: #fff;
        border: none;
        padding: 10px;
        border-radius: 5px;
        cursor: pointer;
    }

    button:hover {
        background: #04AA6D;
    }
</style>

