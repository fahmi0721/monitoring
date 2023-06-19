@extends("master_lte")
@section("title-page", "Grafik Arus Kas - ")

@section('breadcrumb')
<section class="content-header">
  <h1>
    Garfik
    <small>Arus Kas</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{ url('/') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li class="active"><i class="fa fa-line-chart"></i> grafik Arus Kas</li>
  </ol>
</section>
@endsection


@section('konten')
<div class="row">
    <div class="col-md-6 col-sm-6 col-xs-12">
        <div class="box box-success">
            <div class="box-header with-border">
                <h2 class="box-title text-center"><i class='fa fa-tag text-success'></i> Grafik Arus Kas</h2>
            </div>
            <div class="box-body">
            <form action="javascript:void(0)" id='FormData'>
                @csrf
                <div class="form-group">
                    <label for="tahun" autocomplete=off class='control-label'>Tahun <span class='text-danger'>*</span></label>
                    <select name="tahun" id="tahun" class="form-control">
                        <option value="">..:: Pilih Tahun ::..</option>
                        @for($i=2022; $i<= date("Y"); $i++)
                        <option value="{{ $i }}" @if($i == Request::segment(2)) selected @endif>Tahun {{ $i }}</option>
                        @endfor
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
                <h2 class="box-title text-center"><i class='fa fa-line-chart text-success'></i> Performance Saldo Awal Arus <span class='Tahun'></span></h2>

            </div>
            <div class="box-body">
                <div class="chart">
                    <canvas id="chart-saldo-awal" style="height: 250px;"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6 col-sm-6 col-xs-12">
        <div class="box box-success">
            <div class="box-header with-border">
                <h2 class="box-title text-center"><i class='fa fa-bar-chart text-success'></i> Performance Penerimaan Arus Kas <span class='Tahun'></span></h2>
            </div>
            <div class="box-body">
                <div class="chart">
                    <canvas id="chart-penerimaan" style="height: 250px;"></canvas>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6 col-sm-6 col-xs-12">
        <div class="box box-success">
            <div class="box-header with-border">
                <h2 class="box-title text-center"><i class='fa fa-line-chart text-success'></i> Performance Pengeluaran Arus Kas <span class='Tahun'></span></h2>
            </div>
            <div class="box-body">
                <div class="chart">
                    <canvas id="chart-pengeluaran" style="height: 250px;"></canvas>
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

    $("#FormData").submit(function(e){
        e.preventDefault();
        var tahun = $("#tahun").val();
        location.replace("{{ url('/grafik-arus-kas')}}/"+tahun);

    })

    function load_garfik(){
        $(".Tahun").html("{{Request::segment(2)}}");
        $.ajax({
            type : "POST",
            dataType: "json",
            url : "{{ asset('api/grafikaruskas') }}",
            data: "tahun={{ Request::segment(2) }}",
            cache: false,
            success: function(res){
                console.log(res);
                saldoawal(res.data.saldo_awal);
                penerimaan(res.data.penerimaan);
                pengeluaran(res.data.pengeluaran);
            },
            error: function(er){
                console.log(er);
            }
        })
    }
   
    function saldoawal(r){
        const ctx = document.getElementById('chart-saldo-awal');
        const data = {
            labels: r.labels,
            datasets: [
                {
                label: 'Saldo Awal',
                data: r.data,
                borderColor: "#2bcbba",
                backgroundColor: "rgba(43, 203, 186,0.8)",
                fill: false
                },
                
            ]
        };
        const config = {
            type: 'line',
            data: data,
            options: {
                plugins: {
                filler: {
                    propagate: false,
                },
                title: {
                    display: true,
                    text: "Grafik Saldo Awal"
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



    function penerimaan(r){
        var iData = r.dataset;
        const ctx = document.getElementById('chart-penerimaan');
        const data = {
            labels: r.labels,
            datasets: r.dt_set
        };
        console.log(data);
        const config = {
            type: 'bar',
            data: data,
            options: {
                responsive: true,
                plugins: {
                legend: {
                    position: 'top',
                    labels: {
                        usePointStyle: true,
                    },
                },
                title: {
                    display: true,
                    text: 'Grafik Penerimaan Arus Kas Berdasarkan Aktivitas'
                }
                }
            },
        };
        new Chart(ctx, config);
            
        
    }

    function pengeluaran(r){
        var iData = r.dataset;
        const ctx = document.getElementById('chart-pengeluaran');
        const data = {
            labels: r.labels,
            datasets: r.dt_set
        };
        console.log(data);
        const config = {
            type: 'bar',
            data: data,
            options: {
                responsive: true,
                plugins: {
                legend: {
                    position: 'top',
                    labels: {
                        usePointStyle: true,
                    },
                },
                title: {
                    display: true,
                    text: 'Grafik Pengeluaran Arus Kas Berdasarkan Aktivitas'
                }
                }
            },
        };
        new Chart(ctx, config);
            
        
    }

    
   
    
    
    
</script>
@endsection