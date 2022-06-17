//Support function: delay time
function delay(ms) {
    return new Promise(resolve => setTimeout(resolve, ms));
}

// Action when load page:
$(document).ready(function() {
    if (site_home){
        loadProdSlides();
        loadNewProd();
        loadUserLib(0);
    }
    if (site_prod) loadAllProducts();
    if (site_user){
        $("#setting-userName").html(userName);
        document.title = "HCMG | "+userName;
        loadUserLib(1);
        loadUserLog();
    }
    loadCart();
});

$(window).load(async function(){
    toggleEverything();
    await delay(30);
    document.getElementsByTagName("html")[0].style.visibility = "visible";
    if (isLogged == true){
        await delay(30);
        purchasedOrNot();
    }
})
/*----------------------------------------------------------------------------------------------------------------------*/

/*----------------------------------------------------------------------------------------------------------------------*/
// FOR: navigation
//Function: navigate to homepage
$("body").on("click", ".nav-home",async function(e){    
    await delay(50);
    window.location.replace('index.php');
});

//Function: navigate to a certain product page
$("body").on("click", ".prodDetail", function(){
    let Prod_id = parseInt($(this).data("prod-id"));
    window.location.replace('single.php?Prod_id='+Prod_id);
});

//Function: change page display when changing itemsPerPage select
$("#itemsPerPage").change(async function(){
    loadAllProducts();
    if (isLogged == true){
        await delay(30);
        purchasedOrNot();
    }
});

//Function: change page display when chosing other page
$("body").on("click", ".page-number", async function(){
    let newPage = $(this).data('page');
    let curPage = parseInt($('.current').data('page'));
    if (newPage == "front") newPage = 1;
    else if (newPage == "back") newPage = parseInt($('.product-list').last().data('page'));
    else if (newPage == "prev") newPage = Math.max(1, curPage-1);
    else if (newPage == "next") newPage = Math.min(parseInt($('.product-list').last().data('page')), curPage+1);
    else newPage = parseInt(newPage);

    $('.page-number[data-page="'+curPage+'"]').removeClass("current");
    $('.page-number[data-page="'+newPage+'"]').addClass("current");
    await delay(50);
    displayPage(newPage);
});

//Function: change username in site setting user
$("body").on("click", ".changeName",async function(){
    const {value: newName} = await Swal.fire({
        input: 'text',
        title: 'Change username',
        text: 'Enter your new username',
        inputValue: userName, 
        showCancelButton: true,
        inputValidator: (value) => {
            if (!value) {  return 'Please enter new username!'; }
            else if (value.length<5){ return 'Username must be at least 5 characters'; }
        }
    });

    if (newName!="" && newName != userName){
        $.ajax({
            type: 'POST',
            url: 'php/api/update_user.php',
            data: jQuery.param({type: 'changeName', User_id: userId, New_name: newName}),
            success: function(response){
                if (response['status']=='succ'){
                    Swal.fire({
                        title: 'Change username successfully!',
                        icon: 'success'
                    }).then(function(){window.location.replace('user-setting.php');});                    
                }
                else Swal.fire({
                    title: 'Error',
                    text:'Cannot change username',
                    icon: 'error'
                });
            }
        });
    } 
    else Swal.fire({
        title: 'Error',
        text: 'This is the current username',
        icon: 'warning'
    });
});

//Function: change password in site setting user
$("body").on("click", ".changePass",async function(){
    const {value: passData} = await Swal.fire({
        title: 'Change password',
        html:
        '<label for="change-oldPass">Old password</label><input type="password" id="change-oldPass" class="swal2-input" style="margin-top: 3px !important; margin-bottom: 10px !important"><br>\
        <label for="change-newPass">New password</label><input type="password" id="change-newPass" class="swal2-input" style="margin-top: 3px !important; margin-bottom: 10px !important"><br>\
        <label for="change-reNewPass">Re-enter new password</label><input type="password" id="change-reNewPass" class="swal2-input" style="margin-top: 3px !important; margin-bottom: 10px !important">',
        showCancelButton: true,
        focusConfirm: false,
        preConfirm: () => {
            return [
                document.getElementById('change-oldPass').value,
                document.getElementById('change-newPass').value,
                document.getElementById('change-reNewPass').value
            ]
        }
    });

    if (passData){
        $.ajax({
            type: 'POST',
            url: 'php/api/update_user.php',
            data: jQuery.param({type: 'changePass', User_id: userId, Old_pass: passData[0], New_pass: passData[1], Renew_pass: passData[2]}),
            success: function(response){
                console.log(response);
                if (response['status']=='succ'){
                    Swal.fire({
                        title: 'Change password successfully!',
                        icon: 'success'
                    });
                }
                else Swal.fire({
                    title: 'Error',
                    text: response['message'],
                    icon: 'error'
                });
            }
        });
    }
});

