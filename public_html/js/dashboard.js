/**
 * Created by Lenovo on 5/27/2016.
 */

$(document).ready(function(){
    $('.form_datetime').datetimepicker({
        //language:  'fr',
        weekStart: 1,
        todayBtn:  1,
        autoclose: 1,
        todayHighlight: 1,
        startView: 2,
        forceParse: 0,
        showMeridian: 1
    });

    var checkUrl=function()
    {  var found=false;
        $(".step-tab").each(function(){
            var href=$(this).attr("href");
            var url=window.location.href;
            url=url.replace('add-room','room');
            url=url.replace('edit-room','room');
            url=url.replace('manage-price','price');
            if (url.indexOf(href) > -1 && !found) {
                //  console.log("found it");
                $(this).addClass("activestep");
                //$(this).closest(".parent").addClass("active");
                found=true;
            }
            else{//console.log("notFound")
            }
        })
        if(found==false)
        {
            $(".start").addClass("activestep");
        }

    }
    checkUrl();
    $(".disabled-menu .step-tab").removeAttr("onclick");
    $(".disabled-menu .step-tab").removeAttr("href");
    $(".disabled-menu ").removeAttr("onclick");
    $(".disabled-menu").removeAttr("href");
    $(".disabled-menu").on("click",function(){
        $("#upgrade").modal("show");
    })


    $("button[type=\"submit\"]").on("click",function(){
        setTimeout(function(){

            if($("form").find('.has-error').length)
            {
                $("#error-modal").modal("show");
            }

        }, 400);

    })


    var checkUrl=function()
    {  var found=false;
        $("#top-navbar-collapse ul li a").each(function(){
            var href=$(this).attr("href");
            if (window.location.href.indexOf(href) > -1 && !found) {
                //  console.log("found it");
                if(!$(this).parent().hasClass("start"))
                {
                    $(this).parent() . addClass("activeMenu");
                    //$(this).closest(".parent").addClass("active");
                    found = true;
                }
            }
            else{//console.log("notFound")
            }
        })
        if(found==false)
        {
            $(".start").addClass("activeMenu");
        }

    }
    checkUrl();
})


$(function () {
    $('#locale').change(function () {
        this.form.submit();
    });
});

$(document).on('change', '#type', function () {
    var type = $(this).find(':selected').val();
    var token = $('#token').val();
    $.ajax({
        url: "/ajax1",
        type: "POST",
        data: {'_token': token, 'type': type},
        success: function (data) {
            var html = '';
            html +='<option>Please Select one category</option>';
            $.each(data, function (id, name) {
                html += '<option value="' + id + '">' + name + '</option>';
            });
            $('#first').html(html);
        }, error: function () {
            alert("error!!!!");
        }

    });
})
$(document).on('change', '#type-scratch', function () {
    var type = $(this).find(':selected').val();
    var token = $('#token').val();
    $.ajax({
        url: "/ajax1",
        type: "POST",
        data: {'_token': token, 'type': type},
        success: function (data) {
            var html = '';
            html +='<option>Please Select one category</option>';
            $.each(data, function (id, name) {
                html += '<option value="' + id + '">' + name + '</option>';
            });
            $('#first-scratch').html(html);
        }, error: function () {
            alert("error!!!!");
        }

    });
})
$(document).on('change', '#first-scratch', function () {
    var first = $(this).find(':selected').val();
    var token = $('#token').val();
    $.ajax({
        url: "/ajax",
        type: "POST",
        data: {'_token': token, 'first': first},
        success: function (data) {
            var html = '';

            $.each(data, function (id, name) {
                html += '<option value="' + id + '">' + name + '</option>';
            });
            $('#second-scratch').html(html);
        }, error: function () {
            alert("error!!!!");
        }
    });

});
$(document).on('change', '#first', function () {
    var first = $(this).find(':selected').val();
    var token = $('#token').val();
    $.ajax({
        url: "/ajax",
        type: "POST",
        data: {'_token': token, 'first': first},
        success: function (data) {
            var html = '';

            $.each(data, function (id, name) {
                html += '<option value="' + id + '">' + name + '</option>';
            });
            $('#second').html(html);
        }, error: function () {
            alert("error!!!!");
        }
    });

});

$(document).on('click','#btn-findproducts',function(event){

    $('#getproducts').empty();
    $("#loading").show();
    $('#getproducts').append(" <h2>{{ Lang::get('app.Found products') }}</h2>");

    event.preventDefault();
    var subcategoryid= $('#second').find(':selected').val();
    $.ajax({
        url: "{{ url('ajaxfindproduct') }}",
        type: "get",
        data: {subcategoryid:subcategoryid},
        dataType: "json",
        success: function(data)
        {
            // alert( data["data"][0]["id"] );
            $.each(data,function(index,val)
            {

                $('#getproducts').append("<a href='/products/"+val.slug+"/"+val.id+"?template=usetemplate' id='"+val.id+"' class='ajax-product'><div class='stickit col-lg-12' id='"+val.id+"'><div class='description' style='word-break: break-all'>"+val.description+"</div></div></a>");
                $("#loading").hide();
            })
            $('.ajax-product').on('click',function()
            {
                $.ajax({
                    url: "{{ url('getproductajax') }}",
                    type: "get",
                    contentType:'multipart/form-data',
                    data: {prodid: $(this).prop('id')},
                    dataType: "json",
                    success: function (data) {

                        $.each(data,function(index,val)
                        {
                            var input="";
                            $('#title').val(val.title);

                            var formData = new FormData();
                            formData.append('file', $('#imgfile')[0].files["http://localhost:5555/img/products/1456680377.jpg"]);


                            //$('body#tinymce').text(val.description);
                            tinyMCE.activeEditor.setContent(val.description);
                            $('#price').val(val.price);

                        })
                    }
                })

            })
        }
    })

})
