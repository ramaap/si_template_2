<script>
		//______________________Custom Javascript____________________________
		function set_select(id,value_name,text_name,arr) //Set semua option select
		{
			value_name=value_name.split(",");
			text_name=text_name.split(","); 
			arr = typeof arr !== 'undefined' ? arr : "";
			console.log("arr="+arr);
			if(arr!="")
			{
				for (var i = 0; i < arr.length; i++) {  
					value=""; 
					for (var j = 0; j < value_name.length; j++) {  
						value+=arr[i][value_name[j]]+" ";
					}
					text=""; 
					for (var j = 0; j < text_name.length; j++) {  
						text+=arr[i][text_name[j]]+" ";
					}
					console.log("for="+i);
					$('#'+id)
					 .append($("<option></option>") 
					 .attr("value",value)
					 .text(text)); 
					 
					console.log("value="+arr[i][value_name]+"value="+value);
				}
			}
		}
		function reset_select(id,awalan,keterangan) //menghapus semua option select
		{ 
			awalan = typeof awalan !== 'undefined' ? awalan : "xxx"; //set default value bisa 0 atau "" kalau g y xxx
			keterangan = typeof keterangan !== 'undefined' ? keterangan : "Silahkan Pilih";//set default text di option
			
			$('#'+id)
			.find('option')
			.remove()
			.end()
			.append("");
			if(awalan!="xxx")
			{
				 $('#'+id)
				 .append($("<option></option>") 
				 .attr("value",awalan)
				 .text(keterangan)); 
			}
		}
		
		
		function clear_clean() //menghapus semua isian input, select, checkbox, foto
		{		
			
			 $('input:text, input:password, input:file, textarea').val("");		 
			 $('input:radio, input:checkbox')		 
			 $('input:checkbox').attr('checked', false); 
			 $temp=$('select option');
			 if ($temp.length ) {
				 $('select').prop('selectedIndex', 0);
				$('select').trigger("chosen:updated");
			 } 	
			if($('#button').length)
			{ 
				$('#button').attr("name", "simpan");
				$('#button').attr("value", "Simpan");
			}
			if($('#preview_foto').length)
			{ 
				$('#preview_foto').attr("src", ""); 
			}
		}
	
		function currency_format(jumlah) //ubah number / text jadi currency
		{
			var x = +jumlah + +0;
			return n = x.toFixed().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1.");
		}

		function cek_http(ready, status, text) //masih pake xhtml? pakai ini buat cek status
		{
			if (ready == 4)
			{
				if (status != 200)
					alertify.error(status + " - " + text);

			}
		} 
		
		function vardump(element) //vardump JSON
		{
			return JSON.stringify(element);
		}
		
		function json_string(element) //Alert json
		{
			return JSON.stringify(element);
		}
		
		
		function previewFile(id,file_id) {  //mau preview foto sebelum upload?
			/* 		
				id=id dari tag gambar muncul
				file_id=id dari input type=file 
			*/
			document.getElementById(id).style.display = '';
			var preview = document.getElementById(id); //selects the query named img
			var file = document.getElementById(file_id).files[0]; //selects the query named img
			//var file    = document.querySelector('input[type=file]').files[0]; //sames as here
			var reader = new FileReader(); 
			reader.onloadend = function () {
				preview.src = reader.result;
			}

			if (file) {
				reader.readAsDataURL(file); //reads the data as a URL 
			} else {
				preview.src = "";
				alert("bukan gambar");
			}
		}

		//______________________Fungsional buat browser____________________________
		function popup(x) //daftar lib
		{
			popUpObj = window.open(x, 'enlarge', 'screenX=0,screenY=0,left=200,top=100,menubar=no,status=no,scrollbars=yes,toolbar=no,resizable=yes,width=1024,height=400');
			// popUpObj.focus();
		}

		function popup_full(x) //daftar lib
		{
			width = screen.availWidth;
			height = screen.availHeight;
			popUpObj = window.open(x, 'enlarge', 'screenX=0,screenY=0,left=200,top=100,menubar=no,status=no,scrollbars=yes,toolbar=no,resizable=yes,width=' + width + ',height=' + height + '');
			//popUpObj.focus();
		}

		function newTab(address, window_name) //daftar lib
		{
			window.open(address, window_name);
		}
		
		function refreshParent() //daftar lib
		{
			if (window.opener != null && !window.opener.closed)
			{
				window.opener.location.reload();

			}
		}
		
		//______________________Bootsrap____________________________ 
		function show_modal_bootstrap(){
			$('#form-modal').modal('show');
		}
		
		function show_modal_bootstrap_custom(id){
			$('#'+id).modal('show');
		}
				
		function hide_modal_bootstrap(){
			$('.loading_gear_gif').show();
			$('#form-modal').modal('hide');
			window.location = site_url;
		}
		
		
		//_______________________plugin_____________________________
		function init_chosen() {
		$(".chosen-select").chosen({
			search_contains: true,
			//placeholder_text_single: "Select an Option Available",
			// disable_search: true,
			no_results_text: "Oops, nothing found!"
		});
		$('.chosen-select').chosen();
		$('.chosen-select-deselect').chosen({allow_single_deselect: true}); 

	}
		
		function init_chosen_khusus() {
			$(".chosen-select").chosen({
				search_contains: true,
				// placeholder_text_single: "Select an Option Available",
				// disable_search: true,
				no_results_text: "Oops, nothing found!"
			});
			$('.chosen-select').chosen();
			$('.chosen-select-deselect').chosen({allow_single_deselect: true}); 

			$(".chosen-select").each(function(){ //Solusi issue tentang htm5 validation
					//    take each select and put it as a child of the chosen container
					//    this mean it'll position any validation messages correctly
					$(this).next(".chosen-container").prepend($(this).detach());

					//    apply all the styles, personally, I've added this to my stylesheet
					$(this).attr("style","display:block!important; position:absolute; clip:rect(0,0,0,0)");

					//    to all of these events, trigger the chosen to open and receive focus
					$(this).on("click focus keyup",function(event){
						$(this).closest(".chosen-container").trigger("mousedown.chosen");
					});
			});
		}

</script>