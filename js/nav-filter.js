var $j = jQuery.noConflict();

$j(document).ready(function() {
    $j("#nav_filter_women li, #nav_filter_men li, #all_product").bind("click",function(){
    	var cats = $j(this).text();
    	var attr = $j(this).attr('class');
    	var cat = '';
    	
    	var str_lower = attr.toLowerCase();
		if (str_lower.indexOf('catw') > -1) {
		   cat = 'women';
		} else if(str_lower.indexOf('catm') > -1) {
		   cat = 'men';
		}

    	data = {
	      'action': 'nav_filter', 
	      'cats': cats,
	      'cat': cat
		};
        console.log(cats);
        $j.ajax({
			url: "http://localhost/wordpress/index.php/nav-filter/",
			type:"POST",
			data: data,
			success:function(results) {
			   $j("#prodContainer").html(results);
			}
	    });
       
    });
});