<div class="modal fade custom-modal" id="quickViewModal" tabindex="-1" aria-labelledby="quickViewModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <button id="closeModal" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6 col-sm-12 col-xs-12 mb-md-0 mb-sm-5">
                        <div class="detail-gallery">

                            <!-- MAIN SLIDES -->
                            <img src="" alt="product image" id="p_image" />

                        </div>
                        <!-- End Gallery -->
                    </div>
                    <div class="col-md-6 col-sm-12 col-xs-12">
                        <div class="detail-info pr-30 pl-30">


                            <h4 class="title-detail"><a href="" class="text-heading" id="p_name"></a></h4>


                            <div class="attr-detail attr-size mb-30 mt-30" id="p_size_area">
                                <strong class="mr-10" style="width: 60px">Size: </strong>
                                <select class="form-control unicase-form-control" id="p_size" name="p_size">

                                </select>
                            </div>

                            <div class="attr-detail attr-size mb-30" id="p_color_area">
                                <strong class="mr-10" style="width: 60px">Màu: </strong>
                                <select class="form-control unicase-form-control" id="p_color" name="p_color">


                                </select>
                            </div>


                            <div class="clearfix product-price-cover">
                                <div class="product-price primary-color float-left">
                                    <span class="current-price text-brand" id="p_discount_price"></span>
                                    <span>

                                        <span class="old-price font-md ml-15" id="p_selling_price"></span>
                                    </span>
                                </div>
                            </div>

                            <div class="detail-extralink mb-30">
                                <div class="detail-qty border radius">
                                    <a href="#" class="qty-down"><i class="fi-rs-angle-small-down"></i></a>

                                    <input type="text" name="p_qty" id="q_ty" class="qty-val" value="1"
                                        min="1">

                                    <a href="#" class="qty-up"><i class="fi-rs-angle-small-up"></i></a>
                                </div>



                                <div class="product-extra-link2">
                                    <input type="hidden" id="product_id">
                                    <button id="quickview_button" type="submit" class="button button-add-to-cart"
                                        onclick="addToCartQuickView()"><i class="fi-rs-shopping-cart"></i>Thêm vào giỏ
                                        hàng</button>
                                </div>
                            </div>



                            <div class="row">
                                <div class="col-md-6">
                                    <div class="font-xs">
                                        <ul>
                                            <li class="mb-5">Nhà cung cấp: <span class="text-brand"
                                                    id="p_vendor_name"> </span></li>
                                            <li class="mb-5">Thương hiệu: <span class="text-brand"
                                                    id="p_brand"></span></li>
                                            <li class="mb-5">Danh mục: <span class="text-brand" id="p_category">
                                                </span></li>
                                            <li class="mb-5" style="visibility: hidden;">Nhà cung cấp: <span
                                                    class="text-brand" id="p_vendor_id"> </span></li>


                                        </ul>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="font-xs">
                                        <ul>
                                            <li class="mb-5">Code: <span class="text-brand" id="p_code"></span>
                                            </li>
                                            <li class="mb-5">Số lượng:
                                                <span class="badge badge-pill badge-success bg-success text-white"
                                                    id="p__qty_available"></span>
                                                <span class="badge badge-pill badge-danger bg-danger text-white "
                                                    id="p__qty_outstock"></span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Detail Info -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
