<div class="product-area">
    <div class="fluid-container">
        <div class="row">
            <div class="col-12">
                <div class="section-title">
                    <h2>Our Latest Product</h2>
                    <img src="assets/images/section-title.png" alt="">
                </div>
            </div>
        </div>
        <ul class="row">
          @php
            $flag = 1;
          @endphp
          @foreach ($products as $product)
            <li class="col-xl-3 col-lg-4 col-sm-6 col-12 {{ ($flag > 4) ? 'moreload' : '' }}">
                <div class="product-wrap">
                    <div class="product-img">
                        <span>Sale</span>
                        <img src="{{ asset('uploads/product_thumbnail_image') }}/{{ $product->product_thumbnail_image }}" alt="">
                        <div class="product-icon flex-style">
                            <ul>
                                <li><a data-toggle="modal" data-target="#exampleModalCenter{{ $product->id }}" href="javascript:void(0);"><i class="fa fa-eye"></i></a></li>
                                <li><a href="wishlist.html"><i class="fa fa-heart"></i></a></li>
                                <li><a href="cart.html"><i class="fa fa-shopping-bag"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="product-content">
                        <h3><a href="{{ route('products.show', $product->product_slug) }}">{{ $product->product_name }}</a></h3>
                        <p class="pull-left">${{ $product->product_price }}

                        </p>
                        <ul class="pull-right d-flex">
                            <li><i class="fa fa-star"></i></li>
                            <li><i class="fa fa-star"></i></li>
                            <li><i class="fa fa-star"></i></li>
                            <li><i class="fa fa-star"></i></li>
                            <li><i class="fa fa-star-half-o"></i></li>
                        </ul>
                    </div>
                </div>
            </li>
            @php
              $flag++;
            @endphp
            <div class="modal fade" id="exampleModalCenter{{ $product->id }}" tabindex="-1">
                <div class="modal-dialog modal-dialog-centered">
                 <div class="modal-content">
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                         <span aria-hidden="true">&times;</span>
                     </button>
                     <div class="modal-body d-flex">
                         <div class="product-single-img w-50">
                             <img src="{{ asset('uploads/product_thumbnail_image') }}/{{ $product->product_thumbnail_image }}" alt="">
                         </div>
                         <div class="product-single-content w-50">
                             <h3>{{ $product->product_name }}</h3>
                             <div class="rating-wrap fix">
                                 <span class="pull-left">${{ $product->product_price }}</span>
                                 <ul class="rating pull-right">
                                     <li><i class="fa fa-star"></i></li>
                                     <li><i class="fa fa-star"></i></li>
                                     <li><i class="fa fa-star"></i></li>
                                     <li><i class="fa fa-star"></i></li>
                                     <li><i class="fa fa-star"></i></li>
                                     <li>(05 Customar Review)</li>
                                 </ul>
                             </div>
                             <p>On the other hand, we denounce with righteous indignation and dislike men who are so beguiled and demoralized by the charms of pleasure of the moment, so blinded by desire denounce with righteous indignation</p>
                             <ul class="input-style">
                                 <li class="quantity cart-plus-minus">
                                     <input type="text" value="1" />
                                 </li>
                                 <li><a href="cart.html">Add to Cart</a></li>
                             </ul>
                             <ul class="cetagory">
                                 <li>Categories:</li>
                                 <li><a href="#">Honey,</a></li>
                                 <li><a href="#">Olive Oil</a></li>
                             </ul>
                             <ul class="socil-icon">
                                 <li>Share :</li>
                                 <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                 <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                 <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                                 <li><a href="#"><i class="fa fa-instagram"></i></a></li>
                                 <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                             </ul>
                         </div>
                     </div>
                 </div>
                </div>
                </div>
          @endforeach
            <li class="col-12 text-center">
                <a class="loadmore-btn" href="javascript:void(0);">Load More</a>
            </li>
        </ul>
    </div>
</div>
