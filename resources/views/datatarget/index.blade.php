@extends('adminlte::page')

@section('title', 'Data Target')

@section('content_header')

<meta name="csrf-token" content="{{ csrf_token() }}">


  <ol class="breadcrumb">
    <li><a href="/admin/data-training"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Data Target</li>
  </ol>
    
@stop


@section('content')


    <div class="row mt-1" >
            <div class="col-md-12">

            <div class="box box-light">

               <button type="button" id="add-data" class="btn btn-info pull-right mt-1 mr-1">Tambah Data</button>

            

    <h1 class="ml-1">Data Target</h1>
    
       @if(session()->has('message'))
    <div class="ml-1 mr-1 alert alert-success">
        {{ session()->get('message') }}
    </div>
@endif
    <div class="container-fluid">
        <table class="table table-striped table-bordered"  id="table-target" style="width:100%;">
            <thead>
              <tr>
                  
                <th>NIM</th>
                <th>Jenis Kelamin</th>
                <th>Status Tempat Tinggal</th>
                <th>IPK</th>
                <th>Rata-rata Nilai UN</th>
                <th>Penghasilan Ortu</th>
                <th>Prediksi Kelulusan</th>
                <th>Data Ke -</th>
                <th>Hapus Data</th>
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
            <h4 class="modal-title">Tambahkan Data</h4>
          </div>
          <div class="modal-body">

     

            {{--  --}}
   <form action="" id="form-edit-pasien" method="POST" >
              <div class="form-group">
                  <label for="usr">NIM</label>
              <input type="text" class="form-control" name="student_id" required>
                </div>

                <div class="form-group">
                    <label for="usr">Jenis Kelamin</label>
                   <select class="form-control" name="gender" required>
                      <option value="Laki-Laki">Laki-Laki</option>
                      <option value="Perempuan">Perempuan	</option>
                    </select>
                  </div>

                  <div class="form-group">
                      <label for="usr">Status Tempat Tinggal:</label>
                      <select class="form-control" name="dwelling_place" required>
                      <option value="Rumah Sendiri">Rumah Sendiri</option>
                      <option value="Pondokan/Kos">Pondokan/Kos</option>
                      <option value="Asrama">Asrama</option>
                      <option value="Rumah Orang Tua">Rumah Orang Tua</option>
                      <option value="Lain-lain">Lain-lain</option>
                       <option value="Rumah Saudara">Rumah Saudara</option>

                    </select>
                    </div>

                    <div class="form-group">
                        <label for="usr">IPK:</label>
                        <input type="text" class="form-control" name="grade"  id="usr" value="" required>
                      </div>

                      <div class="form-group">
                        <label for="usr">Rerata Ujian Nasional (SMA):</label>
            
                       <input type="text" class="form-control" name="high_school_grade_mean"  required>
                      </div>
                      <div class="form-group">
                          <label for="usr">Penghasilan Orang Tua (Rupiah):</label> 
                         <select class="form-control" name="parents_income" required>
                          <option value="> 5.000.000 - 6.000.000">> 5.000.000 - 6.000.000</option>
                      <option value="> 3.000.000 - 4.000.000">> 3.000.000 - 4.000.000</option>
                          <option value="> 2.000.000 - 3.000.000">> 2.000.000 - 3.000.000</option>
                            <option value="> 1.000.000 - 2.000.000">> 1.000.000 - 2.000.000</option>
                            <option value=" < 1.000.000">  < 1.000.000</option>

                           
                    

                    </select>
                        </div>
                        @csrf
                        <input type="hidden" name="_method" value="POST">
                        <button type="submit" class="btn btn-primary" name="submit" value="edit">Submit</button>

                        </form>


            {{--  --}}
              
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </div>
        
      </div>
    </div>

    {{-- modal --}}



@stop

@section('css')



<link href="{{ asset('css/style.css') }}" rel="stylesheet">





@stop

@section('js')

<script>
  $("#add-data").click(function (e) { 
    e.preventDefault();
    $("#myModal").modal();
    
});



$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }

});


$(document).ready(function () {

     var table =$('#table-target').DataTable( {
       "order": [[ 1, "asc" ]],
        dom: 'Blfrtip',
        buttons: [
          
        ],
     "ajax": "data-target/to-json",
        "columns": [
            { data: 'student_id' },
            { data : 'gender' },
            { data : 'dwelling_place' },
            { data : 'grade' },
            { data : 'high_school_grade_mean'},
            { data : 'parents_income' },
            { data : 'grad_prediction' },
            { data : 'testing_trial.batch' },
            {"defaultContent": "<button class='btn-block btn btn-danger delete-data center col-centered'>Hapus Data!</button>"}
        ],
        
    } );

    
    $('#table-target tbody').on( 'click', '.delete-data', function () {
        var data = table.row( $(this).parents('tr') ).data();

        var confirmation = confirm("Data akan di hapus permanen.Apakah anda ingin melanjutkan?");

        if (confirmation) {
            $.ajax({
                method: "POST",
                url: window.location.href + "/" + data.id,
                data: { 
                      _method     :     "delete"       
                 }    
              })
                .done(function( data ) {
                    alert("Data Berhasil Di Hapus");
                    $('#table-target').DataTable().ajax.reload();  
                });
               
           }
       
    } );

});




  </script>

@stop