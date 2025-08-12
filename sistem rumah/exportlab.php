<?php
require 'function.php';
require 'cek.php';
?>
<html>
<head>
  <title>Tabel Data</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.6.5/css/buttons.dataTables.min.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
  <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
</head>

<body>
<div class="container">
			<h2>Tabel Data</h2>
			<h4>(Inventory)</h4>
				<div class="data-tables datatable-dark">
					
                <table class="table table-bordered" id="mauexport" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Lokasi</th>
                                            <th>Tipe Lokasi</th>
                                            <th>Latitude</th>
                                            <th>Longitude</th>
                                            <th>Alamat</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                       <?php
                                        $ambilsemuadatalab = mysqli_query($conn, "select * from lab");
                                        $i= 1;
                                        while($data=mysqli_fetch_array($ambilsemuadatalab)){
                                            $nama_lokasi = $data['nama_lokasi'];
                                            $tipe_lokasi = $data['tipe_lokasi'];
                                            $latitude = $data['latitude'];
                                            $longitude = $data['longitude'];
                                            $alamat = $data['alamat'];
                                            $idlab =$data['idlab'];
                                        ?>
                                        <tr>
                                            <td><?=$i++;?></td>
                                            <td><?php echo $nama_lokasi;?></td>
                                            <td><?php echo $tipe_lokasi;?></td>
                                            <td><?php echo $latitude;?></td>
                                            <td><?php echo $longitude;?></td>
                                            <td><?php echo $alamat;?></td>
                                            
                                        </tr>
                                      
                                        </div>
                                        <?php
                                        };
                                        ?>
                                    </tbody>
                                    </table>
                                </div>
                            </div>
</div>
	
<script>
$(document).ready(function() {
    $('#mauexport').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'copy','csv','excel', 'pdf', 'print'
        ]
    } );
} );

</script>

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.5/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.print.min.js"></script>

	

</body>

</html>