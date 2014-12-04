$.ajaxSetup( {
	async : false
});
var dataInteract;
var dataInteractExDate;
var dataInteractClick;
function getInteractExDate() {
	$.ajax( {
		url : "../control/interactControl.php",
		async : false,
		type : "POST",
		dataType : "json",
		data : {
			"type" : "getInteractExDate"
		},
		success : function(data) {
			dataInteractExDate = data['interact'];
		}
	});
}
function getInteract() {
	$.ajax( {
		url : "../control/interactControl.php",
		async : false,
		type : "POST",
		dataType : "json",
		data : {
			"type" : "getInteract"
		},
		success : function(data) {
			dataInteract = data['interact'];
		}
	});
}
function flashTable() {
	getInteract();
	getInteractExDate();
	var oTable = document.createElement('table');
	oTable.className = 'table table-hover ';
	var oThead = document.createElement('thead');
	oThead.innerHTML = "<tr><td>用户名</td><td>服装编号</td><td>定制服图片</td><td>上传时间</td><td>点赞数</td></tr>";
	oTbody = document.createElement('tbody');
	for ( var index = 0; index < dataInteract.length; index++) {
		var ifhas = 0;
		var oTr = document.createElement('tr');
		oTr.innerHTML = "<td>" + dataInteract[index].iUser + "</td>";
		oTr.innerHTML += "<td>" + dataInteract[index].iGid + "</td>";
		oTr.innerHTML += "<td><img src='http://115.28.133.116/upload_file/"+ dataInteract[index].iPic+ "' style='height:100px;width:100px;'/>" + "</td>";
		oTr.innerHTML += "<td>" + dataInteract[index].iStartDate + "</td>";
			oTr.innerHTML += "<td>"
					+ dataInteract[index].iClickCount + "</td>";
	
		oTbody.appendChild(oTr);

	}
	oTable.appendChild(oThead);
	oTable.appendChild(oTbody);
	$('#interactTab').html("");
	$('#interactTab').append(oTable);
	
	
	//oldInteract
	var oTable2 = document.createElement('table');
	oTable2.className = 'table table-hover ';
	var oThead2 = document.createElement('thead');
	oThead2.innerHTML = "<tr><td>用户名</td><td>服装编号</td><td>定制服图片</td><td>上传时间</td><td>点赞数</td></tr>";
	oTbody2 = document.createElement('tbody');
	for ( var index = 0; index < dataInteractExDate.length; index++) {
		var oTr = document.createElement('tr');
		oTr.innerHTML = "<td>" + dataInteractExDate[index].iUser + "</td>";
		oTr.innerHTML += "<td>" + dataInteractExDate[index].iGid + "</td>";
		oTr.innerHTML += "<td><img src='http://115.28.133.116/upload_file/"+ dataInteractExDate[index].iPic+ "' style='height:100px;width:100px;'/>" + "</td>";
		oTr.innerHTML += "<td>" + dataInteractExDate[index].iStartDate + "</td>";
	    oTr.innerHTML += "<td>"+ dataInteractExDate[index].iClickCount + "</td>";
		oTbody2.appendChild(oTr);
	}
	oTable2.appendChild(oThead2);
	oTable2.appendChild(oTbody2);
	$('#interactTab2').html("");
	$('#interactTab2').append(oTable2);
	
	
	
}

$(document).ready(function() {
	flashTable();
});
