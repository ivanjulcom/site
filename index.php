<!DOCTYPE html>
<html>
<head>
	<title>Api Mengubah Waktu Menjadi Text</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<script type="text/javascript" src="jquery.min.js"></script>
	<script type="text/javascript" src="jquery.dataTables.min.js"></script>
</head>
<body>
	<h2>1. Api untuk mengubah waktu menjadi text.</h2>
	<h3 >Input Waktu</h3>
	<form>
		<input class="posisi-tengah" type="time" name="waktu">
		
	</form>
	<button id="btn_simpan" class="posisi-tengah" >Simpan</button>
	<p class="posisi-tengah" id="output">Output</p>

</body>
<body>
	<h2>2. API RESTful barang inventoris (input,edit,delete,view).</h2>
	<h3 >Input Data Inventoris</h3>
	<form>
		<input style="display: none;" type="text" name="id">
		<input class="posisi-tengah" type="text" name="nama" placeholder="Nama">
		<input class="posisi-tengah" type="text" name="harga" placeholder="Harga">
		<textarea class="posisi-tengah" name="deskripsi" placeholder="Deskripsi"></textarea>
	</form>
	<button class="posisi-tengah" onclick="post_inventoris()"><div id="simpan">Simpan</div></button>
	<p class="posisi-tengah" id="output_inventoris">Output</p>
	<h3 >Tabel Inventoris</h3>
	<table id="tabel" style="width: 250px; margin-top: 20px; margin-bottom: 20px;" border="1">
		<thead>
			<tr>
				<th>Nama</th>
				<th>Harga</th>
				<th>Deskripsi</th>
				<th>Edit</th>
				<th>Hapus</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>-</td>
				<td>-</td>
				<td>-</td>
				<td>-</td>
				<td>-</td>
			</tr>
		</tbody>

	</table>
</body>
<body>
	<h2>3. Buat algoritma sederhana duplikat huruf pertama.</h2>
	<h3 >Input huruf</h3>
	<form>
		<input class="posisi-tengah" type="text" name="huruf">
		
	</form>
	<button id="btn_cek_huruf" class="posisi-tengah" >Cek</button>
	<p class="posisi-tengah" id="output_cek">Output</p>

</body>
<body>
	<h2>4. Bubble sort tanpa temporary variabel.</h2>
	<h3 >Input</h3>
	<form>
		<input class="posisi-tengah" type="number" name="x" placeholder="x">
		<input class="posisi-tengah" type="number" name="y" placeholder="y">
		
	</form>
	<button id="btn_bubble" class="posisi-tengah" >Urutkan</button>
	<p class="posisi-tengah" id="output_bubble">Output</p>

</body>
<script type="text/javascript">
	$(document).ready(function(){
		waktu();
		get_inventoris();
		edit_inventoris();
		hapus_inventoris();
		cek_input();
		bubble_sort();
		
	});
	function waktu(){
		$('#btn_simpan').click(function(e){
			var waktu = $("[name='waktu']").val();
			if(waktu==""){
				var alerts=alert();
				$("#output").text(alerts);

			}else{
				$.ajax({
					type: 'POST',
					url: 'http://localhost/site/api_waktu.php',
					dataType: 'JSON',
					data: {waktu:waktu},
					success: function(data){
						$.each(data,function(){
							$("#output").text(data.result);
							console.log(data);
						});

					}, error: function(){
						alert("Gagal mengambil data.");

					}
				});
			}
			
		});
	}
	function post_inventoris(){
		var id = $("[name='id']").val();
		var nama = $("[name='nama']").val();
		var harga = $("[name='harga']").val();
		var deskripsi = $("[name='deskripsi']").val();
		if (nama==""||harga==""||deskripsi=="") {
			var alerts=alert();
			$("#output_inventoris").text(alerts);
		}else{
			$.ajax({
				type: 'POST',
				url: 'http://localhost/site/post_inventoris.php',
				dataType: 'JSON',
				data: {id:id,nama:nama,harga:harga,deskripsi:deskripsi},
				success: function(data){
					$.each(data,function(){
						$("#output_inventoris").text(data.msg);
						alert("Berhasil.");
						location.reload();
						console.log(data.msg)
					});

				}, error: function(){
					alert("Gagal mengirim data.");

				}
			});

		}
	}
	function get_inventoris(){
		$.ajax({
			type: 'GET',
			url: 'http://localhost/site/get_inventoris.php',
			dataType: 'JSON',
			success: function(data){
				$('#tabel').dataTable( {
			        "aaData": data,
			        "columns": [
			            { "data": "nama" },
			            { "data": "harga" },
			            { "data": "deskripsi" },
			            { "data": "edit" },
			            {"data": "hapus"}
			        ]
			    });
			    


			}, error: function(){
				alert("Gagal mengirim data.");

			}
		});
	}
	function edit_inventoris(){
		$('#tabel').on('click','.edit',function(){
			var id = $(this).attr('data-id');
			var nama = $(this).attr('data-nama');
			var harga = $(this).attr('data-harga');
			var deskripsi = $(this).attr('data-deskripsi');
			$("[name='id']").val(id);
			$("[name='nama']").val(nama);
			$("[name='harga']").val(harga);
			$("[name='deskripsi']").val(deskripsi);
			$("#simpan").text("Ubah");

			
		});
	}
	function hapus_inventoris(){
		$('#tabel').on('click','.hapus',function(){
			var id = $(this).attr('data-id');
			$.ajax({
				type:'POST',
				url:'http://localhost/site/hapus_inventoris.php',
				dataType:'JSON',
				data:{id:id},
				success:function(data){
					$.each(data,function(){
						$(".hapus").text(data.msg);
						location.reload();
					});			

				},error:function(){
					alert("Gagal menghapus");
				}

			})
			
			
		});
	}
	function cek_input(){
		$("#btn_cek_huruf").on("click",function(){
			var input = $("[name='huruf']").val();
			var hasil="";
			var charRepeats = function(str) {
		    for (var i=0; i<str.length; i++) {
		      if ( str.indexOf(str[i]) !== str.lastIndexOf(str[i]) ) {
		      	hasil=str[i];
		        return hasil; 
		      }
		    }
		    hasil="Tidak ada duplikat";
		  	return hasil;
			}
			var pesan = charRepeats(input);
			$("#output_cek").text(pesan);
			console.log(pesan);
		});
		
	}
	function bubble_sort(){
		$('#btn_bubble').click(function(e){
			var x = $("[name='x']").val();
			var y = $("[name='y']").val();
			if(x==""||y==""){
				var alerts=alert();
				$("#output_bubble").text(alerts);

			}else{
				$.ajax({
					type: 'POST',
					url: 'http://localhost/site/bubble_sort.php',
					dataType: 'JSON',
					data: {x:x,y:y},
					success: function(data){
						$.each(data,function(){
							$("#output_bubble").text(data.result);
							console.log(data);
						});

					}, error: function(){
						alert("Gagal mengambil data.");

					}
				});
			}
			
		});

	}
	function alert(){
		var notif = "Input tidak boleh kosong!";
		return notif;
	}
</script>
</html>