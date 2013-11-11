function delRecord(table, id, redirect){
    r = confirm("Are you sure to delete this?");
    if(r == false){
        return;
    }
    $.post("core/delete.php", {table: table, id:id}, function(data){
	//alert("hi");
	document.location = redirect;
    });
}