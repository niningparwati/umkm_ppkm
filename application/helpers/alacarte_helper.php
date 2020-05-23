<?php

function call_datatable($table){
	$dt = "
	<script type=\"text/javascript\">
	    \$(document).ready(function () {
	        \$('".$table."').DataTable({
	            responsive: true
	        });
	    });
	</script>";
	return $dt;
}

function swal_delete($table, $button) {
	$delete = 
		"<script>
		\$(document).ready(function () {
	        \$('".$table."').on('click', '".$button."', function(e){
	            e.preventDefault();
	            const remove = \$(this).attr('href');
	            Swal.fire({
	                title: 'Apakah anda yakin?',
	                text: 'Menghapus data ini',
	                type: 'warning',
	                showCancelButton: true,
	                confirmButtonColor: '#3085d6',
	                cancelButtonColor: '#d33',
	                confirmButtonText: 'Ya, Hapus!'
	            }).then((result) => {
	                if (result.value) {
	                   document.location.href = remove;
	                }
	            })
	        });
	    });
	</script>";
    return $delete;
}

