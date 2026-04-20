
function toast(type,title) {
    classes = type == 'success' ? 'fa-regular fa-circle-check text-success' : 'fa-solid fa-xmark text-danger';
    $('#liveToast i').removeClass().addClass(classes);
    $('#liveToast strong').html(title);
    var toastLiveExample = document.getElementById('liveToast');
    var toast = new bootstrap.Toast(toastLiveExample);
    toast.show();
}



$(document).on("click", '.fa-plus', function () {
    Modal = $(this).closest(".modal");
    q = parseInt($(Modal).find('.quantity').html()) + 1;
    $(Modal).find('.quantity').html(q);
    $(Modal).find('input[name="quantity"]').val(q);
});
$(document).on("click", '.fa-minus', function () {
    Modal = $(this).closest(".modal");
    q = parseInt($(Modal).find('.quantity').html()) - 1;
    $(Modal).find('.quantity').html(q <= 1 ? 1 : q);
    $(Modal).find('input[name="quantity"]').val(q);
});

$(document).on("submit", '.add-to-cart', function (event) {
    event.preventDefault();

    let lang = $('html').attr('lang') || 'en';

    let required_validation = true;
    let error_message = "";

    $.each($(this).find('.checkbox.required'), function (index, obj) {
        let min = parseInt($(obj).attr('min'));
        let max = parseInt($(obj).attr('max'));
        let title = $(obj).attr('title') || (lang === 'ar' ? "هذا الخيار" : "this option");
        let checked_count = $(obj).find('input[type="checkbox"]:checked').length;

        // Generate error message based on language
        if (checked_count < min || checked_count > max) {
            required_validation = false;
            if (lang === 'ar') {
                error_message = `يرجى اختيار بين ${min} و ${max} مربعات اختيار لـ ${title}.`;
            } else {
                error_message = `Please select between ${min} and ${max} checkboxes for ${title}.`;
            }
            return false;  // Exit the loop early if validation fails
        }
    });

    if (required_validation) {
        this.submit();
    } else {
        alert(error_message);
    }
});
