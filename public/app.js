var ss = {
    app_url: app_url,
    example_attr: '',
    example_object: {id:'',option: '', price: 0, custom_message: '', custom_image: ''},
    ajax : function(action, method = 'get', data=null, callback = false, dataType = 'json', mimeType = false, contentType = false){
        ver = Date.now();
        ss.loader('show');
        response = {};
        var view_data;
        jQuery.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: action,
            crossDomain: true,
            type: method,
            data: data,
            contentType:false,
            processData:false,
            dataType : 'json',
            cache: false,
            success: function (r) {
                view_data = r;
                response.status = 1;
                response.message = '';

                callback.param['response'] = response;
            },
            error: function (xhr, status, error) {
                response.status = 0;
                response.message = error;
                callback.param['response'] = response;

            },
            complete: function (r) {
                ss.loader('hide');

                if(callback != false)
                {

                    if(dataType == 'json'){
                        callback.param.data = r.responseJSON;
                    }
                    else
                    {

                        callback.param.data = r.responseText;
                    }

                    if(typeof callback.action === "function")
                    {
                        callback.action(callback.param);
                    }

                }
            }
        });

    },
    set_data : function (elem, html, fade = false , append = false, event, notice = false){
        if(html == ''){ return false; }
        if(append)
        {   if(fade){$(elem).append(html).fadeIn(500);}
        else{ $(elem).append(html).fadeIn(0);} }
        else
        { if(fade){
            $(elem).hide().html(html).fadeIn(500);
            if(notice){setTimeout(function(){
                $(elem).fadeOut(500);
            },2000)}

        }
        else
        {
            $(elem).hide().html(html).fadeIn(0);

            if(notice){
                setTimeout(function(){
                    $(elem).fadeOut(500);
                },2000)
            }

        }
        }


        if(event){
            event.preventDefault();
        }

    },
    loader : function (action){
        if(action == 'hide'){
            $('.loading').fadeOut(500);
        }
        else if(action == 'show'){
            $('.loading').fadeIn(500);
        }

    },
    init_validate_form : function (id){
        $(id).validate();
    },
    alert_notice  : function (type= 'success', title ='', message = '', position = 'bottomRight'){
        if(message){
            iziToast[type]({
                id: type,
                title: title,
                message: String(message),
                position: 'bottomRight', // bottomRight, bottomLeft, topRight, topLeft, topCenter, bottomCenter, center
                transitionIn: 'bounceInLeft',
                // iconText: 'star',
                onOpened: function(instance, toast){
                    // console.info(instance)
                },
                onClosed: function(instance, toast, closedBy){

                }
            });
        }
   },
    notice : function (type='success',messsage = ''){

        if(messsage)
        {
            return '<div class=" alert alert-'+type+' alert-dismissible fade show" role="alert">\n' +
                '  '+messsage+'.\n' +
                '  <button  type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">\n' +
                '  </button>\n' +
                '</div>';
        }

    },
    show_validation_errors : function (errors){

        $.each(errors,function(field_name,error){
            $(document).find('[name='+field_name+']').addClass('error').after('<label id="'+field_name+'-error" class="error" for="email">'+error+'</label>')
        })

    },
    add_to_cart : function (id, subscription = false){
        ss.loader('show');
        if(subscription)
        {
            subscription = '?subscription=true'
        }else
        {
            subscription = ''
        }
        var callback = {
            param: [],
            action : function(a) {
                console.log(a);
                if(a.response.status == 0){

                    ss.alert_notice('error','',  a.data.message);

                }

                if(a.response.status){

                    ss.alert_notice('success','', a.data.message);
                    ss.update_cart_view();
                    ss.update_cart_mini_view();
                    if(a.data.url){
                        window.location = a.data.url;
                    }
                }

            }
        };

        ss.ajax( 'cart/add/'+id+subscription, 'get', [], callback)
    },
    update_cart_view : function (){
        var data = {ajax: 1};
        var callback = {
            param: [],
            action : function(a) {
                console.log(a);
                if(a.response.status == 0){

                    ss.alert_notice(a.data.message);
                }

                if(a.response.status){

                    if(a.data.html){
                        ss.set_data('#view-cart',a.data.html, false, false, event, false)

                    }

                }

            }
        };

        ss.ajax( 'cart', 'get', data, callback)
    },
    makeCourseFav : function (id , elem){
        elem = $(elem);

        var callback = {
            param: [],
            action : function(a) {
                console.log(a);
                if(a.response.status == 0){

                    ss.alert_notice('error','',  a.data.message);

                }

                if(a.response.status){

                    if(a.data.fav == 1)
                    {
                        elem.addClass('active')
                    }
                    else
                    {
                        elem.removeClass('active')
                    }

                    ss.alert_notice('success','', a.data.message);


                }

            }
        };

        ss.ajax( 'course/fav/'+id, 'get', [], callback)
    },
    getPaginateData : function (url, param, elem){
        var callback = {
            param: [],
            action : function(a) {
                console.log(a);
                if(a.response.status == 0){
                    ss.alert_notice('error','',  a.data.message);
                }
                if(a.response.status){
                    console.log(elem);
                    ss.set_data(elem, a.data.html)
                }
            }
        };
        console.log(param);
        ss.ajax(url, 'get', param, callback)
    },
    urlParams: function(url) {
        response = (function() {
            var _get = {};
            var re = /[?&]([^=&]+)(=?)([^&]*)/g;
            while (m = re.exec(url))
                _get[decodeURIComponent(m[1])] = (m[2] == '=' ? decodeURIComponent(m[3]) : true);
            return _get;
        })();

        return response;
    },
    getAjaxModal : function (url, param, elem, modal, swal=null){

        if(swal){
            var callback = {
                param: [],
                action : function(a) {

                    if(a.response.status == 0){
                        ss.alert_notice('error','',  a.data.message);
                    }
                    if(a.response.status){

                        Swal.fire({
                            icon: "success",
                            title: swal,
                            text: a.data.message,
                            customClass: {confirmButton: "btn btn-success"}
                        });
                    }
                }
            };

        }
        else {
            var callback = {
                param: [],
                action : function(a) {
                    console.log(a);
                    if(a.response.status == 0){
                        ss.alert_notice('error','',  a.data.message);
                    }
                    if(a.response.status){

                        console.log(elem);
                        console.log(a.data.html);

                        $(modal).modal('show');
                        $(elem).html(a.data.html);
                    }
                }
            };

        }
        ss.ajax(url, 'get', param, callback)
    },
    storeForm : function (elem){

        $(elem).validate({
            submitHandler: function(form) {
                console.log(form);
                ss.loader('show');
                $('.textdanger').remove();
                var callback = {
                    param: [],
                    action : function(a) {

                        console.log(a);

                        if(a.response.status == 0){


                            if (typeof a.data.errors === 'object' && a.data.errors !== null){
                                ss.show_validation_errors(a.data.errors);
                            }
                            ss.set_data(' .response', ss.notice('danger',  a.data.message))
                        }
                        if(a.response.status){
                            $(elem).trigger("reset");
                             if(a.data.message){
                                 ss.alert_notice(a.data.message);
                              }
                            if(a.data.url){

                                window.location = a.data.url;
                            }

                        }

                    }
                };

                data = new FormData(form);

                ss.ajax( form.action, form.method, data, callback, 'json', true)
                return false;
            },
          errorPlacement: function (error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight: function (element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function (element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            }

        });

    },
};


