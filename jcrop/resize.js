$(function() {
	$('#target').Jcrop({
			aspectRatio: 4/3,
			minSize: [ 250, 150 ],
			onSelect: updateCoords,
			setSelect: [ 100, 100, 300, 400 ]
	}, function() {
			var jcrop_api = this;		
	});
});

function updateCoords(c) {
	$('#x').val(c.x);
	$('#y').val(c.y);
	$('#w').val(c.w);
	$('#h').val(c.h);
}

function checkCoords() {
	if (parseInt($('#w').val())) return true;
	alert('Vänligen välj en region att beskära');
	return false;	
}