//Function: Log out
$("body").on("click", ".btn-logOut", function(e){
    //e.preventDefault();
    Swal.fire({
        title: 'Are you sure?',
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#1f4287',
        cancelButtonColor: '#999',
        confirmButtonText: 'Logout'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.replace('php/api/logout.php');
        }
    });
});
/*----------------------------------------------------------------------------------------------------------------------*/

/*----------------------------------------------------------------------------------------------------------------------*/
// FOR: load data to front-end

/* For get variables from product
let Prod_id = item['Product_id'], Name = item['Name'], Desp = item['Description'], Type = item['Type'],
    Prod_studio = item['Produce_studio'], Price = item['Price'], Bg_img = item['Background_image'], Sqr_img = item['Square_image'],
    S_img1 = item['Small_image1'], S_img2 = item['Small_image2'], S_img3 = item['Small_image3'];
*/

// Function: Load product to home slider when page load
function loadProdSlides(){
    $.ajax({
        type: 'POST',
        url: 'php/api/load_slides.php',
        success: function(response){
            let prod_list = response['data'];
            for (var i=0; i<prod_list.length; i++){
                let item = prod_list[i];
                let Prod_id = item['Product_id'], Name = item['Name'], Desp = item['Description'],
                    Price = item['Price'], Bg_img = item['Background_image'],
                    S_img1 = item['Small_image1'];
                let li = $('<li data-bg-image="#"></li>');
                //console.log(S_img1);    
                li.attr("data-bg-image", S_img1);
                li.append('<div class="container">\
                <div class="slide-content">\
                <h2 class="slide-title">'+Name+'</h2>\
                <small class="slide-subtitle">$'+Price+'.00</small> \
                <p style="font-size: 20px; text-align: justify;">'+Desp+'</p>\
                <a href="#" class="button toCart hidden" data-prod-id="'+Prod_id+'">Add to cart</a>\
                <a href="cart.php" class="button inCart hidden" data-prod-id="'+Prod_id+'"><i class="icon-cart"></i> In cart</a>\
                <a href="#" class="button isPurchased hidden" data-prod-id="'+Prod_id+'"><i class="icon-wallet"></i> Owned</a>\
                </div> \
                <img src="'+Bg_img+'" class="slide-image">\
                </div>');
                $("ul.slides").append(li);                    
            }
        }
    });
}

