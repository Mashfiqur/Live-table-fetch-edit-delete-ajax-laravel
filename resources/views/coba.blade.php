<!DOCTYPE html>
<html>
<head>
	<title>LIVE CRUD LARAVEL TABLE WITH AJAX</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
	<br />
	<div class="container box">
		<h3 align="center">LIVE CRUD LARAVEL TABLE WITH AJAX</h3><br />
		<div class="panel panel-default">
			<div class="panel-heading">Data</div>
			<div class="panel-body">
				<div id="message"></div>
				<div class="table-responsive">
					<table class="table table-striped table-bordered">
						<thead>
							<tr>
								<!-- <th>#</th> -->
								<th>Name</th>
								<th>SKU</th>
								<th>Barcode</th>
								<th>Purchase Price</th>
								<th>Selling Price</th>

							</tr>
						</thead>
						<tbody>

						</tbody>
					</table>
					@csrf
				</div>
			</div>
		</div>
	</div>


<!-- set interval -->

<!-- (function update() {
    $.ajax({
        ...                        // pass existing options
    }).then(function() {           // on completion, restart
       setTimeout(update, 30000);  // function refers to itself
    });
})();  -->







	<script>
		// $(document).ready(function(){

			

// if you don't wanna auto refresh 
			// function fetch_data()
			// {
			// 	$.ajax({
			// 		url:"/test/fetch-data",
			// 		dataType:"json",
			// 		success:function(data){
			// 			var html = '';
			// 			html += '<tr>';
			// 			html += '<td contenteditable id="nama"></td>';
			// 			html += '<td contenteditable id="alamat"></td>';
			// 			html += '<td><button type="button" class="btn btn-success btn-xs" id="add">Add</button></td></tr>';
			// 			for(var count=0; count < data.length; count++){
			// 				html +='<tr>';
			// 				html +='<td contenteditable class="biodata" data-biodata="nama" data-id="'+data[count].id+'">'+data[count].nama+'</td>';
			// 				html += '<td contenteditable class="biodata" data-biodata="alamat" data-id="'+data[count].id+'">'+data[count].alamat+'</td>';
			// 				html += '<td><button type="button" class="btn btn-danger btn-xs delete" id="'+data[count].id+'">Delete</button></td></tr>';
			// 			} $('tbody').html(html);
			// 		}
			// 	});
			// }

// if you wanna auto refresh 

         var refInterval = window.setInterval('update()', 30000); // 30 seconds
		 var update = function fetch_data()
			{
				$(document).ready(function () {
				$.ajax({
					url:"/test/fetch-data",
					dataType:"json",
					success:function(data){
						var html = '';
						html += '<tr>';
						html += '<td contenteditable id="name"></td>';
						html += '<td contenteditable id="sku"></td>';
						html += '<td contenteditable id="barcode"></td>';
						html += '<td contenteditable id="purchase_price"></td>';
						html += '<td contenteditable id="selling_price"></td>';
						html += '<td><button type="button" class="btn btn-success btn-xs" id="add">Add</button></td></tr>';
						for(var count=0; count < data.length; count++){
							html +='<tr>';
							html +='<td contenteditable class="biodata" data-biodata="name" data-id="'+data[count].id+'">'+data[count].name+'</td>';
							html +='<td contenteditable class="biodata" data-biodata="sku" data-id="'+data[count].id+'">'+data[count].sku+'</td>';
							html +='<td contenteditable class="biodata" data-biodata="barcode" data-id="'+data[count].id+'">'+data[count].barcode+'</td>';
							html +='<td contenteditable class="biodata" data-biodata="purchase_price" data-id="'+data[count].id+'">'+data[count].purchase_price+'</td>';
							html +='<td contenteditable class="biodata" data-biodata="selling_price" data-id="'+data[count].id+'">'+data[count].selling_price+'</td>';
							html += '<td><button type="button" class="btn btn-danger btn-xs delete" id="'+data[count].id+'">Delete</button></td></tr>';
						} $('tbody').html(html);
					}
				});
			});
			};
			update();

			var _token = $('input[name="_token"]').val();

			$(document).on('click', '#add', function(){
				var name = $('#name').text();
				var sku = $('#sku').text();
				var barcode = $('#barcode').text();
				var purchase_price = $('#purchase_price').text();
				var selling_price = $('#selling_price').text();

				if(name != '' && sku != '' && barcode != '' && purchase_price != '' && selling_price != ''){
					$.ajax({
						url:"{{ route('test.add-data') }}",
						method:"POST",
						data:{name:name, sku:sku, barcode:barcode,purchase_price:purchase_price,selling_price:selling_price ,_token:_token},
						success:function(data)
						{
							$('#message').html(data);
							update();
						}
					});
				}
				else
				{
					$('#message').html("<div class='alert alert-danger'>Both Fields are required</div>");
				}
			});

			$(document).on('blur', '.biodata', function(){
				var biodata = $(this).data("biodata");
				var val = $(this).text();
				var id = $(this).data("id");
				if(val != ''){
					$.ajax({
						url:"{{ route('test.update-data') }}",
						method:"POST",
						data:{biodata:biodata, val:val, id:id, _token:_token},
						success:function(data)
						{
							$('#message').html(data);
						}
					})
				}
				else{
					$('#message').html("<div class='alert alert-danger'>Enter some value</div>");
				}
			});

			$(document).on('click', '.delete', function(){
				var id = $(this).attr("id");
				if(confirm("Are you sure you want to delete this records?")){
					$.ajax({
						url:"{{ route('test.delete-data') }}",
						method:"POST",
						data:{id:id, _token:_token},
						success:function(data){
							$('#message').html(data);
							update();
						}
					});
				}
			});
		// });
	</script>
</body>
</html>