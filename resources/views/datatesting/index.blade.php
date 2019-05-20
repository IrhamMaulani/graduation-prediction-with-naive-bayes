@extends('adminlte::page')

@section('title', 'Data Testing')

@section('content_header')

<meta name="csrf-token" content="{{ csrf_token() }}">


  <ol class="breadcrumb">
    <li><a href="/admin/data-training"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Data Testing</li>
  </ol>
    
@stop


@section('content')


    <div class="row mt-1" >
            <div class="col-md-12">

            <div class="box box-light">

                    <button type="button" class="btn btn-success pull-right mt-1 mr-1">Import From Excel</button>

                <button type="button" class="btn btn-primary pull-right mt-1 mr-1">Add New Data</button>

            

    <h1 class="ml-1">List Data Testing</h1>
    <div class="container-fluid">
        <table class="table table-striped table-bordered"  id="tablePasien" style="width:100%;">
            <thead>
              <tr>
                  
                <th>NIM</th>
                <th>IPK</th>
                <th>Jenis Kelamin</th>
                <th>Status Tempat Tinggal</th>
                <th>Nilai UN</th>
                <th>Penghasilan Ortu</th>
                <th>Jumlah Tanggungan Ortu</th>
                <th>Keterangan</th>
                <th>Lihat Data</th>
                <th>Edit Data</th>

              </tr>
            </thead>
           
          </table>
    </div>

            </div>

            </div>


    </div>



@stop

@section('css')



<link href="{{ asset('css/style.css') }}" rel="stylesheet">





@stop

@section('js')

{{-- js --}}

@stop