// this js page is linked to serveral php pages carefull
let batch_ele = document.getElementById("show_batch"); //hide years
let addrecform = document.getElementById("addrecform");
let add_rec_ele = document.getElementById('add_rec_form'); //show the insert form
let update_col = document.getElementById('update_col_div');
let darkbg = document.getElementById('bgdark');
let bgdark = document.getElementById("darkbg");

var categories = document.getElementById("class");
var newOption = document.createElement('option');
newOption.innerText = "select";
newOption.setAttribute('value', 'newvalue');
categories.appendChild(newOption)

var categories1 = document.getElementById("batch");
var newOption = document.createElement('option');
newOption.innerText = "select";
newOption.setAttribute('value', 'newvalue');
categories1.append(newOption)


let theSelect = document.getElementById("class");
var lastValue1 = theSelect.options[theSelect.options.length - 1].value;
theSelect.value = lastValue1;


var drop2_last = categories1.options[categories1.options.length - 1].value;
categories1.value = drop2_last;

function show_batch(batch) {
    add_rec_ele.style.display = "none";
    addrecform.style.display = 'none';
    batch_ele.style.display = 'initial';
    darkbg.style.backgroundColor = "rgba(0, 0, 0, 0.3)";
    // alert("this is " + batch.id);
    std = parseInt(batch.id);
    $.ajax({
        type: "post",
        url: "get_record.php",
        data: { s: std },
        success: function (response) {
            $("#show_batch").html(response);
        }
    });

}

function batch_close() {
    darkbg.style.backgroundColor = "rgba(0, 0, 0, 0)";
    batch_ele.style.display = "none";
}

function view_record(y, s) {
    // alert("you are inside view_record");
    // alert(s);
    // alert(y.id);
    let url = '../php pages/view_record.php?std=' + s + '&yr=' + y.id;

    window.location.href = url;
}

function filter_value() {
    selected_ele = document.querySelector('#class');
    output_cls = selected_ele.value;
    // alert("class selected ::" + output_cls);

    selected_ele = document.querySelector('#batch');
    output_bat = selected_ele.value;
    // alert("batch selected ::" + output_bat);

    let url = '../php pages/view_record.php?std=' + output_cls + '&yr=' + output_bat;
    window.location.href = url;


}


function add_record(std) {
    // hide the batch if it is visible
    batch_ele.style.display = 'none';
    darkbg.style.backgroundColor = "rgba(0, 0, 0, 0.3)";
    addrecform.style.display = 'initial';
    add_rec_ele.style.display = 'initial';

    var newInput = document.getElementById('std');
    newInput.value = std.id;


}

function emptyform() {
    add_rec_ele.reset();

}

function closeform() {
    add_rec_ele.reset();
    darkbg.style.backgroundColor = "rgba(0, 0, 0, 0)";
    addrecform.style.display = "none";
    add_rec_ele.style.display = "none";
}

function delete_rec(value) {
    // if (confirm("Are you sure to delete " + value.id)) {
    //     $.ajax({
    //         type: 'get',
    //         url: 'delete_rec.php',
    //         data: { reg: value.id, },
    //         success: function () {
    //             window.location.reload();
    //             alert("sucessfully deleted the " + value.id);
    //         }
    //     });
    // }

    swal({
        title: "Are you sure?",
        text: "Once deleted, you will not be able to recover the details " + value.id + " !",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
        .then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    type: 'get',
                    url: 'delete_rec.php',
                    data: { reg: value.id, },
                    success: function () {
                        window.location.reload();
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

function update_rec(value) {
    // alert(value.id);
    bgdark.style.backgroundColor = "rgba(0,0,0,0.3)";
    update_col.style.display = "initial";
    $.ajax({
        type: 'post',
        url: 'get_column_std.php',
        data: { reg: value.id },
        success: function (response) {
            $('#update_col_div').html(response);
        }
    });

}

function update_qry(values) {
    // alert(values.id);
    // alert(values.value);

    // let newVal = prompt("please enter the you new " + values.value)
    // if (newVal != null) {

    //     $.ajax({
    //         type: 'get',
    //         url: 'update_tab_std.php',
    //         data: { col: values.value, val: newVal, reg: values.id },
    //         success: function () {
    //             alert("Updated record of " + values.value + "  for the user  " + values.id);
    swal("job is Done!", "Updated Record !", "success");
    //             // update_col.style.display="none";
    //             window.location.reload();

    //         }
    //     });
    // }


    swal("Enter the new values for " + values.value + ":", {
        content: "input",
    })
        .then((value) => {
            $.ajax({
                type: 'get',
                url: 'update_tab_std.php',
                data: { col: values.value, val: value, reg: values.id },
                success: function () {

                    swal("job is Done!", "Updated Record !", "success");
                    // update_col.style.display="none";
                    window.location.reload();

                }
            });
        });
}

function hide_up_q() {
    bgdark.style.backgroundColor = "rgba(0,0,0,0)";
    update_col.style.display = "none";
}

function logout() {
    window.location.href = "../php pages/logout.php";
}