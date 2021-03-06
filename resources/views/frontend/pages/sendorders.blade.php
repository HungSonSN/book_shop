@extends('frontend.master')
@section('title','Thanh toán đơn hàng')
@section('content')
<form method="post" action="">
  <div context="checkout" class="container">
    <div class="main">
      <div class="wrap clearfix">
        <div class="row">
          <div class="col-md-4 col-sm-6">
            <div class="form-group m0">
              <h2>
                <label class="control-label">THÔNG TIN MUA HÀNG</label>
              </h2>
            </div>
            <div class="form-group"> <a href="dang-ky.html">Đăng ký tài khoản mua hàng</a> | <a href="dang-nhap.html">Đăng nhập </a> </div>
            <hr class="divider">
            <div class="form-group">
              <input name="txtEmail" class="form-control txtEmail" value="{!! old('txtEmail') !!}" placeholder="Vui lòng nhập Email">
              <div class="help-block with-errors"><?php echo $errors->first('txtEmail'); ?></div>
            </div>
            <div class="billing">
              <div bind-show="billing_expand">
                <div class="form-group">
                  <input name="txtName" class="form-control txtName" value="{!! old('txtName') !!}"  placeholder="Họ và tên">
                  <div class="help-block with-errors"><?php echo $errors->first('txtName'); ?></div>
                </div>
                <div class="form-group">
                  <input  name="txtPhone" class="form-control txtPhone" value="{!! old('txtPhone') !!}" placeholder="Số điện thoại">
                  <div class="help-block with-errors"><?php echo $errors->first('txtPhone'); ?></div>
                </div>
                <div class="form-group">
                  <input name="txtAddress" class="form-control" value="{!! old('txtAddress') !!}" placeholder="Địa chỉ">
                  <div class="help-block with-errors"><?php echo $errors->first('txtAddress'); ?></div>
                </div>
                <hr class="divider">
              </div>
            </div>
            <div bind-show="otherAddress" class="shipping hide">
              <div class="form-group"> <a class="underline-none" href="javascript:void(0)"> Thông tin nhận hàng<span class="hide"></span> </a> </div>
            </div>
          </div>
          <div class="col-md-4 col-sm-6">
            <div class="shipping-method">
              <div class="form-group">
                <h2>
                  <label class="control-label">VẬN CHUYỂN</label>
                </h2>
              </div>
              <div class="form-group">
                <select name="value_order" class="form-control">
                  <option value="40000">Giao hàng tận nơi - Miễn phí KV TP.HCM</option>
                </select>
              </div>
            </div>
          </div>
          <div class="col-md-4 col-sm-6">
            <div class="order-summary order-summary--custom-background-color ">
              <div class="order-summary-header">
                <h2>
                  <label class="control-label">ĐƠN HÀNG</label>
                </h2>
              </div>
              <div class="summary-body  summary-section">
                <div class="summary-product-list">
                  <ul class="product-list">
                  <?php $content = Cart::content();
                    $total = 0;
                    $total_sale = 0;
                  ?>
                  @foreach($content as $row)
                  <input type="hidden" name="total_qty" value="{!! Cart::count() !!}">
                  @if($row->options->pricesale > 0)
                  <?php
                    $total_sale+=($row->options->pricesale * $row["qty"]);
                  ?>
                  <input type="hidden" name="idproduct" value="{!! $row->id !!}">
                  <input type="hidden" name="sl" value="{!! $row->qty !!}">
                    <input type="hidden" name="gia_sp" value="@if($row->options->pricesale > 0){!! $row->options->pricesale !!}@else {!! $row->price !!} @endif">
                   <input type="hidden" name="tong_gia_sp" value="@if($row->options->pricesale > 0){!! $row->options->pricesale * $row->qty !!}@else {!! $row->price * $row->qty !!} @endif">
                  @else
                      <?php $total+=($row["qty"] * $row["price"]); ?>
                  @endif
                 <li class="product product-has-image clearfix" style="margin-bottom:5px;">
                     <img src="{!! url('/upload/'.$row->options->image) !!}" class="pull-left product-image" width="30" style="margin-right:5px;">
                          <div class="product-info pull-left">
                             <span class="product-info-name">
                                <span style="font-size:10px">{!! $row->name !!}</span>  <span style="color:#C00; padding:0px 5px;"> X </span> {!! $row->qty !!}
                             </span>
                            </div>
                      <span class="product-price pull-right">
                        <input type="hidden" name="total_price" value="{!! $total+$total_sale !!}">
                        <?php
                            if($row->options->pricesale > 0){
                              echo  number_format($row->qty * $row->options->pricesale,0,',','.');
                            }else{
                              echo  number_format($row->qty * $row->price,0,',','.');
                            }
                        ?>đ
                       </span>
                     </li>
                     @endforeach
                     <hr />
                  </ul>
                  <ul>
                    <li class="product product-has-image clearfix" style="margin-bottom:10px;">
                    Tổng cộng:
                    	<strong class="product-price pull-right" style="color:#3C0">
						          <?php echo  number_format($total+$total_sale,0,',','.') ?>đ
                      </strong>
                    </li>
                  </ul>
                </div>
              </div>
              <div class="form-group clearfix">
                @if(Cart::count() > 0)
                <button class="btn btn-primary col-md-12 order-send" name="sendcartok" type="submit" style="cursor: pointer;">ĐẶT HÀNG</button>
                @endif
              </div>
              <div class="form-group has-error">
                <div class="help-block ">
                  <ul class="list-unstyled">
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</form>
@stop

