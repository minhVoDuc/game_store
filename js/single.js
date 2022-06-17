// Action when load page:
$(document).ready(function() {
    loadCertainItem();
    showOtherProd();
});
/*----------------------------------------------------------------------------------------------------------------------*/

function loadCertainItem(){
    if (prodId && prodId!=""){
        $.ajax({
            type: 'GET',
            url: 'php/api/load_cerItem.php?Prod_id='+parseInt(prodId),
            success: function(response){
                let prod = response['data'][0];
                if (!prod){
                    Swal.fire({
                        title: 'Item not exist!',
                        icon: 'error'
                    }).then(function(){ window.location.replace('index.php'); });
                }
                else{
                    document.title = "HCMG | "+prod['Name'];
                    let row = $('<div class="row"></div>');
                    row.append('<div class="col-sm-6 col-md-4">\
                    <div class="product-images">\
                        <figure class="large-image">\
                            <a href="'+prod['Square_image']+'"><img src="'+prod['Square_image']+'" alt="'+prod['Name']+'"></a>\
                        </figure>\
                        <div class="thumbnails">\
                            <a href="'+prod['Small_image1']+'"><img src="'+prod['Small_image1']+'" alt="'+prod['Name']+'_1"></a>\
                            <a href="'+prod['Small_image2']+'"><img src="'+prod['Small_image2']+'" alt="'+prod['Name']+'_2"></a>\
                            <a href="'+prod['Small_image3']+'"><img src="'+prod['Small_image3']+'" alt="'+prod['Name']+'_3"></a>\
                        </div>\
                    </div>\
                    </div>');
                    row.append('<div class="col-sm-6 col-md-8 prod-info">\
                    <h2 class="entry-title"><strong>'+prod['Name']+'</strong></h2>\
                    <small class="price">$'+prod['Price']+'.00</small>\
                    <p>Produce studio: <strong>'+prod['Produce_studio']+'</strong></p>\
                    <p>Type: <strong>'+prod['Type']+'</strong></p>\
                    <p style="text-align: justify">'+prod['Description']+'</p>\
                    <a href="#" class="button toCart hidden" data-prod-id="'+prod['Product_id']+'">Add to cart</a>\
                    <a href="cart.php" class="button inCart hidden" data-prod-id="'+prod['Product_id']+'"><span><i class="icon-cart"></i> In cart</span></a>\
                    <a href="#" class="button isPurchased hidden" data-prod-id="'+prod['Product_id']+'"><i class="icon-wallet"></i> Owned</a>\
                    </div>')
                    $(".entry-content").html(row);
                }
            }
        });
    }
    else{
        Swal.fire({
            title: 'Undefined product id!',
            icon: 'error'
        }).then(function(){ window.location.replace('index.php'); });
    }
}

//Function: Load product to section Other Products
function showOtherProd(){
    $.ajax({
        type: 'POST',
        url: 'php/api/load_otherProd.php?Prod_id='+parseInt(prodId),
        success: function(response){
            let prod_list = response['data'];
            for (var i=0; i<prod_list.length; i++){
                let item = prod_list[i];
                let Prod_id = item['Product_id'], Name = item['Name'], Desp = item['Description'], 
                    Price = item['Price'], Bg_img = item['Background_image'];
                let div = $('<div class="product" data-prod-id="'+Prod_id+'"></div>');
                div.append('<div class="inner-product">\
                <div class="figure-image">\
				<a href="#"><img src="'+Bg_img+'" alt="'+Name+'"></a>\
				</div>\
                <h3 class="product-title"><a href="#">'+Name+'</a></h3>\
                <small class="price">$'+Price+'.00</small>\
                <p>'+Desp+'</p>\
                <a href="#" class="button prodDetail muted" data-prod-id="'+Prod_id+'">Read Details</a>\
                <a href="#" class="button toCart hidden" data-prod-id="'+Prod_id+'">Add to cart</a>\
                <a href="cart.php" class="button inCart hidden" data-prod-id="'+Prod_id+'"><span><i class="icon-cart"></i> In cart</span></a>\
                <a href="#" class="button isPurchased hidden" data-prod-id="'+Prod_id+'"><i class="icon-wallet"></i> Owned</a>\
                </div>');
                $("#sec_otherProd div.product-list").append(div);                    
            }
        }
    });
}