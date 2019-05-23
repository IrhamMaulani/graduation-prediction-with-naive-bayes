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

             

                    <button type="button" id="import" class="btn btn-success pull-right mt-1 mr-1">Import Dari Excel</button>
                  

                 

            

    <h2 class="ml-2">List Data Testing</h2>

    <form action="{{ route('data-testing-post') }}" method="POST">
                @csrf

         <div class="row ml-1 mt-1">
                    <div class="col-xs-4">
                        <div class="form-group">
                     <div class="form-group">
                            <select name="batch" class="form-control" id="select-batch" required>
                               <option value="">Pilih Semua Batch Data</option>
                              @foreach ($dataTestingBatchs as $dataTestingBatch)
                            <option  value={{$dataTestingBatch->batch}}>Data Batch Ke - {{$dataTestingBatch->batch}}</option>
                              @endforeach
                            </select>
                          </div>

                        </div>
                    </div>
                      </div>

                      <button  class="btn btn-primary pull-left ml-2 mb-1 mr-2" style="margin-right:15px;">Lakukan Perhitungan Naive Bayes</button>
                      
                       </form>

    <div class="container-fluid">
        <table class="table table-striped table-bordered"  id="table-testing" style="width:100%;">
            <thead>
              <tr>
                <th>Data Ke- </th>
                <th>NIM</th>
                <th>Jenis Kelamin</th>
                <th>Status Tempat Tinggal</th>
                <th>IPK</th>
                <th>Rata-rata Nilai UN</th>
                <th>Penghasilan Ortu</th>
                 <th>Prediksi Kelulusan</th>
                <th>Kelulusan</th>
                
                {{-- <th>Delete Data</th> --}}

              </tr>
            </thead>
           
          </table>
    </div>

            </div>

            </div>


    </div>


           <!-- Modal -->
  <div class="modal fade " id="myModal" role="dialog">
      <div class="modal-dialog modal-lg">
      
        <!-- Modal content-->
        <div class="modal-content ">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Upload Data Excel</h4>
          </div>
          <div class="modal-body">

              <form action="{{ route('data-testing-import') }}" method="POST" enctype="multipart/form-data">
                @csrf
               <input type="file" name="file" class="form-control">
               <br>
                <button class="btn btn-primary">Import Data</button>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </div>
        
      </div>
    </div>

    {{-- modal --}}


    

    {{-- modal --}}



@stop

@section('css')

<link href="{{ asset('css/style.css') }}" rel="stylesheet">

<style>

  td.equal {
        font-weight: bold;
        color: green;
    }

    td.fail{
      font-weight: bold;
        color: red;
    }

  </style>

@stop

@section('js')

<script>

  $("#import").click(function (e) { 
    e.preventDefault();
    $("#myModal").modal();
    
});





$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }

});

$(document).ready(function () {

  getData("ALL");

  function getData(batch){
      var table =$('#table-testing').DataTable( {

         "createdRow": function ( row, data, index ) {
           if(data.prediction_grad_status !== null && data.grad_status !== null){
            if (data.prediction_grad_status.trim() === data.grad_status.trim()) {
                $('td', row).eq(7).addClass('equal');
                $('td', row).eq(8).addClass('equal');
            }else{
               $('td', row).eq(7).addClass('fail');
                $('td', row).eq(8).addClass('fail');
            }
          }

            console.log(data);
        },
       "bLengthChange": true,

       "order": [[ 8, "asc" ]],
        dom: 'Blfrtip',
        buttons: [
          
        ],

        
     "ajax": "data-testing/to-json/batch=" + batch,
        "columns": [
            { data : 'batch' },
            { data: 'student_id' },
            { data : 'gender' },
            { data : 'dwelling_place' },
            { data : 'grade' },
            { data : 'high_school_grade_mean' },
            { data : 'parents_income' },
            { data : 'prediction_grad_status'},
            { data : 'grad_status' },
            // {"defaultContent": "<button class='btn-block btn btn-danger delete-data center col-centered'>Hapus Data!</button>"}
        ],
        
    } );
   }

   $("#select-batch").change(function () {

    // $('#table-detail  #row-dihapus ').remove();



   let batch = $(this).val();

   if(batch === ""){
     batch = "ALL";
   }

    $("#table-testing").dataTable().fnDestroy();
        getData(batch);
});
});


  </script>
{{-- js --}}

@stop