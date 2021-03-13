var $j = jQuery.noConflict();
$j("form").attr("autocomplete","off");
$j(document).ready(function() {
	$j("#searchResult").hide();
	$j("#searchProd").keyup(function(event) {
		var search = $j(this).val();
		/*
		var terms = [
          "jeans",
          "jackets",
          "men",
          "women",
		];
		var emptyArr = [];
		if(search) {
          emptyArr = terms.filter((data) => {
            return data.toLocaleLowerCase().startsWith(search.toLocaleLowerCase()); 
          });
		}
		*/
		
		$j.ajax({
			url: ajax_search_vars.ajax_search_url,
			type:"POST",
			data:"action=search&search="+search,
			success:function(results) {
				var res = JSON.parse(results);
				//console.log(res);
				$j('#searchResult').empty();
				$j('#searchResult').show();
				if(res) {
                    var html = "<li class='prod-label'><span>title</span></li>";
					$j('#searchResult').append(html);
	                for(var i = 0 ;  i < res.length ; i++) {
	                    var html = "<li class='prod-title'>"+ res[i].title +"</li>"; 
	                    $j('#searchResult').append(html);
	                }
	                $j("#searchResult li").bind("click",function(){
	                	var prod = $j(this).text();
                        $j('#searchProd').val(prod);
                        $j('#searchResult').empty();
                	    $j('#searchResult').hide();
                    });
                } else {
                	$j('#searchResult').empty();
                	$j('#searchResult').hide();
                }
			}
	    });
    });

    
    $j('.navbar-form').on('submit', function(event){

        event.preventDefault();

		var data = $j('#searchProd').val();
		$j.ajax({
			url: "http://localhost/wordpress/index.php/product-search/",
			type:"POST",
			data:"action=search_form&data="+data,
			success:function(results) {
				$j("#prodContainer").html(results);
			}
	    });
	    
    });

});
