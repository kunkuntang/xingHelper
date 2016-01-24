window.onload = function(){
	var bookcount = 1;
	var sumPrice = 0;
	function addItem(){
		$('#book').append('<div id="book'+bookcount+'"><span>书名：</span><input id="bookName'+bookcount+'" type="text" name="bookName" /><span>价格：</span><input id="price'+bookcount+'" type="text" name="price" /><span>数量：</span><input id="bookNum'+bookcount+'" type="number" name="bookNum'+bookcount+'" />总价：<i id="sum'+bookcount+'"></i></div>');
		$('#sum').val(bookcount);
		console.log(bookcount)
		console.log($('#book input').eq(1+3*(bookcount-1)))
		console.log($('#book input').eq(1+3*(bookcount-1)).val())
		console.log($('#book input').eq(1)); 
		console.log($('#book input').eq(1).val()); 
		sumPrice = parseInt($('#book input').eq(1+3*(bookcount-2)).val()) * parseInt($('#book input').eq(2+3*(bookcount-2)).val()) ? parseInt($('#book input').eq(1+3*(bookcount-2)).val()) * parseInt($('#book input').eq(2+3*(bookcount-2)).val()) : 0;
		console.log(sumPrice);
		console.log(1+3*(bookcount-1));
		$('#bookShelf i').eq(bookcount-2).html(sumPrice);
		bookcount++;			
	}
	function sum(){
		for(var i = 0; i < bookcount; i++){
			
		}
	}
	addItem();
	$('#add').on('click', addItem);
	$('#count').on('click', sum);
}
