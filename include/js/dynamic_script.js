/**
 * Projet Name : Dynamic Form Processing with PHP
 * URL: http://techstream.org/Web-Development/PHP/Dynamic-Form-Processing-with-PHP
 *
 * Licensed under the MIT license.
 * http://www.opensource.org/licenses/mit-license.php
 * 
 * Copyright 2013, Tech Stream
 * http://techstream.org
 */


function addRow(tableID) {
	var table = document.getElementById(tableID);
	var rowCount = table.rows.length;
	if(rowCount < 15){							// limit the user from creating fields more than your limits
		$('.tanggal').datepicker('destroy');
		
		var tbody = table.tBodies[0];
		var row = tbody.insertRow(0); 
		var colCount = table.rows[rowCount].cells.length;
		for(var i=0; i<colCount; i++) {
			var newcell = row.insertCell(i); 
			newcell.innerHTML += table.rows[rowCount].cells[i].innerHTML; 
			
		} 
		// alert($('#'+tableID).first().find('input')[1].getAttribute("id"));
		// $('#'+tableID).first().find('input')[1].focus();
		
		var i = 0;
		$('.tanggal').each(function () {
			$(this).attr("id",'date' + i).datepicker({ 
            dayNames: ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'],
            dayNamesMin: ['Mi', 'Sn', 'Sl', 'Rb', 'Km', 'Jm', 'Sb'],
            dayNamesShort: ['Min', 'Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab'],
            monthNamesShort: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
            changeMonth: true,
            changeYear: true,
            dateFormat: 'd M yy',
            yearRange: 'c-3:c+1',
        });;
			i++;
		});
		 // $("body").on('focus',".tanggal", function(){
			// $(this).datepicker("refresh");
        // });
		
	}else{
		alert("Maksimal item adalah 15.");

	}
}
 
 var count=0;
 
 
function deleteRow(tableID) {
    var table = document.getElementById(tableID);
    var rowCount = table.rows.length;
    for(var i=0; i<rowCount; i++) {
        var row = table.rows[i];
        var chkbox = row.cells[0].childNodes[0];
        if(null != chkbox && true == chkbox.checked) {
            if(rowCount <= 1) { 						// limit the user from removing all the fields
                alert("Tidak dapat menghapus semua item!.");
                break;
            }
            table.deleteRow(i);
            rowCount--;
            i--;
        }
    }
}
 
 
function addRow_custom(tableID) {
	
	// var table = document.getElementById(tableID); 
	
	if(count < 15){							// limit the user from creating fields more than your limits
		count++;

		$("#tr_"+count).css("display","block");
		// $("#tr_"+count).show();
		
	}else{
		alert("Maksimal item adalah 15.");

	}
}

 
function deleteRow_custom(tableID) {
	var table = document.getElementById(tableID);
		// alertify.success("for="+count)
   for(var i=0; i<=count; i++) {
        var row = table.rows[i];
		var chkbox = row.cells[0].childNodes[0];
			// alertify.success("i="+i+"|count="+count);
		if(null != chkbox && true == chkbox.checked) {
			// alertify.success(count+"<=0");
			if(count <=0){						
				alert("Minimal item yang harus ada adalah 1!!");	// limit the user from creating fields more than your limits
				break;
			}
			$("#tr_"+count).css("display","none");  
			
			count--;
			i--;
		}
   }
}