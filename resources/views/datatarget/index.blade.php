@extends('adminlte::page')

@section('title', 'Akurasi')

@section('content_header')

<meta name="csrf-token" content="{{ csrf_token() }}">


  <ol class="breadcrumb">
    <li><a href="/admin/data-training"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Akurasi</li>
  </ol>
    
@stop


@section('content')


    <div class="row mt-1" >
            <div class="col-md-12">

            <div class="box box-light">


            

    <h1 class="ml-1">Data Target</h1>
    <div class="container-fluid">
        <table class="table table-striped table-bordered"  id="table-training" style="width:100%;">
            <thead>
              <tr>
                  
                <th>NIM</th>
                <th>Jenis Kelamin</th>
                <th>Status Tempat Tinggal</th>
                <th>IPK</th>
                <th>Rata-rata Nilai UN</th>
                <th>Penghasilan Ortu</th>
                <th>Kelulusan</th>
                <th>Data Ke -</th>
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

    // var table =$('#table-training').DataTable( {

    //    "order": [[ 0, "asc" ]],
    //     dom: 'Blfrtip',
    //     buttons: [
            // {

            //     extend: 'print',
            //     text: 'Print ',
            //     autoPrint: true,
            //     orientation: 'landscape',
            //     exportOptions: {
            //         columns: [ 0, 1, 2, 3 ,4 ,5 ,6 ],
            //         modifier: {
            //             page: 'current',
            //             columns: ':visible',
                        
            //         }
            //     },
            //     customize: function (win) {
            //         $(win.document.body).find('table').addClass('display').css('font-size', '15px');
            //         $(win.document.body).find('h1').css('text-align','center').addClass('header');
            //         $(win.document.body).find('.header').html('Daftar Pasien');
            //         /* $(win.document.body).find('button').css('display','none'); */
            //         /* $(win.document.body).find('h1').html('Hello'); */
            //     },
              
            // },
            // {
            //     extend: 'excelHtml5',
            //     orientation: 'landscape',
            //     exportOptions: {
            //         columns: [ 0, 1, 2, 3 ,4 ,5 ,6 ],
            //         modifier: {
            //             page: 'current',
            //             columns: ':visible',
                        
            //         }
                    
            //     }, customize: function ( xlsx ) {
            //         var sheet = xlsx.xl.worksheets['sheet1.xml'];
 
            //             // jQuery selector to add a border
                        
            //             $('row c[r*="10"]', sheet).attr( 's', '25' );
            //        }
                
            // }
           

//         ],
//      "ajax": "akurasi/to-json",
//         "columns": [
//             { data: 'batch' },
//             { data : 'accuracy_data' },
//             { data : 'recall_data' },
//             { data : 'precision_data' }
//         ],
        
//     } );

//     // $('#tablePasien tbody').on( 'click', '.lihat-data', function () {
//     //     var data = table.row( $(this).parents('tr') ).data();

//     //     $(".lihat-data").attr("href", "pasien/detailpasien=" +data.id);
        
//     //     console.log(data);
//     // } );


//     $('#table-training tbody').on( 'click', '.delete-data', function () {
//         var data = table.row( $(this).parents('tr') ).data();

//         var confirmation = confirm("Data akan di hapus permanen.Apakah anda ingin melanjutkan?");

//         if (confirmation) {
//             $.ajax({
//                 method: "POST",
//                 url: window.location.href + "/" + data.id,
//                 data: { 
//                       _method     :     "delete"       
//                  }    
//               })
//                 .done(function( data ) {
//                     alert("Data Berhasil Di Hapus");
//                     $('#table-training').DataTable().ajax.reload();  
//                 });
               
//            }
       
//     } );

// });




  </script>

@stop