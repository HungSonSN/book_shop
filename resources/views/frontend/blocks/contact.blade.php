@extends('frontend.master')
@section('title','Contact')
@section('contact','active')
@section('content')
<div id="content">
  <section class="">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <ul class="breadcrumb">
            <li><a href="/">Home</a></li>
            <li class="active">Contact</li>
          </ul>
        </div>
      </div>
    </div>
  </section>

  <section>
    <div class="container">
      <div class="row">
        <div class="col-md-6">
          <div class="form-contact">
            <form action="" id="contact" method="post">
              <input type="text" placeholder="Họ và tên" value="" name="name" title="First Name" class="input-text ">
              <input type="text" placeholder="Email" value="" class="input-text" name="email">
              <textarea placeholder="Nội dung" name="content" title="Comment" class="required-entry input-text" cols="5" rows="3"></textarea>
              <button type="submit" class="comment-submit">Gửi</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
@stop