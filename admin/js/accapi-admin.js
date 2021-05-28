/*
* Crud simple with JS and JQUERY using API REST free *gorest.co*
* With Auth TOKEN (check code)
* Author: Anibal Copitan
* website: www.anibalcopitan.com
*/
var jQuery;
var app;
(function ($) {
    'use strict';
    // variables
    var API_URL_USERS = 'https://gorest.co.in/public-api/users';
    var TOKEN_GO_REST = 'c0b3521fb248c25bc3f4e40f4419c91d7c06f1887b897e6a7ba722aae5ccf412';
    app = new function () {
        var $tableList = $('#list');
        var $elAdd = $('#add');
        var $tableEdit = $('#edit');
        var LASTPAGE = 1; // usefull to render new record inserted
        this.listado = function (paramGet) {
            if (paramGet === void 0) { paramGet = ''; }
            jQuery.ajax({
                url: API_URL_USERS + paramGet,
                dataType: "json",
                beforeSend: function () {
                    $tableList.find('tbody tr:not(:first)').remove();
                    $tableList.find('tbody').append("<tr>" + "<td colspan='5'>Cargando...</td>" + "</tr>");
                }
            }).done(function (data) {
                LASTPAGE = data.meta.pagination.pages; // Set the last page of service
                if (data.code === 200) {
                    $tableList.find('tbody tr:not(:first)').remove();
                    $.each(data.data, function (key, value) {
                        $tableList.find('tbody').append("<tr>" +
                            "<td>" + value.id + "</td>" +
                            "<td>" + value.name + "</td>" +
                            "<td>" + value.email + "</td>" +
                            "<td>" + value.gender + "</td>" +
                            "<td><a href='#' onclick='app.editar(event)'>Actualizar</a>|<a href='#' onclick='app.eliminar(event)'>Eliminar</a></td>" +
                            "</tr>");
                    });
                }
            });
        };
        // 
        this.editar = function (event) {
            event.preventDefault();
            var $trElement = $(event.target).parent().parent();
            $tableEdit.show();
            $tableEdit.find('#edit-id').val($trElement.find('td:eq(0)').text());
            $tableEdit.find('#edit-nombre').val($trElement.find('td:eq(1)').text());
            $tableEdit.find('#edit-correo').val($trElement.find('td:eq(2)').text());
            $tableEdit.find('#edit-sexo').val($trElement.find('td:eq(3)').text());
        };
        this.editarYGuardar = function (event) {
            event.preventDefault();
            var concatURL = API_URL_USERS + '/' + $tableEdit.find('#edit-id').val();
            var xhr = new XMLHttpRequest();
            xhr.open("PATCH", concatURL);
            xhr.setRequestHeader("Accept", "application/json");
            xhr.setRequestHeader("Authorization", "Bearer " + TOKEN_GO_REST);
            xhr.setRequestHeader("Content-Type", "application/json");
            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4) {
                    console.log(xhr.status);
                    console.log(xhr.responseText);
                    // update table
                    app.listado();
                }
            };
            var data = {
                "name": $tableEdit.find('#edit-nombre').val(),
                "email": $tableEdit.find('#edit-correo').val(),
                "gender": $tableEdit.find('#edit-sexo').val()
            };
            var myJSON = JSON.stringify(data);
            xhr.send(myJSON);
            // clear form
            $tableEdit.find('form')[0].reset();
            $tableEdit.hide();
        };
        this.editarYCancelar = function (event) {
            event.preventDefault();
            $tableEdit.find('form')[0].reset();
            $tableEdit.hide();
        };
        this.eliminar = function (event) {
            event.preventDefault();
            var $trElement = $(event.target).parent().parent();
            var status = confirm("Seguro de eliminar el registro ID:  " + $trElement.find('td:eq(0)').text());
            if (status == true) {
                var concatURL = API_URL_USERS + '/' + $trElement.find('td:eq(0)').text();
                var xhr = new XMLHttpRequest();
                xhr.open("DELETE", concatURL);
                xhr.setRequestHeader("Accept", "application/json");
                xhr.setRequestHeader("Authorization", "Bearer " + TOKEN_GO_REST);
                xhr.setRequestHeader("Content-Type", "application/json");
                xhr.onreadystatechange = function () {
                    if (xhr.readyState === 4) {
                        console.log(xhr.status);
                        console.log(xhr.responseText);
                        // update table
                        app.listado();
                    }
                };
                xhr.send();
            }
        };
        this.agregar = function (event) {
            event.preventDefault();
            var xhr = new XMLHttpRequest();
            xhr.open("POST", API_URL_USERS);
            xhr.setRequestHeader("Accept", "application/json");
            xhr.setRequestHeader("Authorization", "Bearer " + TOKEN_GO_REST);
            xhr.setRequestHeader("Content-Type", "application/json");
            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4) {
                    console.log(xhr.status);
                    console.log(xhr.responseText);
                    // update table
                    app.verUltimosRegistros();
                }
            };
            var data = {
                "name": $elAdd.find('#nombre').val(),
                "email": $elAdd.find('#correo').val(),
                "gender": $elAdd.find('#sexo').val(),
                "status": 'Inactive'
            };
            var myJSON = JSON.stringify(data);
            xhr.send(myJSON);
            // clear form
            $elAdd.find('form')[0].reset();
        };
        this.verUltimosRegistros = function () {
            // update table
            app.listado('?page=' + LASTPAGE);
        };
    };
    // 
    // Start Application
    // 
    app.listado();
})(jQuery);
