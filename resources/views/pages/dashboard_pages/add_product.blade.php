@extends('layouts.dashboard')

@section('pages')


@php
    use Illuminate\Support\Str;
    $uuid = Str::uuid();

@endphp

<div class="px-10">
    <p class="my-2 font-bold text-3xl ml-5">Add New Product</p>

    <form id="add_product_form" method="POST" class="hero-content flex-col lg:flex-row justify-center">
        @csrf
      <div id="imgUploadingBtn" class="text-center lg:text-left bg-white p-10 rounded-lg h-[460px] w-[50%] flex flex-col items-center justify-center">
        <label class="w-full cursor-pointer productImgLabel">
            @csrf
            <i id="uploadIcon" class="fa-solid fa-image text-9xl text-gray-800"></i>
            <img id="img_preview" class="w-40 h-40 mx-auto mb-2" src="#" alt="">
            <p class="text-gray-800 font-bold">Upload the product Image</p>
            <input class="hidden" name="product_image" id="product_image" type="file">
            <button class="btn btn-primary hidden">upload</button>
        </label>
      </div>
      <div class="card flex-shrink-0 w-[50%] shadow-2xl">
        <div class="card-body">
          <div id="product_name_form_control" class="form-control">
            <label class="label">
              <span class="label-text">Product Name</span>
            </label>
            <input type="text" id="product_name" name="product_name" placeholder="Product Name" class="input input-bordered" />
          </div>
          <div id="buy_price_form_control" class="form-control">
            <label class="label">
              <span class="label-text">Buy Price</span>
            </label>
            <input type="text" name="buy_price" id="buy_price" placeholder="Buy Price" class="input input-bordered" />
          </div>
          <div id="sell_price_form_control" class="form-control">
            <label class="label">
              <span class="label-text">Sell Price</span>
            </label>
            <input type="text" id="sell_price" name="sell_price" placeholder="Sell Price" class="input input-bordered" />
          </div>
          <div class="form-control hidden">
            <label class="label">
              <span class="label-text">Product Code</span>
            </label>
            <input value="{{ $uuid }}" type="text" id="product_code" name="product_code" placeholder="Sell Price" class="input input-bordered" />
          </div>
          <div class="form-control mt-6">
            <button id="add_product_btn" class="btn btn-primary">Add Product</button>
          </div>
        </div>
      </div>
    </form>
</div>
@endsection

