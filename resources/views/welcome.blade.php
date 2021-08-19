<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    {{-- Jquery --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <title>Cek Ongkirmu!</title>
  </head>
  <body>
    <h2>Cek Ongkirmu!</h2>

    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <form class="form-horizontal" role="form" method="POST" action="/">
                            {{csrf_field()}}

                            <div class="form-group-sm">

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Provinsi Asal</label>
                                        <select name="province_origin" class="form-control">
                                            <option value="">--Provinsi--</option>
                                            @foreach ($provinces as $province => $value)
                                            <option value="{{$province}}">{{$value}}</option>    
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Kota Asal</label>
                                        <select name="city_origin" class="form-control" id="city_origin">
                                            <option value="">--Kota--</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Provinsi Tujuan</label>
                                        <select name="province_destination" class="form-control">
                                            <option value="">--Provinsi--</option>
                                            @foreach ($provinces as $province => $value)
                                            <option value="{{$province}}">{{$value}}</option>    
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Kota Tujuan</label>
                                        <select name="city_destination" class="form-control" id="city_destination">
                                            <option value="">--Kota--</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Kurir</label>
                                        <select name="courier" class="form-control">
                                            @foreach ($couriers as $courier => $value)
                                            <option value="{{$courier}}">{{$value}}</option>    
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label  for="">Berat (g)</label>
                                        <input  type="number" 
                                                name="weight" id="" 
                                                class="form-control"
                                                value="1000">
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-primary">cek</button>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Script proses AJAX dependensi Drop Down --}}
    <script>
        $(document).ready(function(){
            $('select[name="province_origin"]').on('change', function(){
                let provinceId = $(this).val();
                if(provinceId) {
                    jQuery.ajax({
                        url:'/province/'+provinceId+'/cities',
                        type:"GET",
                        dataType:"json",
                        success:function(data){
                            $('select[name="city_origin"]').empty();
                            $.each(data, function(key, value){
                                $('select[name="city_origin"]').append('<option value="'+ key +'">'+ value + '</option>');
                            });
                        },
                    });
                } 
                else {
                    $('select[name="city_origin"]').empty();
                }
            });
 
            $('select[name="province_destination"]').on('change', function(){
                let provinceId = $(this).val();
                if(provinceId) {
                    jQuery.ajax({
                        url:'/province/'+provinceId+'/cities',
                        type:"GET",
                        dataType:"json",
                        success:function(data){
                            $('select[name="city_destination"]').empty();
                            $.each(data, function(key, value){
                                $('select[name="city_destination"]').append('<option value="'+ key +'">'+ value + '</option>');
                            });
                        },
                    });
                } 
                else {
                    $('select[name="city_destination"]').empty();
                }
            });
 
        });
    </script>
    {{-- end of Script proses AJAX dependensi Drop Down --}}

    <!-- Optional JavaScript; choose one of the two! -->    

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
  </body>
</html>