const faqSelect = document.getElementById('faq-select');
const answerContainer = document.getElementById('answer');

const faqs = {
  1: 'El horario de atención es de lunes a viernes de 9:00 a 16:00.',
  2: 'Ingresa a la pagina consulta beneficiario, y ahi encontraras:  Modalidad de pago, Pagos pendientes, Periodo de pago  ¡Sólo necesitas tu CURP!',
  3: 'Consulta la pagina buscador de escuelas y con tan solo tu Clave escolar, encontraras las posibilidades de aplicar!! ',
  4: 'Las fechas de incorporacion por lo general comienzan a principios de ciclo escolar, pero te recomendamos ir alas oficinas para asegurar que se encuentre abierta esa convocatoria',
  5: 'El servicio de Informacion general te ayudara a detectar cual es el problema ',
  6: 'Descargando la App Banco de Bienestar',  
  7: 'El bloqueo es de protección a solicitud del programa, las titulares pueden solicitar el desbloqueo en cualquier sucursal, solo deben presentar ya sea tarjeta e INE o Contrato e INE en original y copia.'
};

faqSelect.addEventListener('change', function() {
  const selectedValue = this.value;
  answerContainer.textContent = faqs[selectedValue] || '';
});