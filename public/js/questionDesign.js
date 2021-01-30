/*$(function () {
    $('.toggle-class').change(function() {
        var status = $(this).prop('checked') == true ? 1 : 0;
        var user_id = $(this).data('id');
        $.ajax({
            type: "GET",
            dataType: "json",
            url: '/superadmin/statusupdate',
            data: {status : status, user_id: user_id},
            success: function(data){
                console.log(data.success)
            },
            error: function () {
                alert("Failed to update");
            }
        });
    });

});*/

$("#setMcqBtn").on('click',function () {
    $(this).removeClass('btn-outline-success').addClass('btn-success');
    $("#setOpenEndBtn").removeClass('btn-info').addClass('btn-outline-info');
    $('.addQuestionMcqContainer').removeClass('d-none');
    $('.setQuestionOpenEndedContainer').removeClass('d-none').addClass('d-none');
});

$("#setOpenEndBtn").on('click',function () {
    $(this).removeClass('btn-outline-info').addClass('btn-info');
    $("#setMcqBtn").removeClass('btn-success').addClass('btn-outline-success');
    $('.addQuestionMcqContainer').removeClass('d-none').addClass('d-none');
    $('.setQuestionOpenEndedContainer').removeClass('d-none')
});


$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

/*For Getting the all the question set values*/
$(function () {
        $("#addMcqBtn").on('click',function (e) {
            e.preventDefault();
            var qset = $('#questionSetmcq').val();
            var categoryid = $('#categoryIdmcq').val();
            var categorydesc = $('#qcategorydesMcq').val();
            var qdescription = $('#qdesmcq').val();
            var qopdes1 = $('#qopdes1').val();
            var qopdes2 = $('#qopdes2').val();
            var qopdes3 = $('#qopdes3').val();
            var qopdes4 = $('#qopdes4').val();
            var qopdes5 = $('#qopdes5').val();
            var deptcode = $('#deptcodeMcq').val();



            if (qset && categoryid && categorydesc && qdescription && qopdes1 && qopdes2 && qopdes3 && qopdes4 && qopdes5)
            {
                $.ajax({
                    type: "post",
                    method: "POST",
                    dataType: "json",
                    url: '/admin/addmcq',
                    data: {
                        qset: qset,
                        categoryid: categoryid,
                        categorydesc: categorydesc,
                        qdescription: qdescription,
                        qopdes1: qopdes1,
                        qopdes2: qopdes2,
                        qopdes3: qopdes3,
                        qopdes4: qopdes4,
                        qopdes5: qopdes5,
                        deptcode: deptcode
                    },
                    success: function (data) {
                        alert("MCQ added Successfully!!!");
                        $('#questionSetmcq').val("");
                        $('#categoryIdmcq').val("");
                        $('#qcategorydesMcq').val("");
                        $('#qdesmcq').val("");
                        $('#qopdes1').val("");
                        $('#qopdes2').val("");
                        $('#qopdes3').val("");
                        $('#qopdes4').val("");
                        $('#qopdes5').val("");


                    },
                    error: function () {
                        alert("Failed to add!!!");
                    }
                });
            }else{
                alert("All the Fields are required to fill up!!!");
            }

        });

});
/*For Getting the all the question set values*/

$(function () {
    $('#addOpenEndedBtn').on('click',function() {
        var qset = $("#questionSetOpenEnd").val();
        var categoryid = $("#categoryidOpen").val();
        var categorydesc = $("#categorydescOpen").val();
        var qdesopenended = $("#qdescOpen").val();
        var deptcode = $("#deptcodeOpen").val();
        if (qset && categoryid && categorydesc && qdesopenended){
            $.ajax({
                type: "POST",
                dataType: "json",
                url: '/admin/addopenended',
                data: {
                    qset: qset,
                    categoryid: categoryid,
                    categorydesc: categorydesc,
                    qdesopenended: qdesopenended,
                    deptcode: deptcode
                },
                success: function(data){
                    alert("Open End Question Added Successfully!!");
                    $("#questionSetOpenEnd").val("");
                    $("#categoryidOpen").val("");
                    $("#categorydescOpen").val("");
                    $("#qdescOpen").val("");

                },
                error: function () {
                    alert("Failed to update");
                }
            });
        }else {
            alert("All the fields are required to fill up!!!");
        }
    });

});

//Fow Getting the pdf view of the teacher courses evaluation report
$(function () {
    $('#tpdf').on('click',function () {
        var tid = $('#Tid').val();
        var year = $('#Year').val();
        var semester = $('#Semester').val();

        $.ajax({
            type: "GET",
            dataType: "json",
            url: "admin/teacher-select-course-pdf",
            data: {
                tid: tid,
                year: year,
                semester: semester
            },
            success: function (data) {
                console.log(data);
            },
            error: function () {
                console.log("error");
            }
        })
    });
});
