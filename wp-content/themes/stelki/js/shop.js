// shop scripts
$(function(){

	add_to_cart();
	add_to_wl();
	change_cart_qty();
	remove_from_cart();
	wl_remove();
	wl_move();
	wl_copy();

	$('.comment-form-rating a').click(function(e){
  	cur_index = $(this).text();
  	$(this).siblings().each(function(){
  		if($(this).text() < cur_index) {
        $(this).addClass('filled');
      }else{
        $(this).removeClass('filled');
      }
  	});
  });

	$('[name=update_user]').submit(function(e){
		e.preventDefault();
		var data = {};
		data.first_name = $(this).find('[name=account_first_name]').val();
		data.last_name = $(this).find('[name=account_last_name]').val();
		data.user_email = $(this).find('[name=account_email]').val();
		jxAction('update_user', data);
	});

	$('[name=update_password]').submit(function(e){
		e.preventDefault();
		var data = {};
		data.password_current = $(this).find('[name=password_current]').val();
		data.password_1 = $(this).find('[name=password_1]').val();
		data.password_2 = $(this).find('[name=password_2]').val();
		jxAction('update_password', data);
	});

	$('[name=update_billing]').submit(function(e){
		e.preventDefault();
		var data = {};
		data.form = jxFormData($(this));
		jxAction('update_billing', data);
	});

	$('[name=update_shipping]').submit(function(e){
		e.preventDefault();
		var data = {};
		data.form = jxFormData($(this));
		jxAction('update_shipping', data);
	});

	$('[data-price-slider]').slider({
		step: parseInt($("[data-ui-slider]").attr('data-ui-slider')),
		range: true,
		min: parseInt($("[name=min_price]").attr('data-value')),
		max: parseInt($("[name=max_price]").attr('data-value')),
		values: [ parseInt($("[name=min_price]").val()), parseInt($("[name=max_price]").val()) ],
		slide: function(event, ui) {
			$("[name=min_price]").val(ui.values[0]).keyup();
			$("[name=max_price]").val(ui.values[1]).keyup();
		}
	});

	$('[data-action=product_var_select]').each(function(){
		if($(this).find('option').length){
			product_content = $(this).parents('[data-content=product]');
			product_content.find('[data-variation-id]').hide();
			variation_id = product_content.find('[data-action=product_var_select] option')[0].value;
			if(variation_id !== undefined && variation_id !== ''){
				product_content.find('[data-variation-id='+variation_id+']').show();
				if($(this).find('option[value='+variation_id+']').attr('data-in-stock') === '1'){
					product_content.find('[data-var-in-stock=1]').show();
					product_content.find('[data-var-in-stock=0]').hide();
				}else{
					product_content.find('[data-var-in-stock=0]').show();
					product_content.find('[data-var-in-stock=1]').hide();
				}
			}
		}
	});

	$('[data-action=product_var_select]').change(function(){
		product_content = $(this).parents('[data-content=product]');
		$(this).parents('form').attr('data-product-id', $(this).val());
		product_content.find('[data-variation-id]').hide();
		product_content.find('[data-variation-id='+$(this).val()+']').show();
		if($(this).find('option[value='+$(this).val()+']').attr('data-in-stock') === '1'){
			product_content.find('[data-var-in-stock=1]').show();
			product_content.find('[data-var-in-stock=0]').hide();
		}else{
			product_content.find('[data-var-in-stock=0]').show();
			product_content.find('[data-var-in-stock=1]').hide();
		}
	})

	$('[data-action=product_qty_plus]').click(function(){
		product_qty = $(this).parents('form').find('[data-name=qty]');
		product_qty.val(parseInt(product_qty.val())+1);
	})

	$('[data-action=product_qty_minus]').click(function(){
		product_qty = $(this).parents('form').find('[data-name=qty]');
		if(parseInt(product_qty.val()) > 1){
			product_qty.val(parseInt(product_qty.val())-1);
		}
	})

})

function add_to_cart(){
	$('[data-name=add_to_cart]').submit(function(e){
		e.preventDefault();
		var data = {};
		data.id = $(this).attr('data-product-id');
		data.qty = $(this).find('[data-name=qty]').length === 0 ? '1' : $(this).find('[data-name=qty]').val();
		$(this).find('[data-name=qty]').val('1');
		jxAction('add_to_cart', data);
		$(this).siblings('.w-form-done').show();
	})
}

function add_to_wl(){
	$('[data-name=add_to_wl]').submit(function(e){
		e.preventDefault();
		var data = {};
		data.id = $(this).attr('data-product-id');
		jxAction('add_to_wl', data);
		$(this).siblings('.w-form-done').show();
	})
}

function wl_remove(){
	$('[data-action=wl_remove]').click(function(e){
		e.preventDefault();
		var data = {};
		data.id = [];
		data.id[0] = $(this).attr('data-product-id');
		jxAction('wl_remove', data);
	})
}

function wl_move(){
	$('[data-action=wl_move]').click(function(e){
		e.preventDefault();
		var data = {};
		data.id = [];
		data.id[0] = $(this).attr('data-product-id');
		jxAction('wl_move', data);
	})
}

function wl_copy(){
	$('[data-action=wl_copy]').click(function(e){
		e.preventDefault();
		var data = {};
		data.id = [];
		data.id[0] = $(this).attr('data-product-id');
		jxAction('wl_copy', data);
	})
}

function change_cart_qty(){
	$('[data-action=cart_product_qty]').change(function(e){
		var data = {};
		data.id = $(this).attr('data-product-id');
		data.qty = $(this).val();
		jxAction('change_cart_qty', data);
	})
	$('[data-action=cart_qty_plus]').click(function(){
		product_qty = $(this).siblings('[data-name=qty]');
		product_qty.val(parseInt(product_qty.val())+1);
		var data = {};
		data.id = product_qty.attr('data-product-id');
		data.qty = product_qty.val();
		jxAction('change_cart_qty', data);
	})

	$('[data-action=cart_qty_minus]').click(function(){
		product_qty = $(this).siblings('[data-name=qty]');
		if(parseInt(product_qty.val()) > 1){
			product_qty.val(parseInt(product_qty.val())-1);
			var data = {};
			data.id = product_qty.attr('data-product-id');
			data.qty = product_qty.val();
			jxAction('change_cart_qty', data);
		}
	})
}

function remove_from_cart(){
	$('[data-action=cart_product_remove]').click(function(e){
		var data = {};
		data.id = $(this).attr('data-product-id');
		data.qty = 0;
		jxAction('change_cart_qty', data);
	})
}
