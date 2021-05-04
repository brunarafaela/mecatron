<?php includePartial('header', 'Shared'); ?>
<body>
	<div class="row">
		<div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4">
			<div class="login-panel panel panel-default">
				<div class="panel-heading">Área restrita</div>
				<div class="panel-body">
					<form class="form-signin" role="form" method="post" action="/Index/loginsubmit/">
						<?php if (@$Data['result']['error']): ?>
							<div class="alert alert-danger" role="alert">
								<?php echo $Data['result']['error'] ?>
							</div>
							<hr />
						<?php endif ?>
						<fieldset>
							<div class="form-group">
								<input type="text" class="form-control" name="cpf" placeholder="CPF" autofocus="">
							</div>
							<div class="form-group">
								<div class="input-group" id="show_hide_password">
									<input type="password" name="pass" id="senha1" class="form-control"  placeholder="Senha" required>
									<div class="input-group-addon" style="padding: 10px 15px;margin-bottom: 0;font-size: 17px;font-weight: 400;line-height: 1.25;color: #495057;text-align: center;background-color: #e9ecef;border: 1px solid rgba(0,0,0,.15);border-radius: .25rem;border-left: 0px;border-top-left-radius: 0px; border-bottom-left-radius: 0px;">
										<a href=""><i class="fa fa-eye-slash" aria-hidden="true"></i></a>      
									</div>
								</div>
							</div>
							<button class="btn btn-lg btn-primary">Entrar</button>
						</fieldset>
					</form>
				</div>
			</div>
		</div><!-- /.col-->
	</div><!-- /.row -->	
	<script src="js/jquery-1.11.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
</body>
</html>
<script type="text/javascript">
	function setError(error) {
		$('#alertbox').html('');
		$('#alertbox').append('<div class="alert alert-danger" role="alert">'+error+'</div>');
	}
</script>

<script type="text/javascript" language="JavaScript">
	$(function () {
		$('[data-toggle="popover"]').popover()
	})

	$(document).ready(function() {
		$("#show_hide_password a").on('click', function(event) {
			event.preventDefault();
			if($('#show_hide_password input').attr("type") == "text"){
				$('#show_hide_password input').attr('type', 'password');
				$('#show_hide_password i').addClass( "fa-eye-slash" );
				$('#show_hide_password i').removeClass( "fa-eye" );
			}else if($('#show_hide_password input').attr("type") == "password"){
				$('#show_hide_password input').attr('type', 'text');
				$('#show_hide_password i').removeClass( "fa-eye-slash" );
				$('#show_hide_password i').addClass( "fa-eye" );
			}
		});
	});
</script> 