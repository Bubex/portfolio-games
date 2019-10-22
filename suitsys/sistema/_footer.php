     <!-- Scroll to Top Button-->
	<a class="scroll-to-top rounded" href="#page-top">
		<i class="fas fa-angle-up"></i>
	</a>

	<!-- Logout Modal-->
	<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Sair</h5>
					<button class="close" type="button" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
				</div>
				<div class="modal-body">Tem certeza que deseja sair de sua conta?</div>
				<div class="modal-footer">
					<button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
					<a class="btn btn-primary" href="#" onclick="logout()">Confirmar</a>
				</div>
			</div>
		</div>
	</div>
     
	<script src="vendor/jquery/jquery.min.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
	<script src="vendor/jquery-easing/jquery.easing.min.js"></script>
	<script src="vendor/datatables/jquery.dataTables.min.js"></script>
	<script src="js/sb-admin-2.min.js"></script>
	<script src="vendor/chart.js/Chart.min.js"></script>
	<script src="js/demo/chart-area-demo.js"></script>
	<script src="js/demo/chart-pie-demo.js"></script>
	<script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>

	<script>
	     function forceAtt() {
	          $.ajax({
	               type: 'POST',
	               url: 'requests.php',
	               data: {
	                    action: 'force-att',
	               },
	               success: function(retorno) {
	                    var ret = JSON.parse(retorno);

	                    if (ret.code == 0) {
	                         location.reload();
	                    } else {
	                         Swal.fire({
	                              type: 'error',
	                              text: ret.msg
	                         });
	                    }
	               },
	               error: function() {

	               }
	          });
	     }
     </script>
     
     <script>
		function logout() {

			$.ajax({
				type: 'POST',
				url: 'requests.php',
				data: {
					action: 'logout',
				},
				beforeSend: function() {
					let timerInterval
					Swal.fire({
						title: 'Saindo da conta...',
						timer: 2000,
						onBeforeOpen: () => {
							Swal.showLoading()
						},
						onClose: () => {
							clearInterval(timerInterval)
						}
					});
				},
				success: function(retorno) {
					var ret = JSON.parse(retorno);

					if (ret.code == 0) {
						$('#logoutModal').modal('hide');
						window.location = 'login.php';
					} else {
						Swal.fire({
							type: 'error',
							text: ret.msg
						});
					}
				},
				error: function() {

				}
			});
		}
	</script>