//Function: Load product to section New Products
function loadNewProd(){
    $.ajax({
        type: 'POST',
        url: 'php/api/load_newProd.php',
        success: function(response){
            let prod_list = response['data'];
            for (var i=0; i<prod_list.length; i++){
                let item = prod_list[i];
                let Prod_id = item['Product_id'], Name = item['Name'], Desp = item['Description'], 
                    Price = item['Price'], Bg_img = item['Background_image'];
                let div = $('<div class="product" data-prod-id="'+Prod_id+'"></div>');
                div.append('<div class="inner-product">\
                <div class="figure-image prodDetail" data-prod-id="'+item['Product_id']+'">\
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
                $("#sec_newProd div.product-list").append(div);                    
            }
        }
    });
}

//Function: Load user library to section Library
function loadUserLib(type){
    if (userId){
        $.ajax({
            type: 'GET',
            url: 'php/api/load_userLib.php?User_id='+userId,
            success: function(response){
                let prod_list = response['data'];
                if (!prod_list.length){
                    $("#empty_lib").removeClass("hidden");
                    $("#lib_asUser").addClass("hidden");
                }
                else{
                    $("#empty_lib").addClass("hidden");
                    $("#lib_asUser").removeClass("hidden");
                    let length = prod_list.length;
                    if (!type) length = Math.min(4, length);
                    for (var i=0; i<length; i++){
                        let item = prod_list[i];
                        let Prod_id = item['Product_id'], Name = item['Name'], Desp = item['Description'], Price = item['Price'], 
                        Bg_img = item['Background_image'];
                        let div = $('<div class="product prodDetail" data-prod-id="'+Prod_id+'"></div>');
                        div.append('<div class="inner-product">\
                        <div class="figure-image">\
                        <a href="#"><img src="'+Bg_img+'" alt="'+Name+'"></a>\
                        </div>\
                        <h3 class="product-title"><a href="#">'+Name+'</a></h3>\
                        <small class="price">$'+Price+'.00</small>\
                        <p>'+Desp+'</p>\
                        <a href="#" class="button prodDetail muted" data-prod-id="'+Prod_id+'">Read Details</a>\
                        </div>');
                        $("#lib_asUser").append(div);                    
                    }
                }
            }
        });
    }
}

//Function: load all products and display on PC Games site
async function loadAllProducts(){
    let itemsPerPage = parseInt($("#itemsPerPage").val());
    $.ajax({
        type: 'GET',
        url: 'php/api/load_allProd.php?type=shorten',
        success: function(response){
            let prod_list = response['data'];
            let numPages = Math.ceil(prod_list.length / itemsPerPage);

            //custom navigation panel
            $(".pagination").each(function(){
                $(this).empty();
                $(this).append('<a href="#" class="page-number front-page" data-page="front"><i class="fa fa-angle-left"></i><i class="fa fa-angle-left"></i></a>');
                $(this).append('<a href="#" class="page-number prev-page" data-page="prev"><i class="fa fa-angle-left"></i></a>');
                for (let page=1; page<=numPages; page++){
                    $(this).append('<a href="#" class="page-number" data-page="'+page+'">'+page+'</a>');
                }
                $(this).append('<a href="#" class="page-number next-page" data-page="next"><i class="fa fa-angle-right"></i></a>');
                $(this).append('<a href="#" class="page-number back-page" data-page="back"><i class="fa fa-angle-right"></i><i class="fa fa-angle-right"></i></a>');
                $('.page-number[data-page="1"]').addClass("current");
            });
            
            //display product on each page
            $(".product-area").empty();
            for (let page=1; page<=numPages; page++){
                let html_prodList = $('<div class="product-list hidden" data-page="'+page+'"></div>'); 
                var lower = itemsPerPage*(page-1), upper = itemsPerPage*page;
                for (let i=lower; i<Math.min(upper, prod_list.length); i++){
                    let item = prod_list[i];
                    let html_prod = $('<div class="product" data-prod-id="'+item['Product_id']+'"></div>');
                    html_prod.append('<div class="inner-product">\
                    <div class="figure-image prodDetail" data-prod-id="'+item['Product_id']+'">\
                    <a href="#"><img src="'+item['Background_image']+'" alt="'+item['Name']+'"></a>\
                    </div>\
                    <h3 class="product-title"><a href="#">'+item['Name']+'</a></h3>\
                    <small class="price">$'+item['Price']+'.00</small>\
                    <p>'+item['Description']+'</p>\
                    <a href="#" class="button prodDetail muted" data-prod-id="'+item['Product_id']+'">Read Details</a>\
                    <a href="#" class="button toCart hidden" data-prod-id="'+item['Product_id']+'">Add to cart</a>\
                    <a href="cart.php" class="button inCart hidden" data-prod-id="'+item['Product_id']+'"><span><i class="icon-cart"></i> In cart</span></a>\
                    <a href="#" class="button isPurchased hidden" data-prod-id="'+item['Product_id']+'"><i class="icon-wallet"></i> Owned</a>\
                    </div>');
                    html_prodList.append(html_prod);
                }
                $(".product-area").append(html_prodList);
            }
        }
    });
    await delay(100);
    displayPage(1);
}

//Function: load certain cart of user
function loadCart(){
    if (isLogged){
        $.ajax({
            type: 'GET',
            url: 'php/api/load_cart.php?User_id='+userId,
            success: function(response){
                let cart_list = response['data'], totalPrice = 0;
                $('#itemsInCart').html(cart_list.length);
                if (!cart_list.length){
                    $("#cart_empty").removeClass("hidden");
                    $("#cart_hasItem").addClass("hidden");
                }
                else{
                    $("#cart_hasItem table tbody").empty();                   
                    for (var i=0; i<cart_list.length; i++){
                        let item = cart_list[i];
                        let Prod_id = item['Product_id'], Name = item['Name'], Price = item['Price'], Bg_img = item['Background_image'];
                        let row = $('<tr></tr>');
                        row.append('<td class="product-name">\
                        <div class="product-thumbnail">\
                        <img src="'+Bg_img+'" alt="">\
                        </div>\
                        <div class="product-detail">\
                        <h3 class="product-title">'+Name+'</h3>\
                        </div>\
                        </td>');
                        row.append('<td class="product-price">$'+Price+'.00</td>');
                        row.append('<td class="action"><span class="lnr lnr-trash" data-prod-id="'+Prod_id+'"></span></td>');
                        $("#cart_hasItem table tbody").append(row);                    
                        totalPrice += Price;
                    }
                }
                $("div.cart-total p.total span.num").html('$'+totalPrice+'.00');
            }
        });
    }
}

//Function: load user information to site user setting
function loadUserLog(){
    $.ajax({
        type: 'GET',
        url: 'php/api/load_userLog.php?User_id='+userId,
        success: function(response){
            let log = response['log'];
            $(".user-log tbody").empty();
            for (let i=1; i<=log.length; i++){
                let each = log[i-1];
                let row = $('<tr></tr>');
                row.append('<td class="log-id">'+i+'</td>');
                row.append('<td class="each-time">'+each['Time']+'</td>');
                $(".user-log tbody").append(row);
            }
        }
    });
}

//Function: toggle element hide or visible generally
function toggleEverything(){
    $.ajax({
        url: 'php/api/isLogged_toggle.php',
        success: function(response){
            let show = response['show'], hide = response['hide'];
            for (let i=0; i<show.length; i++){
                let element = show[i];
                $(element).each(function(){
                    $(this).removeClass('hidden');
                });
                // $(element).toggleClass('hidden', false);
            }
            for (let i=0; i<hide.length; i++){
                let element = hide[i];
                $(element).addClass('hidden');
            }
        }
    });
}

//Function: check if product is purchased -> change button Add to cart to Purchased
function purchasedOrNot(){
    let Prod_list = $('.toCart');
    let mark = Array(10000).fill(0);
    for (var i = 0; i < Prod_list.length; i++) {
        let Prod_id = parseInt($(Prod_list[i]).data('prod-id'));
        if (!mark[Prod_id]){
            $.ajax({
                type: 'POST',
                data: jQuery.param({Product_id: Prod_id, User_id: userId}),
                url: 'php/api/check_isPurchased.php',
                success: function(response){
                    if (response['checker'] == 'owned'){
                    // $(Prod_list[i]).addClass('hide');
                        //$('.isPurchased').filter('[data-prod-id="'+Prod_id+'"]').removeClass('hidden');
                        $('.toCart[data-prod-id="'+Prod_id+'"]').each(function(){ $(this).addClass('hidden'); });
                        $('.isPurchased[data-prod-id="'+Prod_id+'"]').each(function(){ $(this).removeClass('hidden'); });
                    }
                    else if (response['checker'] == 'in-cart'){                    
                        $('.toCart[data-prod-id="'+Prod_id+'"]').each(function(){ $(this).addClass('hidden'); });
                        $('.inCart[data-prod-id="'+Prod_id+'"]').each(function(){ $(this).removeClass('hidden'); });
                    }
                    else {
                        $('.toCart[data-prod-id="'+Prod_id+'"]').each(function(){ $(this).removeClass('hidden'); });
                        $('.isPurchased[data-prod-id="'+Prod_id+'"]').each(function(){ $(this).addClass('hidden'); });
                        $('.inCart[data-prod-id="'+Prod_id+'"]').each(function(){ $(this).addClass('hidden'); });
                    }
                }
            });
            mark[Prod_id]=1;
        }
    }
}

//Function: decide which page is display in site PC Games
function displayPage(curPage){
    $(".product-list").each(function(){
        let page = $(this).data("page");
        if (curPage == page) $(this).removeClass("hidden");
        else $(this).addClass("hidden");
    });
}
/*----------------------------------------------------------------------------------------------------------------------*/

/*----------------------------------------------------------------------------------------------------------------------*/
// FOR: cart
//Function: add one item to cart
$("body").on("click", ".toCart",function(){
    let Prod_id = parseInt($(this).data("prod-id"));
    $.ajax({
        type: 'POST',
        url: 'php/api/add_cartItem.php',
        data: jQuery.param({Product_id: Prod_id, User_id: userId}),
        success: function(response){ 
            if (response['status']=='succ'){
                $('.toCart[data-prod-id="'+Prod_id+'"]').each(function(){ $(this).addClass('hidden'); });
                $('.inCart[data-prod-id="'+Prod_id+'"]').each(function(){ $(this).removeClass('hidden'); });
                loadCart();
            }
        }
    })
});

//Function: delete 1 item from cart
$("body").on("click", ".action, span.lnr-trash", function(){
    let Prod_id = parseInt($(this).data("prod-id"));
    $.ajax({
        type: 'POST',
        url: 'php/api/remove_cartItem.php',
        data: jQuery.param({Product_id: Prod_id, User_id: userId}),
        success: function(response){ 
            if (response['checker']) loadCart();
            else{
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Something went wrong!'
                });
            }
        }
    });
});

//Function: Purchase all item in cart and add to library
$("body").on("click","#btn-purchaseItem",function(){
    $.ajax({
        type: 'GET',
        url: 'php/api/purchaseItem.php?User_id='+userId,
        success: function(response){ 
            let itemNums = response['number'];
            if (itemNums==0){
                Swal.fire({
                    icon: 'warning',
                    title: 'Empty cart',
                    text: 'Please pick some items before purchasing'
                });
            }
            else{ 
                if (itemNums==1){
                    Swal.fire({
                        icon: 'success',
                        title: 'Successfully purchase',
                        text: 'An item has been added to your library'
                    }).then(function(){
                        window.location.reload();
                    });
                }
                else {
                    Swal.fire({
                        icon: 'success',
                        title: 'Successfully purchase',
                        text: itemNums+' items have been added to your library'
                    }).then(function(){
                        window.location.reload();
                    });
                }
            }
        }
    });
});