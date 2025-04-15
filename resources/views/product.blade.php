<form action="/add-review" method="post">
    <div class="container">
        <a href="/catalog" class="back-link">Вернуться в каталог</a>

        <div class="product">
            <img width="200" height="200" src={{$product->image_url}} alt={{$product->name}} class="product-image">
            <h2 class="product-name">{{$product->name}}</h2>
            <p class="product-description">{{$product->description}}</p>
            <div class="price">₽ {{$product->price}}</div>
            <div class="rating-info">
                @if($count > 0)
                    <span class="rating">Оценка {{$product->rating}} </span>
                    <span class="rating-count">({{$product->count}} оценок)</span>
                @else
                    Оценок нет
                @endif
            </div>
        </div>

        @if($count > 0)
            <div class="review-section">
                <h1 class="section-title">Отзывы о товаре</h1>
                <div class="reviews-list">
                    @foreach($reviews as $review)
                        <div class="review-item">
                            <div class="review-header">
                                <h2 class="review-author">{{$review->author()->first()->name}}</h2>
                                <div class="review-rating">
                                    @if($review->grade === 5)
                                        5 звёзд
                                    @elseif($review->grade === 1)
                                        1 звезда
                                    @else
                                        {{$review->grade}} звезды
                                    @endif
                                </div>
                            </div>
                            <p class="review-date">{{$review->date}}</p>
                            <p class="review-comment">{{$review->comment}}</p>
                        </div>
                    @endforeach
                </div>
                @endif

                <h1 class="section-title">Оставить отзыв о товаре</h1>
                <form id="reviewForm" action="/add-review" method="post" class="review-form">
                    <div class="form-group">
                        <label for="rating" class="form-label">Оценка:</label>
                        <select id="rating" name="rating" class="form-select" required>
                            <option value="" disabled selected>Выберите оценку</option>
                            <option value="5">5 звёзд</option>
                            <option value="4">4 звезды</option>
                            <option value="3">3 звезды</option>
                            <option value="2">2 звезды</option>
                            <option value="1">1 звезда</option>
                        </select>
                    </div>
                    <div class="form-group">
                        @csrf
                        <label for="comment" class="form-label">Ваш отзыв:</label>
                        <textarea id="comment" name="comment" rows="5" class="form-textarea" required></textarea>
                        <input type="hidden" id="product_id" name="product_id" value= {{$product->id}}>
                    </div>
                    <button type="submit" class="button">Отправить отзыв</button>
                </form>
            </div>
    </div>
</form>

<style>
    /* Общие стили */
    body {
        font-family: 'Arial', sans-serif;
        background-color: #f4f4f9;
        color: #333;
        margin: 0;
        padding: 0;
        line-height: 1.6;
    }

    .container {
        max-width: 800px;
        margin: 20px auto;
        padding: 20px;
        background-color: #fff;
        border-radius: 8px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    /* Ссылка "Вернуться в каталог" */
    .back-link {
        display: inline-block;
        margin-bottom: 20px;
        color: #04AA6D; /* Основной цвет */
        text-decoration: none;
        font-size: 16px;
        font-weight: bold;
    }

    .back-link:hover {
        text-decoration: underline;
        color: #038857; /* Темнее на hover */
    }

    /* Блок с информацией о товаре */
    .product {
        text-align: center;
        margin-bottom: 30px;
    }

    .product-image {
        border-radius: 8px;
        margin-bottom: 15px;
    }

    .product-name {
        font-size: 24px;
        margin: 10px 0;
        color: #333;
    }

    .product-description {
        font-size: 16px;
        color: #666;
        margin: 10px 0;
    }

    .price {
        font-size: 22px;
        color: #04AA6D; /* Основной цвет */
        margin: 15px 0;
        font-weight: bold;
    }

    .rating-info {
        font-size: 18px;
        color: #555;
    }

    .rating {
        font-weight: bold;
    }

    .rating-count {
        color: #777;
    }

    /* Секция с отзывами */
    .review-section {
        margin-top: 30px;
    }

    .section-title {
        font-size: 22px;
        margin-bottom: 20px;
        color: #333;
        border-bottom: 2px solid #04AA6D; /* Основной цвет */
        padding-bottom: 10px;
    }

    .reviews-list {
        margin-bottom: 30px;
    }

    .review-item {
        margin-bottom: 20px;
        padding: 15px;
        background-color: #f9f9f9;
        border-radius: 8px;
        border: 1px solid #eee;
    }

    .review-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 10px;
    }

    .review-author {
        font-size: 18px;
        color: #333;
        margin: 0;
    }

    .review-rating {
        font-size: 16px;
        color: #04AA6D; /* Основной цвет */
        font-weight: bold;
    }

    .review-date {
        font-size: 14px;
        color: #777;
        margin: 5px 0;
    }

    .review-comment {
        font-size: 14px;
        color: #555;
        margin: 10px 0;
    }

    /* Форма для добавления отзыва */
    .review-form {
        display: flex;
        flex-direction: column;
        gap: 15px;
    }

    .form-group {
        display: flex;
        flex-direction: column;
        gap: 5px;
    }

    .form-label {
        font-size: 16px;
        color: #333;
        font-weight: bold;
    }

    .form-select, .form-textarea {
        padding: 10px;
        font-size: 14px;
        border: 1px solid #ddd;
        border-radius: 4px;
        background-color: #f9f9f9;
        transition: border-color 0.3s ease;
    }

    .form-select:focus, .form-textarea:focus {
        border-color: #04AA6D; /* Основной цвет */
        outline: none;
    }

    .form-textarea {
        resize: vertical;
    }

    .button {
        padding: 10px 20px;
        font-size: 16px;
        color: #fff;
        background-color: #04AA6D; /* Основной цвет */
        border: none;
        border-radius: 4px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .button:hover {
        background-color: #038857; /* Темнее на hover */
    }
</style>
