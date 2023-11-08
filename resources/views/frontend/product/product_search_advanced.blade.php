<style type="text/css">

</style>


@if ($products->isEmpty())
    <h4 class="text-center text-secondary fs-6">Không tìm thấy sản phẩm</h4>
@else
    <div class="container mt-5">
        <div class="row d-flex justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    {{-- Scroll search products found --}}
                    {{-- <div class="card" style="height: 100px; overflow-y: scroll"> --}}

                    @foreach ($products as $product)
                        <a href="{{ url('product/details/' . $product->id . '/' . $product->product_slug) }}">
                            <div class="w-100 d-flex list border-bottom" style=" margin-bottom: 5px; padding: 5px">
                                <div class="d-flex align-items-center justify-content-center"
                                    style="width: 50px; height: 50px;margin-right: 10px; ">
                                    <img class="" src="{{ asset($product->product_thumbnail) }}"
                                        style="width: 100%; height: 100%; border-radius: 5px" />
                                </div>

                                <div class="w-100 d-flex justify-content-between align-items-center">
                                    <p style="font-size: 12px; font-weight: 600; color: #253d4e">
                                        {{ $product->product_name }}</p>
                                    <p style="font-size: 12px; font-weight: 600; color: #3bb77e">
                                        {{ number_format($product->selling_price, 0, '.', '.') }}₫</p>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endif
