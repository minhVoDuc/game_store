// Support function: delay time
function delay(ms) {
    return new Promise(resolve => setTimeout(resolve, ms));
}

// Action when load page:
$(document).ready(function() {
    if (admin_home || admin_prod) admin_loadAllProducts();
    if (admin_home || admin_user) admin_loadAllUsers();
    if (admin_home || admin_admin) admin_loadAllAdmins();
});

/*---------------------- For navigation and click event --------------------*/
//Function: Logout
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

//Function: change page display when chosing other page
$("body").on("click", ".page-number", async function(){
    let newPage = $(this).data('page');
    let curPage = parseInt($('.current').data('page'));
    if (newPage == "prev") newPage = Math.max(1, curPage-1);
    else if (newPage == "next") newPage = Math.min(parseInt($('.page-prod').last().data('page')), curPage+1);
    else newPage = parseInt(newPage);

    console.log(curPage+' '+newPage);
    $('.page-number[data-page="'+curPage+'"]').removeClass("current");
    $('.page-number[data-page="'+newPage+'"]').addClass("current");
    await delay(100);
    displayPage(newPage);
});

//Function: navigate to a certain product detail in admin page
$("body").on("click", ".admin-prodDetail", function(){
    let Prod_id = parseInt($(this).data("prod-id"));
    let curPage = parseInt($('.current').data('page'));
    window.location.replace('admin-prodDetails.php?Page='+curPage+'&Prod_id='+Prod_id);
});

//Function: add new user
$("body").on("click", ".btn-addUser", async function(){
    const {value: formData} = await Swal.fire({
        title: 'Add new user',
        html:
        '<label for="add-userName">Username</label><input type="text" id="add-userName" class="swal2-input" style="margin-top: 3px !important; margin-bottom: 10px !important"><br>\
        <label for="add-userPass">Password</label><input type="password" id="add-userPass" class="swal2-input" style="margin-top: 3px !important; margin-bottom: 10px !important"><br>',
        showCancelButton: true,
        focusConfirm: false,
        preConfirm: () => {
            return [
                document.getElementById('add-userName').value,
                document.getElementById('add-userPass').value,
            ]
        }
    });
    if (formData[0]=="" || formData[1]=="") Swal.fire({title: 'Error', text: 'Please fill all the field!', icon: 'error'});
    else{
        $.ajax({
            type: 'GET',
            url: 'php/api/interact_tableUser.php',
            data: jQuery.param({action: 'add', User_name: formData[0], User_pass: formData[1]}), 
            success: function(response){
                if (response['status']=='fail') Swal.fire({ title: 'Error', text: response['message'], icon: 'error' });
                else{
                    Swal.fire({
                        title: 'Add user successfully!',
                        icon: 'success'
                    });
                    admin_loadAllUsers();
                }
            }
        });
    }
});

//Function: edit a user
$("body").on("click", ".btn-editUser", async function(){
    let User_id = parseInt($(this).data('user-id'));
    let initName = $(this).data('user-name')
    const {value: formData} = await Swal.fire({
        title: 'Edit user',
        html:
        '<label for="edit-userName">Username</label><input type="text" id="edit-userName" class="swal2-input" style="margin-top: 3px !important; margin-bottom: 10px !important" value="'+initName+'"><br>\
        <label for="edit-userPass">Password</label><input type="password" id="edit-userPass" class="swal2-input" style="margin-top: 3px !important; margin-bottom: 10px !important"><br>',
        showCancelButton: true,
        focusConfirm: false,
        preConfirm: () => {
            return [
                document.getElementById('edit-userName').value,
                document.getElementById('edit-userPass').value,
            ]
        }
    });
    if (formData[0]=="" || formData[1]=="") Swal.fire({ title: 'Error', text: 'Please fill all the field!', icon: 'error'});
    else{
        $.ajax({
            type: 'GET',
            url: 'php/api/interact_tableUser.php',
            data: jQuery.param({action: 'edit', User_id: User_id, User_name: formData[0], User_pass: formData[1]}), 
            success: function(response){
                if (response['status']=='fail') Swal.fire({ title: 'Error', text: response['message'], icon: 'error' });
                else{
                    Swal.fire({
                        title: 'Update user successfully!',
                        icon: 'success'
                    });
                    admin_loadAllUsers();
                }
            }
        });
    }
});

