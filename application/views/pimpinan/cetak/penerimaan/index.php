<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <style type="text/css">
		@page  {
			width:10in;
			height:10.23in;
			margin:2cm 0px 2cm;
		}
		body {
			width:10in;
			height:10.23in;
			margin:auto;
			/*border:#000 solid 1px;*/
		}
		.container{
		    display: grid;
		    grid-template-columns: 1fr 1fr 1fr 1fr;
		}
		.bordered {
			/*border:1px dotted #000;*/
		}
		.border {
		    border-style: solid; border-width: 1px; padding: 0;
			border-spacing: 0;
		}
		/** Define the header rules **/
        header {
            position: fixed;
            top: -2cm;
            left: 0cm;
            right: 0.5cm;
            height: 1cm;

            /** Extra personal styles **/
            font-size: 7pt;
            color: black;
            text-align: right;
            line-height: 1cm;
        }

        /** Define the footer rules **/
        footer {
            position: fixed; 
            bottom: -1cm; 
            left: 0cm; 
            right: 0cm;
            height: 1cm;

            /** Extra personal styles **/
            font-size: 7pt;
            color: black;
            text-align: center;
            line-height: 1.5cm;
        }
	</style>

    <title><?= $judul ?></title>
  </head>
  <body>

  	<!-- Define header and footer blocks before your content -->
    <header>
        <?= date('r') ?>
    </header>

    <footer>
        Copyright &copy; <?php echo date("Y");?> 
    </footer>
	
	<table style="margin:auto;" class="bordered">
		<tr class="bordered">
			<td class="bordered">
				<img
					src="<?= base_url('vendor'); ?>/profil/rsm.png"
					style="width:70px;">
			</td>
			<td class="bordered" style="font-size:16pt;">
				<center><strong>
					LAPORAN PENERIMAAN<br>
					PT. RIAU SAMUDRA MANDIRI<br>
					BULAN 
					<?= $bulanawal == '1' ? 'JANUARI' : '' ?>
					<?= $bulanawal == '2' ? 'FEBRUARI' : '' ?>
					<?= $bulanawal == '3' ? 'MARET' : '' ?>
					<?= $bulanawal == '4' ? 'APRIL' : '' ?>
					<?= $bulanawal == '5' ? 'MEI' : '' ?>
					<?= $bulanawal == '6' ? 'JUNI' : '' ?>
					<?= $bulanawal == '7' ? 'JULI' : '' ?>
					<?= $bulanawal == '8' ? 'AGUSTUS' : '' ?>
					<?= $bulanawal == '9' ? 'SEPTEMBER' : '' ?>
					<?= $bulanawal == '10' ? 'OKTOBER' : '' ?>
					<?= $bulanawal == '11' ? 'NOVEMBER' : '' ?>
					<?= $bulanawal == '12' ? 'DESEMBER' : '' ?>

					<?= $bulanakhir != $bulanawal && $bulanakhir == '1' ? 'JANUARI' : '' ?>
					<?= $bulanakhir != $bulanawal && $bulanakhir == '2' ? 'FEBRUARI' : '' ?>
					<?= $bulanakhir != $bulanawal && $bulanakhir == '3' ? 'MARET' : '' ?>
					<?= $bulanakhir != $bulanawal && $bulanakhir == '4' ? 'APRIL' : '' ?>
					<?= $bulanakhir != $bulanawal && $bulanakhir == '5' ? 'MEI' : '' ?>
					<?= $bulanakhir != $bulanawal && $bulanakhir == '6' ? 'JUNI' : '' ?>
					<?= $bulanakhir != $bulanawal && $bulanakhir == '7' ? 'JULI' : '' ?>
					<?= $bulanakhir != $bulanawal && $bulanakhir == '8' ? 'AGUSTUS' : '' ?>
					<?= $bulanakhir != $bulanawal && $bulanakhir == '9' ? 'SEPTEMBER' : '' ?>
					<?= $bulanakhir != $bulanawal && $bulanakhir == '10' ? 'OKTOBER' : '' ?>
					<?= $bulanakhir != $bulanawal && $bulanakhir == '11' ? 'NOVEMBER' : '' ?>
					<?= $bulanakhir != $bulanawal && $bulanakhir == '12' ? ' SAMPAI DESEMBER' : '' ?> TAHUN <?= date('Y') ?><br>
				</strong></center>
			</td>
		</tr>
	</table>

	<br>
	<table style="width:100%;margin: auto;" class="border">
		<thead style="font-size:12pt; background-color: #A9A9A9;">
		  <tr>
			<th class="border" style="text-align: center; height: 3em; width: 5%">No</th>
			<th class="border" style="text-align: center; width: 15%; margin-right: 1em">Tanggal</th>
			<th class="border" style="text-align: center;width: 20%">Uraian</th>
			<th class="border" style="text-align: center; width: 17%">Jumlah</th>
			<th class="border" style="text-align: center; width: 43%">Keterangan</th>
		  </tr>
		</thead>
		<tbody style="font-size:10pt;">
		  <?php $i = 1; foreach ($penerimaan as $row) : ?>
		  <tr>
			<td class="border" style="text-align: center; height: 2em"><?= $i++ ?></td>
			<td class="border"><?= $row->tanggal ?></td>
			<td class="border"><?= $row->uraian ?></td>
			<td class="border">Rp <?= number_format($row->satuan,0,',','.') ?>,-</td>
			<td class="border"><?= $row->keterangan ?></td>
		  </tr>
		  <?php endforeach; ?>
		</tbody>
		<tfoot>
          <tr>
            <th class="border" colspan="3" style="text-align: center; height: 2em">Total</th>
            <th class="border" style="text-align: left;">Rp <?= number_format($total->sum,0,',','.') ?>,-</th>
            <th class="border"></th>
          </tr>
        </tfoot>
	</table>
  </body>
</html>

