<div class="tile product">

<div class="product-grid__product-wrapper">
    <div class="product-grid__product">
        <div class="product-grid__img-wrapper">
            {{app('debugbar')->warning($product->images()->first())}}
            @if(count($product->images()->get()) >0)
                <img src="{{$product->images()->first()->url}}" alt="Img" class="product-grid__img" />
            @else
                <img src="images/placeholder.png" alt="Img" class="product-grid__img" />
            @endif

        </div>
        <span class="product-grid__title">{{$product->name}}</span>
        <span class="product-grid__price">{{$product->price}}PLN</span>
        <div class="product-grid__extend-wrapper">
            <div class="product-grid__extend">
                <p class="product-grid__description">{{$product->description}}</p>
                <span class="product-grid__btn product-grid__add-to-cart">
                    <i class="fa fa-cart-arrow-down"></i>
                    <a href="{{route('products.addToCart', ['id' => $product->id])}}"> Add to cart</a>
                </span>
                <span class="product-grid__btn product-grid__view">
                    <i class="fa fa-eye"></i>
                    <a href="{{route('products.show', ['id' => $product->id])}}">More details</a>
                </span>
            </div>
        </div>
    </div>
</div>
</div>

