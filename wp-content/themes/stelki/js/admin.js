jQuery(document).ready(function($){

  $('.acf-add-checkbox').text('Добавить');
  $('#publishing-action input').val('Обновить'); $('#submitdiv h2 span').text('Опубликовать');
  $('.acf-settings-wrap .error p').html('Поля для данной страницы опций не заданы. Вы можете настроить их в разделе <a href="/wp-admin/edit.php?post_type=acf-field-group">Группы полей</a>.');

  $('#acf-field-group-fields').on('blur', '.field-label,.acf-fc-meta-label input', function(){
    if($(this).val() != '-') {
      acf_name_selector = '#'+$(this).attr('id').replace('-label', '-name');
      acf_name_value = getSlug($(this).val(),{separator: '_'}).replace('-','_');
      if($(this).val().replace(new RegExp(" ",'g'),'_').toLowerCase() === $(acf_name_selector).val() || $(acf_name_selector).val() === ''){
        $(acf_name_selector).val(acf_name_value);
      }
    }
  });

});
