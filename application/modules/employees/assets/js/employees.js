$(document).ready(function (){

    if($('form.ajax-form').length) {
        //form page config and actions
        submitForm();
        $('.money').number( true, 2 );
        $('.datepicker').bootstrapMaterialDatePicker({ 
            weekStart : 0, 
            time: false,
            format: 'MM/DD/YYYY'
        });
        $('.date-mask').mask('99/99/9999');
        $('.phone-mask').mask('(999) 999-9999');
    } else {
        //list page actions
        deleteItem();
        showDetails();
    }

});

//submit function
const submitForm = () => {

    $form = $("form.ajax-form");
    let validator = $form.validate();

    $form.on('submit', (e) => {
        e.preventDefault();

        //prevent multiple submit
        if($("button[type='submit']").hasClass('loading'))
            return
    
        $("button[type='submit']").addClass("loading");
            
        if (!validator.form()) {
            $("button[type='submit']").removeClass("loading");
            return false;
        }
        
        $.ajax({
            url: $form.attr('action'),
            dataType: 'json',
            type: 'post',
            data: $form.serialize(),
            success: function (response) {

                $('.message').text(response.message);

                if (response.status) {
                    $('.message').removeClass('text-danger').addClass('text-primary');
                    setTimeout(() => {
                        window.location.href = siteUrl + 'employees'
                    },1000);
                } else {
                    $('.message').addClass('text-danger').removeClass('text-primary');
                    $("button[type='submit']").removeClass("loading");
                }
            }
        });
    });
}

// delete employee
const deleteItem = () => {
    $('.delete-employee').on('click', function(e) {
        e.preventDefault();
        $deleteBtn = $(this);

        if($deleteBtn.hasClass('loading'))
            return

        $deleteBtn.addClass('loading');

        $.ajax({
            url: $deleteBtn.attr('href'),
            dataType: 'json',
            type: 'get',
            success: function (response) {

                $deleteBtn.removeClass('loading');

                if (response.status) {
                    $deleteBtn.closest('tr').addClass('removing');
                    setTimeout(() => {
                        $deleteBtn.closest('tr').remove();
                        if (!$('.table tbody tr').length) {
                            $('.table-responsive').remove();
                            $('.empty').removeClass('d-none');
                        }
                    },300)
                } else {
                    Swal.fire({
                        title: 'Error',
                        text: response.message,
                        icon: 'error'
                    });
                }
            }
        });
    });
}

const showDetails = () => {
    $('.show-employee').on('click', function(e) {
        e.preventDefault();
        $showBtn = $(this);

        if($showBtn.hasClass('loading'))
            return

        $showBtn.addClass('loading');

        $.ajax({
            url: $showBtn.attr('href'),
            dataType: 'json',
            type: 'get',
            success: function (response) {

                $showBtn.removeClass('loading');

                if (response.status) {
                    $('.modal-content').html(response.view);
                    $('.modal').modal('show');
                } else {
                    Swal.fire({
                        title: 'Error',
                        text: response.message,
                        icon: 'error'
                    });
                }
            }
        });
    });
}