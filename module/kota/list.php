<div id="frame-tambah">
	<a href="<?php echo BASE_URL."index.php?page=my_profile&module=kota&action=form"; ?>" class="tombol-action">+ Tambah Kota</a>
</div>

<?php
	
	$pagination = isset($_GET["pagination"]) ? $_GET["pagination"] : 1;
    $data_per_halaman = 3;
    $mulai_dari = ($pagination-1) * $data_per_halaman;

    $no = 1 + $mulai_dari;

	$queryKota = mysqli_query($koneksi, "SELECT * FROM kota LIMIT $mulai_dari, $data_per_halaman");

	if(mysqli_num_rows($queryKota) == 0){
		echo "Saat ini belum ada data di dalam table kota";
	} else {
		echo "<table class='table-list'>";

		echo "<tr class='baris-title'>
				<th class='kolom-nomor'>No</th>
				<th class='kiri'>Kota</th>
				<th class='kiri'>Tarif</th>
				<th class='tengah'>Status</th>
				<th class='tengah'>Action</th>
			  </tr>";

		while($row=mysqli_fetch_assoc($queryKota)){
			echo "<tr>
					<td class='kolom-nomor'>$no</td>
					<td class='kiri'>$row[kota]</td>
					<td class='kiri'>$row[tarif]</td>
					<td class='tengah'>$row[status]</td>
					<td class='tengah'>
						<a class='tombol-action' href='".BASE_URL."index.php?page=my_profile&module=kota&action=form&kota_id=$row[kota_id]'>Edit</a>
					</td>
				  </tr>";
		$no++;
		}
		echo "</table>";

		$queryHitungKota = mysqli_query($koneksi, "SELECT * FROM kota");
        pagination($queryHitungKota, $data_per_halaman, $pagination, "index.php?page=my_profile&module=kota&action=list");

	}
?>