<!-- JQuery siempre de primero -->
<script type="text/javascript" src="./assets/dataTables/jquery223.js"></script>
<script type="text/javascript" src="./assets/dataTables/datatables.js"></script>

<link rel="stylesheet" href="./assets/css/sidebar-menu.css">
<link rel="stylesheet" type="text/css" href="./assets/dataTables/datatables.css">
<link rel="stylesheet" href="./assets/css/jquery-confirm.css" />

<?php if (isset($_SESSION['mensaje'])) { ?>
<div id="main">
	<div class="alert alert-info text-center alert-dismissible negritas" role="alert">
		<?php 
			echo $_SESSION['mensaje'];
			unset($_SESSION['mensaje']);
		?>
		<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	</div>
</div>
<?php } ?>

<!-- Header -->
<div id="header" class="header-visible">
	<div class="top">
		<!-- Logo -->
		<div id="logo">
			<span class="image centered avatar48"><img src="./images/avatar.png" alt="" /></span>
			<h1 id="title">Menú</h1>
			<?php $datos_usuario = $_SESSION['datos_usuario']; ?>
			<small class="menu"><?php echo $datos_usuario['nombre']." ".$datos_usuario['apellido'];?></small>
		</div>

		<section style="width: inherit;">
			<ul class="sidebar-menu">
				<li class="treeview">
					<a href="#">
						<span>Administrador</span> <i class="fa fa-cogs"></i> <i class="fa fa-angle-left pull-left"></i>
					</a>
					<ul class="treeview-menu">
						<li><a href="./listar_administradores.php" id="listar_administradores" class="skel-layers-ignoreHref">Administrador <span class="icon fa-cog fa-fw" style="font-size: 70%"></span></a></li>
						<li><a href="./agregar_admin.php" id="agregar_admin" class="skel-layers-ignoreHref">Agregar Administrador <span class="icon fa-user-plus fa-fw" style="font-size: 70%"></span></a></li>
					</ul>
				</li>

				<li class="treeview">
					<a href="#">
						 <span>Lectores</span> <i class="fa fa-user"></i> <i class="fa fa-angle-left pull-left"></i>
					</a>
					<ul class="treeview-menu">
						<li><a href="./index_usuarios.php" id="index_usuarios" class="skel-layers-ignoreHref">Listar Lectores <span style="font-size: 70%" class="icon fa-user"></span></a></li>
						<li><a href="./agregar_usuario.php" id="agregar_usuario" class="skel-layers-ignoreHref">Registrar Lector <span style="font-size: 70%" class="icon fa-user-plus"></span></a></li>
					</ul>
				</li>

				<li class="treeview">
					<a href="#">
						 <span>Préstamos</span> <i class="fa fa-bookmark"></i> <i class="fa fa-angle-left pull-left"></i>
					</a>
					<ul class="treeview-menu">
						<li><a href="listar_prestamos.php" id="listar_prestamos" class="skel-layers-ignoreHref">Listar Préstamos <span style="font-size: 70%" class="icon fa-bookmark"></span></a></li>
						<li><a href="agregar_prestamo.php" id="agregar_prestamo" class="skel-layers-ignoreHref">Registrar Préstamos <span style="font-size: 70%" class="icon fa-bookmark"></span></a></li>
						
						<li><a href="listar_vencidos.php" class="skel-layers-ignoreHref disabled">Prestamos Vencidos <span style="font-size: 70%" class="icon fa-bookmark"></span></a></li>
					</ul>
				</li>

				<li class="treeview">
					<a href="#">
						 <span>Libros</span> <i class="fa fa-book"></i> <i class="fa fa-angle-left pull-left"></i>
					</a>
					<ul class="treeview-menu">
						<li><a href="./listar_libros.php" id="listar_libros" class="skel-layers-ignoreHref">Listar Libro <span style="font-size: 70%" class="icon fa-book"></span></a></li>
						<li><a href="./agregar_libro.php" id="agregar_libro" class="skel-layers-ignoreHref">Registrar Libro <span style="font-size: 70%" class="icon fa-book"></span></a></li>
					</ul>
				</li>

				<li>
					<a id="cerrar_session" data-href="cerrar_session.php" class="skel-layers-ignoreHref">Cerrar Sesión <span class="icon fa-sign-out" style="font-size: 70%"></span></a>
				</li>
			</ul>
		</section>
	</div>
</div>

<script src="./assets/js/sidebar-menu.js"></script>
<script type="text/javascript" src="./assets/js/jquery-confirm.js"></script>
<script type="text/javascript">
	$.sidebarMenu($('.sidebar-menu'));
	$(document).ready(function(){
		$('#cerrar_session').on('click', function(){
			var $href = $( this ).data('href');
			
			jQuery.confirm({
				theme: 'supervan',
				columnClass: 'medium',
				title: false,
				content: '¿Desea salir del sistema?',
				buttons: {
			        "Cerrar Sesión": function(){
			            jQuery.alert({theme: 'supervan', title: false, content:'Saliendo del sistema'});
			            location.href = $href
			        },
			        Cancelar: function(){
			        	jQuery.alert({theme: 'supervan', title: false, content: 'Cancelando ... pulse ok'});
			        }
			    }
			});
		});
	});
</script>