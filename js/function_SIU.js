$(window).load(function(){
    document.getElementsByTagName("html")[0].style.visibility = "visible";
})

//Function: navigate to homepage
$("body").on("click", ".nav-home", function(e){    
    setTimeout(function(){window.location.replace('index.php');},200);
});

/*----------------------------------------------------------------------------------------------------------------------*/
// FOR: Sign in / Sign up part
//Support function for sign in/sign up
function checkLen(s, ref_len){
    return (s.length >= ref_len);
}

function checkPass(pass){
    var ref_reg = /^(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])([a-zA-Z0-9]{6,})$/;
    return ref_reg.test(pass);
}

function validate(formData){
    let res = new Object();
    res.status = "", res.message = "";
    console.log(formData.username+' '+typeof formData.username);
    if (!formData['username'] || formData['username'] == ""){    //---- if username empty               -> alert
        res.status = "fail";
        res.message = "Please insert username";
    } else if (!checkLen(formData['username'], 5)){ //----------------- if username.length < 5          -> alert
        res.status = "fail";
        res.message = "Username must be at least 5 characters";
    } else if (!formData['pass'] || formData['pass'] == ""){ //-------- if pass empty < 5               -> alert
        res.status = "fail";
        res.message = "Please insert password";
    } else if (!checkLen(formData['pass'], 6)){ //--------------------- if pass.length < 6              -> alert
        res.status = "fail";
        res.message = "Password must be at least 6 characters";
    } else if (!checkPass(formData['pass'])){ //----------------------- if pass not have a-z, A-Z, 0-9  -> alert
        res.status = "fail";
        res.message = "Password must contain at least characters of a-z, A-Z and 0-9";
    } else res.status = "succ";
    return JSON.stringify(res);
}

//Function: sign up
$("body").on("click", "#btn-signUp", function(e){
    e.preventDefault();
    let formData = $('#signUp-form').serialize();
    let formObj = {};
    $.each($('#signUp-form').serializeArray(), function(i, field){
        formObj[field.name] = field.value;
    });
    let clientValidate = JSON.parse(validate(formObj));
    if (clientValidate['status'] == "succ"){
        $.ajax({
            type: 'POST',
            url: 'php/api/signup.php',
            data: formData,
            success: function(response){
                let msg = response['message'];
                if (response['status'] == 'fail'){
                    Swal.fire({
                        title: 'Error',
                        text: msg,
                        icon: 'error',
                        confirmButtonColor: '#1f4287'
                    });
                }
                else{
                    Swal.fire({
                        title: 'Successful',
                        text: msg,
                        icon: 'success',
                        confirmButtonColor: '#1f4287'
                    }).then(function(){
                        window.location.replace('index.php');
                    });
                }
            }
        });
    }
    else Swal.fire({
        title: 'Error',
        text: clientValidate['message'],
        icon: 'error',
        confirmButtonColor: '#1f4287'
    });
});

//Function: Sign in 
$("body").on("click", "#btn-signIn", function(e){
    e.preventDefault();
    let formData = $('#signIn-form').serialize();
    let formObj = {};
    $.each($('#signIn-form').serializeArray(), function(i, field){
        formObj[field.name] = field.value;
    });
    let clientValidate = JSON.parse(validate(formObj));
    if (clientValidate['status']=='succ'){
        $.ajax({
            type: 'POST',
            url: 'php/api/signin.php',
            data: formData,
            success: function(response){
                let msg = response['message'];
                if (response['status'] == 'fail'){
                    Swal.fire({
                        title: 'Error',
                        text: msg,
                        icon: 'error',
                        confirmButtonColor: '#1f4287'
                    });
                }
                else{
                    Swal.fire({
                        title: 'Successful',
                        text: msg,
                        icon: 'success',
                        confirmButtonColor: '#1f4287'
                    }).then(function(){
                        if (response['status'] == 'succ_admin') window.location.replace('admin-home.php');
                        else if (response['status'] == 'succ_user') window.location.replace('index.php');
                    });
                }
            }
        });
    }
    else Swal.fire({
        title: 'Error',
        text: clientValidate['message'],
        icon: 'error',
        confirmButtonColor: '#1f4287'
    });
});
/*----------------------------------------------------------------------------------------------------------------------*/