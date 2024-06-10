@extends('layout.master')

@section('title')
  Chi tiết User
@endsection

@section('content')
<div class="row justify-content-center">
  <div class="col-lg-12">
      <div class="white_card card_height_100 mb_30">
          <div class="white_card_header">
              <div class="box_header m-0">
                  <div class="main-title">
                      <h1 class="m-0">Chi tiết User: {{$user['name']}}</h1>
                  </div>
              </div>
          </div>
          <div class="white_card_body">
              <div class="table-responsive">
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th>Trường</th>
                      <th>Giá trị</th>
                    </tr>
                  </thead>
                  <tbody>
                      @foreach ($user as $field => $value)
                          <tr>
                              <td> {{ $field }} </td>
                              <td> {{ $value }} </td>
                          </tr>
                      @endforeach
                  </tbody>
                </table>
                <div class="text-center">
                  <a href="{{ url("admin/users/") }}" class="btn btn-success">Trở về</a>
                  <a href="{{ url("admin/users/{$user['id']}/edit") }}" class="btn btn-warning">Sửa</a>
                </div>
              </div>
          </div>
      </div>
  </div>
</div>
@endsection