//Function: delete a user
$("body").on("click", ".btn-delUser", async function(){
    let User_id = parseInt($(this).data('user-id'));
    $.ajax({
        type: 'GET',
        url: 'php/api/interact_tableUser.php',
        data: jQuery.param({action: 'del', User_id: User_id}), 
        success: function(response){
            if (response['status']=='fail') Swal.fire({ title: 'Error', text: response['message'], icon: 'error' });
            else{
                Swal.fire({
                    title: 'Delete user successfully!',
                    icon: 'success'
                });
                admin_loadAllUsers();
            }
        }
    });
});

//Function: add new admin
$("body").on("click", ".btn-addAdmin", async function(){
    const {value: formData} = await Swal.fire({
        title: 'Add new admin',
        html:
        '<label for="add-userName">Username</label><input type="text" id="add-userName" class="swal2-input" style="margin-top: 3px !important; margin-bottom: 10px !important"><br>\
        <label for="add-userPass">Password</label><input type="password" id="add-userPass" class="swal2-input" style="margin-top: 3px !important; margin-bottom: 10px !important"><br>',
        showCancelButton: true,
        focusConfirm: false,
        preConfirm: () => {
            return [
                document.getElementById('add-userName').value,
                document.getElementById('add-userPass').value,
            ]
        }
    });
    if (formData[0]=="" || formData[1]=="") Swal.fire({title: 'Error', text: 'Please fill all the field!', icon: 'error'});
    else{
        $.ajax({
            type: 'GET',
            url: 'php/api/interact_tableAdmin.php',
            data: jQuery.param({action: 'add', User_name: formData[0], User_pass: formData[1]}), 
            success: function(response){
                if (response['status']=='fail') Swal.fire({ title: 'Error', text: response['message'], icon: 'error' });
                else{
                    Swal.fire({
                        title: 'Add admin successfully!',
                        icon: 'success'
                    });
                    admin_loadAllAdmins();
                }
            }
        });
    }
});

//Function: delete a user
$("body").on("click", ".btn-delAdmin", async function(){
    let User_id = parseInt($(this).data('admin-id'));
    $.ajax({
        type: 'GET',
        url: 'php/api/interact_tableAdmin.php',
        data: jQuery.param({action: 'del', User_id: User_id}), 
        success: function(response){
            if (response['status']=='fail') Swal.fire({ title: 'Error', text: response['message'], icon: 'error' });
            else{
                Swal.fire({
                    title: 'Delete admin successfully!',
                    icon: 'success'
                });
                admin_loadAllAdmins();
            }
        }
    });
});
/*--------------------------------------------------------------------------*/


