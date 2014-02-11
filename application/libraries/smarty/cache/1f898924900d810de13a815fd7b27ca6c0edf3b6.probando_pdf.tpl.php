<?php /*%%SmartyHeaderCode:3759523c367e11ccf5-89755822%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '1f898924900d810de13a815fd7b27ca6c0edf3b6' => 
    array (
      0 => 'application\\views\\templates\\probando_pdf.tpl',
      1 => 1378552427,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '3759523c367e11ccf5-89755822',
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_523c367e15f788_20817611',
  'cache_lifetime' => 120,
),true); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_523c367e15f788_20817611')) {function content_523c367e15f788_20817611($_smarty_tpl) {?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Generación de reportes con codeIgniter</title>
</head>
<body>
<h2 style="text-align: center">Imprime tus tipos</h2>
<form method="post" action="http://localhost/pfcdata/pdf_controller/generar" />
<input type="submit" value="Crear PDF" title="Crear PDF" />
</form>
</body>
</html><?php }} ?>