<?
include 'session.php';
$page = 'Dashboard';

$table = 'users';
$users = CRUD::SELECT('', $table, '', '', '');
?>
<!DOCTYPE html>
<html lang="en">

<? include '_head.php'; ?>

<body id="page-top">

	<!-- Page Wrapper -->
	<div id="wrapper">

		<? include '_menu.php'; ?>

		<!-- Content Wrapper -->
		<div id="content-wrapper" class="d-flex flex-column">

			<!-- Main Content -->
			<div id="content">

				<? include '_nav.php'; ?>

				<!-- Begin Page Content -->
				<div class="container-fluid">

					<!-- Page Heading -->
					<h1 class="h3 mb-2 text-gray-800">Painel Gerencial</h1>
					<p class="mb-4"></p>

					<!-- DataTales Example -->
					<div class="card shadow mb-4">
						<div class="card-header py-3 d-flex">
							<h6 class="my-auto font-weight-bold text-primary">Cadastro de Usuários</h6>
							<a href="#" class="btn btn-success ml-auto" data-toggle="modal" data-target="#modalNewUser"><i class="fas fa-plus"></i> Cadastrar Usuário</a>
						</div>
						<div class="card-body">
							<div class="table-responsive">
								<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
									<thead>
										<tr>
											<th>Nome</th>
											<th>Função</th>
											<th>E-mail</th>
											<th>Bloqueado</th>
											<th>Cadastrado em</th>
											<th>Ações</th>
										</tr>
									</thead>
									<tbody>
										<? foreach ($users as $user) { ?>
											<tr>
												<td><?= $user['name'] ?></td>
												<td><?= $user['level'] == 1 ? 'Administrador' : 'Vendedor' ?></td>
												<td><?= $user['email'] ?></td>
												<td><?= $user['attempts'] == 0 ? 'Sim' : 'Não' ?></td>
												<td><?= FUNC::convert_datetime($user['date']) ?></td>
												<td style="text-align: center;">
													<a href="#" title="Editar" onclick="" class="btn btn-primary text-white btAcao"><i class="fas fa-edit"></i></a>
												</td>
											</tr>
										<? } ?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
				<!-- /.container-fluid -->
			</div>
			<!-- End of Main Content -->

			<? include '_copyright.php'; ?>

		</div>
		<!-- End of Content Wrapper -->

	</div>
	<!-- End of Page Wrapper -->

	<div class="modal fade" id="modalNewUser" tabindex="-1" role="dialog" aria-labelledby="modalNewUserTitle" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLongTitle">Cadastrar usuário</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form>
						<div class="col-12 form-group">
							<label for="new-user-name">Nome</label>
							<input type="text" class="form-control" id="new-user-name" placeholder="Insira o nome..." required>
						</div>
						<div class="col-12 form-group">
							<label for="new-user-email">E-mail</label>
							<input type="email" class="form-control" id="new-user-email" placeholder="Insira o e-mail..." required>
						</div>
						<div class="col-12 form-group">
							<label for="new-user-email2">Confirme o E-mail</label>
							<input type="email" class="form-control" id="new-user-email2" placeholder="Confirme o e-mail..." required>
						</div>
						<div class="col-12 form-group">
							<label for="new-user-funct">Função</label>
							<select class="form-control" id="new-user-funct" required>
								<option value="">Selecione</option>
								<option value="1">Administrador</option>
								<option value="2">Vendedor</option>
							</select>
						</div>
						<div class="col-12 form-group">
							<label for="new-user-blocked">Bloqueado?</label>
							<select class="form-control" id="new-user-blocked" required>
								<option selected value="0">Não</option>
								<option value="1">Sim</option>
							</select>
						</div>
					</form>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
					<button type="button" class="btn btn-primary" onclick="newUser()">Cadastrar</button>
				</div>
			</div>
		</div>
	</div>

	<? include '_footer.php'; ?>

	<script>
		$(document).ready(function() {
			$('#dataTable').DataTable();
		});
	</script>

	<script>
		function newUser() {
			var name = $('#new-user-name').val();
			var email = $('#new-user-email').val();
			var email2 = $('#new-user-email2').val();
			var funct = $('#new-user-funct').val();
			var blocked = $('#new-user-blocked').val();

			if (email == email2) {

				$.ajax({
					type: 'POST',
					url: 'requests.php',
					data: {
						action: 'new-user',
						name: name,
						email: email,
						email2: email2,
						funct: funct,
						blocked: blocked
					},
					beforeSend: function() {
						let timerInterval
						Swal.fire({
							title: 'Autenticando...',
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
							window.location = 'dashboard.php';
						} else if (ret.code == 1) {
							Swal.fire({
								type: 'error',
								title: 'Senha incorreta.',
								text: 'Você possui mais ' + ret.attempts + ' tentativas...'
							});
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
			} else {

			}
		}
	</script>

</body>

</html>