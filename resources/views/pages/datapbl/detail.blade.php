@extends("master_lte")
@section("title-page", "Data PBL - ")

@section('breadcrumb')
<section class="content-header">
  <h1>
    Data
    <small>Pendaptan Biaya Laba Rugi (PBL)</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{ url('/') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li class="active"><i class="fa fa-server"></i> Data PBL</li>
  </ol>
</section>
@endsection


@section('konten')
<div class="row">
    <div class="col-md-6 col-sm-6 col-xs-12">
        <div class="box box-success">
            <div class="box-header with-border">
                <h2 class="box-title text-center"><i class='fa fa-tag text-success'></i> Data Labarugi</h2>
            </div>
            <div class="box-body">
            <form action="javascript:void(0)" id='FormData'>
                @csrf
                <div class="form-group">
                    <label for="periode" autocomplete=off class='control-label'>Tahun <span class='text-danger'>*</span></label>
                    <select name="periode" id="periode" class="form-control">
                        <option value="">..:: Pilih Periode ::..</option>
                        @foreach($periodes as $dt_periode)
                            <option value="{{ $dt_periode->periode }}" @if(Request::segment(2) == $dt_periode->periode) selected @endif>{{ $dt_periode->keterangan }}</option>
                        @endforeach
                    </select>
                    <!-- <input type="text" placeholder="Entri Nama Penghasilan" name='nama_penghasilan' id='nama_penghasilan' class='form-control FormIsi'> -->
                </div>
                <hr>
                <div class="form-group">
                    <button  class='btn btn-sm btn-success btn-flat'><i class='fa fa-check-square'></i> Load Data</button>
                </div>
            </form>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="box box-success">
            <div class="box-header with-border">
                <h2 class="box-title text-center"><i class='fa fa-server text-success'></i> Performance Laba Rugi Periode <span id='per'></span></h2>

            </div>
            <div class="box-body">
                <div class='table-responsive'>
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr class='warning'>
                                <th>URAIAN</th>
                                <th>SATUAN</th>
                                <th>JUMLAH</th>
                            </tr>
                        </thead>
                        <tbody id="result_data"></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


    
@endsection
@section('script')
<script>
    $(document).ready(function(){
        get_periode();
        load_data_pbl();
    })

    $("#FormData").submit(function(e){
        e.preventDefault();
        var periode = $("#periode").val();
        location.replace("{{ url('/data-pbl')}}/"+periode);
    })
    function format_rupiah(val) {
        separator = ".";
        a = val.toString();
        b = a.replace(/[^\d]/g,"");
        c = "";
        panjang = b.length; 
        j = 0; 
        for (i = panjang; i > 0; i--) {
                j = j + 1;
                if (((j % 3) == 1) && (j != 1)) {
                    c = b.substr(i-1,1) + separator + c;
            } else {
                    c = b.substr(i-1,1) + c;
            }
        }
        return c;
    }

    function get_periode(){
        $.ajax({
            type : "POST",
            dataType: "json",
            url : "{{ asset('api/datapblperiode') }}",
            data: "periode={{ Request::segment(2) }}",
            cache: false,
            success: function(res){
                console.log(res);
                $("#per").html(res.periode);
            },
            error: function(er){
                console.log(er);
            }
        });

    }

    function load_data_pbl(){
        $.ajax({
            type : "POST",
            dataType: "json",
            url : "{{ asset('api/datapbl') }}",
            data: "periode={{ Request::segment(2) }}",
            cache: false,
            success: function(res){
              
                var html = "";
                var data_pb = res.data.data_pb;
                for(var i=0; i < data_pb.length; i++){
                    html += "<tr class='info'>";
                    html += "<td><b>"+data_pb[i].nama_akun+"</b></td>";
                    html += "<td></td>";
                    html += "<td></td>";
                    var detail_data = data_pb[i].detail_data;
                    for(j=0; j<detail_data.length; j++){
                        html += "</tr>";
                        html += "<tr>";
                        html += "<td>&nbsp;&nbsp;&nbsp;"+detail_data[j].nama_sub_akun+"</td>";
                        html += "<td>Rp. Juta</td>";
                        html += "<td>"+detail_data[j].jml+"</td>";
                        html += "</tr>";
                    }

                    html += "</tr>";
                    html += "<tr class='info'>";
                    html += "<td><b>JUMLAH "+data_pb[i].nama_akun+"</b></td>";
                    html += "<td><b>Rp. Juta</b></td>";
                    html += "<td><b>"+format_rupiah(data_pb[i].jumlah)+"</b></td>";
                    html += "</tr>";
                }
                html += "</tr>";
                html += "<tr class='success'>";
                html += "<td><b>LABA RUGI SETELAH PAJAK</b></td>";
                html += "<td><b>Rp. Juta</b></td>";
                html += "<td><b>"+res.data.laba_rugi+"</b></td>";
                html += "</tr>";
                $("#result_data").html(html);
            },
            error: function(er){
                console.log(er);
            }
        });
    }

    

    
   
    
    
    
</script>
@endsection