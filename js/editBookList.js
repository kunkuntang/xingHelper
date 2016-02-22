window.onload = function(){
	var bookcount = 1;
	var sumPrice = 0;
	var isEditing = false;
	var listName = null;

	function addItem(){
		$('#bookShelf').append('<div id="book'+bookcount+'" class="bookInfo"><span>书名：</span><input id="bookName'+bookcount+'" type="text" name="bookName'+bookcount+'" class="bookName" /><span>价格：</span><input id="price'+bookcount+'" type="text" name="price'+bookcount+'" class="price" /><span>折扣：</span><input class="discount" type="number" name="discount'+bookcount+'" /></div>');
		/*
		console.log(bookcount)
		console.log($('#bookShelf input').eq(1+3*(bookcount-1)))
		console.log($('#bookShelf input').eq(1+3*(bookcount-1)).val())
		console.log($('#bookShelf input').eq(1)); 
		*/
		$('#bookSumNum').val(bookcount);
		bookcount++;
		
	}
	function sum(){
		for(var i = 0; i < bookcount; i++){
			
		}
	}

	function editListName(){
		
		if(isEditing){
			listName = $('#tempListName').val();
			$('#listName').html(listName);
			$('#bookListName').val(listName);
			$('#listName').show();
			$('#tempListName').hide();
			$('#listEdit').html('编辑');
			isEditing = false;
		}else{
			listName = $('#listName').html();
			$('#listName').hide();
			$('#tempListName').show();	
			//$('#tempListName').attr('placeholder',listName);
			$('#tempListName').val(listName);
			$('#listEdit').html('保存');
			isEditing = true;
		}
	}

	
	$('#bookListName').val($('#listName').html());
	$('#add').on('click', addItem);
	$('#count').on('click', sum);
	$('#listEdit').on('click',editListName);
	
};
