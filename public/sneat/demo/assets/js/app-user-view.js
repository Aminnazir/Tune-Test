"use strict";
!function () {
    const n = document.querySelector(".suspend-user");
    n && (n.onclick = function () {
        Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert user!",
            icon: "warning",
            showCancelButton: !0,
            confirmButtonText: "Yes, Suspend user!",
            customClass: {confirmButton: "btn btn-primary me-2", cancelButton: "btn btn-label-secondary"},
            buttonsStyling: !1
        }).then((function (n) {
            n.value ? Swal.fire({
                icon: "success",
                title: "Suspended!",
                text: "User has been suspended.",
                customClass: {confirmButton: "btn btn-success"}
            }) : n.dismiss === Swal.DismissReason.cancel && Swal.fire({
                title: "Cancelled",
                text: "Cancelled Suspension :)",
                icon: "error",
                customClass: {confirmButton: "btn btn-success"}
            })
        }))
    });
    const t = document.querySelectorAll(".cancel-subscription");
    t && t.forEach((n => {
        n.onclick = function () {
            Swal.fire({
                text: "Are you sure you would like to cancel your subscription?",
                icon: "warning",
                showCancelButton: !0,
                confirmButtonText: "Yes",
                customClass: {confirmButton: "btn btn-primary me-2", cancelButton: "btn btn-label-secondary"},
                buttonsStyling: !1
            }).then((function (n) {
                n.value ? Swal.fire({
                    icon: "success",
                    title: "Unsubscribed!",
                    text: "Your subscription cancelled successfully.",
                    customClass: {confirmButton: "btn btn-success"}
                }) : n.dismiss === Swal.DismissReason.cancel && Swal.fire({
                    title: "Cancelled",
                    text: "Unsubscription Cancelled!!",
                    icon: "error",
                    customClass: {confirmButton: "btn btn-success"}
                })
            }))
        }
    }))
}();
