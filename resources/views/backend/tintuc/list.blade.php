@extends('backend.master')
@section('controller','Sản phẩm')
@section('action','Danh sách')
@section('article','active')
@section('list_tt', 'active')
@section('content')
 <section class="content">
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-body">
                  <table id="example2" class="table table-bordered table-hover">
                    <thead>
                      <tr>
                        <th>Tên danh mục</th>
                        <th>Hình ảnh</th>
                        <th>Users</th>
                        <th>Ngày tạo</th>
                        <th style="width:8%">Thao tác</th>
                      </tr>
                    </thead>
                    <tbody>
                    @foreach($article as $articles)
                      <tr>
                        <td>{!! $articles["name"] !!}</td>
                        <td><img src="{!! asset('public/upload/article/'.$articles["image"]) !!}" width="30" alt="{!! $articles["name"] !!}"></td>
                        <td><?php
                              $puser = DB::table('users')->where('id',$articles["user_id"])->first();
                              echo $puser->username;
                          ?></td>
                        <td>
                        {!!
                        \Carbon\Carbon::createFromTimeStamp(strtotime($articles["created_at"]))->diffForHumans();
                        !!}
                     </td>
                        <td>
                          <a href="{!! url('admin/article/delete',$articles["id"]) !!}">Xóa</a>
                          <a href="{!! url('admin/article/edit',$articles["id"]) !!}">Sữa</a>
                        </td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                  <div class="pull-right">
                    <?php //$arrProduct->setPath('list'); ?>
                    <?php //echo $arrProduct->render(); ?>
                  </div>
                </div><!-- /.box-body -->
              </div><!-- /.box -->

              <!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section>

@stop