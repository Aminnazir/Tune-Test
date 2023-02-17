"use strict";
$((function () {
    let e, t, a;
    isDarkStyle ? (e = config.colors_dark.borderColor, t = config.colors_dark.bodyBg, a = config.colors_dark.headingColor) : (e = config.colors.borderColor, t = config.colors.bodyBg, a = config.colors.headingColor);
    var n = $(".datatables-users"), s = $(".select2"), o = baseUrl + "app/user/view/account", r = {
        1: {title: "Pending", class: "bg-label-warning"},
        2: {title: "Active", class: "bg-label-success"},
        3: {title: "Inactive", class: "bg-label-secondary"}
    };
    if (s.length) {
        var l = s;
        l.wrap('<div class="position-relative"></div>').select2({
            placeholder: "Select Country",
            dropdownParent: l.parent()
        })
    }
    if (n.length) var i = n.DataTable({
        ajax: assetsPath + "json/user-list.json",
        columns: [{data: ""}, {data: "full_name"}, {data: "role"}, {data: "current_plan"}, {data: "billing"}, {data: "status"}, {data: "action"}],
        columnDefs: [{
            className: "control",
            searchable: !1,
            orderable: !1,
            responsivePriority: 2,
            targets: 0,
            render: function (e, t, a, n) {
                return ""
            }
        }, {
            targets: 1, responsivePriority: 4, render: function (e, t, a, n) {
                var s = a.full_name, r = a.email, l = a.avatar;
                if (l) var i = '<img src="' + assetsPath + "/img/avatars/" + l + '" alt="Avatar" class="rounded-circle">'; else {
                    var c = ["success", "danger", "warning", "info", "dark", "primary", "secondary"][Math.floor(6 * Math.random())],
                        d = (s = a.full_name).match(/\b\w/g) || [];
                    i = '<span class="avatar-initial rounded-circle bg-label-' + c + '">' + (d = ((d.shift() || "") + (d.pop() || "")).toUpperCase()) + "</span>"
                }
                return '<div class="d-flex justify-content-start align-items-center user-name"><div class="avatar-wrapper"><div class="avatar avatar-sm me-3">' + i + '</div></div><div class="d-flex flex-column"><a href="' + o + '" class="text-body text-truncate"><span class="fw-semibold">' + s + '</span></a><small class="text-muted">' + r + "</small></div></div>"
            }
        }, {
            targets: 2, render: function (e, t, a, n) {
                var s = a.role;
                return "<span class='text-truncate d-flex align-items-center'>" + {
                    Subscriber: '<span class="badge badge-center rounded-pill bg-label-warning w-px-30 h-px-30 me-2"><i class="bx bx-user bx-xs"></i></span>',
                    Author: '<span class="badge badge-center rounded-pill bg-label-success w-px-30 h-px-30 me-2"><i class="bx bx-cog bx-xs"></i></span>',
                    Maintainer: '<span class="badge badge-center rounded-pill bg-label-primary w-px-30 h-px-30 me-2"><i class="bx bx-pie-chart-alt bx-xs"></i></span>',
                    Editor: '<span class="badge badge-center rounded-pill bg-label-info w-px-30 h-px-30 me-2"><i class="bx bx-edit bx-xs"></i></span>',
                    Admin: '<span class="badge badge-center rounded-pill bg-label-secondary w-px-30 h-px-30 me-2"><i class="bx bx-mobile-alt bx-xs"></i></span>'
                }[s] + s + "</span>"
            }
        }, {
            targets: 3, render: function (e, t, a, n) {
                return '<span class="fw-semibold">' + a.current_plan + "</span>"
            }
        }, {
            targets: 5, render: function (e, t, a, n) {
                var s = a.status;
                return '<span class="badge ' + r[s].class + '">' + r[s].title + "</span>"
            }
        }, {
            targets: -1, title: "Actions", searchable: !1, orderable: !1, render: function (e, t, a, n) {
                return '<div class="d-inline-block text-nowrap"><button class="btn btn-sm btn-icon"><i class="bx bx-edit"></i></button><button class="btn btn-sm btn-icon delete-record"><i class="bx bx-trash"></i></button><button class="btn btn-sm btn-icon dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></button><div class="dropdown-menu dropdown-menu-end m-0"><a href="' + o + '" class="dropdown-item">View</a><a href="javascript:;" class="dropdown-item">Suspend</a></div></div>'
            }
        }],
        order: [[1, "desc"]],
        dom: '<"row mx-2"<"col-md-2"<"me-3"l>><"col-md-10"<"dt-action-buttons text-xl-end text-lg-start text-md-end text-start d-flex align-items-center justify-content-end flex-md-row flex-column mb-3 mb-md-0"fB>>>t<"row mx-2"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
        language: {sLengthMenu: "_MENU_", search: "", searchPlaceholder: "Search.."},
        buttons: [{
            extend: "collection",
            className: "btn btn-label-secondary dropdown-toggle mx-3",
            text: '<i class="bx bx-upload me-2"></i>Export',
            buttons: [{
                extend: "print",
                text: '<i class="bx bx-printer me-2" ></i>Print',
                className: "dropdown-item",
                exportOptions: {
                    columns: [1, 2, 3, 4, 5], format: {
                        body: function (e, t, a) {
                            if (e.length <= 0) return e;
                            var n = $.parseHTML(e), s = "";
                            return $.each(n, (function (e, t) {
                                void 0 !== t.classList && t.classList.contains("user-name") ? s += t.lastChild.firstChild.textContent : void 0 === t.innerText ? s += t.textContent : s += t.innerText
                            })), s
                        }
                    }
                },
                customize: function (n) {
                    $(n.document.body).css("color", a).css("border-color", e).css("background-color", t), $(n.document.body).find("table").addClass("compact").css("color", "inherit").css("border-color", "inherit").css("background-color", "inherit")
                }
            }, {
                extend: "csv",
                text: '<i class="bx bx-file me-2" ></i>Csv',
                className: "dropdown-item",
                exportOptions: {
                    columns: [1, 2, 3, 4, 5], format: {
                        body: function (e, t, a) {
                            if (e.length <= 0) return e;
                            var n = $.parseHTML(e), s = "";
                            return $.each(n, (function (e, t) {
                                void 0 !== t.classList && t.classList.contains("user-name") ? s += t.lastChild.firstChild.textContent : void 0 === t.innerText ? s += t.textContent : s += t.innerText
                            })), s
                        }
                    }
                }
            }, {
                extend: "excel",
                text: "Excel",
                className: "dropdown-item",
                exportOptions: {
                    columns: [1, 2, 3, 4, 5], format: {
                        body: function (e, t, a) {
                            if (e.length <= 0) return e;
                            var n = $.parseHTML(e), s = "";
                            return $.each(n, (function (e, t) {
                                void 0 !== t.classList && t.classList.contains("user-name") ? s += t.lastChild.firstChild.textContent : void 0 === t.innerText ? s += t.textContent : s += t.innerText
                            })), s
                        }
                    }
                }
            }, {
                extend: "pdf",
                text: '<i class="bx bxs-file-pdf me-2"></i>Pdf',
                className: "dropdown-item",
                exportOptions: {
                    columns: [1, 2, 3, 4, 5], format: {
                        body: function (e, t, a) {
                            if (e.length <= 0) return e;
                            var n = $.parseHTML(e), s = "";
                            return $.each(n, (function (e, t) {
                                void 0 !== t.classList && t.classList.contains("user-name") ? s += t.lastChild.firstChild.textContent : void 0 === t.innerText ? s += t.textContent : s += t.innerText
                            })), s
                        }
                    }
                }
            }, {
                extend: "copy",
                text: '<i class="bx bx-copy me-2" ></i>Copy',
                className: "dropdown-item",
                exportOptions: {
                    columns: [1, 2, 3, 4, 5], format: {
                        body: function (e, t, a) {
                            if (e.length <= 0) return e;
                            var n = $.parseHTML(e), s = "";
                            return $.each(n, (function (e, t) {
                                void 0 !== t.classList && t.classList.contains("user-name") ? s += t.lastChild.firstChild.textContent : void 0 === t.innerText ? s += t.textContent : s += t.innerText
                            })), s
                        }
                    }
                }
            }]
        }, {
            text: '<i class="bx bx-plus me-0 me-sm-2"></i><span class="d-none d-lg-inline-block">Add New User</span>',
            className: "add-new btn btn-primary",
            attr: {"data-bs-toggle": "offcanvas", "data-bs-target": "#offcanvasAddUser"}
        }],
        responsive: {
            details: {
                display: $.fn.dataTable.Responsive.display.modal({
                    header: function (e) {
                        return "Details of " + e.data().full_name
                    }
                }), type: "column", renderer: function (e, t, a) {
                    var n = $.map(a, (function (e, t) {
                        return "" !== e.title ? '<tr data-dt-row="' + e.rowIndex + '" data-dt-column="' + e.columnIndex + '"><td>' + e.title + ":</td> <td>" + e.data + "</td></tr>" : ""
                    })).join("");
                    return !!n && $('<table class="table"/><tbody />').append(n)
                }
            }
        },
        initComplete: function () {
            this.api().columns(2).every((function () {
                var e = this,
                    t = $('<select id="UserRole" class="form-select text-capitalize"><option value=""> Select Role </option></select>').appendTo(".user_role").on("change", (function () {
                        var t = $.fn.dataTable.util.escapeRegex($(this).val());
                        e.search(t ? "^" + t + "$" : "", !0, !1).draw()
                    }));
                e.data().unique().sort().each((function (e, a) {
                    t.append('<option value="' + e + '">' + e + "</option>")
                }))
            })), this.api().columns(3).every((function () {
                var e = this,
                    t = $('<select id="UserPlan" class="form-select text-capitalize"><option value=""> Select Plan </option></select>').appendTo(".user_plan").on("change", (function () {
                        var t = $.fn.dataTable.util.escapeRegex($(this).val());
                        e.search(t ? "^" + t + "$" : "", !0, !1).draw()
                    }));
                e.data().unique().sort().each((function (e, a) {
                    t.append('<option value="' + e + '">' + e + "</option>")
                }))
            })), this.api().columns(5).every((function () {
                var e = this,
                    t = $('<select id="FilterTransaction" class="form-select text-capitalize"><option value=""> Select Status </option></select>').appendTo(".user_status").on("change", (function () {
                        var t = $.fn.dataTable.util.escapeRegex($(this).val());
                        e.search(t ? "^" + t + "$" : "", !0, !1).draw()
                    }));
                e.data().unique().sort().each((function (e, a) {
                    t.append('<option value="' + r[e].title + '" class="text-capitalize">' + r[e].title + "</option>")
                }))
            }))
        }
    });
    $(".datatables-users tbody").on("click", ".delete-record", (function () {
        i.row($(this).parents("tr")).remove().draw()
    })), setTimeout((() => {
        $(".dataTables_filter .form-control").removeClass("form-control-sm"), $(".dataTables_length .form-select").removeClass("form-select-sm")
    }), 300)
})), function () {
    const e = document.querySelectorAll(".phone-mask"), t = document.getElementById("addNewUserForm");
    e && e.forEach((function (e) {
        new Cleave(e, {phone: !0, phoneRegionCode: "US"})
    }));
    FormValidation.formValidation(t, {
        fields: {
            userFullname: {validators: {notEmpty: {message: "Please enter fullname "}}},
            userEmail: {
                validators: {
                    notEmpty: {message: "Please enter your email"},
                    emailAddress: {message: "The value is not a valid email address"}
                }
            }
        },
        plugins: {
            trigger: new FormValidation.plugins.Trigger,
            bootstrap5: new FormValidation.plugins.Bootstrap5({
                eleValidClass: "", rowSelector: function (e, t) {
                    return ".mb-3"
                }
            }),
            submitButton: new FormValidation.plugins.SubmitButton,
            autoFocus: new FormValidation.plugins.AutoFocus
        }
    })
}();
