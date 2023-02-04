<!DOCTYPE html>
<html lang="en">
<?php $this->load->view($header); ?>

<body>
  <div id="app">
    <div class="main-wrapper">
      <div class="navbar-bg"></div>
      <!-- Navbar -->
      <?php $this->load->view($navbar); ?>
      <!-- Navbar Ends -->

      <!-- Sidebar -->
      <?php $this->load->view($sidebar); ?>
      <!-- Sidebar Ends -->
      
      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1><?= $judul; ?></h1>
          </div>

          <!-- Content -->
            <div class="row">
              <div class="col-lg-4 col-md-4 col-sm-12">
                <div style="min-height: 205px; max-height: 205px" class="card card-statistic-2">
                  <div class="card-stats">
                    <div class="card-stats-title">KAS - 
                      <div class="dropdown d-inline">
                        <a class="font-weight-600 dropdown-toggle" data-toggle="dropdown" href="#" id="bulan"><?= date('F') ?></a>
                        <ul class="dropdown-menu dropdown-menu-sm">
                          <li class="dropdown-title">Select Month</li>
                          <?php foreach ($bulan as $key) : ?>
                          <li><a href="#" id="terpilih<?= $key->value; ?>" onclick="filter(<?= $key->value; ?>)" class="dropdown-item <?= $key->value == date('m') ? 'active activebulan' : '' ?>"><?= $key->bulan; ?></a></li>
                          <?php endforeach; ?>
                        </ul>
                      </div>
                    </div>
                    <div class="card-stats-items">
                      <div class="card-stats-item ml-auto" style="min-width: 150px;">
                        <div  id="debit" class="card-stats-item-count" style="font-size: 13px; color: black;"></div>
                        <div class="card-stats-item-label text-muted"><strong>Penerimaan</strong></div>
                      </div>
                      <div class="card-stats-item mr-auto" style="min-width: 150px;">
                        <div id="kredit" class="card-stats-item-count" style="font-size: 13px; color: black"></div>
                        <div class="card-stats-item-label text-muted"><strong>Pengeluaran</strong></div>
                      </div>
                    </div>
                  </div>
                  <div class="card-icon shadow-primary bg-primary">
                    <i class="fas fa-wallet"></i>
                  </div>
                  <div class="card-wrap">
                    <div class="card-header">
                      <h4>Saldo</h4>
                    </div>
                    <div id="saldo" style="font-size: 20px" class="card-body"></div>
                  </div>
                </div>
              </div>
              <div class="col-lg-4 col-md-4 col-sm-12">
                <div style="min-height: 205px; max-height: 205px" class="card card-statistic-2">
                  <div class="card-chart">
                    <canvas id="balance-chart" height="80"></canvas>
                  </div>
                  <div class="card-icon shadow-primary bg-primary">
                    <i class="fas fa-dollar-sign"></i>
                  </div>
                  <div class="card-wrap">
                    <div class="card-header">
                      <h4>Pembayaran SPBJ</h4>
                    </div>
                    <div id="spbj" style="font-size: 20px" class="card-body"></div>
                  </div>
                </div>
              </div>
              <div class="col-lg-4 col-md-4 col-sm-12">
                <div style="min-height: 205px; max-height: 205px" class="card card-statistic-2">
                  <div class="card-chart">
                    <canvas id="sales-chart" height="80"></canvas>
                  </div>
                  <div class="card-icon shadow-primary bg-primary">
                    <i class="fas fa-shopping-bag"></i>
                  </div>
                  <div class="card-wrap">
                    <div class="card-header">
                      <h4>Pengeluaran Pimpinan</h4>
                    </div>
                    <div id="pimpinan" style="font-size: 20px" class="card-body"></div>
                  </div>
                </div>
              </div>
              <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                  <div class="card-icon bg-info">
                    <i class="fas fa-file-invoice-dollar"></i>
                  </div>
                  <div class="card-wrap">
                    <div class="card-header">
                      <h4>Total Data Penerimaan</h4>
                    </div>
                    <div class="card-body">
                      <?= $debitCount->count ?>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                  <div class="card-icon bg-danger">
                    <i class="fas fa-file-invoice-dollar"></i>
                  </div>
                  <div class="card-wrap">
                    <div class="card-header">
                      <h4>Total Data Pengeluaran</h4>
                    </div>
                    <div style="font-size: 20px" class="card-body">
                      <?= $kreditCount->count ?>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                  <div class="card-icon bg-warning">
                    <i class="fas fa-file-invoice-dollar"></i>
                  </div>
                  <div class="card-wrap">
                    <div class="card-header">
                      <h4>Total Data Pembayaran SPBJ</h4>
                    </div>
                    <div style="font-size: 20px" class="card-body">
                      <?= $spbjCount->count ?>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                  <div class="card-icon bg-success">
                    <i class="fas fa-file-invoice-dollar"></i>
                  </div>
                  <div class="card-wrap">
                    <div class="card-header">
                      <h4>Total Data Pengeluaran Pimpinan</h4>
                    </div>
                    <div style="font-size: 20px" class="card-body">
                      <?= $pimpinanCount->count ?>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          <!-- Content Ends -->

          <!-- Content -->
          <div class="section-body">
              <div class="row">
                <div class="col-md-12">
                  <div class="card">
                    <figure style="width: 100%" class="highcharts-figure">
                      <div id="container" style="height: 30rem;"></div>
                      <div id="sliders">
                        <table>
                          <tr>
                            <td><label for="alpha">Alpha Angle</label></td>
                            <td><input id="alpha" type="range" min="0" max="45" value="15"/> <span id="alpha-value" class="value"></span></td>
                          </tr>
                          <tr>
                            <td><label for="beta">Beta Angle</label></td>
                            <td><input id="beta" type="range" min="-45" max="45" value="15"/> <span id="beta-value" class="value"></span></td>
                          </tr>
                          <tr>
                            <td><label for="depth">Depth</label></td>
                              <td><input id="depth" type="range" min="20" max="100" value="100"/> <span id="depth-value" class="value"></span></td>
                          </tr>
                        </table>
                      </div>
                    </figure>
                  </div>
                </div>
              </div>
          </div>
          <!-- Content Ends -->

          <!-- Content -->
          <div class="section-body">
            <div class="row">
              <div class="col-md-12">
                <div class="card">
                  <figure style="width: 100%" class="highcharts-figure">
                    <div id="pie" style="height: 30rem;"></div>
                  </figure>
                </div>
              </div>
            </div>
          </div>
          <!-- Content Ends -->

        </section>
      </div>
      <!-- Main Content Ends -->

      <!-- Footer -->
      <?php $this->load->view($footer); ?>
      <!-- Footer Ends -->
      
    </div>
  </div>

  <!-- Modal -->
    
  <!-- Modal Ends -->

  
  <!-- General JS Scripts -->
  <?php $this->load->view($script_general); ?>
  <!-- General JS Scripts Ends -->

  <!-- Highcharts Scripts -->
  <script src="<?php echo base_url('vendor'); ?>/Highcharts-8.2.0/code/highcharts.js"></script>
  <script src="<?php echo base_url('vendor'); ?>/Highcharts-8.2.0/code/modules/exporting.js"></script>
  <script src="<?php echo base_url('vendor'); ?>/Highcharts-8.2.0/code/modules/export-data.js"></script>
  <script src="<?php echo base_url('vendor'); ?>/Highcharts-8.2.0/code/modules/accessibility.js"></script>
  <script src="<?php echo base_url('vendor'); ?>/Highcharts-8.2.0/code/highcharts-3d.js"></script>
  <!-- Highcharts Scripts Ends -->

  <script type="text/javascript">
    function sum(tahun1='', bulanawal='', bulanakhir=''){
      $.ajax({
          type  : 'POST',
          url   : '<?= base_url()?>pimpinan/laporan/saldo/get_sum',
            data:{
                      tahun1 : tahun1, 
                      bulanawal : bulanawal, 
                      bulanakhir : bulanakhir
                  },
          dataType : 'json',
          success : function(sum){
              var debit = 'Rp '+sum.debit+',-';
              var kredit = 'Rp '+sum.kredit+',-';
              var saldo = 'Rp '+sum.saldo+',-';
              var spbj = 'Rp '+sum.spbj+',-';
              var pimpinan = 'Rp '+sum.pimpinan+',-';
                  $('#debit').html(debit);
                  $('#kredit').html(kredit);
                  $('#saldo').html(saldo);
                  $('#spbj').html(spbj);
                  $('#pimpinan').html(pimpinan);
          }
      });
    }
    function filter(id) {

      $('.activebulan').removeClass('active');
      tahun1 = <?= date('Y') ?>;
      bulanawal = id;
      bulanakhir = id;
      var bulan = new Array('-', 'January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');
        $('#bulan').html(bulan[id]);
        $('#terpilih'+id).addClass('active activebulan');
        sum(tahun1, bulanawal, bulanakhir);
    }

    $(document).ready(function(){
      sum();
    });
    
  </script>

  <script type="text/javascript">
    // Set up the chart
    var chart = new Highcharts.Chart({
      chart: {
        renderTo: 'container',
        type: 'column',
        options3d: {
          enabled: true,
          alpha: 15,
          beta: 15,
          depth: 100,
          viewDistance: 25
        },
        shadow: {
          color: '#f7f8fa',
          width: 10,
          offsetX: 0,
          offsetY: 0
        },
        backgroundColor: {
          linearGradient: [500, 500, 0, 0],
          stops: [
            [0, 'rgb(255, 255, 255)'],
            [1, 'rgb(240, 240, 255)']
          ]
        },
      },
      title: {
        style: {
          color: '#000',
            font: 'bold 20px "Trebuchet MS", Verdana, sans-serif'
          },
            text: 'Grafik Keuangan PT. Riau Samudra Mandiri'
          },
          subtitle: {
            style: {
              color: '#000',
              font: 'bold 14px "Trebuchet MS", Verdana, sans-serif'
            },
            text: <?= json_encode('Tahun '.date('Y')) ?>
          },
          xAxis: {
            title: {
              style: {
                color: '#000',
                font: 'bold 14px "Trebuchet MS", Verdana, sans-serif'
              },
              text: 'Bulan'
            },
            categories: [ <?php foreach ($bulan as $b) {
              echo json_encode($b->bulan).',';
            } ?> ]
          },
          yAxis: {
            stackLabels: { 
                 enabled: true,
                       formatter: function() {
                             return Highcharts.numberFormat(this.total,  '.', '.', 0,);
                         },
                 },
             labels: {
               format: '{value:,.0f}',
            },
            title: {
              style: {
                color: '#000',
                font: 'bold 14px "Trebuchet MS", Verdana, sans-serif'
              },
              text: 'Rupiah (Rp)'
            }
          },
          plotOptions: {
            column: {
              depth: 25
            }
          },
          series: [{
            name : 'Penerimaan',
            data: [ <?php foreach ($debitSumByBulan as $d) {
              echo json_decode($d->sum).',';
            } ?> ]
          }, {
            name : 'Pengeluaran',
            data: [ <?php foreach ($kreditSumByBulan as $k) {
              echo json_decode($k->sum).',';;
            } ?>]
          }]
    });

    function showValues() {
      $('#alpha-value').html(chart.options.chart.options3d.alpha);
      $('#beta-value').html(chart.options.chart.options3d.beta);
      $('#depth-value').html(chart.options.chart.options3d.depth);
    }

    // Activate the sliders
    $('#sliders input').on('input change', function () {
      chart.options.chart.options3d[this.id] = parseFloat(this.value);
      showValues();
        chart.redraw(false);
    });

    showValues();
  </script>

  <script type="text/javascript">
        Highcharts.chart('pie', {
            chart: {
                type: 'pie',
                options3d: {
                    enabled: true,
                    alpha: 45,
                    beta: 0
                },
                shadow: {
                    color: '#f7f8fa',
                    width: 10,
                    offsetX: 0,
                    offsetY: 0
                },
                backgroundColor: {
                    linearGradient: [0, 0, 500, 500],
                    stops: [
                        [0, 'rgb(255, 255, 255)'],
                        [1, 'rgb(240, 240, 255)']
                    ]
                }
            },
            title: {
                style: {
                color: '#000',
                font: 'bold 20px "Trebuchet MS", Verdana, sans-serif'
            },
                text: 'Data Pengeluaran Berdasarkan Kebutuhan PT. RSM'
            },
            subtitle: {
                style: {
                        color: '#000',
                        font: 'bold 14px "Trebuchet MS", Verdana, sans-serif'
                },
                text: <?= json_encode('Bulan '.date('F')) ?>
            },
            accessibility: {
                point: {
                    valueSuffix: '%'
                }
            },
            tooltip: {
                pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    depth: 35,
                    dataLabels: {
                        enabled: true,
                        format: '{point.name}'
                    }
                }
            },
            series: [{
                type: 'pie',
                name: 'Total Pengeluaran',
                data: [
                      <?php foreach ($pie as $key) : ?>
                        [<?= json_encode($key->uraian).','.json_decode($key->sum) ?>],   
                      <?php endforeach ?>
                ]
            }]
        });
      </script>





</body>
</html>
