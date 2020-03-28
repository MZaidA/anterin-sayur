@extends('layouts.web.default')
@section('title', 'Anterin Sayur')

@section('content')
<div class="container">
    <div class="row justify-content-center mb-3 pb-3">
        <div class="col-md-12 heading-section text-center ftco-animate">
            <span class="subheading">Featured Products</span>
            <h2 class="mb-4">Our Products</h2>
            <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia</p>
        </div>
    </div>   		
</div>
<div class="container">
        <div id="list-product" class="row">

        </div>
</div>
@endsection

@section('scripts')
<script>
$( document ).ready(function() {
    getAPIProduct();
});

function getAPIProduct() {
    $.ajax({
        type: 'GET',
        url: 'http://localhost/anterin-sayur/api/product',
        beforeSend: function () {},
        success: function (data) {
            displayProduct(data);
            // console.log(data);
        },
        timeout: 300000,
        error: function (e) {
            console.log(e);
        }
    });
}

function displayProduct(data) {
    const product = data.data;
    const divAnimate = "col-md-6 col-lg-3 ftco-animate";
    const divProduct = "product";
    const divTextCenter = "text py-3 pb-4 px-3 text-center";
    let markup;
    let productId,
        productName,
        productStock,
        productPrice,
        productDiscount,
        productTotalDiscount;

    for(index in product) {
        productId = product[index].id;
        productName = product[index].name;
        productStock = product[index].quantity;
        productPrice = product[index].price;
        productDiscount = product[index].discountPrice;
        productTotalDiscount = product[index].totalDiscount;

        formattedPrice = new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR' }).format(productPrice);
        formattedTotalDiscount = new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR' }).format(productTotalDiscount);

        markup = `
                <div class="col-md-6 col-lg-3">
                    <div class="product">
                        <div class="text py-3 pb-4 px-3 text-center"><h3><a href="#">` + productName + `</a></h3>
                            <div class="d-flex">
                                <div class="pricing">
                                    <p class="price"><span class="mr-2 price-dc">` + formattedPrice + `</span><span class="price-sale">` + formattedTotalDiscount + `</span></p>
                                </div>
                            </div>
                            <div class="bottom-area d-flex px-3">
                                <div class="m-auto d-flex">
                                    <a href="#" class="buy-now d-flex justify-content-center align-items-center mx-1">
                                        <span><i class="ion-ios-cart"></i></span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                `;

        $('#list-product').append(markup);
    }
}
</script>
@endsection