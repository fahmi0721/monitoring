@extends("master_lte")
@section("title-page", "Grafik Piutang - ")

@section('breadcrumb')
<section class="content-header">
  <h1>
    Garfik
    <small>Piutang</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{ url('/') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li class="active"><i class="fa fa-line-chart"></i> grafik Piutang</li>
  </ol>
</section>
@endsection


@section('konten')

<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="box box-success">
            <div class="box-header with-border">
                <h2 class="box-title text-center"><i class='fa fa-bar-chart text-success'></i> Grafik Piutang Berdasarkan Unit Kerja </h2>
            </div>
            <div class="box-body">
                <div class="chart">
                    <canvas id="chart-unit-kerja" style="height: 250px;"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="box box-success">
            <div class="box-header with-border">
                <h2 class="box-title text-center"><i class='fa fa-area-chart text-success'></i> Grafik Piutang Bulanan Tahun <span class='Tahun'></span></h2>
                <div class="box-tools pull-right">
                    <div class='input-group'>   
                        <select name="tahun" id="tahun" class="form-control" onchange="reload()">
                            <option value="">..:: Pilih Tahun ::..</option>
                            @for($i=2022; $i<= date("Y"); $i++)
                            <option value="{{ $i }}" @if($i == Request::segment(2)) selected @endif>Tahun {{ $i }}</option>
                            @endfor
                        </select>
                    </div>
                </div>
            </div>
            <div class="box-body">
                <div class="chart">
                    <canvas id="chart-v_bulan" style="height: 250px;"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="box box-success">
            <div class="box-header with-border">
                <h2 class="box-title text-center"><i class='fa fa-line-chart text-success'></i> Grafik  Berdasarkan Umur Piutang </h2>
                <div class="box-tools pull-right">
                    <div class='input-group'>  
                        @php
                            $umur = array(base64_encode("1s30"),base64_encode("31s60"),base64_encode("61s90"),base64_encode("91s180"),base64_encode("181s270"),base64_encode("271s365"),base64_encode("s365"));
                            $lbl = array("1 sd 30", "31 s/d 60", "61 s/d 90", "91 s/d 180", "181 s/d 270", "271 s/d 365", ">365");
                        @endphp 
                        <select name="umur" id="umur" class="form-control" onchange="reload()">
                            <option value="">..:: Pilih Periode ::..</option>
                            
                            @for($i=0; $i< count($lbl) ; $i++)
                                <option value="{{ $umur[$i] }}" @if($umur[$i] == Request::segment(3)) selected @endif>{{ $lbl[$i] }} hari</option>
                            @endfor
                        </select>
                    </div>
                </div>
            </div>
            <div class="box-body">
                <div class="chart">
                    <canvas id="chart-umur" style="height: 250px;"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

    
@endsection
@section('script')
<script>
    $(document).ready(function(){
        var lbr_chart;
        load_garfik();
    })

    function reload(){
        var tahun = $("#tahun").val();
        var umur = $("#umur").val();
        location.replace("{{ url('/grafik-piutang')}}/"+tahun+"/"+umur);

    }

    function load_garfik(){
        $(".Tahun").html("{{Request::segment(2)}}");
        $.ajax({
            type : "POST",
            dataType: "json",
            url : "{{ asset('api/all-piutang') }}",
            data: "periode={{ Request::segment(2) }}&umur={{ Request::segment(3) }}",
            cache: false,
            success: function(res){
                console.log(res);
                v_bulan(res.data.v_bulan);
                v_unit_kerja(res.data.v_unit_kerja);
                v_umur(res.data.v_umur);
            },
            error: function(er){
                console.log(er);
            }
        })
    }
   
    function v_bulan(r){
        const ctx = document.getElementById('chart-v_bulan');
        const data = {
            labels: r.labels,
            datasets: [
                {
                label: 'Piutang',
                data: r.data,
                borderColor: "#2bcbba",
                backgroundColor: "rgba(43, 203, 186,0.8)",
                fill: true
                },
                
            ]
        };
        const config = {
            type: 'bar',
            data: data,
            options: {
                plugins: {
                filler: {
                    propagate: false,
                },
                title: {
                    display: true,
                    text: "Grafik Piutang Berdasarkan Bulan"
                }
                },
                pointBackgroundColor: '#fff',
                radius: 10,
                interaction: {
                intersect: false,
                }
            },
        };
        new Chart(ctx, config);
    }



    function v_unit_kerja(r){
        const ctx = document.getElementById('chart-unit-kerja');
        const data = {
            labels: r.labels,
            datasets: [
                {
                    label: 'Piutang',
                    data: r.data,
                    borderColor: "#36a2eb",
                    backgroundColor: "#36a2eb",
                }
            ]
        };
        const config = {
            type: 'line',
            data: data,
            options: {
                responsive: true,
                plugins: {
                legend: {
                    position: 'top',
                },
                title: {
                    display: true,
                    text: 'Graik Piutang Berdasarkan Unit Kerja'
                }
                }
            },
        };
        new Chart(ctx, config);
    }

    function v_umur(r){
        const ctx = document.getElementById('chart-umur');
        const data = {
            labels: r.labels,
            datasets: [
                {
                    label: 'Piutang',
                    data: r.data,
                    borderColor: "#36a2eb",
                    backgroundColor: "#36a2eb",
                }
            ]
        };
        const config = {
            type: 'line',
            data: data,
            options: {
                responsive: true,
                plugins: {
                legend: {
                    position: 'top',
                },
                title: {
                    display: true,
                    text: 'Graik Piutang Berdasarkan Unit Kerja'
                }
                }
            },
        };
        new Chart(ctx, config);
            
        
    }

    
   
    
    
    
</script>
@endsection