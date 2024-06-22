let adduserbtn = document.getElementById('adduserformid');
let showrecord = document.getElementById('user_records');
let up_q_div = document.getElementById('update_question');
let darkbg = document.getElementById('bgdark');

// alert("you are inside the js");
function makevisible() {
    // alert("you are inside the makevisible ");
    showrecord.style.display = "none";
    darkbg.style.backgroundColor = "rgba(0, 0, 0, 0.5)";
    adduserbtn.style.display = "initial";
    adduserform.reset();
}

function notvisible() {
    darkbg.style.backgroundColor = "rgba(0, 0, 0, 0)";
    adduserbtn.style.display = "none";
    adduserform.reset();
}

function recordvisible() {
    darkbg.style.backgroundColor = "rgba(0, 0, 0, 0.5)";
    adduserbtn.style.display = "none";
    showrecord.style.display = "initial";
    $.ajax({
        type: 'post',
        url: 'get_users.php',
        success: function (response) {
            $('#user_records').html(response);
        }
    });

}

function hiderecord() {
    darkbg.style.backgroundColor = "rgba(0, 0, 0, 0)";
    showrecord.style.display = "none";
    hide_up_q();
}

function delete_user(uname) {
    // if (confirm("Are you sure to delete " + uname.id)) {
    //     $.ajax({
    //         type: 'get',
    //         url: 'deleteuser.php',
    //         data: { user: uname.id, },
    //         success: function () {
    //             alert("sucessfully deleted the " + uname.id);
    //             hide_up_q();
    //             recordvisible();
    //         }
    //     });
    // }

    swal({
        title: "Are you sure?",
        text: "Once deleted, you will not be able to recover the details " + uname.id + " !",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
        .then((willDelete) => {
            if (willDelete) {

                $.ajax({
                    type: 'get',
                    url: 'deleteuser.php',
                    data: { user: uname.id, },
                    success: function () {
                        hide_up_q();
                        window.location.reload();
                        // recordvisible();
                    }
                });

                swal("Poof! Your record file has been deleted!", {
                    icon: "success",
                });
            } else {
                swal("Your record file is safe!");
            }
        });


}

function hide_up_q() {
    up_q_div.style.display = "none";
}

function get_col(uname) {
    up_q_div.style.display = "initial";
    // alert(uname.id);
    $.ajax({
        type: 'post',
        url: 'get_columns.php',
        data: { user: uname.id },
        success: function (response) {
            $('#update_question').html(response);
        }
    });

}

function update_qry(values) {
    // alert(values.value);
    // alert(values.id);
    // let newVal = prompt("please enter the you new " + values.value)
    // if (newVal != null) {
    //     $.ajax({
    //         type: 'get',
    //         url: 'update_tab.php',
    //         data: { col: values.value, val: newVal, user: values.id },
    //         success: function () {

    //             alert("Updated record of " + values.value + "for the user" + values.id);
    //             hide_up_q();
    //             recordvisible();
    //             // var $score = $("#user_records");
    //             // $score.load("../php pages/get_users.php");
    //         }
    //     });
    // }

    swal("Enter the new values for "+values.value+":", {
        content: "input",
      })
      .then((value) => {
        $.ajax({
                    type: 'get',
                    url: 'update_tab.php',
                    data: { col: values.value, val: value, user: values.id },
                    success: function () {
    
                        swal("job is Done!", "Updated Record !", "success");
                        // alert("Updated record of " + values.value + "for the user" + values.id);
                        hide_up_q();
                        recordvisible();
                        // var $score = $("#user_records");
                        // $score.load("../php pages/get_users.php");
        
                    }
                });
        
      });
}


// add user form validate and submit
function validate_submit() {
    let valid = true;
    let x = document.forms["adduser"]["username"].value;
    let y = document.forms["adduser"]["email"].value;
    let z = document.forms["adduser"]["type"].value;
    let p1 = document.forms["adduser"]["psswd1"].value;
    let p2 = document.forms["adduser"]["psswd"].value;

    let e1 = document.getElementById('error1');
    let e2 = document.getElementById('error2');
    let e3 = document.getElementById('error3');
    let e4 = document.getElementById('error4');

    if (x == "") {
        e1.innerText = "user name must be provided";
        valid = false;
    }
    if (y == "") {
        e2.innerText = "please enter the email";
        valid = false;
    }
    if (z == "") {
        e3.innerText = "desingation is required";
        valid = false;
    }

    if (p1 == "" || p2 == "") {
        e4.innerText = "password is required";
        valid = false;
    } else if (p1 != p2) {
        e4.innerText = "password must be same";
        valid = false;
    }
    if (valid) {
        swal({
            title: "Are you sure?",
            text: " To Add a new record!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
            .then((willDelete) => {
                if (willDelete) {
                    document.forms["adduser"].submit();
                    swal("Poof! Record Added", {
                        icon: "success",
                    });
                } else {
                    swal("Something Went worng Please Check!");
                }
            });

        // alert("everything is fine");
    }

}

function logout() {
    window.location.href = "../php pages/logout.php";
}