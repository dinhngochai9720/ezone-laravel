@php
    $sliders = App\Models\Slider::orderBy('slider_title', 'ASC')->get();
@endphp

<section class="home-slider position-relative mb-30">
    <div class="container">
        <div class="home-slide-cover mt-30">
            <div class="hero-slider-1 style-4 dot-style-1 dot-style-1-position-1">

                @foreach ($sliders as $slider)
                    <div class="single-hero-slider single-animation-wrap"
                        style="background-image: url({{ asset($slider->slider_image) }})">
                        <div class="slider-content">
                            <h1 class="display-2 mb-40" style="color: #ffffff;">
                                {{ $slider->slider_title }}
                            </h1>
                            <p class="mb-65" style="color: #3bb77e;"> {{ $slider->slider_subtitle }}</p>
                            <form class="form-subcriber d-flex">
                                <input type="email" placeholder="Nhập địa chỉ email" />
                                <button class="btn w-50" type="submit" style="">Đăng ký</button>
                            </form>
                        </div>
                    </div>
                @endforeach

            </div>
            <div class="slider-arrow hero-slider-1-arrow"></div>
        </div>
    </div>
</section>
