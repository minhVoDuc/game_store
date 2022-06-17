// Action when load page:
$(document).ready(function() {
    admin_loadCertainItem();
    admin_loadUserPurchase();
});
/*----------------------------------------------------------------------------------------------------------------------*/


/*----------------------------------------------------------------------------------------------------------------------*/
$("body").on("click", ".btn-backProd", function(){
    let curPage = parseInt($(this).data('page'));
    window.location.replace('admin-products.php?Page='+curPage);
});
/*----------------------------------------------------------------------------------------------------------------------*/


/*----------------------------------------------------------------------------------------------------------------------*/
//Function: load Item in admin page
function admin_loadCertainItem(){
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
                    }).then(function(){ window.location.replace('admin-products.php'); });
                }
                else{
                    document.title = "HCMG Admin | "+prod['Name'];
                    $(".section").empty();
                    $(".section").append('<h1 style="text-align: center;"><strong>'+prod['Name']+'</strong></h1>');
                    $(".section").append('<h3 style="text-align: center;">Price: $'+prod['Price']+'.00</h3>');
                    $(".section").append('<p><strong>Studio:</strong> '+prod['Produce_studio']+'</p>');
                    $(".section").append('<p><strong>Type:</strong> '+prod['Type']+'</p>');
                    $(".section").append('<p><strong>Description:</strong> '+prod['Description']+'</p>');
                    $(".section").append('<div class="center"><a href="#" class="btn btn-danger btn-backProd" data-page="'+curPage+'">Back</a></div>');
                }
            }
        });
    }
    else{
        Swal.fire({
            title: 'Undefined product id!',
            icon: 'error'
        }).then(function(){ window.location.replace('admin-products.php'); });
    }
}

//Function: Load user purchase
function admin_loadUserPurchase(){
    if (prodId && prodId!=""){
        $.ajax({
            type: 'GET',
            url: 'php/api/load_userPurchase.php?Prod_id='+parseInt(prodId),
            success: function(response){
                $(".table tbody").empty();
                if (response['status'] == 'empty'){
                    $(".table tbody").html("<tr><td colspan='4' style='text-align: center'><strong>Empty</strong></td></tr>");
                }
                else{
                    let list = response['data'];
                    for (var i=0; i<list.length; i++){
                        let item = list[i];
                        let row = $('<tr class="alert" role="alert"></tr>');
                        row.append('<td>'+item['userID']+'</td>');
                        row.append('<td>'+item['userName']+'</td>');
                        row.append('<td>'+item['productID']+'</td>');
                        row.append('<td>'+item['libID']+'</td>');
                        $(".table tbody").append(row);
                    }
                }
            }
        });
    }
    else{
        Swal.fire({
            title: 'Undefined product id!',
            icon: 'error'
        }).then(function(){ window.location.replace('admin-products.php'); });
    }
}