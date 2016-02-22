window.onload=function(){
	var listCode = null;
	function checkBookList(){
		listCode = $this.attr('listCode');
		console.log(listCode);
		console.log(this);
	}
	$('.list .bookName').on('click',function(e){
		//console.log(e.srcElement['attributes'][1].value);
		listCode = e.srcElement['attributes'][1].value;
		console.log(listCode);
	});
};