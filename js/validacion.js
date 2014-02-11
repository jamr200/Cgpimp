/*Funciones de JQuery para validar mis formularios*/

// Validacion para formulario departamento
function ValidaDepartamento()
{
	$(document).ready(function(){
		$('#formulario').validate({
			errorElement: "span",
			rules: 
			{
				nombre: {required: true, minlength: 4, maxlength: 50},
				email: {required: true, email: true},
				telefono: {required: true, minlength: 9, maxlength: 12},
				fax: {minlength: 9, maxlength: 12}
			},
			highlight: function(element) 
			{
				$(element).closest('.control-group')
				.removeClass('success').addClass('error');
			},
			success: function(element) 
			{
				element
				.text('OK!').addClass('help-inline')
				.closest('.control-group')
				.removeClass('error').addClass('success');
			}
		});
	});
}