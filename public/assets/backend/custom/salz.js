/*
Required jQuery
*/


$.fn.setButton = function (state = 'loading', isLoadingText = true) {
    // NOTE Bootstrap 5 Loading Spinner
    // NOTE Usage $(elem).setButton(state)
    if (state == 'loading') {
        this.attr("data-original-text", this.html());
        this.prop("disabled", true);

        if (isLoadingText) {
            this.html('<i class="spinner-border spinner-border-sm"></i> Loading...');
        } else {
            this.html('<i class="spinner-border spinner-border-sm"></i>');
        }
    } else {
        this.prop("disabled", false);
        this.html(this.attr("data-original-text"));
    }
}

$.fn.setButtonAvail = function (state = false) {
    // NOTE Bootstrap 5 set text avail with icon
    // NOTE Usage $(elem).setButtonAvail(state)

    var text_ori = this.attr("data-original-text") ?? this.html();

    if (!state) {
        this.html(text_ori + ' <span class="badge text-bg-danger"><i class="bi bi-x"></i></span>');
    } else {
        this.html(text_ori + ' <span class="badge text-bg-success"><i class="bi bi-check"></i></span>');
    }

    var text_exp = text_ori.split('<span');

    this.attr("data-original-text", text_exp[0]);
}

async function setActiveMenu(dest_menu) {
    // var base_url = window.location.href;
    let menuClass = '.sidebar-menu';

    setTimeout(() => {
        // remove all active class
        $(menuClass + ' ul a').parent().removeClass('active');

        // add active class
        $(menuClass + ' ul a[href="' + dest_menu + '"]').parent().addClass('active');

        $(menuClass + ' ul a[href="' + dest_menu + '"]').parent().parent().parent().addClass('active');
    }, 5000);
}


function popResult(table, response) {
    let res = response.result;

    if (res.success) {
        Swal.fire({
            title: 'Success',
            text: res.msg,
            icon: 'success',
            confirmButtonText: 'OK',
        }).then((result) => {
            if (result.isConfirmed) { }
            table.ajax.reload();
        });
    } else {
        Swal.fire({
            title: 'Error',
            text: res.msg,
            icon: 'error',
        });
    }
}

// REFF : https://www.freecodecamp.org/news/how-to-format-number-as-currency-in-javascript-one-line-of-code/
// How to use : numberToRupiah.format(1000000); // Rp 1,000,000.00
const numberToRupiah = new Intl.NumberFormat('id-ID', {
    style: 'currency',
    currency: 'IDR',
});
