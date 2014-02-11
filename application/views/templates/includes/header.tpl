<!DOCTYPE html>

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

<html lang="es-ES">
<head>
	<meta charset="utf-8">
	<title>Gestión de dispositivos</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="Aplicacion web de control de impresoras y los consumibles correspondientes.">
	<meta name="author" content="Jose">
	<link rel="shorcut icon" href="{base_url()}img/favicon.ico" type='image/png'>
	<!--<style type="text/css">
		body{ padding-top: 60px; padding-bottom: 40px; }
	</style>

	<link href="{base_url()}css/bootstrap.css" rel="stylesheet" type="text-css">
	<link href="{base_url()}css/bootstrap-responsive.css" rel="stylesheet" type="text-css">
	<link href="{base_url()}css/style.css" rel="stylesheet" type="text-css">
	<link href="{base_url()}css/estilo.css" rel="stylesheet" type="text-css">
	<link href="{base_url()}css/select2/select2.css" rel="stylesheet" type="text-css">
	<link href="{base_url()}css/select2-bootstrap.css" rel="stylesheet" type="text-css">
	<link href="{base_url()}css/bootstrap-duallistbox.css" rel="stylesheet" type="text-css">
-->

	<style>
		@import url('{base_url()}css/bootstrap.css');
		@import url('{base_url()}css/bootstrap-responsive.css');
		@import url('{base_url()}css/style.css');
		@import url('{base_url()}css/estilo.css');
		@import url('{base_url()}css/select2/select2.css');
		@import url('{base_url()}css/select2-bootstrap.css');
		@import url('{base_url()}css/bootstrap-duallistbox.css');
	</style>
<!--

	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js" type="text/javascript"></script>
-->
	<script src="{base_url()}js/jquery.js" type="text/javascript"></script>
	<script src="{base_url()}js/bootstrap.js" type="text/javascript"></script>
	<script src="{base_url()}js/validacion/jquery.validate.js" type="text/javascript"></script>
	<script src="{base_url()}js/validacion/messages_es.js" type="text/javascript"></script>
	<script src="{base_url()}js/select2.js" type="text/javascript"></script>
	<script src="{base_url()}js/bootstrap-duallistbox.js" type="text/javascript"></script>
	<script src="{base_url()}js/multi-upload/jquery.MultiFile.js" type="text/javascript"></script>

	<!--Reglas de validacion extras-->

	<script>
		jQuery.validator.addMethod("exactlength", function(value, element, param) {
		return this.optional(element) || value.length == param;
		}, jQuery.format("Please enter exactly {0} characters."));
	</script>
</head>

<body>
