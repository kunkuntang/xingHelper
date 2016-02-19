window.onload = function(){
	var bookcount = 1;
	var sumPrice = 0;
	function addItem(){
		$('#bookShelf').append('<div id="book'+bookcount+'" class="bookInfo"><span>书名：</span><input id="bookName'+bookcount+'" type="text" name="bookName'+bookcount+'" class="bookName" /><span>价格：</span><input id="price'+bookcount+'" type="text" name="price'+bookcount+'" class="price" /><span>折扣：</span><input class="discount" type="number" name="bookNum'+bookcount+'" /></div>');
		$('#sum').val(bookcount);
		console.log(bookcount)
		console.log($('#bookShelf input').eq(1+3*(bookcount-1)))
		console.log($('#bookShelf input').eq(1+3*(bookcount-1)).val())
		console.log($('#bookShelf input').eq(1)); 
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
