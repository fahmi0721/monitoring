@extends("master_lte")
@section("title-page", "")

@section('breadcrumb')
<section class="content-header">
  <h1>
    Dashboard
    <small>Control Panel</small>
  </h1>
  <ol class="breadcrumb">
    <li class="active"><i class="fa fa-dashboard"></i> Dashboard</li>
  </ol>
</section>
@endsection


@section('konten')
<div class="row">
    @php
        $icon_arr = array("fa-gg","fa-tag","fa-book");
        $bg = array("bg-red","bg-green","bg-blue");
    @endphp
    <div class="col-md-4 col-sm-6 col-xs-12">
        <div class="info-box bg-red">
            <span class="info-box-icon"><i class="fa fa-money"></i></span>
            <div class="info-box-content">
                <span class="info-box-tex">Proyek Belum Ditagih</span>
                <span class="info-box-number">100</span>
                <div class="progress">
                    <div class="progress-bar" style="width: 30%"></div>
                </div>
                <span class="progress-description">30% yang belum ditagihkan</span>
            </div>
        </div>
    </div>

    <div class="col-md-4 col-sm-6 col-xs-12">
        <div class="info-box bg-orange">
            <span class="info-box-icon"><i class="fa fa-hourglass-2"></i></span>
            <div class="info-box-content">
                <span class="info-box-tex">Proyek Telah Ditagihkan</span>
                <span class="info-box-number">20</span>
                <div class="progress">
                    <div class="progress-bar" style="width: 20%"></div>
                </div>
                <span class="progress-description">20% yang telah ditagihkan</span>
            </div>
        </div>
    </div>

    <div class="col-md-4 col-sm-6 col-xs-12">
        <div class="info-box bg-green">
            <span class="info-box-icon"><i class="fa fa-check"></i></span>
            <div class="info-box-content">
                <span class="info-box-tex">Proyek Telah Terbayar</span>
                <span class="info-box-number">50</span>
                <div class="progress">
                    <div class="progress-bar" style="width: 50%"></div>
                </div>
                <span class="progress-description">50% yang telah terbayar</span>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="box box-success">
            <div class="box-header with-border">
                <h2 class="box-title text-center"><i class='fa fa-line-chart text-info'></i> Performance PBL Tahun {{ date("Y") }}</h2>
            </div>
            <div class="box-body">
                <div class="chart">
                    <canvas id="revenue-chart" style="height: 300px;"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="box box-success">
            <div class="box-header with-border">
                <h2 class="box-title text-center"><i class='fa fa-bar-chart text-info'></i> Performance Arus Kas Tahun {{ date("Y") }}</h2>
            </div>
            <div class="box-body">
                <div class="chart">
                    <canvas id="arus_kas" style="height: 300px;"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

    
@endsection
@section('script')
<script>
    $(document).ready(function(){
        getPbl();
        get_arus_kas();
    })

    function get_arus_kas(){
        $.ajax({
            type : "GET",
            dataType: "json",
            url : "{{ asset('api/aruskas') }}",
            cache: false,
            success: function(res){
                var iData = res.data;
                console.log(iData);
                const ctx = document.getElementById('arus_kas');
                const data = {
                labels: iData.labels,
                datasets: [
                        {
                        label: 'Saldo Awal',
                        data: iData.dataset.data.saldo_awal,
                        borderColor: iData.dataset.color.saldo_awal,
                        backgroundColor: iData.dataset.color.saldo_awal,
                        },

                        {
                        label: 'Penerimaan',
                        data: iData.dataset.data.penerimaan,
                        borderColor: iData.dataset.color.penerimaan,
                        backgroundColor: iData.dataset.color.penerimaan,
                        },

                        {
                        label: 'Penegeluaran',
                        data: iData.dataset.data.pengeluaran,
                        borderColor: iData.dataset.color.pengeluaran,
                        backgroundColor: iData.dataset.color.pengeluaran,
                        },
                        
                    ]
                };
                const config = {
                type: 'bar',
                data: data,
                options: {
                        indexAxis: 'y',
                        // Elements options apply to all of the options unless overridden in a dataset
                        // In this case, we are setting the border of each horizontal bar to be 2px wide
                        elements: {
                        bar: {
                            borderWidth: 2,
                        }
                        },
                        responsive: true,
                        plugins: {
                        legend: {
                            position: 'right',
                        },
                        title: {
                            display: true,
                            text: 'Grafik Arus KAS'
                        }
                        }
                    },
                };
                new Chart(ctx, config);
            },
            error: function(er){
                console.log(er);
            }
        })
    }
    function getPbl(){
        $.ajax({
            type : "GET",
            dataType: "json",
            url : "{{ asset('api/grafik') }}",
            cache: false,
            success: function(res){
                var iData = res.data;
                const ctx = document.getElementById('revenue-chart');
                const data = {
                    labels: iData.labels,
                    datasets: [
                        {
                        label: 'Laba Rugi',
                        data: iData.laba_rugi,
                        borderColor: "#2ecc71",
                        backgroundColor: "rgba(46, 204, 113,0.8)",
                        pointStyle: 'rectRounded',
                        pointRadius: 6,
                        pointHoverRadius: 8
                        },

                        {
                        label: 'Pendapatan',
                        data: iData.pendapatan,
                        borderColor: "#3498db",
                        backgroundColor: "rgba(52, 152, 219,0.8)",
                        pointStyle: 'rectRounded',
                        pointRadius: 6,
                        pointHoverRadius: 8
                        },

                        {
                        label: 'Beban',
                        data: iData.beban,
                        borderColor: "#e67e22",
                        backgroundColor: "rgba(230, 126, 34,0.8)",
                        pointStyle: 'rectRounded',
                        pointRadius: 6,
                        pointHoverRadius: 8
                        }
                    ]
                };
                const config = {
                    type: 'line',
                    data: data,
                    options: {
                        responsive: true,
                        plugins: {
                        title: {
                            display: true,
                            text: (ctx) => 'Grafik PBL',
                            }
                        }
                    }
                };
                new Chart(ctx, config);
            },
            error: function(er){
                console.log(er);
            }
        })
    }
</script>
@endsection