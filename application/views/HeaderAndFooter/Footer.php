
		<!-- <footer style="background-color: red;"><p>test</p></footer> -->

        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>		
		<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>
		
		<!-- <script src="<?php echo base_url(); ?>application/assets/js/datatables.js"></script>
		<script src="<?php echo base_url(); ?>application/assets/dataTables/js/jquery.dataTables.min.js"></script>
		<script src="<?php echo base_url(); ?>application/assets/dataTables/js/dataTables.semanticui.min.js"></script> -->
		<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
		<script src="https://cdn.datatables.net/responsive/1.0.7/js/dataTables.responsive.min.js"></script>
		<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>
		<script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
		<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
		<!-- <script src="<?php echo base_url(); ?>application/assets/js/responsive.dataTables.min.js"></script> -->
		
		<script src="https://code.highcharts.com/highcharts.js"></script>
		<script src="//unpkg.com/alpinejs" defer></script>
		<script>
       
	   $(document).ready( function () {
			$('.field').hide();
			$('#loadingpage').hide();
		   $('#loadingicon').hide();
	   });	
	   $( "#button" ).click(function() {
		   $('#loadingpage').show();
		   $('#loadingicon').show();
		   $('body').addClass("disableScrolling");
	   });
	   $( "#editbutton" ).click(function() {
			$('.field').show();
			$('.detail-text').hide();
	   });
	   $( "#canceledit" ).click(function() {
			$('.field').hide();
			$('.detail-text').show();
	   });
   </script>
   <script>
		function ConfirmDelete(){
			if (confirm("Are you sure you want to delete?")){
				return true;
			}
			else {
				return false;
			}
		}  
	</script>
		<?php if(isset($analysis)): ?>
			<script>
			// SERVICES AND PRODUCTS COUNT
			document.addEventListener('DOMContentLoaded', function () {
					const chart2 = Highcharts.chart('percentTypePie', {
						chart: {
							type: 'pie',
							plotBackgroundColor: null,
							plotBorderWidth: null,
							plotShadow: false,
							scrollablePlotArea: {
								minWidth: 400,
								scrollPositionX: 1
							}
						},
						// title: {
						// 	text: ''
						// },
						tooltip: {
							pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
						},
						accessibility: {
							point: {
								valueSuffix: '%'
							}
						},
						plotOptions: {
							pie: {
								allowPointSelect: true,
								cursor: 'pointer',
								dataLabels: {
									enabled: true,
									format: '<b>{point.name}</b>: {point.percentage:.1f} %'
								}
							}
						},

						series: [{
							name: 'Count',
							colorByPoint: true,
							data: [
								<?php foreach($analysis as $data): ?>
									<?= 
										'{name: "' . $data->provider_name. '", y: ' .round(($data->total/$totalProviderCount)*100,2). '},'	
									?>
								<?php endforeach; ?>
							]
						}]

					});
				});
		</script>
		<?php endif; ?>
    </body>
</html>