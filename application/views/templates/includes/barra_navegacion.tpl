<!--
/*
 * Copyright (C) 2014 jamr200
 *
 * This file is part Cgpimp.
 *
 * This program is free software: you can redistribute it and/or modify it
 * under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful, but WITHOUT
 * ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS
 * FOR A PARTICULAR PURPOSE. See the GNU General Public License
 * for more details.
 *
 * You should have received a copy of the GNU General Public License along with
 * this program. If not, see <http://www.gnu.org/licenses/>
 */
 -->

<div class="container">
	<img class="logo-cabecera" src="{base_url()}img/logo.png" alt="">
	<!--<h2>Sistema de gestion de dispositivos</h2>-->
	<div class="row">
		<div class="col-md-12">
			<div class="navbar">
			<ul class="nav navbar-nav">
			<!-- **************************************** -->
			<li><a href="{base_url()}">Inicio</a></li>
			<!-- **************************************** -->
			<li class="dropdown">
				<a class="dropdown-toggle" data-toggle="dropdown" href="#">Dispositivos<b class="caret"></b></a>
				<ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu">
					<li role="presentation" class="dropdown-header">Tipo de dispositivo</li>
					<li><a href="{base_url()}dispositivo_controller/alta_tipo_dispositivo">Dar de alta</a></li>
					<!--<li><a href="{base_url()}dispositivo_controller/eliminar_tipo_dispositivo">Dar de baja</a></li>-->
					<!-- **************************************** -->
					<li role="presentation" class="divider"></li>
  					<li role="presentation" class="dropdown-header">Dispositivo</li>
  					<li><a href="{base_url()}dispositivo_controller/alta_dispositivo">Dar de alta</a></li>
					<!--<li><a href="{base_url()}dispositivo_controller/eliminar_dispositivo">Dar de baja</a></li>-->
					<li><a href="{base_url()}dispositivo_controller/listar_dispositivo">Listar</a></li>
					<!-- **************************************** -->
					<li role="presentation" class="divider"></li>
  					<li role="presentation" class="dropdown-header">Instancia de dispositivo</li>
  					<li><a href="{base_url()}dispositivo_controller/alta_instancia_dispositivo">Dar de alta</a></li>
					<!--<li><a href="{base_url()}dispositivo_controller/eliminar_instancia_dispositivo">Dar de baja</a></li>-->
					<li><a href="{base_url()}dispositivo_controller/modificar_instancia_dispositivo">Modificar</a></li>
					<li><a href="{base_url()}dispositivo_controller/buscar_instancia_dispositivo">Buscar</a></li>
					<li><a href="{base_url()}dispositivo_controller/historico_instancia_dispositivo">Histórico de estados</a></li>
				</ul>
			</li>
			<!-- **************************************** -->
			<li class="dropdown">
				<a class="dropdown-toggle" data-toggle="dropdown" href="#">Materiales<b class="caret"></b></a>
				<ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu">
					<li role="presentation" class="dropdown-header">Tipo de material</li>
					<li><a href="{base_url()}material_controller/alta_tipo_material">Dar de alta</a></li>
					<!--<li><a href="{base_url()}material_controller/eliminar_tipo_material">Dar de baja</a></li>-->
					<!-- **************************************** -->
					<li role="presentation" class="divider"></li>
  					<li role="presentation" class="dropdown-header">Material</li>
  					<li><a href="{base_url()}material_controller/alta_material">Dar de alta</a></li>
					<!--<li><a href="{base_url()}material_controller/eliminar_material">Dar de baja</a></li>-->
					<li><a href="{base_url()}material_controller/listar_material">Listar</a></li>
					<!-- **************************************** -->
					<li role="presentation" class="divider"></li>
  					<li role="presentation" class="dropdown-header">Instancia de material</li>
  					<li><a href="{base_url()}material_controller/alta_instancia_material">Dar de alta</a></li>
					<li><a href="{base_url()}material_controller/modificar_instancia_material">Modificar</a></li>
					<li><a href="{base_url()}material_controller/buscar_instancia_material">Buscar</a></li>
					<li><a href="{base_url()}material_controller/asociar_instancia_material">Asociar a una instancia de dispositivo</a></li>
					<li><a href="{base_url()}material_controller/desasociar_instancia_material">Desasociar de una instancia de dispositivo</a></li>
					<li><a href="{base_url()}material_controller/historico_instancia_material">Histórico de estados</a></li>
				</ul>
			</li>
			<!-- **************************************** -->
			<li class="dropdown">
				<a class="dropdown-toggle" data-toggle="dropdown" href="#">Departamentos<b class="caret"></b></a>
				<ul class="dropdown-menu">
					<li><a href="{base_url()}departamento_controller/alta_departamento">Dar de alta</a></li>
					<li><a href="{base_url()}departamento_controller/eliminar_departamento">Dar de baja</a></li>
					<li><a href="{base_url()}departamento_controller/modificar_departamento">Modificar</a></li>
					<li><a href="{base_url()}departamento_controller/listar_departamento">Listar</a></li>
				</ul>
			</li>
			<!-- **************************************** -->
			<li class="dropdown">
				<a class="dropdown-toggle" data-toggle="dropdown" href="#">Pedidos<b class="caret"></b></a>
				<ul class="dropdown-menu">
					<li><a href="{base_url()}pedido_controller/alta_pedido">Nuevo</a></li>
					<li><a href="{base_url()}pedido_controller/eliminar_pedido">Eliminar</a></li>
					<li><a href="{base_url()}pedido_controller/modificar_pedido">Modificar</a></li>
					<li><a href="{base_url()}pedido_controller/almacena_ficheros">Almacena ficheros</a></li>
					<li><a href="{base_url()}pedido_controller/listar_pedido">Listar</a></li>
				</ul>
			</li>
			<!-- **************************************** -->
			<li class="dropdown">
				<a class="dropdown-toggle" data-toggle="dropdown" href="#">Proveedores<b class="caret"></b></a>
				<ul class="dropdown-menu">
					<li><a href="{base_url()}proveedor_controller/alta_proveedor">Dar de alta</a></li>
					<li><a href="{base_url()}proveedor_controller/eliminar_proveedor">Dar de baja</a></li>
					<li><a href="{base_url()}proveedor_controller/modificar_proveedor">Modificar</a></li>
					<li><a href="{base_url()}proveedor_controller/listar_proveedor">Listar</a></li>
				</ul>
			</li>
			<!-- **************************************** -->
			<li class="dropdown">
				<a class="dropdown-toggle" data-toggle="dropdown" href="#">Personal<b class="caret"></b></a>
				<ul class="dropdown-menu">
					<li><a href="{base_url()}persona_controller/alta_persona">Dar de alta</a></li>
					<li><a href="{base_url()}persona_controller/eliminar_persona">Dar de baja</a></li>
					<li><a href="{base_url()}persona_controller/modificar_persona">Modificar</a></li>
					<li><a href="{base_url()}persona_controller/listar_persona">Listar</a></li>
				</ul>
			</li>
			<!-- ****************************************
			<li class="dropdown">
				<a class="dropdown-toggle" data-toggle="dropdown" href="#">Estado<b class="caret"></b></a>
				<ul class="dropdown-menu">
					<li><a href="{base_url()}estado_controller/alta_estado">Dar de alta</a></li>
					<li><a href="{base_url()}estado_controller/alta_estado">Ver histórico</a></li>
				</ul>
			</li>
			<!-- ****************************************
			<li class="dropdown">
				<a class="dropdown-toggle" data-toggle="dropdown" href="#">Marca<b class="caret"></b></a>
				<ul class="dropdown-menu">
					<li><a href="{base_url()}marca_controller/alta_marca">Dar de alta marca</a></li>
				</ul>
			</li>
			<!-- ****************************************
			<li class="dropdown">
				<a class="dropdown-toggle" data-toggle="dropdown" href="#">Modelo<b class="caret"></b></a>
				<ul class="dropdown-menu">
					<li><a href="{base_url()}modelo_controller/alta_modelo">Dar de alta modelo</a></li>
				</ul>
			</li>
			<!-- **************************************** -->

			<li class="dropdown">
				<a class="dropdown-toggle" data-toggle="dropdown" href="#">Ubicacion<b class="caret"></b></a>
				<ul class="dropdown-menu">
  					<!--
  					<li role="presentation" class="dropdown-header">Edificio</li>
  					<li><a href="{base_url()}ubicacion_controller/alta_edificio">Dar de alta</a></li>
					<!-- ****************************************
					<li role="presentation" class="divider"></li>
  					<li role="presentation" class="dropdown-header">Habitacion</li>
  					<li><a href="{base_url()}ubicacion_controller/alta_habitacion">Dar de alta</a></li>
					<!-- ****************************************
					<li role="presentation" class="divider"></li>
  					<li role="presentation" class="dropdown-header">Mueble</li>
  					<li><a href="{base_url()}ubicacion_controller/alta_mueble">Dar de alta</a></li>
					<!-- ****************************************
					<li role="presentation" class="divider"></li>
  					<li role="presentation" class="dropdown-header">Balda</li>
  					<li><a href="{base_url()}ubicacion_controller/alta_balda">Dar de alta</a></li>
					<!-- ****************************************
					<li role="presentation" class="divider"></li>-->
					<li><a href="{base_url()}ubicacion_controller/establece_ubicacion">Establecer ubicación</a></li>
					<li><a href="{base_url()}ubicacion_controller/encontrar_ubicacion">Encontrar ubicacion</a></li>
					<li><a href="{base_url()}ubicacion_controller/listar_ubicacion">Listar ubicaciones</a></li>
					<li><a href="{base_url()}ubicacion_controller/buscar_ubicacion">Buscar ubicacion</a></li>
				</ul>
			</li>
			<!-- **************************************** -->
			<li class="dropdown">
				<a class="dropdown-toggle" data-toggle="dropdown" href="#">Backup<b class="caret"></b></a>
				<ul class="dropdown-menu">
					<li><a href="{base_url()}backup_controller/hacer_backup">Hacer copia de seguridad</a></li>
					<li><a href="{base_url()}backup_controller/restaurando_backup">Restaurar copia de seguridad</a></li>
				</ul>
			</li>
			<!-- **************************************** -->
			<li><a href="{base_url()}usuario_controller/logout">Salir</a></li>
			</ul>
			</div>
		</div>
	</div>
</div>