/*-------------------------- For load data -------------------------------- */
//Function: load product database
async function admin_loadAllProducts(){
    $.ajax({
        type: 'GET',
        url: 'php/api/load_allProd.php?type="full"',
        success: function(response){
            let prod_list = response['data'];
            let itemsPerPage = 2;
            let numPages = Math.ceil(prod_list.length / itemsPerPage);
            $('.panel-prod div h3').html(prod_list.length);

            //custom pagination
            $(".pagination").empty();
            $(".pagination").append('<a href="#" class="page-number" data-page="prev">&laquo;</a>');
            for (let page=1; page<=numPages; page++){
                $(".pagination").append('<a href="#" class="page-number" data-page="'+page+'">'+page+'</a>');
            }
            $(".pagination").append('<a href="#" class="page-number" data-page="next">&raquo;</a>');
            $('.page-number[data-page="'+curPage+'"]').addClass("current");

            //display table
            if (!prod_list.length){
                $('.table').html("<tbody><tr><td colspan='7' style='text-align: center'><strong>Empty</strong></td></tr></tbody>");
            }
            else{
                for (let page=1; page<=numPages; page++){
                    let page_prodList = $('<tbody class="page-prod hidden" data-page="'+page+'"></tbody>'); 
                    var lower = itemsPerPage*(page-1), upper = itemsPerPage*page;
                    for (let i=lower; i<Math.min(upper, prod_list.length); i++){
                        let item = prod_list[i];
                        let row = $('<tr class="alert" role="alert"></tr>');
                        row.append('<td>'+item['Product_id']+'</td>');
                        row.append('<td><div class="img" style="background-image: url('+item['Background_image']+');"></div></td>');
                        row.append('<td>\
						<div class="email" style="text-align: left;">\
							<span>'+item['Name']+'</span>\
							<span style="text-align: justify">'+item['Description']+'</span>\
						</div>\
						</td>');
                        row.append('<td>$'+item['Price']+'.00</td>');
                        row.append('<td>'+item['Produce_studio']+'</td>');
                        row.append('<td>'+item['Type']+'</td>');
                        row.append('<td><a href="#" class="btn btn-danger admin-prodDetail" data-prod-id="'+item['Product_id']+'" style="text-decoration: none;">Details</a></td>');
                        page_prodList.append(row);
                    }
                    $('.table').append(page_prodList);
                }
            }
        }
    });
    await delay(100);
    displayPage(curPage);
}

//Function: load user data
function admin_loadAllUsers(){
    $.ajax({
        type: 'GET',
        url: 'php/api/interact_tableUser.php?action=get',
        success: function(response){
            let list = response['data'];
            $('.panel-user div h3').html(list.length); 
            $('.table tbody').empty();
            if (!list.length){
                $('.table tbody').html("<tr><td colspan='4' style='text-align: center'><strong>Empty</strong></td></tr>");
            }
            else{
                for (var i=0; i<list.length; i++){
                    let item = list[i];
                    let row = $('<tr></tr>');
                    row.append('<td>'+item['User_id']+'</td>');
                    row.append('<td>'+item['User_name']+'</td>');
                    row.append('<td>'+item['User_password']+'</td>');
                    row.append('<td>\
                    <a class="btn btn-primary m-r-1em btn-editUser" data-user-id="'+item['User_id']+'" data-user-name="'+item['User_name']+'">Edit</a>\
                    <a class="btn btn-danger m-r-1em btn-delUser" data-user-id="'+item['User_id']+'">Delete</a>\
                    </td>');
                    $('.table tbody').append(row);
                }
            }
        }
    });
}

//Function: load admin data
function admin_loadAllAdmins(){
    $.ajax({
        type: 'GET',
        url: 'php/api/interact_tableAdmin.php?action=get',
        success: function(response){
            let list = response['data'];
            $('.panel-admin div h3').html(list.length); 
            $('.table tbody').empty();
            if (!list.length){
                $('.table tbody').html("<tr><td colspan='4' style='text-align: center'><strong>Empty</strong></td></tr>");
            }
            else{
                for (var i=0; i<list.length; i++){
                    let item = list[i];
                    let row = $('<tr></tr>');
                    row.append('<td>'+item['User_id']+'</td>');
                    row.append('<td>'+item['User_name']+'</td>');
                    row.append('<td>'+item['User_password']+'</td>');
                    if (item['User_id']!=adminId){
                        row.append('<td>\
                        <a class="btn btn-danger m-r-1em btn-delAdmin" data-admin-id="'+item['User_id']+'">Delete</a>\
                        </td>');
                    }
                    else row.append('<td></td>');
                    $('.table tbody').append(row);
                }
            }
        }
    });
}
/*--------------------------------------------------------------------------*/


/*-------------------------- For display data ----------------------------- */
//Function: decide which page is display in site admin-prod
function displayPage(curPage){
    $(".page-prod").each(function(){
        let page = $(this).data("page");
        if (curPage == page) $(this).removeClass("hidden");
        else $(this).addClass("hidden");
    });
}