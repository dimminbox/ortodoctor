jQuery(document).ready(function($){

$('[data-copy]').click(function(){
  params = $(this).attr('data-copy').split(' ');
  $('.'+params[1]).html($(this).parent().find('.'+params[0]).html());
	Webflow.ready();
});

$('[data-object=wp_term_menu] a').each(function(){
if(document.URL === $(this).attr('href')){
  $(this).addClass('active');
	$(this).addClass('w--current');
	$(this).parents().each(function(){
		if($(this).attr('data-object') === 'wp_term_menu') return false;
    $(this).addClass('active');
    $(this).addClass('w--current');
	});
}
});

$('a').not('.w--current,.active').each(function(){
if(document.URL === $(this).attr('href')){
	$(this).addClass('w--current');
}
});

// адаптивность изображений
$('img').each(function(){
	$(this).removeAttr('height');
});

// обработка полей фильтра
$('[name=search]').submit(function(e){
	var form = $(this);
	if($(this).find('[name=s]').val() === ''){
		$(this).find('[name=s]').removeAttr('name');
	}
	$(this).find('[data-taxonomy]').each(function(){
		values = [];
		taxonomy = $(this).attr('data-taxonomy');
		$(this).find('input:checked:enabled').each(function(){
			values.push($(this).val());
			$(this).removeAttr('name');
		})
		values = values.join(',');
		if(values != '') {
			form.append('<input type = "hidden" name = "'+taxonomy+'" value = "'+values+'">');
		}
	});
	$(this).find('.w-input').each(function(){
		if($(this).attr('data-value') === $(this).val()){
			$(this).removeAttr('name');
		}
	});
});

// слайдер диапозонов значений
$('[data-range-slider]').each( function(){
	var field = $(this).attr('data-range-slider');
	$(this).slider({
	step: parseInt($(this).attr('data-ui-slider')),
	range: true,
	min: parseInt($("[name=min_pm_"+field+"]").attr('data-value')),
	max: parseInt($("[name=max_pm_"+field+"]").attr('data-value')),
	values: [ parseInt($("[name=min_pm_"+field+"]").val()), parseInt($("[name=max_pm_"+field+"]").val()) ],
	slide: function(event, ui) {
		$("[name=min_pm_"+field+"]").val(ui.values[0]).keyup();
		$("[name=max_pm_"+field+"]").val(ui.values[1]).keyup();
	}
	});
});

});
