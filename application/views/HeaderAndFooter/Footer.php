


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
		
		<!-- Show Uploaded Image  -->
		<script>
			try {
				function readURL(input) {
					if (input.files && input.files[0]) {
						var reader = new FileReader();
						reader.onload = function (e) {
							$('#imageContainer').attr('style', 'background: url('+e.target.result+');background-size: cover; width: 100%; height: 500px; background-position: center;')  ;
						};
						reader.readAsDataURL(input.files[0]);
					}
				}
			} catch (error) { 
				throw error; 
			}
			try {
				function readURL1(input) {
					if (input.files && input.files[0]) {
						var reader = new FileReader();
						reader.onload = function (e) {
							$('#imageContainer1').attr('style', 'background: url('+e.target.result+');background-size: cover; width: 100%; height: 500px; background-position: center;')  ;
						};
					reader.readAsDataURL(input.files[0]);
					}
				}
			} catch (error) { 
				throw error; 
			}
			try {
				function readURL2(input) {
					if (input.files && input.files[0]) {
						var reader = new FileReader();
						reader.onload = function (e) {
							$('#profilePic').attr('src', e.target.result)  ;
						};
					reader.readAsDataURL(input.files[0]);
					}
				}
			} catch (error) { 
				throw error; 
			}

		</script>
		<!-- utils js  -->
		<script>
       
			$(document).ready( function () {
				<?php if(isset($picture)):?>
					$('#imageContainer').attr('style', 'background: url("<?=  $this->session->userdata('base_url').$picture->image ?>");background-size: cover; width: 100%; height: 500px; background-position: center;')  ;
				<?php elseif(isset($credDetail->image)):?>
					$('#imageContainer').attr('style', 'background: url("<?=  $this->session->userdata('base_url').$credDetail->image ?>");background-size: cover; width: 100%; height: 500px; background-position: center;')  ;
				<?php else:?>
					$('#imageContainer').attr('style', 'background: url("https://upload.wikimedia.org/wikipedia/commons/thumb/d/d1/Image_not_available.png/800px-Image_not_available.png?20210219185637");background-size: cover; width: 100%; height: 500px; background-position: center;')  ;
				<?php endif;?>

				<?php if($this->session->has_userdata('ManageCoursesError')):?>
					$("#courseModal").modal('show');
					<?php $this->session->unset_userdata('ManageCoursesError'); ?>
				<?php endif;?>
				<?php if($this->session->has_userdata('ManageCoursesErrorUpdate')):?>
					$("#courseModalEdit").modal('show');
					<?php $this->session->unset_userdata('ManageCoursesErrorUpdate'); ?>
					
				<?php endif;?>							
				<?php if($this->session->has_userdata('oldData')):?>
					$("#createUserModal").modal('show');
					<?php $this->session->unset_userdata('oldData'); ?>
					
				<?php endif;?>
							
				$('.field').hide();
				$('#loadingpage').hide();
				$('#loadingicon').hide();
			});	
			$( "#button" ).click(function() {
				$('#loadingpage').show();
				$('#loadingicon').show();
				$('body').addClass("disableScrolling");
			});
			$( "#button1" ).click(function() {
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
			
			$(".test1").click(function(e) {
				$('#courseModalEdit').on('show.bs.modal', function (event) {

					var button = $(event.relatedTarget);

					var button = $(event.relatedTarget);
					var title = button.data('title');
					var description = button.data('description');
					var link = button.data('link');
					var provider = button.data('provider');
					var type = button.data('type');
					var id = button.data('id');
					var base_url = "<?= (($this->session->has_userdata('base_url')) ? $this->session->userdata('base_url'): '') ?>";
					var image = button.data('image');
					var modal = $(this);

					modal.find('.modal-body #title').val(title);
					modal.find('.modal-body #description').val(description);
					modal.find('.modal-body #link').val(link);
					modal.find('.modal-body #provider').val(provider);
					modal.find('.modal-body #types').val(type);
					modal.find('.modal-body #id').val(id);
					modal.find('.modal-body #secretImg').val(image);
					if(image != null){
						modal.find('.modal-body #imageContainer1').attr("style", "background-image: url(" +base_url+image+ "); height: 500px; background-size: cover; background-position: center;");
					}


				})
			});
			function ConfirmDelete(){
				if (confirm("Are you sure you want to delete?")){
					return true;
				}
				else {
					return false;
				}
			}  
		</script>
		<!-- table js  -->
		<script>
			 $('#userTable').DataTable({responsive: true,pageLength: 15,lengthChange: false,searching: true,ordering: true});
		</script>
		<!-- graps js  -->
		<?php if(isset($analysisProvider)): ?>
			<script>
			// SERVICES AND PRODUCTS COUNT
			document.addEventListener('DOMContentLoaded', function () {
					const chart2 = Highcharts.chart('percentProviderPie', {
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
						title: {
							text: ''
						},
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
								<?php foreach($analysisProvider as $data): ?>
									<?= 
										'{name: "' . $data->value. '", y: ' .round(($data->total/$totalProviderCount)*100,2). '},'	
									?>
								<?php endforeach; ?>
							]
						}]

					});
				});
			</script>
		<?php endif; ?>
		<?php if(isset($analysisDate)): ?>
			<script>
				<?php 
					$months = array('filler','Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec');
				?>
				document.addEventListener('DOMContentLoaded', function () {
					const chart1 = Highcharts.chart('Dates', {
						chart: {
							type: 'column',
							scrollablePlotArea: {
								minWidth: 400,
								scrollPositionX: 1
							}
						},
						title: {
							text: ''
						},
						xAxis: {
							categories: [
								<?php foreach($months as $data): ?>
									<?php if($data != 'filler'): ?>
										<?= '"'.$data.'",' ?>
									<?php endif; ?>
								<?php endforeach; ?>
							],
							labels: {
								overflow: 'justify'
							}
						},
						yAxis: {
							type: 'linear',

							title: {
								text: 'Count'
							}
						},

						series: [{
							name: 'Number of credentials per month',
							data: [
								<?php foreach($months as $key => $data): ?>
									<?php if($data != 'filler'): ?>
										<?php if(isset($analysisDate[$key])): ?>
											<?=  $analysisDate[$key] .',' ?>
										<?php else: ?>
											<?=  0 .',' ?>
										<?php endif; ?>	
									<?php endif; ?>
								<?php endforeach; ?>
							]
						}]

					});
				});
			</script>
		<?php endif; ?>
		<?php if(isset($analysisTypes)): ?>
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
							},
						},
						title: {
							text: ''
						},
						
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
									enabled: false,
									format: '<b>{point.name}</b>: {point.percentage:.1f} %'
								},
								showInLegend: true
							}
						},

						series: [{
							name: 'Count',
							colorByPoint: true,
							data: [
								<?php foreach($analysisTypes as $data): ?>
									<?= 
										'{name: "' . (($data->value == 1) ? 'Certification': (($data->value == 2) ? 'Recognition' : (($data->value == 3) ? 'Attendance' : 'Completion' ))) . '", y: ' .round(($data->total/$totalTypeCount)*100,2). '},'	
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