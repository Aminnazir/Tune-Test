"use strict";
const formAuthentication = document.querySelector("#formAuthentication");
document.addEventListener("DOMContentLoaded", (function (e) {
    !function () {
        if (formAuthentication) {
            FormValidation.formValidation(formAuthentication, {
                fields: {
                    username: {
                        validators: {
                            notEmpty: {message: "Please enter username"},
                            stringLength: {min: 6, message: "Username must be more than 6 characters"}
                        }
                    },
                    email: {
                        validators: {
                            notEmpty: {message: "Please enter your email"},
                            emailAddress: {message: "Please enter valid email address"}
                        }
                    }
                },
                plugins: {
                    trigger: new FormValidation.plugins.Trigger,
                    bootstrap5: new FormValidation.plugins.Bootstrap5({eleValidClass: "", rowSelector: ".mb-3"}),
                    submitButton: new FormValidation.plugins.SubmitButton,
                    defaultSubmit: new FormValidation.plugins.DefaultSubmit,
                    autoFocus: new FormValidation.plugins.AutoFocus
                },
                init: e => {
                    e.on("plugins.message.placed", (function (e) {
                        e.element.parentElement.classList.contains("input-group") && e.element.parentElement.insertAdjacentElement("afterend", e.messageElement)
                    }))
                }
            })
        }
        const e = document.querySelectorAll(".numeral-mask");
        e.length && e.forEach((e => {
            new Cleave(e, {numeral: !0})
        }))
    }()
}));
