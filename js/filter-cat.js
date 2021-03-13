var $j = jQuery.noConflict();

$j(document).ready(function() {

    $j("input[name='check']").each(function() {
	    $j(this).on("change",function(event){
	    	$j('input[name="check"]:checked').not(this).prop('checked', false);
	    	var val = $j('input[name="check"]:checked').val()
	    	console.log(val);
		    $j.ajax({
				url: "http://localhost/wordpress/index.php/filter-cat/",
				type:"POST",
				data:"action=filter-cat&terms="+val,
				success:function(results) {
				   $j("#prodContainer").html(results);
				}
		    });

	    });
	});

	$j('.clear-all').on("click",function(event){
    	$j('input[name="check"]').prop('checked', false);
	});
});