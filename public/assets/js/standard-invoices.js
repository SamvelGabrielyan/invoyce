/******** SHow preview****************/

	function showPreview(){
		$('#item_div').html("");
		document.getElementById("s_company_name").innerHTML=jQuery('#company_name').val();
		document.getElementById("s_email").innerHTML=jQuery('#email').val();
		// document.getElementById("s_additional_email").innerHTML=jQuery('#additional_email').val();
		document.getElementById("s_address").innerHTML=jQuery('#address').val();

		document.getElementById("s_city").innerHTML=jQuery('#city').val();
		document.getElementById("s_state").innerHTML=jQuery('#state').val();
		document.getElementById("s_zip_code").innerHTML=jQuery('#zip_code').val();
		document.getElementById("s_phone").innerHTML=jQuery('#phone').val();
		//document.getElementById("s_invoice_title").innerHTML=jQuery('#invoice_title').val();
		document.getElementById("s_invoice_number").innerHTML=jQuery('#invoice_number').val();
		//document.getElementById("s_invoice_message").innerHTML=jQuery('#invoice_message').val();
		//document.getElementById("s_terms_conditions").innerHTML=jQuery('#terms_conditions').val();

		var totalInAmount=0;
		var discountAmount=0;
		var disType='';
		var totalDis=0;
		var totalInvoice=jQuery('#totalInvoice').val();
		for (i = 1; i <= totalInvoice; i++) {
			var item_name= jQuery('#item_name_'+i).val();
			var item_description= jQuery('#item_description_'+i).val();
			var item_rate= jQuery('#item_rate_'+i).val();
			var item_qty= jQuery('#item_qty_'+i).val();
			var item_discount= jQuery('#item_discount_'+i).val();
			var item_dis= jQuery('#item_dis_'+i).val();
			var itemPrice=item_rate * item_qty;
			$("#item_div").append('<tr><td class="text-left">'+item_name+'</td><td class="text-left">'+item_description+' </td><td class="text-left">$'+item_rate+'  </td><td class="text-left">'+item_qty+'</td> <td class="text-right">$'+itemPrice+'</td> </tr> ');


			var radios = document.getElementsByName('item_dis_'+i);
			for (var l = 0, length = radios.length; l < length; l++) {
				if (radios[l].checked) {
					disType =radios[l].value;
				}
			}
			if(typeof item_discount!="undefined" && item_discount!='' && item_discount!=0){
				if(disType=='yes'){
					discountAmount=item_discount;
				}else{
					discountAmount=(itemPrice*item_discount)/100;
				}

			} else{
				discountAmount=0;
			}
			totalDis = +totalDis + +discountAmount;
			totalInAmount = +totalInAmount + +(itemPrice-discountAmount);

		}

		var sub_total= totalInAmount+totalDis;

		var totalInAmount = totalInAmount.toLocaleString(  undefined, // use a string like 'en-US' to override browser locale
														 { minimumFractionDigits: 2 }
														);
		var totalDis = totalDis.toLocaleString(  undefined, // use a string like 'en-US' to override browser locale
											   { minimumFractionDigits: 2 }
											  );
		document.getElementById('s_totalAmount').innerHTML =totalInAmount;
		document.getElementById('s_totalDiscount').innerHTML =totalDis;
		var sub_total = sub_total.toLocaleString(  undefined, // use a string like 'en-US' to override browser locale
												 { minimumFractionDigits: 2 }
												);
		document.getElementById('s_sub_total').innerHTML =sub_total;
	}

	document.getElementById("next_2").style.display = "block";
	function openTab(cityName,activeTab,nextId,pre) {
		var i, tabcontent, tablinks;
		tabcontent = document.getElementsByClassName("tab-pane slide-left padding-20");
		for (i = 0; i < tabcontent.length; i++) {
			tabcontent[i].style.display = "none";
		}
		tablinks = document.getElementsByClassName("tablinks");
		for (i = 0; i < tablinks.length; i++) {
			tablinks[i].className = tablinks[i].className.replace(" active", "");
		}
		//For next
		document.getElementById(cityName).style.display = "block";
        document.getElementById("next_2").style.display = "none";
        document.getElementById("next_3").style.display = "none";
		// document.getElementById("next_4").style.display = "none";
		document.getElementById("next_5").style.display = "none";
		document.getElementById(nextId).style.display = "block";
		var d = document.getElementById(activeTab);
		d.className += " active";

		document.getElementById("previous_1").style.display = "none";
		document.getElementById("previous_2").style.display = "none";
		document.getElementById("previous_3").style.display = "none";
		// document.getElementById("previous_4").style.display = "none";
		document.getElementById(pre).style.display = "block";

	}

	$(window).on('load',function()
				   {
		var phones = [{ "mask": "(###) ###-####"}, { "mask": "(###) ###-####"}];
		$('#phone').inputmask({
			mask: phones,
			greedy: false,
			definitions: { '#': { validator: "[0-9]", cardinality: 1}} });
	}); 
  
	$(document).ready(function() {
		var max_fields      = 200; //maximum input boxes allowed
		var wrapper         = $(".input_fields_wrap"); //Fields wrapper
		var add_button      = $(".add_field_button"); //Add button ID

		var x = $('#totalInvoice').val(); //initlal text box count
		$(add_button).click(function(e){ //on add input button click
			e.preventDefault();
			if(x < max_fields){ //max input box allowed
				x++; //text box increment
				document.getElementById('totalInvoice').value=x;
				$(wrapper).append('<div class="m-b-20" style="clear:both;"></div><div><hr> <div class="form-group"> <label>Item</label> <input class="form-control" placeholder="Item Here" type="text" name="item_name_'+x+'" id="item_name_'+x+'"><span id="item_name_error_'+x+'" class="error-message" style=" display: none;"></span></div> <div class="form-group"> <label>Description</label> <input class="form-control" placeholder="Description here" type="text" name="item_description_'+x+'" id="item_description_'+x+'"><span id="item_description_error_'+x+'" class="error-message" style=" display: none;"></span></div> <div class="col-md-2 form-group" style="padding-left:0px;"> <label>Rate</label><span class="help">e.g. "$45.50"</span> <div class="input-group"> <span class="input-group-addon">$</span> <input class="form-control input-group-lg full_input" placeholder="Rate here" type="text" name="item_rate_'+x+'" id="item_rate_'+x+'" onblur="calculateTotal();" onkeypress="return isNumberKey(event);" value=""> </div><span id="item_rate_error_'+x+'" class="error-message" style=" display: none;"></span> </div> <div class="col-md-2 form-group"> <label>Quantity</label> <input class="form-control" value="1" type="text" onblur="calculateTotal();" name="item_qty_'+x+'" id="item_qty_'+x+'" onkeypress="return isNumberKey(event);"><span id="item_qty_error_'+x+'" class="error-message" style=" display: none;"></span></div> <div class="col-md-2 form-group"> <label>Discount?</label> <input class="form-control" type="text" value="0" onblur="calculateTotal();" name="item_discount_'+x+'" id="item_discount_'+x+'" onkeypress="return isNumberKey(event);"> <span id="item_discount_error_'+x+'" class="error-message" style=" display: none;" data-value="0"></span></div> <div class="col-md-2 form-group"> <div class="radio radio-success"> <div class="radio m-0"> <label class="p-0"> <input type="radio" name="item_dis_'+x+'" id="item_dis_'+x+'" onClick="calculateTotal();" value="yes"><span class="cr"><i class="cr-icon fa fa-circle"></i></span>$ Discount</label> </div> <div class="radio m-0"> <label class="p-0"> <input type="radio" name="item_dis_'+x+'" id="item_dis_'+x+'" value="no" onClick="calculateTotal();" checked="checked"><span class="cr"><i class="cr-icon fa fa-circle"></i></span>% Discount</label> </div> </div> </div> <div class="clearfix"></div><a style="text-align: right;float: right;" href="#" class="remove_field btn btn-danger btn-cons"><i class="fa fa-ban" aria-hidden="true"></i> REMOVE</a> <div class="clearfix"></div> </div><div class="clearfix"></div><div class="m-b-20" style="clear:both;"></div>'); //add input box

			}
		});

		$(wrapper).on("click",".remove_field", function(e){ //user click on remove text
			e.preventDefault();
			$(this).parent('div').remove(); x--;
			document.getElementById('totalInvoice').value=x;
			calculateTotal();
		})

		var form1 =  $("#form-stander");
		$("#saveDarf").click(function(){

			document.getElementById('save_status').value=1;
			document.getElementById("form-stander").setAttribute( "onsubmit", "" );
			var pattern = /^[a-zA-Z0-9\-_]+(\.[a-zA-Z0-9\-_]+)*@[a-z0-9]+(\-[a-z0-9]+)*(\.[a-z0-9]+(\-[a-z0-9]+)*)*\.[a-z]{2,4}$/;
			var company_name=jQuery('#company_name').val();
			var email=jQuery('#email').val();
			var city=jQuery('#city').val();
			var zip_code=jQuery('#zip_code').val();

			if(company_name.trim()=="" && email.trim()=="" && city.trim()=="" && zip_code.trim()==""){
				openTab('tab1','tab_1','next_2','previous_1');
			}

			if(company_name.trim()==""){
				jQuery('#company_error').show();
				jQuery('#company_error').html("Please enter company name.");
				jQuery('#company_name').focus();
				return false;
			}
			else{ form1.submit();
				}
		});
	});
