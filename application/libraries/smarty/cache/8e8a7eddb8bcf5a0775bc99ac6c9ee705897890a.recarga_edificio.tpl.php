<?php /*%%SmartyHeaderCode:529552e925eb0461f8-25939752%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '8e8a7eddb8bcf5a0775bc99ac6c9ee705897890a' => 
    array (
      0 => 'application\\views\\templates\\ubicacion\\edificio\\recarga_edificio.tpl',
      1 => 1386173690,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '529552e925eb0461f8-25939752',
  'variables' => 
  array (
    'edificio' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_52e925eb0f3013_24962004',
  'cache_lifetime' => 120,
),true); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_52e925eb0f3013_24962004')) {function content_52e925eb0f3013_24962004($_smarty_tpl) {?><select name="edificio" id="edificio">
	<option value=""></option>
			<option value="1">Ayuntamiento</option>
			<option value="2">Palacio Beniel</option>
	</select><?php }} ?>