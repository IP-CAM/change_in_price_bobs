<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
<div class="page-header">
	<div class="container-fluid">
		<div class="pull-right">
			<button type="submit" form="form-product" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i></button>
			<a href="<?php echo $cancel; ?>" data-toggle="tooltip" title="<?php echo $button_cancel; ?>" class="btn btn-default"><i class="fa fa-reply"></i></a>
		</div>
		<h1><?php echo $heading_title; ?></h1>
		<ul class="breadcrumb">
			<?php foreach ($breadcrumbs as $breadcrumb) { ?>
			<li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
			<?php } ?>
		</ul>
	</div>
</div>
<div class="container-fluid">
	<?php if ($success) { ?>
	<div class="alert alert-success"><i class="fa fa-check-circle"></i> <?php echo $success; ?>
		<button type="button" class="close" data-dismiss="alert">&times;</button>
	</div>
	<?php } ?>
	<?php if ($info) { ?>
		<div class="alert alert-info">
			<p><i class="fa fa-info-circle"></i> <?php echo $info; ?></p>
		</div>
	<?php } ?>

	<div class="panel panel-default">
		<div class="panel-heading">
			<h3 class="panel-title"><i class="fa fa-list"></i> <?php echo $text_list; ?></h3>
		</div>
		<div class="panel-body">
			<div class="well">
				<div class="row">
					<div class="col-sm-4">
						<div class="form-group">
							<label class="control-label" for="input-name"><?php echo $entry_name; ?></label>
							<input type="text" name="filter_name" value="<?php echo $filter_name; ?>" placeholder="<?php echo $entry_name; ?>" id="input-name" class="form-control" />
						</div>
						<div class="form-group">
							<label class="control-label" for="input-model"><?php echo $entry_model; ?></label>
							<input type="text" name="filter_model" value="<?php echo $filter_model; ?>" placeholder="<?php echo $entry_model; ?>" id="input-model" class="form-control" />
						</div>
						<div class="form-group">
							<label class="control-label" for="input-category"><?php echo $column_category; ?></label>
							<select name="filter_category" id="input-category" class="form-control">
								<option value="*"></option>
								<?php foreach ($categories as $category) { ?>
								<?php if ($category['product_count'] >= 1) { ?>
								<?php if ($category['category_id']==$filter_category) { ?>
								<option value="<?php echo $category['category_id']; ?>" selected="selected"><?php echo $category['name']; ?>&nbsp;&nbsp;&nbsp;&nbsp;</option>
								<?php } else { ?>
								<option value="<?php echo $category['category_id']; ?>">&nbsp;&nbsp;<?php echo $category['name']; ?>&nbsp;&nbsp;&nbsp;&nbsp;</option>
								<?php } ?>
								<?php } ?>
								<?php } ?>
							</select>
						</div>
					</div>
					<div class="col-sm-4">
						<div class="form-group">
							<label class="control-label" for="input-price"><?php echo $entry_price; ?></label>
							<input type="text" name="filter_price" value="<?php echo $filter_price; ?>" placeholder="<?php echo $entry_price; ?>" id="input-price" class="form-control" />
						</div>
						<div class="form-group">
							<label class="control-label" for="input-quantity"><?php echo $entry_quantity; ?></label>
							<input type="text" name="filter_quantity" value="<?php echo $filter_quantity; ?>" placeholder="<?php echo $entry_quantity; ?>" id="input-quantity" class="form-control" />
						</div>
					</div>
					<div class="col-sm-4">
						<div class="form-group">
							<label class="control-label" for="input-status"><?php echo $entry_status; ?></label>
							<select name="filter_status" id="input-status" class="form-control">
								<option value="*"></option>
								<?php if ($filter_status) { ?>
								<option value="1" selected="selected"><?php echo $text_enabled; ?></option>
								<?php } else { ?>
								<option value="1"><?php echo $text_enabled; ?></option>
								<?php } ?>
								<?php if (!$filter_status && !is_null($filter_status)) { ?>
								<option value="0" selected="selected"><?php echo $text_disabled; ?></option>
								<?php } else { ?>
								<option value="0"><?php echo $text_disabled; ?></option>
								<?php } ?>
							</select>
						</div>
						<div class="form-group">
							<label class="control-label" for="input-image"><?php echo $entry_image; ?></label>
							<select name="filter_image" id="input-image" class="form-control">
								<option value="*"></option>
								<?php if ($filter_image) { ?>
								<option value="1" selected="selected"><?php echo $text_enabled; ?></option>
								<?php } else { ?>
								<option value="1"><?php echo $text_enabled; ?></option>
								<?php } ?>
								<?php if (!$filter_image && !is_null($filter_image)) { ?>
								<option value="0" selected="selected"><?php echo $text_disabled; ?></option>
								<?php } else { ?>
								<option value="0"><?php echo $text_disabled; ?></option>
								<?php } ?>
							</select>
						</div>
						<button type="button" id="button-filter" class="btn btn-primary pull-right"><i class="fa fa-filter"></i> <?php echo $button_filter; ?></button>
					</div>
				</div>
			</div>

			<form action="<?php echo $basePrice; ?>" method="post" id="form-base-price">
				<div class="well">
					<div class="row form-group">
						<div class="col-sm-8">
							<input type="text" name="base_price_factor" value="<?php echo $base_price_factor; ?>" placeholder="<?php echo $help_base_price; ?>" class="form-control" />
						</div>
						<div class="col-sm-1">
							<button name="base_price_button" form="form-base-price"  data-toggle="tooltip" title="<?php echo $help_base_price_button; ?>" class="btn btn-primary"><i class="fa fa-hand-o-up"></i></button>
						</div>
						<div class="col-sm-3">
							<span><?php echo $help_base_price; ?></span>
						</div>
					</div>
				</div>
			</form>
			<form action="<?php echo $saveAll; ?>" method="post" id="form-product">

				<div class="table-responsive">
					<table class="table table-bordered table-hover">
						<thead>
						<tr>
							<td class="text-center"><?php echo $column_image; ?></td>
							<td class="text-left"><?php if ($sort == 'pd.name') { ?>
								<a href="<?php echo $sort_name; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_name; ?></a>
								<?php } else { ?>
								<a href="<?php echo $sort_name; ?>"><?php echo $column_name; ?></a>
								<?php } ?></td>
							<td class="text-left"><?php if ($sort == 'p.model') { ?>
								<a href="<?php echo $sort_model; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_model; ?></a>
								<?php } else { ?>
								<a href="<?php echo $sort_model; ?>"><?php echo $column_model; ?></a>
								<?php } ?></td>
							<td class="text-right"><?php if ($sort == 'p.price') { ?>
								<a href="<?php echo $sort_price; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_price; ?></a>
								<?php } else { ?>
								<a href="<?php echo $sort_price; ?>"><?php echo $column_price; ?></a>
								<?php } ?></td>
							<td class="text-left"><?php echo $column_category; ?></td>
							<td class="text-left"><?php echo $column_discount; ?></td>
							<td class="text-left"><?php echo $column_options; ?></td>
							<td class="text-right column_quantity"><?php if ($sort == 'p.quantity') { ?>
								<a href="<?php echo $sort_quantity; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_quantity; ?></a>
								<?php } else { ?>
								<a href="<?php echo $sort_quantity; ?>"><?php echo $column_quantity; ?></a>
								<?php } ?></td>
							<td class="text-left column_status"><?php if ($sort == 'p.status') { ?>
								<a href="<?php echo $sort_status; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_status; ?></a>
								<?php } else { ?>
								<a href="<?php echo $sort_status; ?>"><?php echo $column_status; ?></a>
								<?php } ?></td>
							<td class="text-right"><?php echo $column_action; ?></td>
						</tr>
						</thead>
						<tbody>
						<?php if ($products) { ?>
						<?php foreach ($products as $product) { ?>
						<tr>


							<td class="text-center"><?php if ($product['image']) { ?>
								<img src="<?php echo $product['image']; ?>" alt="<?php echo $product['name']; ?>" class="img-thumbnail" />
								<?php } else { ?>
								<span class="img-thumbnail list"><i class="fa fa-camera fa-2x"></i></span>
								<?php } ?></td>


							<td class="text-left"><?php echo $product['name']; ?></td>


							<td class="text-left"><?php echo $product['model']; ?></td>


							<td class="text-left price_td">

								<input type="text"
									   name="price_<?php echo $product['product_id'] ?>"
									   value="<?php echo $product['price']; ?>"
									   placeholder="<?php echo $entry_price; ?>"
									   class="form-control"/>
								<span class="old_price" style="display: none;"><?php echo $old_product_text; ?></span>
								<span class="old_price"
									  style="display: none;"
									  name="old_price_<?php echo $product['product_id'] ?>">
									<?php echo $product['price']; ?></span>

								<?php if (!empty($product['special'])) { ?>
								<div class="special_price_box">
									<span><?php echo $product_special_text; ?></span>
									<div class="input-group">
										<input type="text"
											   name="product_special_id_<?php echo $product['special']['product_special_id'] ?>"
											   value="<?php echo $product['special']['price']; ?>"
											   class="form-control"/>
                          				<span class="input-group-btn">
                          					<button type="button" name="delete_special_<?php echo $product['product_id'] ?>" data-toggle="tooltip" title="<?php echo $entry_delete_special; ?>" class="btn btn-danger"><i class="fa fa-trash-o"></i></button>
                          				</span>
									</div>
									<span class="old_special_price" style="display: none;">
										<?php echo $old_product_special_text; ?>
									</span>
									<span class="old_special_price"
										  style="display: none;"
										  name="old_special_price_<?php echo $product['product_id'] ?>">
										<?php echo $product['special']['price']; ?>
									</span>
								</div>
								<?php } ?>
							</td>


							<td class="text-left">
								<?php foreach ($categories as $category) { ?>
								<?php if (in_array($category['category_id'], $product['category'])) { ?>
								<?php echo $category['name'];?><br>
								<?php } ?>
								<?php } ?></td>


							<td class="text-center" name="discount_product_<?php echo $product['product_id'] ?>">
								<button type="button" name="discount_<?php echo $product['product_id'] ?>" data-toggle="tooltip" title="<?php echo $entry_discount_button; ?>" class="btn btn-primary discount_button"><i class="fa fa-plus-square"></i></button>
							</td>

							<td class="text-center" name="options_product_<?php echo $product['product_id'] ?>">
								<button type="button" name="options_<?php echo $product['product_id'] ?>" data-toggle="tooltip" title="<?php echo $entry_options_button; ?>" class="btn btn-primary options_button"><i class="fa fa-plus-square"></i></button>
							</td>


							<td class="text-center column_quantity" style="width: 100px">
								<input type="text"
									   name="quantity_<?php echo $product['product_id'] ?>"
									   value="<?php echo $product['quantity']; ?>"
									   class="form-control"/>
								<span class="old_quantity" style="display: none;"><?php echo $old_quantity_text; ?></span>
								<span class="old_quantity"
									  style="display: none;"
									  name="old_quantity_<?php echo $product['product_id'] ?>">
									<?php echo $product['quantity']; ?>
								</span>
							</td>


							<td class="text-left column_status" style="width: 130px">
								<select name="status_<?php echo $product['product_id'] ?>" class="form-control">
									<?php if ($product['status']) { ?>
										<option value="1" selected="selected"><?php echo $text_enabled; ?></option>
										<option value="0"><?php echo $text_disabled; ?></option>
									<?php } else { ?>
										<option value="1"><?php echo $text_enabled; ?></option>
										<option value="0" selected="selected"><?php echo $text_disabled; ?></option>
									<?php } ?>
								</select>
								<span class="old_status" style="display: none;"><?php echo $old_status_text; ?></span>
								<span class="old_status"
									  style="display: none;"
									  name="old_status_<?php echo $product['product_id'] ?>">
									<?php if ($product['status']) { ?>
									<?php echo $text_enabled; ?>
									<?php } else { ?>
									<?php echo $text_disabled; ?>
									<?php } ?>
								</span>
							</td>


							<td class="text-right">
								<button type="button" name="<?php echo $product['product_id'] ?>" data-toggle="tooltip" title="<?php echo $entry_save; ?>" class="btn btn-primary save_button"><i class="fa fa-save"></i></button>
								<a href="<?php echo $product['edit']; ?>" data-toggle="tooltip" title="<?php echo $entry_edit_product; ?>" class="btn btn-primary"><i class="fa fa-pencil"></i></a></td>


						</tr>
						<?php } ?>
						<?php } else { ?>
						<tr>
							<td class="text-center" colspan="10"><?php echo $text_no_results; ?></td>
						</tr>
						<?php } ?>
						</tbody>
					</table>
				</div>
			</form>
			<div class="row">
				<div class="col-sm-6 text-left"><?php echo $pagination; ?></div>
				<div class="col-sm-6 text-right"><?php echo $results; ?></div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript"><!--

	//visible old prise
	$('.price_td [name ^= price_]:input').change(function(){
		$(this).siblings('.old_price').show();
	});
	//visible old prise special
	$('.price_td [name ^= product_special_id_]:input').change(function(){
		$(this).parent().siblings('.old_special_price').show();
	});
	//visible old prise special
	$('[name ^= quantity_]:input').change(function(){
		$(this).siblings('.old_quantity').show();
	});
	//visible old prise special
	$('[name ^= status_]').change(function(){
		$(this).siblings('.old_status').show();
	});


	$('.price_td [name ^= delete_special_]').click(function()
		{
			var inputSpecialPriceBox = $(this).parent().siblings(':input');
			var product_special_id=inputSpecialPriceBox.attr('name').replace('product_special_id_', '');
			//alert(product_special_id);
			$.ajax({
				url: 'index.php?route=extension/module/massive_change_in_price_bobs/deleteSpecial&token=<?php echo $token; ?>&product_special_id=' + product_special_id,
				dataType: 'json',
				success: function(json) {
					//alert(json);
					if(json != false) {
						inputSpecialPriceBox.attr('name', 'product_special_id_'+json['product_special_id']);
						inputSpecialPriceBox.val(json['price']);
						//alert('yes');
						//alert(json);
					} else {
						inputSpecialPriceBox.parent().parent().hide();
					}
				}
			});
			}
	);

	$('.table-responsive').on('click', '[name ^= delete_discount_]', deleteDiscount);
	function deleteDiscount() {

		var product_discount_id = $(this).attr('name').replace('delete_discount_', '');
		var button_delete = $(this);
		$.ajax({
			url: 'index.php?route=extension/module/massive_change_in_price_bobs/deleteDiscount&token=<?php echo $token; ?>&product_discount_id=' + product_discount_id,
			dataType: 'json',
			success: function (json) {
				var context_tr = button_delete.parent().parent().parent().parent().parent().parent();
				$('.discount_product_sub_block', context_tr).empty();
				//context_tr.empty();
				var discount_sub = renderDiscountHTML(json);
				$('.discount_product_sub_block', context_tr).append(discount_sub);

			}
		});
	}


	var product_id_discount_open= [];
	$('.table-responsive').on('click', '.discount_button', discount);
	function discount() {
		viewPostParameters(this, 'discount', product_id_discount_open)
	}


	var product_id_options_open= [];
	$('.table-responsive').on('click', '.options_button', options);
	function options() {
		viewPostParameters(this, 'options', product_id_options_open);
	}



	function viewPostParameters(this_event_call, prefix, product_id_array)
	{

		prefix = prefix + "_";
		var product_id=$(this_event_call).attr('name').replace(prefix, '');
		//alert(prefix +' as ' + product_id);
		if (typeof product_id_array[product_id] != "undefined") {
			//alert("dom : " + "[name=" + prefix + "product_" + product_id + "] ." + prefix + "product_sub_block");
			var DOM_element = $("[name=" + prefix + "product_" + product_id + "] ." + prefix + "product_sub_block");
			//alert("name :  " +DOM_element.attr('name'));
			//alert('DOM_element ' + DOM_element);
			showOrHide(product_id, DOM_element, product_id_array);
			//alert('showOrHide, product_id ' + product_id );
		} else {
			//alert('dsfs');
			product_id_array[product_id] = 'show';
			switch(prefix) {
				case 'discount_':
					renderDiscount(product_id);
					break;
				case 'options_':
					renderOptions(product_id);
					break;
			}

			//alert('renderOptions, product_id '  + product_id);
		}
		hideAndShowColumn();
	}


	function renderDiscount(product_id) {
		//alert('dsfs2');
		$.ajax({
			url: 'index.php?route=extension/module/massive_change_in_price_bobs/discount&token=<?php echo $token; ?>&product_id=' + product_id,
			dataType: 'json',
			success: function(json){
				var discount_sub = renderDiscountHTML(json);
				$("[name=discount_product_" + product_id + "]").append(discount_sub);
			}
		});
	}

	function renderDiscountHTML(json) {
		var discount_sub = '<div class="discount_product_sub_block">';

		if(json.length)
		{
			//alert('dsfs ' + json.length);
			var discount = '';
			discount +='<div class="row text-left">';
			discount +='<div class="col-sm-4">';
			discount +='<?php echo $discount_text_quantity; ?>';
			discount +='</div>';
			discount +='<div class="col-sm-8">';
			discount +='<?php echo $discount_text_price; ?>';
			discount +='</div>';
			discount +='</div>';

			discount_sub += discount;
			for (i = 0; i < json.length; i++) {
				////alert('555');

				var discount = '';
				discount +='<div class="row text-left">';
				discount +='<div class="col-sm-4">';
				discount +='<input type="text" name="product_discount_quantity_id_' + json[i]['product_discount_id'] + '" value="' + json[i]['quantity'] + '" class="form-control"/>';
				discount +='</div>';
				discount +='<div class="col-sm-8">';
				discount +='<div class="input-group">';
				discount +='<input type="text" name="product_discount_price_id_' + json[i]['product_discount_id'] + '" value="' + json[i]['price'] + '" class="form-control"/>';
				discount +='<span class="input-group-btn">';
				discount +='<button type="button" name="delete_discount_' + json[i]['product_discount_id'] + '" data-toggle="tooltip" title="<?php echo $entry_delete_discount; ?>" class="btn btn-danger"><i class="fa fa-trash-o"></i></button>';
				discount +='</span>';
				discount +='</div>';
				discount +='</div>';
				discount +='</div>';

				discount_sub += discount;
				//alert(discount);
			}
		} else {
			discount_sub += attentionsNoDiscountHTML();
		}
		discount_sub += '</div>';

		return discount_sub;

	}

	function attentionsNoDiscountHTML() {
		return '<div class="text-left"><?php echo $attentions_no_discount; ?></div>';
	}






	function renderOptions(product_id) {
		//alert('renderOptions' + ' ' + product_id);
		$.ajax({
			url: 'index.php?route=extension/module/massive_change_in_price_bobs/options&token=<?php echo $token; ?>&product_id=' + product_id,
			dataType: 'json',
			success: function (json) {
				var options_sub = '<div class="options_product_sub_block">';
				if(json.length)
				{
					//alert('dsfs' + json);
					for (i = 0; i < json.length; i++) {
						//alert('555');
						if(json[i]['options']) {
							var options = '<div class="text-left"><strong>' + json[i]['name'] +": " + '</strong></div>';
							for (isub = 0; isub < json[i]['options'].length; isub++) {
								options +='<div class="row text-left">';
								options +='<div class="col-sm-6">';
								options +=json[i]['options'][isub]['name'] + ' ' + json[i]['options'][isub]['price_prefix'];
								options +='</div>';
								options +='<div class="col-sm-6">';
								options +='<input type="text" name="product_option_value_id_' + json[i]['options'][isub]['product_option_value_id'] + '" value="' + json[i]['options'][isub]['price'] + '" class="form-control" />'
								options +='</div>';
								options +='</div>';
							}
						} else {
							var options = '<div class="text-left"><strong>' + json[i]['name'] + "</strong>: ";
							options +='<?php echo $attentions_no_options_price; ?>';
							options +='</div>';
						}

						options_sub += options;
						//alert(options);
					}
				} else {
					options_sub += '<div class="text-left"><?php echo $attentions_no_options; ?></div>';
				}
				options_sub += '</div>';
				$("[name=options_product_" + product_id + "]").append(options_sub);
			}
		});
	}


	function showOrHide(product_id, DOM_element, product_id_array) {
		switch(product_id_array[product_id]) {
			case 'show':
				DOM_element.hide();
				product_id_array[product_id] = 'hide';
				//alert('DOM_element: ' +DOM_element.attr('name'));
				break;
			case 'hide':
				DOM_element.show();
				product_id_array[product_id] = 'show';
				//alert('show: ' +product_id_options_open);
				break;
		}
	}

	function hideAndShowColumn() {
		if(product_id_discount_open.indexOf('show') == -1 &&
				product_id_options_open.indexOf('show') == -1) {

			$('.column_quantity').show();
			$('.column_status').show();
		} else {
			$('.column_quantity').hide();
			$('.column_status').hide();
		}
	}


	$('.save_button').click(function()
		{

			var url = "";
			var context_tr = $(this).parent().parent();

			var product_id = $(this).attr('name');
			var price = $('[name = "price_' + product_id + '"]').val();
			var price_special = $("[name ^= product_special_id_]", context_tr).val();
			//var discount_quantity = $("[name ^= product_discount_quantity_id_]", context_tr).val();
			//var discount_price = $("[name ^= product_discount_price_id_]", context_tr).val();
			var quantity = $("[name ^= quantity_]", context_tr).val();

			var status = $("[name ^= status_]", context_tr).val();


			//gather date
			url += $("[name ^= price_]", context_tr).attr('name') +
					"=" +
					encodeURIComponent($("[name ^= price_]", context_tr).val());


			$("[name ^= discount_product] .form-control", context_tr).each(function(i,elem) {
				url += '&' + $(this).attr('name') + "=" + encodeURIComponent($(this).val());
				alert('kjh');
			});



			$("[name ^= options_product] .form-control", context_tr).each(function(i,elem) {
				url += '&' + $(this).attr('name') + "=" + encodeURIComponent($(this).val());
			});

			$("[name ^= product_special_id_]", context_tr).each(function(i,elem) {
				url += '&' + $(this).attr('name') + "=" + encodeURIComponent($(this).val());
			});

			url += "&" + $("[name ^= quantity_]", context_tr).attr('name') +
			"=" +
			encodeURIComponent($("[name ^= quantity_]", context_tr).val());

			url += "&" + $("[name ^= status_]", context_tr).attr('name') +
			"=" +
			encodeURIComponent($("[name ^= status_]", context_tr).val());
			//alert('name ' +$("[name ^= quantity_]", context_tr).attr('name'));
			//alert('val ' +$("[name ^= quantity_]", context_tr).val());

			$.ajax({
				url: 'index.php?route=extension/module/massive_change_in_price_bobs/save&token=<?php echo $token; ?>',
				dataType: 'json',
				type: 'post',
				data: url,
				success: function(json) {
					//alert(price+"p"+product_id);
					$("[name ^= old_price_]", context_tr).text(price);
					$("[name ^= old_special_price_]", context_tr).text(price_special);
					$("[name ^= old_quantity_]", context_tr).text(quantity);
					$("[name ^= old_status_]", context_tr).text(status);

					$(".old_price", context_tr).hide();
					$(".old_special_price", context_tr).hide();
					$(".old_quantity", context_tr).hide();
					$(".old_status", context_tr).hide();
				}
			});
		}
	);
	//--></script>

