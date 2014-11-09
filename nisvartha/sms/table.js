// JavaScript source code
var arr = [];
$(function () {


    $("#selectall").change(function () {

       // if(this.checked)
        
       // console.log("cool");
        $('#myTable tr').toggleClass('selected');

        

    });


    $('#myTable tbody').on('click', 'tr', function () {
        $(this).toggleClass('selected');

        var id = $(this).attr('id');
        //alert(elID);

        var index = arr.indexOf(id);

        if (index > -1) {
            arr.splice(index, 1);
        }
        else {
            arr.push(id);

        }


    });





    $("#send_msg").click(function () {

        data = JSON.stringify(arr);

        bootbox.dialog({
            title: "Please type the Message to be Sent",
            message: '<textarea class="form-control" rows="3" cols="2" id="sms"></textarea>',
            buttons: {
                success: {
                    label: "Send",
                    className: "btn-success",
                    callback: function () {

                        $.ajax(
                            {
                                type: 'post',
                                url: "do_sms.php",
                                data: { data: data, msg: $('#sms').val() },
                                success: function (data) {

                                },
                                error: function (data) {



                                }


                            });

                     //   var name = $('#name').val();
                      //  var answer = $("input[name='awesomeness']:checked").val()
                     //   Example.show("Hello Message sent successfull </b>");
                    }
                }
            }
        }
        );







        /*var table = $('#myTable').DataTable();

        var data = table
            .rows()
            .data();

        var data_sel = table.row('#');


        alert('The table has ' + data_sel.id  + ' records');
        */

    });








});