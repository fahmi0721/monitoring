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
        <div class="box box-info">
            <div class="box-header with-border">
                <h2 class="box-title text-center"><i class='fa fa-line-chart text-info'></i> Performance PBL</h2>
            </div>
            <div class="box-body">
                <div class="chart">
                    <canvas id="revenue-chart" style="height: 300px;"></canvas>
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
    })
    function getPbl(){
        $.ajax({
            type : "GET",
            dataType: "json",
            url : "{{ asset('api/grafikpbl') }}",
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

    function getPendapatan(){
        $.ajax({
            type : "GET",
            dataType: "json",
            url : "{{ asset('api/pendapatan') }}",
            cache: false,
            success: function(res){
                console.log(res);
                const ctx = document.getElementById('pendapatanbar');
                const labels = ["Januari","Februari","Maret","April"];
                const data = {
                    labels: labels,
                    datasets: [
                        {
                        label: 'Pendapatan Penyedia Jasa Pengamanan',
                        data: [18785,39374,60097,80895],
                        borderColor: "#ff7f50",
                        backgroundColor: "rgba(255, 127, 80,0.8)",
                        },
                        {
                        label: 'Pendapatan Penyedia Cleaning Service',
                        data: [1669,3682,6103,9656],
                        borderColor: "#34ace0",
                        backgroundColor: "rgba(52, 172, 224,0.8)",
                        }
                    ]
                };

                const config = {
                    type: 'bar',
                    data: data,
                    options: {
                        responsive: true,
                        plugins: {
                        legend: {
                            position: 'top',
                        },
                        title: {
                            display: true,
                            text: 'Grafik Pendapatan (Juta)'
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

    function getBiaya(){
        $.ajax({
            type : "GET",
            dataType: "json",
            url : "{{ asset('api/beban') }}",
            cache: false,
            success: function(res){
                console.log(res);
                const ctx = document.getElementById('bebanbar');
                const labels = ["Januari","Februari","Maret","April"];
                const data = {
                    labels: labels,
                    datasets: [
                        {
                        label: 'Beban Penghasilan',
                        data: [2173,4619,68715,98929],
                        borderColor: "#eb4d4b",
                        backgroundColor: "rgba(235, 77, 75,0.8)",
                        },
                        {
                        label: 'Beban Bahan',
                        data: [1264,2304,36446,12606],
                        borderColor: "#34ace0",
                        backgroundColor: "rgba(52, 172, 224,0.8)",
                        }
                    ]
                };

                const config = {
                    type: 'bar',
                    data: data,
                    options: {
                        responsive: true,
                        plugins: {
                            legend: {
                                position: 'top',
                            },
                            title: {
                                display: true,
                                text: 'Grafik Pendapatan (Juta)'
                            }
                        },
                        indexAxis: 'y',
                        elements: {
                            bar: {
                                borderWidth: 2,
                            }
                        },
                        
                    },
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