<script type="text/javascript"><!--
	$('#button-filter').on('click', function() {
		var url = 'index.php?route=extension/module/massive_change_in_price_bobs&token=<?php echo $token; ?>';

		var filter_name = $('input[name=\'filter_name\']').val();

		if (filter_name) {
			url += '&filter_name=' + encodeURIComponent(filter_name);
		}

		var filter_model = $('input[name=\'filter_model\']').val();

		if (filter_model) {
			url += '&filter_model=' + encodeURIComponent(filter_model);
		}

		var filter_price = $('input[name=\'filter_price\']').val();

		if (filter_price) {
			url += '&filter_price=' + encodeURIComponent(filter_price);
		}


		var filter_category = $('select[name=\'filter_category\']').val();

		if (filter_category != '*') {
			url += '&filter_category=' + encodeURIComponent(filter_category);
		}

		var filter_quantity = $('input[name=\'filter_quantity\']').val();

		if (filter_quantity) {
			url += '&filter_quantity=' + encodeURIComponent(filter_quantity);
		}

		var filter_status = $('select[name=\'filter_status\']').val();

		if (filter_status != '*') {
			url += '&filter_status=' + encodeURIComponent(filter_status);
		}

		var filter_image = $('select[name=\'filter_image\']').val();

		if (filter_image != '*') {
			url += '&filter_image=' + encodeURIComponent(filter_image);
		}

		location = url;
	});
	//--></script>
<script type="text/javascript"><!--
	$('input[name=\'filter_name\']').autocomplete({
		'source': function(request, response) {
			$.ajax({
				url: 'index.php?route=extension/module/massive_change_in_price_bobs/autocomplete&token=<?php echo $token; ?>&filter_name=' +  encodeURIComponent(request),
				dataType: 'json',
				success: function(json) {
					response($.map(json, function(item) {
						return {
							label: item['name'],
							value: item['product_id']
						}
					}));
				}
			});
		},
		'select': function(item) {
			$('input[name=\'filter_name\']').val(item['label']);
		}
	});

	$('input[name=\'filter_model\']').autocomplete({
		'source': function(request, response) {
			$.ajax({
				url: 'index.php?route=extension/module/massive_change_in_price_bobs/autocomplete&token=<?php echo $token; ?>&filter_model=' +  encodeURIComponent(request),
				dataType: 'json',
				success: function(json) {
					response($.map(json, function(item) {
						return {
							label: item['model'],
							value: item['product_id']
						}
					}));
				}
			});
		},
		'select': function(item) {
			$('input[name=\'filter_model\']').val(item['label']);
		}
	});
	//--></script></div>
<?php echo $footer; ?>
